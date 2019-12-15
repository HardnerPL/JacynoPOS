<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/26/2019
 * Time: 12:48 PM
 */

class Ajax extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function order_menu()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }

        $data['orders'] = $this->order_model->get_orders();
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/order_menu', $data);
        $this->load->view('templates/footer', $data);

    }

    public function item_menu()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/item_menu', $data);
        $this->load->view('templates/footer', $data);
    }

    public function item_menu_navbar()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/item_menu/navbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function item_menu_categories()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['categories'] = $this->category_model->get_all_categories();
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/item_menu/categories', $data);
        $this->load->view('templates/footer', $data);
    }

    public function item_menu_info()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['current_order'] = $this->session->current_order;
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/item_menu/info', $data);
        $this->load->view('templates/footer', $data);
    }

    public function items()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['items'] = $this->item_model->get_category_items($this->input->post('category_id'));
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/items', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add_items_prompt()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['ajax'] = true;
        $data['item_id'] = $this->input->post('item_id');
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/add_items', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add_items()
    {
        $item = $this->item_model->get_item($this->input->post('item_id'));
        $this->order_model->add_items($item);
        $this->get_price();
    }

    public function get_price()
    {
        echo $this->order_model->get_current_price();
    }

    public function add_order()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $this->order_model->add_order();
    }

    public function delete_order()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $this->order_model->delete_order();
    }

    public function open_order()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $this->order_model->open_order();
    }

    public function edit_order()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['order_items'] = $this->order_model->get_order_items();
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/edit_order', $data);
        $this->load->view('templates/footer', $data);
    }

	public function delete_order_item()
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->delete_order_item();
	}
}
