<?php namespace FuzzyBlog\Services;

use \FuzzyBlog\Services\Traits\FindBySlugTrait;

/**
 * Service layer for \FuzzyBlog\Entities\Category
 *
 * @package FuzzyBlog
 **/
class CategoryService extends BaseService {

	use FindBySlugTrait;

	//sets the slug to strtolower version of the title (with spaces changed to `-`) if no slug is passed
	public function create(array $attributes = array())
	{
		$attributes['slug'] = $this->setSlug($attributes['slug'], $attributes['name']);
		parent::create($attributes);
	}
}