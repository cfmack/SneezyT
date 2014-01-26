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

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maintain extends CI_Controller {

	public function index()
	{
		$this->merge_type();
	}

	public function merge_type() 
	{
		$this->load->helper('url');
		$this->load->view('merge_type');
	}
	
	public function merge()
	{
		$data = array();
		$data['result'] = false;
		
		$type = 'Food'; // in the future, this should support more than just food
		
		$model = $type . '_model';
		$this->load->model($model);
		
		
		$from = filter_var(html_entity_decode($_POST['type-merge-from']), FILTER_SANITIZE_STRING);
		$to = filter_var(html_entity_decode($_POST['type-merge-to']), FILTER_SANITIZE_STRING);
		
		$data['to'] = $to;
		$data['from'] = $from;
		
		$from_id = $this->$model->get_type_id($from, false);
		$to_id = $this->$model->get_type_id($to, false);
		
		$data['to_id'] = $to_id;
		$data['from_id'] = $from_id;
		
		if ($from_id && $to_id && $from_id != $to_id)
		{
			// save all from types entries to to-type entries in the TypeMergeHistory table
			$this->$model->log_merge_request($from_id, $to_id);
			
			// update all from-types to to-types
			$this->$model->merge($from_id, $to_id);
			
			// soft delete $from
			$this->$model->delete_type($from_id);
			
			$data['result'] = true; // add a better error case
		}
		
		
		$data['alert'] = 'alert-success';
		if (!$data['result'])
		{
			$data['alert'] = 'alert-error';
		}
		
		$this->load->view('merge_result', $data);
	}
	
	public function get_timeline_data()
	{
        $this->load->model('Result_model');
		$timeline = $this->Result_model->timeline_data();
		$data = array();
		$data['json'] = $this->transform_timeline_data($timeline);
		$this->load->view('json_encode', $data);
	}
	

}