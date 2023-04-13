<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_order_items extends CI_Migration {

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
			'product_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'null' => FALSE
			),
			'product_name' => array(
				'type' => 'VARCHAR',
				'constraint' => 127,
				'null' => FALSE
			),
			'qty' => array(
				'type' => 'DECIMAL',
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'price' => array(
				'type' => 'DECIMAL',
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'total' => array(
				'type' => 'DECIMAL',
				'constraint' => '20,4',
				'null' => FALSE,
				'unsigned' => TRUE,
				'default' => 0
			),
			'message' => array(
				'type' => 'VARCHAR',
				'constraint' => 191,
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
		$this->dbforge->create_table('order_items');
	}

	public function down()
	{
		$this->dbforge->drop_table('order_items');
	}

}