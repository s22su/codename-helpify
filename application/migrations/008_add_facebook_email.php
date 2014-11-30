<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Facebook_Email extends CI_Migration {
    public function up()
    {
        $this->dbforge->add_column(
            'users',
            array(
                'facebook_email' => array(
                    'type' => 'VARCHAR',
                    'null' => TRUE,
                    'constraint' => '255',
                )
            )
        );
    }

    public function down()
    {
        $this->dbforge->drop_column('users', 'facebook_email');
    }
}
