<?php
session_start();
error_reporting(0);
	if ($_SESSION['is_log_user'] != 2) {			
		header("Location: index.php?error=1.php"); 
		exit;
	}
include("db_con.php");	
	if ($_POST['form_submitted'] == "form_submitted") {		
		$status_update_query	= "UPDATE money_transaction SET status = '".$_REQUEST['request_status']."', code = '".$_REQUEST['security_code_new']."' WHERE id = '".$_REQUEST['money_transfer_id']."' ";								
		$result_status_update	= mysql_query($status_update_query);
		$message				= "Request status has been updated";
		$_REQUEST['id']			= $_REQUEST['money_transfer_id'];
		$msg 					= "Hi, '".$_POST['sender_email']."'. Your money transfer request has been processed from digittransfer. Your security code for withdrawl of money is '".$_POST['security_code_new']."'. You can login to digittransfer system to see details.";
		// use wordwrap() if lines are longer than 70 characters
		$msg = wordwrap($msg,70);
		// send email
		@mail("basitjee1@hotmail.com","Notification, Money Transfer Request Processed", $msg);
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

	<title>Digital Word - Change Money Transfer Request Status</title>

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
					<h1>Change Money Transfer Request<small>&nbsp;Status</small></h1>
				</div><!--.col-->
				<div class="col-sm-6">
					<ol class="breadcrumb">
						<li><a href="dashboard_admin.php"><i class="ion-home"></i></a></li>
						<li><a href="dashboard_admin.php">Dashboard</a></li>
						<li><a href="logout.php">Logout</a></li>
						<li><a href="#" class="active">Change Money Transfer Request Status</a></li>
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
						<div class="panel-title"><h4>Change Money Transfer Request</h4></div>
					</div><!--.panel-heading-->
					<div class="panel-body">
						<?php
						$transfer_request_query		= "SELECT * FROM money_transaction WHERE id = '".$_REQUEST['id']."'";	
						$result_transfer_request	= mysql_query($transfer_request_query);	
							while ($row = mysql_fetch_array($result_transfer_request))  {
								$request_id			= $row["id"];																		
								$amount				= $row["amount"];
								$payment_method		= $row["payment_method"];
								$status				= $row["status"];
								$sender_name		= $row["sender_name"];
								$sender_address		= $row["sender_address"];
								$sender_phone		= $row["sender_phone"];
								$sender_country		= $row["sender_country"];
								$sender_email		= $row["sender_email"];
								$receiver_name		= $row["receiver_name"];
								$receiver_address	= $row["receiver_address"];
								$receiver_phone		= $row["receiver_phone"];
								$receiver_country	= $row["receiver_country"];									
							}				
						?>						
						<form name="change_request_status_form" action="change_money_transfer_request_status.php" method="post" class="form-horizontal" >							 
							<div class="row">								
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Amount (SEK)</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 	<?=$amount?>&nbsp;								
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Payment Method</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 <?=$payment_method?>&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Request Status</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
												<select name="request_status" id="request_status" class="selecter" required="required">
													<option value="" selected="selected">Select One</option>
													<option value="Pending">Pending</option>
													<option value="Sent">Sent</option>													
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Security Code</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 	<input type="text" class="form-control" id="security_code_new" name="security_code_new" required="" value="<?=$security_code?>">
												<span class="ion-android-done tooltips form-control-feedback" data-toggle="tooltip" data-placement="top" title="Success tooltip"></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Sender Name</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 <?=$sender_name?>&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Sender Address</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 <?=$sender_address?>&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Sender Phone</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 <?=$sender_phone?>&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Sender Country</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 <?=$sender_country?>&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Receiver Name</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 <?=$receiver_name?>&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Receiver Address</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 <?=$receiver_address?>&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Receiver Phone</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 <?=$receiver_phone?>&nbsp;
											</div>
										</div>
									</div>
								</div>
								<div class="form-group has-success has-feedback">
									<label class="control-label col-md-3" for="inputSuccess2">Receiver Country</label>
									<div class="col-md-5">
										<div class="inputer">
											<div class="input-wrapper">
											 <?=$receiver_country?>&nbsp;
											</div>
										</div>
									</div>
								</div>
								
							</div><!--.row-->
							<?php
							$money_transfer_id = $_REQUEST['id'];							
							?>							
							<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-primary">Save</button>
											<button type="reset" class="btn btn-default bv-reset">Cancel</button>
											<a href="money_transfer_requests.php"><button type="button" class="btn btn-default bv-reset">Back</button></a>
											<input type="hidden" value="form_submitted" name="form_submitted">
											<input type="hidden" value="<?=$money_transfer_id?>" name="money_transfer_id">
											<input type="hidden" value="<?=$sender_email?>" name="sender_email">
											<input type="hidden" value="<?=$security_code?>" name="security_code">											
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