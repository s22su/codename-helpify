<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'common.php';
class Helper_Search_Controller extends CI_Controller {

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

    public function index() {
        if($this->input->get('submitted')) {
            $this->load->model('helprequest_model');

            $filters = array();

            // city filter
            if($this->input->get('city')) {
                $filters['city'] = $this->input->get('city');
            }

            // cat filter
            if($this->input->get('category')) {
                $filters['category'] = $this->input->get('category');
            }

            // date filter
            if($this->input->get('date_start')) {
                $filters['date_start'] = strtotime($this->input->get('date_start'));
            }

            if($this->input->get('date_start')) {
                $filters['date_start'] = strtotime($this->input->get('date_start'));
            }

            $entries = $this->helprequest_model->getHelpRequests($filters);

            $this->twiggy->set('entries', $entries);
            $this->twiggy->set('submitted', 1);
        }

        $this->load->model('helprequest_model');
        $this->twiggy->set('cities', $this->helprequest_model->getCitiesWithHelpRequests());

        $this->twiggy->set('now', date('m/d/Y', time()));
        $this->twiggy->template($this->currentLanguage.'/helprequest.index')->display();
    }
}
