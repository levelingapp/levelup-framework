<?php
	class Game extends Connection{
		private $id;
		private $name;
		private $friendly_url;
		private $description;
		private $file;
		private $type;
		private $postedBy;
		private $icon;
		private $img;
		private $thumb;
		private $companyName;
		private $companyWeb;
		private $url;
		private $uploadFileType;
		private $embedUrl;
		private $publishOn;
		private $instructions;
		private $category;
		private $height;
		private $width;
		private $timesPlayed;
		private $position;
		private $isUsingApi;
		private $isVisible;
		private $ip;
		private $counter;
		private $userID;
		
		private $tag_name;
		
		private $canvasUrl;

	
		//sql
		private $sql;
		private $query;
		private $row;
	
	
	
		//******************************************************************
		//Select ALL Games
		//******************************************************************
		public function select_all(){
			
			$this->sql = "SELECT * FROM game";
			
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute();
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		
			
		//******************************************************************
		//Select by Games by ID
		//******************************************************************
		public function select_by_id($id){
			$this->id = $id;
			$this->sql = "SELECT * FROM game JOIN user ON user.user_id = game.game_posted_by
						WHERE game.game_id = :id AND  game.game_is_visible = 'YES'";

			
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
			
		}
		
		
		//******************************************************************
		//Select by friendly url
		//******************************************************************
		public function select_by_friendly_url($url){
			$this->friendly_url = $url;
			$this->sql = "SELECT * FROM game JOIN user ON user.user_id = game.game_posted_by
						WHERE game.game_friendly_url = :url AND  game.game_is_visible = 'YES'";

			
			//Query Parameters
			$query_params = array(
				':url' => $this->friendly_url
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
			
		}
	
		//******************************************************************
		//Return the category of the game
		//******************************************************************
		public function select_categories_in_game($game_id){
			$this->id = $game_id;
			$this->sql = 	"SELECT * FROM game_category 
							LEFT JOIN categories ON categories.categories_id = game_category.game_category_category_id 
							WHERE game_category.game_category_game_id  = :id";
			

			
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    

				return $stmt;
			   
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
				
		}
		
		
		//******************************************************************
		//Return the category of the game
		//******************************************************************
		public function select_all_categories(){
			
			$this->sql = "SELECT * FROM categories";
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute();
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
		}
	
		//******************************************************************
		//Return ALL the tags of the game
		//******************************************************************
		public function select_tags($id){
			$this->id = $id;
			$this->sql = "SELECT * FROM game_tag WHERE game_tag.game_id = :id";
			
			
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			   
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		
		
		//******************************************************************
		//Return game type by ID
		//******************************************************************
		public function select_type_by_id($id){
			$this->id = $id;
			$this->sql = "SELECT * FROM game_type WHERE game_type.game_type_id = :id";
			
			
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
		
				return $stmt;
			   
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		
		//******************************************************************
		//Return all game type
		//******************************************************************
		public function select_all_types(){
			
			$this->sql = "SELECT * FROM game_type";
			
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute();
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
		}
		
		
		//******************************************************************
		//Select all games by User ID
		//******************************************************************
		public function select_by_user_id($userid, $page = NULL, $offset = NULL){
			$this->userID = $userid;
			
			$this->sql = "SELECT * FROM game WHERE game.game_posted_by = :userID AND  game.game_is_visible = 'YES'";
			
			
			if($page != NULL){
				$this->sql .= " LIMIT {$page}";
			}
			
			if($offset != NULL){
				$this->sql .= " OFFSET {$offset}";
			}
			
			//Query Parameters
			$query_params = array(
				':userID' => $this->userID
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			


		}
		
		
		//******************************************************************
		// Insert a game
		//******************************************************************
		public function insert($form, $file, $postedBy, $files){

			if($form["isVisible"] == "on"){
				$this->isVisible = "YES";
			}
			else{
				$this->isVisible = "no";
			}
			
			/*
			if($form["isEmbeded"] == "on"){
				$this->isEmbeded = "YES";
			}
			else{
				$this->isEmbeded = "NO";
			}
			*/
			$this->postedBy = $postedBy;
			$this->name = utf8_encode($form['name']);
			$this->description = utf8_encode($form['description']);
			$this->file = $files["gameFile"];
			$this->type = $form['type'];
			$this->img = $files["icon"];
			$this->thumb = $files["thumb"];
			$this->uploadFileType = $form['typeUpload'];
			$this->companyName = utf8_encode($form['company']);
			$this->companyWeb = $form['companyUrl'];
			
			$this->publishOn = date('Y-m-d H:i:s');
			$this->instructions = utf8_encode($form['instructions']);
			$this->category = $form['category'];
			$this->height = $form['height'];
			$this->width = $form['width'];
			
			$this->canvasUrl = $form['canvasUrl'];
			
			$this->embedUrl = $form['embededCode'];
			//future vars
			//$this->isUsingApi = $form[''];
			//$this->url = $form[''];


			$this->sql = "INSERT INTO 
						game 
						(
						game_posted_by, 
						game_name, 
						game_description, 
						game_file, 
						game_type, 
						game_img, 
						game_medium_thumb, 
						game_company,  
						game_web_company,  
						game_url_embeded,  
						game_publish_on,  
						game_instructions,  
						game_category,  
						game_height, 
						game_width,
						game_upload_type, 
						game_is_visible, 
						game_canvas_page 
						)
						VALUES 
						(
							:postedBy, 
							:name, 
							:description, 
							:file, 
							:type, 
							:img, 
							:thumb, 
							:companyName, 
							:companyWeb,  
							:embedUrl, 
							:publishOn,
							:instructions, 
							:category, 
							:height, 
							:width,
							:uploadFileType,
							:isVisible,
							:canvasUrl
						)";

			
			//Query Parameters
			$query_params = array(
				':postedBy' => $this->postedBy, 
				':name' => $this->name, 
				':description' => $this->description, 
				':file' => $this->file, 
				':type' => $this->type, 
				':img' => $this->img, 
				':thumb' => $this->thumb, 
				':companyName' => $this->companyName, 
				':companyWeb' => $this->companyWeb,  
				':embedUrl' => $this->embedUrl, 
				':publishOn' => $this->publishOn,
				':instructions' => $this->instructions, 
				':category' => $this->category, 
				':height' => $this->height, 
				':width' => $this->width,
				':uploadFileType' => $this->uploadFileType,
				':isVisible' => $this->isVisible,
				':canvasUrl' => $this->canvasUrl
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				$last_id = parent::$db->lastInsertId();    
			   
				return $stmt;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
			
			
			
			
		}
		
		//******************************************************************
		// Insert game tags
		//******************************************************************
		public function insert_tags($tags, $id){
		
			//find id
			$this->id = $id;
			
			$tags = explode(",", $tags);
			
			foreach($tags as $key){
			
				$this->tag_name = $key;
				
				$this->tag_name = trim($this->tag_name);
				
				$this->sql = 
						"INSERT INTO 
						game_tag
						(
						game_tag_name, 
						game_id
						)
						VALUES 
						(
						:tag_name, 
						:id
						)";
	
	

				//Query Parameters
				$query_params = array(
					':tag_name' => $this->tag_name,
					':id' => $this->id
				); 
				
				try {
					// Execute the query to create the user
					$stmt = parent::$db->prepare($this->sql);
					$result = $stmt->execute($query_params);
					//$last_id = $db->lastInsertId();    
				   
					return $stmt;
				}
			   
				catch(PDOException $ex) {
					// Note: On a production website, you should not output $ex->getMessage().
					// It may provide an attacker with helpful information about your code. 
					die("Failed to run query: " . $ex->getMessage());
				}
			}
		}
		
		
		//******************************************************************
		//Return ALL the tags of the game
		//******************************************************************
		public function counter($id, $ip){
			$this->id = $id;
			$this->ip = $ip;
			
			//***************************************************************************************
			//first we count how many people played this game
			//***************************************************************************************
			$this->sql = "SELECT * FROM game_count WHERE game_count.game_count_game_id = :id";
				
				
			//Query Parameters
			$query_params = array(
				':id' => $this->id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();
				

				$this->counter = $stmt->rowCount();


				$this->row = $stmt->fetch();
				
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
			
			
			
			//***************************************************************************************
			//Then we check if the user have played this game before
			//***************************************************************************************
			
			$this->sql = "SELECT * FROM game_count WHERE game_count.game_count_game_id = :id AND game_count.game_count_ip = :ip";
				
				
			//Query Parameters
			$query_params = array(
				':id' => $this->id,
				':ip' => $this->ip
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();
				

				$num_rows = $stmt->rowCount();


				$this->row = $stmt->fetch();
				
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
				

			if($num_rows > 0){
				//Do not increment
				
			}
			else{
				
				 
				
				$this->sql = 
					"INSERT INTO 
					game_count 
					(
					game_count_game_id, 
					game_count_ip
					)
					VALUES 
					(
					:id, 
					:ip
					)";
					
					
						
						//Query Parameters
					$query_params = array(
						':id' => $this->id,
						':ip' => $this->ip
					); 
					
					try {
						// Execute the query to create the user
						$stmt = parent::$db->prepare($this->sql);
						$result = $stmt->execute($query_params);
						//$last_id = $db->lastInsertId();
						$this->counter++;
						
						
						
					}
				   
					catch(PDOException $ex) {
						// Note: On a production website, you should not output $ex->getMessage().
						// It may provide an attacker with helpful information about your code. 
						die("Failed to run query: " . $ex->getMessage());
					}
			}
			
			return $this->counter;
		}
	
	
	}


?>