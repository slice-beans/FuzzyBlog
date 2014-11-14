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
		return View::make('pages.showpost')->withPost(\FuzzyBlog\Entities\Post::find($id));
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

	public function switchStatus()
	{
		$id = Input::get('id');

		$post = \FuzzyBlog\Entities\Post::find($id);
		$post->status = ( $post->status == 1 ? 2 : 1 );
		$post->save();
		return Redirect::route('admin.posts.index')->withConfirmation('Post status updated.');
	}


}
