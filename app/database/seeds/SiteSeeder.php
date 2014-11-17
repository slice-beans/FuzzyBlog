<?php

use \FuzzyBlog\Entities\Site;

class SiteSeeder extends \Seeder {
	
	public function run()
	{
		$site = array(
			'site_name'   => 'FuzzyBlog', 
			'site_title'  => 'FuzzyBlog - Full of Fuzzy Goodness', 
			'description' => 'FuzzyBlog is your one stop shop for all things fuzzy - mugwais, tennis balls, analog televisions - you name it we got it!'
		);

		Site::create($site);
	}

}