<?php namespace FuzzyBlog\Composers\PublicComposers;

use Illuminate\View\View;

/**
 * HomeComposer sends posts and categories to the view, so that a list of the posts / categories can be displayed to the user, also sends site configuration information to be used to build the meta og tags and the meta description of the site
 *
 * @package FuzzyBlog
 **/
class HomeComposer implements \FuzzyBlog\Composers\ComposerInterface {
		
	public function compose(View $view)
	{
		$posts = \FuzzyBlog\Entities\Post::allWherePublished();
		$categories = \FuzzyBlog\Entities\Category::all();
		$view->withPosts($posts)->withCategories($categories);
	}

}