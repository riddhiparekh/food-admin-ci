<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_products extends CI_Migration {

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
				'constraint' => '127',
				'null' => TRUE,
				'default' => NULL
			),
			'images' => array(
				'type' => 'JSON',
				'null' => TRUE,
				'default' => NULL
			),
			'price' => array(
				'type' => 'DECIMAL',
				'null' => FALSE,
				'constraint' => '20,2',
				'default' => 0
			),
			'description' => array(
			    'type' => 'TEXT',
			    'null' => TRUE,
			    'default' => NULL
			),
			'is_active' => array(
				'type' => 'BOOLEAN',
				'null' => FALSE,
				'default' => 0
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_field("`created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`updated_at` TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field("`deleted_at` TIMESTAMP NULL DEFAULT NULL");
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('products');
	}

	public function down()
	{
		$this->dbforge->drop_table('products');
	}
}
