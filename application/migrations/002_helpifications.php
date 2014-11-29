<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Helpifications extends CI_Migration {

    public function up()
    {
        $this->dbforge->add_field(array(
            'helpification_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
            )
        ));

        $this->dbforge->add_key('helpification_id', TRUE);
        $this->dbforge->create_table('helpifications');
    }

    public function down()
    {
        $this->dbforge->drop_table('helpifications');
    }
}