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

/**
 * Abstract base controller class
 */
class MY_Controller extends CI_Controller {

    // used for view layer
    protected $icon;
    protected $amount_label;

	public function __construct()
	{
		// Call the Controller constructor
		parent::__construct();
		$this->amount_label = "Amount";
		$this->define();
	}
	
	
	/**
	 * Went back and forth here but decided to force an override rather than have a generic DAO
	 *
	 */
	function define() 
	{
		
	}
	
	/**
	 * Default view for this type of data
	 * 
	 */
	public function index()
	{
		$this->add();
	}
	
	/**
	 * Add view for this type of data
	 * 
	 */
	public function add()
	{
		$data = array();
		$data['header'] = ucfirst($this->name);
		$data['name'] 	= $this->name;
		
		$this->load->view('add_view', $data);
	}
	
	
	/**
	 * Insert data
	 * 
	 */
	public function insert()
	{
		$data = array();
		$data['name'] = $this->name;
		
		$selection = $_POST[$this->name];
		$date = new DateTime($_POST[$this->name . '-date']);
		$note = $_POST[$this->name . '-note'];
        $amount = $_POST[$this->name . '-amount'];
		
		$model = ucfirst($this->name) . '_model';
		$this->load->model($model);
		
		$data['result'] = $this->$model->insert($selection, $date, $note, $amount);
		$data['alert'] = 'alert-success';
		if (!$data['result'])
		{
			$data['alert'] = 'alert-error';
		}
		
		$this->load->view('insert_view', $data);
	}
	
	public function get_types()
	{
		$data = array();
	
		$term = '';
	
		if(isset($_GET['term']))
		{
			$term = $_GET['term'];
		}
	
		$model = ucfirst($this->name) . '_model';
		$this->load->model($model);
		
		$data['json'] = $this->$model->get_types($term);
		
		$this->load->view('json_encode', $data);
	}
	
	
	
	public function retrieve_inventory()
	{
		$model = ucfirst($this->name) . '_model';
		$this->load->model($model);
		
		$index = intval($_GET['jtStartIndex']);
		$page_size = intval($_GET['jtPageSize']);
		
		$sort = ' ' . ucfirst($this->name) . 'Date DESC ';
		if (isset($_GET['jtSorting']))
		{	     
			$sort = html_entity_decode($_GET['jtSorting']);
		}
		
		$result = $this->$model->inventory($index, $page_size, trim($sort));
		$data['json'] = array("Result" => "OK", "Records" => $result );
		$this->load->view('json_encode', $data);
	}
	
	public function delete()
	{
		$model = ucfirst($this->name) . '_model';
		$this->load->model($model);
		
		$this->$model->delete(intval($_POST[ ucfirst($this->name) . 'Id']));
	
		$data = array();
		$data['json'] = array("Result" => "OK");
		$this->load->view('json_encode', $data);
	}
	
	public function update()
	{
		$this->load->helper('url');
		
		$model = ucfirst($this->name) . '_model';
		$this->load->model($model);
		
		$date = new DateTime($_POST[ucfirst($this->name) .'Date']);
		$this->$model->update(intval($_POST[ ucfirst($this->name) . 'Id']), $_POST[ucfirst($this->name) .'Note'], $date, $_POST[ucfirst($this->name) .'Amount']);
		
		$data = array();
		$data['json'] = array("Result" => "OK");
		$this->load->view('json_encode', $data);
	}

    /**
     * Download the category export range
     *
     * @param $start_date
     * @param $end_date
     * @param bool $echo - echo to the screen / pop up, opposed to return the data
     *
     * @return array
     */
    public function download($start_date, $end_date, $echo = true)
    {
        $this->load->helper('url');
        $this->load->model('Person_model');

        $person = $this->Person_model->get_active_person();

        $model = ucfirst($this->name) . '_model';
        $this->load->model($model);

        if (stripos($start_date, '-') == 2)
        {
            $start_date = DateTime::createFromFormat('m-d-Y', $start_date);
        }
        else
        {
            $start_date = DateTime::createFromFormat('Y-m-d', $start_date);
        }

        if (stripos($end_date, '-') == 2)
        {
            $end_date = DateTime::createFromFormat('m-d-Y', $end_date);
        }
        else
        {
            $end_date = DateTime::createFromFormat('Y-m-d', $end_date);
        }

        $model = ucfirst($this->name) . '_model';
        $this->load->model($model);

        $result = $this->$model->download($start_date, $end_date);

        $data = array();
        $data['file'] = 'Sneezy-T-Extract-' . $person['person_name'] . '-'. $this->name . '-' . $start_date->format('Ymd');
        $data['header'] = array("Date", ucfirst($this->name), "Note");
        $data['data'] = $result;

        if ($echo)
        {
            $this->load->view('csv', $data);
            return array();
        }
        else
        {
            return $data;
        }
    }

    /**
     * Email the download / export data to the user logged in
     *
     * @param $start_date
     * @param $end_date
     */
    public function email($start_date, $end_date)
    {
        $this->load->helper('file');
        $this->load->library('email');

        $this->load->config('ion_auth', TRUE);
        $this->load->library('session');
        $this->load->library('ion_auth');

        $file = $this->download($start_date, $end_date, false);

        $file['file'] = '/tmp/' . $file['file'] . '.csv';

        $data = '';
        $data .= '"' . implode('","', $file['header']) . '"' . "\n";

        foreach ($file['data'] as $row)
        {
            $data .= '"' . implode('","', $row) . '"' . "\n";
        }

        // free some memory
        unset($file['data']);

        $alert = array();

        if ( write_file($file['file'], $data, 'wr+') )
        {
            $to = $this->session->userdata('email');

            $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
            $this->email->to($to);

            $this->email->subject('Sneezy T ' . ucfirst($this->name) . ' Extract');
            $this->email->message('Attached is a file containing the extract from Sneezy T.  Open it in Excel.');

            $this->email->attach($file['file']);

            $this->email->send();

            delete_files($file['file']);

            $alert['type'] = 'alert-success';
            $alert['message'] = 'Email sent to: ' . $to;
        }
        else
        {
            $alert['type'] = 'alert-error';
            $alert['message'] = 'Unable to send email';
        }

        $this->load->view('email_response_view', $alert);
    }

	/**
	 * Simplify the view of the type into one div
	 */
	public function category() 
	{


		$category_data = array();
			
		$category_data['name'] = $this->name;
        $category_data['hide'] = false;
		
		$category_data['section'] = array();
        $category_data['section']['add'] = $this->load->view('add_view', array(
                                                'header'=>$this->build_header(),
                                                'name'=>$this->name,
                                                'icon'=>$this->icon,
                                                'amount_label'=>$this->amount_label),
                                            true);

        $json = $this->load->view('inventory_json', array('type'=>ucfirst($this->name)), true);
		$category_data['section']['inventory'] = $this->load->view('inventory_view', array('name'=>$this->name, 'json'=>$json), true);

        $category_data['section']['download'] = $this->load->view('category_download_view', array('name'=>$this->name), true );

        $this->load->view('category_view', $category_data);
	}

    /**
     * Build header string for each section, currently used in add_view
     *
     * @return string
     */
    private function build_header()
    {
        $this->load->model('Person_model');

        $person = $this->Person_model->get_active_person();
        $header = $person['person_name'];

        if (substr(strtolower($header), -1) == 's')
        {
            $header .= "'";
        }
        else
        {
            $header .= "'s ";
        }

        $header .= ' ' . ucfirst($this->name);

        return $header;
    }
}
?>