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

	<title>Digital Word - Monthly Report</title>

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
	<link rel="stylesheet" href="../../assets/globals/plugins/pnikolov-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/minicolors/jquery.minicolors.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/clockface/css/clockface.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	<link rel="stylesheet" href="../../assets/globals/plugins/bootstrap-table/dist/bootstrap-table.min.css">
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
					<h1>Monthly <small>Report</small></h1>
				</div><!--.col-->
				<div class="col-sm-6">
					<ol class="breadcrumb">
						<li><a href="dashboard_admin.php"><i class="ion-home"></i></a></li>
						<li><a href="dashboard_admin.php">Dashboard</a></li>
						<li><a href="logout.php">Logout</a></li>
						<li><a href="monthly_report.php" class="active">Monthly Report</a></li>
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
						<div class="panel-title"><h4>Select Month and Year</h4></div>
					</div><!--.panel-heading-->	 					
						<div class="panel-body">
						<form name="new_card_form" action="monthly_report.php" method="post" class="form-horizontal" enctype="multipart/form-data">							 
							<div class="row">								
								<div class="row example-row">
							<div class="col-md-3">Select Range for Report Dates</div><!--.col-md-3-->
							<div class="col-md-9">

								<div class="control-group">
									<div class="controls">
										<div class="input-group">
											<span class="add-on input-group-addon"><i class="ion-android-calendar"></i></span>
											<div class="inputer">
												<div class="input-wrapper">
													<!-- value="01/06/2015 - 03/23/2015"  -->
													<input type="text" style="width: 200px" name="reservation" class="form-control bootstrap-daterangepicker-basic-range" />
												</div>
											</div>
										</div>
									</div>
								</div>

							</div><!--.col-md-9-->
						</div><!--.row-->
															 
							</div> 						
							<div class="form-actions">
									<div class="row">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn btn-primary">Show Report</button>
											<button type="reset" class="btn btn-default bv-reset">Cancel</button>
											<input type="hidden" value="form_submitted" name="form_submitted">
										</div>
									</div>
							</div>								
						</form>
						</div>
				</div>  
					
				</div><!--.panel-->
			</div><!--.col-md-12-->
			
			
			<?php	
		if ($_POST['form_submitted'] == "form_submitted") {			
			$date_range 		= $_POST['reservation'];
			$date_range_array 	= explode("-", $date_range);			
			$start_date			= $date_range_array[0];
			$start_date_array 	= explode("/", $start_date);
			$new_start_date		= trim($start_date_array[2])."-".$start_date_array[0]."-".$start_date_array[1]; 
			$end_date			= $date_range_array[1];			
			$end_date_array 	= explode("/", $end_date);
			$new_end_date		= $end_date_array[2]."-".trim($end_date_array[0])."-".$end_date_array[1];
			$new_start_date			= $new_start_date. " 00:00:00";			
			$new_end_date			= $new_end_date. " 23:59:59";  			
		?>	
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-title"><h4>Report</h4></div>
					</div>
					<div class="panel-body">
						<?php
						$report_query	= "SELECT * FROM cards_collection WHERE time_date BETWEEN '".$new_start_date."' AND '".$new_end_date."' AND status = '1'";							
						$result_report	= mysql_query($report_query);
						?>
						<table data-toggle="table" data-height="300" data-sort-name="name" data-sort-order="desc">
							<thead>
								<tr>
									<th  data-sortable="true">Retail Price</th>
									<th data-sortable="true">Market Price</th>
									<th data-sortable="true" data-sorter="priceSorter">Purchase Price</th>
									<th data-sortable="true" data-sorter="priceSorter">Company</th>									
									<th data-sortable="true" data-sorter="priceSorter">Status</th>
								</tr>								
							</thead>
							<tbody>
							<?php
							while ($row = mysql_fetch_array($result_report))  {								
								$retail_price	= $row["amount"];
								$market_price	= $row["market_price"];
								$purchase_price	= $row["purchase_price"];
								$company		= $row["company"];																		
							?>
								<tr>
									<td>
										<?=$retail_price?>
									</td>									
									<td>
										<?=$market_price?>
									</td>
									<td>
										<?=$purchase_price?>
									</td>
									<td>
										<?=$company?>								
									</td>
									<td>
										Sold
									</td>	
								</tr>									 
							<?php
							}
							?>
							</tbody>	
						</table>
					</div>
					
				</div><!--.panel-->
			</div><!--.col-md-6-->
		</div><!--.row-->		
		<?php		
		$sum_query	= "SELECT SUM(amount), SUM(market_price), SUM(purchase_price) FROM cards_collection WHERE time_date BETWEEN '".$new_start_date."' AND '".$new_end_date."' AND status = '1'";	
		$result_sum	= mysql_query($sum_query);
			while ($row_sum = mysql_fetch_array($result_sum))  {
				$total_amount 			= $row_sum['SUM(amount)'];
				$total_market_price		= $row_sum['SUM(market_price)'];
				$total_purchase_price	= $row_sum['SUM(purchase_price)'];
			}
		$profit = $total_amount  - $total_purchase_price;  			
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel">
					<div class="panel-heading">
						<div class="panel-title"><h4>Total Retail Price of Sold Cards (SEK): <?=$total_amount?> </h4></div>
					</div>
					<div class="panel-heading">
						<div class="panel-title"><h4>Total Market Price of Sold Cards (SEK): <?=$total_market_price?></h4></div>
					</div>
					<div class="panel-heading">
						<div class="panel-title"><h4>Total Purchase Price of Sold Cards (SEK): <?=$total_purchase_price?></h4></div>
					</div>
					<div class="panel-heading">
						<div class="panel-title"><h4>Total Profit (SEK): <?=$profit?></h4></div>
					</div>
				</div>  
			</div>
		</div>
		<?php
		}
		?>	
		
		
		
		
		
		
		</div><!--.row-->

		
		

	</div><!--.content-->

	<div class="layer-container">

		<!-- BEGIN MENU LAYER -->
		<?php
		include("menu_admin.php");
		?>
		
		 

	</div>
	
	<!-- BEGIN GLOBAL AND THEME VENDORS -->
	<script src="../../assets/globals/js/global-vendors.js"></script>
	<!-- END GLOBAL AND THEME VENDORS -->

	<!-- BEGIN PLUGINS AREA -->
	<script src="../../assets/globals/plugins/pnikolov-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="../../assets/globals/plugins/minicolors/jquery.minicolors.min.js"></script>
	<script src="../../assets/globals/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="../../assets/globals/plugins/clockface/js/clockface.js"></script>
	<!-- END PLUGINS AREA -->

	<!-- PLUGINS INITIALIZATION AND SETTINGS -->
	<script src="../../assets/globals/scripts/forms-pickers.js"></script>
	<!-- END PLUGINS INITIALIZATION AND SETTINGS -->

	<!-- PLEASURE -->
	<script src="../../assets/globals/js/pleasure.js"></script>
	<!-- ADMIN 1 -->
	<script src="../../assets/admin1/js/layout.js"></script>
	<script src="../../assets/globals/plugins/bootstrap-table/dist/bootstrap-table.min.js"></script>	
	<script src="../../assets/globals/scripts/tables-bootstrap.js"></script>
	
	<!-- BEGIN INITIALIZATION-->
	<script>	
	$(document).ready(function () {
		Pleasure.init();
		Layout.init();
		FormsPickers.init();
	});
	 
	</script>
	<!-- END INITIALIZATION-->

	

</body>
</html>