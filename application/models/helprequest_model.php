<?php
class Helprequest_Model extends CI_Model {
    const TABLE = 'help_requests';

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

    	$this->db->join('users', 'users.user_id = help_requests.user_id');

    	$res = $this->db->get();

        if($res->num_rows() === 0) {
        	return false;
        }

        $rows = $res->result_array();
        foreach($rows as &$row) {
        	$row['converted_date'] = $this->convertTimestamp($row['date']);
        }

        return $rows;
    }

    private function convertTimestamp($timestamp) {
    	$arr = array(
    		'dateY' => date('Y-m-d', $timestamp),
    		'day'   => date('d', $timestamp),
    		'monthName3' => date('M', $timestamp),
    		'year' => date('Y', $timestamp)
    	);

    	return $arr;
    }

    /**
     * Insert new help request to page
     *
     * @param  array $data
     * @return array inserted entry
     */
    function addHelpRequest($data = array()) {

        $this->db->from('help_requests');
        return $this->db->insert(self::TABLE, $data);
    }
}
