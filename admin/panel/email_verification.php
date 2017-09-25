<?php
error_reporting(0);
include("db_con.php");
$id 			= $_REQUEST['id'];
$find_query		= "SELECT username from users WHERE id = '".$id."'";	
$result_find	= mysql_query($find_query);
$num_rows 		= mysql_num_rows($result_find);
	if ($num_rows != 0) {
		$verify_query	= "UPDATE users SET status = '1' WHERE id = '".$id."'";								
		$result_verify	= mysql_query($verify_query);
		$message		= "Welcome. You are verified successfuly to Digitstransfer. You can <a href='index.php'>login here </a>now.";		 
	} else {
		$message		= "Uuauthorize access. Please go to <a href='index.php'>login page</a> now.";
	}
echo $message;	
?>
