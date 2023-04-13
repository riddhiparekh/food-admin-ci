<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_address extends CI_Migration {

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
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => TRUE,
				'default' => NULL
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => TRUE,
				'default' => NULL
			),
			'contact_no' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => TRUE,
				'default' => NULL
			),
			'address1' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => TRUE,
				'default' => NULL
			),
			'address2' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => TRUE,
				'default' => NULL
			),
			'state' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => TRUE,
				'default' => NULL
			),
			'city' => array(
				'type' => 'VARCHAR',
				'constraint' => '191',
				'null' => TRUE,
				'default' => NULL
			),
			'pincode' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => TRUE,
				'default' => NULL
			),
			'is_default' => array(
				'type' => 'BOOLEAN',
				'null' => FALSE,
				'default' => FALSE
			),
			'user_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'created_at' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE,
				'default' => NULL
			),
			'updated_at' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE,
				'default' => NULL
			)
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('addresses');
	}

	public function down()
	{
		$this->dbforge->drop_table('addresses');
	}
}