<?php
class Helper_Profile_Model extends CI_Model {
    const TABLE = 'helper_profiles';

    var $id;
    var $user_id;
    var $city;
    var $address;
    var $address_formatted;
    var $lat;
    var $lon;
    var $created_at;
    var $deleted_at;
}
