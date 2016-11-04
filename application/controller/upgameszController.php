<?php

class upgamesController {

	public function __construct(){
		echo "initialize Index Controller <br />";
	}

	public function indexAction(){
		
		echo "<h1>esto es games</h1>";
		require_once("application/views/index/home.php");
	}

}
?>