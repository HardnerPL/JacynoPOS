<?php

/**
 * @property User_model user_model
 * @property CI_Loader load
 * @property Item_model item_model
 * @property Category_model category_model
 * @property CI_Input input
 * @property Order_model order_model
 */
class Item_menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->user_model->can_access('waiter')) {
			redirect('login');
		}
	}

	public function load_item_menu()
	{
		$data['categories'] = $this->category_model->get_all_categories();
		$this->load->view('waiter/item_menu/navbar', $data);
		$this->load->view('waiter/item_menu/category_list', $data);
	}

	public function load_category_list()
	{
		$data['categories'] = $this->category_model->get_all_categories();
		$this->load->view('waiter/item_menu/category_list', $data);
	}

	public function load_item_list()
	{
		$cat_id = $this->input->post('category_id');
		$data['categories'] = $this->item_model->get_category_categories($cat_id);
		$data['items'] = $this->item_model->get_category_items($cat_id);
		$this->load->view('waiter/item_menu/item_list', $data);
	}

	public function load_item_form()
	{
		$data['item'] = $this->item_model->get_item($this->input->post('item_id'));
		$this->load->view('waiter/item_menu/add_item_form', $data);
	}

	public function add_item()
	{
		$item = $this->item_model->get_item($this->input->post('item_id'));
		$this->order_model->add_item($item);
	}
}
