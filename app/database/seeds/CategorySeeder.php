<?php

class CategorySeeder extends Seeder {

	public function __construct()
	{
		$this->path = "FuzzyBlog\\Entities\\Category";
	}
	
	public function run()
	{	
		$categories = array(
			array('name' => 'Uncategorised', 'slug' => 'uncategorised'),
			array('name' => 'Fuzziness', 'slug' => 'fuzz')
		);

		foreach($categories as $category)
		{
			App::make($this->path)->createOrFail($category);
		}
	}

}