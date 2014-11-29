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
//        var_dump(            sprintf(
//                'SELECT * FROM users WHERE facebook_id = %s',
//                $this->db->escape($facebookId)
//            )
//        );
//
//        $result = $this->db->query(
//            sprintf(
//                'SELECT * FROM users WHERE facebook_id = %s',
//                $this->db->escape($facebookId)
//            )
//        );
//
//        var_dump($result->num_rows());
//
        $this->db->from('users');
//        $this->db->where('facebook_id', $facebookId);
        $query = $this->db->get();
//
        $query->num_rows(); // 6
////        $result->last_row(); // array()
//
//
//        print_r($query);
//
//        echo '<pre>' . print_r($query) . '</pre>';

        //var_dump($query->result());
//
        foreach($query->result_array() as $row) {
            var_dump($row);
        }

//        var_dump($result->row());
//        var_dump($result->result('Users_Model'));

        return $query->num_rows();

        //return $query->result();
    }

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