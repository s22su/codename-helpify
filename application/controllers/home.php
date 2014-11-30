<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'common.php';

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$common = new Common($this);
	}
	
	public function index() {
		// pre($this->authentication->getUserData());
		$this->twiggy->template($this->currentLanguage.'/home')->display();
	}

	public function about() {
		$this->twiggy->template($this->currentLanguage.'/about')->display();
	}

    public function et() {
        $this->twiggy->template($this->currentLanguage.'/estonian')->display();
    }
}