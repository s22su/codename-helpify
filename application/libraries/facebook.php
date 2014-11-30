<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Facebook {
    /*
    * The CodeIgniter Instance
    */
    public $ci;

    /*
    * The Constructor Method
    */
    public function __construct() {
        $this->ci = &get_instance();
    }

    public function getProfilePictureUrl($facebookId, $height, $width) {
        $json = file_get_contents('https://graph.facebook.com/' . $facebookId . "/picture?type=large&width=$width&height=$height&redirect=false");
        if(false !== ($response = json_decode($json)))
        {
            return $response->data->url;
        }
        return false;
    }
}