<?php namespace FuzzyBlog\Composers;

use Illuminate\View\View;

/**
 * adds last 7 days post and comment data to the dashboard, as well as the 10 most commented posts
 *
 * @package FuzzyBlog
 **/
class DashboardComposer implements ComposerInterface {

	protected $postService;
	protected $commentService;

	public function __construct(\FuzzyBlog\Services\PostService $postService, \FuzzyBlog\Services\CommentService $commentService)
	{
		$this->postService = $postService;
		$this->commentService = $commentService;
	}
	
	public function compose(View $view)
	{
		$posts7days    = $this->postService->getLastSevenDays();
		$comments7days = $this->commentService->getLastSevenDays();
		
		$weekByPosts = $this->count7Days($posts7days);
		$weekByComments = $this->count7Days($comments7days);

		$commentsPosts = $this->commentService->countPosts();

		$topcommented = $this->formatCommentsToPosts($commentsPosts);

		$view->with(array('weekbyposts' => $weekByPosts, 'weekbycomments' => $weekByComments, 'topcommented' => $topcommented));
	}

	public function formatCommentsToPosts(array $posts)
	{
		$return = array();
		foreach($posts as $post)
		{
			$postObject = $this->postService->findById($post->post_id);
			$return[$postObject->title] = $post->total;
		};

		return $return;
	}

	public function count7days(\Illuminate\Database\Eloquent\Collection $entities)
	{
		$week = $this->setWeekArrayKeys();

		foreach($entities as $entity)
		{
			$week[$entity->created_at->format('D')]++;
		}

		return $week;		
	}

	public function setWeekArrayKeys()
	{
		$week = array();
		$dt = \Carbon\Carbon::now();
		for ($i=0; $i < 7; $i++) 
		{ 	
			if($i > 0)
			{
				$dt->subDay($i);
			}
			$week[$dt->format('D')] = 0;
		}
		return $week;
	}
}