<?php namespace FuzzyBlog\Services;

class CategoryService extends BaseService {

	public function create(array $attributes = array())
	{
		$attributes['slug'] = $this->setSlug($attributes['slug'], $attributes['name']);
		parent::create($attributes);
	}
}