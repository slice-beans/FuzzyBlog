<?php

class CommentsController extends \BaseController {

	public function __construct(\FuzzyBlog\Services\CommentService $service)
	{
		$this->service = $service;
		$this->beforeFilter('auth', array('except' => 'publicStoreNew'));
		$this->beforeFilter('csrf', array('on' => 'post', 'except' => array('newReply', 'store')));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return View::make('pages.comments')->withComments(\FuzzyBlog\Entities\Comment::all());
	}

	public function newReply()
	{	
		try
		{
			$this->service->createReply(Input::all());
		}
		catch(\FuzzyBlog\Exceptions\ValidationException $e)
		{
			return Redirect::back()->withErrors($e->getErrors())->withInput();
		}
		return View::make('pages.comments')->withComments(\FuzzyBlog\Entities\Comment::all());
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
			$this->service->setAttributesAndCreate(Input::all(), Input::get('post_id'));
		}
		catch(\FuzzyBlog\Exceptions\ValidationException $e)
		{
			return Redirect::back()->withErrors($e->getErrors())->withInput();
		}
		return Redirect::route('admin.posts.index')->withPosts(\FuzzyBlog\Entities\Post::all())->withConfirmation('Comment Created successfully.');
	}

	/**
	 * not used here as handled by javascript
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('pages.editcomment')->withComment(\FuzzyBlog\Entities\Comment($id));
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
		\FuzzyBlog\Entities\Comment::destroy($id);
		return Redirect::route('admin.comments.index')->withConfirmation('Post deleted.');
	}

	public function publicStoreNew($postid)
	{
		try
		{
			$this->service->setAttributesAndCreate(Input::all(), $postid);
		}
		catch(\FuzzyBlog\Exceptions\ValidationException $e)
		{
			return Redirect::back()->withErrors($e->getErrors())->withInput();
		}
		return Redirect::back()->withConfirmation('Comment has been posted and is awaiting moderation.');
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
		
		return Redirect::route('admin.comments.index')->withConfirmation('Comment status updated.');
	}
	
	public function publicStoreReply($parentid)
	{

	}


}
