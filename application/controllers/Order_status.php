<?php

class Order_status extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function forward_order($order_id) {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->set_order_status($order_id, 'kitchen');
	}

	public function give_out_order($order_id) {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->set_order_status($order_id, 'out');
	}

	public function pay_off_order($order_id) {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->set_order_status($order_id, 'paid');
	}

	public function archive_order($order_id) {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->set_order_status($order_id, 'archived');
	}
}
