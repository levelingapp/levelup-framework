<?php

class upgamesController extends LevelUp_Framework{

	public function __construct(){
		//echo "initialize Index Controller <br />";
	}

	public function indexAction(){
		$this->test->testing();
		echo "<h1>esto es games</h1>";
		require_once("application/views/index/home.php");
	}
	
	
	public function gamesAction(){
		
		echo "<h1>esto es second parameter games</h1>";
		require_once("application/views/index/home.php");
	}
	
	public function viewAction(){
		
		echo "<h1>esto es View games</h1>";
		require_once("application/views/index/home.php");
	}


}
?>