<?php namespace FuzzyBlog\Helpers;

class LaravelFacebookRedirectLoginHelper extends \Facebook\FacebookRedirectLoginHelper {
	
	protected function storeState($state)
<<<<<<< HEAD
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
=======
	{
	  	\Session::put('facebook.state', $state);
	}

    protected function loadState()
    {
	    $this->state = \Session::get('facebook.state');
	    return $this->state;
    }

    protected function isValidRedirect()
    {
	    return $this->getCode() && \Input::has('state') && \Input::get('state') == $this->state;
    }

    protected function getCode()
    {
    	return \Input::has('code') ? \Input::get('code') : null;
    }


	public function getAccessTokenDetails($app_id,$app_secret,$redirect_url,$code)
	{
		$token_url = "https://graph.facebook.com/oauth/access_token?"
	          . "client_id=" . $app_id . "&redirect_uri=" . $redirect_url
	          . "&client_secret=" . $app_secret . "&code=" . $code;

	    $response = file_get_contents($token_url);
	    $params = null;
	    parse_str($response, $params);
		return $params;
	}
>>>>>>> eb8af287ce050eb07c332ca11362962e52799e4d
}