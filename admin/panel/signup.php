<?php
error_reporting(0);
include("db_con.php");

//This function separates the extension from the rest of the file name and returns it 
function findexts($filename)  { 
$filename 	= strtolower($filename) ; 
$exts 		= split("[/\\.]", $filename) ; 
$n 			= count($exts)-1; 
$exts 		= $exts[$n]; 
return $exts; 
} 

function encryptIt($q) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded  = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return($qEncoded);
}

	if ($_POST['form_submitted'] == "form_submitted") {					
		if ($_FILES["fileToUpload"]["name"] != "") {					
			$target_dir 	= "uploads/";
			$target_file 	= $target_dir . basename($_FILES["fileToUpload"]["name"]);		
			$uploadOk 		= 1;
			$imageFileType 	= pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
		    $check 			= getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if ($check !== false) {
			        // echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $message 	= "File is not an image.";
			        $uploadOk 	= 0;
			    }
				
				// Check if file already exists
				if (file_exists($target_file)) {
				    $message 	= "Sorry, file already exists.";
				    $uploadOk 	= 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
				    $message 	= "Sorry, your file is too large.";
				    $uploadOk 	= 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				    $message 	= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				    $uploadOk 	= 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
				    echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {						
					//This applies the function to our file  
					$ext = findexts($_FILES['fileToUpload']['name']) ;
					//This line assigns a random number to a variable. You could also use a timestamp here if you prefer. 
					$ran = rand () ;						
					//This takes the random number (or timestamp) you generated and adds a . on the end, so it is ready of the file extension to be appended.
					$ran2 = $ran.".";						
					//This assigns the subdirectory you want to save into... make sure it exists!
					$target = "uploads/";						
					//This combines the directory, the random file name, and the extension
					$target = $target . $ran2.$ext; 
						if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target)) {
					    
					        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
					        
					    } else {
					        echo "Sorry, there was an error uploading your file.";
					    }
				}		 	
		}		
		$duplicate_query	= "SELECT id FROM users WHERE username = '".$_POST['email']."'";	
		$result_duplicate	= mysql_query($duplicate_query);
		$num_rows 			= mysql_num_rows($result_duplicate);
			if ($num_rows == 0) {
				$hash_password		= $_POST['password'];				
				$hash_password 		= encryptIt($hash_password);				
				// $insert_query		= "INSERT INTO users(id, username, password, first_name, last_name, email_address, phone1, phone2, address, city, country, photo, id_card_image, status) VALUES (NULL, '".$_POST['email']."', '".$hash_password."', '".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['email']."', '".$_POST['phone1']."', '".$_POST['phone2']."', '".$_POST['address']."', '".$_POST['city']."', '".$_POST['country']."', '".$target."', '', '0')";	
				$insert_query		= "INSERT INTO users(id, username, password, first_name, last_name, email_address, phone1, phone2, address, city, country, photo, id_card_image, status) VALUES (NULL, '".$_POST['email']."', '".$hash_password."', '".$_POST['first_name']."', '".$_POST['last_name']."', '".$_POST['email']."', '', '', '', '', '', '', '', '0')";
				$result_insert 		= mysql_query($insert_query);
				$new_user_id		= mysql_insert_id();
				// the message
				$msg 				= "You have requested for new account on Digital Word. Please click on link below\n http://www.digitstransfer.com/admin/panel/email_verification.php?id=".$new_user_id."";				
				// use wordwrap() if lines are longer than 70 characters
				$msg 				= wordwrap($msg,70);
				$email_address		= $_POST['email'];
				// send email
				@mail($email_address,"Email Verification from Digitstransfer",$msg);
				$message_success 	= "Your account has been created. We have send you an email for verification. Please verify your email address";	
			} else {
				$message_success 	= "This email already registered. Please try with another email address";
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

	<title>Digitstransfer - Sign up</title>

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
    var password		= document.forms["myform"]["password"].value;
    var verify_password	= document.forms["myform"]["verify_password"].value;
    //var first_name		= document.forms["myform"]["first_name"].value;
    //var last_name		= document.forms["myform"]["last_name"].value;
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
	    if (password == null || password == "") {
	        alert("Password must be filled out");
	        document.getElementById("password").focus();
	        return false;
	    }
	    if (verify_password == null || verify_password == "") {
	        alert("Verify Password must be filled out");
	        document.getElementById("verify_password").focus();
	        return false;
	    }
	    if (password != verify_password) {
	    	alert("Verify Password does not match");
	        document.getElementById("verify_password").focus();
	        return false;
	    }
	    /*
	    if (first_name == null || first_name == "") {
	        alert("First Name must be filled out");
	        document.getElementById("first_name").focus();
	        return false;
	    }
	    if (last_name == null || last_name == "") {
	        alert("Last Name must be filled out");
	        document.getElementById("last_name").focus();
	        return false;
	    }
	    */
	}
	</script>
</head>
<body>

	 

	<div class="content">

		<div class="page-header full-content bg-brown">
			<div class="row">
				<div class="col-sm-6">
					<h1>Sign Up<small>&nbsp;Create new free account</small></h1>
				</div><!--.col-->
				<div class="col-sm-6">
					<ol class="breadcrumb">						
						<li><a href="index.php">Login</a></li>
						<li><a href="signup.php" class="active">Sign Up</a></li>
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
						<div class="panel-title"><h4>Sipn Up </h4></div>
					</div><!--.panel-heading-->
					<div class="panel-body">

						<form action="signup.php" name="myform" id="myform" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
							 
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Email Address</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="email" name="email" required="">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Password</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="password" class="form-control" id="password" name="password" required="">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Verify Password</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="password" class="form-control" id="verify_password" name="verify_password" required="">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<!--
								<div class="form-group has-warning has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">First Name</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="first_name" name="first_name">
												<span class="ion-android-warning tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Warning tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-warning has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Last Name</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="last_name" name="last_name">
												<span class="ion-android-warning tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Warning tooltip"></span>
											</div>
										</div>
									</div>
								</div>								
								<div class="form-group has-warning has-feedback">
									<label class="control-label col-md-3" for="inputWarning2">Phone 1</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="phone1" name="phone1">
												<span class="ion-android-warning tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Warning tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-warning has-feedback">
									<label class="control-label col-md-3" for="inputWarning2">Phone 2</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="phone2" name="phone2">
												<span class="ion-android-warning tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Warning tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-warning has-feedback">
									<label class="control-label col-md-3" for="inputWarning2">Address</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="address" name="address">
												<span class="ion-android-warning tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Warning tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-warning has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">City</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="city" name="city">
												<span class="ion-android-warning tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Warning tooltip"></span>
											</div>
										</div>
									</div>
								</div>	
								<div class="form-group has-warning has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Country</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="country" name="country">
												<span class="ion-android-warning tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Warning tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-warning has-feedback">
									<label class="control-label col-md-3" for="inputWarning2">Photo</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
												<span class="ion-android-warning tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Warning tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								-->
								 
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