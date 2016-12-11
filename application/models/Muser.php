<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {

	public function get_all($limit = 20, $offset = 0, $type = 'result')
	{
		if($this->input->get('q') != '')
			$this->db->like('nama_lengkap', $this->input->get('q'))
					->or_like('email', $this->input->get('q'));

		if($type == 'result')
		{
			return $this->db->get('tb_users', $limit, $offset)->result();
		} else {
			return $this->db->get('tb_users')->num_rows();
		}
	}

	public function get($param = 0)
	{
		$query = $this->db->query("
			SELECT * FROM tb_users WHERE ID_user = ? ", array($param));

		return $query->row();
	}


	/**
	 * Inserting data
	 *
	 * @return String
	 **/
	public function insert()
	{
		$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$user = array(
			'nama_lengkap' => $this->input->post('full_name'),
			'username' => $this->input->post('username'),
			'password' => $password,
			'email' => $this->input->post('email'),
			'level' => $this->input->post('access') 
		);

		$this->db->insert('tb_users', $user);

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' User ditambahkan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Updating data
	 *
	 * @param Integer ID_user
	 * @return String
	 **/
	public function update($param = 0)
	{
		$get = $this->get($param);

		$user = array(
			'nama_lengkap' => (!$this->input->post('full_name')) ? $get->nama_lengkap : $this->input->post('full_name'),
			'email' => (!$this->input->post('email')) ? $get->email : $this->input->post('email'),
			'level' => (!$this->input->post('access')) ? $get->access : $this->input->post('access')  
		);

		$this->db->update('tb_users', $user, array('ID_user' => $param));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Deleting data
	 *
	 * @param Integer ID_user
	 * @return String
	 **/
	public function delete($param  = 0)
	{
		$get = $this->get($param);

		$this->db->delete('tb_users', array('ID_user' => $param));

		$this->template->alert(
			' User terhapus.', 
			array('type' => 'success','icon' => 'check')
		);
	}


	/**
	 * Multiple Update user
	 *
	 * @return string
	 **/
	public function multiple_update()
	{
		if(is_array($this->input->post('users')))
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$get = $this->get($value);

				$user = array(
					'nama_lengkap' => (!$this->input->post('full_name')[$key]) ? $get->nama_lengkap : $this->input->post('full_name')[$key],
					'email' => (!$this->input->post('email')[$key]) ? $get->email : $this->input->post('email')[$key],
					'level' => (!$this->input->post('access')[$key]) ? $get->access : $this->input->post('access')[$key]  
				);

				$this->db->update('tb_users', $user, array('ID_user' => $value));
			}
			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Multiple Delete user
	 *
	 * @return string
	 **/
	public function multiple_delete()
	{
		if(is_array($this->input->post('users')))
		{
			foreach ($this->input->post('users') as $key => $value) 
			{
				$this->db->delete('tb_users', array('ID_user' => $value));
			}
			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}

	/**
	 * Update passowrd and username account
	 *
	 * @param session id
	 * @return String
	 **/
	public function update_account()
	{
		$get = $this->get($this->session->userdata('user')->ID_user);

		$old_pass = password_hash($this->input->post('old_pass'), PASSWORD_DEFAULT);
		$new_pass = password_hash($this->input->post('password'), PASSWORD_DEFAULT);

		$user = array(
			'username' => (!$this->input->post('username')) ? $get->username : $this->input->post('username'),
			'password' => (!$this->input->post('passowrd')) ? $old_pass : $new_pass,
		);

		$this->db->update('tb_users', $user, array('ID_user' => $get->ID_user));

		if($this->db->affected_rows())
		{
			$this->template->alert(
				' Perubahan disimpan.', 
				array('type' => 'success','icon' => 'check')
			);
		} else {
			$this->template->alert(
				' Gagal menyimpan data.', 
				array('type' => 'danger','icon' => 'times')
			);
		}
	}
}

/* End of file Muser.php */
/* Location: ./application/models/Muser.php */