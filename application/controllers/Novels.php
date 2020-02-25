<?php

class Novels extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('novels_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$novels = $this->novels_model->get_novels();
		$this->output
							->set_content_type('application/json')
							->set_output(json_encode($novels));
	}
}
