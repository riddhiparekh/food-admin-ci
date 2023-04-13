<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Seed_users extends CI_Migration {


	public function up()
	{
		$this->load->library('Password');
		$hash = $this->password->hash('1#1@dM!n');
		$seeds = array(
			'oauth_provider' => 'local',
			'oauth_token' => NULL,
			'contact_no' => '101202303',
			'email' => 'superadmin@101.com',
			'secret_key' => $hash
		);
		$child_seeds = array(
			'name' => 'Super Admin'
		);
		$user = User::create($seeds);
		if($user) {
			$profile = new Profile;
			$profile->name = 'Super Admin';
			$profile->user_id = $user->id;
			$profile->save();
		}
	}

	public function down()
	{
		User::truncate();
	}
}