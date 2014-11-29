<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! defined('ENVIRONMENT') || ENVIRONMENT !== 'development') exit('Development mode only');

class Facebook_Controller extends CI_Controller {

    public function authentication()
    {
        $this->load->spark('codeigniter-oauth/0.0.2');
        $this->oauth->authorize('facebook');
    }

    public function callback()
    {
        $this->load->spark('codeigniter-oauth/0.0.2');
        $result = $this->oauth->authorize_result('facebook');
        if('success' !== $result->status) {
            log_message('Authentication failed 1');
            return;
        }
        $auth = $this->oauth->access('facebook', $result->token);
        if('success' !== $auth->status) {
            log_message('Authentication failed 2');
            return;
        }
        /**
         * id           10152860440812866
         * email        kristjan.siimson@gmail.com
         * first_name   Kristjan
         * last_name    Siimson
         * link         https://www.facebook.com/app_scoped_user_id/10152860440812866/
         * locale       en_GB
         * name         Kristjan Siimson
         * timezone     2
         * updated_time 2014-11-19T17:09:29+0000
         * verified     true
         */
        $user = $auth->user;
        $this->load->model('users_model');
        $this->load->database();
        $result = $this->users_model->getByFacebookId($user->id);
        if(0 === count($result)) {
            $this->users_model->createWithFacebookData(
                array(
                    'facebook_id' => $user->id ? $user->id : null,
                    'email' => $user->email ? $user->email : null,
                    'first_name' => $user->first_name ? $user->first_name : null,
                    'last_name' => $user->last_name ? $user->last_name : null,
                    'facebook_profile' => $user->link ? $user->link : null,
                    'name' => $user->name ? $user->name : null,
                    'verified' => $user->verified ? $user->verified : null
                )
            );
            $result = $this->users_model->getByFacebookId($user->id);
        }
        var_dump($result);
        //$this->load->library('Auth_Facebook');
        //$this->auth_facebook->callback($_SERVER['QUERY_STRING']);
    }
}