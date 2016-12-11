<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Mahasiswa Model
 * @category Mahasiswa Module
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @see https://github.com/nitinegoro/pertiba-perpus
 **/

class Mmahasiswa extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('upload');
	}

	public function get_all($limit = 10, $offset = 0, $type = 'result')
	{
		$this->db->join('tb_ktm', 'tb_mahasiswa.npm = tb_ktm.npm', 'left');

		if($this->input->get('q') != '')
			$this->db->like('tb_mahasiswa.nama_lengkap', $this->input->get('q'))
					->or_like('tb_mahasiswa.npm', $this->input->get('q'))
					->or_like('tb_ktm.barcode', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('tb_mahasiswa', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_mahasiswa')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$query = $this->db->query("
			SELECT tb_mahasiswa.*, tb_ktm.*, tb_peminjaman.ID_pinjaman FROM tb_mahasiswa 
			LEFT JOIN tb_ktm ON tb_mahasiswa.npm = tb_ktm.npm 
			LEFT JOIN tb_peminjaman ON tb_mahasiswa.ID = tb_peminjaman.mahasiswa_id
			WHERE tb_mahasiswa.ID = ?
			", array($param));
		return $query->row();
	}
	
	public function insert()
	{
		$mahasiswa = array(
			'npm' => $this->input->post('npm'),
			'nama_lengkap' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('gender'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'thn_masuk' => $this->input->post('thn_masuk'),
			'program_studi' => $this->input->post('program'),
			'kelas_perkuliahan' => $this->input->post('kelas'),
			'konsentrasi' => $this->input->post('konsentrasi') 
		);

		$this->db->insert('tb_mahasiswa', $mahasiswa);

		$ktm = array(
			'npm' => $mahasiswa['npm'],
			'barcode' => $this->input->post('barcode'),
			'foto' => $this->upload_foto() 
		);

		$this->db->insert('tb_ktm', $ktm);

		if($this->upload->display_errors() != '') 
		{
			$this->template->alert(
				$this->upload->display_errors('<span>', '</span>'), 
				array('type' => 'warning','icon' => 'warning')
			);	
		} else {
			$this->template->alert(
				" Mahasiswa ditambahkan.", 
				array('type' => 'success','icon' => 'check')
			);	
		}
	}

	/**
	 * Set Upload file foto
	 *
	 * @return string (file name)
	 **/
	private function upload_foto()
	{
		$config['upload_path'] = 'assets/foto-ktm';
		$config['allowed_types'] = 'gif|jpg|png|JPG|PNG';
		$config['max_size']  = '3072';
		$config['max_width']  = '1500';
		$config['max_height']  = '2000';
		$config['file_name'] = $this->input->post('npm');
		$config['overwrite'] = TRUE;
		
		$this->upload->initialize($config);
		
		// set foto ktm mahasiswa 
		$file_foto = (!$this->upload->do_upload('foto')) ? "" : $this->upload->file_name;

		return $file_foto;
	}

	/**
	 * Update data mahasiswa
	 *
	 * @param Integer (ID)
	 * @return string
	 **/
	public function update($param = 0)
	{
		// get original data
		$get = $this->get($param);

		// tb_mahasiswa
		$mahasiswa = array(
			'npm' => $this->input->post('npm'),
			'nama_lengkap' => $this->input->post('nama'),
			'jenis_kelamin' => $this->input->post('gender'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'thn_masuk' => $this->input->post('thn_masuk'),
			'program_studi' => $this->input->post('program'),
			'kelas_perkuliahan' => $this->input->post('kelas'),
			'konsentrasi' => $this->input->post('konsentrasi') 
		);

		$this->db->update('tb_mahasiswa', $mahasiswa, array('ID' => $param));

		// upload file
		$uploading_file = $this->upload_foto();

		if($uploading_file != '')
		{
			// hapus foto lama
			if($get->foto != '')
				unlink("assets/foto-ktm/{$get->foto}");
			// ganti dgn yg baru
			$file_foto = $uploading_file;
		} else {
			$file_foto = $get->foto;
		}

		// tb_ktm
		$ktm = array(
			'npm' => $mahasiswa['npm'],
			'barcode' => $this->input->post('barcode'),
			'foto' => $file_foto
		);

		$this->db->update('tb_ktm', $ktm, array('ktm_id' => $get->ktm_id));

		if($this->upload->display_errors() != '') 
		{
			$this->template->alert(
				$this->upload->display_errors('<span>', '</span>'), 
				array('type' => 'warning','icon' => 'warning')
			);	
		} else {
			$this->template->alert(
				" Perubahan disimpan.", 
				array('type' => 'success','icon' => 'check')
			);	
		}
	}

	/**
	 * Select semua data transaksi mahasiswa
	 * Meliputi tb_peminjaman, tb_detail_peminjaman, tb_pengembalian, tb_book_lose, tb_denda
	 * 
	 * @access private
	 * @param Integer (ID)
	 * @return Result
	 **/
	private function getTransaksi($param = 0)
	{
		$query = $this->db->query("SELECT ID_pinjaman FROM tb_peminjaman WHERE mahasiswa_id = ?", $param);
		return $query->result();
	}

	/**
	 * Delete data mahasiswa dan transaksinya
	 * Meliputi tb_peminjaman, tb_detail_peminjaman, tb_pengembalian, tb_book_lose, tb_denda
	 *
	 * @param Integer (ID)
	 * @return string
	 **/
	public function delete($param = 0)
	{
		$mahasiswa = $this->get($param);

		// hapus semua transaksinya
		foreach ($this->getTransaksi($param) as $row) 
		{
			$this->db->delete('tb_detail_peminjaman', array('ID_pinjaman' => $row->ID_pinjaman));

			$this->db->delete('tb_pengembalian', array('peminjaman_kembali' => $row->ID_pinjaman));

			$this->db->delete('tb_denda', array('peminjaman_denda' => $row->ID_pinjaman));

			$this->db->update('tb_book_lose', array('book_peminjaman' => 0), array('book_peminjaman' => $row->ID_pinjaman));
		}

		$this->db->delete('tb_peminjaman', array('mahasiswa_id' => $param));

		if($mahasiswa->foto !='')
			unlink("assets/foto-ktm/{$mahasiswa->foto}");

		$this->db->delete('tb_ktm', array('npm' => $mahasiswa->npm));

		$this->db->delete('tb_mahasiswa', array('ID' => $param));

		$this->template->alert(
			" Data terhapus.", 
			array('type' => 'success','icon' => 'check')
		);	
	}

	/**
	 * Multiple Action data Mahasiswa 
	 *
	 * @param Array (Integer) ID : tb_mahasiswa
	 * @return String
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('mahasiswa')))
		{
			foreach ($this->input->post('mahasiswa') as $key => $value) 
			{
				$mahasiswa = $this->get($value);

				// hapus semua transaksinya
				foreach ($this->getTransaksi($value) as $row) 
				{
					$this->db->delete('tb_detail_peminjaman', array('ID_pinjaman' => $row->ID_pinjaman));

					$this->db->delete('tb_pengembalian', array('peminjaman_kembali' => $row->ID_pinjaman));

					$this->db->delete('tb_denda', array('peminjaman_denda' => $row->ID_pinjaman));

					$this->db->update('tb_book_lose', array('book_peminjaman' => 0), array('book_peminjaman' => $row->ID_pinjaman));
				}

				$this->db->delete('tb_peminjaman', array('mahasiswa_id' => $value));

				if($mahasiswa->foto !='')
					unlink("assets/foto-ktm/{$mahasiswa->foto}");

				$this->db->delete('tb_ktm', array('npm' => $mahasiswa->npm));

				$this->db->delete('tb_mahasiswa', array('ID' => $value));
			}
		} 

		$this->template->alert(
			" Data terhapus.", 
			array('type' => 'success','icon' => 'check')
		);	
	}

	/**
	 * Uploads data yang akan diimport
	 *
	 * @package PHPExcel
	 * @return String
	 **/
	public function import()
	{
		// load library PHPExcel
		$this->load->library(array('Excel/PHPExcel'));

		$config['upload_path'] = 'assets/excel';
		$config['allowed_types'] = 'xlsx';
		$config['max_size']  = '5120';
		
		$this->upload->initialize($config);
		
		if ( ! $this->upload->do_upload('excel')) 
		{
			$output = array('status' => 'error', 'message' => $this->upload->display_errors('<span>','</span>'));
		} else {
			$file_excel = "./assets/excel/{$this->upload->file_name}";

			// identifikasi file
			try 
			{
				$excelReader = new PHPExcel_Reader_Excel2007();

            	$loadExcel = $excelReader->load($file_excel);	

            	$sheet = $loadExcel->getActiveSheet()->toArray(null, true, true ,true);
		        // Loops Excel data reader
		        $baris = 1;
		        foreach ($sheet as $row) 
		        {

		        	if($baris > 1)
		        	{
		        		if($row['B'] == FALSE OR $this->getNpm($row['B'])) continue;
						// set data mahasiswa
						$mahasiswa = array(
							'npm' => $row['B'],
							'nama_lengkap' => $row['C'],
							'jenis_kelamin' => lcfirst($row['D']),
							'tgl_lahir' => date("Y-m-d", PHPExcel_Shared_Date::ExcelToPHP($row['E'])),
							'thn_masuk' => $row['F'],
							'program_studi' => $row['G'],
							'kelas_perkuliahan' => $row['H'],
							'konsentrasi' => $row['I'] 
						);	
						
						$this->db->insert('tb_mahasiswa', $mahasiswa);    

						// set data ktm
						$ktm = array(
							'npm' => $row['B'],
							'barcode' => $row['J'],
							'foto' => $row['K']
						);

						$this->db->insert('tb_ktm', $ktm);    	
					}

					$baris++;
		        }

		        unlink("./assets/excel/{$this->upload->file_name}");

				$output = array(
					'status' => 'OK', 
					'message' => ' Data Mahasiswa berhasil diimport.'
				);
			} catch (Exception $e) {
				$output = array(
					'status' => 'error', 
					'message' => 'Error loading file "'.pathinfo($file_excel,PATHINFO_BASENAME).'": '.$e->getMessage()
				);
				
			}
		}

		echo json_encode($output);
	}

	/**
	 * Cek Validasi NPM Mahasiswa
	 *
	 * @param Integer = npm 
	 * @return Boolean
	 **/
	public function getNpm($param = 0)
	{
		$query = $this->db->query("SELECT npm FROM tb_mahasiswa WHERE npm = ?", $param);
		if($query->num_rows())
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file Mmahasiswa.php */
/* Location: ./application/modules/Mahasiswa/models/Mmahasiswa.php */