<?php
/**
* @author Luis Vazquez
* Date : 06/17/2011
* CheckExtensions class: 	The purpose of this class is to check extension in images and games
* @version 1.0
* @copyright Copyright (c) 2011, Luis Vazquez (leveling app)
*/
	class CheckExtensions{
	
		//attributes
		private $image = array();
		private $games = array();
		private $img;
		private $game;
		private $extension;
		private $fileNoExtension;
		private $newFileName;
		private $check;
		private $typeUpload;
		private $fileName;
		private $nameForm;
		private $files;
		private $msg;
		private $formName;
		private $fileType;
		
		/**
		* constructor
		*/
		public function __construct(){
			$this->image[] = "image/jpeg";
			$this->image[] = "image/jpg";
			$this->image[] = "image/pjpeg";
			$this->image[] = "image/png";
			$this->image[] = "image/x-png";
			$this->image[] = "image/gif";
			
			$this->games[] = "swf";
			$this->games[] = "unity3d";
			
			$this->check = false;
			
		}
		
		/**
		* check only images files and return new name  of the image and 
		*/
		public function check($img){
			$this->img = $img;
			
			//Find extension
			$this->find_ext($this->img);

			//change name to sh1 
			$this->fileNoExtension = sha1($this->fileNoExtension . date('Y-m-d H:i:s'));
			
			//new name
			$this->newFileName = $this->fileNoExtension . "." . $this->extension;

			//check status if is image
			if($this->typeUpload =="images"){
				if($this->check_image() ){
					return true;
				}
			}
				
			//check status if is game
			if($this->typeUpload =="games"){
				if($this->check_game() ){
					return true;
				}
			}
			
			$this->msg = "Extension \"$this->extension\" is not supported at the moment. Please try another File." ;
			return false;
			
		}
		
		/**
		* check for extensions for image
		*/
		private function check_image(){
		
			for($i = 0; $i < count($this->image); $i++){
				if($this->image[$i] == $this->fileType){
					//$this->check =  true;
					return true;
					break;
				}
			}
			return false;
		}
		
		/**
		* check for extensions for Games
		*/
		private function check_game(){
		
			for($i = 0; $i < count($this->games); $i++){
				if($this->games[$i] == $this->extension){
					//$this->check =  true;
					return true;
					break;
				}
			}
		}
		
		
		
		/**
		* private function find the name of the file and find the extension of the file and save them in 2 different vars
		*/
		private function find_ext($file){
			$this->extension = preg_replace('/^.*\.([^.]+)$/D', '$1', $file);
			$this->extension = strtolower($this->extension);
			$this->fileNoExtension = preg_replace('/\.[^.]*$/', '', $file);
		}
		
		/**
		* Upload File to the server
		*/
		private function uploadFile(){
		
			//Check image
			if(isset( $this->files[$this->formName]['name'])){
				$form_file =  $this->files[$this->formName]['name'];
			}

			//Copying the file picture into the folder
			if($form_file !=""){
				$file =  $this->files[$this->formName]['tmp_name'];
				$newfile = $this->pathImages ."/". $this->newFileName;
				if (!copy($file, $newfile)) {
					$this->msg = "It was a problem loading the file: {$form_file}. Please try again\n";
					return false;
				}
			}
			
			return true;
		}
		
		/**
		* Check width
		*/
		private function checkWidth(){
			if($this->typeUpload =="images"){
				list($width, $height, $type, $attr) = getimagesize( $this->files[$this->formName]['tmp_name']);
				if($width >= 200){
					return true;
				}else{
					$this->msg = "The image you tried to upload is too small. It needs to be at least 200 pixels wide. Please try again with a larger image.";
					return false;
				}
			}else{
				return true;
			}
		}
		
		/**
		* here is the path of your saved pictures or games
		*/
		public function setPath($pathFiles){
			$this->pathImages = $pathFiles;
			
			if(stristr($this->pathImages,"images")){
				$this->typeUpload = "images";
			}
			if(stristr($this->pathImages,"games")){
				$this->typeUpload =  "games";
			} 
		}
		
		/**
		* execute
		*/
		public function execute($files, $formName){
			$this->files = $files;
			$this->formName = $formName;
			
			$file = $this->files[$this->formName]['name'];
			$this->fileType = $this->files[$this->formName]['type'];
			
			if(!$this->check($file)){
				return false;
				
			}
			else if(!$this->checkWidth()){
				return false;
			}
			
			else{
				
				if(!$this->uploadFile()){
					return false;
				}
			}
			return true;
		}
		
		/**
		* return message
		*/
		public function error(){
			return $this->msg;
		}
		
		/**
		* Return New Name
		*/
		public function name(){
			return $this->newFileName;
		
		}
		
		//End
		
	}
	
//***********************************
//Example of objects
//***********************************
/*
$checkExtensions = new CheckExtensions();
$checkExtensions->setPath("images");

if(!$checkExtensions->execute($_FILES, "image")){
	echo $checkExtensions->error();
}else{
	echo $checkExtensions->name();
}
		
*/