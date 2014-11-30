<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Help_requests extends CI_Migration {
    const TABLE_NAME = 'help_requests';

    const PRIMARY_KEY = 'id';

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
            'category' => array(
                'type' => 'VARCHAR',
                'null' => TRUE,
                'constraint' => '255',
            ),
            'description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
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
            'date' => array(
                'type' => 'INT',
                'null' => TRUE
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
            'created_at' => array(
                'type' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP'
            ),
            'is_active' => array(
                'type' => 'TINYINT',
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