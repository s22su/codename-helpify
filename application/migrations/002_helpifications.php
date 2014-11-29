<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Helpifications extends CI_Migration {
    const TABLE_NAME = 'helpifications';

    const PRIMARY_KEY = 'helpification_id';

    public function up()
    {
        $this->dbforge->add_field(array(
            self::PRIMARY_KEY => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            Migration_Users::PRIMARY_KEY => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'latitude' => array(
                'type' => 'POINT'
            ),
            'longitude' => array(
                'type' => 'POINT'
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