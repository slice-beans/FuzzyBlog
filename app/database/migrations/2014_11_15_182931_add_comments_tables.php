<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCommentsTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function($t)
		{
			$t->increments('id');
			$t->integer('post_id');
			$t->integer('parent_id')->nullable();
			$t->string('authorable_type');
			$t->string('authorable_id');
			$t->string('content');
			$t->integer('status')->default(0);
			$t->timestamps();
		});

		Schema::create('commenters', function($t)
		{
			$t->increments('id');
			$t->string('username');
			$t->string('email')->unique();
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
		Schema::drop('comments');
		Schema::drop('commenters');
	}

}
