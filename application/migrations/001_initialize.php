<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Initialize extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 5,
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
                'type' => 'DECIMAL',
                'constraint' => '20,16',
            ),
            'longitude' => array(
                'type' => 'DECIMAL',
                'constraint' => '20,16',
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));

        $this->dbforge->add_key('user_id', TRUE);
        $this->dbforge->create_table('user');
    }

    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}