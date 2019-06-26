<?php
/**
 * Created by PhpStorm.
 * User: Hardner07@gmail.com
 * Date: 6/21/2019
 * Time: 7:37 PM
 */

class Item_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function get_category_items($category_id) : array {
        return $this->db->query("SELECT * FROM items WHERE item_category = $category_id")->result();
    }

    public function get_item($item_id) {
        return $this->db->query("SELECT * FROM items WHERE item_id = $item_id")->row();
    }
}