<?php

class UserTableSeeder extends Seeder {
	
	public function run()
	{
		$user = array('username' => 'admin', 'password' => 'password', 'email' => 'keirlavelle1@hotmail.co.uk');
		App::make('user')->createOrFail($user);
	}	

}