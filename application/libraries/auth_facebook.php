<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication {
    /*
    * The CodeIgniter Instance
    */
    public $ci;

    /*
    * The Type of Auth Being Used
    */
    public $type;

    /*
    * The Constructor Method
    */
    public function __construct() {
        $this->ci = &get_instance();
    }

    public function notifyFacebookLogin($result) {

    }
}