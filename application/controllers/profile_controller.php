<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'common.php';

class Profile_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if(false === $this->authentication->isLoggedIn())
        {
            log_message('warning', 'Unauthenticated user attempted to access profile page');
            redirect(site_url());
        }

        $common = new Common($this);
    }

    public function need_help()
    {
        $this->twiggy->template($this->currentLanguage.'/need_help')->display();
    }

    public function do_help()
    {
        $this->twiggy->template($this->currentLanguage.'/do_help')->display();
    }
}