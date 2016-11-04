<?php
	
	//include Connection
	require_once("../../../configAjax.php");
	
	//start session
	$session = new Session();
	$session->init();
	
	//open connection
	$connection = new Connection();
	$connection->open_connection();

	$gameComment = new Game_comment();
	$users = new Users();
	
	
	$message = $_POST['message'];
	$game_id = $_POST['game_id'];
	$last_comm = $_POST['last_comm'];
	
	$user_id = $session->user();
	
	$response = array();
	
	$message = htmlspecialchars($message);
	
	$gameComment->insert($user_id, $game_id, $message);
	
	$userQuery = $users->select_by_id($user_id);
	$userRow = $userQuery->fetch();

	

	$response['user'] = $userRow['user_fname'] . " " . $userRow['user_lname'];
	$response['date'] = "A second ago";
	$response['img'] = "http://www.levelingapp.com/images/assets/image_profile_62_62.jpg";
	$response['message'] = $message;
	
	die(json_encode($response));
