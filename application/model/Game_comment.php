<?php
	class Game_comment extends Connection{
		
		//sql
		private $sql;
		private $query;
		private $row;
	
	
	
		//******************************************************************
		//Select ALL Games
		//******************************************************************
		public function select_by_game_id($game_id, $page = NULL, $offset = NULL){
			
			$this->sql = 	"SELECT * FROM game_comment 
							JOIN user ON user_id = game_comm_user_id
							WHERE game_comm_game_id = :game_id";
			
			if($page != NULL )
			{
				$this->sql .= " LIMIT {$page} OFFSET {$offset}";
			}
			
			//Query Parameters
			$query_params = array(
				':game_id' => $game_id
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
		//Select ALL Games
		//******************************************************************
		public function total_in_game($game_id){
			
			$this->sql = 	"SELECT * FROM game_comment 
							WHERE game_comm_game_id = :game_id";
			
			//Query Parameters
			$query_params = array(
				':game_id' => $game_id
			); 
		
			
			try {
				// Execute the query to create the user
				$stmt = parent::$db->prepare($this->sql);
				$result = $stmt->execute($query_params);
				//$last_id = $db->lastInsertId();    
			   
				return $stmt->rowCount();
			}
		   
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage().
				// It may provide an attacker with helpful information about your code. 
				die("Failed to run query: " . $ex->getMessage());
			}
		}
		
		public function insert($user_id, $game_id, $message){
		
			$this->sql = "INSERT INTO game_comment (
					 	game_comm_message, 
						game_comm_user_id,
						game_comm_game_id,
						game_comm_date
					)
					VALUES (
					:message, 
					:user_id,
					:game_id,
					:date
					)
					";

			
					
			//Query Parameters
			$query_params = array(
				':message' => $message,
				':user_id' => $user_id,
				':game_id' => $game_id,
				':date' => date('Y-m-d H:i:s')
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
		
		
		
		// return the number of rows
		public function total_of_rows($game_id){
			
			$this->sql = "SELECT * FROM game_comment WHERE game_comm_game_id = :game_id" ;

			//Query Parameters
			$query_params = array(
				':game_id' => $game_id,
			);

			try {
				// Execute the query to create the user 
				$stmt = parent::$db->prepare($this->sql); 
				$result = $stmt->execute($query_params); 
				//$last_id = $db->lastInsertId(); 	
				
				return $stmt->rowCount();
			}
			
			catch(PDOException $ex) {
				// Note: On a production website, you should not output $ex->getMessage(). 
				// It may provide an attacker with helpful information about your code.  
				die("Failed to run query: " . $ex->getMessage()); 
			}
		}
		

	}


?>