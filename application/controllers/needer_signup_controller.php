<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'common.php';
class Needer_Signup_Controller extends CI_Controller {

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

    public function add() {

        //TOD O: hardcoded also, should add the field in database
        $country = 'Estonia';

        if($this->input->post()) {

            $this->load->model('helprequest_model');
            $this->load->spark('ja-geocode/1.2.0');

            $user = $this->authentication->getUserData();

            $formData = array(
                'user_id'     => $user->user_id,
                'category'    => $this->input->post('category', true) ?: null,
                'date'        => strtotime($this->input->post('date', true)) ?: time(),
                'city'        => $this->input->post('city', true) ?: null,
                'description' => $this->input->post('desc', true) ?: null,
                'is_active'   => true,
            );

            // Geocode, OMFG so safe
            $address = $this->ja_geocode->query($country .' '. $formData['city'] .' '. $formData['city']);

            $formData['lat'] = $this->ja_geocode->lat;
            $formData['lon'] = $this->ja_geocode->lng;

            $entries = $this->helprequest_model->addHelpRequest($formData);

            redirect(site_url('/my_helprequests'));
        }

        $this->twiggy->set('now', date('m/d/Y', time()));
        $this->twiggy->set('view_url', site_url('/helprequest/view'));
        $this->twiggy->template($this->currentLanguage .'/help_request.add')->display();
    }
}
