<?php

Class Novels_model extends CI_model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get_novels($slug = false)
	{
		$query = $this->db->get('novels');
		return $query->result_array();
	}
}
