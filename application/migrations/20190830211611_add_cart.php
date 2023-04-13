<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_cart extends CI_Migration {

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
			'user_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'address_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'null' => FALSE,
				'default' => 0
			),
			'items_count' => array(
				'type' => 'INT',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'items_qty' => array(
				'type' => 'DECIMAL',
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'base_total' => array(
				'type' => "DECIMAL",
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'discount_total' => array(
				'type' => "DECIMAL",
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'delivery_charge' => array(
				'type' => "DECIMAL",
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'grand_total' => array(
				'type' => "DECIMAL",
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'coupon_id' => array(
				'type' => "INT",
				'constraint' => 10,
				'null' => FALSE,
				'unsigned' => TRUE,
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
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('cart');
	}

	public function down()
	{
		$this->dbforge->drop_table('cart');
	}

}