<?php
session_start();
error_reporting(0);
	if ($_SESSION['is_log_user'] != 2) {			
		header("Location: index.php?error=1.php"); 
		exit;
	}
include("db_con.php");
//This function separates the extension from the rest of the file name and returns it 
function findexts($filename)  { 
$filename 	= strtolower($filename) ; 
$exts 		= split("[/\\.]", $filename) ; 
$n 			= count($exts)-1; 
$exts 		= $exts[$n]; 
return $exts; 
} 
	if ($_POST['form_submitted'] == "form_submitted") {					
		if ($_FILES["card_image"]["name"] != "") {					
			$target_dir 	= "samples/";
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
					$ext = findexts($_FILES['card_image']['name']) ;
					//This line assigns a random number to a variable. You could also use a timestamp here if you prefer. 
					$i 		= 0;
					$tmp 	= mt_rand(1,9);
						do {
						    $tmp .= mt_rand(0, 9);
						} while(++$i < 14);
					
					// $ran = rand();
					$ran 	= $tmp;						
					//This takes the random number (or timestamp) you generated and adds a . on the end, so it is ready of the file extension to be appended.
					 
					$ran2 = $ran.".";						
					//This assigns the subdirectory you want to save into... make sure it exists!
					$target = "samples/";						
					//This combines the directory, the random file name, and the extension
					$target = $target . $ran2.$ext;					 
						if (move_uploaded_file($_FILES['card_image']['tmp_name'], $target)) {
							$insert_query		= "INSERT INTO companies(id, company_name, photo, retail_price) VALUES (NULL, '".$_POST['company']."', '".$target."', '".$_POST['retail_price']."')";								
							$result_insert 		= mysql_query($insert_query);
							$message_success 	= "New company has been entered into system";
					    } else {
					        echo "Sorry, there was an error uploading your file.";
					    }
				}		 	
		}
	} else {
		$message_success 	= "";
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

	<title>Digital Word - Add New Company</title>

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
	var card_image			= $('input[type="file"]').val();
    var card_image			= document.forms["new_card_form"]["card_image"].value;
    var card_image_empty 	= card_image.length;    
    var numbers 	= /^[0-9]+$/;
     	if (card_image == null || card_image == "") {
     		alert('Please Upload Card Image');
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
					<h1>New Company<small>Add new company</small></h1>
				</div><!--.col-->
				<div class="col-sm-6">
					<ol class="breadcrumb">
						<li><a href="dashboard_admin.php"><i class="ion-home"></i></a></li>
						<li><a href="dashboard_admin.php">Dashboard</a></li>
						<li><a href="logout.php">Logout</a></li>
						<li><a href="add_new_company.php" class="active">New Company</a></li>
					</ol>
				</div><!--.col-->
			</div><!--.row-->
		</div><!--.page-header-->
		<div align="center" style="color: blue;">
			<?=$message_success?>
		</div>
			
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-title"><h4>New Company Details</h4></div>
					</div><!--.panel-heading-->
					<div class="panel-body">

						<form name="new_card_form" action="add_new_company.php" method="post" class="form-horizontal" enctype="multipart/form-data" onsubmit="return validateForm();">							 
							<div class="row">								
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">New Company</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="company" name="company" required="">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Upload Sample Card Image</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="file" class="form-control" id="card_image" name="card_image">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Retail Price (SEK)</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<input type="text" class="form-control" id="retail_price" name="retail_price" required="">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
							</div><!--.row-->
							
							<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-primary">Save</button>
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
		include("menu_admin.php");
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