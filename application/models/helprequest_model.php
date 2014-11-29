<?php
class Helprequest_Model extends CI_Model {
    const TABLE = 'help_request';

    var $id;
    var $user_id;
    var $category;
    var $city;
    var $address;
    var $address_formatted;
    var $date;
    var $lat;
    var $lon;
    var $created_ad;
    var $is_active;

    /**
     * Get help request entries
     * @param  array $filters array of filters
     * @return array found entries
     */
    function getHelpRequests($filters = array()) {
    	$this->db->from('help_requests');

    	// city filter
    	if(isset($filters['city']) && $filters['city']) {
    		$this->db->where('city', $filters['city']);	
    	}

    	// category filter
    	if(isset($filters['category']) && $filters['category']) {
    		$this->db->where('category', $filters['category']);	
    	}

		// date filter
    	if(isset($filters['date']) && $filters['date']) {
    		$this->db->where('date', $filters['city']);
    	}

    	$res = $this->db->get();
        
        if($res->num_rows() === 0) {
        	return false;
        }

        return $res->result_array();
    }

}