<?php
	
	//include Connection
	require_once("../../../configAjax.php");
	
	//start session
	$session = new Session();
	$session->init();
	
	$user_id = $session->user();
	
	//open connection
	$connection = new Connection();
	$connection->open_connection();

	$users = new Users();
	
	$small_bio = $_POST['bio'];
	
	$users->update_small_bio($user_id, $small_bio);
	
?>