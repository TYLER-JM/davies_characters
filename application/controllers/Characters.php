<?php

Class Characters extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('characters_model');
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data['characters'] = $this->characters_model->get_characters();
		$this->output
							->set_content_type('application/json')
							->set_output(json_encode($data['characters']));
	}
}
