<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_user_otp extends CI_Migration {

	public function up()
	{
		$fields = array(
			'contact_no' => array(
				'type' => 'VARCHAR',
				'constraint' => 15,
				'null' => FALSE,
				'unique' => TRUE
			),
			'otp' => array(
				'type' => 'VARCHAR',
				'constraint' => 63,
				'null' => FALSE
			),
			'valid_till' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE,
				'default' => NULL
			),
			'created_at' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE,
				'default' => NULL
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('user_otp_dtl');
	}

	public function down()
	{
		$this->dbforge->drop_table('user_otp_dtl');
	}

}