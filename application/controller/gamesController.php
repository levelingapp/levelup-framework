<?php

class gamesController extends LevelUp_Framework{

	public $name;
	public $width;
	public $height;
	public $fileName;
	public $description;
	public $instructions;
	public $postedBy;
	public $postedOn;
	public $category;
	public $embededGames;
	public $ip;
	public $counter;
	public $type;
	public $tags;
	public $meta_tags;
	
	
	//upload
	public $uploadType;
	public $msg;
	public $game_query_categories;
	public $query_type;

	/**
	* constructor initialize parent constructor
	*/
	public function __construct(){
		 parent::__construct(); 
	}

	/**
	* send to Index games
	*/
	public function indexAction(){
		require_once("application/views/games/index.php");
	}
	
	
	/**
	* send to Category games
	*/
	public function categoryAction(){
		require_once("application/views/games/category.php");
	}
	
	
	/**
	* send to view games
	*/
	public function viewAction(){
	
		$checkRequest = $this->request->getRequest();
		$game_url = $checkRequest[1];

		//creating object for games
		$game = new Game();
		
		//$query_game = $game->select_by_id($game_id); 
		$query_game = $game->select_by_friendly_url($game_url);
		
		$row_game = $query_game->fetch();
		
		
		//check if is empty
		if($query_game->rowCount() == 0){
			//send to 404 Error
			$path = PATH . "error/error_404/";
			header("Location: {$path}");
		}
		
		
		
		//$row_game = mysql_fetch_assoc($query_game);
		
		
		
		
		if($query_game->rowCount() != 0){
		
			/*
			//Creating object for users
			$user = new Users();		
			$query_user = $user->return_nick_by_id($row_game['game_posted_by']);
			$row_user = mysql_fetch_assoc($query_user);
			
			*/
			
			
			
			//Variable for the game
			$game_id =  $row_game['game_id'];
			$this->name = $row_game['game_name'];
			$this->name= stripcslashes(utf8_decode($this->name));
			$this->name = stripslashes($this->name);
			$this->name = nl2br($this->name);

			$this->width = $row_game['game_width'];
			$this->height = $row_game['game_height'];
			$this->fileName = $row_game['game_file'];
			
			$this->description = $row_game['game_description'];
			$this->description= utf8_decode($this->description);
			//$this->description= stripcslashes(utf8_decode($this->description));
			/*$this->description = stripslashes($this->description);
			$this->description = nl2br($this->description);
			*/
			
			$this->instructions = $row_game['game_instructions'];
			$this->instructions= utf8_decode($this->instructions);
			//$this->instructions = stripslashes($this->instructions);
			$this->instructions = nl2br($this->instructions);
			
			
			
			$this->postedBy = $row_game['user_nick'];
			$this->postedOn = date('m/d/Y', strtotime($row_game['game_publish_on']));
			
			
			

			
			//Find Categories
			$query_categories = $query_categories = $game->select_categories_in_game($game_id);;
			$number_categories  = $query_categories->rowCount();
			
			$count = 0;
			$this->category = "";
			
			
			while($row_categories = $query_categories->fetch()){
				$count++;
				
				$link_category = strtolower($row_categories['categories_friendly_url']);
				$link_category = str_replace(" " , "-", $link_category);
				$this->category .= '<a href="../category/'. $link_category . '/" >' .  $row_categories['categories_title'] .'</a>';
				$this->meta_tags .= $row_categories['categories_title'];
				$this->meta_tags .= ", ";
				
				if($number_categories != $count){
					
					$this->category .= ", ";
				}
			}
			
			
			 
			
			//Find game type
			$this->type = $row_game['game_type'];
			$query_type  = $game->select_type_by_id($this->type);
			
			
			$row_type = $query_type->fetch();
			$this->type = $row_type['game_type_title'];
			
		
			
			
			//Find tags
			$query_tags = $game->select_tags($game_id);
			$number_tags  = $query_tags->rowCount();
			
			$count = 0;
			$this->tags = "";
			
			
			while($row_tags =$query_tags->fetch()){
				$count++;
				
				$link_tag = strtolower($row_tags['game_tag_name']);
				$link_tag = str_replace(" " , "-", $link_tag);
				$this->tags .= '<a href="../tags/'. $link_tag . '/" >' . "#" .$row_tags['game_tag_name'] .'</a>';
				$this->meta_tags .= $row_tags['game_tag_name'];
				
				if($number_tags != $count){
					$this->meta_tags .= ", ";
					$this->tags .= ", ";
				}
			}
			
			/*
			//emebeding  for unity
			$embededGames = new EmbededGames();
			$embededGames->SetSize(560,400);
			$embededGames->SetTitle("spaceshooter");
			$embededGames->SetFileName("http://media.moddb.com/images/articles/1/76/75303/2d-spaceshooter.unity3d");
			$type = "unity3D";
			*/
			
			
			
			//Increment counter
			$this->ip = $_SERVER['REMOTE_ADDR'];
			$this->counter = $game->counter($game_id, $this->ip);
			
			
			
			//Creating an embeding object
			//$this->embededGames = new EmbededGames();
			$this->embededGames->SetSize($this->width, $this->height);
			$this->embededGames->SetTitle($this->name);
			$this->embededGames->SetFileName($this->fileName);
			
			
			//**********************************************************************************************
			//Comments
			//**********************************************************************************************
			$game_comments = new Game_comment();
			
			
			$current_page_seen = 1;			
			$per_page = 5;
			$total_count = $game_comments->total_of_rows($game_id);
			$pagination = new Pagination($current_page_seen, $per_page, $total_count);

			
			$game_comm_query = $game_comments->select_by_game_id($game_id, $per_page, $pagination->offset());
			
			$totalOfComments = $game_comments->total_in_game($game_id);
			
			
			
			//**********************************************************************************************
			//Set Header information
			//**********************************************************************************************
			$this->header->set_title("Play ". $this->name . ", a free online game in Leveling App");
			$this->header->set_property_description($this->description);
			$this->header->set_url_property("games/{$game_id}/");
			
			$this->header->set_tags($this->meta_tags);
			
		}
	
		//send to templates
		require_once("application/views/games/view.php");
	}
	
	
	/**
	* Upload a Game
	*
	*/
	public function uploadagameAction(){
		//Creating object for games
		$game = new Game();
	
		//Find categories
		$this->game_query_categories = $game->select_all_categories();
		
		$this->query_type  = $game->select_all_types($this->uploadType);
		
		
		//assign title page
		$this->header->set_title("Upload An App Or Game in Leveling App");
			
		if(isset($_POST["submitted"]) && $_POST['name'] != ""){
			//assign the name
			$this->name = $_POST['name'];
			$this->uploadType = $_POST['uploadType'];
			
			//require_once("templates/uploadGame_02.php");
			require_once("application/views/games/upload-a-game2.php");
		}
		else if(isset($_POST["submitted_02"])){
		
			
			//Find type of game
			$this->name = $_POST['name'];
			$this->uploadType = $_POST['uploadType'];
			
			if($this->uploadType == 1){
				if($_POST['name'] != "" &&
					$_POST['type'] != "" &&
					$_POST['category'] != "" &&
					$_FILES['gameFile']['name'] != "" &&
					$_POST['height'] != "" &&
					$_POST['width'] != "" &&
					$_POST['width'] >= "1" &&
					$_POST['width'] <= "800"
				){
					//UPLOAD
					$this->upload($_POST, $_FILES, $game);
					
					
				}else{
					$this->msg = "One or more of the fields are empty or have an error.";
				}
			}else if($this->uploadType == 2){
				if($_POST['name'] != "" &&
					$_POST['category'] != "" &&
					$_POST['embededCode'] != ""
				){
					//UPLOAD
					$this->upload($_POST, $_FILES, $game);
	
				}else{
					$this->msg = "One or more of the fields are empty or have an error.";
				}
			}else if($this->uploadType == 3){
				if($_POST['name'] != "" &&
					$_POST['category'] != "" &&
					$_POST['canvasUrl'] != "" &&
					$_POST['height'] != "" &&
					$_POST['width'] != "" &&
					$_POST['width'] >= "1" &&
					$_POST['width'] <= "800"
				){
					//UPLOAD
					$this->upload($_POST, $_FILES, $game);
	
				}else{
					$this->msg = "One or more of the fields are empty or have an error.";
				}
			}
				

			require_once("application/views/games/upload-a-game2.php");
		}
		else{
			require_once("application/views/games/upload-a-game.php");
		}
		
	}
	
	
	/**
	*
	*	Upload files
	*/
	public function upload($_POST, $_FILES, $game){
		
		//Upload icon
		if(isset($_FILES['icon']['name']) && $_FILES['icon']['name'] != ""){
			$checkExtensions = new CheckExtensions();
			$checkExtensions->setPath("images/game_icons");
			
			if(!$checkExtensions->execute($_FILES, "icon")){
				$errorMsg =  $checkExtensions->error();
			}else{
				$iconName =  $checkExtensions->name();
				//echo $iconName . "<br />";
				$this->files["icon"] = $iconName;
			}
		
			//Create thumbs
			$thumb = new Thumb();
			$thumb->path("images/game_icons/", "images/game_icons/thumbs/");
			$thumb->setResize(84);
			$this->files["thumb"] = $thumb->execute($iconName);
		}
		
		
		//Upload Game
		if(isset($_FILES['gameFile']['name'])){
			$checkExtensions2 = new CheckExtensions();
			$checkExtensions2->setPath("games/flash");
			
			if(!$checkExtensions2->execute($_FILES, "gameFile")){
				$errorMsg =  $checkExtensions2->error();
			}else{
				$iconName =  $checkExtensions2->name();
				//echo $iconName . "<br />";
				$this->files["gameFile"] = $iconName;
			}
		}

		//Insert into database
		$game_id = $game->insert($_POST, $_FILES, 1, $this->files);
		
		echo "<br />ID: " . $game_id . "<br />";
		
		//Insert tags in db
		$game->insert_tags($_POST['tags'], $game_id);

	}
	
	/**
	* Edit a Game
	*
	*/
	public function editagameAction(){
		
		$checkRequest = $this->request->getRequest();
		$game_id = $checkRequest[2];
		
		
		
		$game = new Game();
		
		$game_query = $game->select_by_id($game_id);
		$row_game = mysql_fetch_assoc($game_query);
		
		$this->uploadType = $row_game['game_upload_type'];
		
		$this->name  = $row_game['game_name'];
		$this->description = $row_game['game_description'];
		$this->instructions = $row_game['game_instructions'];
		$this->width = $row_game['game_width'];
		$this->height = $row_game['game_height'];
		
		
		$query_tags = $game->select_tags($game_id);
		$number_tags = $number = mysql_num_rows($query_tags);
		$count = 0;
		
		while($row_tags = mysql_fetch_assoc($query_tags)){
			$count++;
			$this->tags ="";
			$this->tags .= $row_tags['game_tag_name'] ;
			
			if($number_tags != $count){
			$this->tags .= ", ";
			}
		}
		
		//get categories
		$this->game_query_categories = $game->select_all_categories();
		//get game type
		$this->query_type  = $game->select_all_types($this->uploadType);
		
		
		//send to templates
		require_once("application/views/games/edit-a-game.php");
	}

}
?>