<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_delivery_boy extends CI_Migration {
	
	public function up()
	{
		$field = array(
			'role_id' => array(
				'type' => 'INT',
				'default' => 0,
				'after' => 'parent_id'
			),
		);
		$seed = array(
			'role_name' => 'Delivery Boy',
			'role_slug' => 'delivery-boy',
			'permissions' => NULL
		);
		$role = Role::create($seed);
	}

	public function down()
	{
		Role::truncate();
	}
}