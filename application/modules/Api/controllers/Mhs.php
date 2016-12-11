<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhs extends Application 
{
	public function __construct()
	{
		parent::__construct();
		// load model mahasiswa
		$this->load->model('mmhs', 'mahasiswa');
	}

	public function index()
	{
		
	}

	/**
	 * Cek Validasi NPM Mahasiswa
	 *
	 * @param String (POST) npm 
	 * @return string
	 **/
	public function auth_npm()
	{
		if($this->input->get('method') == 'update')
		{
			$output['valid'] = ($this->mahasiswa->oneNpm($this->input->post('npm'),$this->input->get('id'))) ? TRUE : FALSE;
		} else {
			$output['valid'] = ($this->mahasiswa->getNpm($this->input->post('npm'))) ? TRUE : FALSE;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}
}

/* End of file Mhs.php */
/* Location: ./application/modules/Api/controllers/Mhs.php */