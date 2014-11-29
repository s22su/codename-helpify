<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'common.php';

class Do_Help_Controller extends CI_Controller {

    protected $user;

    public function __construct() {
        parent::__construct();

        if(false === $this->authentication->isLoggedIn())
        {
            log_message('warning', 'Unauthenticated user attempted to access profile page');
            redirect(site_url());
        }
        $common = new Common($this);
        $this->load->library('input');
        $this->load->model('helper_profile_model');
        $this->user = $this->authentication->getUserData();
    }

    public function do_help() {
        // Redirect to next step if data already exists
        if($this->helper_profile_model->hasUserActiveHelperProfile($this->user->user_id)) {
            redirect('/helprequest');
        }

        // Process the submitted information if exists
        if('POST' === $this->input->server('REQUEST_METHOD')) {
            $this->input($this->input->post());
        }

        // If we have not been redirected to next step, display the form
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $cacheId = 'facebook_profileimage_' . $this->user->facebook_id;
        $this->load->library('facebook');
        if(! $profileImage = $this->cache->file->get($cacheId)) {
            $profileImage = $this->facebook->getProfilePictureUrl($this->user->facebook_id, 300, 300);
            $this->cache->file->save($cacheId, $profileImage);
        }
        $this->twiggy->set('profile_image', $profileImage);
        $this->twiggy->set('error', $this->session->flashdata('error'));
        $this->twiggy->template($this->currentLanguage.'/do_help')->display();
    }

    protected function input($post) {
        $this->load->helper('geocode_helper');
        $geocode = geocode($this->input->post('address'), $this->input->post('city'));

        if(false === $geocode) {
            $this->session->set_flashdata('error', 'Location not found. Please enter a new location');
            return false;
        }

        $this->helper_profile_model->insert(
            array(
                'user_id' => $this->user->user_id,
                'city' => $this->input->post('city'),
                'address' => $this->input->post('address'),
                'address_formatted' => $geocode['address'],
                'lat' => $geocode['latitude'],
                'lon' => $geocode['longitude'],
                'hobbies' => $this->input->post('hobbies'),
                'experience' => $this->input->post('experience')
            )
        );
    }
}