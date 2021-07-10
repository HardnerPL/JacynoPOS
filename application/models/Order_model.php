<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 9:45 PM
 * @property CI_Config config
 * @property CI_DB_query_builder db
 * @property CI_Session session
 */

class Order_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_orders()
	{
		$orders = $this->db
			->query("
				SELECT orders.order_id, order_table, order_comment, order_time, item_status
				FROM orders
				LEFT JOIN order_items ON order_items.order_id = orders.order_id
				WHERE NOT order_status = 'closed'
			")
			->result();
		$resultOrders = [];
		$i = 0;
		$len = count($orders);
		foreach ($orders as $order) {
			if (!isset($resultOrders[$order->order_id])) {
				$resultOrders[$order->order_id] = $order;
				$resultOrders[$order->order_id]->count = 0;
			}
			if (!isset($orders_statuses)) {
				$orders_statuses = array();
			}
			if (!isset($orders_statuses[$order->order_id])) {
				$orders_statuses[$order->order_id] = array();
			}
			if (!isset($orders_statuses[$order->order_id][$order->item_status])) {
				$orders_statuses[$order->order_id][$order->item_status] = 1;
				$orders_statuses[$order->order_id]['order_id'] = $order->order_id;
			} else {
				$orders_statuses[$order->order_id][$order->item_status]++;
			}
			$resultOrders[$order->order_id]->count += 1;
			$i++;
		}
		if (isset($orders_statuses)) {
			foreach ($orders_statuses as $order_statuses) {
				if (isset($order_statuses['ready'])) {
					$resultOrders[$order_statuses['order_id']]->order_status = 'ready';
				} else if (isset($order_statuses['new'])) {
					$resultOrders[$order_statuses['order_id']]->order_status = 'new';
				} else if (isset($order_statuses['delivered']) &&
					$order_statuses['delivered'] == $resultOrders[$order_statuses['order_id']]->count) {
					$resultOrders[$order_statuses['order_id']]->order_status = 'delivered';
				} else {
					$resultOrders[$order_statuses['order_id']]->order_status = 'confirmed';
				}
			}
		}
		return $resultOrders;
	}

	public function get_order($order_id)
	{
		$query = $this->db->query("SELECT * FROM orders WHERE order_id = $order_id");
		return $query->row();
	}

	public function add_order()
	{
		$table = $this->input->post('table');
		$time = date('H:i');
		$this->db->query("
                  INSERT INTO orders (order_table, order_time, order_status)
                              VALUES ('$table', '$time', 'new')
        ");
		$this->session->current_order = $this->db->insert_id();
	}

	public function add_item($item)
	{
		$order_id = $this->session->current_order;
		$item_id = $item->item_id;
		$item_count = $this->input->post('item_count');
		$item_to_go = $this->input->post('item_to_go');
		$item_to_go_id = $item->item_to_go_id;
		for ($i = $item_count; $i > 0; $i--) {
			if ($item_to_go == 'true') {
				$this->db->query("INSERT INTO order_items (order_id, item_id, item_status)
                              VALUES ('$order_id', '$item_to_go_id', 'new')");
				$to_go_id = $this->db->insert_id();
				$this->db->query("INSERT INTO order_items (order_id, item_id, item_status, to_go_id)
                              VALUES ('$order_id', '$item_id', 'new', $to_go_id)
        ");
			} else {
				$this->db->query("INSERT INTO order_items (order_id, item_id, item_status)
                              VALUES ('$order_id', '$item_id', 'new')
        ");
			}
		}
	}

	public function get_current_price(): float
	{
		$price = 0.00;
		$query = $this->db->query("SELECT item_price FROM order_items LEFT JOIN items ON order_items.item_id = items.item_id
		WHERE order_id = '{$this->session->current_order}'");
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

	public function get_order_items($position)
	{
		if ($position == 'all') {
			$order_items = $this->db->query("SELECT * FROM order_items 
			LEFT JOIN category_items ON order_items.item_id = category_items.item_id 
			LEFT JOIN category_positions ON category_items.cat_id = category_positions.cat_id
			LEFT JOIN positions ON category_positions.pos_id = positions.position_id 
			WHERE order_id = {$this->session->current_order} AND NOT category_items.cat_id = 0")->result();
		} else {
			$order_items = $this->db->query("SELECT * FROM order_items 
			LEFT JOIN category_items ON order_items.item_id = category_items.item_id 
			LEFT JOIN category_positions ON category_items.cat_id = category_positions.cat_id
			LEFT JOIN positions ON category_positions.pos_id = positions.position_id 
			WHERE order_id = {$this->session->current_order} AND position_name = '$position'")->result();
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
		$query = $this->db->query("SELECT * FROM order_items
    	LEFT JOIN items ON order_items.item_id = items.item_id
		LEFT JOIN category_items ON order_items.item_id = category_items.item_id 
		LEFT JOIN category_positions ON category_items.cat_id = category_positions.cat_id
		LEFT JOIN positions ON category_positions.pos_id = positions.position_id
		LEFT JOIN orders ON order_items.order_id = orders.order_id
		LEFT JOIN categories ON category_items.cat_id = categories.category_id
		WHERE position_name = '$position' AND (item_status = 'confirmed' OR item_status = 'ready')
		ORDER BY orders.order_id, 
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

			if ((time() - strtotime($item->item_time)) / 60 > $this->config->item('late_soup_time') && 'Zupy' == $item->category_name) {
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
		$item = $this->get_order_item($order_item_id);
		if (isset($item->to_go_id)) {
			$this->db->query("DELETE FROM order_items WHERE order_item_id = {$item->to_go_id}");
		}
		$this->db->query("DELETE FROM order_items WHERE order_item_id = $order_item_id");
	}

	public function edit_item($order_item_id)
	{
		$item_comment = urldecode($this->input->post('item_comment'));
		$item_to_go = $this->input->post('item_to_go');
		$item = $this->get_order_item($order_item_id);
		if ($item_to_go == 'true' && !isset($item->to_go_id)) {
			$this->db->query("INSERT INTO order_items (item_id, order_id, item_status) 
				VALUES ({$item->item_to_go_id}, {$item->order_id},'{$item->item_status}')
				");
			$to_go_id = $this->db->insert_id();
			$this->db->query("UPDATE order_items SET item_comment = '$item_comment', to_go_id = $to_go_id WHERE order_item_id = $order_item_id");
		} else if ($item_to_go == 'false' && isset($item->to_go_id)) {
			$this->db->query("DELETE FROM order_items WHERE order_item_id = {$item->to_go_id}");
			$this->db->query("UPDATE order_items SET item_comment = '$item_comment', to_go_id = NULL WHERE order_item_id = $order_item_id");
		} else {
			$this->db->query("UPDATE order_items SET item_comment = '$item_comment' WHERE order_item_id = $order_item_id");
		}
	}

	public function set_order_status($order_id, $status)
	{
		$this->db->query("UPDATE orders SET order_status = '$status' WHERE order_id = $order_id");
	}

	public function confirm_order($order_id)
	{
		$this->set_order_status($order_id, "confirmed");
		$time = date("H:i");
		$this->db->query("UPDATE order_items SET item_status = 'confirmed', item_time = '$time'
		WHERE order_id = $order_id AND item_status = 'new'");
	}

	public function close_order($order_id)
	{
		$this->set_order_status($order_id, "closed");
		$this->db->query("UPDATE order_items SET item_status = 'closed' WHERE order_id = $order_id");
	}

	public function set_order_item_status($order_item_id, $status)
	{
		$item = $this->get_order_item($order_item_id);
		$this->db->query("INSERT INTO order_item_statuses (order_item_id, old_status, new_status)
			VALUES ($order_item_id, '$item->item_status', '$status')");
		if (isset($item->to_go_id)) {
			$this->db->query("UPDATE order_items SET item_status = '$status' WHERE order_item_id = {$item->to_go_id}");
		}
		$this->db->query("UPDATE order_items SET item_status = '$status' WHERE order_item_id = $order_item_id");
	}

	public function get_order_checkout($order_id)
	{
		$items = $this->db->query("SELECT i.item_id, i.code_id, i.item_name, i.item_price, c.code_price FROM order_items AS o
		LEFT JOIN items AS i ON o.item_id = i.item_id
		LEFT JOIN codes AS c ON c.code_id = i.code_id
		WHERE order_id = $order_id ORDER BY i.code_id
		")->result();
		$codes = [];
		foreach ($items as $item) {
			if (!isset($codes[$item->item_id])) {
				$codes[$item->item_id] = new stdClass();
				$codes[$item->item_id]->code = $item->code_id;
				$codes[$item->item_id]->count = 1;
				$codes[$item->item_id]->name = $item->item_name;
				$codes[$item->item_id]->price = $item->item_price;
				$codes[$item->item_id]->dynamic_price = $item->code_price;
			} else {
				$codes[$item->item_id]->count++;
			}
		}

		return $codes;
	}

	public function delete_order_if_empty($order_id = NULL)
	{
		if (!isset($order_id)) {
			$order_id = $this->session->current_order;
		}
		if ($this->db->query("SELECT * FROM order_items WHERE order_id = $order_id")->num_rows() == 0) {
			$this->db->query("DELETE FROM orders WHERE order_id = $order_id");
		}
	}

	public function edit_order($order_id)
	{
		$order_comment = $this->input->post('order_comment');
		$order_table = $this->input->post('order_table');
		$this->db->query("UPDATE orders SET order_comment = '$order_comment', order_table = '$order_table' 
		WHERE order_id = $order_id");
	}

	public function group_items_by_order(array $items): array
	{
		$orders = [];
		foreach ($items as $item) {
			$orders[$item->order_id][] = $item;
		}

		return $orders;
	}
}
