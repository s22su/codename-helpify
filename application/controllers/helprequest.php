<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
include 'common.php';
class Helprequest extends CI_Controller {

	public function __construct() {
		parent::__construct();

        // Deny if not authenticated
        if(false === $this->authentication->isLoggedIn())
        {
            log_message('warning', 'Unauthenticated user attempted to access profile page');
            redirect(site_url());
        }

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
			if($this->input->get('date_start')) {
				$filters['date_start'] = strtotime($this->input->get('date_start'));
			}

			if($this->input->get('date_start')) {
				$filters['date_start'] = strtotime($this->input->get('date_start'));
			}

			$entries = $this->helprequest_model->getHelpRequests($filters);

			$this->twiggy->set('entries', $entries);
			$this->twiggy->set('submitted', 1);
		}

        $this->load->model('helprequest_model');
        $this->twiggy->set('cities', $this->helprequest_model->getCitiesWithHelpRequests());

		$this->twiggy->set('now', date('m/d/Y', time()));
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

			redirect(site_url('/my_helprequests'));
		}

		$this->twiggy->set('now', date('m/d/Y', time()));
		$this->twiggy->set('view_url', site_url('/helprequest/view'));
        $this->twiggy->template($this->currentLanguage .'/help_request.add')->display();
	}


	public function my_helprequests() {
		$this->load->model('helprequest_model');

		$my = $this->helprequest_model->getHelpRequestsByUserId(
			$this->authentication->getUserData()->user_id
		);

		$this->twiggy->set('entries', $my);
		$this->twiggy->template($this->currentLanguage .'/helprequest.my')->display();

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

        $this->load->model('helper_to_help_request_model');
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
        $cacheId = 'facebook_profileimage_' . $user->facebook_id;
        $this->load->library('facebook');
        if(! $profileImage = $this->cache->file->get($cacheId)) {
            $profileImage = $this->facebook->getProfilePictureUrl($user->facebook_id, 300, 300);
            $this->cache->file->save($cacheId, $profileImage);
        }

        $this->load->model('help_request_message');
        $this->twiggy->set('messages', $this->help_request_message->listHelpRequestMessagesForHelper($helpRequest->id, $user->user_id));

        $this->twiggy->set('profile_image', $profileImage);
		$this->twiggy->set('record', TRUE);
		$this->twiggy->set('request_user', $user);
		$this->twiggy->set('request', $helpRequest);

		$this->twiggy->template($this->currentLanguage .'/help_request.view')->display();
	}

    public function notify() {
        $user = $this->authentication->getUserData();
        $viewingUserId = $user->user_id;
        $helprequestId = $this->uri->segment(2);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('description', 'description', 'trim|required|min_length[1]|max_length[1024]|xss_clean');

        if(false === $this->form_validation->run()) {
            redirect('/helprequest');
        }

        $data = array(
          'do_help_user_id' => $viewingUserId,
          'help_request_id' => $helprequestId,
          'accepted' => '0'
        );
        $this->load->model('helper_to_help_request_model');

        if(!$this->helper_to_help_request_model->userAssociatedWithRequest($viewingUserId, $helprequestId)) {
            $this->helper_to_help_request_model->insert($data);
        }

        $this->load->model('help_request_message');
        $this->help_request_message->insert(
            array(
                'help_request_id' => $helprequestId,
                'user_id' => $viewingUserId,
                'description' => $this->input->post('description')
            )
        );

        redirect('/helprequest/view/' . $helprequestId);
    }
}