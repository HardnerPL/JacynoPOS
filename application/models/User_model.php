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
			'user_access' => 0
		);
		$this->db->insert('users', $data);
	}

	private function get_user_hash($username)
	{
		$query = $this->db->query("SELECT user_password FROM users WHERE user_name = '$username'");
		$row = $query->row();
		return $row->user_password;
	}

	private function get_user_access($username)
	{
		$query = $this->db->query("SELECT user_access FROM users WHERE user_name = '$username'");
		$row = $query->row();
		return $row->user_access;
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

	public function log_in()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		if (!empty($username) && !empty($password) && $this->config->item('dev') && $username == $password) {
			$this->session->username = 'dev';
			$this->session->access = 1;
			redirect('index');
		} else if (!empty($username) && !empty($password)) {
			if (password_verify($password, $this->get_user_hash($username))) {
				$this->session->username = $username;
				$this->session->access = $this->get_user_access($username);
				redirect('index');
			}
		}
	}

	public function can_access($access): bool
	{
		if (!empty($this->session->access) && $this->session->access >= $access) {
			return true;
		} else {
			return false;
		}
	}
}
