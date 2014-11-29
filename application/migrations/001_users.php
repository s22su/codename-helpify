<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Users extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'user_id' => array(
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

        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('users');
    }

    public function down()
    {
        $this->dbforge->drop_table('users');
    }
}