<?php
//require_once 'lib/swift_required.php';
// Create the Transport
/*$transport = Swift_SmtpTransport::newInstance('mail51.mittwald.de', 25)
    ->setUsername('p113189p1')
    ->setPassword('AndreK1206')
;
*/
// Create the Mailer using your created Transport
//$mailer = Swift_Mailer::newInstance($transport);

$emailTo = 'mail@andre-krug.de';
$siteTitle = 'Andre Krug';


error_reporting(E_ALL ^ E_NOTICE); // hide all basic notices from PHP

//If the form is submitted
if(isset($_POST['submitted'])) {
	
	// require a name from user
	if(trim($_POST['contactName']) === '') {
		$nameError =  'Forgot your name!'; 
		$hasError = true;
	} else {
		$name = trim($_POST['contactName']);
	}
	
	// need valid email
	if(trim($_POST['email']) === '')  {
		$emailError = 'Forgot to enter in your e-mail address.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'You entered an invalid email address.';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
		
	// we need at least some content
	if(trim($_POST['comments']) === '') {
		$commentError = 'You forgot to enter a message!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['comments']));
		} else {
			$comments = trim($_POST['comments']);
		}
	}
		
	// upon no failure errors let's email now!
	if(!isset($hasError)) {
		
		$subject = 'New message to '.$siteTitle.' from '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\nEmail: $email \n\nMessage: $comments";
		$headers = 'From: ' .' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

        //todo akr
        If ($_POST['contactSurName'] == ""){
		    //mail($emailTo, $subject, $body, $headers);
        }
        /*$message = Swift_Message::newInstance('Kontaktformular von andre-krug.de')
            ->setFrom(array($emailSent))
            ->setTo(array($emailTo => 'Andre Krug'))
        ;
        $message->setBody($body);
        $result = $mailer->send($message);
		*/
        //Autoresponse
		$respondSubject = 'Thank you for contacting '.$siteTitle;
		$respondBody = "Your message to $siteTitle has been delivered! \n\nWe will answer back as soon as possible.";
		$respondHeaders = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $emailTo;

        //todo akr
        If ($_POST['contactSurName'] == "") {
            //mail($email, $respondSubject, $respondBody, $respondHeaders);
        }
        /*$message = Swift_Message::newInstance('Kontaktformular von andre-krug.de')
            ->setFrom(array('mail@andre-krug.de'=> 'André Krug'))
            ->setTo(array($email => 'Andre Krug'))
        ;
        $message->setBody($respondBody);
        $result = $mailer->send($message);
		*/
        // set our boolean completion value to TRUE
		$emailSent = true;
	}
}
?>