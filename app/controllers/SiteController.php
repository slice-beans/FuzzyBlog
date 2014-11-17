<?php 

class SiteController extends \BaseController {
	
	protected $service;

	public function construct( $service)
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->beforeFilter('auth', array('only' => array('showAdmin', 'update')));
		$this->service = new \FuzzyBlog\Services\SiteService;
	}

	public function showHome()
	{
		return View::make('pages.public.home');
	}

	public function showAdmin()
	{
		$site = \FuzzyBlog\Entities\Site::firstOrFail();
		return View::make('pages.editsite')->withSite($site);
	}

	public function update()
	{
		$service = new \FuzzyBlog\Services\SiteService;
		try
		{
			$service->update(Input::all(), 1);
		}
		catch(\FuzzyBlog\Exceptions\ValidationException $e)
		{
			return Redirect::back()->withErrors($e->getErrors())->withInput();
		}
		return Redirect::action('SiteController@showAdmin')->withConfirmation('Site details updated successfully.');
	}

}