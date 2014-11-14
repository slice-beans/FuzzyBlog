<?php namespace FuzzyBlog\Entities;

class Post extends Basemodel {

	protected $table = 'posts';

	protected $fillable = array('title', 'author_id', 'status', 'slug', 'thumbnail', 'content', 'snippet', 'post_type', 'category_id', 'parent_id');
	
}