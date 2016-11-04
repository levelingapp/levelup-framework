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
	$album = new Album();

	
	if($_POST['image_type'] == "profile"){
		
		$uploadFile = new UploadFile();
		$uploadFile->setPath("images/user_icons");
		$uploadFile->setWidth(200);
		$uploadFile->setFileType("images"); //"images", "game", ""
		
		if(!$uploadFile->execute($_FILES, "upload_profile_pic")){
			$errorMsg =  $uploadFile->error();
		}else{
			$imageOriginal =  $uploadFile->name();
			//$this->files["icon"] = $iconName;
		}
		
		
		//Create thumbs
		$files = array();
		$thumbsWidth = array(690, 200, 160, 62, 36);
		
		$thumb = new Thumb();
		
		//Creating thumbs
		for($i = 0; $i < count($thumbsWidth); $i++){
			
			$thumb->path("images/user_icons/", "images/user_icons/thumbs/");
			$thumb->setResize($thumbsWidth[$i]);
			$thumb_name_1 = $thumb->execute($imageOriginal);
			
			$files[] = array(
				"thumb_name" => $thumb_name_1,
				"width" => $thumbsWidth[$i]
			);
		}

		
		$album_id = $album->get_profile_id($user_id);
		$image_info = array(
			'name' => "profile", 
			'description' => "Profile Image", 
			'position' => 1, 
			'album_id' => $album_id, 
			'user_id' => $user_id, 
			'privacy' => "public", 
			'is_used' => "yes",
			'thumbs' => $files,
		);
			
		//print_r($image_info);
		
		$album->add_image($image_info);
		
	}
	
	
	if($_POST['image_type'] == "cover"){
		
		$uploadFile = new UploadFile();
		$uploadFile->setPath("images/user_icons");
		$uploadFile->setWidth(690);
		$uploadFile->setFileType("images"); //"images", "game", ""
		
		if(!$uploadFile->execute($_FILES, "upload_profile_pic")){
			$errorMsg =  $uploadFile->error();
		}else{
			$imageOriginal =  $uploadFile->name();
			//$this->files["icon"] = $iconName;
		}
		
		
		//Create thumbs
		$files = array();
		$thumbsWidth = array(1000,690, 200);
		
		$thumb = new Thumb();
		
		//Creating thumbs
		for($i = 0; $i < count($thumbsWidth); $i++){
			
			$thumb->path("images/user_icons/", "images/user_icons/thumbs/");
			$thumb->setResize($thumbsWidth[$i]);
			$thumb_name_1 = $thumb->execute($imageOriginal);
			
			$files[] = array(
				"thumb_name" => $thumb_name_1,
				"width" => $thumbsWidth[$i]
			);
		}

		
		$album_id = $album->get_cover_id($user_id);
		$image_info = array(
			'name' => "Cover photo", 
			'description' => "Cover photo", 
			'position' => 1, 
			'album_id' => $album_id, 
			'user_id' => $user_id, 
			'privacy' => "public", 
			'is_used' => "yes",
			'thumbs' => $files,
		);
			
		//print_r($image_info);
		
		$album->add_image($image_info);
	}
	
	$response = array();
	
	$response["image_type"] = $_POST['image_type'];
	$response['images'] = $files;
	
	die(json_encode($response));