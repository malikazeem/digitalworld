<?php
session_start();
error_reporting(0);
	if ($_SESSION['is_log_user'] != 2) {			
		header("Location: index.php?error=1.php"); 
		exit;
	}
include("db_con.php");
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>Digits Transfer - Dashboard Admin</title>

	<meta name="description" content="">
	<meta name="author" content="">

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
	<meta name="apple-touch-fullscreen" content="yes">

	<!-- BEGIN CORE CSS -->
	<link rel="stylesheet" href="../../assets/admin1/css/admin1.css">
	<link rel="stylesheet" href="../../assets/globals/css/elements.css">
	<!-- END CORE CSS -->

	<!-- BEGIN PLUGINS CSS -->
	<link rel="stylesheet" href="../../assets/globals/plugins/rickshaw/rickshaw.min.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/bxslider/jquery.bxslider.css">

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
			<div class="logo">Digital Word</div><!--.logo-->
		</div><!--.overlay-->

		<div class="overlay-secondary"></div><!--.overlay-secondary-->
		<!-- END OF OVERLAY HELPERS -->

	</div><!--.nav-bar-container-->

	<div class="content">

		<div class="page-header full-content">
			<div class="row">
				<div class="col-sm-6">
					<h1><!--<img src="../../assets/globals/img/shop-1424339975.jpg" width="150">-->Dashboard Digits Transfer<small>Activity Summary</small></h1>
				</div><!--.col-->
				<div class="col-sm-6">
					<ol class="breadcrumb">
						<li><a href="#" class="active"><i class="ion-home"></i> Homepage</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ol>
				</div><!--.col-->
			</div><!--.row-->
		</div><!--.page-header-->

		<div class="display-animation">

			<div class="row image-row">

				<div class="col-md-8">

					<div class="row image-row">
						<div class="col-sm-8">

							<div class="card tile card-green card-weather bg-image sample-bg-image15 material-animate">
								<div class="card-heading">
									<div class="card-action">
										<a href="javascript:;" data-toggle="fake-reload"></a>
									</div><!--.card-action-->
								</div><!--.card-heading-->
								<div class="card-body">
									<div class="forecast-container">
										<span class="temparature">19 <i class="wi wi-celsius"></i></span>
										<span class="place">Barcelona, Spain</span>
										<span class="forecast">Clear until tomorrow morning.</span>
									</div>
								</div><!--.card-body-->
								<div class="card-footer">
									<div class="row">
										<div class="col-xs-3 col-sm-2 animate-item">
											<ul>
												<li>MON</li>
												<li><i class="wi wi-day-sleet-storm"></i></li>
												<li>18 <i class="wi wi-celsius"></i></li>
											</ul>
										</div><!--.col-->
										<div class="col-xs-3 col-sm-2 animate-item">
											<ul>
												<li>TUE</li>
												<li><i class="wi wi-day-sunny-overcast"></i></li>
												<li>22 <i class="wi wi-celsius"></i></li>
											</ul>
										</div><!--.col-->
										<div class="col-xs-3 col-sm-2 animate-item">
											<ul>
												<li>WED</li>
												<li><i class="wi wi-rain"></i></li>
												<li>14 <i class="wi wi-celsius"></i></li>
											</ul>
										</div><!--.col-->
										<div class="col-xs-3 col-sm-2 animate-item">
											<ul>
												<li>THU</li>
												<li><i class="wi wi-day-rain"></i></li>
												<li>15 <i class="wi wi-celsius"></i></li>
											</ul>
										</div><!--.col-->
										<div class="col-sm-2 hidden-xs animate-item">
											<ul>
												<li>FRI</li>
												<li><i class="wi wi-showers"></i></li>
												<li>10 <i class="wi wi-celsius"></i></li>
											</ul>
										</div><!--.col-->
										<div class="col-sm-2 hidden-xs animate-item">
											<ul>
												<li>SAT</li>
												<li><i class="wi wi-storm-showers"></i></li>
												<li>5 <i class="wi wi-celsius"></i></li>
											</ul>
										</div><!--.col-->
									</div><!--.row-->
								</div><!--.card-footer-->
							</div><!--.card-->

						</div><!--.col-->
						<div class="col-sm-4">

							<div class="card tile card-dashboard-graph material-animate">
								<div class="contextual">
									<h5>Welcome</h5>
									<p>Collaboratively administrate empowered markets</p>
								</div><!--.contextual-->
								<div class="chart without-time chart-sales"></div>
								<div class="chart-legend chart-sales-legend"></div>
							</div><!--.card-->

							<div class="card tile card-dashboard-graph material-animate margin-top-4">
								<div class="contextual">
									<h5>Total Balance</h5>
									<p>
									<?php
									$total_balance_query	= "SELECT SUM(balance) FROM balance";	
									$result_total_balance	= mysql_query($total_balance_query);
										while ($row = mysql_fetch_array($result_total_balance)){
											echo $row['SUM(balance)']." SEK";								
										}	
									?>		
									</p>
								</div><!--.contextual-->
								<!-- <div class="chart without-time chart-balance"></div> -->
							</div><!--.card-->

						</div><!--.col-->
					</div><!--.row-->

					<div class="row image-row">

						<div class="col-sm-4">
							<ul class="bxslider width-percent-100" data-bx-slider-pager="false" data-bx-slider-controls="false" data-bx-slider-auto="true" data-bx-slider-mode="vertical">
								<!--
								<li>
									<div class="card tile card-indigo card-social material-animate">
										<div class="card-body">
											<p>Collaboratively administrate empowered markets via networks.</p>
										</div>
										<div class="card-footer">
											<ul class="inline-list">
												<li><i class="fa fa-thumbs-o-up"></i> 393</li>
												<li><i class="fa fa-share"></i> 105</li>
											</ul>
										</div>
										<div class="card-icon"><i class="fa fa-facebook"></i></div>
									</div>
								</li>
								-->
								<!--
								<li>
									<div class="card tile card-light-blue card-social material-animate">
										<div class="card-body">
											<p>Dynamically procrastinate B2C users after installed base benefits.</p>
										</div>
										<div class="card-footer">
											<ul class="inline-list">
												<li><i class="fa fa-star-o"></i> 594</li>
												<li><i class="fa fa-retweet"></i> 256</li>
											</ul>
										</div>
										<div class="card-icon"><i class="fa fa-twitter"></i></div>
									</div>
								</li>
								-->
							</ul>
						</div>

						<div class="col-sm-4">
							<div class="card card-music card-music-single card-music-centered tile card-black card-player-indigo bg-image bg-opaque8 sample-bg-image14 material-animate">
								<audio src="http://teamfox.co/audionautix/5CentsBack.mp3" preload="none" class="audiojs-single"></audio>
								<div class="card-heading">
									<div class="song-container">
										<p class="artist">Jason Shaw</p>
										<p class="song">Audio Cards</p>
									</div><!--.song-container-->
								</div><!--.card-heading-->
							</div><!--.card-->
						</div><!--.col-->

						<div class="col-sm-4">
							<div class="card tile card-dashboard-graph material-animate">
								<div class="contextual">
									<h5>Social Followers</h5>
									<p>Dramatically maintain clicks-and-mortar</p>
								</div><!--.contextual-->
								<div class="chart without-time chart-followers"></div>
								<div class="chart-legend chart-followers-legend"></div>
							</div><!--.card-->
						</div><!--.col-->

					</div><!--.row-->

				</div><!--.col-->

				<div class="col-md-4">

					<div class="row image-row">
						<div class="col-md-12">
							<div class="card tile card-lime card-image material-animate">
								<input id="pac-input" type="text" placeholder="Search Place">
								<div id="gmaps-dashboard" class="example-map"></div>
							</div><!--.card-->
						</div><!--.col-->
					</div><!--.row-->

					<div class="row image-row">
						<div class="col-md-12">
							<div class="card tile card-white card-stocks material-animate">
								<div class="card-heading">
									<div class="card-action">
										<a href="javascript:;" data-toggle="fake-reload"></a>
									</div><!--.card-action-->
									<span class="name">Apple Inc</span>
									<span class="price"><i class="ion-arrow-up-b"></i> 0.30%</span>
									<div class="chart chart-stocks"></div>
								</div><!--.card-heading-->
								<div class="card-body">
									<ul>
										<li class="animate-item btn-ripple">
											<span class="name">Apple Inc</span>
											<span class="price text-green"><i class="ion-arrow-up-b"></i> $119.56</span>
										</li>
										<li class="animate-item btn-ripple">
											<span class="name">Nokia Corporation</span>
											<span class="price text-red"><i class="ion-arrow-down-b"></i> $10.69</span>
										</li>
										<li class="animate-item btn-ripple">
											<span class="name">Canon Inc</span>
											<span class="price text-green"><i class="ion-arrow-up-b"></i> $31.48</span>
										</li>
										<li class="animate-item btn-ripple">
											<span class="name">Motorola Solutions</span>
											<span class="price text-red"><i class="ion-arrow-down-b"></i> $63.94</span>
										</li>
										<li class="animate-item btn-ripple">
											<span class="name">Sony Corp</span>
											<span class="price text-green"><i class="ion-arrow-up-b"></i> $25.94</span>
										</li>
									</ul>
								</div><!--.card-body-->
							</div><!--.card-->
						</div><!--.col-->
					</div><!--.row-->

				</div><!--.col-->

			</div><!--.row-->

		</div><!--.display-animation-->

		<div class="display-animation">
			<div class="full-content margin-top-40 margin-bottom-40 bg-white">
				<div class="row">

					<div class="col-md-4 material-animate padding-right-40">
						<h4>Orders in 2014</h4>
						<p class="text-grey">Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.</p>
					</div><!--.col-->

					<div class="col-md-8 material-animate">
						<div class="chart chart-sales-by-year without-time"></div>
					</div><!--.col-->


				</div><!--.row-->
			</div><!--.full-content-->
		</div><!--.display-animation-->

		<div class="display-animation">
			<div class="row image-row margin-bottom-40">
				<div class="col-md-4">
					<div class="card tile card-dashboard-info card-teal material-animate">
						<div class="card-body">
							<div class="card-icon"><i class="fa fa-usd"></i></div><!--.card-icon-->
							<h4>Revenue</h4>
							<p class="result">$10,786</p>
							<small><i class="fa fa-caret-up"></i> Total balance is $23,591</small>
						</div>
					</div><!--.card-->

					<div class="card tile card-dashboard-info card-light-blue material-animate">
						<div class="card-body">
							<div class="card-icon"><i class="fa fa-calculator"></i></div><!--.card-icon-->
							<h4>Open Orders</h4>
							<p class="result">26</p>
							<small>Waiting to send</small>
						</div>
					</div><!--.card-->

					<div class="card tile card-dashboard-info card-blue-grey material-animate">
						<div class="card-body">
							<div class="card-icon"><i class="fa fa-thumbs-o-up"></i></div><!--.card-icon-->
							<h4>Completed Orders</h4>
							<p class="result">183</p>
							<small><i class="fa fa-caret-up"></i> 9814 orders totally</small>
						</div>
					</div><!--.card-->

				</div><!--.col-->

				<div class="col-md-4">
					<div class="card tile card-news-more material-animate">
						<div class="card-heading bg-image bg-opaque5 sample-bg-image29">
							<div class="heading-content">
								<span class="badge">NEWS</span>
								<span class="headline">Quickly maximize timely deliverables</span>
								<button class="btn btn-floating btn-pink toggle-card-news-more"><i class="ion-android-create"></i></button>
							</div>
						</div><!--.card-heading-->
						<div class="card-body">
							<p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.</p>
							<p>Efficiently unleash cross-media information without cross-media value. Quickly maximize timely deliverables for real-time schemas. Dramatically maintain clicks-and-mortar solutions without functional solutions.</p>
							<p>Completely synergize resource sucking relationships via premier niche markets. Professionally cultivate one-to-one customer service with robust ideas. Dynamically innovate resource-leveling customer service for state of the art customer service.</p>
						</div><!--.card-body-->
					</div><!--.card-->
				</div><!--.col-->

				<div class="col-md-4">
					<div class="card tile card-friend material-animate">
						<a href="user-profile.html"><img src="../../assets/globals/img/faces/1.jpg" class="user-photo" alt=""></a>
						<div class="friend-content">
							<p class="title">Nicholas Murray</p>
							<p><a href="user-profile.html">180 friends</a></p>
							<a class="btn btn-flat btn-primary btn-xs">Add as a Friend</a>
						</div><!--.friend-content-->
					</div><!--.card-->

					<div class="card tile card-friend material-animate">
						<a href="user-profile.html"><img src="../../assets/globals/img/faces/2.jpg" class="user-photo" alt=""></a>
						<div class="friend-content">
							<p class="title">Jason Herrera</p>
							<p><a href="user-profile.html">423 friends</a></p>
							<a class="btn btn-flat btn-primary btn-xs">Add as a Friend</a>
						</div><!--.friend-content-->
					</div><!--.card-->

					<div class="card tile card-friend material-animate">
						<a href="user-profile.html"><img src="../../assets/globals/img/faces/3.jpg" class="user-photo" alt=""></a>
						<div class="friend-content">
							<p class="title">Michael Bell</p>
							<p><a href="user-profile.html">490 friends</a></p>
							<a class="btn btn-flat btn-primary btn-xs">Add as a Friend</a>
						</div><!--.friend-content-->
					</div><!--.card-->

					<div class="card tile card-friend material-animate">
						<a href="user-profile.html"><img src="../../assets/globals/img/faces/5.jpg" class="user-photo" alt=""></a>
						<div class="friend-content">
							<p class="title">Henry Allen</p>
							<p><a href="user-profile.html">859 friends</a></p>
							<a class="btn btn-flat btn-primary btn-xs">Add as a Friend</a>
						</div><!--.friend-content-->
					</div><!--.card-->
				</div><!--.col-->

			</div><!--.row-->
		</div><!--.display-animation-->

		<div class="display-animation">
			<div class="row image-row">
				<div class="col-sm-6 col-md-3">

					<div class="panel helper-dashboard-height">
						<div class="panel-heading">
							<div class="panel-title"><h4>VISITORS</h4></div>
						</div><!--.panel-heading-->
						<div class="panel-body vertical-padding">
							<div class="gauge-chart">
								<canvas id="gauge" class="gauge-canvas"></canvas>
								<div id="preview-textfield"></div>
								<div class="chart-desc">
									Collaboratively administrate.
								</div>
							</div>
						</div><!--.panel-body-->
					</div><!--.panel-->

				</div><!--.col-->

				<div class="col-sm-6 col-md-3">

					<div class="panel helper-dashboard-height">
						<div class="panel-heading">
							<div class="panel-title"><h4>OPEN TICKETS</h4></div>
						</div><!--.panel-heading-->
						<div class="panel-body">
							<div class="knob-container margin-top-10">
								<input class="knob" data-angleOffset="-125" data-fgColor="deep_purple" data-angleArc="250" data-readOnly="true" value="35">
							</div><!--.knob-container-->
							<div class="chart-desc">
								Collaboratively administrate empowered markets.
							</div>
						</div><!--.panel-body-->
					</div><!--.panel-->

				</div><!--.col-->

				<div class="col-sm-12 col-md-6">

					<div class="panel helper-dashboard-height">
						<div class="panel-heading">
							<div class="panel-title"><h4>TIMELINE</h4></div>
						</div><!--.panel-heading-->
						<div class="panel-body horizontal-padding">

							<div class="timeline single helper-timeline">
								<div class="frame">
									<div class="timeline-badge">
										<i class="fa fa-headphones"></i>
									</div><!--.timeline-badge-->
									<span class="timeline-date">17 August 1999</span>
									<div class="timeline-content">
										The 1999 Kocaeli earthquake occurred with a moment magnitude of 7.4 that struck northwestern Turkey struck northwestern Turkey
									</div><!--.timeline-content-->
								</div><!--.frame-->
								<div class="frame">
									<div class="timeline-badge">
										<i class="fa fa-tree"></i>
									</div><!--.timeline-badge-->
									<span class="timeline-date">18 April 1906</span>
									<div class="timeline-content">
										The San Francisco earthquake of 1906 struck San Francisco on Wednesday, April 18, 1906.
									</div><!--.timeline-content-->
								</div><!--.frame-->
							</div><!--.timeline-->

						</div><!--.panel-body-->
					</div><!--.panel-->

				</div><!--.col-->

			</div><!--.row-->
		</div><!--.display-animation-->

		<div class="footer-links margin-top-40">
			<div class="row no-gutters bg-blue">
				<div class="col-xs-6"></div><!--.col-->
				<div class="col-xs-6">
					<a href="logout.php">
						<span class="state"></span>
						<span></span>
						<span class="icon"><i class="ion-android-arrow-forward"></i></span>
					</a>
				</div><!--.col-->
			</div><!--.row-->
		</div><!--.footer-links-->

	</div><!--.content-->

	<div class="layer-container">

		<!-- BEGIN MENU LAYER -->
		<?php
		include("menu_admin.php");
		?>
		<!--.menu-layer-->
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

	<script src="../../assets/globals/js/global-vendors.js"></script>	
	<script src="http://maps.google.com/maps/api/js?sensor=true&amp;libraries=places"></script>
	<script src="../../assets/globals/plugins/gmaps/gmaps.js"></script>
	<script src="../../assets/globals/plugins/bxslider/jquery.bxslider.min.js"></script>
	<script src="../../assets/globals/plugins/audiojs/audiojs/audio.min.js"></script>
	<script src="../../assets/globals/plugins/d3/d3.min.js"></script>
	<script src="../../assets/globals/plugins/rickshaw/rickshaw.min.js"></script>
	<script src="../../assets/globals/plugins/jquery-knob/excanvas.js"></script>	
	<script src="../../assets/globals/plugins/jquery-knob/dist/jquery.knob.min.js"></script>	
	<script src="../../assets/globals/plugins/gauge/gauge.min.js"></script>
	<script src="../../assets/globals/js/pleasure.js"></script>	
	<script src="../../assets/admin1/js/layout.js"></script>	
	<script src="../../assets/globals/scripts/sliders.js"></script>	
	<script src="../../assets/globals/scripts/maps-google.js"></script>	
	<script src="../../assets/globals/scripts/widget-audio.js"></script>
	<script src="../../assets/globals/scripts/charts-knob.js"></script>	
	<script src="../../assets/globals/scripts/index.js"></script>
	<!-- BEGIN INITIALIZATION-->
	<script>
	$(document).ready(function () {
		Pleasure.init();
		Layout.init();

		Index.init();
		WidgetAudio.single();
		ChartsKnob.init();

	});
	</script>
	<!-- END INITIALIZATION-->


</body>
</html>