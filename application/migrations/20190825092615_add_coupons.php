<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_coupons extends CI_Migration {

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
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => 127,
				'null' => FALSE
			),
			'code' => array(
				'type' => 'VARCHAR',
				'constraint' => 31,
				'null' => FALSE
			),
			'description' => array(
				'type' => 'text',
				'null' => TRUE,
				'default' => NULL
			),
			'amount' => array(
				'type' => 'DECIMAL',
				'constraint' => '20,2',
				'null' => FALSE,
				'default' => 0
			),
			'amount_type' => array(
				'type' => "ENUM('flat','percentage')",
				'null' => FALSE,
				'default' => 'flat'
			),
			'valid_from' => array(
				'type' => 'DATE',
				'null' => TRUE,
				'default' => NULL
			),
			'valid_till' => array(
				'type' => 'DATE',
				'null' => TRUE,
				'default' => NULL
			),
			'max_orders' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'default' => 0
			),
			'min_orders' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'default' => 0
			),
			'min_order_value' => array(
				'type' => 'DECIMAL',
				'constraint' => '20,2',
				'null' => FALSE,
				'default' => 0
			),
			'max_order_value' => array(
				'type' => 'DECIMAL',
				'constraint' => '20,2',
				'null' => FALSE,
				'default' => 0
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
			),
			'deleted_at' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE,
				'default' => NULL
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('coupons');
	}

	public function down()
	{
		$this->dbforge->drop_table('coupons');
	}

}