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
}else if($_SESSION['login_type'] == "staff") {
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/s-appointments.php";
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
if(!isset($_SESSION['customer_id'])) {
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/";
	</script>
	<?php 
	exit;
}
include(dirname(dirname(__FILE__))."/classes/class_settings.php");
include(dirname(dirname(__FILE__))."/classes/class_refund_request.php");

/* Create object of classes */
$obj_database->check_admin_setup_detail($conn);

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$obj_refund_request = new rzvy_refund_request();
$obj_refund_request->conn = $conn;

if(isset($rzvy_translangArr['customer_dashboard'])){ $dash_title = $rzvy_translangArr['customer_dashboard']; }else{ $dash_title = $rzvy_defaultlang['customer_dashboard']; }

$saiframe = '';
if(isset($_GET['if'])){
  	$saiframe = '?if=y';  
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/png" href="<?php  echo SITE_URL; ?>includes/images/favicon.ico" />
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
	<link href="<?php echo SITE_URL; ?>includes/css/rzvy-customer.css?<?php echo time(); ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/css/intlTelInput.css?<?php echo time(); ?>">
	
	<?php include("customer_dash_css.php"); ?>
</head>

<body class="rzvy fixed-nav sticky-footer bg-light" id="rzvy-page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="rzvy-mainnav">
    <a class="navbar-brand" href="<?php echo SITE_URL; ?>backend/my-appointments.php"><?php echo $dash_title; ?></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#rzvy-navbarresponsive" aria-controls="rzvy-navbarresponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
	<div class="collapse navbar-collapse" id="rzvy-navbarresponsive">
	  <ul class="navbar-nav navbar-sidenav" id="rzvy-menu-accordion">
		<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'my-appointments.php') != false) { echo 'rzy_active'; } ?>">
		  <a class="nav-link" href="<?php echo SITE_URL; ?>backend/my-appointments.php<?php echo $saiframe; ?>">
			<i class="fa fa-fw fa-calendar-check-o"></i>
			<span class="nav-link-text"><?php if(isset($rzvy_translangArr['my_appointments'])){ echo $rzvy_translangArr['my_appointments']; }else{ echo $rzvy_defaultlang['my_appointments']; } ?></span>
		  </a>
		</li>
		<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'c_refund.php') != false) { echo 'rzy_active'; } ?>">
		  <a class="nav-link" href="<?php echo SITE_URL; ?>backend/c_refund.php<?php echo $saiframe; ?>">
			<i class="fa fa-fw fa-exchange"></i>
			<span class="nav-link-text"><?php if(isset($rzvy_translangArr['refund'])){ echo $rzvy_translangArr['refund']; }else{ echo $rzvy_defaultlang['refund']; } ?></span>
		  </a>
		</li>
		<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'c_profile.php') != false) { echo 'rzy_active'; } ?>">
			<a class="nav-link" href="<?php echo SITE_URL; ?>backend/c_profile.php<?php echo $saiframe; ?>">
				<i class="fa fa-fw fa-user-o" aria-hidden="true"></i>
				<span class="nav-link-text"><?php if(isset($rzvy_translangArr['profile'])){ echo $rzvy_translangArr['profile']; }else{ echo $rzvy_defaultlang['profile']; } ?></span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="modal" data-target="#rzvy-change-password-modal">
				<i class="fa fa-fw fa-key" aria-hidden="true"></i>
				<span class="nav-link-text"><?php if(isset($rzvy_translangArr['change_password'])){ echo $rzvy_translangArr['change_password']; }else{ echo $rzvy_defaultlang['change_password']; } ?></span>
			</a>
		</li>
		<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'c-support-tickets.php') != false || strpos($_SERVER['SCRIPT_NAME'], 'c-ticket-discussion.php') != false) { echo 'rzy_active'; } ?>">
		  <a class="nav-link" href="<?php echo SITE_URL; ?>backend/c-support-tickets.php<?php echo $saiframe; ?>">
			<i class="fa fa-fw fa-comments-o"></i>
			<span class="nav-link-text"><?php if(isset($rzvy_translangArr['support_tickets'])){ echo $rzvy_translangArr['support_tickets']; }else{ echo $rzvy_defaultlang['support_tickets']; } ?></span>
		  </a>
		</li>
		<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'referral-coupons.php') != false) { echo 'rzy_active'; } ?>">
		  <a class="nav-link" href="<?php echo SITE_URL; ?>backend/referral-coupons.php<?php echo $saiframe; ?>">
			<i class="fa fa-fw fa-ticket"></i>
			<span class="nav-link-text"><?php if(isset($rzvy_translangArr['referral_coupons'])){ echo $rzvy_translangArr['referral_coupons']; }else{ echo $rzvy_defaultlang['referral_coupons']; } ?></span>
		  </a>
		</li>
		<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'refer.php') != false) { echo 'rzy_active'; } ?>">
		  <a class="nav-link" href="<?php echo SITE_URL; ?>backend/refer.php<?php echo $saiframe; ?>">
			<i class="fa fa-fw fa-gift"></i>
			<span class="nav-link-text"><?php if(isset($rzvy_translangArr['refer_a_friend'])){ echo $rzvy_translangArr['refer_a_friend']; }else{ echo $rzvy_defaultlang['refer_a_friend']; } ?></span>
		  </a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" data-toggle="modal" data-target="#rzvy-logout-modal">
			<i class="fa fa-fw fa-sign-out"></i>
			<span class="nav-link-text"><?php if(isset($rzvy_translangArr['logout'])){ echo $rzvy_translangArr['logout']; }else{ echo $rzvy_defaultlang['logout']; } ?></span>
		  </a>
		</li>
	  </ul>
	  <ul class="navbar-nav ml-auto"><?php 		
		if($lang_j>1){ 
			?>
			<li class="nav-item">
				<div class="nav-link nav-link-no-hover py-0">
					<div class="btn-danger px-2">
						<i class="fa fa-fw fa-language text-white" style="font-size:20px"></i>
						<select class="sarzy_set_language selectpicker" data-style="btn-danger">
							<?php echo $langOptions; ?>
						</select>
					</div>
				</div>
			</li>
			<?php 
		}  
		?>
		<li class="nav-item">
		  <a class="nav-link" href="<?php echo SITE_URL; ?><?php echo $saiframe; ?>">
			<i class="fa fa-fw fa-backward"></i>
			<span class="nav-link-text"><?php if(isset($rzvy_translangArr['continue_booking'])){ echo $rzvy_translangArr['continue_booking']; }else{ echo $rzvy_defaultlang['continue_booking']; } ?></span>
		  </a>
		</li>
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