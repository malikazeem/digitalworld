<?php
session_start();
include("db_con.php");

function encryptIt($q) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return($qEncoded);
}

$hash_password	= $_POST['password'];				
$hash_password 	= encryptIt($hash_password);	
$login_query	= "SELECT id FROM users WHERE username = '".$_POST['email']."' AND password = '".$hash_password."' AND status = '1'";	
$result_login	= mysql_query($login_query);
$num_rows 		= mysql_num_rows($result_login);
	if ($num_rows != 0) {
		$row_user_id				= mysql_fetch_row($result_login);		
		$_SESSION['is_log_user'] 	= 1; 
		$_SESSION['user_id'] 		= $row_user_id[0];
		$_SESSION['email'] 			= $_POST['email'];
		header("Location: dashboard.php"); 
		exit;	
	} else {		
		$admin_login_query	= "SELECT id FROM admin WHERE username = '".$_POST['email']."' AND password = '".$hash_password."' ";		
		$result_admin_login	= mysql_query($admin_login_query);
		$num_rows_admin		= mysql_num_rows($result_admin_login);	
			if ($num_rows_admin != 0) {
				$_SESSION['is_log_user'] = 2;
				header("Location: dashboard_admin.php"); 
				exit;	
			} else {
				header("Location: index.php?error=1"); 
				exit;
			}	
	}
?>