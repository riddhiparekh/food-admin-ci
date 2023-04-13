<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Seed_roles extends CI_Migration {
	
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
			'role_name' => 'Super Admin',
			'role_slug' => 'super-admin',
			'permissions' => NULL
		);
		$role = Role::create($seed);
		if($role) {
			$profile = Profile::find(1);
			$profile->role = $role->id;
			$profile->save();
		}
	}

	public function down()
	{
		Role::truncate();
	}
}