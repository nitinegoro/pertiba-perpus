<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mmhs extends CI_Model 
{	
	/**
	 * Cek Validasi NPM Mahasiswa
	 *
	 * @param Integer (POST) npm 
	 * @return Boolean
	 **/
	public function getNpm($param = 0)
	{
		$query = $this->db->query("SELECT npm FROM tb_mahasiswa WHERE npm = ?", $param);
		if($query->num_rows())
		{
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/**
	 * Cek Validasi NPM Mahasiswa sama dengan 1
	 *
	 * @param Integer (POST) npm 
	 * @param Integer ID
	 * @return Boolean
	 **/
	public function oneNpm($npm = 0, $param = 0)
	{
		$query = $this->db->query("SELECT npm FROM tb_mahasiswa WHERE npm = ? AND ID = ?", array($npm, $param));
		if($query->num_rows()==1)
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file Mmhs.php */
/* Location: ./application/modules/Api/models/Mmhs.php */