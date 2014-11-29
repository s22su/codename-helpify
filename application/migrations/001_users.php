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
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'facebook_profile' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'verified' => array(
                'type' => 'TINYINT',
                'null' => TRUE,
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'facebook_id' => array(
                'type' => 'BIGINT',
                'null' => TRUE
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