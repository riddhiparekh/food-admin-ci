<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_profiles extends CI_Migration {

	public function up()
	{
		$fields = array(
			'user_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '127',
				'null' => TRUE,
				'default' => NULL
			),
			'role' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'default' => 0,
				
			),
			'fcm_id' => array(
				'type' => 'TEXT',
				'null' => TRUE,
				'default' => NULL
			),
			'device_company' => array(
				'type' => 'CHAR',
				'constraint' => '63',
				'null' => TRUE,
				'default' => NULL
			),
			'device_name' => array(
				'type' => 'CHAR',
				'constraint' => '127',
				'null' => TRUE,
				'default' => NULL
			),
			'device_code' => array(
				'type' => 'CHAR',
				'constraint' => '127',
				'null' => TRUE,
				'default' => NULL
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_field("`last_login` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'");
		$this->dbforge->add_field("`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`deleted_at` TIMESTAMP NULL DEFAULT NULL");
		$this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES users(id)');
		$this->dbforge->add_key('user_id', TRUE);
		$this->dbforge->create_table('profiles');
	}

	public function down()
	{
		$this->dbforge->drop_table('profiles');
	}
}