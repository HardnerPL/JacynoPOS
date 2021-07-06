<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/9/2019
 * Time: 8:31 PM
 * @property CI_Loader load
 * @property CI_Session session
 * @property User_model user_model
 */

class Main extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if (!$this->session->role) {
			redirect('login');
		}
		$data['title'] = "Home | POS";

		$this->load->view('templates/header', $data);
		$this->load->view('home', $data);
		$this->load->view('templates/footer', $data);
	}

	public function admin()
	{
		redirect('waiter');
	}

	public function waiter()
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('login');
		}

		$data['title'] = "POS";
		$data['scripts'] = "waiter/main_menu, waiter/item_menu, waiter/order_menu";

		$this->load->view('templates/header', $data);
		$this->load->view('waiter/main', $data);
		$this->load->view('templates/footer', $data);
	}

	public function pizza()
	{
		redirect('kitchen');
	}

	public function kitchen()
	{
		if (!$this->user_model->can_access('kitchen')) {
			redirect('login');
		}

		$data['title'] = "POS";
		$data['scripts'] = "kitchen/main_menu";

		$this->load->view('templates/header', $data);
		$this->load->view('kitchen/main', $data);
		$this->load->view('templates/footer', $data);
	}

	public function login()
	{
		$this->user_model->login();
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

	public function logout()
	{
		$this->user_model->logout();
	}
}
