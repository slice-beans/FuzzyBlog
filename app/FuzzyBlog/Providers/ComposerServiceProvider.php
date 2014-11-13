<?php namespace FuzzyBlog\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->view->composer('admin.dashboard', 'FuzzyBlog\Composers\DashboardComposer');
		$this->app->view->composer('pages.addnewpost', 'FuzzyBlog\Composers\PostComposer');
		$this->app->view->composer('pages.updatepost', 'FuzzyBlog\Composers\PostComposer');
	}

}