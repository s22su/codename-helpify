<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'common.php';

class Do_Help_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if(false === $this->authentication->isLoggedIn())
        {
            log_message('warning', 'Unauthenticated user attempted to access profile page');
            redirect(site_url());
        }
        $common = new Common($this);
    }

    public function do_help()
    {
        $user = $this->authentication->getUserData();
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $cacheId = 'facebook_profileimage_' . $user->id;
        $this->load->library('facebook');
        if(! $profileImage = $this->cache->file->get($cacheId)) {
            $profileImage = $this->facebook->getProfilePictureUrl($user->id, 300, 300);
            $this->cache->file->save($cacheId, $profileImage);
        }
        $this->twiggy->set('profile_image', $profileImage);
        $this->twiggy->template($this->currentLanguage.'/do_help')->display();
    }
}