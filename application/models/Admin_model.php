<?php


/**
 * @property CI_DB_query_builder db
 */
class Admin_model extends CI_Model
{
	public function get_category_sales_by_date(string $date)
	{
		$next_day = date('Y-m-d', strtotime('+1 day', strtotime($date)));
		$first_day = $this->db->escape($date);
		$last_day = $this->db->escape($next_day);

		$sql = "
			SELECT c.category_name AS type, COUNT(item_price) AS count, SUM(item_price) AS value
			FROM order_items AS o
					 LEFT JOIN items AS i ON o.item_id = i.item_id
					 LEFT JOIN category_items ci on i.item_id = ci.item_id
					 LEFT JOIN categories AS c ON c.category_id = ci.cat_id
			WHERE o.item_datetime >= $first_day
			  AND o.item_datetime < $last_day
			  AND NOT o.item_status = 'deleted'
			GROUP BY c.category_name
		";

		return $this->db->query($sql)->result();
	}
}
