<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Mahasiswa Controller
 * @category Mahasiswa Module
 * @author Vicky Nitinegoro <pkpvicky@gmail.com>
 * @see https://github.com/nitinegoro/pertiba-perpus
 **/

class Mahasiswa extends Application 
{
	public function __construct()
	{
		parent::__construct();

		$this->breadcrumbs->unshift(1, 'Mahasiswa ', 'mahasiswa');

		$this->load->model('mmahasiswa', 'mahasiswa');

		// load js mahasiswa
		$this->load->js(base_url('assets/app/mahasiswa.js'));
	}

	public function index()
	{
		$this->breadcrumbs->unshift(1, 'Data Mahasiswa ', 'index');
		$this->page_title->push('Mahasiswa', 'Data Mahasiswa');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("mahasiswa?per_page={$this->input->get('per_page')}&q={$this->input->get('q')}");
		$config['per_page'] = (!$this->input->get('per_page')) ? 20 : $this->input->get('per_page');
		$config['total_rows'] = $this->mahasiswa->get_all(null, null, 'num');
		$config['uri_segment'] = 3;
		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Data Mahasiswa",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'mahasiswa' => $this->mahasiswa->get_all($config['per_page'], $this->input->get('page')),
			'total_rows' => $config['total_rows']
		);
		
		$this->template->view('daftar_mahasiswa', $this->data);
	}

	/**
	 * Form Tambah Mahasiswa
	 *
	 * @return Html Output
	 **/
	public function add()
	{
		$this->breadcrumbs->unshift(1, 'Tambah Mahasiswa ', 'add');
		$this->page_title->push('Mahasiswa', 'Tambah Mahasiswa');

		$this->data = array(
			'title' => "Tambah Mahasiswa",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);

		$this->template->view('tambah_mahasiswa', $this->data);
	}

	/**
	 * Insert data Mahasiswa
	 *
	 * @return Void
	 **/
	public function insert()
	{
		$this->mahasiswa->insert();
		redirect('mahasiswa/add');
	}

	/**
	 * Form Detail Mahasiswa
	 *
	 * @param Integer = ID (tb_mahasiswa)
	 * @return Html Output
	 **/
	public function get($param = 0)
	{
		if(!is_object($this->mahasiswa->get($param)))
			show_404();

		$get = $this->mahasiswa->get($param);

		$this->breadcrumbs->unshift(1, 'Sunting Mahasiswa ', 'add');
		$this->page_title->push('Mahasiswa', 'Sunting Mahasiswa');

		$this->data = array(
			'title' => $get->nama_lengkap,
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $get
		);

		$this->template->view('edit_mahasiswa', $this->data);
	}

	/**
	 * Form Detail Mahasiswa
	 *
	 * @param Integer = ID (tb_mahasiswa)
	 * @return Void
	 **/
	public function update($param = 0)
	{
		if(!$param)
			show_404();

		$this->mahasiswa->update($param);
		redirect("mahasiswa/get/{$param}");
	}

	/**
	 * undocumented class variable
	 *
	 * @param Integer = ID (tb_mahasiswa)
	 * @return void
	 **/
	public function delete($param = 0)
	{
		if(!$param)
			show_404();

		$this->mahasiswa->delete($param);
		redirect("mahasiswa");
	}

	/**
	 * Multiple Action data Mahasiswa 
	 *
	 * @param Array (Integer) ID : tb_mahasiswa
	 * @return Void
	 **/
	public function bulk_action()
	{
		switch ($this->input->post('action')) 
		{
			case 'delete':
				$this->mahasiswa->multiple_delete();
				break;
			default:
				$this->template->alert(
					" Tidak ada data yang dipilih.", 
					array('type' => 'success','icon' => 'check')
				);
				break;
		}
		redirect("mahasiswa");
	}

	/**
	 * Halaman Import data mahasiswa
	 *
	 * @return Html Output
	 **/
	public function import()
	{
		$this->breadcrumbs->unshift(1, 'Import Data Mahasiswa ', 'add');
		$this->page_title->push('Mahasiswa', 'Import Data Mahasiswa');

		$this->data = array(
			'title' => "Import Data Mahasiswa",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);

		$this->template->view('import_mahasiswa', $this->data);
	}

	/**
	 * Uploads data yang akan diioport
	 *
	 * @return String
	 **/
	public function set_import()
	{
		ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
		$this->mahasiswa->import();
	}
	public function php($value='')
	{
		echo phpinfo();
	}
}
