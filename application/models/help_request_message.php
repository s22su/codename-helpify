<?php
/**
 * @author Kristjan Siimson <dev@siimsoni.ee>
 */
class Helper_Profile_Model extends CI_Model {
    const TABLE = 'help_request_messages';

    var $id;

    var $help_request_id;

    var $user_id;

    var $description;

    var $created_at;
}