<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 9:45 PM
 */

class Order_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_items($item)
    {
        if (!isset($this->session->current_order)) {
            //$this->db->query("INSERT INTO")
        }
        $order_item['id'] = $item->item_id;
        $order_item['name'] = $item->item_name;
        $order_item['price'] = $item->item_price;
        $order_item['count'] = $this->input->post('item_count');
        $order_item['comment'] = $this->input->post('item_comment');
        if (!isset($this->session->order_items)) {
            $this->session->order_items = array();
        }
        $order_items = $this->session->order_items;
        array_push($order_items, $order_item);
        $this->session->order_items = $order_items;
    }

    public function get_current_price(): float
    {
        $price = 0.00;
        if (isset($this->session->order_items)) {
            foreach ($this->session->order_items as $item) {
                $price += $item['price'] * $item['count'];
            }
        }
        return $price;
    }

    public function delete_current_order() {
        $this->session->order_items = array();
    }
}