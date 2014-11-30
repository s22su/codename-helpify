<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Helper_To_Help_Request extends CI_Migration {
    const TABLE_NAME = 'helper_to_help_request';

    const PRIMARY_KEY = 'id';

    public function up()
    {
        $this->dbforge->add_field(array(
            self::PRIMARY_KEY => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'do_help_user_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'help_request_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'accepted' => array(
                'type' => 'TINYINT'
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
            ),
        ));

        $this->dbforge->add_key(self::PRIMARY_KEY, TRUE);
        $this->dbforge->create_table(self::TABLE_NAME);
    }

    public function down()
    {
        $this->dbforge->drop_table(self::TABLE_NAME);
    }
}