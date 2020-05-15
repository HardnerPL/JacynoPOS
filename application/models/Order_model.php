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

	public function get_orders()
	{
		$query = $this->db->query("SELECT * FROM orders WHERE NOT order_status = 'closed'");
		return $query->result();
	}

	public function get_order($order_id) {
		$query = $this->db->query("SELECT * FROM orders WHERE order_id = $order_id");
		return $query->row();
	}

	public function add_order()
	{
		$table = $this->input->post('table');
		$time = date('H:i');
		$this->db->query("
                  INSERT INTO orders (order_table, order_time, order_status)
                              VALUES ('$table', '$time', 'draft')
        ");
		$this->session->current_order = $this->db->insert_id();
	}

	public function add_item($item)
	{
		$order_id = $this->session->current_order;
		$item_id = $item->item_id;
		$item_count = $this->input->post('item_count');
		for ($i = $item_count; $i > 0; $i--) {
			$this->db->query("INSERT INTO order_items (order_id, item_id, item_status)
                              VALUES ('$order_id', '$item_id', 'new')
        ");
		}
	}

	public function get_current_price(): float
	{
		$price = 0.00;
		$query = $this->db->query("SELECT * FROM order_items WHERE order_id = '{$this->session->current_order}'");
		foreach ($query->result() as $item) {
			$query = $this->db->query("SELECT item_price FROM items WHERE item_id = $item->item_id");
			$price += $query->row()->item_price;
		}
		return $price;
	}

	public function delete_order()
	{
		$order_id = $this->input->post('order_id');
		$this->db->query("DELETE FROM orders WHERE order_id = $order_id");
		$this->db->query("DELETE FROM order_items WHERE order_id = $order_id");
		$this->session->unset_userdata('current_order');
	}

	public function load_order($order_id)
	{
		if (empty($order_id)) {
			$order_id = $this->input->post('order_id');
		}
		if (!empty($order_id)) {
			$this->session->current_order = $order_id;
		}
	}

	public function get_order_items()
	{
		$order_items = $this->db->query("SELECT * FROM order_items WHERE order_id = {$this->session->current_order}")->result();
		foreach ($order_items as $item) {
			$query = $this->db->query("SELECT item_price, item_name FROM items WHERE item_id = $item->item_id");
			$item->item_price = $query->row()->item_price;
			$item->price = $item->item_price;
			$item->item_name = $query->row()->item_name;
		}
		return $order_items;
	}

	public function get_active_order_items() {
		$query = $this->db->query("SELECT * FROM order_items WHERE item_status = 'new'");
		$order_items = $query->result();
		return $order_items;
	}

	public function get_order_item()
	{
		$order_id = $this->session->current_order;
		$item_id = $this->input->post('item_id');
		$order_item = $this->db->query("SELECT * FROM order_items WHERE order_id = $order_id AND item_id = $item_id")->row();
		$query = $this->db->query("SELECT item_price, item_name FROM items WHERE item_id = $item_id");
		$order_item->item_price = $query->row()->item_price;
		$order_item->item_name = $query->row()->item_name;
		return $order_item;
	}

	public function delete_order_item()
	{
		$order_item_id = $this->input->post('order_item_id');
		$this->db->query("DELETE FROM order_items WHERE order_item_id = $order_item_id");
	}

	public function edit_item()
	{
		$order_id = $this->session->current_order;
		$item_id = $this->input->post('item_id');
		$item_count = $this->input->post('item_count');
		$comment = $this->input->post('item_comment');
		$this->db->query("UPDATE order_items SET item_count = $item_count, comment = '$comment' 
WHERE order_id = $order_id AND item_id = $item_id");
	}

	public function set_order_status($order_id, $status)
	{
		$this->db->query("UPDATE orders SET order_status = '$status' WHERE order_id = $order_id");
	}

	public function confirm_order($order_id) {
		$this->set_order_status($order_id, "confirmed");
	}
}
