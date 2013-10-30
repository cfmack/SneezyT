<?php

class Person_model extends CI_Model {


	function __construct()
	{
		// Call the Model constructor
		parent::__construct();

        $this->load->library('ion_auth');

    }

	public function add($person_name, $is_default, $person_note)
	{
        //log_message('error', print_r($this->ion_auth->user()->row()->id, true));
        $data = array(
            'PersonName'=>filter_var($person_name,FILTER_SANITIZE_STRING),
            'PersonNote' => filter_var($person_note,FILTER_SANITIZE_STRING),
            'IsDefault' => ($is_default?1:0),
            'UserId' => $this->ion_auth->user()->row()->id
        );

        if ($is_default)
        {
            $this->reset_default();
        }

        $this->db->insert('Person' , $data);
        return $this->db->insert_id();
	}
	
	function inventory($index, $page_size, $sort_str = 'PersonId ASC')
	{
        $sort = explode(' ', $sort_str);

        $id = (int) $this->ion_auth->user()->row()->id;
        $this->db->select( 'p.PersonId, p.PersonName, p.PersonNote, IsDefault')
            ->from('Person p')
            ->where('p.UserId', $id)
            ->where('IsDeleted', 0)
            ->order_by(trim($sort[0]), trim($sort[1]))
            ->limit($page_size, $index);
        $query = $this->db->get();
        return $query->result_array();
	}

    function check_person_session($person_id)
    {
        $user_id = intval($this->ion_auth->user()->row()->id);
        $this->db->select( 'PersonId');
        $this->db->where('IsDeleted', 0);
        $this->db->where('UserId', $user_id );
        $query = $this->db->get('Person');
        $row = $query->first_row();
        return (isset($row->PersonId));
    }

    function reset_default()
    {
        $user_id = intval($this->ion_auth->user()->row()->id);

        $data = array(
            'IsDefault' => 0
        );

        $this->db->where('UserId', $user_id);
        $this->db->update('Person', $data);
    }


    function update($person_id, $person_name, $is_default, $person_note)
    {
        if (!$this->check_person_session($person_id))
        {
            return;
        }

        $data = array(
            'PersonNote' => $person_note,
            'PersonName' => $person_name,
            'IsDefault' => $is_default
        );

        if ($is_default)
        {
            $this->reset_default();
        }


        $this->db->where('PersonId', intval($person_id));
        $this->db->update('Person', $data);
    }

    function delete($person_id)
    {
        if (!$this->check_person_session($person_id))
        {
            return;
        }

        $data = array(
            'IsDeleted' => 1
        );


        $this->db->where('PersonId', intval($person_id));
        $this->db->update('Person', $data);
    }


}
