<?php

class Main_menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function load_main_menu()
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$data['orders'] = $this->order_model->get_orders();
		$this->load->view('waiter/main_menu/top_menu');
		$this->load->view('waiter/main_menu/order_list_header');
		$this->load->view('waiter/main_menu/order_list', $data);
		$this->load->view('waiter/main_menu/bottom_menu');
	}

	public function load_order_list_row($order_id)
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$data['order'] = $this->order_model->get_order($order_id);
		$this->load->view('waiter/main_menu/order_list_row', $data);
	}

	public function add_order()
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$this->order_model->add_order();
	}

	public function confirm_close_order_popup($order_id)
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$data['order_id'] = $order_id;
		$this->load->view('waiter/main_menu/confirm_close_order_popup', $data);
	}

	public function checkout_order_popup($order_id)
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$data['codes'] = $this->order_model->get_order_checkout($order_id);
		$data['order_id'] = $order_id;
		$this->load->view('waiter/main_menu/checkout_order_popup', $data);
	}

	public function close_order($order_id)
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$this->order_model->close_order($order_id);
	}

	public function edit_order_popup($order_id)
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$data['order'] = $this->order_model->get_order($order_id);
		$data['order_id'] = $order_id;
		$this->load->view('waiter/main_menu/edit_order_popup', $data);
	}

	public function confirm_edit_order_popup($order_id)
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$data['order_id'] = $order_id;
		$this->load->view('waiter/main_menu/confirm_edit_order_popup', $data);
	}

	public function edit_order($order_id)
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('index');
		}
		$this->order_model->edit_order($order_id);
	}
}
