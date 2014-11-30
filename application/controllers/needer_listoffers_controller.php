<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'common.php';
class Needer_Listoffers_Controller extends CI_Controller {

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

    public function my_helprequests() {
        $this->load->model('helprequest_model');

        $my = $this->helprequest_model->getHelpRequestsByUserId(
            $this->authentication->getUserData()->user_id
        );

        $this->twiggy->set('entries', $my);
        $this->twiggy->template($this->currentLanguage .'/helprequest.my')->display();

    }
}