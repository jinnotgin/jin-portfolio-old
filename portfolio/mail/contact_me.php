<?php 
// grab recaptcha library
require_once "recaptchalib.php";
 
// Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
   
// your secret key
$secret = "6LdrliATAAAAAAD0FnIIIBuPxOUrttm8Ee-HrDJC";
// empty response
$response = null;
// check secret key
$reCaptcha = new ReCaptcha($secret);

// if submitted check response
if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}

//if ($response != null && $response->success) {
	$name = $_POST['name'];
	$email_address = $_POST['email'];
	$phone = $_POST['phone'];
	$message = $_POST['message'];
		
	// Create the email and send the message
	$to = 'me@thelinjin.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
	$email_subject = "linjin.me Contact Form:  $name";
	$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message $repsonse";
	$headers = "From: noreply@linjin.me\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
	$headers .= "Reply-To: $email_address";	
	mail($to,$email_subject,$email_body,$headers);
	return true;		
/*} else {
    $errors = $resp->getErrorCodes();
	return false;
}	*/
?>