<?php namespace FuzzyBlog\Services;

class PostService extends BaseService {

	public function create(array $attributes = array())
	{
		$attributes['author_id'] = \Auth::user()->id;
		$this->validator->validateCreate($attributes);

		if(empty($attributes['slug']))
		{
			$attributes['slug'] = $this->setSlug($attributes['title']);
		}

		if(!is_null($attributes['thumbnail']) && get_class($attributes['thumbnail']) == 'Symfony\Component\HttpFoundation\File\UploadedFile')
		{
			$attributes['thumbnail'] = $this->setThumbnail($attributes['thumbnail'], $attributes['slug']);
		}

		$attributes['content'] = $attributes['content'][$attributes['post_type']];

		$model = $this->entitybasepath . $this->model;

		$model::create($attributes);
	}

	public function setSlug($title)
	{
		return strtolower(str_replace(' ', '-', $title));
	}

	public function setThumbnail(\Symfony\Component\HttpFoundation\File\UploadedFile $thumbnail, $slug)
	{
		$newfile = time() . $slug . '.' . $thumbnail->getClientOriginalExtension();

		$thumbnail->move(public_path() . '/img/thumbs/', $newfile);

		return $newfile;
	}

}