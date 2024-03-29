<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Helper_Profiles extends CI_Migration {
    const TABLE_NAME = 'helper_profiles';

    const PRIMARY_KEY = 'id';

    public function up()
    {
        $this->dbforge->add_field(array(
            self::PRIMARY_KEY => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'user_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255',
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255',
            ),
            'address_formatted' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255',
            ),
            'lat' => array(
                'type' => 'DECIMAL',
                'constraint' => '20,16',
                'null' => TRUE,
            ),
            'lon' => array(
                'type' => 'DECIMAL',
                'constraint' => '20,16',
                'null' => TRUE,
            ),
            'hobbies' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'experience' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'created_at' => array(
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
            ),
            'deleted_at' => array(
                'type' => 'TIMESTAMP',
                'null' => TRUE
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