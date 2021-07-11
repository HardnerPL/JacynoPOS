<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/26/2019
 * Time: 12:48 PM
 * @property Order_model order_model
 * @property User_model user_model
 * @property CI_Loader load
 * @property CI_Session session
 */

class Order_menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->user_model->can_access('waiter')) {
			redirect('login');
		}
	}

	public function confirm_delete_item_popup($order_id, $order_item_id)
	{
		$data['order_id'] = $order_id;
		$data['order_item_id'] = $order_item_id;
		$this->load->view('waiter/order_menu/confirm_delete_item_popup', $data);
	}

	public function get_price()
	{
		echo $this->order_model->get_current_price();
	}

	public function load_order_menu($order_id = NULL)
	{
		if (!isset($order_id)) {
			$order_id = $this->session->current_order;
		}

		$this->order_model->load_order($order_id);
		$data['order_id'] = $order_id;
		$data['order_items'] = $this->order_model->get_order_items('all');
		$this->load->view('waiter/order_menu/navbar', $data);
		$this->load->view('waiter/order_menu/order_menu', $data);
		$this->load->view('waiter/order_menu/price', $data);
		$this->load->view('waiter/order_menu/footer', $data);
	}

	public function update_item_list()
	{
		$data['order_items'] = $this->order_model->get_order_items('all');
		$this->load->view('waiter/order_menu/order_menu', $data);
	}

	public function delete_order_item()
	{
		$this->order_model->delete_order_item();
	}

	public function load_edit_item_form()
	{
		$data['item'] = $this->order_model->get_order_item();
		$this->load->view('waiter/order_menu/edit_item_form', $data);
	}

	public function confirm_edit_item_popup($order_item_id)
	{
		$data['item'] = $this->order_model->get_order_item($order_item_id);
		$this->load->view('waiter/order_menu/confirm_edit_item_popup', $data);
	}

	public function confirm_order_popup($order_id)
	{
		$data['order_id'] = $order_id;
		$this->load->view('waiter/order_menu/confirm_order_popup', $data);
	}

	public function edit_item_popup($order_item_id)
	{
		$data['order_item_id'] = $order_item_id;
		$data['item'] = $this->order_model->get_order_item($order_item_id);
		$this->load->view('waiter/order_menu/edit_item_popup', $data);
	}

	public function confirm_item_delivery_popup($order_item_id)
	{
		$data['order_item_id'] = $order_item_id;
		$this->load->view('waiter/order_menu/confirm_item_delivery_popup', $data);
	}

	public function edit_item($order_item_id)
	{
		$this->order_model->edit_item($order_item_id);
	}

	public function confirm_order($order_id)
	{
		$this->order_model->confirm_order($order_id);
	}

	public function deliver_item($order_item_id)
	{
		$this->order_model->set_order_item_status($order_item_id, 'delivered');
	}
}
