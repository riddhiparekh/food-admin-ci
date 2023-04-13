<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_user_session extends CI_Migration {

	public function up()
	{
		$fields = array(
			'user_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'token' => array(
				'type' => 'CHAR',
				'constraint' => '127',
				'null' => FALSE,
				'unique' => TRUE
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('user_sessions');
	}

	public function down()
	{
		$this->dbforge->drop_table('user_sessions');
	}
}
