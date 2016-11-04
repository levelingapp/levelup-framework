<?php
class ErrorController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
		$this->header->set_index_robots(true);
		require_once("application/views/error/index.php");
	}
	
	public function error_404Action(){
		$this->header->set_index_robots(true);
		
		$this->header->set_title("OOPS | 404 ERROR Page Was Not Found");
		require_once("application/views/error/error_404.php");
	}

}
?>