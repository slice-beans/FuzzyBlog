<?php namespace FuzzyBlog\Services\Traits;

trait FindBySlugTrait {
	
	public function findBySlug($slug)
	{
		$model = $this->entitybasepath . $this->model;
		return $model::where('slug', '=', $slug)->firstOrFail();
	}

}