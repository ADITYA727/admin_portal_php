<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Rezervy- Online Appointment Scheduling & Reservation Booking Calendar --- Booking Software, Cleaner Booking, Online Appointment Scheduling, Appointment Booking Calendar, Reservation System, Rendez-vous logiciel, Limpieza reserva, appointment, Cleaning services business software, Scheduling, Booking Calendar, Appointment Calendar, Cleaning Appointment, Maid Booking Software">
		<meta name="author" content="Rezervy - WPMinds">
		<link rel="shortcut icon" type="image/png" href="<?php  echo SITE_URL; ?>includes/images/favicon.ico" />
		
		<title>Rezervy Installation Instructions</title>

		<!-- Bootstrap core CSS -->
		<link href="../includes/vendor/bootstrap/css/bootstrap.min.css?<?php echo time(); ?>" rel="stylesheet">
		
		<!-- Custom fonts for this template -->
		<link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
		
		<!-- Custom styles for this template -->
		<link href="../includes/installation/css/rzvy-installation-instruction.css?<?php echo time(); ?>" rel="stylesheet">
	</head>
	<body>
		<header class="rzvy-main-header text-center text-white">
			<div class="rzvy-main-header-content">
				<div class="container">
					<a class="rzvy-logo-img" href="javascript:void(0);"><img src="../includes/installation/image/logo.png" alt="rzvy - Appointment Solution" /></a>
					<h2 class="rzvy-main-header-subheading mb-0">Appointment Solution for all businesses</h2>
				</div>
			</div>
			<div class="rzvy-bg-header-circle-1 rzvy-bg-header-circle"></div>
			<div class="rzvy-bg-header-circle-2 rzvy-bg-header-circle"></div>
			<div class="rzvy-bg-header-circle-3 rzvy-bg-header-circle"></div>
			<div class="rzvy-bg-header-circle-4 rzvy-bg-header-circle"></div>
		</header>
	
		<section class="rzvy-main-section-bg">
			<div class="container">
				<div class="row p-5">
					<div class="col-md-12">
						<center><h2>Installation Instructions</h2></center>
						<p class="text-right"><a href="#update_rzvy_instructions">Want to update Rezervy?</a></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="rzvy-instruction-steps clearfix">
							<div class="panel panel-default col-sm-12 col-sm-offset-2">
								<div class="panel-body">
									<div class="row p-3">
										<div class="col-md-9">
										<h3 class="rzvy-instruction-steps-heading"> Step 1 </h3>
										<br />
										* Upload the Rezervy Software zip in your preferred directory and extract there.
										<br />
										<br />
										* Open Rezervy/config.php file and configure your HostName, UserName, Password, and Database Name.
										<br />
										<br />
										* Also Import the SQL file(Given in database folder. Check image) in your database via phpmyadmin.
										<br />
										<br />
										</div>
										<div class="col-md-3">
											<img class="p-1" src="../includes/installation/image/ss1.png" alt="Rezervy - Appointment Solution" />
										</div>
									</div>
								</div>
							</div>
							
							<div class="panel panel-default col-sm-12 col-sm-offset-2">
								<div class="panel-body">
									<div class="row p-3">
										<div class="col-md-12">
											<h3 class="rzvy-instruction-steps-heading"> Step 2 </h3>
											<b>Check below server requirements:</b><br /><br />
											<div class="table-responsive">
												<table class="table text-center" cellspacing="2" cellpadding="10">
													<thead>
														<tr>
															<th> &nbsp; </th>
															<th> Rezervy Server requirement </th>
															<th> Your server configuration </th>
															<th> Status (OK / Please configure) </th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>PHP Version</td>
															<td>5.3+</td>
															<td><span class="text-white"><strong><?php echo phpversion(); ?></strong></span></td>
															<td><span class="text-white"><strong><?php echo (phpversion() >= '5.3') ? 'OK' : 'Please configure'; ?></strong></span></td>
														</tr>
														<tr>
															<td>MySQLi </td>
															<td>On</td>
															<td>
																<span class="text-white"><strong><?php echo extension_loaded('mysqli') ? 'On' : 'Off'; ?></strong></span>
															</td>
															<td><span class="text-white"><strong><?php  echo extension_loaded('mysqli') ? 'OK' : 'Please configure'; ?></strong></span></td>
														</tr>
														
														<tr>
															<td>CURL</td>
															<td>Enable</td>
															<td>
																<span class="text-white"><strong><?php echo (extension_loaded('curl') == 'true')  ? 'Enabled' : 'Disabled'; ?></strong></span>
															</td>
															<td><span class="text-white"><strong><?php  echo (extension_loaded('curl') == 'true') ? 'OK' : 'Please configure'; ?></strong></span></td>
														</tr>
														<tr>
															<td>GD </td>
															<td>On</td>
															<td>
																<span class="text-white"><strong><?php echo extension_loaded('gd') ? 'On' : 'Off'; ?></strong></span>
															</td>
														
															<td><span class="text-white"><strong><?php  echo extension_loaded('gd') ? 'OK' : 'Please configure'; ?></strong></span></td>
														</tr>
														<tr>
															<td>Session Auto Start</td>
															<td>Off</td>
															<td>
																<span class="text-white"><strong><?php echo (ini_get('session_auto_start')) ? 'On' : 'Off'; ?></strong>
																</span>
															</td>
															<td><span class="text-white"><strong><?php  echo (!ini_get('session_auto_start')) ? 'OK' : 'Please configure'; ?></strong></span></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="panel panel-default col-sm-12 col-sm-offset-2">
								<div class="panel-body">
									<div class="row p-3">
										<div class="col-md-6">
											<h3 class="rzvy-instruction-steps-heading"> Step 3 </h3>
											* Run the Rezervy Software directory URL in your browser.
											<br />
											* Setup your profile & company details.
											<br />
											* Verify purchase code and ENJOY Rezervy.
										</div>
										<div class="col-md-6">
											<h3 class="rzvy-instruction-steps-heading"> Step 4 </h3>
											* Configure default Company settings, Payment settings, Email settings, SMS settings to use our fantastic services.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="rzvy-main-section-bg">
			<div class="container">
				<div class="row p-5">
					<div class="col-md-12">
						<a href="javascript:void(0)" id="update_rzvy_instructions"></a>
						<center><h2>Update Rezervy Instructions</h2></center>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="rzvy-instruction-steps clearfix">
							<div class="panel panel-default col-sm-12 col-sm-offset-2">
								<div class="panel-body">
									<div class="row p-3">
										<div class="col-md-9">
										* Upload the Rezervy Software zip in your preferred directory and extract there.
										<br />
										* Do not replace your Old Rezervy/config.php file and Rezervy/uploads folder
										<br />
										* Go to your site and Run the Rezervy Software directory URL in your browser.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Footer -->
		<footer class="py-5 rzvy-bg-black" style="background:linear-gradient(0deg, #ff6a00 0%, #ee0979 100%) !important;">
			<div class="container">
				<p class="m-0 text-center text-white"> © Copyright WPMinds <?php if(date("Y") == "2019"){ echo "2019"; }else{ echo "2019 - ".date("Y"); } ?>. All Rights Reserved.</p>
			</div>
		<!-- /.container -->
		</footer>
	</body>
</html>