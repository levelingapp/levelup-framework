<?php
	require_once("../../../levelUp_Framework/includes/recaptcha/recaptchalib.php");
	
	$privatekey = "6LeuE-sSAAAAAKTGZlAD0Snjgk8vwUmMXQOMOoxY";
	
	$resp = recaptcha_check_answer(
	            $privatekey,
	            $_SERVER["REMOTE_ADDR"],
	            $_POST["recaptcha_challenge_field"],
	            $_POST["recaptcha_response_field"]
	        );
	
	$response = array();
	
	if (!$resp->is_valid) {
	    // What happens when the CAPTCHA was entered incorrectly
	    $response['status'] =  "fail";
		$response['message'] =  $resp->error;
	    
	} else {
	    // Your code here to handle a successful verification
	    $response['status'] =  "success";
	    $response['message'] =  "";
	}
	
	echo json_encode($response);