<?php namespace FuzzyBlog\Composers;

use Illuminate\View\View;

/**
 * Define the contract that all view composers should adhere to
 *
 * @package FuzzyBlog
 **/
interface ComposerInterface {
	
	/**
	 * @param instance of illuminate\view\view
	 *
	 * @return void
	 **/
	public function compose(View $view);

}