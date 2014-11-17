<?php namespace FuzzyBlog\Composers;

use Illuminate\View\View;
use FuzzyBlog\Entities\Category;
use FuzzyBlog\Entities\Post;

/**
 * View Composer for the addnewpost view, adds the categories and the posts to the view for populating the 'choose category' and 'parent post' select elements of the form
 *
 * @package FuzzyBlog
 **/ 
class PostComposer implements ComposerInterface {

	public function compose(View $view)
	{
		$viewcategories = array();
		$viewposts = array(0 => 'Select parent post..');

		$categories = Category::all();
		
		foreach($categories as $cat)
		{
			$viewcategories[$cat->id] = $cat->name;
		}

		$posts = Post::all();

		foreach ($posts as $post) 
		{
			$viewposts[$post->id] = $post->title;
		}

		$view->with(array('categories' => $viewcategories, 'posts' => $viewposts));
	}

}