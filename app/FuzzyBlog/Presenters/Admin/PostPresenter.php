<?php namespace FuzzyBlog\Presenters\Admin;

class PostPresenter extends \FuzzyBlog\Presenters\BasePresenter {

	public function thumbnail()
	{
		if( ! empty($this->entity->thumbnail))
		{
			return \HTML::image('/img/thumbs/'.$this->entity->thumbnail, $this->entity->title, array('class' => 'post-thumbnail'));
		}
		else
		{
			return 'No post thumbnail.';
		}
	}

	public function snippet()
	{
		return str_limit($this->entity->snippet, 20, '...');
	}

	public function status()
	{
		switch($this->entity->status) 
		{
			case 1:
				return '<div class="label label-success">Live</div>';
				break;
			case 2:
				return '<div class="label label-warning">Draft</div>';
				break;
		}
	}

}