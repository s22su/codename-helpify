<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'common.php';
class Helprequest extends CI_Controller {

	public function __construct() {
		parent::__construct();
		new Common($this);
	}

	public function index() {
		// pre($this->authentication->getUserData());

		if($this->input->get('submitted')) {
			$this->load->model('helprequest_model');

			$filters = array();

			// city filter
			if($this->input->get('city')) {
				$filters['city'] = $this->input->get('city');
			}

			// cat filter
			if($this->input->get('category')) {
				$filters['category'] = $this->input->get('category');
			}

			// date filter
			if($this->input->get('date')) {
				$filters['date'] = $this->input->get('date');
			}

			$entries = $this->helprequest_model->getHelpRequests($filters);

			pre($entries);

			$this->twiggy->set('entries', $entries);
		}

		$this->twiggy->template($this->currentLanguage.'/helprequest.index')->display();
	}

	public function add()
	{

		if($this->input->post()) {
			$this->load->model('helprequest_model');

			$formData = array(
				// 'user_id'  =>
				'category' => $this->input->post('category', true),
				'date'     => $this->input->post('date', true),
				'city'     => $this->input->post('city', true),
				'address'  => $this->input->post('address', true),
			);

			// TODO: hack not working
			pre($this->authentication->getUserData());
			// pre($this);
			// $entries = $this->helprequest_model->addHelpRequest($formData);
			// pre($entries);

			// pre($entries);

			// $this->twiggy->set('entries', $entries);
		}

        $this->twiggy->template($this->currentLanguage .'/help_request')->display();
	}
}
