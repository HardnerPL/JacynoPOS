<?php

class Kitchen_main_menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function load_main_menu()
	{
		if (!$this->user_model->can_access('kitchen')) {
			redirect('index');
		}

		$data['order_items'] = $this->order_model->get_active_order_items();

		$this->load->view('kitchen/main_menu/top_menu');
		$this->load->view('kitchen/main_menu/order_list', $data);
		$this->load->view('kitchen/main_menu/right_menu');
	}

	public function load_order_list_row($row_id)
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$data['order'] = $this->order_model->get_order($row_id);
		$this->load->view('waiter/main_menu/order_list_row', $data);
	}
}
