<?php

Class Characters_model extends CI_model {
	public function __construct()
	{
		$this->load->database();
	}
	public function get_characters($slug = false)
	{
		if ($slug === false) {
			$query = $this->db->get('characters');
			return $query->result_array();
		}
	}
}
