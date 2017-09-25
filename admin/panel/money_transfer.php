<?php
session_start();
	if ($_SESSION['is_log_user'] != 1) {			
		header("Location: index.php?error=1.php"); 
		exit;
	}	
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
$message 	= "";
// echo $_SESSION['user_id'];
	if ($_POST['form_submitted'] == "form_submitted") {					
			$today 			= date("Y-m-d H:i:s");
			$find_query		= "SELECT balance FROM balance WHERE user_id = '".$_SESSION['user_id']."' ";	
			$result_find	= mysql_query($find_query);
			$num_rows 		= mysql_num_rows($result_find);			
				if ($num_rows != 0) {
					$row_find_balance 		= mysql_fetch_row($result_find);					
					$balance				= $row_find_balance[0];
						if ($balance < $_POST['amount']) {
							$message = "Sorry, You have insufficient balance";		
						} else {
							if ($_FILES["card_image"]["name"] != "") {														
								$target_dir 	= "psokew/";
								$target_file 	= $target_dir . basename($_FILES["card_image"]["name"]);		
								$uploadOk 		= 1;
								$imageFileType 	= pathinfo($target_file,PATHINFO_EXTENSION);
								// Check if image file is a actual image or fake image
							    $check 			= getimagesize($_FILES["card_image"]["tmp_name"]);
								
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
									if ($_FILES["card_image"]["size"] > 500000) {
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
										$ext 	= findexts($_FILES['card_image']['name']) ;
										//This line assigns a random number to a variable. You could also use a timestamp here if you prefer. 
										$ran 	= rand () ;						
										//This takes the random number (or timestamp) you generated and adds a . on the end, so it is ready of the file extension to be appended.
										$ran2 	= $ran.".";						
										//This assigns the subdirectory you want to save into... make sure it exists!
										$target = "psokew/";						
										//This combines the directory, the random file name, and the extension
										$target = $target . $ran2.$ext; 
											if (move_uploaded_file($_FILES['card_image']['tmp_name'], $target)) {										    
										        // echo "The file ". basename( $_FILES["card_image"]["name"]). " has been uploaded.";
										        $id_card_query	= "UPDATE users SET id_card_image = '".$target."' WHERE id = '".$_SESSION['user_id']."' ";
												$result_id_card	= mysql_query($id_card_query);
										    } else {
										        echo "Sorry, there was an error uploading your file.";
										    }
									}		 	
							}	
							$money_transfer_query	= "INSERT INTO money_transaction(id, user_id, amount, payment_method, receiver_name, receiver_address, receiver_phone, receiver_country, sender_name, sender_address, sender_phone, sender_country, sender_email, status, request_time_date, code) VALUES (NULL, '".$_SESSION['user_id']."', '".$_POST['amount']."', '".$_POST['payment_method']."', '".$_POST['receiver_name']."', '".$_POST['receiver_address']."', '".$_POST['receiver_phone']."', '".$_POST['receiver_country']."', '".$_POST['sender_name']."', '".$_POST['sender_address']."', '".$_POST['sender_phone']."', '".$_POST['sender_country']."', '".$_SESSION['email']."', 'Pending', '".$today."', NULL)";	
							$result_money_transfer	= mysql_query($money_transfer_query);							
								if (!$result_money_transfer) {
									die(mysql_error());
								}
							$new_balance			= $balance - $_POST['amount'];
							$balance_update_query	= "UPDATE balance SET balance = '".$new_balance."' WHERE user_id = '".$_SESSION['user_id']."' ";								
							$result_balance_update	= mysql_query($balance_update_query);							
							$transaction_query		= "INSERT INTO transaction_history(id, user_id, amount, time_date) VALUES (NULL, '".$_SESSION['user_id']."', '".$_POST['amount']."', '".$today."')";	
							$result_transaction		= mysql_query($transaction_query);	
							$message 				= "Your money transfer request is successful. Shortly you will recieve email with code. Send that code to receiver";
							$msg 					= "Hi, admin, '".$_SESSION['email']."' has a request for money transfer for amount SEK '".$_POST['amount']."' using payment method '".$_POST['payment_method']."'. Please login to admin panel of digitaltransfer for details in money transfer requests page.";
							// use wordwrap() if lines are longer than 70 characters
							$msg = wordwrap($msg,70);
							// send email
							@mail("basitjee1@hotmail.com","Notification, Money Transfer Request", $msg);					
						}										 
				} else {		
					$message = "You have insufficient balance";
				}
	} else {
		 
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

	<title>Digital Word - Money Transfer</title>

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
	
	function validateForm() {				
	
	
	var is_id_card_exist 		= document.getElementById('id_card_image_element').src;  
	var file_extention_array 	= is_id_card_exist.split(".");
	var file_extention			= file_extention_array[1]; 	
	
	var card_image				= $('input[type="file"]').val();	
	// var card_image			= document.forms["money_transfer_form"]["card_image"].value;	
	var inputtxt				= document.forms["money_transfer_form"]["amount"];
    var numbers 				= /^[0-9]+$/;     	
    	if (file_extention == "php") {
    		if (card_image == null || card_image == "") {
     			alert('Please Upload Id Card Image');
      			return false;  
     		}	
    	}    	
    	if (inputtxt.value.match(numbers)) {    		
      		return true;  
      	} else {
      		alert('Please input numeric characters only');  
      		document.money_transfer_form.amount.focus();  
      		return false;  
      	}	        	  
    }   
	
	</script>
	
</head>
<body>

	<div class="nav-bar-container">

		<!-- BEGIN ICONS -->
		<div class="nav-menu">
			<div class="hamburger">
				<span class="patty"></span>
				<span class="patty"></span>
				<span class="patty"></span>
				<span class="patty"></span>
				<span class="patty"></span>
				<span class="patty"></span>
			</div><!--.hamburger-->
		</div><!--.nav-menu-->

		<div class="nav-search">
			<!-- <span class="search"></span> -->
		</div><!--.nav-search-->

		<div class="nav-user">
			<div class="user">
				<!--
				<img src="../../assets/globals/img/faces/tolga-ergin.jpg" alt="">
				<span class="badge">3</span>
				-->
			</div><!--.user-->
			<div class="cross">
				<span class="line"></span>
				<span class="line"></span>
			</div><!--.cross-->
		</div><!--.nav-user-->
		<!-- END OF ICONS -->

		<div class="nav-bar-border"></div><!--.nav-bar-border-->

		<!-- BEGIN OVERLAY HELPERS -->
		<div class="overlay">
			<div class="starting-point">
				<span></span>
			</div><!--.starting-point-->
			<div class="logo">PLEASURE</div><!--.logo-->
		</div><!--.overlay-->

		<div class="overlay-secondary"></div><!--.overlay-secondary-->
		<!-- END OF OVERLAY HELPERS -->

	</div><!--.nav-bar-container-->

	<div class="content">

		<div class="page-header full-content bg-brown">
			<div class="row">
				<div class="col-sm-6">
					<h1>Money Transfer<small>&nbsp; Generate request</small></h1>
				</div><!--.col-->
				<?php
				$find_query			= "SELECT balance FROM balance WHERE user_id = '".$_SESSION['user_id']."' ";	
				$result_find		= mysql_query($find_query);
				$row_find_balance 	= mysql_fetch_row($result_find);
				$balance			= $row_find_balance[0];
				?>
				<div class="col-sm-6">
					<ol class="breadcrumb">
						<li><a href="dashboard.php"><i class="ion-home"></i></a></li>
						<li><a href="dashboard.php">Dashboard</a></li>
						<li><a href="logout.php">Logout</a></li>
						<li><a href="money_transfer.php" class="active">Money Transfer</a></li>
						<li><a href="#" class="active">Balance <?=$balance?> SEK</a></li>
					</ol>
				</div><!--.col-->
			</div><!--.row-->
		</div><!--.page-header-->
		<div align="center" style="color: red;">
			<?=$message?>
		</div>
			
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-title"><h4>Provide details</h4></div>
					</div><!--.panel-heading-->
					<div class="panel-body">
						<?php
						$money_transfer_flag 	= 0;
						$profile_query			= "SELECT * FROM users WHERE id = '".$_SESSION['user_id']."' ";	
						$result_profile			= mysql_query($profile_query);
						$row_profile			= mysql_fetch_row($result_profile);
						$first_name				= $row_profile[3];
						$last_name				= $row_profile[4];
						$phone1					= $row_profile[6];
						$phone2					= $row_profile[7];
						$address				= $row_profile[8];
						$city					= $row_profile[9];
						$country				= $row_profile[10];
							if ($first_name == "") {
								$money_transfer_flag = 1;		
							}
							if ($last_name == "") {
								$money_transfer_flag = 1;		
							}
							if ($phone1 == "") {
								$money_transfer_flag = 1;		
							}
							if ($address == "") {
								$money_transfer_flag = 1;		
							}
							if ($city == "") {
								$money_transfer_flag = 1;		
							}
							if ($country == "") {
								$money_transfer_flag = 1;		
							}
							if ($money_transfer_flag == 1) {
									$disable 				= "display: none;";
									$message_money_transfer = "Plesae complete your profile. Then you can use money transfer service"; 
								} else {
									$disable 				= "display: block;";
									$message_money_transfer = "";
							}							
						?>
						<div align="center" style="color: red;">
							<?=$message_money_transfer?>
						</div>
						<form enctype="multipart/form-data" id="money_transfer_form" name="money_transfer_form" action="money_transfer.php" method="post" class="form-horizontal" onsubmit="return validateForm();">							 
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Amount (SEK)</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="amount" name="amount" required="">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div><!--.row-->
							<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Payment Method</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<select name="payment_method" id="payment_method" class="selecter" required="required">
													<option value="" selected="selected">Select One</option>
													<option value="Western Union">Western Union</option>
													<option value="Small World">Small World</option>
													<option value="MoneyGram">MoneyGram</option>
													<option value="Ria">Ria</option>
												</select>												
											</div>
										</div>
									</div>
							</div> 
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Receiver Name</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="receiver_name" name="receiver_name" required="">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div><!--.row-->
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Receiver Address</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="receiver_address" name="receiver_address">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div><!--.row-->
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Receiver Phone</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="receiver_phone" name="receiver_phone" required="">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div><!--.row-->
							
							<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Receiver Country</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<select name="receiver_country" id="receiver_country" class="selecter" required="required">												
													<option value="" selected="selected">Select</option>
													<option value="Afghanistan">Afghanistan</option>
													<option value="Åland Islands">Åland Islands</option>
													<option value="Albania">Albania</option>
													<option value="Algeria">Algeria</option>
													<option value="American Samoa">American Samoa</option>
													<option value="Andorra">Andorra</option>
													<option value="Angola">Angola</option>
													<option value="Anguilla">Anguilla</option>
													<option value="Antarctica">Antarctica</option>
													<option value="Antigua and Barbuda">Antigua and Barbuda</option>
													<option value="Argentina">Argentina</option>
													<option value="Armenia">Armenia</option>
													<option value="Aruba">Aruba</option>
													<option value="Australia">Australia</option>
													<option value="Austria">Austria</option>
													<option value="Azerbaijan">Azerbaijan</option>
													<option value="Bahamas">Bahamas</option>
													<option value="Bahrain">Bahrain</option>
													<option value="Bangladesh">Bangladesh</option>
													<option value="Barbados">Barbados</option>
													<option value="Belarus">Belarus</option>
													<option value="Belgium">Belgium</option>
													<option value="Belize">Belize</option>
													<option value="Benin">Benin</option>
													<option value="Bermuda">Bermuda</option>
													<option value="Bhutan">Bhutan</option>
													<option value="Bolivia">Bolivia</option>
													<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
													<option value="Botswana">Botswana</option>
													<option value="Bouvet Island">Bouvet Island</option>
													<option value="Brazil">Brazil</option>
													<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
													<option value="Brunei Darussalam">Brunei Darussalam</option>
													<option value="Bulgaria">Bulgaria</option>
													<option value="Burkina Faso">Burkina Faso</option>
													<option value="Burundi">Burundi</option>
													<option value="Cambodia">Cambodia</option>
													<option value="Cameroon">Cameroon</option>
													<option value="Canada">Canada</option>
													<option value="Cape Verde">Cape Verde</option>
													<option value="Cayman Islands">Cayman Islands</option>
													<option value="Central African Republic">Central African Republic</option>
													<option value="Chad">Chad</option>
													<option value="Chile">Chile</option>
													<option value="China">China</option>
													<option value="Christmas Island">Christmas Island</option>
													<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
													<option value="Colombia">Colombia</option>
													<option value="Comoros">Comoros</option>
													<option value="Congo">Congo</option>
													<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
													<option value="Cook Islands">Cook Islands</option>
													<option value="Costa Rica">Costa Rica</option>
													<option value="Cote Divoire">Cote Divoire</option>
													<option value="Croatia">Croatia</option>
													<option value="Cuba">Cuba</option>
													<option value="Cyprus">Cyprus</option>
													<option value="Czech Republic">Czech Republic</option>
													<option value="Denmark">Denmark</option>
													<option value="Djibouti">Djibouti</option>
													<option value="Dominica">Dominica</option>
													<option value="Dominican Republic">Dominican Republic</option>
													<option value="Ecuador">Ecuador</option>
													<option value="Egypt">Egypt</option>
													<option value="El Salvador">El Salvador</option>
													<option value="Equatorial Guinea">Equatorial Guinea</option>
													<option value="Eritrea">Eritrea</option>
													<option value="Estonia">Estonia</option>
													<option value="Ethiopia">Ethiopia</option>
													<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
													<option value="Faroe Islands">Faroe Islands</option>
													<option value="Fiji">Fiji</option>
													<option value="Finland">Finland</option>
													<option value="France">France</option>
													<option value="French Guiana">French Guiana</option>
													<option value="French Polynesia">French Polynesia</option>
													<option value="French Southern Territories">French Southern Territories</option>
													<option value="Gabon">Gabon</option>
													<option value="Gambia">Gambia</option>
													<option value="Georgia">Georgia</option>
													<option value="Germany">Germany</option>
													<option value="Ghana">Ghana</option>
													<option value="Gibraltar">Gibraltar</option>
													<option value="Greece">Greece</option>
													<option value="Greenland">Greenland</option>
													<option value="Grenada">Grenada</option>
													<option value="Guadeloupe">Guadeloupe</option>
													<option value="Guam">Guam</option>
													<option value="Guatemala">Guatemala</option>
													<option value="Guernsey">Guernsey</option>
													<option value="Guinea">Guinea</option>
													<option value="Guinea-bissau">Guinea-bissau</option>
													<option value="Guyana">Guyana</option>
													<option value="Haiti">Haiti</option>
													<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
													<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
													<option value="Honduras">Honduras</option>
													<option value="Hong Kong">Hong Kong</option>
													<option value="Hungary">Hungary</option>
													<option value="Iceland">Iceland</option>
													<option value="India">India</option>
													<option value="Indonesia">Indonesia</option>
													<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
													<option value="Iraq">Iraq</option>
													<option value="Ireland">Ireland</option>
													<option value="Isle of Man">Isle of Man</option>
													<option value="Israel">Israel</option>
													<option value="Italy">Italy</option>
													<option value="Jamaica">Jamaica</option>
													<option value="Japan">Japan</option>
													<option value="Jersey">Jersey</option>
													<option value="Jordan">Jordan</option>
													<option value="Kazakhstan">Kazakhstan</option>
													<option value="Kenya">Kenya</option>
													<option value="Kiribati">Kiribati</option>
													<option value="Korea, Democratic People Republic of">Korea, Democratic People Republic of</option>
													<option value="Korea, Republic of">Korea, Republic of</option>
													<option value="Kuwait">Kuwait</option>
													<option value="Kyrgyzstan">Kyrgyzstan</option>
													<option value="Lao Peoples Democratic Republic">Lao Peoples Democratic Republic</option>
													<option value="Latvia">Latvia</option>
													<option value="Lebanon">Lebanon</option>
													<option value="Lesotho">Lesotho</option>
													<option value="Liberia">Liberia</option>
													<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
													<option value="Liechtenstein">Liechtenstein</option>
													<option value="Lithuania">Lithuania</option>
													<option value="Luxembourg">Luxembourg</option>
													<option value="Macao">Macao</option>
													<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
													<option value="Madagascar">Madagascar</option>
													<option value="Malawi">Malawi</option>
													<option value="Malaysia">Malaysia</option>
													<option value="Maldives">Maldives</option>
													<option value="Mali">Mali</option>
													<option value="Malta">Malta</option>
													<option value="Marshall Islands">Marshall Islands</option>
													<option value="Martinique">Martinique</option>
													<option value="Mauritania">Mauritania</option>
													<option value="Mauritius">Mauritius</option>
													<option value="Mayotte">Mayotte</option>
													<option value="Mexico">Mexico</option>
													<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
													<option value="Moldova, Republic of">Moldova, Republic of</option>
													<option value="Monaco">Monaco</option>
													<option value="Mongolia">Mongolia</option>
													<option value="Montenegro">Montenegro</option>
													<option value="Montserrat">Montserrat</option>
													<option value="Morocco">Morocco</option>
													<option value="Mozambique">Mozambique</option>
													<option value="Myanmar">Myanmar</option>
													<option value="Namibia">Namibia</option>
													<option value="Nauru">Nauru</option>
													<option value="Nepal">Nepal</option>
													<option value="Netherlands">Netherlands</option>
													<option value="Netherlands Antilles">Netherlands Antilles</option>
													<option value="New Caledonia">New Caledonia</option>
													<option value="New Zealand">New Zealand</option>
													<option value="Nicaragua">Nicaragua</option>
													<option value="Niger">Niger</option>
													<option value="Nigeria">Nigeria</option>
													<option value="Niue">Niue</option>
													<option value="Norfolk Island">Norfolk Island</option>
													<option value="Northern Mariana Islands">Northern Mariana Islands</option>
													<option value="Norway">Norway</option>
													<option value="Oman">Oman</option>
													<option value="Pakistan">Pakistan</option>
													<option value="Palau">Palau</option>
													<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
													<option value="Panama">Panama</option>
													<option value="Papua New Guinea">Papua New Guinea</option>
													<option value="Paraguay">Paraguay</option>
													<option value="Peru">Peru</option>
													<option value="Philippines">Philippines</option>
													<option value="Pitcairn">Pitcairn</option>
													<option value="Poland">Poland</option>
													<option value="Portugal">Portugal</option>
													<option value="Puerto Rico">Puerto Rico</option>
													<option value="Qatar">Qatar</option>
													<option value="Reunion">Reunion</option>
													<option value="Romania">Romania</option>
													<option value="Russian Federation">Russian Federation</option>
													<option value="Rwanda">Rwanda</option>
													<option value="Saint Helena">Saint Helena</option>
													<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
													<option value="Saint Lucia">Saint Lucia</option>
													<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
													<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
													<option value="Samoa">Samoa</option>
													<option value="San Marino">San Marino</option>
													<option value="Sao Tome and Principe">Sao Tome and Principe</option>
													<option value="Saudi Arabia">Saudi Arabia</option>
													<option value="Senegal">Senegal</option>
													<option value="Serbia">Serbia</option>
													<option value="Seychelles">Seychelles</option>
													<option value="Sierra Leone">Sierra Leone</option>
													<option value="Singapore">Singapore</option>
													<option value="Slovakia">Slovakia</option>
													<option value="Slovenia">Slovenia</option>
													<option value="Solomon Islands">Solomon Islands</option>
													<option value="Somalia">Somalia</option>
													<option value="th Africa">South Africa</option>
													<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
													<option value="Spain">Spain</option>
													<option value="Sri Lanka">Sri Lanka</option>
													<option value="Sudan">Sudan</option>
													<option value="Suriname">Suriname</option>
													<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
													<option value="Swaziland">Swaziland</option>
													<option value="Sweden">Sweden</option>
													<option value="Switzerland">Switzerland</option>
													<option value="Syrian Arab Republic">Syrian Arab Republic</option>
													<option value="Taiwan, Province of China">Taiwan, Province of China</option>
													<option value="Tajikistan">Tajikistan</option>
													<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
													<option value="Thailand">Thailand</option>
													<option value="Timor-leste">Timor-leste</option>
													<option value="Togo">Togo</option>
													<option value="Tokelau">Tokelau</option>
													<option value="Tonga">Tonga</option>
													<option value="Trinidad and Tobago">Trinidad and Tobago</option>
													<option value="Tunisia">Tunisia</option>
													<option value="Turkey">Turkey</option>
													<option value="Turkmenistan">Turkmenistan</option>
													<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
													<option value="Tuvalu">Tuvalu</option>
													<option value="Uganda">Uganda</option>
													<option value="Ukraine">Ukraine</option>
													<option value="United Arab Emirates">United Arab Emirates</option>
													<option value="United Kingdom">United Kingdom</option>
													<option value="United States">United States</option>
													<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
													<option value="Uruguay">Uruguay</option>
													<option value="Uzbekistan">Uzbekistan</option>
													<option value="Vanuatu">Vanuatu</option>
													<option value="Venezuela">Venezuela</option>
													<option value="Viet Nam">Viet Nam</option>
													<option value="Virgin Islands British">Virgin Islands British</option>
													<option value="Virgin Islands U.S.">Virgin Islands U.S.</option>
													<option value="Wallis and Futuna">Wallis and Futuna</option>
													<option value="Western Sahara">Western Sahara</option>
													<option value="Yemen">Yemen</option>
													<option value="Zambia">Zambia</option>
													<option value="Zimbabwe">Zimbabwe</option>
												</select>												
											</div>
										</div>
									</div>
							</div> 
							
							<!--
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Receiver Country</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">												
												<input type="text" class="form-control" id="receiver_country" name="receiver_country" required="">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							-->
							
							<?php
							$sender_query	= "SELECT * FROM users WHERE id = '".$_SESSION['user_id']."' ";	
							$result_sender	= mysql_query($sender_query);
							$row_sender		= mysql_fetch_row($result_sender);
							$first_name		= $row_sender[3];
							$last_name		= $row_sender[4];						
							$phone			= $row_sender[6];
							$address		= $row_sender[8];
							$city			= $row_sender[9];
							$country		= $row_sender[10];
							$id_card_image	= $row_sender[12];
							$full_name		= $first_name." ".$last_name;
							?>
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Sender Name</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="sender_name" name="sender_name" required="" value="<?=$full_name?>">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div><!--.row-->
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Sender Address</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="sender_address" name="sender_address" required="" value="<?=$address?>">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div><!--.row-->
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Sender Phone</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="sender_phone" name="sender_phone" required="" value="<?=$phone?>">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div><!--.row-->
							<div class="row">
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Sender Country</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="sender_country" name="sender_country" required="" value="<?=$country?>">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div><!--.row-->
							<div class="form-group has-success has-feedback" <?=$style_id_card_image?> >
									<label class="control-label col-md-3" for="inputSuccess2">Your Card Image</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<img src="<?=$id_card_image?>" id="id_card_image_element">
											</div>
										</div>
									</div>
							</div>
							
							<div class="form-group has-success has-feedback" <?=$style_id_card_upload?>>
									<label class="control-label col-md-3" for="inputSuccess2">Upload Id Card Image</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="file" class="form-control" id="card_image" name="card_image">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
							</div>
							<?php
								if ($money_transfer_flag == 1) {
									$disable = "display: none;"; 
								} else {
									$disable = "display: block;";
								}
							?>
							
							<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-primary" style="<?=$disable?>" >Send Money</button>
											<button type="reset" class="btn btn-default bv-reset">Cancel</button>
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

	<div class="layer-container">

		<!-- BEGIN MENU LAYER -->
		<?php
		include("menu.php");
		?>
		
		<!-- END OF MENU LAYER -->

		<!-- BEGIN SEARCH LAYER -->
		<div class="search-layer">
			<div class="search">
				<form action="pages-search-results.html">
					<div class="form-group">
						<input type="text" id="input-search" class="form-control" placeholder="type something">
						<button type="submit" class="btn btn-default disabled"><i class="ion-search"></i></button>
					</div>
				</form>
			</div><!--.search-->

			<div class="results">
				<div class="row">
					<div class="col-md-4">
						<div class="result result-users">
							<h4>USERS <small>(3)</small></h4>

							<ul class="list-material">
								<li class="has-action-left">
									<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
									<a href="#" class="visible">
										<div class="list-action-left">
											<img src="../../assets/globals/img/faces/1.jpg" class="face-radius" alt="">
										</div>
										<div class="list-content">
											<span class="title">Pari Subramanium</span>
											<span class="caption">Legacy Response Assistant</span>
										</div>
									</a>
								</li>
								<li class="has-action-left">
									<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
									<a href="#" class="visible">
										<div class="list-action-left">
											<img src="../../assets/globals/img/faces/10.jpg" class="face-radius" alt="">
										</div>
										<div class="list-content">
											<span class="title">Andrew Fox</span>
											<span class="caption">National Branding Technician</span>
										</div>
									</a>
								</li>
								<li class="has-action-left">
									<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
									<a href="#" class="visible">
										<div class="list-action-left">
											<img src="../../assets/globals/img/faces/11.jpg" class="face-radius" alt="">
										</div>
										<div class="list-content">
											<span class="title">Lieke Vermeulen</span>
											<span class="caption">Global Tactics Consultant</span>
										</div>
									</a>
								</li>
							</ul>

						</div><!--.results-user-->
					</div><!--.col-->
					<div class="col-md-4">
						<div class="result result-posts">
							<h4>POSTS <small>(5)</small></h4>

							<ul class="list-material">
								<li class="has-action-left">
									<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
									<a href="#" class="visible">
										<div class="list-action-left">
											<img src="../../assets/globals/img/picjumbo/1.jpg" class="img-radius" alt="">
										</div>
										<div class="list-content">
											<span class="title">Mobile Trends for 2015</span>
											<span class="caption">Collaboratively administrate empowered markets via plug-and-play networks.</span>
										</div>
									</a>
								</li>
								<li class="has-action-left">
									<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
									<a href="#" class="visible">
										<div class="list-action-left">
											<img src="../../assets/globals/img/picjumbo/10.jpg" class="img-radius" alt="">
										</div>
										<div class="list-content">
											<span class="title">Interview with Phillip Riley</span>
											<span class="caption">Dynamically procrastinate B2C users after installed base benefits.</span>
										</div>
									</a>
								</li>
								<li class="has-action-left">
									<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
									<a href="#" class="visible">
										<div class="list-action-left">
											<img src="../../assets/globals/img/picjumbo/11.jpg" class="img-radius" alt="">
										</div>
										<div class="list-content">
											<span class="title">Workspaces</span>
											<span class="caption">Dramatically visualize customer directed convergence without revolutionary ROI.</span>
										</div>
									</a>
								</li>
								<li class="has-action-left">
									<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
									<a href="#" class="visible">
										<div class="list-action-left">
											<img src="../../assets/globals/img/picjumbo/5.jpg" class="img-radius" alt="">
										</div>
										<div class="list-content">
											<span class="title">Graphics &amp; Multimedia</span>
											<span class="caption">Efficiently unleash cross-media information without cross-media value.</span>
										</div>
									</a>
								</li>
								<li class="has-action-left">
									<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
									<a href="#" class="visible">
										<div class="list-action-left">
											<img src="../../assets/globals/img/picjumbo/6.jpg" class="img-radius" alt="">
										</div>
										<div class="list-content">
											<span class="title">Interactive Storytelling</span>
											<span class="caption">Quickly maximize timely deliverables for real-time schemas.</span>
										</div>
									</a>
								</li>
							</ul>

						</div><!--.results-posts-->
					</div><!--.col-->
					<div class="col-md-4">
						<div class="result result-files">
							<h4>FILES <small>(0)</small></h4>
							<p>No results were found</p>
						</div><!--.results-files-->
					</div><!--.col-->

				</div><!--.row-->
			</div><!--.results-->
		</div><!--.search-layer-->
		<!-- END OF SEARCH LAYER -->

		<!-- BEGIN USER LAYER -->
		<div class="user-layer">
			<ul class="nav nav-tabs nav-justified" role="tablist">
				<li class="active"><a href="#messages" data-toggle="tab">Messages</a></li>
				<li><a href="#notifications" data-toggle="tab">Notifications <span class="badge">3</span></a></li>
				<li><a href="#settings" data-toggle="tab">Settings</a></li>
			</ul>

			<div class="row no-gutters tab-content">

				<div class="tab-pane fade in active" id="messages">
					<div class="col-md-4">
						<div class="message-list-overlay"></div>

						<ul class="list-material message-list">
							<li class="has-action-left has-action-right">
								<a href="#" class="visible" data-message-id="1">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/1.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="title">Pari Subramanium</span>
										<span class="caption">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.</span>
									</div>
									<div class="list-action-right">
										<span class="top">15 min</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right">
								<a href="#" class="visible" data-message-id="2">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/10.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="title">Andrew Fox</span>
										<span class="caption">Dramatically visualize customer directed convergence without revolutionary ROI. Efficiently unleash cross-media information without cross-media value.</span>
									</div>
									<div class="list-action-right">
										<span class="top">2 hr</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right">
								<a href="#" class="visible" data-message-id="3">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/11.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="title">Lieke Vermeulen</span>
										<span class="caption">Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.</span>
									</div>
									<div class="list-action-right">
										<span class="top">Yesterday</span>
										<i class="ion-android-volume-off bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right">
								<a href="#" class="visible" data-message-id="4">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/2.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="title">Benjamin Beck</span>
										<span class="caption">Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.</span>
									</div>
									<div class="list-action-right">
										<span class="top">1 week ago</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right">
								<a href="#" class="visible" data-message-id="5">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/12.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="title">Joshua Harris</span>
										<span class="caption">Dynamically innovate resource-leveling customer service for state of the art customer service. Objectively innovate empowered manufactured products whereas parallel platforms.</span>
									</div>
									<div class="list-action-right">
										<span class="top">Jan 10, 2015</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right">
								<a href="#" class="visible" data-message-id="1">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/13.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="title">Lisa Cooper</span>
										<span class="caption">Holisticly predominate extensible testing procedures for reliable supply chains. Dramatically engage top-line web services vis-a-vis cutting-edge deliverables.</span>
									</div>
									<div class="list-action-right">
										<span class="top">Jan 5, 2015</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right">
								<a href="#" class="visible" data-message-id="2">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/16.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="title">Matthew Harris</span>
										<span class="caption">Globally incubate standards compliant channels before scalable benefits. </span>
									</div>
									<div class="list-action-right">
										<span class="top">Jan 4, 2015</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right">
								<a href="#" class="visible" data-message-id="3">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/17.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="title">Diana Nguyen</span>
										<span class="caption">Happy new yeaar!!</span>
									</div>
									<div class="list-action-right">
										<span class="top">Jan 1, 2015</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
						</ul>
					</div><!--.col-->
					<div class="col-md-8">
						<div class="message-send-container">

							<div class="messages">
								<div class="message left">
									<div class="message-text">Hello!</div>
									<img src="../../assets/globals/img/faces/1.jpg" class="user-picture" alt="">
								</div>
								<div class="message right">
									<div class="message-text">Hi!</div>
									<div class="message-text">Credibly innovate granular internal or "organic" sources whereas high standards in web-readiness. Energistically scale future-proof core competencies vis-a-vis impactful experiences.</div>
									<img src="../../assets/globals/img/faces/tolga-ergin.jpg" class="user-picture" alt="">
								</div>
								<div class="message left">
									<div class="message-text">Dramatically synthesize integrated schemas with optimal networks.</div>
									<img src="../../assets/globals/img/faces/1.jpg" class="user-picture" alt="">
								</div>
								<div class="message right">
									<div class="message-text">Interactively procrastinate high-payoff content</div>
									<img src="../../assets/globals/img/faces/tolga-ergin.jpg" class="user-picture" alt="">
								</div>
								<div class="message left">
									<div class="message-text">Globally incubate standards compliant channels before scalable benefits. Quickly disseminate superior deliverables whereas web-enabled applications. Quickly drive clicks-and-mortar catalysts for change before vertical architectures.</div>
									<div class="message-text">Credibly reintermediate backend ideas for cross-platform models. Continually reintermediate integrated processes through technically sound intellectual capital. Holistically foster superior methodologies without market-driven best practices.</div>
									<img src="../../assets/globals/img/faces/1.jpg" class="user-picture" alt="">
								</div>
								<div class="message right">
									<div class="message-text">Distinctively exploit optimal alignments for intuitive bandwidth</div>
									<img src="../../assets/globals/img/faces/tolga-ergin.jpg" class="user-picture" alt="">
								</div>
								<div class="message left">
									<div class="message-text">Quickly coordinate e-business applications through</div>
									<img src="../../assets/globals/img/faces/1.jpg" class="user-picture" alt="">
								</div>
							</div><!--.messages-->

							<div class="send-message">
								<div class="input-group">
									<div class="inputer inputer-blue">
										<div class="input-wrapper">
											<textarea rows="1" id="send-message-input" class="form-control js-auto-size" placeholder="Message"></textarea>
										</div>
									</div><!--.inputer-->
									<span class="input-group-btn">
										<button id="send-message-button" class="btn btn-blue" type="button">Send</button>
									</span>
								</div>
							</div><!--.send-message-->

						</div><!--.message-send-container-->
					</div><!--.col-->

					<div class="mobile-back">
						<div class="mobile-back-button"><i class="ion-android-arrow-back"></i></div>
					</div><!--.mobile-back-->
				</div><!--.tab-pane #messages-->

				<div class="tab-pane fade" id="notifications">

					<div class="col-md-6 col-md-offset-3">

						<ul class="list-material has-hidden">
							<li class="has-action-left has-action-right has-long-story">
								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
								<a href="#" class="visible">
									<div class="list-action-left">
										<i class="ion-bag icon text-indigo"></i>
									</div>
									<div class="list-content">
										<span class="caption">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits.</span>
									</div>
									<div class="list-action-right">
										<span class="top">2 hr</span>
										<i class="ion-record text-green bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right has-long-story">
								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
								<a href="#" class="visible">
									<div class="list-action-left">
										<i class="ion-image text-green icon"></i>
									</div>
									<div class="list-content">
										<span class="caption">Dramatically visualize customer directed convergence without revolutionary ROI. Efficiently unleash cross-media information without cross-media value.</span>
									</div>
									<div class="list-action-right">
										<span class="top">16:55</span>
										<i class="ion-record text-green bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right has-long-story">
								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
								<a href="#" class="visible">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/13.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="caption">Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.</span>
									</div>
									<div class="list-action-right">
										<span class="top">Yesterday</span>
										<i class="ion-record text-green bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right has-long-story">
								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
								<a href="#" class="visible">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/14.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="caption">Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas.</span>
									</div>
									<div class="list-action-right">
										<span class="top">2 days ago</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right has-long-story">
								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
								<a href="#" class="visible">
									<div class="list-action-left">
										<i class="ion-location text-light-blue icon"></i>
									</div>
									<div class="list-content">
										<span class="caption">Dynamically innovate resource-leveling customer service for state of the art customer service. Objectively innovate empowered manufactured products whereas parallel platforms.</span>
									</div>
									<div class="list-action-right">
										<span class="top">1 week ago</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right has-long-story">
								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
								<a href="#" class="visible">
									<div class="list-action-left">
										<i class="ion-bookmark text-deep-orange icon"></i>
									</div>
									<div class="list-content">
										<span class="caption">Holisticly predominate extensible testing procedures for reliable supply chains. Dramatically engage top-line web services vis-a-vis cutting-edge deliverables.</span>
									</div>
									<div class="list-action-right">
										<span class="top">10 Jan</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right has-long-story">
								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
								<a href="#" class="visible">
									<div class="list-action-left">
										<i class="ion-locked icon"></i>
									</div>
									<div class="list-content">
										<span class="caption">Phosfluorescently engage worldwide methodologies with web-enabled technology.</span>
									</div>
									<div class="list-action-right">
										<span class="top">9 Jan</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right has-long-story">
								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
								<a href="#" class="visible">
									<div class="list-action-left">
										<img src="../../assets/globals/img/faces/17.jpg" class="face-radius" alt="">
									</div>
									<div class="list-content">
										<span class="caption">Synergistically evolve 2.0 technologies rather than just in time initiatives. Quickly deploy strategic networks with compelling e-business. Credibly pontificate highly efficient manufactured products and enabled data.</span>
									</div>
									<div class="list-action-right">
										<span class="top">7 Jan</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
							<li class="has-action-left has-action-right has-long-story">
								<a href="#" class="hidden"><i class="ion-android-delete"></i></a>
								<a href="#" class="visible">
									<div class="list-action-left">
										<i class="ion-navigate text-indigo icon"></i>
									</div>
									<div class="list-content">
										<span class="caption">Objectively pursue diverse catalysts for change for interoperable meta-services. Dramatically mesh low-risk high-yield alignments before transparent e-tailers.</span>
									</div>
									<div class="list-action-right">
										<span class="top">7 Jan</span>
										<i class="ion-android-done bottom"></i>
									</div>
								</a>
							</li>
						</ul>

					</div><!--.col-->
				</div><!--.tab-pane #notifications-->

				<div class="tab-pane fade" id="settings">
					<div class="col-md-6 col-md-offset-3">

						<div class="settings-panel">
							<p class="text-grey">Here's where you can check your settings of Pleasure Admin Panel. If you need an extra information from us, do not hesitate to contact.</p>

							<div class="legend">Privacy Controls</div>
							<ul>
								<li>
									Show my profile on search results
									<div class="switcher switcher-indigo pull-right">
										<input id="settings1" type="checkbox" hidden="hidden" checked="checked">
										<label for="settings1"></label>
									</div><!--.switcher-->
								</li>
								<li>
									Only God can judge me
									<div class="switcher switcher-indigo pull-right">
										<input id="settings2" type="checkbox" hidden="hidden" checked="checked">
										<label for="settings2"></label>
									</div><!--.switcher-->
								</li>
								<li>
									Review tags people add to your own posts
									<div class="switcher switcher-indigo pull-right">
										<input id="settings3" type="checkbox" hidden="hidden">
										<label for="settings3"></label>
									</div><!--.switcher-->
								</li>
							</ul>

							<div class="legend">Notifications</div>
							<ul>
								<li>
									Activity that involves you
									<div class="switcher switcher-indigo pull-right">
										<input id="settings4" type="checkbox" hidden="hidden" checked="checked">
										<label for="settings4"></label>
									</div><!--.switcher-->
								</li>
								<li>
									Birthdays
									<div class="switcher switcher-indigo pull-right">
										<input id="settings5" type="checkbox" hidden="hidden">
										<label for="settings5"></label>
									</div><!--.switcher-->
								</li>
								<li>
									Calendar events
									<div class="switcher switcher-indigo pull-right">
										<input id="settings6" type="checkbox" hidden="hidden">
										<label for="settings6"></label>
									</div><!--.switcher-->
								</li>
							</ul>

							<div class="legend">Newsletter</div>
							<ul>
								<li>
									Friend requests
									<div class="checkboxer checkboxer-indigo pull-right">
										<input type="checkbox" id="checkboxSettings1" value="option1" checked="checked">
										<label for="checkboxSettings1"></label>
									</div>
								</li>
								<li>
									People you may know
									<div class="checkboxer checkboxer-indigo pull-right">
										<input type="checkbox" id="checkboxSettings2" value="option1">
										<label for="checkboxSettings2"></label>
									</div>
								</li>
							</ul>

						</div><!--.settings-panel-->

					</div><!--.col-->
				</div><!--.tab-pane #settings-->

			</div><!--.row-->
		</div><!--.user-layer-->
		<!-- END OF USER LAYER -->

	</div><!--.layer-container-->

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