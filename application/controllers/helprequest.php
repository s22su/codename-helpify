<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'common.php';
class Helprequest extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$common = new Common($this);
	}

	public function index() {
		// pre($this->authentication->getUserData());

		//$this->twiggy->template()->display();
	}

	public function add() {

        $this->twiggy->template($this->currentLanguage .'/help_request')->display();
	}
}
