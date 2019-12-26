<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/9/2019
 * Time: 8:31 PM
 */

class Main extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		//$data['items'] = $this->item_model->get_all_items($data['categories']);
		$data['title'] = "POS";
		$this->load->view('templates/header', $data);
		$this->load->view('main', $data);
		$this->load->view('templates/footer', $data);
	}

	public function login()
	{
		$this->user_model->log_in();
		$data['title'] = "Logowanie | POS";
		$this->load->view('templates/header', $data);
		$this->load->view('login', $data);
		$this->load->view('templates/footer', $data);
	}

	public function register()
	{
		$this->user_model->register();
		$data['title'] = "Rejestracja | POS";
		$this->load->view('templates/header', $data);
		$this->load->view('register', $data);
		$this->load->view('templates/footer', $data);
	}
}
