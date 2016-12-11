<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Application 
{
	public $data = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->js(base_url('assets/app/user.js'));

		$this->load->model('muser', 'user');

		$this->breadcrumbs->unshift(1, 'Pengguna', 'user');
	}

	public function index()
	{
		$this->page_title->push('Pengaturan', 'Data Pengguna');

		// set pagination
		$config = $this->template->pagination_list();
		$config['base_url'] = site_url("user?q={$this->input->get('q')}");
		$config['per_page'] = 20;
		$config['total_rows'] = $this->user->get_all(null, null, 'num');
		$config['uri_segment'] = 3;

		$this->pagination->initialize($config);

		$this->data = array(
			'title' => "Data Pengguna",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'users' => $this->user->get_all($config['per_page'], $this->input->get('page'))
		);
		$this->template->view('user/semua_user', $this->data);
	}

	public function adduser()
	{
		$this->breadcrumbs->unshift(2, 'Tambah Pengguna', 'adduser');
		$this->page_title->push('Pengaturan', 'Tambah Pengguna');

		$this->data = array(
			'title' => "Tambah Pengguna",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('user/add_user', $this->data);
	}

	/**
	 * Handle Insert data
	 *
	 * @return void
	 **/
	public function insert()
	{
		$this->user->insert();
		redirect('user');
	}

	/**
	 * Auth username from database
	 *
	 * @param String
	 * @return Qeury Result
	 **/
	public function getusername()
	{
		// get query prepare statmennts
		$query = $this->db->query("SELECT * FROM tb_users WHERE username = ?", array($this->input->post('username')));

		if($query->num_rows() == 1)
		{
			$output['valid'] = FALSE;

		} else {
			$output['valid'] = TRUE;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Get edit Form user
	 *
	 * @return html output
	 **/
	public function get($param = 0)
	{
		$this->breadcrumbs->unshift(2, 'Sunting Pengguna', 'get');
		$this->page_title->push('Pengaturan', 'Sunting Pengguna');

		$this->data = array(
			'title' => "Sunting Pengguna",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
			'get' => $this->user->get($param)
		);
		$this->template->view('user/edit_user', $this->data);
	}

	/**
	 * Handle Update User
	 *
	 * @param Integer ID_user
	 * @return void
	 **/
	public function updateuser($param = 0)
	{
		$this->user->update($param);
		redirect("user/get/{$param}");
	}

	/**
	 * Handle Delete User
	 *
	 * @param Integer ID_user
	 * @return void
	 **/
	public function delete($param = 0)
	{
		$this->user->delete($param);
		redirect('user');
	}

	/**
	 * Handle Multiple Action
	 *
	 * @return String
	 **/
	public function bulkuser()
	{
		switch ($this->input->post('action')) 
		{
			case 'set_update':
				$this->multiple_update();
				break;
			case 'update':
				$this->user->multiple_update();
				redirect('user');
				break;
			case 'delete':
				$this->user->multiple_delete();
				redirect('user');
				break;
			default:
				$this->template->alert(
					' Tidak ada data yang dipilih.', 
					array('type' => 'warning','icon' => 'times')
				);
				break;
		}
	}

	/**
	 * Multiple Form update
	 *
	 * @access private
	 * @return Html Output
	 **/
	private function multiple_update()
	{
		$this->breadcrumbs->unshift(2, 'Sunting Pengguna', 'get');
		$this->page_title->push('Pengaturan', 'Sunting Pengguna');

		$this->data = array(
			'title' => "Sunting Pengguna",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files()
		);
		$this->template->view('user/multiple_edit_user', $this->data);
	}


	/**
	 * Get Account Setting page
	 *
	 * @return html output
	 **/
	public function account()
	{
		$this->breadcrumbs->unshift(2, 'Pengaturan', 'account');
		$this->page_title->push('Pengguna', 'Pengaturan');

		$this->data = array(
			'title' => "Pengaturan",
			'breadcrumb' => $this->breadcrumbs->show(),
			'page_title' => $this->page_title->show(),
			'js' => $this->load->get_js_files(),
		);
		$this->template->view('user/account', $this->data);
	}

	/**
	 * Mengecek benarnya password lama
	 *
	 * @return String
	 **/
	public function authpass()
	{
		$password = $this->input->post('old_pass');

        // authentifaction dengan password verify
        if (password_verify($password, $this->session->userdata('user')->password)) 
        {
			$output['valid'] = TRUE;

		} else {
			$output['valid'] = FALSE;
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($output));
	}

	/**
	 * Setting account (Ganti Password)
	 *
	 * @return void
	 **/
	public function account_setting()
	{
		$this->user->update_account();
		redirect('user/account');
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */