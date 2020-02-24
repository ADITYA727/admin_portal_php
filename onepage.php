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
		<link href="<?php echo SITE_URL; ?>includes/vendor/bootstrap/css/bootstrap-select.min.css?<?php echo time(); ?>" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/font-awesome.min.css?<?php echo time(); ?>" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/pe-icon-7-stroke.css?<?php echo time(); ?>" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/datepicker.min.css?<?php echo time(); ?>" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/rzvy-front-style.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/rzvy-front-calendar-style.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/css/intlTelInput.css?<?php echo time(); ?>">
					
		<!-- Bootstrap core JavaScript and Page level plugin JavaScript-->
		<script src="<?php echo SITE_URL; ?>includes/front/js/jquery-3.2.1.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/front/js/popper.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/front/js/bootstrap.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/bootstrap/js/bootstrap-select.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/front/js/slick.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/front/js/datepicker.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/jquery/jquery.validate.min.js?<?php echo time(); ?>"></script>
		
		<?php include(dirname(__FILE__)."/includes/lib/rzvy_lang_objects.php"); ?>
		
		<?php if($obj_settings->get_option("rzvy_authorizenet_payment_status") == "Y" || $obj_settings->get_option("rzvy_twocheckout_payment_status") == "Y"){ ?>
		<script src="<?php echo SITE_URL; ?>includes/vendor/jquery/jquery.payment.min.js?<?php echo time(); ?>" type="text/javascript"></script>
		<script>
		$(document).ready(function(){
			/** card payment validation **/
			$('#rzvy-cardnumber').payment('formatCardNumber');
			$('#rzvy-cardcvv').payment('formatCardCVC');
			$('#rzvy-cardexmonth').payment('restrictNumeric');
			$('#rzvy-cardexyear').payment('restrictNumeric');
		});
		</script>
		<?php } ?>
		
		<?php if($obj_settings->get_option('rzvy_twocheckout_payment_status') == 'Y'){ ?>
		<script src="https://www.2checkout.com/checkout/api/2co.min.js" type="text/javascript"></script>	
		<?php } ?>
		
		<!-- Custom scripts -->
		<script>
			var generalObj = { 'site_url' : '<?php echo SITE_URL; ?>', 'ajax_url' : '<?php echo AJAX_URL; ?>', 'ty_link' : '<?php echo $obj_settings->get_option('rzvy_thankyou_page_url').$saiframe; ?>', 'twocheckout_status' : '<?php echo $obj_settings->get_option('rzvy_twocheckout_payment_status'); ?>', 'twocheckout_sid' : '<?php echo $obj_settings->get_option('rzvy_twocheckout_seller_id'); ?>', 'twocheckout_pkey' : '<?php echo $obj_settings->get_option('rzvy_twocheckout_publishable_key'); ?>', 'stripe_status' : '<?php echo $obj_settings->get_option('rzvy_stripe_payment_status'); ?>', 'stripe_pkey' : '<?php echo $obj_settings->get_option('rzvy_stripe_publishable_key'); ?>', 'location_selector' : '<?php echo $show_location_selector; ?>', 'minimum_booking_amount':'<?php echo $obj_settings->get_option('rzvy_minimum_booking_amount');?>', 'endslot_status' : '<?php echo $obj_settings->get_option('rzvy_endtimeslot_selection_status'); ?>', 'single_category_status' : '<?php echo $obj_settings->get_option('rzvy_single_category_autotrigger_status'); ?>', 'defaultCountryCode' : '<?php $rzvy_default_country_code = $obj_settings->get_option("rzvy_default_country_code"); if($rzvy_default_country_code != ""){ echo $rzvy_default_country_code; }else{ echo "us"; } ?>', 'single_service_status' : '<?php echo $obj_settings->get_option('rzvy_single_service_autotrigger_status'); ?>' };
			
			var formfieldsObj = { 'en_ff_phone_status' : '<?php echo $rzvy_en_ff_phone_status; ?>', 'g_ff_phone_status' : '<?php echo $rzvy_g_ff_phone_status; ?>', 'en_ff_firstname' : '<?php echo $rzvy_en_ff_firstname_optional; ?>', 'en_ff_lastname' : '<?php echo $rzvy_en_ff_lastname_optional; ?>', 'en_ff_phone' : '<?php echo $rzvy_en_ff_phone_optional; ?>', 'en_ff_address' : '<?php echo $rzvy_en_ff_address_optional; ?>', 'en_ff_city' : '<?php echo $rzvy_en_ff_city_optional; ?>', 'en_ff_state' : '<?php echo $rzvy_en_ff_state_optional; ?>', 'en_ff_country' : '<?php echo $rzvy_en_ff_country_optional; ?>', 'g_ff_firstname' : '<?php echo $rzvy_g_ff_firstname_optional; ?>', 'g_ff_lastname' : '<?php echo $rzvy_g_ff_lastname_optional; ?>', 'g_ff_phone' : '<?php echo $rzvy_g_ff_phone_optional; ?>', 'g_ff_address' : '<?php echo $rzvy_g_ff_address_optional; ?>', 'g_ff_city' : '<?php echo $rzvy_g_ff_city_optional; ?>', 'g_ff_state' : '<?php echo $rzvy_g_ff_state_optional; ?>', 'g_ff_country' : '<?php echo $rzvy_g_ff_country_optional; ?>' }; 
		</script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/js/intlTelInput.js?<?php echo time(); ?>"></script>
		<?php include("backend/bf_css.php"); ?>
	</head>
	<body class="rzvy" onscroll="parent.postMessage(document.body.scrollHeight, '*');" onload="parent.postMessage(document.body.scrollHeight, '*');">
		<div class="rzvy-booking-detail-body">
			<!-- Brand and toggle get grouped for better mobile display -->
			<?php include(dirname(__FILE__)."/header2.php"); ?>			
			<section class="rzvy-booking-detail-block rzvy-center-block rzvy-main-block-before">
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
				<div class="container">
					<?php if($obj_settings->get_option('rzvy_welcome_message_status')=='Y'){ ?>
					<div class="row rzvy_welcome_content">
						<div class="col-md-12 rzvy-set-sm-fit mb-9"><?php echo base64_decode($obj_settings->get_option('rzvy_welcome_message_container'));?> </div>
					</div>
					<?php } ?>
					<div class="row">
						<div class="col-md-8 rzvy-set-sm-fit mb-4">
							<div class="rzvy-booking-detail-main">
								<div class="rzvy-radio-group-block rzvy-company-services-blocks">
									<div class="rzvy-radio-group-block-content rzvy-no-border-bottom  rzvy-no-border-top py-3">
										<h4><?php if(isset($rzvy_translangArr['what_type_of_service'])){ echo $rzvy_translangArr['what_type_of_service']; }else{ echo $rzvy_defaultlang['what_type_of_service']; } ?></h4>
									</div>
									<div class="d-flex flex-wrap">
										<?php 
										$i=0;
										$total_cat = mysqli_num_rows($all_categories);
										if($total_cat>0){
											while($category = mysqli_fetch_array($all_categories)){ 
												?>
												<div class="col-md-4 rzy_same_padding px-0 rzvy-sm-box">
													<div class="rzvy-styled-radio">
														<input type="radio" id="rzvy-categories-radio-<?php echo $category['id']; ?>" value="<?php echo $category['id']; ?>" name="rzvy-categories-radio" class="rzvy-categories-radio-change">
														<label for="rzvy-categories-radio-<?php echo $category['id']; ?>"><?php echo ucwords($category['cat_name']); ?></label>
													</div>
												</div>
												<?php 
											} 
										}else{ 
											?>
											<div class="col-xs-12 col-md-12 rzvy-sm-box">
												<label><?php if(isset($rzvy_translangArr['please_configure_first_services_from_admin_area'])){ echo $rzvy_translangArr['please_configure_first_services_from_admin_area']; }else{ echo $rzvy_defaultlang['please_configure_first_services_from_admin_area']; } ?></label>
											</div>
											<?php 
										} 
										?>
									</div>
								</div>
								<div class="row rzvy_show_hide_services">
									<div class="col-md-12">
										<div class="rzvy-radio-group-block-content rzvy-no-border-bottom m-0 border-0 pb-3 pt-1">
											<h4><?php if(isset($rzvy_translangArr['tell_us_about_your_service'])){ echo $rzvy_translangArr['tell_us_about_your_service']; }else{ echo $rzvy_defaultlang['tell_us_about_your_service']; } ?></h4>
										</div>
									</div>
								</div>
								<div class="rzvy-radio-group-block rzvy-no-border-bottom rzvy-mb-minus2 rzvy_show_hide_services">
									<div id="rzvy_services_html_content" class="d-flex flex-wrap">
										<!-- services will go here -->
									</div>
								</div>
								<div class="row rzvy-mb-minus4 rzvy_show_hide_addons">
									<div class="col-md-12">
										<div class="rzvy-radio-group-block-content rzvy-no-border-bottom m-0 border-0 pb-2 pt-2">
											<h4><?php if(isset($rzvy_translangArr['select_additional_services'])){ echo $rzvy_translangArr['select_additional_services']; }else{ echo $rzvy_defaultlang['select_additional_services']; } ?></h4>
										</div>
									</div>
								</div>
								<div id="rzvy_multi_and_single_qty_addons_content">
									<!-- multipleqty & singleqty addons will go here -->
								</div>
								
								<!-- STAFF SECTION START -->
								<div id="rzvy-staff-main">
								</div>
								<!-- STAFF SECTION END -->
								
								<div class="row">
									<div class="col-md-12">
										<div class="rzvy-radio-group-block-content rzvy-no-border-bottom mt-1 pt-2 pb-3">
											<h4><?php if(isset($rzvy_translangArr['choose_your_appointment_slot'])){ echo $rzvy_translangArr['choose_your_appointment_slot']; }else{ echo $rzvy_defaultlang['choose_your_appointment_slot']; } ?></h4>
										</div>
									</div>
								</div>
								<div class="row pt-0">
									<div class="col-md-12">
										<div class="rzvy-inline-calendar">
											<div class="rzvy-inline-calendar-container rzvy-inline-calendar-container-boxshadow">
												<center><h3><?php if(isset($rzvy_translangArr['please_wait'])){ echo $rzvy_translangArr['please_wait']; }else{ echo $rzvy_defaultlang['please_wait']; } ?></h3></center>
											</div>
											<div class="rzvy-inline-calendar-container-boxshadow rzvy_selected_slot_detail pl-5 pr-5 pb-2 pt-3 text-center">
												
											</div>
										</div>
										<input type="hidden" id="rzvy_time_slots_selection_date" value="" />
										<input type="hidden" id="rzvy_time_slots_selection_starttime" value="" />
										<input type="hidden" id="rzvy_time_slots_selection_endtime" value="" />
										<input type="hidden" id="rzvy_fdate" value="" />
										<input type="hidden" id="rzvy_fstime" value="" />
										<input type="hidden" id="rzvy_fetime" value="" />
									</div>
								</div>
								<div class="rzvy-radio-group-block mt-4 show_hide_frequently_discount">
									<h4 class="pb-2"><?php if(isset($rzvy_translangArr['how_often_would_you_like_service'])){ echo $rzvy_translangArr['how_often_would_you_like_service']; }else{ echo $rzvy_defaultlang['how_often_would_you_like_service']; } ?></h4>
									<div id="rzvy_frequently_discount_content" class="show_hide_frequently_discount">
										<!-- frequently discount will go here -->
									</div>
								</div>
								<?php 
								$useremail = "";
								$userpassword = "";
								$userfirstname = "";
								$userlastname = "";
								if(isset($_SESSION['rzvy_location_selector_zipcode'])){
									$userzip = $_SESSION['rzvy_location_selector_zipcode'];
								}else{
									$userzip = "";
								}
								$userphone = "";
								$useraddress = "";
								$usercity = "";
								$userstate = "";
								$usercountry = "";
								if(isset($_SESSION['customer_id'])){
									$obj_frontend->customer_id = $_SESSION['customer_id'];
									$customer_detail = $obj_frontend->readone_customer();
									$useremail = $customer_detail['email'];
									$userpassword = $customer_detail['password'];
									$userfirstname = ucwords($customer_detail['firstname']);
									$userlastname = ucwords($customer_detail['lastname']);
									if(isset($_SESSION['rzvy_location_selector_zipcode'])){
										$userzip = $_SESSION['rzvy_location_selector_zipcode'];
									}else{
										$userzip = "";
									}
									$userphone = $customer_detail['phone'];
									$useraddress = $customer_detail['address'];
									$usercity = $customer_detail['city'];
									$userstate = $customer_detail['state'];
									$usercountry = $customer_detail['country'];
								} 
								?>
								<div class="row">
									<div class="col-md-12">
										<div class="rzvy-radio-group-block-content rzvy-no-border-bottom my-1 py-3">
											<h4><?php if(isset($rzvy_translangArr['personal_information'])){ echo $rzvy_translangArr['personal_information']; }else{ echo $rzvy_defaultlang['personal_information']; } ?></h4>
											<div class="rzvy-users-selection-div" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:none;'"; } ?>>
												<?php 
												$rzvy_show_existing_new_user_checkout = $obj_settings->get_option("rzvy_show_existing_new_user_checkout");
												$rzvy_show_guest_user_checkout = $obj_settings->get_option("rzvy_show_guest_user_checkout");
												if($rzvy_show_existing_new_user_checkout == "Y"){ 
													?>
													<input type="radio" class="rzvy-user-selection" id="rzvy-existing-user" name="rzvy-user-selection" checked value="ec" />
													<label class="rzvy-user-selection-label" for="rzvy-existing-user"><?php if(isset($rzvy_translangArr['existing_customer'])){ echo $rzvy_translangArr['existing_customer']; }else{ echo $rzvy_defaultlang['existing_customer']; } ?></label>

													<input type="radio" class="rzvy-user-selection" id="rzvy-new-user" name="rzvy-user-selection" value="nc" />
													<label class="rzvy-user-selection-label" for="rzvy-new-user"><?php if(isset($rzvy_translangArr['new_customer'])){ echo $rzvy_translangArr['new_customer']; }else{ echo $rzvy_defaultlang['new_customer']; } ?></label>
												
												<?php 
												}
												
												if($rzvy_show_guest_user_checkout == "Y"){ 
													?>
													<input type="radio" class="rzvy-user-selection" id="rzvy-guest-user" name="rzvy-user-selection" <?php if($rzvy_show_existing_new_user_checkout == "N"){ echo "checked"; } ?> value="gc" />
													<label class="rzvy-user-selection-label" for="rzvy-guest-user"><?php if(isset($rzvy_translangArr['guest_customer'])){ echo $rzvy_translangArr['guest_customer']; }else{ echo $rzvy_defaultlang['guest_customer']; } ?></label>
													<?php 
												} 
												
												if($rzvy_show_existing_new_user_checkout == "Y" || $rzvy_show_guest_user_checkout == "Y"){ 
													?>
													<input type="radio" class="rzvy-user-selection" id="rzvy-user-forget-password" name="rzvy-user-selection" value="fp" />
													<label class="rzvy-user-selection-label" for="rzvy-user-forget-password"><?php if(isset($rzvy_translangArr['forget_password'])){ echo $rzvy_translangArr['forget_password']; }else{ echo $rzvy_defaultlang['forget_password']; } ?></label>
													<?php 
												} 
												?>
											</div>
											<div class="rzvy-logout-div mt-2" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:block;'"; } ?> >
												<label><?php if(isset($rzvy_translangArr['you_are_logged_in_as'])){ echo $rzvy_translangArr['you_are_logged_in_as']; }else{ echo $rzvy_defaultlang['you_are_logged_in_as']; } ?> <b class="rzvy_loggedin_name"><?php echo $useremail; ?></b>. <a href="javascript:void(0)" id="rzvy_logout_btn"><?php if(isset($rzvy_translangArr['logout'])){ echo $rzvy_translangArr['logout']; }else{ echo $rzvy_defaultlang['logout']; } ?></a></label>
											</div>
										</div>
									</div>
								</div>
								<?php 
								if($rzvy_show_existing_new_user_checkout == "Y"){ 
									?>
									<form method="post" name="rzvy_login_form" id="rzvy_login_form">
										<div class="rzvy-radio-group-block mt24" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:none;'"; } ?> id="rzvy-existing-user-box">
											<div class="row">
												<div class="col-md-6">
													<div class="rzvy-input-class-div">
														<input type="email" name="rzvy_login_email" id="rzvy_login_email" placeholder="<?php if(isset($rzvy_translangArr['email_address'])){ echo $rzvy_translangArr['email_address']; }else{ echo $rzvy_defaultlang['email_address']; } ?>" class="rzvy-input-class">
													</div>
												</div>
												<div class="col-md-6">
													<div class="rzvy-input-class-div">
														<input type="password" name="rzvy_login_password" id="rzvy_login_password" placeholder="<?php if(isset($rzvy_translangArr['password'])){ echo $rzvy_translangArr['password']; }else{ echo $rzvy_defaultlang['password']; } ?>" class="rzvy-input-class">
													</div>
												</div>
											</div>
											<div class="row mt-2">
												<div class="col-md-12">
													<button id="rzvy_login_btn" class="btn btn-block rzvy-block-btn" type="submit"><i class="fa fa-lock"></i> <?php if(isset($rzvy_translangArr['login'])){ echo $rzvy_translangArr['login']; }else{ echo $rzvy_defaultlang['login']; } ?></button>
												</div>
											</div>
										</div>
									</form>
									<form method="post" name="rzvy_user_detail_form" id="rzvy_user_detail_form">
										<div class="rzvy-radio-group-block mt24" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:block;'"; } ?> id="rzvy-new-user-box">
											<div class="row rzvy_hide_after_login" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:none;'"; } ?>>
												<div class="col-md-6">
													<div class="rzvy-input-class-div">
														<input type="email" id="rzvy_user_email" name="rzvy_user_email" placeholder="<?php if(isset($rzvy_translangArr['email_address'])){ echo $rzvy_translangArr['email_address']; }else{ echo $rzvy_defaultlang['email_address']; } ?>" value="<?php echo $useremail; ?>" class="rzvy-input-class">
													</div>
												</div>
												<div class="col-md-6">
													<div class="rzvy-input-class-div">
														<input type="password" id="rzvy_user_password" name="rzvy_user_password" placeholder="<?php if(isset($rzvy_translangArr['password'])){ echo $rzvy_translangArr['password']; }else{ echo $rzvy_defaultlang['password']; } ?>" value="<?php echo $userpassword; ?>" class="rzvy-input-class">
													</div>
												</div>
											</div>
											<div class="row">
												<?php 
												if($rzvy_en_ff_firstname_status == "Y"){ 
													?>
													<div class="col-md-6">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_user_firstname" name="rzvy_user_firstname" placeholder="<?php if(isset($rzvy_translangArr['first_name'])){ echo $rzvy_translangArr['first_name']; }else{ echo $rzvy_defaultlang['first_name']; } ?>" value="<?php echo $userfirstname; ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php  
												}else{ 
													?>
													<input type="hidden" id="rzvy_user_firstname" name="rzvy_user_firstname" value="<?php echo $userfirstname; ?>" />
													<?php 
												} 
												
												if($rzvy_en_ff_lastname_status == "Y"){ 
													?>
													<div class="col-md-6">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_user_lastname" name="rzvy_user_lastname" placeholder="<?php if(isset($rzvy_translangArr['last_name'])){ echo $rzvy_translangArr['last_name']; }else{ echo $rzvy_defaultlang['last_name']; } ?>" value="<?php echo $userlastname; ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php  
												}else{ 
													?>
													<input type="hidden" id="rzvy_user_lastname" name="rzvy_user_lastname" value="<?php echo $userlastname; ?>" />
													<?php 
												} 
												
												if($rzvy_en_ff_phone_status == "Y"){ 
													?>
													<div class="col-md-6">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_user_phone" name="rzvy_user_phone" placeholder="<?php if(isset($rzvy_translangArr['phone_number'])){ echo $rzvy_translangArr['phone_number']; }else{ echo $rzvy_defaultlang['phone_number']; } ?>" value="<?php echo $userphone; ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php  
												}else{ 
													?>
													<input type="hidden" id="rzvy_user_phone" name="rzvy_user_phone" value="<?php echo $userphone; ?>" />
													<?php 
												} 
												
												$show_zip_input = "";
												if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
													$show_zip_input= "rzvy_hide";
												}
												?>
												<div class="col-md-6 <?php echo $show_zip_input; ?>">
													<div class="rzvy-input-class-div">
														<input type="text" id="rzvy_user_zip" name="rzvy_user_zip" placeholder="<?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?>" disabled value="<?php echo $userzip; ?>" class="rzvy-input-class">
													</div>
												</div>
												
												<?php  
												if($rzvy_en_ff_address_status == "Y"){ 
													?>
													<div class="col-md-12">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_user_address" name="rzvy_user_address" placeholder="<?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?>" value="<?php echo $useraddress; ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php  
												}else{ 
													?>
													<input type="hidden" id="rzvy_user_address" name="rzvy_user_address" value="<?php echo $useraddress; ?>" />
													<?php 
												} 
												
												if($rzvy_en_ff_city_status == "Y"){ 
													?>
													<div class="col-md-4">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_user_city" name="rzvy_user_city" placeholder="<?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?>" value="<?php echo $usercity; ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php  
												}else{ 
													?>
													<input type="hidden" id="rzvy_user_city" name="rzvy_user_city" value="<?php echo $usercity; ?>" />
													<?php 
												} 
												
												if($rzvy_en_ff_state_status == "Y"){ 
													?>
													<div class="col-md-4">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_user_state" name="rzvy_user_state" placeholder="<?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?>" value="<?php echo $userstate; ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php  
												}else{ 
													?>
													<input type="hidden" id="rzvy_user_state" name="rzvy_user_state" value="<?php echo $userstate; ?>" />
													<?php 
												} 
												
												if($rzvy_en_ff_country_status == "Y"){ 
													?>
													<div class="col-md-4">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_user_country" name="rzvy_user_country" placeholder="<?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?>" value="<?php echo $usercountry; ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php  
												}else{ 
													?>
													<input type="hidden" id="rzvy_user_country" name="rzvy_user_country" value="<?php echo $usercountry; ?>" />
													<?php 
												} 
												?>
											</div>
										</div>
									</form>
								<?php } ?>
								
								<?php if($rzvy_show_guest_user_checkout == "Y"){ ?>
									<form method="post" name="rzvy_guestuser_detail_form" id="rzvy_guestuser_detail_form">
										<div class="rzvy-radio-group-block mt24" <?php if($rzvy_show_existing_new_user_checkout == "N"){ echo "style='display:block;'"; } ?> id="rzvy-guest-user-box">
											<div class="row">
												<?php 
												if($rzvy_g_ff_firstname_status == "Y"){ 
													?>
													<div class="col-md-6">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_guest_firstname" name="rzvy_guest_firstname" placeholder="<?php if(isset($rzvy_translangArr['first_name'])){ echo $rzvy_translangArr['first_name']; }else{ echo $rzvy_defaultlang['first_name']; } ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php 
												}else{ 
													?>
													<input type="hidden" id="rzvy_guest_firstname" name="rzvy_guest_firstname" />
													<?php 
												} 
												
												if($rzvy_g_ff_lastname_status == "Y"){ 
													?>
													<div class="col-md-6">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_guest_lastname" name="rzvy_guest_lastname" placeholder="<?php if(isset($rzvy_translangArr['last_name'])){ echo $rzvy_translangArr['last_name']; }else{ echo $rzvy_defaultlang['last_name']; } ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php 
												}else{ 
													?>
													<input type="hidden" id="rzvy_guest_lastname" name="rzvy_guest_lastname" />
													<?php 
												} 
												?>
												<div class="col-md-6">
													<div class="rzvy-input-class-div">
														<input type="text" id="rzvy_guest_email" name="rzvy_guest_email" placeholder="<?php if(isset($rzvy_translangArr['email_address'])){ echo $rzvy_translangArr['email_address']; }else{ echo $rzvy_defaultlang['email_address']; } ?>" class="rzvy-input-class">
													</div>
												</div>
												<?php 
												if($rzvy_g_ff_phone_status == "Y"){ 
													?>
													<div class="col-md-6">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_guest_phone" name="rzvy_guest_phone" placeholder="<?php if(isset($rzvy_translangArr['phone_number'])){ echo $rzvy_translangArr['phone_number']; }else{ echo $rzvy_defaultlang['phone_number']; } ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php 
												}else{ 
													?>
													<input type="hidden" id="rzvy_guest_phone" name="rzvy_guest_phone" />
													<?php 
												}
												
												$show_gzip_input = "";
												if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
													$show_gzip_input= "rzvy_hide";
												}
												
												if($rzvy_g_ff_address_status == "Y"){ 
													?>
													<div class="col-md-12">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_guest_address" name="rzvy_guest_address" placeholder="<?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php 
												}else{ 
													?>
													<input type="hidden" id="rzvy_guest_address" name="rzvy_guest_address" />
													<?php 
												} 
												?>
												<div class="col-md-6 <?php echo $show_gzip_input; ?>">
													<div class="rzvy-input-class-div">
														<input type="text" id="rzvy_guest_zip" name="rzvy_guest_zip" placeholder="<?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?>" disabled value="<?php echo $userzip; ?>" class="rzvy-input-class">
													</div>
												</div>
												<?php 
												if($rzvy_g_ff_city_status == "Y"){ 
													?>
													<div class="col-md-6">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_guest_city" name="rzvy_guest_city" placeholder="<?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php 
												}else{ 
													?>
													<input type="hidden" id="rzvy_guest_city" name="rzvy_guest_city" />
													<?php 
												} 
												if($rzvy_g_ff_state_status == "Y"){ 
													?>
													<div class="col-md-6">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_guest_state" name="rzvy_guest_state" placeholder="<?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php 
												}else{ 
													?>
													<input type="hidden" id="rzvy_guest_state" name="rzvy_guest_state" />
													<?php 
												} 
												if($rzvy_g_ff_country_status == "Y"){ 
													?>
													<div class="col-md-6">
														<div class="rzvy-input-class-div">
															<input type="text" id="rzvy_guest_country" name="rzvy_guest_country" placeholder="<?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?>" class="rzvy-input-class">
														</div>
													</div>
													<?php 
												}else{ 
													?>
													<input type="hidden" id="rzvy_guest_country" name="rzvy_guest_country" />
													<?php 
												} 
												?>
											</div>
										</div>
									</form>
								<?php } ?>
								<?php if($rzvy_show_existing_new_user_checkout == "Y" || $rzvy_show_guest_user_checkout == "Y"){ ?>
									<form id="rzvy_forgot_password_form" name="rzvy_forgot_password_form">
										<div class="rzvy-radio-group-block mt24" id="rzvy-user-forget-password-box">
											<div class="row">
												<div class="col-md-12">
													<div class="rzvy-input-class-div">
														<input type="email" id="rzvy_forgot_password_email" name="rzvy_forgot_password_email" placeholder="<?php if(isset($rzvy_translangArr['your_registered_email_address'])){ echo $rzvy_translangArr['your_registered_email_address']; }else{ echo $rzvy_defaultlang['your_registered_email_address']; } ?>" class="rzvy-input-class">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<button class="btn btn-block rzvy-block-btn" id="rzvy_forgot_password_btn" type="submit"><i class="fa fa-envelope"></i> <?php if(isset($rzvy_translangArr['send_mail'])){ echo $rzvy_translangArr['send_mail']; }else{ echo $rzvy_defaultlang['send_mail']; } ?></button>
												</div>
											</div>
										</div>
									</form>
								<?php } ?>
								<div class="row">
									<div class="col-md-12">
										<div class="rzvy-radio-group-block-content mt-2 py-3">
											<?php 
											if($obj_settings->get_option("rzvy_pay_at_venue_status") == "Y" || $obj_settings->get_option("rzvy_paypal_payment_status") == "Y" || $obj_settings->get_option("rzvy_stripe_payment_status") == "Y" || $obj_settings->get_option("rzvy_authorizenet_payment_status") == "Y" || $obj_settings->get_option("rzvy_twocheckout_payment_status") == "Y"){ 
												?>
												<h4><?php if(isset($rzvy_translangArr['payment_method'])){ echo $rzvy_translangArr['payment_method']; }else{ echo $rzvy_defaultlang['payment_method']; } ?> </h4>
												<div class="rzvy-payment-icon">
													<i class="fa fa-lock" aria-hidden="true"></i>
													<p>256 bit Secure<br> SSL Encryption</p>
												</div>
												<?php
											}
											?>
											<div class="row mt-2">
												<div class="rzvy-payments">
													<?php 
													if($obj_settings->get_option("rzvy_pay_at_venue_status") == "Y"){ 
														?>
														<input type="radio" class="rzvy-payment-method-check" id="rzvy-pay-at-venue" name="rzvy-payment-method-radio" value="pay-at-venue" checked />
														<label for="rzvy-pay-at-venue"><?php if(isset($rzvy_translangArr['pay_at_venue'])){ echo $rzvy_translangArr['pay_at_venue']; }else{ echo $rzvy_defaultlang['pay_at_venue']; } ?></label>
														<?php 
													} 
													if($obj_settings->get_option("rzvy_paypal_payment_status") == "Y"){ 
														?>
														<input type="radio" class="rzvy-payment-method-check" id="rzvy-paypal-payment" name="rzvy-payment-method-radio" value="paypal" />
														<label for="rzvy-paypal-payment"><?php if(isset($rzvy_translangArr['paypal'])){ echo $rzvy_translangArr['paypal']; }else{ echo $rzvy_defaultlang['paypal']; } ?></label>
														<?php 
													} 
													if($obj_settings->get_option("rzvy_stripe_payment_status") == "Y" && $obj_settings->get_option("rzvy_authorizenet_payment_status") == "N" && $obj_settings->get_option("rzvy_twocheckout_payment_status") == "N"){ 
														$payment_method = "stripe";
													} else if($obj_settings->get_option("rzvy_stripe_payment_status") == "N" && $obj_settings->get_option("rzvy_authorizenet_payment_status") == "Y" && $obj_settings->get_option("rzvy_twocheckout_payment_status") == "N"){ 
														$payment_method = "authorize.net";
													}  else if($obj_settings->get_option("rzvy_stripe_payment_status") == "N" && $obj_settings->get_option("rzvy_authorizenet_payment_status") == "N" && $obj_settings->get_option("rzvy_twocheckout_payment_status") == "Y"){ 
														$payment_method = "2checkout";
													} else{
														$payment_method = "N";
													}
													if($payment_method != "N"){ 
														?>
														<input type="radio" class="rzvy-payment-method-check" id="rzvy-card-payment" name="rzvy-payment-method-radio" value="<?php echo $payment_method; ?>" />
														<label for="rzvy-card-payment"><?php if(isset($rzvy_translangArr['card_payment'])){ echo $rzvy_translangArr['card_payment']; }else{ echo $rzvy_defaultlang['card_payment']; } ?></label>
														<?php 
													} 
													?>
												</div>
												<div class="col-md-12">
													<div class="pull-left fa-border rzvy_applied_coupon_div">
														<span class="rzvy_applied_coupon_badge"><i class="fa fa-ticket"></i> </span>
													</div>
													<a href="javascript:void(0)" class="pull-left rzvy_remove_applied_coupon" data-id=""><i class="fa fa-times-circle-o fa-lg"></i></a>
													<a href="javascript:void(0)" class="pull-right" id="rzvy-available-coupons-open-modal"><?php if(isset($rzvy_translangArr['check_available_promo'])){ echo $rzvy_translangArr['check_available_promo']; }else{ echo $rzvy_defaultlang['check_available_promo']; } ?></a>
												</div>
												<?php if($obj_settings->get_option("rzvy_referral_discount_status") == "Y"){ ?>
												<div class="col-md-12 text-left mt-3 rzvy_apply_referral_coupon_div">
													<a href="javascript:void(0)" id="rzvy_apply_referral_coupon"><span><?php if(isset($rzvy_translangArr['do_you_have_referral_discount_coupon'])){ echo $rzvy_translangArr['do_you_have_referral_discount_coupon']; }else{ echo $rzvy_defaultlang['do_you_have_referral_discount_coupon']; } ?></span></a>
												</div>
												<div class="col-md-12 text-left mt-3 rzvy_applied_referral_coupon_div_text">
													<span><?php if(isset($rzvy_translangArr['applied_referral_discount_coupon'])){ echo $rzvy_translangArr['applied_referral_discount_coupon']; }else{ echo $rzvy_defaultlang['applied_referral_discount_coupon']; } ?>: <b class="rzvy_applied_referral_coupon_code"></b></span>
												</div>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<div class="rzvy-radio-group-block">
									<div class="rzvy-card-detail-box">
										<p><?php if(isset($rzvy_translangArr['credit_card_details'])){ echo $rzvy_translangArr['credit_card_details']; }else{ echo $rzvy_defaultlang['credit_card_details']; } ?></p>
										<?php 
										if($obj_settings->get_option("rzvy_stripe_payment_status") == "Y" && $obj_settings->get_option("rzvy_authorizenet_payment_status") == "N" && $obj_settings->get_option("rzvy_twocheckout_payment_status") == "N"){ 
											?>
											<div class="mb-4">
												<div id="rzvy_stripe_plan_card_element">
													<!-- A Stripe Element will be inserted here. -->
												</div>
												<!-- Used to display form errors. -->
												<div id="rzvy_stripe_plan_card_errors" role="alert"></div>
											</div>
											<?php 
										}else{ 
											?>
											<div class="row">
												<div class="col-md-9">
													<div class="rzvy-input-class-div">
														<input maxlength="20" size="20" type="tel" placeholder="<?php if(isset($rzvy_translangArr['card_number'])){ echo $rzvy_translangArr['card_number']; }else{ echo $rzvy_defaultlang['card_number']; } ?>" class="rzvy-input-class rzvy-card-num" name="rzvy-cardnumber" id="rzvy-cardnumber" value="" />
													</div>
												</div>
												<div class="col-md-3">
													<div class="rzvy-input-class-div">
														<input type="password" maxlength="4" size="4" placeholder="<?php if(isset($rzvy_translangArr['cvv'])){ echo $rzvy_translangArr['cvv']; }else{ echo $rzvy_defaultlang['cvv']; } ?>" class="rzvy-input-class"  name="rzvy-cardcvv" id="rzvy-cardcvv" value="" />
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-3">
													<div class="rzvy-input-class-div">
														<input maxlength="2" type="tel" placeholder="<?php if(isset($rzvy_translangArr['mm'])){ echo $rzvy_translangArr['mm']; }else{ echo $rzvy_defaultlang['mm']; } ?>" class="rzvy-input-class" name="rzvy-cardexmonth" id="rzvy-cardexmonth" value="" />
													</div>
												</div>
												<div class="col-md-3">
													<div class="rzvy-input-class-div">
														<input maxlength="4" type="tel" placeholder="<?php if(isset($rzvy_translangArr['yyyy'])){ echo $rzvy_translangArr['yyyy']; }else{ echo $rzvy_defaultlang['yyyy']; } ?>" class="rzvy-input-class" name="rzvy-cardexyear" id="rzvy-cardexyear" value="" />
													</div>
												</div>
												<div class="col-md-6">
													<div class="rzvy-input-class-div">
														<input type="text" placeholder="<?php if(isset($rzvy_translangArr['name_as_on_card'])){ echo $rzvy_translangArr['name_as_on_card']; }else{ echo $rzvy_defaultlang['name_as_on_card']; } ?>" class="rzvy-input-class" name="rzvy-cardholdername" id="rzvy-cardholdername" value="" />
													</div>
												</div>
											</div>
											<?php 
										} 
										?>
									</div>
									<?php if($obj_settings->get_option("rzvy_referral_discount_status") == "Y"){ ?>
									<div class="rzvy-radio-group-block mt-4 mb-4 rzvy_referral_code_applied_div">
										<div class="row">
											<div class="col-md-12">
												<span><?php if(isset($rzvy_translangArr['applied_referral_code'])){ echo $rzvy_translangArr['applied_referral_code']; }else{ echo $rzvy_defaultlang['applied_referral_code']; } ?>: <b class="rzvy_referral_code_applied_text"></b></span>
											</div>
										</div>
									</div>
									<div class="rzvy-radio-group-block mt-4 mb-4 rzvy_referral_code_div">
										<div class="row">
											<div class="col-md-12">
												<span><?php if(isset($rzvy_translangArr['do_you_have_referral_code'])){ echo $rzvy_translangArr['do_you_have_referral_code']; }else{ echo $rzvy_defaultlang['do_you_have_referral_code']; } ?></span>
											</div>
										</div>
										<div class="row mt-2 ml-1">
											<div class="col-md-5 pl-0 pr-0">
												<input type="text" id="rzvy_referral_code" name="rzvy_referral_code" placeholder="<?php if(isset($rzvy_translangArr['enter_your_referral_code'])){ echo $rzvy_translangArr['enter_your_referral_code']; }else{ echo $rzvy_defaultlang['enter_your_referral_code']; } ?>" minlength="15" maxlength="15" class="form-control rounded-0 text-uppercase">
											</div>
											<div class="col-md-2 pl-0 pr-0">
												<button class="btn btn-block rzvy-block-btn rounded-0" id="rzvy_apply_referral_code_btn" type="submit"><?php if(isset($rzvy_translangArr['apply'])){ echo $rzvy_translangArr['apply']; }else{ echo $rzvy_defaultlang['apply']; } ?></button>
											</div>
										</div>
									</div>
									<?php } ?>
									<div class="row mt-3">
										<div class="col-md-12">
											<div class="rzvy-terms-and-condition">
												<label class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input rzvy-tc-control-input">
													<span class="custom-control-indicator rzvy-tc-control-indicator"></span>
													<span class="custom-control-description rzvy-tc-control-description"><?php if(isset($rzvy_translangArr['i_read_and_agree_to_the'])){ echo $rzvy_translangArr['i_read_and_agree_to_the']; }else{ echo $rzvy_defaultlang['i_read_and_agree_to_the']; } ?> <a target="_blank" href="<?php $rzvy_terms_and_condition_link = $obj_settings->get_option("rzvy_terms_and_condition_link"); if($rzvy_terms_and_condition_link != ""){ echo $rzvy_terms_and_condition_link; }else{ echo "javascript:void(0)"; } ?>"><?php if(isset($rzvy_translangArr['terms_conditions'])){ echo $rzvy_translangArr['terms_conditions']; }else{ echo $rzvy_defaultlang['terms_conditions']; } ?></a></span>
												</label>
											</div>
										</div>
									</div>
									<div class="row mt-4">
										<div class="col-md-12">
											<button id="rzvy_book_appointment_btn" class="btn btn-block rzvy-big-block-btn" type="submit"><span class="fa fa-calendar-check-o"></span><?php if(isset($rzvy_translangArr['book_now'])){ echo $rzvy_translangArr['book_now']; }else{ echo $rzvy_defaultlang['book_now']; } ?></button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 rzvy-set-sm-fit mb-5">
							<div class="rzvy_sticky_bottom_booking_summary">
								<div class="rzvy-sidebar-block-title">
									<h4><?php if(isset($rzvy_translangArr['booking_summary'])){ echo $rzvy_translangArr['booking_summary']; }else{ echo $rzvy_defaultlang['booking_summary']; } ?></h4>
								</div>
								<div id="rzvy_refresh_cart" class="rzvy-sidebar-block-content">
									<label><?php if(isset($rzvy_translangArr['no_items_in_cart'])){ echo $rzvy_translangArr['no_items_in_cart']; }else{ echo $rzvy_defaultlang['no_items_in_cart']; } ?></label>
								</div>
							</div>
							<?php 
							if($obj_settings->get_option("rzvy_show_frontend_rightside_feedback_form") == "Y"){ 
								?>
								<div class="mt-3">
									<div class="rzvy-sidebar-block-title">
										<h4><?php if(isset($rzvy_translangArr['give_us_feedback'])){ echo $rzvy_translangArr['give_us_feedback']; }else{ echo $rzvy_defaultlang['give_us_feedback']; } ?></h4>
									</div>
									<form method="post" name="rzvy_feedback_form" id="rzvy_feedback_form">
										<input type="hidden" id="rzvy_fb_rating" name="rzvy_fb_rating" value="0" />
										<div class="rzvy-sidebar-block-content">
											<div class="row">
												<div class="col-md-12">
													<div class="rzvy-input-class-div">
														<center>
															<span class="fa fa-star-o rzvy-sidebar-feedback-star" id="rzvy-sidebar-feedback-star1" onclick="rzvy_add_star_rating(this,1)"></span>
															<span class="fa fa-star-o rzvy-sidebar-feedback-star" id="rzvy-sidebar-feedback-star2" onclick="rzvy_add_star_rating(this,2)"></span>
															<span class="fa fa-star-o rzvy-sidebar-feedback-star" id="rzvy-sidebar-feedback-star3" onclick="rzvy_add_star_rating(this,3)"></span>
															<span class="fa fa-star-o rzvy-sidebar-feedback-star" id="rzvy-sidebar-feedback-star4" onclick="rzvy_add_star_rating(this,4)"></span>
															<span class="fa fa-star-o rzvy-sidebar-feedback-star" id="rzvy-sidebar-feedback-star5" onclick="rzvy_add_star_rating(this,5)"></span>
														</center>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="rzvy-input-class-div">
														<input type="text" placeholder="<?php if(isset($rzvy_translangArr['your_name'])){ echo $rzvy_translangArr['your_name']; }else{ echo $rzvy_defaultlang['your_name']; } ?>" id="rzvy_fb_name" name="rzvy_fb_name" class="rzvy-input-class">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="rzvy-input-class-div">
														<input type="email" placeholder="<?php if(isset($rzvy_translangArr['email_address'])){ echo $rzvy_translangArr['email_address']; }else{ echo $rzvy_defaultlang['email_address']; } ?>" id="rzvy_fb_email" name="rzvy_fb_email" class="rzvy-input-class">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="rzvy-input-class-div">
														<textarea placeholder="<?php if(isset($rzvy_translangArr['your_review'])){ echo $rzvy_translangArr['your_review']; }else{ echo $rzvy_defaultlang['your_review']; } ?>" id="rzvy_fb_review" name="rzvy_fb_review" class="rzvy-input-class"></textarea>
													</div>
												</div>
											</div>
											<h4><button class="btn btn-block rzvy-big-block-btn" id="rzvy_submit_feedback_btn" type="submit"><i class="fa fa-thumbs-up"></i> <?php if(isset($rzvy_translangArr['submit_review'])){ echo $rzvy_translangArr['submit_review']; }else{ echo $rzvy_defaultlang['submit_review']; } ?></button></h4>
										</div>
									</form>
								</div>
								<?php 
							}
							
							if($obj_settings->get_option("rzvy_show_frontend_rightside_feedback_list") == "Y"){
								$all_feedbacks = $obj_frontend->get_all_feedbacks();
								$total_feedbacks = mysqli_num_rows($all_feedbacks);
								if($total_feedbacks>0){ 
									?>
									<div class="mt-3">
										<div class="rzvy-sidebar-block-title">
											<h4><?php if(isset($rzvy_translangArr['our_happy_customers'])){ echo $rzvy_translangArr['our_happy_customers']; }else{ echo $rzvy_defaultlang['our_happy_customers']; } ?></h4>
										</div>
										<div class="rzvy-sidebar-block-content">
											<?php 
											$fb_i=1;
											while($feedback = mysqli_fetch_array($all_feedbacks)){ 
												if($fb_i == 1){
													echo '<div class="rzvy_list_of_feedbacks">';
												}
												?>
												<div class="row card">
													<div class="card-body">
														<h3 class="card-title"><?php echo ucwords($feedback['name']); ?></h3>
														<p class="card-text">
															<?php 
															if($feedback['rating']>0){
																for($star_i=0;$star_i<$feedback['rating'];$star_i++){ 
																	?>
																	<i class="fa fa-star" aria-hidden="true"></i>
																	<?php 
																} 
																for($star_j=0;$star_j<(5-$feedback['rating']);$star_j++){ 
																	?>
																	<i class="fa fa-star-o" aria-hidden="true"></i>
																	<?php 
																} 
															}else{ 
																?>
																<i class="fa fa-star-o" aria-hidden="true"></i>
																<i class="fa fa-star-o" aria-hidden="true"></i>
																<i class="fa fa-star-o" aria-hidden="true"></i>
																<i class="fa fa-star-o" aria-hidden="true"></i>
																<i class="fa fa-star-o" aria-hidden="true"></i>
																<?php 
															} 
															?>
														</p>
														<p class="card-text"><?php echo ucfirst($feedback['review']); ?></p>
													</div>
												</div>
												<?php 
												if($fb_i == 3){
													echo '</div>';
													$fb_i = 0;
												}
												if($fb_i == $total_feedbacks){
													echo '</div>';
												}
												$fb_i++;
											} 
											?>
										</div>
									</div>
									<?php 
								}  
							}  
							?>
						</div>
					</div>
				</div>
			</section>
			<!-- Available Coupon Offers START -->
			<div class="modal" id="rzvy-available-coupons-modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title"><?php if(isset($rzvy_translangArr['select_a_promo_offer'])){ echo $rzvy_translangArr['select_a_promo_offer']; }else{ echo $rzvy_defaultlang['select_a_promo_offer']; } ?></h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>
						<!-- Modal body -->
						<div class="modal-body rzvy_avail_promo_modal_body">
							
						</div>
						<!-- Modal footer -->
						<div class="modal-footer">
							
						</div>
					</div>
				</div>
			</div>
			<!-- Available Coupon Offers END -->		
			
			<!-- Location Selector Modal START -->
			<div class="modal" id="rzvy-location-selector-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content rzvy-location-selector-bg">
						<!-- Modal body -->
						<div class="modal-body">
							<div class="row">
								<div class="col-md-12">
									<div class="border-0 rzvy-location-selector-content-box">
										<div class="col-md-12">
											<div class="border-0 pb-5 pt-3 text-center">
												<h3 class="text-white"><?php if(isset($rzvy_translangArr['check_for_services_available_at_your_location'])){ echo $rzvy_translangArr['check_for_services_available_at_your_location']; }else{ echo $rzvy_defaultlang['check_for_services_available_at_your_location']; } ?></h3>
											</div>
										</div>
										<div id="rzvy_location_selector_form">
											<div class="pb-3">
												<div class="row">
													<div class="col-md-12">
														<center>
															<!-- Search form -->
															<div class="card card-sm">
																<div class="card-body row no-gutters align-items-center">
																	<!--end of col-->
																	<div class="col">
																		<?php if(sizeof($exploded_rzvy_location_selector)>0 &&  sizeof($exploded_rzvy_location_selector)<=10){ ?>
																			<select class="form-control selectpicker" id="rzvy_ls_input_keyword">
																			<option value="" selected disabled><?php if(isset($rzvy_translangArr['enter_zip'])){ echo $rzvy_translangArr['enter_zip']; }else{ echo $rzvy_defaultlang['enter_zip']; } ?></option>
																			<?php foreach($exploded_rzvy_location_selector as $exploded_rzvy_location_selectors){ ?> 
																			<option value="<?php echo $exploded_rzvy_location_selectors; ?>"><?php echo $exploded_rzvy_location_selectors; ?></option>
																			<?php } ?>
																			</select>
																		<?php }else{ ?>
																			<input id="rzvy_ls_input_keyword" class="form-control form-control-lg rzvy-form-control-borderless" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_zip'])){ echo $rzvy_translangArr['enter_zip']; }else{ echo $rzvy_defaultlang['enter_zip']; } ?>" autocomplete="off" />
																		<?php } ?>	
																	</div>
																	<!--end of col-->
																	<div class="col-auto">
																		<button id="rzvy_location_check_btn" class="btn rzvy-block-btn pl-3 pr-3" type="submit"><i class="fa fa-map-marker"></i></button>
																	</div>
																	<!--end of col-->
																</div>
															</div>
														</center>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal footer
						<div class="modal-footer">
							
						</div> -->
					</div>
				</div>
			</div>
			<!-- Location Selector Modal END -->
		</div>
		<?php if($obj_settings->get_option('rzvy_stripe_payment_status') == 'Y'){ ?>
		<script src="https://js.stripe.com/v3/"></script>
		<?php } ?>
		<script src="<?php echo SITE_URL; ?>includes/front/js/rzvy-front-jquery.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/js/rzvy-set-languages.js?<?php echo time(); ?>"></script>
	</body>
</html>