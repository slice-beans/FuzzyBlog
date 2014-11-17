<?php namespace FuzzyBlog\Composers\PublicComposers;

use \Illuminate\View\View;

class DefaultMetaComposer implements \FuzzyBlog\Composers\ComposerInterface {

	public function compose (View $view)
	{
		$view->withSite(\FuzzyBlog\Entities\Site::firstOrFail());
	}

}