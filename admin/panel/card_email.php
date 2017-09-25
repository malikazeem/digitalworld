<?php
session_start();
include("db_con2.php");	
	if(!$db) {	
		echo 'Could not connect to the database.';
	} else {
$email_image 	= $_POST['queryString'];
$to				= $_SESSION['email'];
//define the receiver of the email
//define the subject of the email
$subject 	= 'Confirmation of purchase of card on Digitstransfer';
//create a boundary string. It must be unique
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(date('r', time()));
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: webmaster@digittransfer.com\r\nReply-To: webmaster@digittransfer.com";
//add boundary string and mime type specification
$headers .= "\r\nContent-Type: multipart/alternative; boundary=\"PHP-alt-".$random_hash."\"";
//define the body of the message.
ob_start(); //Turn on output buffering
?>
--PHP-alt-<?php echo $random_hash; ?> 
Content-Type: text/plain; charset="iso-8859-1"
Content-Transfer-Encoding: 7bit

Hello World!!! 
This is simple text email message. 

--PHP-alt-<?php echo $random_hash; ?> 
Content-Type: text/html; charset="iso-8859-1"
Content-Transfer-Encoding: 7bit

<h2>Hello</h2>
<p>You have purchased a new card on Digitstransfer. This is your new purchased <b>card</b>. </p>
<img src="<?=$email_image?>" width="282" height="179" />

--PHP-alt-<?php echo $random_hash; ?>--
<?
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $to, $subject, $message, $headers );
	}
?>