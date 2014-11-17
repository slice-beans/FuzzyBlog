<?php namespace FuzzyBlog\Helpers;

class LaravelFacebookRedirectLoginHelper extends \Facebook\FacebookRedirectLoginHelper {
	
	protected function storeState($state)
    {
        \Session::put('facebook.state', $state);
    }

    protected function loadState()
    {
        return $this->state =  \Session::get('facebook.state');
    }

	protected function isValidRedirect()
	{
	    return $this->getCode() && \Input::has('state') && \Input::get('state') == $this->state;
	}
	
    protected function getCode()
    {
	   return \Input::has('code') ? \Input::get('code') : null;
    }
}