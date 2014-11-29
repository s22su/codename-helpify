<?php
/**
 * @author Kristjan Siimson <dev@siimsoni.ee>
 */
class Users_Model extends CI_Model {
    const TABLE = 'users';

    var $email;
    var $name;
    var $first_name;
    var $last_name;
    var $facebook_profile;
    var $verified;
    var $description;
    var $facebook_id;

    function existsUserWithFacebookId($facebookId)
    {
        $this->db->from('users');
        $this->db->where('facebook_id', $facebookId);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    function createWithFacebookData($data)
    {
        $this->db->insert(self::TABLE, $data);
    }
}