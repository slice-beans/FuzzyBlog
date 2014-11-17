<?php

class FacebookController extends \BaseController {

	protected $helper;

	public function __construct(\FuzzyBlog\Helpers\FacebookHelper $helper)
	{
		$this->helper = $helper;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$facebookloginurl = $this->helper->generateLoginURL();
		return View::make('pages.facebookconnect')->withLogin($facebookloginurl);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	public function store()
	{
		try
		{
			$this->helper->checkLogin();
		}
		catch(\FuzzyBlog\Exceptions\FacebookConnectException $e)
		{
			return Redirect::action('FacebookController@index')->withErrors($e->getMessage());
		}
		return Redirect::action('FacebookController@index')->withConfirmation('Login to Facebook was successful.');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
