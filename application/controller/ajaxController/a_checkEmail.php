<?php
	//include Connection
	require_once("../../../configAjax.php");
	
	//open connection
	$connection = new Connection();
	$connection->open_connection();
	
	
	$users = new Users();
	
	$email = $_POST['email'];
	
	
	$emailQuery = $users->select_by_email($email);
	
	$emailRow = $emailQuery->fetch();
	
	//echo $emailRow['user_email'];
	
	if(empty($emailRow['user_email'])){
		echo "true";
	}else{
		echo "false";
	}