<?php

Class Characters_model extends CI_model {
	public function __construct()
	{
		$this->load->database();
	}

	public function get_characters($id = false)
	{
		if ($id === false) {
			$query = $this->db->get('person');
			return $query->result_array();
		}

		# run two queries
		$this->db->select('title, year_published');
		$this->db->from('novel');
		$this->db->join('person_novel', 'person_novel.novel_id = novel.id');
		$this->db->where('person_novel.person_id', $id);
		$novels_query = $this->db->get();
		$char_data = array(
			'id' => $id
		);
		$characters_query = $this->db->get_where('person', $char_data);
		# row() returns an stdClass
		# result() returns an Array of stdClass objects
		$full_query = $characters_query->row();
		$full_query->novels = $novels_query->result();
		#print_r($full_query);
		return $full_query;
	}

	public function find_characters($query)
	{
		$this->db->get('person');
		$this->db->like('first_name', $query, 'after');
		$this->db->or_like('last_name', $query, 'after');
		$query = $this->db->get('person');
		$found_chars = $query->result();

		// foreach ($found_chars as $key => $value) {
		foreach ($found_chars as $char) {
			$this->db->select('title, year_published');
			$this->db->from('novel');
			$this->db->join('person_novel', 'person_novel.novel_id = novel.id');
			$this->db->where('person_novel.person_id', $char->id);
			$novels_query = $this->db->get();
			$char->novels = $novels_query->result();
		}
		# return $query->result();
		return $found_chars;
	}

	public function add_character($data)
	{
		$novel_data = array(
			'title' => ucwords(strtolower(trim($data['novel']['title']))),
		);
		# check if the Novel exists in the Database Already
		$check_query = $this->db->get_where('novel', $novel_data);
		$novel = $check_query->row();
		if (! $novel) {
			$this->db->insert('novel', $novel_data);
			$novel_query = $this->db->get_where('novel', $novel_data);
			$novel = $novel_query->row();
		}

		foreach ($data['person'] as $key => $value) {
			if ($value) {
				$character_data[$key] = strtolower($value);
			}
		}

		$is_character_there = [
			'first_name' => strtolower(trim($data['person']['first_name'])),
			'last_name' => strtolower(trim($data['person']['last_name']))
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
