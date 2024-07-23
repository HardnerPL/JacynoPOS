<?php

/**
 * @property Order_model order_model
 * @property User_model user_model
 * @property CI_Loader load
 * @property CI_Output output
 */
class Kitchen_main_menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->user_model->can_access('kitchen')) {
			redirect('login');
		}
	}

	public function load_main_menu()
	{
		$order_items = $this->order_model->get_active_order_items('kitchen');

		$this->load->view('kitchen/main_menu/top_menu');
		$this->load->view('kitchen/main_menu/order_list', [
			'order_items' => $order_items
		]);
		$this->load->view('kitchen/main_menu/right_menu');
	}

	public function get_item_sums()
	{
		$order_items = $this->order_model->get_active_order_items('kitchen');
		$order_item_counts = [];
		foreach ($order_items as $order_item)
		{
			$to_go = isset($order_item->to_go_id);
			if ($order_item->item_type == 'zupa')
			{
				$count_id = $order_item->item_id . $to_go;
				$order_item_counts[$count_id] ??= [
					'display_name' => $order_item->item_name . ($to_go ? ' (wynos)' : ''),
					'count' => 0,
				];
				$order_item_counts[$count_id]['count']++;

				continue;
			}

			if ($order_item->item_type == 'obiad')
			{
				$name = $order_item->item_name;
				$plus_pos = strpos($name, '+');
				$name = substr($name, 0, $plus_pos ? $plus_pos - 1 : strlen($name));
				$count_id = $name . $to_go;
				$order_item_counts[$count_id] ??= [
					'display_name' => $name . ($to_go ? ' (wynos)' : ''),
					'count' => 0,
				];
				$order_item_counts[$count_id]['count']++;
			}

			if (
				str_contains($order_item->item_name, '+ Z')
				|| $order_item->item_name == 'Ziemniaki'
			) {
				$count_id = 'ziemniaki' . $to_go;
				$order_item_counts[$count_id] ??= [
					'display_name' => 'Ziemniaki' . ($to_go ? ' (wynos)' : ''),
					'count' => 0,
				];
				$order_item_counts[$count_id]['count']++;
			}
			elseif (
				str_contains($order_item->item_name, '+ F')
				|| $order_item->item_name == 'Frytki'
			) {
				$count_id = 'frytki' . $to_go;
				$order_item_counts[$count_id] ??= [
					'display_name' => 'Frytki' . ($to_go ? ' (wynos)' : ''),
					'count' => 0,
				];
				$order_item_counts[$count_id]['count']++;
			}
		}

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(array_values($order_item_counts)));
	}

	public function order_list()
	{
		$data['order_items'] = $this->order_model->get_active_order_items('kitchen');

		$this->load->view('kitchen/main_menu/order_list', $data);
	}

	public function item_ready_popup($order_item_id)
	{
		$data['order_item_id'] = $order_item_id;
		$this->load->view('kitchen/main_menu/item_ready_popup', $data);
	}

	public function item_ready($order_item_id)
	{
		$this->order_model->set_order_item_status($order_item_id, 'ready');
	}

	public function item_delivered_popup($order_item_id)
	{
		$data['order_item_id'] = $order_item_id;
		$this->load->view('kitchen/main_menu/item_delivered_popup', $data);
	}

	public function item_delivered($order_item_id)
	{
		$this->order_model->set_order_item_status($order_item_id, 'delivered');
	}
}
