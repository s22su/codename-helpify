<?php
class Helper_To_Help_Request_Model extends CI_Model {
    const TABLE = 'helper_to_help_request';

    var $id;
    var $do_help_user_id;
    var $help_request_id;
    var $accepted;
    var $created_at;

    public function insert($data) {
        $this->db->insert(self::TABLE, $data);
    }

    public function listAcceptedHelpOffersByHelpRequest($requestId) {
        $this->db->from(self::TABLE);
        $this->db->where('help_request_id', $requestId);
        $this->db->where('accepted', '1');
        $results = array();
        foreach($this->db->get()->result() as $row) {
            $results[] = $row;
        }
        return $results;
    }

    public function listUnacceptedHelpOffersByHelpRequest($requestId) {
        $this->db->from(self::TABLE);
        $this->db->where('help_request_id', $requestId);
        $this->db->where('accepted', '0');
        $results = array();
        foreach($this->db->get()->result() as $row) {
            $results[] = $row;
        }
        return $results;
    }

    public function userAssociatedWithRequest($userId, $requestId) {
        $this->db->from(self::TABLE);
        $this->db->where('do_help_user_id', $userId);
        $this->db->where('help_request_id', $requestId);
        return $this->db->count_all_results() > 0;
    }
}