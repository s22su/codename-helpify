<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('geocode')) {
    function geocode($city) {
        $ci = &get_instance();
        $ci->load->spark('ja-geocode/1.2.0');
        $ci->ja_geocode->query($city);

        if('ZERO_RESULTS' === $ci->ja_geocode->status) {
            return false;
        }

        return array(
            'latitude' => $ci->ja_geocode->lat,
            'longitude' => $ci->ja_geocode->lng,
            'city' => $ci->ja_geocode->city
        );
    }
}