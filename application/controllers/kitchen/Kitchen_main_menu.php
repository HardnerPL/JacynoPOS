<?php

/**
 * @property Order_model order_model
 * @property User_model user_model
 * @property CI_Loader load
 */
class Kitchen_main_menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->user_model->can_access('kitchen')) {
			redirect('login');
		}
	}

	public function load_main_menu()
	{
		$order_items = $this->order_model->get_active_order_items('kitchen');
		$data['orders'] = $this->order_model->group_items_by_order($order_items);

		$this->load->view('kitchen/main_menu/top_menu');
		$this->load->view('kitchen/main_menu/order_list', $data);
		$this->load->view('kitchen/main_menu/right_menu');
	}

	public function order_list()
	{
		$order_items = $this->order_model->get_active_order_items('kitchen');
		$data['orders'] = $this->order_model->group_items_by_order($order_items);

		$this->load->view('kitchen/main_menu/order_list', $data);
	}

	public function item_ready_popup($order_item_id)
	{
		$data['order_item_id'] = $order_item_id;
		$this->load->view('kitchen/main_menu/item_ready_popup', $data);
	}

	public function item_ready($order_item_id)
	{
		$this->order_model->set_order_item_status($order_item_id, 'ready');
	}

	public function item_delivered_popup($order_item_id)
	{
		$data['order_item_id'] = $order_item_id;
		$this->load->view('kitchen/main_menu/item_delivered_popup', $data);
	}

	public function item_delivered($order_item_id)
	{
		$this->order_model->set_order_item_status($order_item_id, 'delivered');
	}
}
