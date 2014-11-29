<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'common.php';

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$common = new Common($this);
	}
	
	public function index() {
		$this->twiggy->template($this->currentLanguage.'/home')->display();
	}

	public function about() {
		$this->twiggy->template($this->currentLanguage.'/about')->display();
	}
}