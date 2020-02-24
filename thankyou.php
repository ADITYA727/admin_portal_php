<?php 
session_start();
include(dirname(__FILE__)."/constants.php"); 

$obj_database->check_admin_setup_detail($conn);

/* Include class files */
include(dirname(__FILE__)."/classes/class_frontend.php");
include(dirname(__FILE__)."/classes/class_settings.php");

/* Create object of classes */
$obj_frontend = new rzvy_frontend();
$obj_frontend->conn = $conn; 

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;
 
$saiframe = '';
if(isset($_GET['if'])){
	$saiframe = '?if=y';  
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="-1" />
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
		if($rzvy_seo_og_tag_image != '' && file_exists("uploads/images/".$rzvy_seo_og_tag_image)){ 
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
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/bootstrap.min.css?<?php echo time(); ?>" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/font-awesome.min.css?<?php echo time(); ?>" />
		
		<style>
			.rzvy .jumbotron{
				background-color: #ffffff;
			}
		</style>
		<!-- Custom scripts -->
		<script type="text/javascript">
			var timer = 5; /* seconds */
			frontpage = '<?php echo SITE_URL.$saiframe; ?>';
			function delayer() {
				window.location = frontpage;
			}
			setTimeout('delayer()', 1000 * timer);
		</script>
	</head>
	<body class="rzvy">
		<center class="pt-5">
			<!-- Thank you page content start -->
			<div class="jumbotron text-xs-center">
			  <i class="fa fa-calendar-check-o fa-5x text-success" aria-hidden="true"></i>
			  <br />
			  <h1 class="display-3"><?php if(isset($rzvy_translangArr['thank_you'])){ echo $rzvy_translangArr['thank_you']; }else{ echo $rzvy_defaultlang['thank_you']; } ?></h1>
			  <br />
			  <h4 class="py-2"><i class="fa fa-check-square-o text-success" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['your_appointment_has_been_booked'])){ echo $rzvy_translangArr['your_appointment_has_been_booked']; }else{ echo $rzvy_defaultlang['your_appointment_has_been_booked']; } ?></h4>
				<h6 class="py-2"><?php if(isset($rzvy_translangArr['if_you_have_any_questions_about_this_appointment_please_generate_ticket_related_your_issue_from'])){ echo $rzvy_translangArr['if_you_have_any_questions_about_this_appointment_please_generate_ticket_related_your_issue_from']; }else{ echo $rzvy_defaultlang['if_you_have_any_questions_about_this_appointment_please_generate_ticket_related_your_issue_from']; } ?> <a href="<?php echo SITE_URL; ?>backend/c-support-tickets.php<?php echo $saiframe; ?>"><?php if(isset($rzvy_translangArr['support_tickets'])){ echo $rzvy_translangArr['support_tickets']; }else{ echo $rzvy_defaultlang['support_tickets']; } ?></a></h6>
				<h6 class="py-2"><?php if(isset($rzvy_translangArr['to_check_your_booking_or_to_make_a_cancellation_visit'])){ echo $rzvy_translangArr['to_check_your_booking_or_to_make_a_cancellation_visit']; }else{ echo $rzvy_defaultlang['to_check_your_booking_or_to_make_a_cancellation_visit']; } ?> <a href="<?php echo SITE_URL; ?>backend/my-appointments.php<?php echo $saiframe; ?>"><?php if(isset($rzvy_translangArr['my_appointments'])){ echo $rzvy_translangArr['my_appointments']; }else{ echo $rzvy_defaultlang['my_appointments']; } ?></a></h6>
				<h6 class="py-2"><?php if(isset($rzvy_translangArr['to_book_more_appointment'])){ echo $rzvy_translangArr['to_book_more_appointment']; }else{ echo $rzvy_defaultlang['to_book_more_appointment']; } ?> <a href="<?php echo SITE_URL.$saiframe; ?>"><?php if(isset($rzvy_translangArr['continue_booking'])){ echo $rzvy_translangArr['continue_booking']; }else{ echo $rzvy_defaultlang['continue_booking']; } ?></a></h6>
			</div>
			<!-- Thank you page content end -->
		</center>
	</body>
</html>