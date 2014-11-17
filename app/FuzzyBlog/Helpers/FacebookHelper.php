<?php namespace FuzzyBlog\Helpers;

use Facebook\FacebookRequestException;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;
use Facebook\GraphObject;
use FuzzyBlog\Exceptions\FacebookConnectException;

class FacebookHelper {
	
	public function generateLoginURL($route = 'FacebookController@store')
	{
		$helper = new LaravelFacebookRedirectLoginHelper(action($route));
		return $helper->getLoginUrl(array('scope' => 'publish_actions'));
	}

	public function setFacebookAccessToken($route = 'FacebookController@store')
	{
		$helper = new LaravelFacebookRedirectLoginHelper(action($route.''));
		
		try
		{
			$session = $helper->getSessionFromRedirect();
		} 
		catch(FacebookRequestException $e) 
		{
			throw new FacebookConnectException($e->getMessage());
		} 
		catch(\Exception $e) 
		{
			throw new FacebookConnectException($e->getMessage());
		}

		\Session::put('facebook.token', $session->getToken());
		return $session;
	}

	public function getFacebookAccessToken()
	{
		if( ! \Session::has('facebook.token'))
		{
			throw new FacebookConnectException('Token not set.');
		}

		return \Session::get('facebook.token');
	}


	public function postToFacebook($link, $title)
	{
		$session = new FacebookSession($this->getFacebookAccessToken());

		$response = (new FacebookRequest(
			$session, 'POST', '/me/feed', array(
				'link' => url('/'.$link),
				'message' => 'New post on FuzzyBlog: '.$title
			)
		))->execute()->getGraphObject();

	}
			
}