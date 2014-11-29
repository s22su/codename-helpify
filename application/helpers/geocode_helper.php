<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('geocode')) {
    function geocode($city, $address) {
        $ci = &get_instance();
        $ci->load->spark('ja-geocode/1.2.0');
        $ci->ja_geocode->query(sprintf('%s, %s', $city, $address));

        return array(
            'latitude' => $ci->ja_geocode->lat,
            'longitude' => $ci->ja_geocode->lng,
            'address' => $ci->ja_geocode->address
        );
    }
}