<?php


/**
 * @property CI_Loader load
 * @property Admin_model admin_model
 * @property User_model user_model
 * @property CI_Input input
 */
class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->user_model->can_access('admin')) {
			redirect('login');
		}

		$this->load->model('admin_model');
	}

	public function dashboard()
	{
		$timestamp = !empty($this->input->get('date')) ? strtotime($this->input->get('date')) : time();
		$content_data['categories'] = $this->admin_model->get_category_sales_by_date(date('Y-m-d', $timestamp));
		$data['content'] = $this->load->view('admin/dashboard/table', $content_data, true);
		$this->load->view('admin/layout', $data);
	}
}
