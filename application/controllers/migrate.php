<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }

    public function current()
    {
        var_export($this->migration->current());
    }

    public function latest()
    {
        var_export($this->migration->latest());
    }

    public function version()
    {
        var_export($this->migration->version($this->uri->segment(3)));
    }
}