<?php namespace FuzzyBlog\Providers;

use Illuminate\Support\ServiceProvider;

class ParsedownServiceProvider extends ServiceProvider {
	
	public function register()
	{
		$this->app->singleton('parsedown', function()
		{
			return new \Parsedown;
		});
	}

}