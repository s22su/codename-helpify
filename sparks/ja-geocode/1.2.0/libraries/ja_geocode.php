<?php

/**
 * 
 *
 * A spark to handle geocoding of locations (or reverse lookup of given latitude and longitude).
 *
 * @package		Geocode
 * @author		Johan André <johanandre@me.com>
 *
 *
 */
 
class JA_Geocode
{
	public $request_url 	= "https://0cc7eee8-89a3780cf261.my.apitools.com/geocode/json?";
	
	public $sensor 			= "false";
	public $language 		= "en";
	
	public $status			= false;
	public $response		= false;
	public $country			= false;
	public $country_short	= false;
	public $region			= false;
	public $region_short	= false;
	public $city			= false;
	public $address			= false;
	public $zipcode			= false;
	public $lat				= false;
	public $lng				= false;
	public $location_type	= false;
	
	public function __construct()
	{
		if(!function_exists('curl_init'))
		{
			show_error('CURL is needed and not available on this configuration. Please install it to use the Geocode-library.');
		}
		
	}
	
	public function query()
	{
		$args = func_get_args();
		
		if(count($args) == 2)
		{
			$query = 'latlng=' . $args[0] . ',' . $args[1] . '&language=' . $this->language . '&sensor=' . $this->sensor;
		} else {
			$query = 'address=' . urlencode(stripslashes($args[0])) . '&language=' . $this->language . '&sensor=' . $this->sensor;
		}
		$req = curl_init();
		
		curl_setopt($req, CURLOPT_URL, $this->request_url . $query);
		curl_setopt($req, CURLOPT_RETURNTRANSFER, 1);
		$this->response = json_decode(curl_exec($req));
		curl_close($req);
		
		$this->status = $this->response->status;
		
		if($this->status == 'OK')
		{
			
			$country 					= $this->get_component("country");
			
			if($country) 
			{
				$this->country			= $country->long_name;
				$this->country_short	= $country->short_name;
			}
			
			$region 					= $this->get_component("administrative_area_level_1");
			
			if($region) 
			{	
				$this->region	 		= $region->long_name;
				$this->region_short		= $region->short_name;
			}
			
			$city 						= $this->get_component("postal_town");
			
			if($city) 
			{
				$this->city				= $city->short_name;
			}
			
			$zipcode 					= $this->get_component("postal_code");
			
			if($zipcode) 
			{
				$this->zipcode 			= $zipcode->short_name;
			}
			
			$this->address 				= $this->response->results[0]->formatted_address;
			
			$this->lat 					= $this->response->results[0]->geometry->location->lat;
			$this->lng 					= $this->response->results[0]->geometry->location->lng;
			$this->location_type 		= $this->response->results[0]->geometry->location_type;
		
			return $this->response;
			
		} else { 
			return false;
		}
	}
	
	function get_component($type) {
		foreach($this->response->results[0]->address_components as $k => $found){
			if(in_array($type, $found->types)){
				return $found;
			} 
		}
		return false;
	}
}