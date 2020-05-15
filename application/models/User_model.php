<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/9/2019
 * Time: 9:29 PM
 */

class User_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	private function username_available(string $user_name): bool
	{
		$query = $this->db->query("SELECT * FROM users WHERE user_name = '$user_name'");
		if ($query->num_rows() == 0) {
			return true;
		}
		return false;
	}

	private function add_user(string $user_name, string $user_password)
	{
		$data = array(
			'user_name' => $user_name,
			'user_password' => password_hash($user_password, PASSWORD_DEFAULT),
			'user_role' => ''
		);
		$this->db->insert('users', $data);
	}

	private function get_user_hash($username)
	{
		$query = $this->db->query("SELECT user_password FROM users WHERE user_name = '$username'");
		if ($query->num_rows() > 0) {
			return $query->row()->user_password;
		} else return "USER NOT FOUND";
	}

	private function get_user_role($username)
	{
		$query = $this->db->query("SELECT user_role FROM users WHERE user_name = '$username'");
		$row = $query->row();
		return $row->user_role;
	}

	public function register(): string
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$repeat_password = $this->input->post('repeat_password');
		if (!empty($username) && !empty($password) && $password == $repeat_password) {
			if ($this->username_available($username)) {
				$this->add_user($username, $password);
			}
			return "USERNAME UNAVAILABLE";
		}
		return "EMPTY INPUT";
	}

	public function user_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (!empty($username) && !empty($password) && $this->config->item('dev') && $username == $password) {
			$this->session->username = 'dev';
			$this->session->role = 'admin';
			redirect('index');
		} else if (!empty($username) && !empty($password)) {
			if (password_verify($password, $this->get_user_hash($username))) {
				$this->session->username = $username;
				$this->session->role = $this->get_user_role($username);
				redirect('index');
			}
		}
	}

	public function can_access($role): bool
	{
		if (!empty($this->session->role) && ($this->session->role == $role || $this->session->role == 'admin')) {
			return true;
		} else {
			return false;
		}
	}
}
