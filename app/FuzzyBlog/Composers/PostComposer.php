<?php namespace FuzzyBlog\Composers;

use Illuminate\View\View;
use FuzzyBlog\Entities\Category;
use FuzzyBlog\Entities\Post;

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