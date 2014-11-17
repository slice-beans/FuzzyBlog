<?php namespace FuzzyBlog\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Binds composers to the their views, registered in app/config/app.php
 *
 * @package default
 * @author 
 **/
class ComposerServiceProvider extends ServiceProvider {

	public function register()
	{
		$this->app->view->composer('admin.dashboard', 'FuzzyBlog\Composers\DashboardComposer');
		$this->app->view->composer('pages.addnewpost', 'FuzzyBlog\Composers\PostComposer');
		$this->app->view->composer('pages.editpost', 'FuzzyBlog\Composers\PostComposer');
		$this->app->view->composer('pages.public.home', 'FuzzyBlog\Composers\PublicComposers\HomeComposer');
		$this->app->view->composer(array('layouts.public', 'partials.defaultmeta'), 'FuzzyBlog\Composers\PublicComposers\LayoutComposer');
		$this->app->view->composer('partials.publicsidebar', 'FuzzyBlog\Composers\PublicComposers\SidebarComposer');
	}

}