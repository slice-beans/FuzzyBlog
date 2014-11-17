<?php namespace FuzzyBlog\Helpers;

class FacebookHelper {
	
	public function generateLoginURL($route = 'FacebookController@store')
	{
		$helper = new LaravelFacebookRedirectLoginHelper(action($route));
		return $helper->getLoginUrl();
	}

	public function checkLogin($route = 'FacebookController@store')
	{
		$helper = new LaravelFacebookRedirectLoginHelper(action($route));
		
		try
		{
			$session = $helper->getSessionFromRedirect();
		} 
		catch(\FacebookRequestException $e) 
		{
			throw new \FuzzyBlog\Exceptions\FacebookConnectException('Unable to connect to facebook at this time');
		} 
		catch(\Exception $e) 
		{
			throw new \FuzzyBlog\Exceptions\FacebookConnectException('Unable to connect to facebook at this time');
		}
	}
			
}