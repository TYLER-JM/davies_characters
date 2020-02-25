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
		$check_query = $this->db->get_where('novel', $novel_data);
		$novel = $check_query->row();
		if (! $novel)
		{
			$this->db->insert('novels', $novel_data);
			$novel_query = $this->db->get_where('novel', $novel_data);
			$novel = $novel_query->row();
		}

		// $character_data = array(
		// 	'first_name' => ucwords(strtolower(trim($data['first_name']))),
		// 	'last_name' => ucwords(strtolower(trim($data['last_name']))),
		// 	'birth_name' => ucwords(strtolower(trim($data['birth_name']))),
		// 	'nick_name' => ucwords(strtolower(trim($data['nick_name']))),
		// 	'hometown' => ucwords(strtolower(trim($data['hometown']))),
		// 	'about' => strtolower(trim($data['about'])),
		// 	'birth_year' => trim($data['birth_year']),
		// 	'death_year' => trim($data['death_year']),
		// );

		$character_data['first_name'] = ucwords(strtolower(trim($data['first_name'])));
		$character_data['last_name'] = ucwords(strtolower(trim($data['last_name'])));

		# only insert if the character doesn't already exist
		$character_query = $this->db->get_where('person', $character_data);
		$new_char = $character_query->row();
		if (! $new_char)
		{
			$character_data['birth_name'] = ucwords(strtolower(trim($data['birth_name']))) || null;
			$character_data['nick_name'] = ucwords(strtolower(trim($data['nick_name']))) || null;
			$character_data['hometown'] = ucwords(strtolower(trim($data['hometown']))) || null;
			$character_data['about'] = strtolower(trim($data['about'])) || null;
			$character_data['birth_year'] = trim($data['birth_year']) || null;
			$character_data['death_year'] = trim($data['death_year']) || null;

			$this->db->insert('person', $character_data);

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
