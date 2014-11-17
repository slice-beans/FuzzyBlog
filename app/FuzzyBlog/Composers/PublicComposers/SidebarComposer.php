<?php namespace FuzzyBlog\Composers\PublicComposers;

use Illuminate\View\View;

class SidebarComposer implements \FuzzyBlog\Composers\ComposerInterface {
	
	/**
	 * Composes view 'partials.publicsiderbar' - bound in FuzzyBlog\Providers\ComposerServiceProvider
	 *
	 * The sidebar composer grabs all the categories and all the posts. The categories go straight into the view data so that we can link to them in the sidebar
	 *
	 * The posts are iterated over, with the month / year of the post being used to generate an archive link and being placed into an array. This array is then checked and cleaned of duplicates.
     *
 	 * The first item in the posts collection is sent to the view as 'latest' so we can display a link to the latest post
	 **/

	public function compose(View $view)
	{
		$categories = \FuzzyBlog\Entities\Category::all();
		$viewCategories = array();

		foreach($categories as $cat)
		{
			if( ! $cat->posts->isEmpty())
			{
				$viewCategories[] = $cat;
			}
		}

		$posts = \FuzzyBlog\Entities\Post::where('status', '=', 1)->orderBy('created_at', 'desc')->get();
		$viewArchives = array();

		foreach($posts as $post)
		{
			$viewArchives[] = array(
				'slug' => '/archive/'.$post->created_at->format('Y').'/'.$post->created_at->format('m'),
				'text' => $post->publicpresent()->archive_date
			);
		}

		$viewArchives = array_map('unserialize', array_unique(array_map('serialize', $viewArchives)));

		$view->withArchives($viewArchives)->withSidebar($viewCategories)->withLatest($posts->first());
	}

}