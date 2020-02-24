<?php 
session_start();
/* Include class files */
include(dirname(__FILE__)."/constants.php");
include(dirname(__FILE__)."/classes/class_settings.php");

/* Create object of classes */
$obj_database->check_admin_setup_detail_setup_page($conn);
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="Rezervy- Online Appointment Scheduling & Reservation Booking Calendar --- Booking Software, Cleaner Booking, Online Appointment Scheduling, Appointment Booking Calendar, Reservation System, Rendez-vous logiciel, Limpieza reserva, appointment, Cleaning services business software, Scheduling, Booking Calendar, Appointment Calendar, Cleaning Appointment, Maid Booking Software">
		<meta name="author" content="Rezervy - WPMinds">
		<link rel="shortcut icon" type="image/png" href="<?php  echo SITE_URL; ?>includes/images/favicon.ico" />
		<title>Administrator Setup</title>
		<!-- Bootstrap core CSS-->
		<link href="<?php echo SITE_URL; ?>includes/vendor/bootstrap/css/bootstrap.min.css?<?php echo time(); ?>" rel="stylesheet">
		<!-- Custom fonts for this template-->
		<link href="<?php echo SITE_URL; ?>includes/vendor/font-awesome/css/font-awesome.min.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<!-- Custom styles for this template-->
		<link href="<?php echo SITE_URL; ?>includes/css/rzvy-sadmin-setup.css?<?php echo time(); ?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/css/intlTelInput.css?<?php echo time(); ?>">
	</head>
	<body class="rzvy">
		<section class="rzvy-sadminsetup-main">
			<div class="col-md-12">
				<div class="text-center">
					<h1 class="pb-3 rzvy-sadminsetup-center-block-title"><img src="<?php echo SITE_URL; ?>includes/installation/image/logo.png" alt="rzvy" /></h1>
				</div>
			</div>
			<div class="container rzvy-sadminsetup-container">
				<form id="rzvy_sadminsetup_form" name="rzvy_sadminsetup_form" method="post">
					<div class="row">
						<div class="col-md-12 rzvy-sadminsetup-right-block">
							<h2 class="text-center">Configure Default Settings</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 rzvy-sadminsetup-right-block rzvy-border-right">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_firstname">First Name</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_firstname" name="rzvy_sadminsetup_firstname" placeholder="Enter first name" />
								</div>
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_lastname">Last Name</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_lastname" name="rzvy_sadminsetup_lastname" placeholder="Enter last name" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_email">Email</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_email" name="rzvy_sadminsetup_email" placeholder="Enter email" />
								</div>
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_password">Password</label>
									<input type="password" class="form-control" id="rzvy_sadminsetup_password" name="rzvy_sadminsetup_password" placeholder="Enter password" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_phone">Phone</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_phone" name="rzvy_sadminsetup_phone" placeholder="Enter phone" />
								</div>
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_zip">Zip</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_zip" name="rzvy_sadminsetup_zip" placeholder="Enter zip">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label for="rzvy_sadminsetup_address">Address</label>
									<textarea class="form-control" id="rzvy_sadminsetup_address" name="rzvy_sadminsetup_address" placeholder="Enter address"></textarea>
								</div>
							</div>
						</div>
						<div class="col-md-6 rzvy-sadminsetup-right-block">
							<div class="row">
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_city">City</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_city" name="rzvy_sadminsetup_city" placeholder="Enter city">
								</div>
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_state">State</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_state" name="rzvy_sadminsetup_state" placeholder="Enter state">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_country">Country</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_country" name="rzvy_sadminsetup_country" placeholder="Enter country">
								</div>
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_companyname">Company Name</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_companyname" name="rzvy_sadminsetup_companyname" placeholder="Enter company name">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_companyemail">Company Email</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_companyemail" name="rzvy_sadminsetup_companyemail" placeholder="Enter company email">
								</div>
								<div class="form-group col-md-6">
									<label for="rzvy_sadminsetup_companyphone">Company Phone</label>
									<input type="text" class="form-control" id="rzvy_sadminsetup_companyphone" name="rzvy_sadminsetup_companyphone" placeholder="Enter phone">
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<a class="btn rzvy-submit-btn pull-right" id="rzvy_sadminsetup_btn" href="javascript:void(0)">Configure settings</a>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
		<!-- Bootstrap core JavaScript-->
		<script src="<?php echo SITE_URL; ?>includes/vendor/jquery/jquery.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/jquery/jquery.validate.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/bootstrap/js/bootstrap.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.js?<?php echo time(); ?>"></script>
		<!-- Custom scripts for all pages-->
		<script>
			var generalObj = { 'site_url' : '<?php echo SITE_URL; ?>', 'ajax_url' : '<?php echo AJAX_URL; ?>' };
		</script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/js/intlTelInput.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/js/rzvy-sadmin-setup.js?<?php echo time(); ?>"></script>
	</body>
</html>