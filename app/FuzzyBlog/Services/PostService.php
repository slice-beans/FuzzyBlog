<?php namespace FuzzyBlog\Services;

class PostService extends BaseService {

	public function create(array $attributes = array())
	{
		$attributes['author_id'] = \Auth::user()->id;
		$this->validator->validateCreate($attributes);

		$attributes = $this->setAttributes($attributes);

		$model = $this->entitybasepath . $this->model;
		$model::create($attributes);
	}

	public function setAttributes(array $attributes)
	{
		$attributes['slug']      = $this->setSlug($attributes['slug'], $attributes['title']);
		
		if(isset($attributes['thumbnailupdate']))
		{
			if($attributes['thumbnailupdate'] == 'true') $attributes['thumbnail'] = $this->setThumbnail($attributes['thumbnail'], $attributes['slug']);
		}
		else
		{
			 $attributes['thumbnail'] = $this->setThumbnail($attributes['thumbnail'], $attributes['slug']);
		}

		if(is_null($attributes['thumbnail'])) $attributes['thumbnail'] = '';
		
		$attributes['content']   = $attributes['content'][$attributes['post_type']];

		return $attributes;
	}

	public function update(array $attributes = array(), $id)
	{	
		$this->validator->validateUpdate($attributes);
		$attributes = $this->setAttributes($attributes);

		$model = $this->entitybasepath . $this->model;
		
		$post = $model::find($id);

		foreach($attributes as $col => $val)
		{
			if(in_array($col, $post->getFillable()))
			{
				$post->{$col} = $val;
			}
		}

		$post->save();

	}

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

		if(get_class($thumbnail) == 'Symfony\Component\HttpFoundation\File\UploadedFile')
		{
			$newfile = time() . $slug . '.' . $thumbnail->getClientOriginalExtension();
			$thumbnail->move(public_path() . '/img/thumbs/', $newfile);
			return $newfile;
		}

		if(file_exists(public_path() . '/img/thumbs/'.$thumbnail))
		{
			return $thumbnail;
		}

		return false;		
	}

}