<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/9/2019
 * Time: 8:31 PM
 */

class Main extends CI_Controller
{
    
    /**
     * @var User_model
     */
    public $user_model;

    public function __construct()
    {
        parent::__construct();
    }

	public function index()
	{
		$data['title'] = "POS";
		$this->load->view('templates/header', $data);
		if ($this->user_model->can_access('admin')) {
			$this->load->view('waiter/main', $data);
		} else if ($this->user_model->can_access('waiter')) {
			$this->load->view('waiter/main', $data);
		} else if ($this->user_model->can_access('kitchen')) {
			$this->load->view('kitchen/main', $data);
		} else {
			redirect('login');
		}
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
