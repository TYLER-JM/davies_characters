<?php

Class Characters_model extends CI_model {
	public function __construct()
	{
		$this->load->database();
	}

	public function get_characters($slug = false)
	{
		if ($slug === false)
		{
			$query = $this->db->get('person');
			return $query->result_array();
		}
	}

	public function add_character($data)
	{
		$novel_data = array(
			'title' => ucwords(strtolower(trim($data['novel']))),
			'year_published' => $data['year_published']
		);
		# check if the Novel exists in the Database Already
		# ...I should also format the text (Capitalize each first word)
		$check_query = $this->db->get_where('novel', $novel_data);
		$row = $check_query->row();
		if (! $row)
		{
			$this->db->insert('novels', $novel_data);
			$novel_query = $this->db->get_where('novel', $novel_data);
			$row = $novel_query->row();
		}

		$character_data = array(
			'first_name' => ucwords(strtolower(trim($data['first_name']))),
			'last_name' => ucwords(strtolower(trim($data['last_name']))),
			'novel_id' => $row->id
		);

		# only insert if the character doesn't already exist
		$character_query = $this->db->get_where('person', $character_data);
		$row = $character_query->row();
		if (! $row)
		{
			$this->db->insert('person', $character_data);
		}
	}
}
