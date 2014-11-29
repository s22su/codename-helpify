<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Common {

	public function __construct(&$controller) {
		$this->twiggy = $controller->twiggy;
		$this->config = $controller->config;
		$this->lang   = $controller->lang;
		$this->uri   = $controller->uri;
		$this->router = $controller->router;

		$this->lang->load('web_texts', 'english');

		// set global template vars
		$this->twiggy->set('base_url', $this->config->item('base_url'));
		$this->twiggy->set('language', 'english');
		$this->twiggy->set('lang_texts', $this->lang->language);

		$controller->currentLanguage = $this->twiggy->language;

		$linkClasses = $this->menuLinkActiveClassSwitcher();
		$this->twiggy->set('menuLinkClasses', $linkClasses);		

		$controller->output->enable_profiler(TRUE);
	}


	/**
	 * Switch active link class
	 * @return array active links
	 */
	private function menuLinkActiveClassSwitcher() {
		$linkClasses = array(
			'about' => '',
			'home' => '',
		);

		//pre($this->router);

		switch($this->router->class) {
			case 'smth':
			break;
			default:
				switch($this->router->method) {
					case 'about':
						$linkClasses['about'] = 'active';
					break;
					default:
						$linkClasses['home'] = 'active';
					break;
				}

			break;
		}

		return $linkClasses;
	}
}