<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/26/2019
 * Time: 12:48 PM
 */

class Order_menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function confirm_delete_item_popup($order_id, $order_item_id)
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$data['order_id'] = $order_id;
		$data['order_item_id'] = $order_item_id;
		$this->load->view('order_menu/confirm_delete_item_popup', $data);
	}

	public function get_price()
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		echo $this->order_model->get_current_price();
	}

	public function load_order_menu($order_id = NULL)
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->load_order($order_id);
		$data['order_items'] = $this->order_model->get_order_items();
		$this->load->view('order_menu/navbar', $data);
		$this->load->view('order_menu/order_menu', $data);
		$this->load->view('order_menu/price', $data);
		$this->load->view('order_menu/footer', $data);
	}

	public function delete_order_item()
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->delete_order_item();
	}

	public function load_edit_item_form()
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$data['item'] = $this->order_model->get_order_item();
		$this->load->view('order_menu/edit_item_form', $data);
	}

	public function confirm_edit_item_popup()
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$data['item'] = $this->order_model->get_order_item();
		$this->load->view('order_menu/confirm_edit_item_popup', $data);
	}

	public function edit_item()
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->edit_item();
	}
}
