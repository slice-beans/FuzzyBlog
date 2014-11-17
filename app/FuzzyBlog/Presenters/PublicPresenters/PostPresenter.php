<?php namespace FuzzyBlog\Presenters\PublicPresenters;

/**
 * methods for presenting posts in the frontend of the application, declared in FuzzyBlog/Entities/Post
 *
 * @package FuzzyBlog
 **/
class PostPresenter extends \FuzzyBlog\Presenters\BasePresenter {

	//if the post has a thumbnail, output the html for the grid-item view of the post
	public function cat_thumbnail()
	{
		if( ! empty($this->entity->thumbnail)) 
		{
			return '<div class="catthumb">
						<img src="'. \URL::asset('img/thumbs/'.$this->entity->thumbnail).'">
					</div>';
		}

		return '';
	}

	public function content()
	{
		if($this->entity->post_type == 'markdown')
		{
			return \Markdown::parse($this->entity->content);
		}
		else
		{
			return $this->entity->content;
		}
	}

	//link text for archive links 'Mar 2014' for example
	public function archive_date()
	{
		return $this->entity->created_at->format('M Y');
	}

	//limits the snippet to 100 characters when called
	public function snippet()
	{
		return str_limit($this->entity->snippet);
	}

}
