<?php // app/database/seeds/ArticleTableSeeder.php

use App\User;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();

		User::create(array(
				'author' => 'Chris Sevilleja',
				'text' => 'Look I am a test comment.'
		));

		User::create(array(
				'author' => 'Nick Cerminara',
				'text' => 'This is going to be super crazy.'
		));

		User::create(array(
				'author' => 'Holly Lloyd',
				'text' => 'I am a master of Laravel and Angular.'
		));
	}

}