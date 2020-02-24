<?php 
session_start();

/* Include class files */
include(dirname(dirname(__FILE__))."/constants.php");

if(!isset($_SESSION['login_type'])) { 
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/";
	</script>
	<?php  
	exit;
}else if($_SESSION['login_type'] == "customer") { 
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/my-appointments.php";
	</script>
	<?php  
	exit;
}else if($_SESSION['login_type'] == "admin") { 
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/appointments.php";
	</script>
	<?php  
	exit;
}else{}
if(!isset($_SESSION['staff_id'])) { 
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/";
	</script>
	<?php  
	exit;
}

$obj_database->check_admin_setup_detail($conn);

include(dirname(dirname(__FILE__))."/classes/class_settings.php");
include(dirname(dirname(__FILE__))."/classes/class_schedule.php");
include(dirname(dirname(__FILE__))."/classes/class_bookings.php");
include(dirname(dirname(__FILE__))."/classes/class_staff.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$obj_schedule = new rzvy_schedule();
$obj_schedule->conn = $conn;

$obj_bookings = new rzvy_bookings();
$obj_bookings->conn = $conn;

$obj_staff = new rzvy_staff();
$obj_staff->conn = $conn;

$rzvy_settings_timezone = $obj_settings->get_option("rzvy_timezone");
$rzvy_server_timezone = date_default_timezone_get();
$currDateTime_withTZ = $obj_settings->get_current_time_according_selected_timezone($rzvy_server_timezone,$rzvy_settings_timezone);

$dash_title = "Staff Dashboard";  
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/png" href="<?php echo SITE_URL; ?>includes/images/favicon.ico" />
	<?php 
	$rzvy_seo_ga_code = $obj_settings->get_option('rzvy_seo_ga_code');
	$rzvy_seo_meta_tag = $obj_settings->get_option('rzvy_seo_meta_tag');
	$rzvy_seo_meta_description = $obj_settings->get_option('rzvy_seo_meta_description');
	$rzvy_seo_og_meta_tag = $obj_settings->get_option('rzvy_seo_og_meta_tag');
	$rzvy_seo_og_tag_type = $obj_settings->get_option('rzvy_seo_og_tag_type');
	$rzvy_seo_og_tag_url = $obj_settings->get_option('rzvy_seo_og_tag_url');
	$rzvy_seo_og_tag_image = $obj_settings->get_option('rzvy_seo_og_tag_image'); 
	?>
	
	<title><?php if($rzvy_seo_meta_tag != ""){ echo $rzvy_seo_meta_tag; }else{ echo $obj_settings->get_option("rzvy_company_name"); } ?></title>
	
	<?php 
	if($rzvy_seo_meta_description != ''){ 
		?>
		<meta name="description" content="<?php echo $rzvy_seo_meta_description; ?>">
		<?php 
	} 
	if($rzvy_seo_og_meta_tag != ''){ 
		?>
		<meta property="og:title" content="<?php  echo $rzvy_seo_og_meta_tag; ?>" />
		<?php 
	} 
	if($rzvy_seo_og_tag_type != ''){ 
		?>
		<meta property="og:type" content="<?php echo $rzvy_seo_og_tag_type; ?>" />
		<?php 
	} 
	if($rzvy_seo_og_tag_url != ''){ 
		?>
		<meta property="og:url" content="<?php echo $rzvy_seo_og_tag_url; ?>" />
		<?php 
	} 
	if($rzvy_seo_og_tag_image != '' && file_exists("../uploads/images/".$rzvy_seo_og_tag_image)){ 
		?>
		<meta property="og:image" content="<?php  echo SITE_URL; ?>uploads/images/<?php echo $rzvy_seo_og_tag_image; ?>" />
		<?php 
	} 
	if($rzvy_seo_ga_code != ''){ 
		?>
		<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $rzvy_seo_ga_code; ?>"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', '<?php echo $rzvy_seo_ga_code; ?>');
		</script>
		<?php  
	} 
	?>
	<!-- Bootstrap core CSS-->
	<link href="<?php echo SITE_URL; ?>includes/vendor/bootstrap/css/bootstrap.min.css?<?php echo time(); ?>" rel="stylesheet">
	<link href="<?php echo SITE_URL; ?>includes/vendor/bootstrap/css/bootstrap-select.min.css?<?php echo time(); ?>" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="<?php echo SITE_URL; ?>includes/vendor/font-awesome/css/font-awesome.min.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
	<link href="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<link href="<?php echo SITE_URL; ?>includes/vendor/datatables/datatables.min.css?<?php echo time(); ?>" rel="stylesheet">
	<!-- Include all css file for calendar -->
	<link href='<?php echo SITE_URL; ?>includes/vendor/calendar/fullcalendar.min.css?<?php echo time(); ?>' rel='stylesheet' />
	<!-- Custom styles for this template-->
	<link href="<?php echo SITE_URL; ?>includes/css/rzvy-admin.css?<?php echo time(); ?>" rel="stylesheet">
	<?php if (strpos($_SERVER['SCRIPT_NAME'], 'appointments.php') != false) { ?>
	<!-- Custom frontend CSS -->
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/manual-booking/css/pe-icon-7-stroke.css?<?php echo time(); ?>" />
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/manual-booking/css/datepicker.min.css?<?php echo time(); ?>" />
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/manual-booking/css/rzvy-mb-style.css?<?php echo time(); ?>">
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/manual-booking/css/rzvy-mb-calendar-style.css?<?php echo time(); ?>">
	<?php } ?>
	<?php if (strpos($_SERVER['SCRIPT_NAME'], 'location-selector.php') != false) { ?>
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/bootstrap/css/bootstrap-tagsinput.css?<?php echo time(); ?>" />
	<?php } ?>
	<?php if (strpos($_SERVER['SCRIPT_NAME'], 'location-selector.php') != false || strpos($_SERVER['SCRIPT_NAME'], 'refund.php') != false || strpos($_SERVER['SCRIPT_NAME'], 'email-sms-templates.php') != false || strpos($_SERVER['SCRIPT_NAME'], 'settings.php') != false) { ?>
		<!-- include text editor -->
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/text-editor/text-editor.css">
	<?php } ?>
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/css/intlTelInput.css?<?php echo time(); ?>">
	<?php include("admin_dash_css.php"); ?>
</head>

<body class="rzvy fixed-nav sticky-footer bg-light" id="rzvy-page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="rzvy-mainnav">
    <a class="navbar-brand" href="<?php echo SITE_URL; ?>backend/appointments.php"><?php echo $dash_title; ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#rzvy-navbarresponsive" aria-controls="rzvy-navbarresponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="rzvy-navbarresponsive">
			<ul class="navbar-nav navbar-sidenav" id="rzvy-menu-accordion">
				<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 's-appointments.php') != false) { echo 'rzy_active'; } ?>">
					<a class="nav-link" href="<?php echo SITE_URL; ?>backend/s-appointments.php">
					<i class="fa fa-fw fa-calendar-check-o"></i>
					<span class="nav-link-text"><?php if(isset($rzvy_translangArr['appointments'])){ echo $rzvy_translangArr['appointments']; }else{ echo $rzvy_defaultlang['appointments']; } ?></span>
					</a>
				</li>
				<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'staff-profile.php') != false) { echo 'rzy_active'; } ?>">
					<a class="nav-link" href="<?php echo SITE_URL; ?>backend/staff-profile.php">
					<i class="fa fa-fw fa-user-plus"></i>
					<span class="nav-link-text"><?php if(isset($rzvy_translangArr['profile'])){ echo $rzvy_translangArr['profile']; }else{ echo $rzvy_defaultlang['profile']; } ?></span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="modal" data-target="#rzvy-change-password-modal"><i class="fa fa-fw fa-key" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['change_password'])){ echo $rzvy_translangArr['change_password']; }else{ echo $rzvy_defaultlang['change_password']; } ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="modal" data-target="#rzvy-logout-modal">
					<i class="fa fa-fw fa-sign-out"></i> <?php if(isset($rzvy_translangArr['logout'])){ echo $rzvy_translangArr['logout']; }else{ echo $rzvy_defaultlang['logout']; } ?></a>
				</li>
			</ul>
			<ul class="navbar-nav ml-auto">
				<?php 		
				if($lang_j>1){ 
					?>
					<li class="nav-item">
						<div class="nav-link nav-link-no-hover py-0">
							<div class="btn-danger px-2">
								<i class="fa fa-fw fa-language text-white" style="font-size:20px"></i>
								<select class="rzvy_set_language selectpicker" data-style="btn-danger">
									<?php echo $langOptions; ?>
								</select>
							</div>
						</div>
					</li>
					<?php 
				}  
				?>
			</ul>
		</div>
  </nav>
  <div class="rzvy-content-wrapper">
	<div id="rzvy-loader-overlay" class="rzvy_main_loader rzvy_hide_loader">
		<div id="rzvy-loader" class="rzvy_main_loader rzvy_hide_loader">
			<div class="rzvy-loader-dot"></div>
			<div class="rzvy-loader-dot"></div>
			<div class="rzvy-loader-dot"></div>
			<div class="rzvy-loader-dot"></div>
			<div class="rzvy-loader-dot"></div>
			<div class="rzvy-loader-dot"></div>
			<div class="rzvy-loader-dot"></div>
			<div class="rzvy-loader-dot"></div>
			<div class="rzvy-loader-loading"></div>
		</div>
	</div>
    <div class="container-fluid">