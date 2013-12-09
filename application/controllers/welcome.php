<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->helper('url');
        $this->load->database();

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->helper('language');
        $this->load->view('metadata', array(), true);
    }

    public function index()
    {

        // remove these lines to start working on log ins again
        // default dev password is: password
        if (!$this->ion_auth->logged_in())
        {
            //redirect them to the login page
            redirect('welcome/login', 'refresh');
        }
        else
        {

            $this->welcome();
        }
    }

    /**
     * Test function to get around logging in
     *
     * @todo DELETE
     */
    private function test()
    {
        $this->session->set_userdata('person_id', '1');
        $this->session->set_userdata('person_name', 'Test');
        $this->welcome();

        return;
    }


	public function login()
    {
        $data = array();
        $data['title'] = "Login";
        $data['head'] = $this->load->view('metadata', array(), true);

        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true)
        {
            //check to see if the user is logging in
            //check for "remember me"
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
            {
                //if the login is successful
                //redirect them back to the home page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect(base_url(), 'refresh');
            }
            else
            {
                //if the login was un-successful
                //redirect them back to the login page
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('welcome/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        }
        else
        {
            //the user is not logging in so display the login page
            //set the flash data error message if there is one
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );

            $this->load->view('auth/login', $data);
        }
    }

    //log the user out
    function logout()
    {
        $data = array();
        $data['title'] = "Logout";

        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('auth/login', 'refresh');
    }

    public function welcome()
    {
        $types = array('food'); // only pre-load food 

        $this->load->model('Person_model');
        $person = $this->Person_model->get_active_person();

        $data = array();
        $data['person_name'] = $person['person_name'];

        $data['head'] = $this->load->view('metadata', array(), true);
        $hide = false;

        $data['is_admin'] = false;
        if (($this->ion_auth->is_admin()))
        {
            $data['is_admin'] = true;
        }

        foreach($types as $type)
        {
            $category_data = array();

            $category_data['name'] = $type;
            $category_data['hide'] = $hide;

            $category_data['section'] = array();
            $category_data['section']['add'] = $this->load->view('add_view', array('header'=>ucfirst($type), 'name'=>$type), true);

            $json = $this->load->view('inventory_json', array('type'=>ucfirst($type)), true);
            $category_data['section']['inventory'] = $this->load->view('inventory_view', array('name'=>$type, 'json'=>$json), true);

            $category_data['section']['download'] = $this->load->view('category_download_view', array('name'=>$type), true );
            $data[$type] = $this->load->view('category_view', $category_data, true);


            $hide = true;
        }


        $this->load->view('nav_view', $data);
    }

}
