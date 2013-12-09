<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result extends CI_Controller {

	public function index()
	{
		$this->hours_from_reaction();
	}

	public function hours_from_reaction() 
	{
		$this->load->helper('url');
		$this->load->view('hours_from_reaction');
	}

    /**
     * Cheap and dirty duplication of retrieve hours from reaction
     * @param $num_of_gaps
     * @param $scale
     * @param $start_date
     * @param $end_date
     * @param $type
     * @param $min_eaten
     * @param $initial_hour
     * @param $food_filter
     */
    public function download_hours_from_reaction($num_of_gaps, $scale, $start_date, $end_date, $type, $min_eaten, $initial_hour, $food_filter)
    {
        $index = 0;
        $page_size = 10000;
        $sort = 'NumOfFood DESC';

        $num_of_gaps = intval($num_of_gaps);
        $min_eaten = intval($min_eaten);
        $initial_hour = intval($initial_hour);
        $scale = filter_var($scale, FILTER_SANITIZE_STRING);

        $start_date = DateTime::createFromFormat('m-d-Y', $start_date);
        $end_date = DateTime::createFromFormat('m-d-Y', $end_date);

        $type = filter_var($type, FILTER_SANITIZE_STRING);
        $type = urldecode($type);

        $food_filter = urldecode($food_filter);
        $food_filter = filter_var($food_filter, FILTER_SANITIZE_STRING);

        $this->load->model('Reaction_model');
        $id = $this->Reaction_model->get_type_id($type);

        $this->load->model('Result_model');
        $result = $this->Result_model->hours_from_reaction($index, $page_size, $num_of_gaps, $scale, $sort, $start_date->format('Y-m-d'), $end_date->format('Y-m-d'), $id, $min_eaten, $initial_hour, $food_filter);

        $hour = $initial_hour;
        for($i = 1; $i <= $num_of_gaps; $i++)
        {
            if ($scale == 'quadratic')
            {
                $hour_gaps[$i] = pow($hour, 2);
            }
            else if ($scale == 'exponential')
            {
                $hour_gaps[$i] = pow(2, $hour);
            }
            else //if ($scale == 'linear')
            {
                $hour_gaps[$i] = $hour;
            }

            $hour += 1;
        }

        $columns = array();
        $columns[] = 'FoodName';
        $columns[] = "NumOfFood";
        for($i = 1; $i <= $num_of_gaps; $i++)
        {
            $columns[] = "NumOf" . $hour_gaps[$i] . "Reactions";
            $columns[] = "PercentOf" . $hour_gaps[$i] . "Reactions";
        }

        $data = array();
        $data['file'] = 'Sneezy-T-Extract-Hour-by-Reaction-' . $start_date->format('Ymd');
        $data['header'] = $columns;
        $data['data'] = $result;

        $this->load->view('csv', $data);
    }



	public function retrieve_hours_from_reaction($num_of_gaps, $scale, $start_date, $end_date, $type, $min_eaten, $initial_hour, $food_filter)
	{
		// jtStartIndex=0&jtPageSize=10&jtSorting=meal_date%20ASC
		$index = intval($_GET['jtStartIndex']);
		$page_size = intval($_GET['jtPageSize']);
		
		$sort = 'NumOfFood DESC';
		if (isset($_GET['jtSorting']))
		{
			$sort = filter_var(html_entity_decode($_GET['jtSorting']), FILTER_SANITIZE_STRING);
		}
		
		$num_of_gaps = intval($num_of_gaps);
        $min_eaten = intval($min_eaten);
        $initial_hour = intval($initial_hour);
		$scale = filter_var($scale, FILTER_SANITIZE_STRING);

		$start_date = DateTime::createFromFormat('m-d-Y', $start_date);
		$end_date = DateTime::createFromFormat('m-d-Y', $end_date);
		
		$type = filter_var($type, FILTER_SANITIZE_STRING);
		$type = urldecode($type);

        $food_filter = urldecode($food_filter);
        $food_filter = filter_var($food_filter, FILTER_SANITIZE_STRING);


        $this->load->model('Reaction_model');
        $id = $this->Reaction_model->get_type_id($type);

        $this->load->model('Result_model');

        // build json for jTables
		$json = array();
		$json['Result'] = "OK";
		$json['Records'] = $this->Result_model->hours_from_reaction($index, $page_size, $num_of_gaps, $scale, $sort, $start_date->format('Y-m-d'), $end_date->format('Y-m-d'), $id, $min_eaten, $initial_hour, $food_filter);
		
		$data = array();
		$data['json'] = $json;
		
		$this->load->view('json_encode', $data);
	}

    /**
     * Used to examine jQuery full calendar plug in
     */
    public function calendar()
    {
        $this->load->helper('url');
        $data = array();
        $this->load->view('calendar_view', $data);
    }

    public function get_calendar_data()
    {
        $start = intval($_GET['start']);
        $end = intval($_GET['end']);

        $this->load->model('Result_model');
        $events = $this->Result_model->timeline_data($start, $end);
        $data = array();
        $data['json'] = $this->transform_calendar_data($events);

        $this->load->helper('url');
        $this->load->view('json_encode', $data);
    }


	public function timeline()
	{
		$this->load->helper('url');

		
		$data = array();
		$this->load->view('timeline_view', $data);
	}
	
	public function get_timeline_data()
	{
        $this->load->model('Result_model');
		$timeline = $this->Result_model->timeline_data();
		$data = array();
		$data['json'] = $this->transform_timeline_data($timeline);
		$this->load->view('json_encode', $data);
	}

    /**
     * Toy around with new jQuery Full Calendar plug in
     *
     * @param $timeline
     * @return array
     */
    private function transform_calendar_data($timeline)
    {
        $events = array();
        foreach($timeline as $event)
        {
            $temp = new stdClass();
            $temp->title = ucwords(strtolower($event['Name']));
            $temp->start = $event['Date'] ;
            $temp->allDay = false;

            if ($event['Type'] == 'Reaction')
            {
                $temp->color = 'red';
            }
            else if ($event['Type'] == 'Environment')
            {
                $temp->color = 'green';
            }
            else if ($event['Type'] == 'Medicine')
            {
                $temp->color = 'white';
            }
            else
            {
                $temp->color = 'blue';
            }
            $events[] = $temp;
        }

        return $events;
    }


	private function transform_timeline_data($timeline)
	{
		$this->load->helper('url');
		
		$data = array();
		$data['dataTimeFormat'] = 'iso8601';
		$data['events'] = array();
		foreach($timeline as $line)
		{
			$temp = array();
			$temp['start'] = $line['Date'];
			$temp['title'] = $line['Name'];
			$temp['description'] = 'Id: ' . $line['Id'] . ' - ' . $line['Note'];

			if ($line['Type'] == 'Reaction')
			{
				$temp['icon'] = base_url() . 'js/timeline_2.3.0/timeline_js/images/dark-red-circle.png';
			}
			else if ($line['Type'] == 'Environment')
			{
				$temp['icon'] = base_url() . 'js/timeline_2.3.0/timeline_js/images/medium-gray-circle.png';
			}
			else if ($line['Type'] == 'Medicine')
			{
				$temp['icon'] = base_url() . 'js/timeline_2.3.0/timeline_js/images/dark-green-circle.png';
			}
			
			$data['events'][] = $temp; 
		}
		
		return $data;
	}
}