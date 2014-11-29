<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
            $this->session->set_flashdata('message', 'Authentication failed');
            log_message('Authentication failed 1');
            redirect(site_url());
        }
        $auth = $this->oauth->access('facebook', $result->token);
        if('success' !== $auth->status) {
            $this->session->set_flashdata('message', 'Authentication failed');
            log_message('Authentication failed 2');
            redirect(site_url());
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
        $this->load->database();
        $this->load->model('users_model');
        if(false === $this->users_model->existsUserWithFacebookId($user->id)) {
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
        }
        $this->authentication->setUserData($user);
        $this->session->set_flashdata('message', 'Successfully logged in');
        redirect(site_url());
    }

    public function logout() {
        $this->authentication->logout();
        $this->session->set_flashdata('message', 'Successfully logged out');
        redirect(site_url());
    }
}