<?php
/*
Copyright (C) 2013-2014 Charles Mack

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>
*/


class Sneezy_model extends CI_Model {

	protected $table;
	
	public function __construct()
	{
        // Call the Model constructor
		parent::__construct();
		$this->define();

        $this->load->library('session');
        $this->load->library('ion_auth');
        $this->load->model('Person_model');
    }

	/**
	 * @todo find a way to abstract this
	 * 
	 * Not sure if I like this approach.  Ideally, this would be abstract but I can't get codeignitor to go along with that idea.  
	 * 
	 */
	function define() {}
	
	
	/**
	 * Model for the combo box for this model
	 * @param string $term - search term
	 */
	public function get_types($term)
	{
        $userId = $this->ion_auth->user()->row()->id;
        if (!$userId)
        {
            log_message('error', 'Could not find user id', true);
            throw new Exception('Could not find user id');
        }


		$this->db->select( $this->table  . 'TypeId as id, ' . $this->table . 'Name as value');
		$this->db->order_by( $this->table . 'Name', 'asc');
		$this->db->like($this->table . 'Name', $term);
		$this->db->where('IsDeleted', 0);
        $this->db->where('(UserId IS NULL OR UserId = ' . intval($userId) . ') ');

        $query = $this->db->get($this->table . 'Type', 10);

        return $query->result();
	}

	/**
	 * Insert into this table
	 * 
	 * @param string $selection - selected term
	 * @param DateTime $date
	 * @param string $note - optional note
     * @param string $amount - optional amount
	 */
	public function insert($selection, $date, $note, $amount)
	{
		$type_id = $this->get_type_id($selection);
		if (!$type_id)
		{
			log_message('error', "Error generating new: $selection");
			return false;
		}

        $person = $this->Person_model->get_active_person();

		$data = array(
				$this->table  . 'TypeId' => $type_id ,
				$this->table  . 'Date' => $date->format("Y-m-d H:i:s"),
				$this->table  . 'Note' => $this->cleanse_string($note),
                $this->table  . 'Amount' => $this->cleanse_string($amount),
                'PersonId' => $person['person_id']
		);
		
		$this->db->insert($this->table , $data);
		return $this->db->insert_id();
	}
	
	/**
	 * Looks up the name based user input.  If an entry is not found, it is added (probably not the best idea but cheap)
	 * 
	 * @param string $term
	 * @param boolean $insert - only insert if this is true
	 * @return int|false
	 */
	public function get_type_id($term, $insert=true)
	{
        $userId = $this->ion_auth->user()->row()->id;
        if (!$userId)
        {
            log_message('error', 'Could not find user id', true);
            throw new Exception('Could not find user id');
        }

        $term = $this->cleanse_string($term);

        $this->db->select($this->table . 'TypeId, IsDeleted');
        $this->db->from($this->table . 'Type');
        $this->db->where($this->table . 'Name', $term);
        $this->db->where('(UserId IS NULL OR UserId = ' . intval($userId) . ') ');

        $query = $this->db->get();
		$row = $query->first_row();

		$column_name = $this->table . 'TypeId';
		
		$is_deleted = false;
		
		if (isset($row->IsDeleted))
		{
			$is_deleted = $row->IsDeleted;
		}
		
		if ($is_deleted == true)
		{
			log_message('error', $this->table . ' already soft deleted this term: ' . $term);
			return false;
		}

		if (!isset($row->$column_name) || $row->$column_name == null)
		{
			if ($insert)
			{
				$data = array(
						$this->table . 'Name' => $term,
                        'UserId' => $userId

				);

				if($this->db->insert($this->table . 'Type', $data))
				{
					return $this->db->insert_id();
				}

			}

			return false;
		}	

		return $row->$column_name;
	}

    /**
     * Quick and dirty function to cleanse a string
     *
     * @todo replace with CodeIgnitor input validator
     * @param $s
     * @return mixed
     */
    private function cleanse_string($s)
    {
        return filter_var($s, FILTER_SANITIZE_STRING);
    }


	/**
	 * Persist this change of this type table to be from and to
	 * 
	 * @return int affected_rows() 
	 */
	public function log_merge_request($from_id, $to_id)
	{

        if (!($this->ion_auth->is_admin()))
        {
            throw new Exception("Unauthorized");
        }

		$date = new DateTime();
		$today = $date->format("Y-m-d H:i:s");
		
		$table = $this->table;
		$table_id = $table . 'Id';
		$table_type_id = $table . 'TypeId';
		
		$update = <<<SQL
INSERT INTO TypeMergeHistory (MergeTable, TableId, ToTypeId, FromTypeId, MergeDate) 
 SELECT '$table', $table_id, $to_id, $from_id, '$today'
 FROM `$table`
 WHERE $table_type_id = $from_id;
SQL;
		
		$this->db->query($update);
		
		return $this->db->affected_rows();
	}
	
	/**
	 * Update all the entries in this->table with a new type
	 * 
	 * @return int affected_rows()
	 */
	public function merge($from_id, $to_id)
	{
        if (!($this->ion_auth->is_admin()))
        {
            throw new Exception("Unauthorized");
        }

		$table_type_id = $this->table . 'TypeId';
		$data = array(
				$table_type_id => $to_id
		);
	
		$this->db->where($table_type_id, intval($from_id));
		$this->db->update($this->table, $data);
		
		return $this->db->affected_rows();
	}
	
	/**
	 * Get all inventory in a list
	 * @param unknown_type $index
	 * @param unknown_type $page_size
	 * @param unknown_type $sort
	 */
	public function inventory($index, $page_size, $sort_str)
	{
		$sort = explode(' ', $sort_str);

        $person = $this->Person_model->get_active_person();


        $this->db->select( $this->table  . 'Id, ' . $this->table . 'Date, ' . $this->table . 'Name, ' . $this->table . 'Amount, ' . $this->table . 'Note')
					->from($this->table . ' i')
					->join($this->table . 'Type t', 'i.'.$this->table.'TypeId = t.'. $this->table .'TypeId')
					->where('i.IsDeleted', 0)
                    ->where('i.PersonId', $person['person_id'])
					->order_by(trim($sort[0]), trim($sort[1]))
					->limit($page_size, $index);
		$query = $this->db->get();
		return $query->result_array();
	}

    /**
     * Get total count for what's in the inventory inventory in a list
     * @param unknown_type $index
     * @param unknown_type $page_size
     * @param unknown_type $sort
     */
    public function inventory_count()
    {
        $person = $this->Person_model->get_active_person();

        $this->db->from($this->table . ' i')
            ->join($this->table . 'Type t', 'i.'.$this->table.'TypeId = t.'. $this->table .'TypeId')
            ->where('i.IsDeleted', 0)
            ->where('i.PersonId', $person['person_id']);

        return $this->db->count_all_results();
    }

    /**
     * Get a downloaded list of food
     * @param DateTime $start_date
     * @param DateTime $end_date note that we add a day in the query to the End Date.  This makes the end date inclusive
     */
    public function download($start_date, $end_date)
    {
        $start = $start_date->format("Y-m-d");

        $end_date->add(new DateInterval('P1D'));
        $end = $end_date->format("Y-m-d");

        $person = $this->Person_model->get_active_person();

        $this->db->select( $this->table . 'Date, ' . $this->table . 'Name, ' . $this->table . 'Amount, ' . $this->table . 'Note')
            ->from($this->table . ' i')
            ->join($this->table . 'Type t', 'i.'.$this->table.'TypeId = t.'. $this->table .'TypeId')
            ->where('i.IsDeleted', 0)
            ->where('i.PersonId', $person['person_id'])
            ->where($this->table . "Date BETWEEN '$start' AND '$end'")
            ->order_by($this->table . "Date", "DESC");

        $query = $this->db->get();
        return $query->result_array();
    }

	/**
	 * Soft delete an entry from the list
	 */
	public function delete($id)
	{
        $person = $this->Person_model->get_active_person();

        $data = array(
        	'IsDeleted' => 1
	    );

        $this->db->where($this->table . 'Id', intval($id));
        $this->db->where('PersonId', intval($person['person_id']));
	    $this->db->update($this->table, $data); 
	}

	/**
	 * Soft delete an type entry
	 */
	public function delete_type($id)
	{
        if (!($this->ion_auth->is_admin()))
        {
            throw new Exception("Unauthorized");
        }

		$data = array(
				'IsDeleted' => 1
		);
		
		$this->db->where($this->table . 'TypeId', intval($id));
		$this->db->update($this->table . 'Type', $data);
		
		return $this->db->affected_rows();
	}
	
	/**
	 * Update just the note and date
	 */
	public function update($id, $note, $date, $amount)
	{
        $person = $this->Person_model->get_active_person();

        $data = array(
           		$this->table . 'Note' => $this->cleanse_string($note),
				$this->table  . 'Date' => $date->format("Y-m-d H:i:s"),
                $this->table . 'Amount' => $this->cleanse_string($amount)
	        );

        $this->db->where($this->table . 'Id', intval($id));
        $this->db->where('PersonId', intval($person['person_id']));
	    $this->db->update($this->table, $data); 
	}
}
?>