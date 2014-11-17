<?php namespace FuzzyBlog\Providers;

use Illuminate\Support\ServiceProvider;
use Facebook\FacebookSession;

class FacebookServiceProvider extends ServiceProvider {
	
	public function register()
	{
		FacebookSession::setDefaultApplication(getenv('facebook_app_id'), getenv('facebook_app_secret'));
	}

}