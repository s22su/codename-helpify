<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Users extends CI_Migration {
    const TABLE_NAME = 'users';

    const PRIMARY_KEY = 'user_id';

    public function up()
    {
        $this->dbforge->add_field(array(
            self::PRIMARY_KEY => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'latitude' => array(
                'type' => 'POINT'
            ),
            'longitude' => array(
                'type' => 'POINT'
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
            )
        ));

        $this->dbforge->add_key(self::PRIMARY_KEY, TRUE);
        $this->dbforge->create_table(self::TABLE_NAME);
    }

    public function down()
    {
        $this->dbforge->drop_table(self::TABLE_NAME);
    }
}