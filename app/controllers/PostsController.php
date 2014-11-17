<?php

class PostsController extends \BaseController {

	protected $service;

	public function __construct(FuzzyBlog\Services\PostService $service)
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
		return View::make('pages.posts')->withPosts($this->service->indexPosts());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('pages.addnewpost');
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

		return Redirect::action('admin.posts.index')->withConfirmation('Post created successfully.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return View::make('pages.public.post')->withPost(\FuzzyBlog\Entities\Post::find($id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('pages.editpost')->withPost(\FuzzyBlog\Entities\Post::find($id));
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
		return Redirect::action('admin.posts.index')->withConfirmation('Post updated successfully.');
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		\FuzzyBlog\Entities\Post::destroy($id);
		return Redirect::route('admin.posts.index')->withConfirmation('Post deleted.');
	}

	//used for building archive pages
	public function findAllByDate($year, $month = null)
	{
		try
		{
			$posts = $this->service->findAllByDate($year, $month);
		}
		catch(\InvalidArgumentException $e)
		{
			\App::abort(404);
		}
	
		return View::make('pages.public.archive')->withPosts($posts);
	}

	public function switchStatus()
	{
		$id = Input::get('id');
		
		try
		{
			$this->service->switchStatus($id);
		}
		catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			return Redirect::back()->withErrors('Post not found.');
		}
		
		return Redirect::route('admin.posts.index')->withConfirmation('Post status updated.');
	}

	public function showBySlug($slug)
	{
		try
		{
			$post = $this->service->findBySlug($slug);
		}
		catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			\App::abort(404);
		}

		return View::make('pages.public.post')->withPost($post);
	}


}
