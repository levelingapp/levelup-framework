<?php
//***************************************************************************************
// Date: 01/23/2012
// Created by Luis Vazquez
// Purpose: This class help you add, update, and delete user from database
//***************************************************************************************
class Users extends Connection{

	private $id;
	private $fname;
	private $lname;
	private $email;
	private $password;
	private $salt;
	private $nick;
	private $dob;
	private $dor;
	private $level;
	private $website;
	private $about_me;
	private $gender;
	private $last_seen;
	private $ip;
	private $counrty;
	private $city;
	private $home_town;
	private $home_country;
	private $highr_school;
	private $college;
	private $work_place;
	private $interests;
	private $steam;
	private $xbox;
	private $psn;
	private $wii;
	private $emblem;
	private $badge;
	private $prestige;
	private $flag;
	private $image;
		
		
	//sql
	private $sql;
	private $query;
	private $row;
	
	private $check;
	
	
		
	//******************************************************************
	//Select ALL Users
	//******************************************************************
	public function select_all(){
		$this->sql = "SELECT * FROM user";
		
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
	//Select by ID
	//******************************************************************
	public function select_by_id($id){
		$this->id = $id;
		$this->sql = "SELECT * FROM user WHERE user.user_id = :id";
		
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
	//Select by ID and return ONLY the nick name
	//******************************************************************
	public function return_nick_by_id($id){
		$this->id = $id;
		
		$this->sql = "SELECT user_nick FROM user WHERE user.user_id = :id";
		
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
	//Select by Nick
	//******************************************************************
	public function select_by_nick($nick){
		$this->nick = $nick;
		$this->sql = "SELECT * FROM user WHERE user.user_nick = :nick";

		//Query Parameters
		$query_params = array(
			':nick' => $this->nick
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
	//Select by Email
	//******************************************************************
	public function select_by_email($email){
		$this->email = $email;
		$this->sql = "SELECT * FROM user WHERE user.user_email = :email";

		//Query Parameters
		$query_params = array(
			':email' => $this->email
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
	//Select all Admin
	//******************************************************************
	/*
	public function select_all_admin(){
		$this->sql = "SELECT * FROM user WHERE user.status_user ='admin'";
		$this->query = mysql_query($this->sql);
		
		return $this->query;
	}
	*/
	
		
	//******************************************************************
	//Check Login
	//******************************************************************
	public function check_password($email,$password){
	
		$check = false;
		$this->email = trim($email);
		$this->password = trim($password);
		
		
		$query = $this->get_salt_by_email($email);
		$row = $query->fetch(); 
		$this->password = sha1($row['user_salt'] . trim($password) );
		
		
		
		$this->sql = "SELECT * FROM user WHERE user.user_email = :email AND user.user_password = :password";

		//Query Parameters
		$query_params = array(
			':password' => $this->password,
			':email' => $this->email
		); 
		
		try {
			// Execute the query to create the user
			$stmt = parent::$db->prepare($this->sql);
			$result = $stmt->execute($query_params);
			//$last_id = $db->lastInsertId();
			

			$totalRows = $stmt->rowCount();


			//check if have more than 1 results
			if($totalRows > 0){
				$this->row = $stmt->fetch();
				$check = $this->row['user_id'];
			}
			else{
				$check = false;
			}

			return $check;
			
			
		}
	   
		catch(PDOException $ex) {
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code. 
			die("Failed to run query: " . $ex->getMessage());
		}
		

	}

	
	//******************************************************************
	//update Info
	//******************************************************************
	public function update_info($id, $info){
	
		$this->fname = trim($info['name']);
		$this->lname = trim($info['last']);
		$this->id = $id;
		
		
		$this->sql = 	"UPDATE user
						SET 
						name_user = :fname', 
						lname_user= ':lname', 
						WHERE id_user = :id";
		
		//Query Parameters
		$query_params = array(
			':id' => $this->id,
			':fname' => $this->fname,
			':lname' => $this->lname
		); 
		
		try {
			// Execute the query to create the user
			$stmt = parent::$db->prepare($this->sql);
			$result = $stmt->execute($query_params);
			//$last_id = $db->lastInsertId();
			

			//return $stmt;
			
		}
	   
		catch(PDOException $ex) {
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code. 
			die("Failed to run query: " . $ex->getMessage());
		}
	
	}
	
		
	//******************************************************************
	//Update Password
	//******************************************************************
	public function update_password($pass, $id){
		$this->id = $id;
		$this->password = md5(mysql_real_escape_string($pass));
		$this->sql = 	"UPDATE user
						SET user_password = '{$this->password}'
						WHERE user_id ={$this->id}";

		$this->query = mysql_query($this->sql);
	
	}
	
		
	//******************************************************************
	//Insert Values
	//******************************************************************
	public function insert($form){
		$this->fname = ucfirst(strtolower(trim($form['fname']))); //strtolower
		$this->lname = ucfirst(strtolower(trim($form['lname'])));
		$this->nick = strtolower(trim($form['nick']));
		$this->email = strtolower(trim($form['email']));
		$month = $form['month'];
		$day = $form['day'];
		$year = $form['year'];
		$this->dob = $year. "-". $month."-".$day; //2012-01-24
		$this->dor = date('Y-m-d H:i:s');  //2012-01-24 19:20:38
		$this->sex = $form['sex'];
		$pass = trim($form['password']);
	
		$this->salt = sha1( "1eVe1@4p5al7" . time() );	
		$this->password =  sha1($this->salt . $pass);
		
		
		//$this->img;
		$this->sql = 	"INSERT INTO 
						user 
						(
						user_fname, 
						user_lname, 
						user_nick, 
						user_email, 
						user_password, 
						user_salt, 
						user_dob, 
						user_dor, 
						user_gender  
						)
						VALUES 
						(
						:fname, 
						:lname,  
						:nick,  
						:email, 
						:password,  
						:salt,  
						:dob, 
						:dor, 
						:sex
						)";
						
						/*
						echo $this->sql;
						echo "<br/ >";
						*/

		
		//Query Parameters
		$query_params = array(
			':fname' => $this->fname,
			':lname' => $this->lname,
			':nick' => $this->nick,
			':email' => $this->email,
			':password' => $this->password,
			':salt' => $this->salt,
			':dob' => $this->dob,
			':dor' => $this->dor,
			':sex' => $this->sex,
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
	
	
	
	
	public function insert_profile_image($image, $user_id){
		$this->image = $image;
		$this->id = $user_id;
		
		
		//$this->img;
		$this->sql = 	"INSERT INTO 
						user 
						(
						user_fname, 
						user_lname, 
						user_nick, 
						user_email, 
						user_password, 
						user_salt, 
						user_dob, 
						user_dor, 
						user_gender  
						)
						VALUES 
						(
						:fname, 
						:lname,  
						:nick,  
						:email, 
						:password,  
						:salt,  
						:dob, 
						:dor, 
						:sex
						)";
						
						/*
						echo $this->sql;
						echo "<br/ >";
						*/

		
		//Query Parameters
		$query_params = array(
			':fname' => $this->fname,
			':lname' => $this->lname,
			':nick' => $this->nick,
			':email' => $this->email,
			':password' => $this->password,
			':salt' => $this->salt,
			':dob' => $this->dob,
			':dor' => $this->dor,
			':sex' => $this->sex,
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

	
	//unique md5
	function unique_md5() {
		mt_srand(microtime(true)*100000 + memory_get_usage(true));
		return md5(uniqid(mt_rand(), true));
	}
	
	
	
	/*
	* Check if password and email are set in the database for login purposes
	*/
	public function get_salt_by_id($db, $id){
		
		$this->sql = "SELECT * FROM user WHERE user.user_id = :id";

		//Query Parameters
		$query_params = array( 
			':id' => $id
		); 

		
		try {
			// Execute the query to create the user 
			$stmt = parent::$db->prepare($this->sql); 
			$result = $stmt->execute($query_params); 
			//$last_id = $db->lastInsertId(); 	
		}
		
		catch(PDOException $ex) {
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		}

		
		return $stmt;
		
		
	
	}
	
	
	
	/*
	* Check if password and email are set in the database for login purposes
	*/
	public function get_salt_by_email($email){
		
		$this->sql = "SELECT * FROM user WHERE user.user_email = :email";

		//Query Parameters
		$query_params = array( 
			':email' => $email
		); 

		
		try {
			// Execute the query to create the user 
			$stmt = parent::$db->prepare($this->sql); 
			$result = $stmt->execute($query_params); 
			//$last_id = $db->lastInsertId(); 	
		}
		
		catch(PDOException $ex) {
			// Note: On a production website, you should not output $ex->getMessage(). 
			// It may provide an attacker with helpful information about your code.  
			die("Failed to run query: " . $ex->getMessage()); 
		}

		
		return $stmt;

	}
	
	
	//******************************************************************
	//update Info
	//******************************************************************
	public function update_small_bio($id, $bio){
	
		$this->about_me = trim($bio);
		$this->id = $id;
		
		
		$this->sql = 	"UPDATE user
						SET 
						user_about_me = :about_me
						WHERE user_id = :id";
		
		//Query Parameters
		$query_params = array(
			':id' => $this->id,
			':about_me' => $this->about_me
		); 
		
		try {
			// Execute the query to create the user
			$stmt = parent::$db->prepare($this->sql);
			$result = $stmt->execute($query_params);
			//$last_id = $db->lastInsertId();
			

			//return $stmt;
			
		}
	   
		catch(PDOException $ex) {
			// Note: On a production website, you should not output $ex->getMessage().
			// It may provide an attacker with helpful information about your code. 
			die("Failed to run query: " . $ex->getMessage());
		}
	
	}
	
	
				
}//Class Ends
?>