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
        return $this->db->count_all_results() > 0;
    }

    function createWithFacebookData($data)
    {
        $this->db->insert(self::TABLE, $data);
    }

    function getRecordByFacebookId($facebookId)
    {
        $this->db->from('users');
        $this->db->where('facebook_id', $facebookId);
        $query = $this->db->get();
        foreach($query->result() as $row) {
            return $row;
        }
        throw new ApplicationException('No user was found with specified Facebook ID');
    }

    function getById($id)
    {
        $this->db->from('users');
        $this->db->where('user_id', $id);

        $query = $this->db->get();
        foreach($query->result() as $row) {
            return $row;
        }
    }

    function getUserCount() {
        // return $this->db->count_all('users');
        $this->db->select('COUNT(user_id) as count');
        $this->db->from('users');
        // $this->db->where(array('image !=' => ''));
        $query = $this->db->get();

        if ($query->num_rows() > 0 )
        {
            $row = $query->row();
            return $row->count;
        }
        return 0;
    }
}
