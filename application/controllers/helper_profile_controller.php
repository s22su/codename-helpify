<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Helper_Profile_Controller extends CI_Controller {

    public function __construct() {
        include_once 'common.php';
        parent::__construct();
        new Common($this);
    }

    public function view()
    {
        $this->load->model('helper_profile_model');
        $profile = $this->helper_profile_model->getProfileForUser($this->uri->segment(2));
        if(false === $profile) {
            redirect(site_url());
        }
        $this->load->library('facebook');
        $this->twiggy->set('user', $profile);
        $this->twiggy->set('profile_image', $this->facebook->getProfilePictureUrl($profile->facebook_id, 300, 300));
        $this->twiggy->template($this->currentLanguage .'/do_help_profile')->display();
    }
}