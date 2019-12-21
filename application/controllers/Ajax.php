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

    public function confirm_delete_order($order_id) {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$data['order_id'] = $order_id;
		$data['ajax'] = true;
		$this->load->view('templates/header', $data);
		$this->load->view('ajax/popup/confirm_delete_order', $data);
		$this->load->view('templates/footer', $data);
	}

	public function confirm_delete_order_item($order_id, $order_item_id) {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$data['order_id'] = $order_id;
		$data['order_item_id'] = $order_item_id;
		$data['ajax'] = true;
		$this->load->view('templates/header', $data);
		$this->load->view('ajax/popup/confirm_delete_order_item', $data);
		$this->load->view('templates/footer', $data);
	}

    public function main_menu()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }

        $data['orders'] = $this->order_model->get_orders();
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/main_menu', $data);
        $this->load->view('templates/footer', $data);

    }

    public function order_menu()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['ajax'] = true;
		$data['categories'] = $this->category_model->get_all_categories();
		$data['current_order'] = $this->session->current_order;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/order_menu', $data);
        $this->load->view('templates/footer', $data);
    }

    public function order_menu_navbar()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/order_menu/navbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function order_menu_category_list()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['categories'] = $this->category_model->get_all_categories();
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/category_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function order_menu_info()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['current_order'] = $this->session->current_order;
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/order_menu/info', $data);
        $this->load->view('templates/footer', $data);
    }

    public function load_item_list()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['items'] = $this->item_model->get_category_items($this->input->post('category_id'));
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/item_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add_item_prompt()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['ajax'] = true;
        $data['item_id'] = $this->input->post('item_id');
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/add_item', $data);
        $this->load->view('templates/footer', $data);
    }

    public function add_item()
    {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
        $item = $this->item_model->get_item($this->input->post('item_id'));
        $this->order_model->add_item($item);
    }

    public function get_price()
    {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
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

    public function load_order()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $this->order_model->load_order();
    }

    public function edit_order_menu()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['order_items'] = $this->order_model->get_order_items();
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/edit_order_menu', $data);
        $this->load->view('templates/footer', $data);
    }

	public function delete_order_item()
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->delete_order_item();
	}

	public function edit_order_item()
	{
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$data['order_item'] = $this->order_model->get_order_item();
		$data['ajax'] = true;
		$this->load->view('templates/header', $data);
		$this->load->view('ajax/edit_order_item', $data);
		$this->load->view('templates/footer', $data);
	}

	public function confirm_edit_order_item() {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$data['item'] = $this->order_model->get_order_item();
		$data['ajax'] = true;
		$this->load->view('templates/header', $data);
		$this->load->view('ajax/popup/confirm_edit_order_item', $data);
		$this->load->view('templates/footer', $data);
	}

	public function edit_item() {
		if (!$this->user_model->can_access(1)) {
			redirect('login');
		}
		$this->order_model->edit_item();
	}
}
