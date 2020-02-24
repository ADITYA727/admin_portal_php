<?php 
session_start();
/* Include class files */
include(dirname(dirname(__FILE__))."/constants.php");

/* Redirect if user logged in */
if(isset($_SESSION['login_type'])) { 
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/";
	</script>
	<?php 
	exit;
}

include(dirname(dirname(__FILE__))."/classes/class_settings.php");

/* Create object of classes */
$obj_database->check_admin_setup_detail($conn);

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn; 
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
		<link href="<?php echo SITE_URL; ?>includes/vendor/bootstrap/css/bootstrap-select.min.css?<?php echo time(); ?>" rel="stylesheet" />
		<!-- Custom fonts for this template-->
		<link href="<?php echo SITE_URL; ?>includes/vendor/font-awesome/css/font-awesome.min.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<link href="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
		<!-- Custom styles for this template-->
		<link href="<?php echo SITE_URL; ?>includes/css/rzvy-register.css?<?php echo time(); ?>" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/css/intlTelInput.css?<?php echo time(); ?>">
		
		<?php include("bdp_lr_css.php"); ?>
	</head>
	<body class="rzvy">
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
		
		<!-- Brand and toggle get grouped for better mobile display -->
		<?php include(dirname(dirname(__FILE__))."/header1.php"); ?>
		
		<section class="rzvy-register-main my-3">
			<div class="container rzvy-register-container">
				<form id="rzvy_customer_register_form" name="rzvy_customer_register_form" method="post">
					<div class="row">
						<div class="col-md-12 pt-3 rzvy-register-right-block">
							<h2 class="text-center"><?php if(isset($rzvy_translangArr['register_as_customer'])){ echo $rzvy_translangArr['register_as_customer']; }else{ echo $rzvy_defaultlang['register_as_customer']; } ?></h2>
							<div class="row">
								<div class="form-group col-md-6">
									<label for="rzvy_register_customer_firstname"><?php if(isset($rzvy_translangArr['first_name'])){ echo $rzvy_translangArr['first_name']; }else{ echo $rzvy_defaultlang['first_name']; } ?></label>
									<input type="text" class="form-control" id="rzvy_register_customer_firstname" name="rzvy_register_customer_firstname" placeholder="<?php if(isset($rzvy_translangArr['enter_first_name'])){ echo $rzvy_translangArr['enter_first_name']; }else{ echo $rzvy_defaultlang['enter_first_name']; } ?>" />
								</div>
								<div class="form-group col-md-6">
									<label for="rzvy_register_customer_lastname"><?php if(isset($rzvy_translangArr['last_name'])){ echo $rzvy_translangArr['last_name']; }else{ echo $rzvy_defaultlang['last_name']; } ?></label>
									<input type="text" class="form-control" id="rzvy_register_customer_lastname" name="rzvy_register_customer_lastname" placeholder="<?php if(isset($rzvy_translangArr['enter_last_name'])){ echo $rzvy_translangArr['enter_last_name']; }else{ echo $rzvy_defaultlang['enter_last_name']; } ?>" />
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-4">
									<label for="rzvy_register_customer_email"><?php if(isset($rzvy_translangArr['email'])){ echo $rzvy_translangArr['email']; }else{ echo $rzvy_defaultlang['email']; } ?></label>
									<input type="text" class="form-control" id="rzvy_register_customer_email" name="rzvy_register_customer_email" placeholder="<?php if(isset($rzvy_translangArr['enter_email'])){ echo $rzvy_translangArr['enter_email']; }else{ echo $rzvy_defaultlang['enter_email']; } ?>" />
								</div>
								<div class="form-group col-md-4">
									<label for="rzvy_register_customer_password"><?php if(isset($rzvy_translangArr['password'])){ echo $rzvy_translangArr['password']; }else{ echo $rzvy_defaultlang['password']; } ?></label>
									<input type="password" class="form-control" id="rzvy_register_customer_password" name="rzvy_register_customer_password" placeholder="<?php if(isset($rzvy_translangArr['enter_password'])){ echo $rzvy_translangArr['enter_password']; }else{ echo $rzvy_defaultlang['enter_password']; } ?>" />
								</div>
								<div class="form-group col-md-4">
									<label for="rzvy_register_customer_phone"><?php if(isset($rzvy_translangArr['phone'])){ echo $rzvy_translangArr['phone']; }else{ echo $rzvy_defaultlang['phone']; } ?></label>
									<input type="text" class="form-control" id="rzvy_register_customer_phone" name="rzvy_register_customer_phone" placeholder="<?php if(isset($rzvy_translangArr['enter_phone'])){ echo $rzvy_translangArr['enter_phone']; }else{ echo $rzvy_defaultlang['enter_phone']; } ?>" />
									<label for="rzvy_register_customer_phone" generated="true" class="error"></label>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-12">
									<label for="rzvy_register_customer_address"><?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?></label>
									<textarea class="form-control" id="rzvy_register_customer_address" name="rzvy_register_customer_address" placeholder="<?php if(isset($rzvy_translangArr['enter_address'])){ echo $rzvy_translangArr['enter_address']; }else{ echo $rzvy_defaultlang['enter_address']; } ?>" rows="1"></textarea>
								</div>
							</div>
							<div class="row">
								<div class="form-group col-md-3">
									<label for="rzvy_register_customer_city"><?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?></label>
									<input type="text" class="form-control" id="rzvy_register_customer_city" name="rzvy_register_customer_city" placeholder="<?php if(isset($rzvy_translangArr['enter_city'])){ echo $rzvy_translangArr['enter_city']; }else{ echo $rzvy_defaultlang['enter_city']; } ?>">
								</div>
								<div class="form-group col-md-3">
									<label for="rzvy_register_customer_state"><?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?></label>
									<input type="text" class="form-control" id="rzvy_register_customer_state" name="rzvy_register_customer_state" placeholder="<?php if(isset($rzvy_translangArr['enter_state'])){ echo $rzvy_translangArr['enter_state']; }else{ echo $rzvy_defaultlang['enter_state']; } ?>">
								</div>
								<div class="form-group col-md-3">
									<label for="rzvy_register_customer_zip"><?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?></label>
									<input type="text" class="form-control" id="rzvy_register_customer_zip" name="rzvy_register_customer_zip" placeholder="<?php if(isset($rzvy_translangArr['enter_zip'])){ echo $rzvy_translangArr['enter_zip']; }else{ echo $rzvy_defaultlang['enter_zip']; } ?>">
								</div>
								<div class="form-group col-md-3">
									<label for="rzvy_register_customer_country"><?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?></label>
									<input type="text" class="form-control" id="rzvy_register_customer_country" name="rzvy_register_customer_country" placeholder="<?php if(isset($rzvy_translangArr['enter_country'])){ echo $rzvy_translangArr['enter_country']; }else{ echo $rzvy_defaultlang['enter_country']; } ?>">
								</div>
							</div>
							<div class="row mt-2 mb-3">
								<div class="col-md-12">
									<button type="submit" id="rzvy_customer_register_btn" class="rzvy_register_btn btn p-2 w-100"><?php if(isset($rzvy_translangArr['register_now'])){ echo $rzvy_translangArr['register_now']; }else{ echo $rzvy_defaultlang['register_now']; } ?></button>
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
		<script src="<?php echo SITE_URL; ?>includes/vendor/bootstrap/js/bootstrap-select.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.js?<?php echo time(); ?>"></script>
		<!-- Custom scripts for all pages-->
		<script>
			var generalObj = { 'site_url' : '<?php echo SITE_URL; ?>', 'ajax_url' : '<?php echo AJAX_URL; ?>', 'twocheckout_status' : 'N', 'twocheckout_sid' : '', 'twocheckout_pkey' : '', 'stripe_status' : 'N', 'stripe_pkey' : '', 'defaultCountryCode' : '<?php $rzvy_default_country_code = $obj_settings->get_option("rzvy_default_country_code"); if($rzvy_default_country_code != ""){ echo $rzvy_default_country_code; }else{ echo "us"; } ?>',
			'please_enter_first_name' : "<?php if(isset($rzvy_translangArr['please_enter_first_name'])){ echo $rzvy_translangArr['please_enter_first_name']; }else{ echo $rzvy_defaultlang['please_enter_first_name']; } ?>" 
			, 'please_enter_only_alphabets' : "<?php if(isset($rzvy_translangArr['please_enter_only_alphabets'])){ echo $rzvy_translangArr['please_enter_only_alphabets']; }else{ echo $rzvy_defaultlang['please_enter_only_alphabets']; } ?>" 
			, 'please_enter_valid_phone_number_without_country_code' : "<?php if(isset($rzvy_translangArr['please_enter_valid_phone_number_without_country_code'])){ echo $rzvy_translangArr['please_enter_valid_phone_number_without_country_code']; }else{ echo $rzvy_defaultlang['please_enter_valid_phone_number_without_country_code']; } ?>" 
			, 'please_enter_valid_zip' : "<?php if(isset($rzvy_translangArr['please_enter_valid_zip'])){ echo $rzvy_translangArr['please_enter_valid_zip']; }else{ echo $rzvy_defaultlang['please_enter_valid_zip']; } ?>" 
			, 'please_select_payment_method' : "<?php if(isset($rzvy_translangArr['please_select_payment_method'])){ echo $rzvy_translangArr['please_select_payment_method']; }else{ echo $rzvy_defaultlang['please_select_payment_method']; } ?>" 
			, 'please_enter_maximum_50_characters' : "<?php if(isset($rzvy_translangArr['please_enter_maximum_50_characters'])){ echo $rzvy_translangArr['please_enter_maximum_50_characters']; }else{ echo $rzvy_defaultlang['please_enter_maximum_50_characters']; } ?>" 
			, 'please_enter_last_name' : "<?php if(isset($rzvy_translangArr['please_enter_last_name'])){ echo $rzvy_translangArr['please_enter_last_name']; }else{ echo $rzvy_defaultlang['please_enter_last_name']; } ?>" 
			, 'please_enter_email' : "<?php if(isset($rzvy_translangArr['please_enter_email'])){ echo $rzvy_translangArr['please_enter_email']; }else{ echo $rzvy_defaultlang['please_enter_email']; } ?>" 
			, 'please_enter_valid_email' : "<?php if(isset($rzvy_translangArr['please_enter_valid_email'])){ echo $rzvy_translangArr['please_enter_valid_email']; }else{ echo $rzvy_defaultlang['please_enter_valid_email']; } ?>" 
			, 'email_already_exist' : "<?php if(isset($rzvy_translangArr['email_already_exist'])){ echo $rzvy_translangArr['email_already_exist']; }else{ echo $rzvy_defaultlang['email_already_exist']; } ?>" 
			, 'please_enter_password' : "<?php if(isset($rzvy_translangArr['please_enter_password'])){ echo $rzvy_translangArr['please_enter_password']; }else{ echo $rzvy_defaultlang['please_enter_password']; } ?>" 
			, 'please_enter_minimum_8_characters' : "<?php if(isset($rzvy_translangArr['please_enter_minimum_8_characters'])){ echo $rzvy_translangArr['please_enter_minimum_8_characters']; }else{ echo $rzvy_defaultlang['please_enter_minimum_8_characters']; } ?>" 
			, 'please_enter_maximum_20_characters' : "<?php if(isset($rzvy_translangArr['please_enter_maximum_20_characters'])){ echo $rzvy_translangArr['please_enter_maximum_20_characters']; }else{ echo $rzvy_defaultlang['please_enter_maximum_20_characters']; } ?>" 
			, 'please_enter_phone_number' : "<?php if(isset($rzvy_translangArr['please_enter_phone_number'])){ echo $rzvy_translangArr['please_enter_phone_number']; }else{ echo $rzvy_defaultlang['please_enter_phone_number']; } ?>" 
			, 'please_enter_minimum_5_characters' : "<?php if(isset($rzvy_translangArr['please_enter_minimum_5_characters'])){ echo $rzvy_translangArr['please_enter_minimum_5_characters']; }else{ echo $rzvy_defaultlang['please_enter_minimum_5_characters']; } ?>" 
			, 'please_enter_minimum_10_digits' : "<?php if(isset($rzvy_translangArr['please_enter_minimum_10_digits'])){ echo $rzvy_translangArr['please_enter_minimum_10_digits']; }else{ echo $rzvy_defaultlang['please_enter_minimum_10_digits']; } ?>" 
			, 'please_enter_maximum_15_digits' : "<?php if(isset($rzvy_translangArr['please_enter_maximum_15_digits'])){ echo $rzvy_translangArr['please_enter_maximum_15_digits']; }else{ echo $rzvy_defaultlang['please_enter_maximum_15_digits']; } ?>" 
			, 'please_enter_address' : "<?php if(isset($rzvy_translangArr['please_enter_address'])){ echo $rzvy_translangArr['please_enter_address']; }else{ echo $rzvy_defaultlang['please_enter_address']; } ?>" 
			, 'please_enter_city' : "<?php if(isset($rzvy_translangArr['please_enter_city'])){ echo $rzvy_translangArr['please_enter_city']; }else{ echo $rzvy_defaultlang['please_enter_city']; } ?>" 
			, 'please_enter_state' : "<?php if(isset($rzvy_translangArr['please_enter_state'])){ echo $rzvy_translangArr['please_enter_state']; }else{ echo $rzvy_defaultlang['please_enter_state']; } ?>" 
			, 'please_enter_zip' : "<?php if(isset($rzvy_translangArr['please_enter_zip'])){ echo $rzvy_translangArr['please_enter_zip']; }else{ echo $rzvy_defaultlang['please_enter_zip']; } ?>" 
			, 'please_enter_maximum_10_characters' : "<?php if(isset($rzvy_translangArr['please_enter_maximum_10_characters'])){ echo $rzvy_translangArr['please_enter_maximum_10_characters']; }else{ echo $rzvy_defaultlang['please_enter_maximum_10_characters']; } ?>" 
			, 'please_enter_country' : "<?php if(isset($rzvy_translangArr['please_enter_country'])){ echo $rzvy_translangArr['please_enter_country']; }else{ echo $rzvy_defaultlang['please_enter_country']; } ?>" 
			, 'please_select_business_type' : "<?php if(isset($rzvy_translangArr['please_select_business_type'])){ echo $rzvy_translangArr['please_select_business_type']; }else{ echo $rzvy_defaultlang['please_select_business_type']; } ?>" 
			, 'please_enter_company_name' : "<?php if(isset($rzvy_translangArr['please_enter_company_name'])){ echo $rzvy_translangArr['please_enter_company_name']; }else{ echo $rzvy_defaultlang['please_enter_company_name']; } ?>" 
			, 'please_enter_company_email' : "<?php if(isset($rzvy_translangArr['please_enter_company_email'])){ echo $rzvy_translangArr['please_enter_company_email']; }else{ echo $rzvy_defaultlang['please_enter_company_email']; } ?>" 
			, 'please_enter_company_phone' : "<?php if(isset($rzvy_translangArr['please_enter_company_phone'])){ echo $rzvy_translangArr['please_enter_company_phone']; }else{ echo $rzvy_defaultlang['please_enter_company_phone']; } ?>" 
			, 'please_enter_company_address' : "<?php if(isset($rzvy_translangArr['please_enter_company_address'])){ echo $rzvy_translangArr['please_enter_company_address']; }else{ echo $rzvy_defaultlang['please_enter_company_address']; } ?>" 
			, 'please_enter_company_city' : "<?php if(isset($rzvy_translangArr['please_enter_company_city'])){ echo $rzvy_translangArr['please_enter_company_city']; }else{ echo $rzvy_defaultlang['please_enter_company_city']; } ?>" 
			, 'please_enter_company_state' : "<?php if(isset($rzvy_translangArr['please_enter_company_state'])){ echo $rzvy_translangArr['please_enter_company_state']; }else{ echo $rzvy_defaultlang['please_enter_company_state']; } ?>" 
			, 'please_enter_company_zip' : "<?php if(isset($rzvy_translangArr['please_enter_company_zip'])){ echo $rzvy_translangArr['please_enter_company_zip']; }else{ echo $rzvy_defaultlang['please_enter_company_zip']; } ?>" 
			, 'please_enter_company_country' : "<?php if(isset($rzvy_translangArr['please_enter_company_country'])){ echo $rzvy_translangArr['please_enter_company_country']; }else{ echo $rzvy_defaultlang['please_enter_company_country']; } ?>" 
			, 'opps' : "<?php if(isset($rzvy_translangArr['opps'])){ echo $rzvy_translangArr['opps']; }else{ echo $rzvy_defaultlang['opps']; } ?>" 
			, 'something_went_wrong_please_try_again' : "<?php if(isset($rzvy_translangArr['something_went_wrong_please_try_again'])){ echo $rzvy_translangArr['something_went_wrong_please_try_again']; }else{ echo $rzvy_defaultlang['something_went_wrong_please_try_again']; } ?>" };
		</script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/js/intlTelInput.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/js/rzvy-register.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/js/rzvy-set-languages.js?<?php echo time(); ?>"></script>
	</body>
</html>