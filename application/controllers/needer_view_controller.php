<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'common.php';
class Needer_View_Controller extends CI_Controller {

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

    public function view()	{
        $segment = 3;

        if ($this->uri->segment($segment) === FALSE)
        {
            $view_id = -1;
        }
        else
        {
            $view_id = $this->uri->segment($segment);
        }

        $this->load->model('helprequest_model');
        $this->load->model('users_model');

        $helpRequest = $this->helprequest_model->getById($view_id);
        $user        = $this->users_model->getById($helpRequest->user_id);
        //$user = $this->users_model;

        //pre($user);

        // Handle error
        if (!$helpRequest || !$helpRequest->user_id || !$user) {
            $this->twiggy->set('record', FALSE);
            //die;
        }
        else {

            $this->load->model('helper_to_help_request_model');
            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $cacheId = 'facebook_profileimage_' . $user->facebook_id;
            $this->load->library('facebook');
            if(! $profileImage = $this->cache->file->get($cacheId)) {
                $profileImage = $this->facebook->getProfilePictureUrl($user->facebook_id, 300, 300);
                $this->cache->file->save($cacheId, $profileImage);
            }

            $this->load->model('help_request_message');
            $helper_messages = $this->help_request_message->listHelpRequestMessagesForHelper($helpRequest->id, $user->user_id);
            $this->twiggy->set('messages', $helper_messages);

            //pre($helper_messages);
            // die;

            $this->twiggy->set('profile_image', $profileImage);
            $this->twiggy->set('record', TRUE);
            $this->twiggy->set('request_user', $user);
            $this->twiggy->set('request', $helpRequest);
        }

        $this->twiggy->template($this->currentLanguage .'/help_request.view')->display();
    }
}