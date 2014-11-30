<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Drop_Address extends CI_Migration {
    public function up()
    {
        $this->dbforge->drop_column('help_requests', 'address');
        $this->dbforge->drop_column('help_requests', 'address_formatted');

        $this->dbforge->drop_column('helper_profiles', 'address');
        $this->dbforge->drop_column('helper_profiles', 'address_formatted');
    }

    public function down()
    {
        $this->dbforge->add_column(
            'help_requests',
            array(
                'address' => array(
                    'type' => 'VARCHAR',
                    'null' => TRUE,
                    'constraint' => '255',
                ),
                'address_formatted' => array(
                    'type' => 'VARCHAR',
                    'null' => TRUE,
                    'constraint' => '255',
                )
            )
        );

        $this->dbforge->add_column(
            'helper_profiles',
            array(
                'address' => array(
                    'type' => 'VARCHAR',
                    'null' => TRUE,
                    'constraint' => '255',
                ),
                'address_formatted' => array(
                    'type' => 'VARCHAR',
                    'null' => TRUE,
                    'constraint' => '255',
                )
            )
        );
    }
}
