<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_roles extends CI_Migration {

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
			'role_name' => array(
				'type' => 'VARCHAR',
				'constraint' => '63',
				'null' => TRUE,
				'default' => NULL
			),
			'role_slug' => array(
				'type' => 'VARCHAR',
				'constraint' => '63',
				'null' => FALSE,
				'unique' => TRUE
			),
			'permissions' => array(
				'type' => 'JSON',
				'null' => TRUE,
				'default' => NULL
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('roles');
	}

	public function down()
	{
		$this->dbforge->drop_table('roles');
	}
}
