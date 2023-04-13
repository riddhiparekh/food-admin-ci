<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_users extends CI_Migration {

	public function up()
	{
		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'auto_increment' => TRUE,
				'unsigned' => TRUE
			),
			'oauth_provider' => array(
				'type' => "ENUM('local','google','facebook')",
				'null' => FALSE,
				'default' => 'local'
			),
			'oauth_token' => array(
				'type' => 'VARCHAR',
				'constraint' => '127',
				'null' => TRUE,
				'default' => NULL
			),
			'contact_no' => array(
				'type' => 'VARCHAR',
				'constraint' => '63',
				'null' => FALSE,
				'unique' => TRUE
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '127',
				'null' => TRUE,
				'default' => NULL
			),
			'secret_key' => array(
				'type' => 'CHAR',
				'constraint' => '255',
				'null' => TRUE,
				'default' => NULL
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_field("`verified_on` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00'");
		$this->dbforge->add_field("`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`deleted_at` TIMESTAMP NULL DEFAULT NULL");
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('users');
	}

	public function down()
	{
		$this->dbforge->drop_table('users');
	}
}