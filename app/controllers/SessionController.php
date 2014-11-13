<?php

class SessionController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	public function destroy()
	{
		Auth::logout();
		return Redirect::to('login');
	}

	public function create()
	{
		if(Auth::check()) return Redirect::intended('admin');
		return View::make('pages.login');
	}

	public function store()
	{
		if(Auth::attempt(Input::only('username', 'password'))) return Redirect::intended('admin');
		return Redirect::to('login')->withError('Login failed.');
	}

}
