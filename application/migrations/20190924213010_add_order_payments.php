<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_order_payments extends CI_Migration {

	public function up()
	{
		$fields = array(
			'id' => array(
				'type' => 'BIGINT',
				'constraint' => 20,
				'null' => FALSE,
				'auto_increment' => TRUE,
				'unsigned' => TRUE
			),
			'order_id' => array(
				'type' => 'BIGINT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'payment_method' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
				'null' => FALSE
			),
			'payable_amount' => array(
				'type' => 'DECIMAL',
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'paid_amount' => array(
				'type' => 'DECIMAL',
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'payment_response' => array(
				'type' => 'LONGTEXT',
				'null' => TRUE
			),
			'paid_on' => array(
				'type' => 'TIMESTAMP',
				'null' => TRUE,
				'default' => NULL
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
		$this->dbforge->create_table('order_payments');
	}

	public function down()
	{
		$this->dbforge->drop_table('order_payments');
	}

}