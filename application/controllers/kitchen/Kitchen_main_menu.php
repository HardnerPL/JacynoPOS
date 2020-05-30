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

	public function item_ready_popup($order_item_id) {
	if (!$this->user_model->can_access('kitchen')) {
		redirect('index');
	}
	$data['order_item_id'] = $order_item_id;
	$this->load->view('kitchen/main_menu/item_ready_popup', $data);
}

	public function item_ready($order_item_id) {
		if (!$this->user_model->can_access('kitchen')) {
			redirect('index');
		}
		$this->order_model->set_order_item_status($order_item_id, 'ready');
	}

	public function item_delivered_popup($order_item_id) {
		if (!$this->user_model->can_access('kitchen')) {
			redirect('index');
		}
		$data['order_item_id'] = $order_item_id;
		$this->load->view('kitchen/main_menu/item_delivered_popup', $data);
	}

	public function item_delivered($order_item_id) {
		if (!$this->user_model->can_access('kitchen')) {
			redirect('index');
		}
		$this->order_model->set_order_item_status($order_item_id, 'delivered');
	}
}
