<?php namespace FuzzyBlog\Composers;

use Illuminate\View\View;

interface ComposerInterface {
	
	public function compose(View $view);

}