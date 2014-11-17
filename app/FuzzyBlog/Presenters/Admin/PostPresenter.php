<?php namespace FuzzyBlog\Presenters\Admin;

/**
 * Presenter for the post entity - declared in FuzzyBlog/Entities/Post
 *
 * @package FuzzyBlog
 **/
class PostPresenter extends \FuzzyBlog\Presenters\BasePresenter {

	//if thumbnail exists, return it as an image, otherwise 'no post thumbnail' message
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

	//for displaying a small snippet in the table of posts view
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