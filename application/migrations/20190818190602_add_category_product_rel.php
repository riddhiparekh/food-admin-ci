<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_category_product_rel extends CI_Migration {

	public function up()
	{
		$fields = array(
			'product_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'category_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'unsigned' => TRUE
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('category_product_rel');
		$columns = array(
			'CONSTRAINT category_product UNIQUE (category_id, product_id)'
		);
		$this->dbforge->add_column('category_product_rel', $columns);
	}

	public function down()
	{
		$this->dbforge->drop_table('category_product_rel');
	}
}
