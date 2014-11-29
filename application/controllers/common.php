<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common {

	public function __construct($contorller) {
		$this->twiggy = $contorller->twiggy;
		$this->config = $contorller->config;
		return $this;
	}

	public function setup() {
		return $this;
	}
}