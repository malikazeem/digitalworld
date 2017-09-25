<?php
error_reporting(0);
include("db_con.php");

function encryptIt($q) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return($qEncoded);
}

function decryptIt($q) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded  = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return($qDecoded);
}

	if ($_POST['form_submitted'] == "form_submitted") {
		$find_query		= "SELECT email_address, password FROM users WHERE username = '".$_POST['email']."'";	
		$result_find	= mysql_query($find_query);
		$num_rows 		= mysql_num_rows($result_find);
		$row 			= mysql_fetch_row($result_find);
		$password		= $row[1];
			if ($num_rows == 0) {
				$message_success 	= "Sorry. This email does not match in our system. Please try again";	
			} else {
				// the message
				$hash_password		= $password;				
				$decrypted 			= decryptIt($hash_password);
				$msg 				= "You have requested for password of Digits Tranfer. You password is\n".$decrypted;				
				// use wordwrap() if lines are longer than 70 characters
				$msg 				= wordwrap($msg,70);
				$email_address		= $_POST['email'];
				// send email
				mail($email_address,"Forgot Password Request",$msg);	
				$message_success 	= "We have sent you am email. Please check your email.";
			}
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Digital Word - Forgot Password</title>

	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

	<!-- BEGIN CORE CSS -->
	<link rel="stylesheet" href="../../assets/admin1/css/admin1.css">
	<link rel="stylesheet" href="../../assets/globals/css/elements.css">
	<!-- END CORE CSS -->

	<!-- BEGIN PLUGINS CSS -->
	<link rel="stylesheet" href="../../assets/globals/plugins/components-summernote/dist/summernote.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/pnikolov-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/minicolors/jquery.minicolors.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/clockface/css/clockface.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	
	<link rel="stylesheet" href="../../assets/globals/css/plugins.css">
	<!-- END PLUGINS CSS -->

	<!-- BEGIN SHORTCUT AND TOUCH ICONS -->
	<link rel="shortcut icon" href="../../assets/globals/img/icons/favicon.ico">
	<link rel="apple-touch-icon" href="../../assets/globals/img/icons/apple-touch-icon.png">
	<!-- END SHORTCUT AND TOUCH ICONS -->

	<script src="../../assets/globals/plugins/modernizr/modernizr.min.js"></script>
	<script>
	
	function checkEmail() {
    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

	    if (!filter.test(email.value)) {
	    	alert('Please provide a valid email address');
	    	email.focus;
	    	return false;
	 	}
 	}
 	
	function validateForm() {
    var email 			= document.forms["myform"]["email"].value;    
        if (email == null || email == "") {
	        alert("Email must be filled out");
	        document.getElementById("email").focus();
	        return false;
	    }
	var email_validator = checkEmail();
    	if (email_validator == false) {
    		document.getElementById("email").focus();
    		return false;
    	}	    
	}
	</script>
</head>
<body>

	 

	<div class="content">

		<div class="page-header full-content bg-brown">
			<div class="row">
				<div class="col-sm-6">
					<h1>Forgot Password<small>&nbsp;Provide your email address</small></h1>
				</div><!--.col-->
				<div class="col-sm-6">
					<ol class="breadcrumb">						
						<li><a href="index.php">Login</a></li>
						<li><a href="forgot_password.php" class="active">Forgot Password</a></li>
					</ol>
				</div><!--.col-->
			</div><!--.row-->
		</div><!--.page-header-->
			<div align="center" style="color: red;">
				<?=$message?>
				<?=$message_success?>
			</div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-title"><h4>Forgot Password </h4></div>
					</div><!--.panel-heading-->
					<div class="panel-body">

						<form action="forgot_password.php" name="myform" id="myform" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
							 
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Email Address</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="email" name="email">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								 
								 
							</div><!--.row-->
							
							<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<input type="submit" class="btn btn-primary" value="Save">
											<input type="reset" class="btn btn-primary" value="Cancel">
											<input type="hidden" value="form_submitted" name="form_submitted">
										</div>
									</div>
							</div>
								
						</form>

					</div><!--.panel-body-->
				</div><!--.panel-->
			</div><!--.col-md-12-->
		</div><!--.row-->

		
		 

	</div><!--.content-->

	 
	<!-- BEGIN GLOBAL AND THEME VENDORS -->
	<script src="../../assets/globals/js/global-vendors.js"></script>
	<!-- END GLOBAL AND THEME VENDORS -->

	<!-- BEGIN PLUGINS AREA -->
	<script src="../../assets/globals/plugins/components-summernote/dist/summernote.min.js"></script>
	<script src="../../assets/globals/plugins/parsleyjs/dist/parsley.min.js"></script>
	<!-- END PLUGINS AREA -->

	<!-- PLUGINS INITIALIZATION AND SETTINGS -->
	<script src="../../assets/globals/scripts/forms-validations-parsley.js"></script>
	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->
	
	<!-- BEGIN PLUGINS AREA -->
	<script src="../../assets/globals/plugins/pnikolov-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="../../assets/globals/plugins/minicolors/jquery.minicolors.min.js"></script>
	<script src="../../assets/globals/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="../../assets/globals/plugins/clockface/js/clockface.js"></script>
	<!-- END PLUGINS AREA -->

	<!-- PLUGINS INITIALIZATION AND SETTINGS -->
	<script src="../../assets/globals/scripts/forms-pickers.js"></script>
	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->
	
	<!-- OMIS -->
	<script src="../../assets/globals/js/pleasure.js"></script>
	<!-- ADMIN 1 -->
	<script src="../../assets/admin1/js/layout.js"></script>

	<!-- BEGIN INITIALIZATION-->
	<script>
	$(document).ready(function () {
		Pleasure.init();
		Layout.init();
		FormsValidationsParsley.init();
	});
	</script>
	<!-- END INITIALIZATION-->

	

</body>
</html>