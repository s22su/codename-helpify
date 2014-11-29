<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common {

	public function __construct($controller) {
		$this->twiggy = $controller->twiggy;
		$this->config = $controller->config;
		$this->lang   = $controller->lang;

		$this->lang->load('web_texts', 'english');

		// set global template vars
		$this->twiggy->set('base_url', $this->config->item('base_url'));
		$this->twiggy->set('lang_texts', $this->lang->language);

		return $this;
	}

	public function setup() {
		return $this;
	}
}