<?php namespace FuzzyBlog\Exceptions;

/**
 * Thrown whenever the adminpresenter or public presenter of a model is called, but the path is not set or the class does not exist - thrown by FuzzyBlog\Presenters\PresentableTrait
 *
 * @package default
 * @author 
 **/
class PresenterException extends \Exception {}