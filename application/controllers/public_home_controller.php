<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'common.php';

class Public_Home_Controller extends CI_Controller {

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

	public function team() {
		$this->twiggy->template($this->currentLanguage.'/team')->display();
	}

    public function et() {
        $this->twiggy->template($this->currentLanguage.'/estonian')->display();
    }

    public function volunteer() {
        $this->twiggy->template($this->currentLanguage.'/volunteer')->display();
    }
}
