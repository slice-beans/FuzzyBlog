<?php namespace FuzzyBlog\Composers;

use Illuminate\View\View;

class PostsComposer implements ComposerInterface {
	
	public function compose(View $view)
	{
		$facebookhelper = new \FuzzyBlog\Helpers\FacebookHelper;

		try
		{
			 $facebookhelper->getFacebookAccessToken();
		}
		catch(\FuzzyBlog\Exceptions\FacebookConnectException $e)
		{

		}

		$view->with('facebookset', true);
	}

}