<?php

class Person_model extends CI_Model {


	function __construct()
	{
		// Call the Model constructor
		parent::__construct();

        $this->load->library('session');
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

    /**
     * Get an inventory of people for this user
     *
     * @param int $index
     * @param bool $page_size
     * @param string $sort_str
     *
     * @return mixed
     */
    function inventory($index=0, $page_size=false, $sort_str = 'PersonId ASC')
	{
        $sort = explode(' ', $sort_str);

        $id = (int) $this->ion_auth->user()->row()->id;
        $this->db->select( 'p.PersonId, p.PersonName, p.PersonNote, IsDefault')
            ->from('Person p')
            ->where('p.UserId', $id)
            ->where('IsDeleted', 0)
            ->order_by(trim($sort[0]), trim($sort[1]));

        if ($page_size)
        {
            $this->db->limit($page_size, $index);
        }

        $query = $this->db->get();
        return $query->result_array();
	}

    /**
     * Get the person for this user
     *
     * @param $id int - if false, returns the default user
     *
     * @return object
     */
    public function get_person($id = false)
    {
        $user_id = intval($this->ion_auth->user()->row()->id);

        $this->db->select( 'PersonId, PersonName');
        $this->db->where('IsDeleted', 0);

        if ($id == false)
        {
            $this->db->where('IsDefault', 1);
        }
        else
        {
            $this->db->where('PersonId', $id);
        }

        $this->db->where('UserId', $user_id );
        $query = $this->db->get('Person');

        return $query->first_row();
    }

    /**
     * Check that this logged in user can see this person
     *
     * @param $person_id
     * @return bool
     */
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

    public function get_active_person()
    {
        $person_id = $this->session->userdata('person_id');

        if ($person_id == false)
        {
            $this->set_active_person(); // set it to the default
            $person_id = $this->session->userdata('person_id');
        }

        $person_name = $this->session->userdata('person_name');

        return array('person_id'=>$person_id, 'person_name'=>$person_name);
    }


    /**
     * If nothing is passed, it returns the default for the user
     * @param string $person_id
     * @param $person_name
     * @return bool
     */
    public function set_active_person($person_id = false, $person_name = false)
    {
        if ($person_id != false && $person_name == false)
        {
            throw new Exception('Id and Name should always be set if one is set');
        }

        if ($person_id == false)
        {
            $default = $this->get_person();

            if (!isset($default->PersonId))
            {
                return false;
            }

            $person_id = $default->PersonId;
            $person_name = $default->PersonName;
        }
        else if (!$this->check_person_session($person_id))
        {
            // this user cannot set this person
            return false;
        }

        $this->session->set_userdata('person_id', $person_id);
        $this->session->set_userdata('person_name', $person_name);

        return true;
    }

}
