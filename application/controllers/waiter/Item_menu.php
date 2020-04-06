<?php

class Item_menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function load_item_menu()
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('login');
		}
		$data['categories'] = $this->category_model->get_all_categories();
		$this->load->view('waiter/item_menu/navbar', $data);
		$this->load->view('waiter/item_menu/category_list', $data);
	}

	public function load_category_list()
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('login');
		}
		$data['categories'] = $this->category_model->get_all_categories();
		$this->load->view('waiter/item_menu/category_list', $data);
	}

	public function load_item_list()
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('login');
		}
		$data['items'] = $this->item_model->get_category_items($this->input->post('category_id'));
		$this->load->view('waiter/item_menu/item_list', $data);
	}

	public function load_item_form()
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('login');
		}
		$data['item'] = $this->item_model->get_item($this->input->post('item_id'));
		$this->load->view('waiter/item_menu/add_item_form', $data);
	}

	public function add_item()
	{
		if (!$this->user_model->can_access('waiter')) {
			redirect('login');
		}
		$item = $this->item_model->get_item($this->input->post('item_id'));
		$this->order_model->add_item($item);
	}
}
