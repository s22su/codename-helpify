<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication {
    /*
    * The CodeIgniter Instance
    */
    public $ci;

    /*
    * The Type of Auth Being Used
    */
    public $data;

    /*
    * The Constructor Method
    */
    public function __construct() {
        $this->ci = &get_instance();
    }

    public function isLoggedIn() {
        return null !== $this->getUserData();
    }

    public function getUserData() {
        if(null === $this->data) {
            $session = $this->ci->get_instance()->session;
            $data = $session->userdata('auth');
            if(false !== $data) {
                return $data;
            }
        }
        return $this->data;
    }

    public function setUserData($data) {
        $session = $this->ci->get_instance()->session;
        $session->set_userdata('auth', $data);
    }

    public function logout() {
        $session = $this->ci->get_instance()->session;
        $session->set_userdata('auth', null);
    }
}