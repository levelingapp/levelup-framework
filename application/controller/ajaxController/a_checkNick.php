<?php
	
	//include Connection
	require_once("../../../configAjax.php");
	
	//open connection
	$connection = new Connection();
	$connection->open_connection();
	
	
	$users = new Users();
	
	$nick = $_POST['nick'];
	
	
	$nickQuery = $users->select_by_nick($nick);
	
	$nickRow = $nickQuery->fetch();
	
	//$nickRow['user_nick'];
	
	if(empty($nickRow['user_nick'])){
		echo "true";
	}else{
		echo "false";
	}