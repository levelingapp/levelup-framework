<?php
	class Album extends Connection{
		//sql
		private $sql;
		private $query;
		private $row;
		function __construct(){
		}
		//******************************************************************
		//Create an album of pictures for a user
		//******************************************************************
		function create_album($info){
			$this->sql = "INSERT INTO 
						album 
						(
							album_name, 
							album_description, 
							album_date,
							album_position,
							album_user_id,
							album_privacy,
							album_category
						)
						VALUES 
						(
							:name, 
							:description, 
							:date, 
							:position, 
							:user_id, 
							:privacy, 
							:category 
						)";
			//Query Parameters
			$query_params = array(
				':name' => $info['name'], 
				':description' => $info['description'], 
				':date' => date('Y-m-d H:i:s'), 
				':position' => $info['position'], 
				':user_id' => $info['user_id'], 
				':privacy' => $info['privacy'], 
				':category' => $info['category']
			); 
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				$last_id = parent::$db->lastInsertId();
				return $last_id;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		//******************************************************************
		//Add a picture to a specific album
		//******************************************************************
		function add_image($info){
			$this->sql = "INSERT INTO 
						picture 
						(
							picture_title, 
							picture_description, 
							picture_date,
							picture_position,
							picture_album_id,
							picture_user_id,
							picture_privacy,
							picture_is_used
						)
						VALUES 
						(
							:title, 
							:description, 
							:date, 
							:position, 
							:album_id, 
							:user_id, 
							:privacy, 
							:is_used 
						)";
						
						
			//Query Parameters
			$query_params = array(
				':title' => $info['name'], 
				':description' => $info['description'], 
				':date' => date('Y-m-d H:i:s'), 
				':position' => $info['position'], 
				':album_id' => $info['album_id'], 
				':user_id' => $info['user_id'], 
				':privacy' => $info['privacy'], 
				':is_used' => $info['is_used']
			); 

			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				$last_id = parent::$db->lastInsertId(); 
				
				$info['picture_id'] = $last_id;
				$this->add_thumbs($info);
				
				return $last_id;
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		
		
		
		private function add_thumbs($info){
			$thumbs = $info["thumbs"];	
			
			foreach ($thumbs as $key) {
				$this->sql = "INSERT INTO 
							pictures_thumb 
							(
								pic_thumb_name, 
								pic_thumb_width, 
								pic_thumb_picture_id
							)
							VALUES
							(
								:thumb_name, 
								:width, 
								:picture_id
							)";
							
							
				//Query Parameters
				$query_params = array(
					':thumb_name' => $key['thumb_name'], 
					':width' => $key['width'], 
					':picture_id' => $info['picture_id']
				); 
				
				
				try {
					// Execute the query to create the user
					$stmt = parent::$db->prepare($this->sql);
					$result = $stmt->execute($query_params);
					$last_id = parent::$db->lastInsertId();  
					//return $last_id;
				}
			   
				catch(PDOException $ex) {
					// Note: On a production website, you should not output $ex->getMessage().
					// It may provide an attacker with helpful information about your code. 
					die("Failed to run query: " . $ex->getMessage());
				}
				
			}
		}
		public function get_profile_id($user_id){
			$this->sql = "SELECT * FROM album WHERE album_user_id = :user_id AND album_category = 'profile'";

			//Query Parameters
			$query_params = array(
				':user_id' => $user_id
			); 
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				$rowCover = $stmt->fetch();
				return $rowCover['album_id'];
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
			
		}
		
		
		public function get_cover_id($user_id){
			$this->sql = "SELECT * FROM album WHERE album_user_id = :user_id AND album_category = 'cover'";			
			
			//Query Parameters			
			$query_params = array(
				':user_id' => $user_id
			); 						
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				$rowCover = $stmt->fetch();
				return $rowCover['album_id'];
				
			}
			
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().				
				// It may provide an attacker with helpful information about your code. 				
				die("Failed to run query: " . $ex->getMessage());			
			}		
		}

		
		public function get_cover_by_user_id($user_id){
			$this->sql = 	"SELECT * FROM album 
							JOIN picture ON album.album_id = picture.picture_album_id
							JOIN pictures_thumb ON pictures_thumb.pic_thumb_picture_id = picture.picture_id
							WHERE album_user_id = :user_id AND album_category = 'cover' AND
							picture_is_used = 'yes'";			
			
			//Query Parameters			
			$query_params = array(
				':user_id' => $user_id
			); 						
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				
				return $stmt;
				
			}
			
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().				
				// It may provide an attacker with helpful information about your code. 				
				die("Failed to run query: " . $ex->getMessage());			
			}		
		}
		
		
	
	}