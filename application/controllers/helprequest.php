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


			$this->twiggy->set('entries', $entries);
			$this->twiggy->set('submitted', 1);
		}

		$this->twiggy->template($this->currentLanguage.'/helprequest.index')->display();
	}

	public function add() {
		// TODO: hardcoded also, should add the field in database
		$country = 'Estonia';

		if($this->input->post()) {

			$this->load->model('helprequest_model');
			$this->load->spark('ja-geocode/1.2.0');

			$user = $this->authentication->getUserData();

			$formData = array(
				'user_id'   => $user->user_id,
				'category'  => $this->input->post('category', true) ?: null,
				'date'      => strtotime($this->input->post('date', true)) ?: time(),
				'city'      => $this->input->post('city', true) ?: null,
				'address'   => $this->input->post('address', true) ?: null,
				'is_active' => true,
			);

			// Geocode, OMFG so safe
			$address = $this->ja_geocode->query($country .' '. $formData['city'] .' '. $formData['city']);

			$formData['lat'] = $this->ja_geocode->lat;
			$formData['lon'] = $this->ja_geocode->lng;
			$formData['address_formatted'] = $this->ja_geocode->address;

			$entries = $this->helprequest_model->addHelpRequest($formData);

			redirect(site_url('/helprequest'));
		}

		$this->twiggy->set('now', date('m/d/Y', time()));
		$this->twiggy->set('view_url', site_url('/helprequest/view'));
        $this->twiggy->template($this->currentLanguage .'/help_request.add')->display();
	}

	public function view ()	{
		$segment = 3;

		if ($this->uri->segment($segment) === FALSE)
		{
		    $view_id = -1;
		}
		else
		{
		    $view_id = $this->uri->segment($segment);
		}

		$this->load->model('helprequest_model');
		$this->load->model('users_model');

		$helpRequest = $this->helprequest_model->getById($view_id);
		$user        = $this->users_model->getById($helpRequest->user_id);

		// Handle error
		if (!$helpRequest || !$helpRequest->user_id || $user) {

			$this->twiggy->set('record', FALSE);
		}

		$this->twiggy->set('record', TRUE);
		$this->twiggy->set('request_user', $user);
		$this->twiggy->set('request', $helpRequest);

		$this->twiggy->template($this->currentLanguage .'/help_request.view')->display();
	}
}
