<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_webcontent extends CI_Migration {

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
			'type' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => FALSE
			),
			'content' => array(
				'type' => 'LONGTEXT',
				'null' => TRUE,
				'default' => NULL
			)
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('web_content');
	}

	public function down()
	{
		$this->dbforge->drop_table('web_content');
	}
}