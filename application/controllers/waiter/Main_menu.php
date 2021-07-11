<?php

/**
 * @property Order_model order_model
 * @property User_model user_model
 * @property CI_Loader load
 */
class Main_menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->user_model->can_access('waiter')) {
			redirect('login');
		}
	}

	public function load_main_menu()
	{
		$data['orders'] = $this->order_model->get_orders();
		$this->load->view('waiter/main_menu/top_menu');
		$this->load->view('waiter/main_menu/order_list_header');
		$this->load->view('waiter/main_menu/order_list', $data);
		$this->load->view('waiter/main_menu/bottom_menu');
	}

	public function load_order_list_row($order_id)
	{
		$data['order'] = $this->order_model->get_order($order_id);
		$this->load->view('waiter/main_menu/order_list_row', $data);
	}

	public function add_order()
	{
		$this->order_model->add_order();
	}

	public function confirm_close_order_popup($order_id)
	{
		$data['order_id'] = $order_id;
		$this->load->view('waiter/main_menu/confirm_close_order_popup', $data);
	}

	public function checkout_order_popup($order_id)
	{
		$data['codes'] = $this->order_model->get_order_checkout($order_id);
		$data['order_id'] = $order_id;
		$this->load->view('waiter/main_menu/checkout_order_popup', $data);
	}

	public function close_order($order_id)
	{
		$this->order_model->close_order($order_id);
	}

	public function edit_order_popup($order_id)
	{
		$data['order'] = $this->order_model->get_order($order_id);
		$data['order_id'] = $order_id;
		$this->load->view('waiter/main_menu/edit_order_popup', $data);
	}

	public function confirm_edit_order_popup($order_id)
	{
		$data['order_id'] = $order_id;
		$this->load->view('waiter/main_menu/confirm_edit_order_popup', $data);
	}

	public function edit_order($order_id)
	{
		$this->order_model->edit_order($order_id);
	}

	public function confirm_utensils_delivery_popup($order_id)
	{
		$data['message'] = 'Czy potwierdzasz wydanie sztućców?';
		$data['yes'] = "deliver_utensils($order_id)";
		$this->load->view('waiter/popup', $data);
	}

	public function deliver_utensils($order_id)
	{
		$this->order_model->deliver_utensils($order_id);
	}
}
