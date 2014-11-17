<?php namespace FuzzyBlog\Services\Traits;

trait Last7DaysTrait {
	
	public function getLastSevenDays()
	{
		$model = $this->entitybasepath . $this->model;

		$dt = \Carbon\Carbon::now();
		$dt->subDay(7);

		return $model::where('created_at', '>', $dt->format('d-m-Y'))->get();
	}

}