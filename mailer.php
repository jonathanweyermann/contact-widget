<?php

//Check $_POST
if($_SERVER['REQUEST_METHOD']=="POST"){
	//Get % Sanitize $_POST values
	$name = strip_tags(trim($_POST['name']));
	$email = filter_var(trim($_POST['email']),FILTER_SANITIZE_EMAIL);
	$message = trim($_POST['message']);
	$recipient = $_POST['recipient'];
	$subject = $_POST['subject'];
	
	if(empty($name) or empty($message) or empty($email)){
		// 400 error bad request
		http_response_code(400);
		echo "Please check your form fields";
		exit;
	}
	//Build Message
	$message = "Name: $name\n";
	$message .= "Email: $email\n\n";
	$message .= "Message: \n$message\n";
	
	//Build Headers
	$headers = "From: $name <$email>";
	
	//send email
	if(mail($recipient,$subject,$message, $headers)){
		//set 200 success
		http_response_code(200);
		echo "Thank you: your message has been sent";
	} else {
		// 500 (internal server error)
		http_response_code(500);
		echo "Error: There was a problem sending your message";
	}
} else {
	//set 403 response (forbidden)
	http_response_code(403);
	echo "There was a problem with your submission, please try again.";
}



?>