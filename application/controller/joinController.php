<?php
class joinController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
		
		require_once("application/views/join/index.php");
	}

	public function step1Action(){
		
		require_once("application/views/join/step1.php");
	}

}
?>