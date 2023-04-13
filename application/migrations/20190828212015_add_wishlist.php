<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_wishlist extends CI_Migration {

	public function up() {

		$fields = array(
			'user_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'unsigned' => TRUE
			),
			'product_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'null' => FALSE,
				'unsigned' => TRUE
			)
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->create_table('wishlist');
		$column = array('CONSTRAINT user_product UNIQUE (user_id, product_id)');
		$this->dbforge->add_column('wishlist', $column);
	}

	public function down() {
		$this->dbforge->drop_table('wishlist');
	}
}