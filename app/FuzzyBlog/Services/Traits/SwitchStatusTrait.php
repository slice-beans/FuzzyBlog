<?php namespace FuzzyBlog\Services\Traits;

trait SwitchStatusTrait {
	
	//sets posts from live to draft or vice versa
	public function switchStatus($id)
	{
		$model = $this->entitybasepath . $this->model;
		$post = $model::findOrFail($id);
		$post->status = ($post->status == 1 ? 2 : 1);
		$post->save();
	}
}