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

    function getByFacebookId($facebookId)
    {

        $this->db->from('users');
        $this->db->where('facebook_id', $facebookId);
        $result = $this->db->get();

        $result->num_rows(); // 6
        $result->last_row(); // array()

        return $result->num_rows();

        //return $query->result();
    }

    function createWithFacebookData($data)
    {
        $this->db->insert(self::TABLE, $data);
    }
}