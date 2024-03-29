<?php
/**
 * @author Kristjan Siimson <dev@siimsoni.ee>
 */
class Help_request_message extends CI_Model {
    const TABLE = 'help_request_messages';

    var $id;

    var $help_request_id;

    var $user_id;

    var $description;

    var $created_at;

    public function listHelpRequestMessagesForHelper($helpRequestId, $helperId) {
        if(empty($helpRequestId)) {
            //throw new ApplicationException('Help Request ID required');
            return false;
        }
        if(empty($helperId)) {
            //throw new ApplicationException('User ID required');
            return false;
        }
        $helpRequestId = $this->db->escape($helpRequestId);
        $helperId = $this->db->escape($helperId);
        $query = $this->db->query("
            select r.*, r.user_id as request_user_id, m.user_id, u.name, m.description as content from help_requests r
            inner join help_request_messages m on r.id = m.help_request_id
            inner join users u on r.user_id = u.user_id
            where r.id = $helpRequestId and (r.user_id = $helperId or m.user_id = r.user_id)");

        $result = array();
        foreach($query->result() as $row) {
            $result[] =  $row;
        }

        //pre($result);
        return $result;
    }

    public function listHelpRequestMessagesForHelpee($helpRequestId) {
        if(empty($helpRequestId)) {
            throw new ApplicationException('Help Request ID required');
        }
        $helpRequestId = $this->db->escape($helpRequestId);
        $query = $this->db->query("
            select * from help_requests r
            inner join help_request_messages m on r.id = m.help_request_id
            inner join users u on r.user_id = u.user_id
            where r.id = $helpRequestId");

        $result = array();
        foreach($query->result() as $row) {
            $result[] =  $row;
        }
        return $result;
    }

    public function listAcceptedHelpRequestUsersForHelpee($helpeeId, $helpRequestId) {
        if(empty($helpRequestId)) {
            throw new ApplicationException('Help Request ID required');
        }
        $helpRequestId = $this->db->escape($helpRequestId);        $query = $this->db->query("
            select DISTINCT u.* from helper_to_help_request hth
            inner join users u on hth.do_help_user_id = u.user_id
            where hth.help_request_id = $helpRequestId and hth.accepted=1");

        foreach($query->result() as $row) {
            return $row;
        }
        return false;
    }

    public function insert($data) {
        return $this->db->insert(self::TABLE, $data);
    }
}