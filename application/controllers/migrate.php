<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! defined('ENVIRONMENT') || ENVIRONMENT !== 'development') exit('Development mode only');

class Migrate extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
    }

    public function current()
    {
        $this->migration->current();
    }

    public function latest()
    {
        $this->migration->latest();
    }

    public function version()
    {
        $this->migration->version($this->uri->segment(3));
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */