<?php
	
	//include Connection
	require_once("../../../configAjax.php");
	
	//Start session
	$session = new Session();
	$session->init();

	//open connection
	$connection = new Connection();
	$connection->open_connection();
	
	
	$users = new Users();
	
	//creating the message array
	$msg = array();
	$msg['response'] = "success";
	
	
	
	//Check if all the fields are not empty
	if($_POST['fname'] != "" && $_POST['lname'] != "" && $_POST['nick'] != "" && $_POST['email'] != "" && $_POST['confirm_email'] != "" && 
	$_POST['password'] != "" && $_POST['month'] != "" && $_POST['day'] != "" && $_POST['year'] != "" && $_POST['sex'] != ""){
		
		$checkNick = true;
		$checkEmail = true;
		
		
		//check if username already exists in db
		$nickQuery = $users->select_by_nick($_POST['nick']);
		$nickRow = $nickQuery->fetch();
		if(empty($nickRow['user_nick'])){
			$checkNick = false;
		}else{
			$msg['response'] = "fail";
			$msg['message'] = "This username is already taken";
		}				
		
		
		//check if email already exists in db
		$emailQuery = $users->select_by_email($_POST['email']);
		$emailRow = $emailQuery->fetch();
		if(empty($emailRow['user_email'])){
			$checkEmail = false;
		}else{
			$msg['response'] = "fail";
			$msg['message'] = "This email is already in our DB";
		}

		if($checkNick != true && $checkEmail != true){
			//Insert
			$id = $users->insert($_POST);
			
			
			
			//create an album
			$album = new Album();
			
			//album Info
			$album_info = array(
				'name' => "Cover photos", 
				'description' => "Cover photos", 
				'position' => 1, 
				'user_id' => $id, 
				'privacy' => "public", 
				'category' => "cover", 

			); 
			$album->create_album($album_info);
			
			//album Info
			$album_info = array(
				'name' => "Profile pictures", 
				'description' => "Profile photos", 
				'position' => 1, 
				'user_id' => $id, 
				'privacy' => "public", 
				'category' => "profile", 

			);
			
			$album->create_album($album_info);
			
			//start session
			$session->login($id, $_POST['nick']);
			
			
			$msg['success'] = true;
		}
		
		
	}else{
		$msg['response'] = "fail";
		$msg['message'] = "One or more fields are empty";
	}

	
	echo json_encode($msg);