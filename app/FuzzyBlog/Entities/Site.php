<?php namespace FuzzyBlog\Entities;

/**
 * Stores site wide configuration
 *
 * @package FuzzyBlog
 **/
class Site extends BaseModel {
	
	protected $table = 'site';

	protected $fillable = array('site_name', 'site_title', 'description');
}

	