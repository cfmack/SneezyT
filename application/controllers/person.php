<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Person extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Person_model');
    }

    public function index()
	{
        $data = array();



        $this->load->view('person_view', $data);
    }

    public function add()
    {

        $person_name = html_entity_decode($_POST['name']);
        $is_default = ($_POST['default'] == 'true'?true:false);
        $person_note = html_entity_decode($_POST['note']);

        $this->Person_model->add($person_name, $is_default, $person_note);
    }

    public function update()
    {
        $person_id = intval($_POST[ 'PersonId']);
        $person_name = html_entity_decode($_POST['PersonName']);
        $is_default = ($_POST['IsDefault'] == '1'?1:0); // could use intval but want to convert to true/false
        $person_note = html_entity_decode($_POST['PersonNote']);

        $this->Person_model->update($person_id, $person_name, $is_default, $person_note);

        $data = array();
        $data['json'] = array("Result" => "OK");
        $this->load->view('json_encode', $data);
    }

    public function delete()
    {
        $person_id = intval($_POST[ 'PersonId']);
        $this->Person_model->delete($person_id);

        $data = array();
        $data['json'] = array("Result" => "OK");
        $this->load->view('json_encode', $data);
    }


    public function inventory()
    {
        $data = array();

        $index = intval($_GET['jtStartIndex']);
        $page_size = intval($_GET['jtPageSize']);

        $sort = 'PersonName ASC ';
        if (isset($_GET['jtSorting']))
        {
            $sort = html_entity_decode($_GET['jtSorting']);
        }


        $result = $this->Person_model->inventory($index, $page_size, $sort);
        $data['json'] = array("Result" => "OK", "Records" => $result );
        $this->load->view('json_encode', $data);
    }

    public function change()
    {
        $data = array();

        $result = $this->Person_model->inventory();
        $data['persons'] =  $result;

        $active = $this->Person_model->get_active_person();
        $data['active'] = $active;

        $this->load->view('person_change_view', $data);
    }

    /**
     * Set the appropriate session values for the active person
     *
     */
    public function do_change()
    {
        $person_id = intval($_POST[ 'PersonId']);
        $person = $this->Person_model->get_person($person_id);


        $data = array();
        $data['result'] = $this->Person_model->set_active_person($person->PersonId, $person->PersonName);

        $data['alert'] = 'alert-success';
        if (!$data['result'])
        {
            $data['alert'] = 'alert-error';
        }

        $this->load->view('change_person_result', $data);
    }

}