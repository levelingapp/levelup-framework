<?php
class TestController extends LevelUp_Framework{

	public $share;
	public $userGameQuery;

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
		
		require_once("application/views/id/index.php");
	}
	
	
	public function viewAction(){
	
		$user = new Users();
		$game = new Game();
		
		$userid = 1;
		$limit = 10;
		
		$checkRequest = $this->request->getRequest();
		$nick =  $checkRequest[0];
		
		$query_user = $user->select_by_nick(trim($nick));
		$row_user= $query_user->fetch();
		
		
		//check if is empty 
		if($query_user->rowCount() == 0){
			//send to 404 Error
			$path = PATH . "error/error_404/";
			header("Location: {$path}");
		}
		
		
		$this->userGameQuery = $game->select_by_user_id($userid, $limit);
		
		
		
		if($this->share ==""){
			$this->share = "What are you playing?";
		}
		
		
		
		
		require_once("application/views/id/view.php");
	}

}
?>