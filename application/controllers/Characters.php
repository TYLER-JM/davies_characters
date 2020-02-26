<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST");
header('Access-Control-Allow-Headers: Content-Type');
?>
<?php

Class Characters extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('characters_model');
		$this->load->helper('url_helper');

		$this->output->set_header('Access-Control-Allow-Origin: http://localhost:8080');
		$this->output->set_header('Access-Control-Allow-Methods: GET, OPTIONS, DELETE, POST');
		$this->output->set_header('Access-Control-Allow-Headers: Content-Type');
	}

	public function index()
	{
		$data['characters'] = $this->characters_model->get_characters();
		$this->output
							->set_content_type('application/json')
							->set_output(json_encode($data['characters']));
	}

	public function add()
	{
		$json_data = json_decode(file_get_contents('php://input'), true);
		// $this->output
		// 					->set_content_type('application/json')
		// 					->set_output(json_encode($json_data));
		$this->characters_model->add_character($json_data);
	}

	public function view($id)
	{
		$character = $this->characters_model->get_characters($id);
		$this->output
							->set_content_type('application/json')
							->set_output(json_encode($character));
	}
}
