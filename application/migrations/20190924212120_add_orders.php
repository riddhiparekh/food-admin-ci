<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_orders extends CI_Migration {

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
			'customer_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'delivery_boy_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'user_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
				'null' => TRUE,
				'default' => NULL
			),
			'customer_email' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
				'null' => TRUE,
				'default' => NULL
			),
			'customer_contact' => array(
				'type' => 'VARCHAR',
				'constraint' => 30,
				'null' => TRUE,
				'default' => NULL
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
			'total_refunded' => array(
				'type' => "DECIMAL",
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'coupon_code' => array(
				'type' => "VARCHAR",
				'constraint' => 30,
				'null' => TRUE,
				'default' => NULL
			),
			'order_status' => array(
				'type' => "VARCHAR",
				'constraint' => 30,
				'null' => FALSE
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
		$this->dbforge->create_table('orders');
	}

	public function down()
	{
		$this->dbforge->drop_table('orders');
	}

}