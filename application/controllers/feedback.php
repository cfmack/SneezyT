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

class Feedback extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Feedback_model');
    }

    public function index()
	{
        $this->view();
    }

    public function view()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('', 'refresh');
            return;
        }

        $this->load->view('feedback_view', array());
    }


    public function submit()
    {
        $feedback = filter_var($_POST['feedback'], FILTER_SANITIZE_STRING);


        $data = array();
        $data['result'] = $this->Feedback_model->add($feedback);

        $data['alert'] = 'alert-success';
        if (!$data['result'])
        {
            $data['alert'] = 'alert-error';
        }

        $this->load->view('feedback_result', $data);
    }

}