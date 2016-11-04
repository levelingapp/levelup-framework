<?php

class IndexController extends LevelUp_Framework{

	public function __construct(){
		 parent::__construct(); 
	}

	public function indexAction(){
	
		//create a user object
		$users = new Users();
		
		
		//check if post is set
		if(isset($_POST['submit_register'])){
			
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
					$msg = "This username is already taken";
				}				
				
				
				//check if email already exists in db
				$emailQuery = $users->select_by_email($_POST['email']);
				$emailRow = $emailQuery->fetch();
				if(empty($emailRow['user_email'])){
					$checkEmail = false;
				}else{
					$msg = "This email is already in our DB";
				}
				
				
				if($checkNick == true && $checkEmail == true){
					//Insert
				}
				
				
			}else{
				$msg = "One or more fields are empty";
			}
			
		}
		
		$this->header->set_title("Leveling App | Play Free Online Games and Social Entertainment");
		require_once("application/views/index/home.php");
	}
	


}
?>