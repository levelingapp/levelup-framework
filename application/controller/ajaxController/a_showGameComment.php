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
	
	
	$page = $_POST['page'];
	$game_id = $_POST['game_id'];

	$response = array();
	
	$current_page_seen = $page;
	$per_page = 5;
	$total_count = $gameComment->total_of_rows($game_id);
	$pagination = new Pagination($current_page_seen, $per_page, $total_count);

	
	$game_comm_query = $gameComment->select_by_game_id($game_id, $per_page, $pagination->offset());
	
	if($pagination->has_next_page()){
		$more = "true";
	}else{
		$more = "false";
	}
	
	
	$response = array();
	$response[] = array(
						"page" => $page + 1,
						"more" => $more
					);
	
	
	$allComments = array();
	while($game_comm_row = $game_comm_query->fetch()){

		$allComments[] = array(
							"message" => $game_comm_row['game_comm_message'],
							"user" => $game_comm_row['user_fname'] . " " . $game_comm_row['user_lname'],
							"date" => $game_comm_row['game_comm_date'],
							"img" => "http://levelingapp.com/images/assets/image_profile_62_62.jpg"
						);
	}
	
	$response[] = array("comments" => $allComments);

	die(json_encode($response));
