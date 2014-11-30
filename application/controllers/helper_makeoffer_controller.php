<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'common.php';
class Helper_Makeoffer_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // Deny if not authenticated
        if(false === $this->authentication->isLoggedIn())
        {
            log_message('warning', 'Unauthenticated user attempted to access profile page');
            redirect(site_url());
        }

        new Common($this);
    }

    public function notify() {
        $user = $this->authentication->getUserData();
        $viewingUserId = $user->user_id;
        $helprequestId = $this->uri->segment(2);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'description', 'trim|required|min_length[1]|max_length[1024]|xss_clean');

        if(false === $this->form_validation->run()) {
            redirect('/helprequest');
        }

        $data = array(
            'do_help_user_id' => $viewingUserId,
            'help_request_id' => $helprequestId,
            'accepted' => '0'
        );
        $this->load->model('helper_to_help_request_model');

        //pre($user);
        //die;

        if(!$this->helper_to_help_request_model->userAssociatedWithRequest($viewingUserId, $helprequestId)) {
            $this->helper_to_help_request_model->insert($data);
        }

        $this->load->model('help_request_message');
        $this->help_request_message->insert(
            array(
                'help_request_id' => $helprequestId,
                'user_id' => $viewingUserId,
                'description' => $this->input->post('description')
            )
        );

        redirect('/helprequest/view/' . $helprequestId);
    }
}