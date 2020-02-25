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
			'title' => ucwords(strtolower(trim($data['novel']['title']))),
			'year_published' => $data['novel']['year_published']
		);
		# check if the Novel exists in the Database Already
		$check_query = $this->db->get_where('novel', $novel_data);
		$novel = $check_query->row();
		if (! $novel) {
			$this->db->insert('novels', $novel_data);
			$novel_query = $this->db->get_where('novel', $novel_data);
			$novel = $novel_query->row();
		}

		foreach ($data['person'] as $key => $value) {
			if ($value) {
				$character_data[$key] = $value;
			}
		}

		$is_character_there = [
			'first_name' => ucwords(strtolower(trim($data['person']['first_name']))),
			'last_name' => ucwords(strtolower(trim($data['person']['last_name'])))
		];

		# only insert if the character doesn't already exist
		$character_query = $this->db->get_where('person', $is_character_there);
		$new_char = $character_query->row();
		if (! $new_char)
		{
			$this->db->insert('person', $character_data);

			# get info to add the required row in the join table
			$new_character_query = $this->db->get_where('person', $character_data);
			$new_char = $new_character_query->row();

			$new_join = array(
				'novel_id' => $novel->id,
				'person_id' => $new_char->id
			);

			$this->db->insert('person_novel', $new_join);
		}
	}
}
