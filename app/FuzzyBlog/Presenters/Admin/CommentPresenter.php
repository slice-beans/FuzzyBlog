<?php namespace FuzzyBlog\Presenters\Admin;

class CommentPresenter extends \FuzzyBlog\Presenters\BasePresenter {
	
	public function parent()
	{
		if( ! is_null($this->entity->parent_id))
		{
			return '<a data-content="'.$this->entity->parent->content.'" href="#" class="viewCommentParent" data-added="'.$this->entity->parent->adminpresent()->created_at_human.'" data-user="'.$this->entity->parent->authorable->username.'">'.$this->entity->parent->content.'</a>';
		}
		else 
		{
			return '';
		}
	}

	public function status()
	{
		switch($this->entity->status)
		{
			case 0:
				return '<div class="label label-warning">Requires Moderation</div>';
				break;
			case 1:
				return '<div class="label label-success">Active</div>';
				break;
			case 2:
				return '<div class="label label-danger">Inactive</div>';
			break;
		}
	}
}