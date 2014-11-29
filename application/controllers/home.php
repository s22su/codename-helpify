<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include 'common.php';

class Home extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$common = new Common($this);
		$common->setup();
	}
	
	public function index() {
		$this->twiggy->template('home')->display();
		//$this->twiggy->display();
	}
}