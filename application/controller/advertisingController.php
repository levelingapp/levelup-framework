<?php
class AdvertisingController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
		
		require_once("application/views/advertising/index.php");
	}

}
?>