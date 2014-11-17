<?php namespace FuzzyBlog\Services;

use \FuzzyBlog\Services\Traits\SwitchStatusTrait;
use \FuzzyBlog\Services\Traits\FindBySlugTrait;
use \FuzzyBlog\Services\Traits\Last7DaysTrait;

/**
 * Service layer for \FuzzyBlog\Entities\Post
 *
 * @package FuzzyBlog
 **/
class PostService extends BaseService {

	use SwitchStatusTrait;
	use FindBySlugTrait;
	use Last7DaysTrait;

	//after validating the data sent from the client, we can set the slug dynamically and handle the moving of file uploads using the setAttributes method
	public function create(array $attributes = array())
	{
		$attributes['author_id'] = \Auth::user()->id;
		$this->validator->validateCreate($attributes);

		$attributes = $this->setAttributes($attributes);

		$model = $this->entitybasepath . $this->model;
		$model::create($attributes);
	}

	public function findById($id)
	{
		$model = $this->entitybasepath . $this->model;
		return $model::find($id);
	}

	public function update(array $attributes = array(), $id)
	{	
		$this->validator->validateUpdate($attributes);
		$attributes = $this->setAttributes($attributes);

		$model = $this->entitybasepath . $this->model;
		
		$post = $model::find($id);

		foreach($attributes as $col => $val)
		{
			//checks that we are not trying to add the _method (as its a PUT verb) or _token to the database
			if(in_array($col, $post->getFillable()))
			{
				$post->{$col} = $val;
			}
		}

		$post->save();

	}

	public function setAttributes(array $attributes)
	{
		$attributes['slug'] = $this->setSlug($attributes['slug'], $attributes['title']);
		
		//if is an update rather than create action - ugly though, there should be seperate methods for this
		if(isset($attributes['thumbnailupdate']))
		{
			//if the thumbnail has changed we process the new thumbnail, otherwise take no action
			if($attributes['thumbnailupdate'] == 'true') $attributes['thumbnail'] = $this->setThumbnail($attributes['thumbnail'], $attributes['slug']);
		}
		else
		{
			//if the action is create, process the thumbnail if provided
			 $attributes['thumbnail'] = $this->setThumbnail($attributes['thumbnail'], $attributes['slug']);
		}

		//a bit lazy of me, but the thumbnail column is not nullable - wouldn't do this in production code!
		if(is_null($attributes['thumbnail'])) $attributes['thumbnail'] = '';
		
		//set the content to either the html or markdown version, whichever is provided
		$attributes['content']   = $attributes['content'][$attributes['post_type']];

		return $attributes;
	}

	//we only want to display parent posts on the homepage, so we retrieve them and send them back to the controller here - called by view composer FuzzyBlog\Composers\PublicComposers\HomeComposer
	public function indexPosts()
	{
		$model = $this->entitybasepath . $this->model;

		$posts = $model::where('parent_id', '=', 0)->get();

		foreach($posts as $post)
		{
			$post->children();
		}
		return $posts;
	}

	public function setThumbnail($thumbnail, $slug)
	{
		//if the file is an instance of an uploaded file object then we move it to teh thumbs directory, adding the time to the prefix of the image so that if the thumbnail changes but the slug stays the same, we can tell the difference
		if(get_class($thumbnail) == 'Symfony\Component\HttpFoundation\File\UploadedFile')
		{
			$newfile = time() . $slug . '.' . $thumbnail->getClientOriginalExtension();
			$thumbnail->move(public_path() . '/img/thumbs/', $newfile);
			return $newfile;
		}

		//if thumbnail exists as is, then return it
		if(file_exists(public_path() . '/img/thumbs/'.$thumbnail))
		{
			return $thumbnail;
		}

		//should really throw an exception here, not a fan of returning false
		return false;		
	}

	public function findAllByDate($year, $month)
	{
		$model = $this->entitybasepath . $this->model;

		if(is_null($month))
		{
			$dt =\Carbon\Carbon::createFromFormat('Y-m-d', $year . '-01-01');
			$gt = $year .'-01-01';
			$lt = $dt->addYear();			
		}
		else
		{
			$dt = \Carbon\Carbon::createFromFormat('Y-m-d', $year . '-' . $month . '-01');
			$gt = $year . '-' . $month . '-01';
			$lt = $dt->addMonth();
		}
	
		return $model::where('created_at', '>', $gt)->where('created_at', '<', $lt)->get();
	}

}