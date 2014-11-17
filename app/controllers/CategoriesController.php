<?php

class CategoriesController extends \BaseController {

	public function __construct(FuzzyBlog\Services\CategoryService $service)
	{
		$this->beforeFilter('csrf', array('on' => 'post'));
		$this->service = $service;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('pages.categories')->withCategories(\FuzzyBlog\Entities\Category::all());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pages.addnewcategory');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		try
		{
			$this->service->create(Input::all());
		}
		catch(FuzzyBlog\Exceptions\ValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors()); 
		}

		return Redirect::action('admin.categories.index')->withConfirmation('Category created successfully.');
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
		return View::make('pages.editcategory')->withCategory(\FuzzyBlog\Entities\Category::find($id));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		try
		{
			$this->service->update(Input::all(), $id);
		}
		catch(FuzzyBlog\Exceptions\ValidationException $e)
		{
			return Redirect::back()->withInput()->withErrors($e->getErrors());
		}
		return Redirect::action('admin.categories.index')->withConfirmation('Category updated successfully.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\FuzzyBlog\Entities\Category::destroy($id);
		return Redirect::route('admin.categories.index')->withConfirmation('Category deleted.');
	}

	/**
	 * Show all posts in category or 404 if category doesnt exist
	 *
	 **/
	public function showBySlug($slug)
	{
		try
		{
			$category = $this->service->findBySlug($slug);
		}
		catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			\App::abort(404);
		}
		
		return View::make('pages.public.category')->withCategory($category)->withPosts($category->posts);
	}


}
