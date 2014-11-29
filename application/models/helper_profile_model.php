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
    var $hobbies;
    var $experience;
    var $created_at;
    var $deleted_at;

    public function insert($data) {
        $this->db->insert(self::TABLE, $data);
    }

    public function hasUserActiveHelperProfile($userId) {
        $this->db->from(self::TABLE);
        $this->db->where('user_id', $userId);
        $this->db->where('deleted_at IS NULL', null, false);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }
}
