<?php
class HelpController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
		
		require_once("application/views/help/index.php");
	}

}
?>