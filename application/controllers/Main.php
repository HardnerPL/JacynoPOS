<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/9/2019
 * Time: 8:31 PM
 */

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        //$data['items'] = $this->item_model->get_all_items($data['categories']);
        $data['title'] = "POS";
        $this->load->view('templates/header', $data);
        $this->load->view('main', $data);
        $this->load->view('templates/footer', $data);
    }

    public function login() {
        $this->user_model->log_in();
        $data['title'] = "Logowanie | POS";
        $this->load->view('templates/header', $data);
        $this->load->view('login', $data);
        $this->load->view('templates/footer', $data);
    }

    public function register() {
        $this->user_model->register();
        $data['title'] = "Rejestracja | POS";
        $this->load->view('templates/header', $data);
        $this->load->view('register', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajax_categories() {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['categories'] = $this->category_model->get_all_categories();
        $data['title'] = "AJAX | POS";
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/categories', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajax_items() {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['items'] = $this->item_model->get_category_items($this->input->post('category_id'));
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/items', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajax_add_items_prompt() {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['ajax'] = true;
        $data['item_id'] = $this->input->post('item_id');
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/add_items', $data);
        $this->load->view('templates/footer', $data);
    }

    public function ajax_add_items() {
        $item = $this->item_model->get_item($this->input->post('item_id'));
        $this->order_model->add_items($item);
        $this->ajax_get_price();
    }

    public function ajax_get_price() {
        echo $this->order_model->get_current_price();
    }

    public function ajax_delete_current_order() {
        $this->order_model->delete_current_order();
    }

    public function ajax_edit_order() {
        if (!$this->user_model->can_access(1)) {
            redirect('login');
        }
        $data['items'] = $this->session->order_items;
        $data['ajax'] = true;
        $this->load->view('templates/header', $data);
        $this->load->view('ajax/edit_order', $data);
        $this->load->view('templates/footer', $data);
    }
}