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



class Feedback_model extends CI_Model {


	function __construct()
	{
		// Call the Model constructor
		parent::__construct();

        $this->load->library('session');
        $this->load->library('ion_auth');
    }

    /**
     * @param $feedback
     * @return mixed
     */
    public function add($feedback)
	{
        $userId = $this->ion_auth->user()->row()->id;
        if (!$userId)
        {
            log_message('error', 'Could not find user id', true);
            throw new Exception('Could not find user id');
        }

        $date = new DateTime('now');

        $data = array(
            'Feedback' => filter_var($feedback,FILTER_SANITIZE_STRING),
            'FeedbackDate' => $date->format("Y-m-d H:i:s"),
            'UserId' => $userId
        );

        $this->db->insert('Feedback' , $data);
        return $this->db->insert_id();
	}

}
