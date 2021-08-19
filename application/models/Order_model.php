<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 9:45 PM
 * @property CI_Config config
 * @property CI_DB_query_builder db
 * @property CI_Session session
 * @property CI_Input input
 */

class Order_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_open_orders()
	{
		return $this->db
			->query("SELECT *, NOT EXISTS(SELECT * FROM order_items oi 
       			LEFT JOIN items i on oi.item_id = i.item_id
       			WHERE oi.order_id = o.order_id AND i.item_type = 'drink' AND oi.item_status = 'confirmed')
       			AS drinks_delivered FROM orders o WHERE NOT order_status = 'closed'")
			->result();
	}

	public function get_order($order_id)
	{
		$query = $this->db->query("SELECT * FROM orders WHERE order_id = $order_id");
		return $query->row();
	}

	public function add_order()
	{
		$owner = $this->session->userdata('username');
		$table = $this->input->post('table');
		$this->db->query("
                  INSERT INTO orders (order_table, order_status, order_owner)
                              VALUES ('$table', 'new', '$owner')
        ");
		$this->session->current_order = $this->db->insert_id();
	}

	public function add_item($item)
	{
		$owner = $this->session->userdata('username');
		$order_id = $this->session->current_order;
		$item_id = $item->item_id;
		$item_count = $this->input->post('item_count');
		$item_to_go = $this->input->post('item_to_go');

		if ('true' == $item_to_go) {
			$to_go_id = $item->item_to_go_id;
		} else {
			$to_go_id = 'null';
		}

		for ($i = $item_count; $i > 0; $i--) {
			$this->db->query("INSERT INTO order_items (order_id, item_id, item_status, to_go_id, order_item_owner)
                              VALUES ('$order_id', '$item_id', 'new', $to_go_id, '$owner')");
		}
		$this->update_order_status($order_id);
	}

	public function get_current_price(): float
	{
		$price = 0.00;
		$query = $this->db->query("SELECT item_price FROM order_items LEFT JOIN items ON order_items.item_id = items.item_id
		WHERE order_id = '{$this->session->current_order}' AND NOT item_status = 'deleted'");
		foreach ($query->result() as $item) {
			$price += $item->item_price;
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

	public function get_current_order_items($position)
	{
		if ($position == 'all') {
			$order_items = $this->db->query("SELECT * FROM order_items 
			LEFT JOIN category_items ON order_items.item_id = category_items.item_id 
			LEFT JOIN category_positions ON category_items.cat_id = category_positions.cat_id
			LEFT JOIN positions ON category_positions.pos_id = positions.position_id 
			WHERE order_id = {$this->session->current_order} AND NOT category_items.cat_id = 0
			AND NOT item_status = 'deleted'")->result();
		} else {
			$order_items = $this->db->query("SELECT * FROM order_items 
			LEFT JOIN category_items ON order_items.item_id = category_items.item_id 
			LEFT JOIN category_positions ON category_items.cat_id = category_positions.cat_id
			LEFT JOIN positions ON category_positions.pos_id = positions.position_id 
			WHERE order_id = {$this->session->current_order} AND position_name = '$position'
			AND NOT item_status = 'deleted'")->result();
		}
		foreach ($order_items as $item) {
			$query = $this->db->query("SELECT item_price, item_name FROM items WHERE item_id = $item->item_id");
			$item->item_price = $query->row()->item_price;
			$item->price = $item->item_price;
			$item->item_name = $query->row()->item_name;
		}
		return $order_items;
	}

	public function get_active_order_items($position)
	{
		$query = $this->db->query("SELECT *, ois.created_at AS kitchen_time FROM order_items
    	LEFT JOIN items ON order_items.item_id = items.item_id
		LEFT JOIN category_items ON order_items.item_id = category_items.item_id 
		LEFT JOIN category_positions ON category_items.cat_id = category_positions.cat_id
		LEFT JOIN positions ON category_positions.pos_id = positions.position_id
		LEFT JOIN orders ON order_items.order_id = orders.order_id
		LEFT JOIN categories ON category_items.cat_id = categories.category_id
		LEFT JOIN order_item_statuses ois on order_items.order_item_id = ois.order_item_id
		WHERE position_name = '$position' AND (item_status = 'confirmed' OR item_status = 'ready') AND ois.new_status = 'confirmed'
		ORDER BY ois.created_at, order_items.order_id,
		    CASE items.item_type
			WHEN 'zupa' THEN 1
			WHEN 'obiad' THEN 2
			ELSE 3 END
		");
		$order_items = $query->result();
		$query = $this->db->query("SELECT * FROM orders WHERE order_status = 'confirmed'");
		$orders = $query->result();
		$query = $this->db->query("SELECT * FROM items WHERE item_id IN (SELECT item_id FROM order_items 
									WHERE item_status = 'confirmed' OR item_status = 'ready')");
		$items = [];
		foreach ($query->result() as $item) {
			$items[$item->item_id] = $item;
		}
		foreach ($order_items as $item) {
			$item->item_name = $items[$item->item_id]->item_name;
			$item->item_image = $items[$item->item_id]->item_img;

			if ((time() - strtotime($item->item_datetime)) / 60 > $this->config->item('late_soup_time') && 'Zupy' == $item->category_name) {
				$item->late = true;
			}
		}
		return $order_items;
	}

	public function get_order_item($order_item_id)
	{
		$order_id = $this->session->current_order;
		$order_item = $this->db->query("SELECT * FROM order_items LEFT JOIN items
		ON order_items.item_id = items.item_id WHERE order_item_id = $order_item_id")->row();
		return $order_item;
	}

	public function delete_order_item()
	{
		$order_item_id = $this->input->post('order_item_id');
		$this->set_order_item_status($order_item_id, 'deleted');
	}

	public function edit_item($order_item_id)
	{
		$item_comment = urldecode($this->input->post('item_comment'));
		$item = $this->get_order_item($order_item_id);

		if ('true' == $this->input->post('item_to_go')) {
			$to_go_id = $item->item_to_go_id;
		} else {
			$to_go_id = 'null';
		}

		$this->db->query("UPDATE order_items SET item_comment = '$item_comment', to_go_id = $to_go_id WHERE order_item_id = $order_item_id");
	}

	public function set_order_status($order_id, $status)
	{
		$this->db->query("UPDATE orders SET order_status = '$status' WHERE order_id = $order_id");
	}

	public function confirm_order($order_id)
	{
		$owner = $this->session->userdata('username');
		$time = date("H:i");
		$this->db->query("INSERT INTO order_item_statuses (order_item_id, old_status, new_status, status_owner)
			SELECT order_item_id, 'new', 'confirmed', '$owner' FROM order_items 
			WHERE order_id = $order_id AND item_status = 'new'");
		$this->db->query("UPDATE order_items SET item_status = 'confirmed' 
			WHERE order_id = $order_id AND item_status = 'new'");
		$this->update_order_status($order_id);
	}

	public function close_order($order_id)
	{
		$owner = $this->session->userdata('username');
		$this->set_order_status($order_id, 'closed');
		$this->db->query("INSERT INTO order_item_statuses (order_item_id, old_status, new_status, status_owner) 
 			SELECT order_item_id, item_status, 'deleted', '$owner' FROM order_items WHERE order_id = $order_id AND item_status = 'new'");
		$this->db->query("UPDATE order_items SET item_status = 'deleted' WHERE order_id = $order_id AND item_status = 'new'");
		$this->db->query("INSERT INTO order_item_statuses (order_item_id, old_status, new_status, status_owner) 
 			SELECT order_item_id, item_status, 'closed', '$owner' FROM order_items WHERE order_id = $order_id AND NOT item_status = 'deleted'");
		$this->db->query("UPDATE order_items SET item_status = 'closed' WHERE order_id = $order_id AND NOT item_status = 'deleted'");
	}

	public function set_order_item_status($order_item_id, $status)
	{
		$owner = $this->session->userdata('username');
		$item = $this->get_order_item($order_item_id);
		$this->db->query("INSERT INTO order_item_statuses (order_item_id, old_status, new_status, status_owner)
			VALUES ($order_item_id, '$item->item_status', '$status', '$owner')");
		$this->db->query("UPDATE order_items SET item_status = '$status' WHERE order_item_id = $order_item_id");
		$this->update_order_status($item->order_id);
	}

	public function get_order_checkout($order_id)
	{
		$items = $this->db->query("SELECT i.*, o.*, p.*, c.code_price, code_price FROM order_items AS o
		LEFT JOIN items AS i ON o.item_id = i.item_id
		LEFT JOIN codes AS c ON c.code_id = i.code_id
		LEFT JOIN packagings as p ON o.to_go_id = p.packaging_id
		WHERE order_id = $order_id AND NOT o.item_status = 'deleted' ORDER BY i.code_id
		")->result();
		$codes = [];
		foreach ($items as $item) {
			if ($item->to_go_id && $item->packaging_price > 0) {
				if ($item->packaging_code) {
					// TODO: Implement support for packagings with codes
				} else {
					$item->item_name .= ' (Wynos)';
					$item->item_price += $item->packaging_price;
				}
			}

			$key = $item->item_id . $item->item_price;

			if (!isset($codes[$key])) {
				$codes[$key] = new stdClass();
				$codes[$key]->code = $item->code_id;
				$codes[$key]->count = 1;
				$codes[$key]->name = $item->item_name;
				$codes[$key]->price = $item->item_price;
				$codes[$key]->dynamic_price = $item->code_price;
			} else {
				$codes[$key]->count++;
			}
		}

		return $codes;
	}

	public function edit_order($order_id)
	{
		$order_comment = $this->input->post('order_comment');
		$order_table = $this->input->post('order_table');
		$this->db->query("UPDATE orders SET order_comment = '$order_comment', order_table = '$order_table' 
		WHERE order_id = $order_id");
	}

	public function deliver_utensils($order_id)
	{
		$this->db->query("UPDATE orders SET order_utensils = 1 WHERE order_id = $order_id");
	}

	private function update_order_status($order_id)
	{
		$items = $this->get_order_items($order_id);
		$order = $this->get_order($order_id);

		$statuses = [];
		foreach ($items as $item) {
			$statuses[$item->item_status] = true;
		}

		if (isset($statuses['ready'])) {
			$status = 'ready';
		} else if (isset($statuses['new'])) {
			$status = 'new';
		} else if (isset($statuses['confirmed'])) {
			$status = 'confirmed';
		} else if (isset($statuses['delivered'])) {
			$status = 'delivered';
		} else {
			$status = 'new';
		}

		if ($order->order_status != $status) {
			$this->db->query("UPDATE orders SET order_status = '$status' WHERE order_id = $order_id");
		}
	}

	private function get_order_items($order_id)
	{
		return $this->db
			->query("SELECT * FROM order_items WHERE order_id = $order_id")
			->result();
	}

    public function checkout_order($order_id)
    {
    	die($this->db->update('orders', ['order_paid' => true], 'order_id = ' . $order_id));
    }
}
