<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitialDatabaseSchema extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($t)
		{
			$t->increments('id');
			$t->integer('status');
			$t->integer('author_id');
			$t->integer('category_id');
			$t->integer('parent_id');
			$t->string('title');
			$t->string('snippet');
			$t->string('thumbnail');
			$t->binary('content');
			$t->enum('post_type', array('markdown', 'html'));
			$t->integer('revision_of')->nullable();
			$t->timestamps();
		});

		Schema::create('categories', function($t)
		{
			$t->increments('id');
			$t->string('slug');
			$t->string('name');
			$t->timestamps();
		});

		Schema::create('users', function($t)
		{
			$t->increments('id');
			$t->string('email')->unique();
			$t->string('username')->unique();
			$t->string('password', 60);
			$t->rememberToken();
			$t->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
		Schema::drop('categories');
		Schema::drop('users');
	}

}
