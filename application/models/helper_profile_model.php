<?php
class Helper_Profile_Model extends CI_Model {
    const TABLE = 'helper_profiles';

    var $id;
    var $user_id;
    var $city;
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
        return $this->db->count_all_results() > 0;
    }

    public function getProfileForUser($userId) {
        $this->db->from(self::TABLE);
        $this->db->where(self::TABLE . '.user_id', $userId);
        $this->db->where(self::TABLE . '.deleted_at IS NULL', null, false);
        $this->db->join('users', 'users.user_id = '.self::TABLE.'.user_id');
        $query = $this->db->get();
        foreach($query->result() as $row) {
            return $row;
        }
        return false;
    }
}
