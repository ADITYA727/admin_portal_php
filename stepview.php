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
			<script type="text/javascript" async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $rzvy_seo_ga_code; ?>"></script>
			<script type="text/javascript">
				window.dataLayer = window.dataLayer || [];
				function gtag(){dataLayer.push(arguments);}
				gtag('js', new Date());
				gtag('config', '<?php echo $rzvy_seo_ga_code; ?>');
			</script>
			<?php  
		} 
		?>
		<!-- Bootstrap core JavaScript and Page level plugin JavaScript-->
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/bootstrap.min.css?<?php echo time(); ?>" />
		<link href="<?php echo SITE_URL; ?>includes/vendor/bootstrap/css/bootstrap-select.min.css?<?php echo time(); ?>" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/font-awesome.min.css?<?php echo time(); ?>" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/pe-icon-7-stroke.css?<?php echo time(); ?>" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/front/css/datepicker.min.css?<?php echo time(); ?>" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/css/intlTelInput.css?<?php echo time(); ?>">
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/stepview/inline-calendar.css" />
		<link rel="stylesheet" href="<?php echo SITE_URL; ?>includes/stepview/rzvy-stepview.css" />
		
		<!-- Bootstrap core JavaScript and Page level plugin JavaScript-->
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/front/js/jquery-3.2.1.min.js?<?php echo time(); ?>"></script>
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/front/js/popper.min.js?<?php echo time(); ?>"></script>
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/front/js/bootstrap.min.js?<?php echo time(); ?>"></script>
		<script src="<?php echo SITE_URL; ?>includes/vendor/bootstrap/js/bootstrap-select.min.js?<?php echo time(); ?>"></script>
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/front/js/slick.min.js?<?php echo time(); ?>"></script>
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/front/js/datepicker.min.js?<?php echo time(); ?>"></script>
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.js?<?php echo time(); ?>"></script>
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/vendor/jquery/jquery.validate.min.js?<?php echo time(); ?>"></script>
		<?php 
		include(dirname(__FILE__)."/includes/lib/rzvy_lang_objects.php");
		if($obj_settings->get_option("rzvy_authorizenet_payment_status") == "Y" || $obj_settings->get_option("rzvy_twocheckout_payment_status") == "Y"){ ?>
			<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/vendor/jquery/jquery.payment.min.js?<?php echo time(); ?>"></script>
		<?php } ?>
		<?php if($obj_settings->get_option('rzvy_twocheckout_payment_status') == 'Y'){ ?>
			<script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>	
		<?php } ?>
		
		<!-- Custom scripts -->
		<script type="text/javascript">
			var generalObj = { 'site_url' : '<?php echo SITE_URL; ?>', 'ajax_url' : '<?php echo AJAX_URL; ?>', 'ty_link' : '<?php echo $obj_settings->get_option('rzvy_thankyou_page_url').$saiframe; ?>', 'twocheckout_status' : '<?php echo $obj_settings->get_option('rzvy_twocheckout_payment_status'); ?>', 'authorizenet_status' : '<?php echo $obj_settings->get_option('rzvy_authorizenet_payment_status'); ?>', 'twocheckout_sid' : '<?php echo $obj_settings->get_option('rzvy_twocheckout_seller_id'); ?>', 'twocheckout_pkey' : '<?php echo $obj_settings->get_option('rzvy_twocheckout_publishable_key'); ?>', 'stripe_status' : '<?php echo $obj_settings->get_option('rzvy_stripe_payment_status'); ?>', 'stripe_pkey' : '<?php echo $obj_settings->get_option('rzvy_stripe_publishable_key'); ?>', 'location_selector' : '<?php echo $show_location_selector; ?>', 'minimum_booking_amount':'<?php echo $obj_settings->get_option('rzvy_minimum_booking_amount');?>', 'endslot_status' : '<?php echo $obj_settings->get_option('rzvy_endtimeslot_selection_status'); ?>', 'single_category_status' : '<?php echo $obj_settings->get_option('rzvy_single_category_autotrigger_status'); ?>', 'defaultCountryCode' : '<?php $rzvy_default_country_code = $obj_settings->get_option("rzvy_default_country_code"); if($rzvy_default_country_code != ""){ echo $rzvy_default_country_code; }else{ echo "us"; } ?>', 'single_service_status' : '<?php echo $obj_settings->get_option('rzvy_single_service_autotrigger_status'); ?>' };
			
			var formfieldsObj = { 'en_ff_phone_status' : '<?php echo $rzvy_en_ff_phone_status; ?>', 'g_ff_phone_status' : '<?php echo $rzvy_g_ff_phone_status; ?>', 'en_ff_firstname' : '<?php echo $rzvy_en_ff_firstname_optional; ?>', 'en_ff_lastname' : '<?php echo $rzvy_en_ff_lastname_optional; ?>', 'en_ff_phone' : '<?php echo $rzvy_en_ff_phone_optional; ?>', 'en_ff_address' : '<?php echo $rzvy_en_ff_address_optional; ?>', 'en_ff_city' : '<?php echo $rzvy_en_ff_city_optional; ?>', 'en_ff_state' : '<?php echo $rzvy_en_ff_state_optional; ?>', 'en_ff_country' : '<?php echo $rzvy_en_ff_country_optional; ?>', 'g_ff_firstname' : '<?php echo $rzvy_g_ff_firstname_optional; ?>', 'g_ff_lastname' : '<?php echo $rzvy_g_ff_lastname_optional; ?>', 'g_ff_phone' : '<?php echo $rzvy_g_ff_phone_optional; ?>', 'g_ff_address' : '<?php echo $rzvy_g_ff_address_optional; ?>', 'g_ff_city' : '<?php echo $rzvy_g_ff_city_optional; ?>', 'g_ff_state' : '<?php echo $rzvy_g_ff_state_optional; ?>', 'g_ff_country' : '<?php echo $rzvy_g_ff_country_optional; ?>' }; 
		</script>
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/js/intlTelInput.js?<?php echo time(); ?>"></script>
		<?php include("backend/bf_css_stepview.php"); ?>
	</head>
	<body class="rzvy" onscroll="parent.postMessage(document.body.scrollHeight, '*');" onload="parent.postMessage(document.body.scrollHeight, '*');">
		<?php include(dirname(__FILE__)."/header2.php"); ?>	
		<div class="container my-3">
			<!-- Brand and toggle get grouped for better mobile display -->
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
			<?php if($obj_settings->get_option('rzvy_welcome_message_status')=='Y'){ ?>
				<div class="row rzvy_welcome_content">
					<div class="col-md-12 rzvy-set-sm-fit mb-9"><?php echo base64_decode($obj_settings->get_option('rzvy_welcome_message_container'));?> </div>
				</div>
			<?php } ?>
			<div id="rzvy_main_wizard">
				<div class="rzvy-wizard">
					<div class="rzvy-wizard-inner">
						<div class="rzvy-connecting-line"></div>
						<ul class="nav nav-tabs">
							<li class="nav-item">
								<a href="#rzvy-first-step" data-toggle="tab" aria-controls="rzvy-first-step" role="tab" title="<?php if(isset($rzvy_translangArr['what_type_of_service'])){ echo $rzvy_translangArr['what_type_of_service']; }else{ echo $rzvy_defaultlang['what_type_of_service']; } ?>" class="nav-link active rzvy-first-step-tab">
									<span class="rzvy-round-tab">
										<i class="fa fa-cogs" aria-hidden="true"></i>
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#rzvy-second-step" data-toggle="tab" aria-controls="rzvy-second-step" role="tab" title="<?php if(isset($rzvy_translangArr['how_often_would_you_like_service'])){ echo $rzvy_translangArr['how_often_would_you_like_service']; }else{ echo $rzvy_defaultlang['how_often_would_you_like_service']; } ?>" class="nav-link disabled rzvy-second-step-tab">
									<span class="rzvy-round-tab">
										<i class="fa fa-calendar" aria-hidden="true"></i>
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#rzvy-third-step" data-toggle="tab" aria-controls="rzvy-third-step" role="tab" title="<?php if(isset($rzvy_translangArr['booking_summary'])){ echo $rzvy_translangArr['booking_summary']; }else{ echo $rzvy_defaultlang['booking_summary']; } ?>" class="nav-link disabled rzvy-third-step-tab">
									<span class="rzvy-round-tab">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#rzvy-fourth-step" data-toggle="tab" aria-controls="rzvy-fourth-step" role="tab" title="<?php if(isset($rzvy_translangArr['personal_information'])){ echo $rzvy_translangArr['personal_information']; }else{ echo $rzvy_defaultlang['personal_information']; } ?>" class="nav-link disabled rzvy-fourth-step-tab">
									<span class="rzvy-round-tab">
										<i class="fa fa-user-circle-o" aria-hidden="true"></i>
									</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#rzvy-fifth-step" data-toggle="tab" aria-controls="rzvy-fifth-step" role="tab" title="<?php if(isset($rzvy_translangArr['booked'])){ echo $rzvy_translangArr['booked']; }else{ echo $rzvy_defaultlang['booked']; } ?>" class="nav-link disabled rzvy-fifth-step-tab">
									<span class="rzvy-round-tab">
										<i class="fa fa-check" aria-hidden="true"></i>
									</span>
								</a>
							</li>
						</ul>
					</div>
					<div class="tab-content">
						<div class="tab-pane container fade show active p-4 rzvy-steps" id="rzvy-first-step">
							<div class="row">
								<div class="col-md-12">
									<div class="rzvy-steps-btn">
										<a href="javascript:void(0)" id="rzvy-get-second-next-box-btn" class="btn btn-common next-step next-button pull-right rzvy_nextstep_btn rounded-0" style="width:158.4px"><?php if(isset($rzvy_translangArr['next'])){ echo $rzvy_translangArr['next']; }else{ echo $rzvy_defaultlang['next']; } ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
							<div class="row py-2 rzvy-category-container">
								<div class="col-md-12">
									<h4><?php if(isset($rzvy_translangArr['what_type_of_service'])){ echo $rzvy_translangArr['what_type_of_service']; }else{ echo $rzvy_defaultlang['what_type_of_service']; } ?></h4>
									<div class="py-1 rzvy-custom-radio-main">
										<?php 
										$i=0;
										$total_cat = mysqli_num_rows($all_categories);
										if($total_cat>0){
											while($category = mysqli_fetch_array($all_categories)){ 
												?>
												<input type="radio" id="rzvy-categories-radio-<?php echo $category['id']; ?>" name="rzvy-categories-radio" class="rzvy-categories-radio-change" value="<?php echo $category['id']; ?>" />
												<label class="col-md-3" for="rzvy-categories-radio-<?php echo $category['id']; ?>"><?php echo ucwords($category['cat_name']); ?></label>
												<?php 
											} 
										}else{ 
											?>
											<label><?php if(isset($rzvy_translangArr['please_configure_first_services_from_admin_area'])){ echo $rzvy_translangArr['please_configure_first_services_from_admin_area']; }else{ echo $rzvy_defaultlang['please_configure_first_services_from_admin_area']; } ?></label>
											<?php 
										} 
										?>
									</div>
								</div>
							</div>
							<div class="row py-2 rzvy-services-container">
								<!-- Services Goes Here -->
							</div>
							<div class="rzvy-addons-container">
								<!-- Service Detail & Addons Goes Here -->
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="rzvy-steps-btn">
										<a href="javascript:void(0)" id="rzvy-get-second-next-box-btn" class="btn btn-common next-step next-button pull-right rzvy_nextstep_btn rzvy_nextstep_btn_bottom rounded-0" style="width:158.4px;display:none"><?php if(isset($rzvy_translangArr['next'])){ echo $rzvy_translangArr['next']; }else{ echo $rzvy_defaultlang['next']; } ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane container fade p-4 rzvy-steps" id="rzvy-second-step">
							<!-- Second box with frequently discount, staff & calendar -->
						</div>
						<div class="tab-pane container fade p-4 rzvy-steps" id="rzvy-third-step">
							<!-- Booking Summary will goes here -->
						</div>
						<div class="tab-pane container fade p-4 rzvy-steps" id="rzvy-fourth-step">
							<!-- Customer Detail will goes here -->
						</div>
						<div class="tab-pane container fade p-4 rzvy-steps" id="rzvy-fifth-step">
							<div class="row mt-4" id="rzvy-thankyou">
								<div class="col-md-12">
									<h4 class="rzvy-h">
									  <span><?php if(isset($rzvy_translangArr['thank_you'])){ echo $rzvy_translangArr['thank_you']; }else{ echo $rzvy_defaultlang['thank_you']; } ?></span>
									</h4>
								</div>
							</div>
							<div class="row mt-5" id="rzvy-thankyou">
								<div class="col-md-12 text-center mt-4">
									<h4 class="py-2"><i class="fa fa-check-square-o text-success" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['your_appointment_has_been_booked'])){ echo $rzvy_translangArr['your_appointment_has_been_booked']; }else{ echo $rzvy_defaultlang['your_appointment_has_been_booked']; } ?></h4>
									<h6 class="py-2"><?php if(isset($rzvy_translangArr['if_you_have_any_questions_about_this_appointment_please_generate_ticket_related_your_issue_from'])){ echo $rzvy_translangArr['if_you_have_any_questions_about_this_appointment_please_generate_ticket_related_your_issue_from']; }else{ echo $rzvy_defaultlang['if_you_have_any_questions_about_this_appointment_please_generate_ticket_related_your_issue_from']; } ?> <a href="<?php echo SITE_URL; ?>backend/c-support-tickets.php<?php echo $saiframe; ?>"><?php if(isset($rzvy_translangArr['support_tickets'])){ echo $rzvy_translangArr['support_tickets']; }else{ echo $rzvy_defaultlang['support_tickets']; } ?></a></h6>
									<h6 class="py-2"><?php if(isset($rzvy_translangArr['to_check_your_booking_or_to_make_a_cancellation_visit'])){ echo $rzvy_translangArr['to_check_your_booking_or_to_make_a_cancellation_visit']; }else{ echo $rzvy_defaultlang['to_check_your_booking_or_to_make_a_cancellation_visit']; } ?> <a href="<?php echo SITE_URL; ?>backend/my-appointments.php<?php echo $saiframe; ?>"><?php if(isset($rzvy_translangArr['my_appointments'])){ echo $rzvy_translangArr['my_appointments']; }else{ echo $rzvy_defaultlang['my_appointments']; } ?></a></h6>
									<h6 class="py-2"><?php if(isset($rzvy_translangArr['to_book_more_appointment'])){ echo $rzvy_translangArr['to_book_more_appointment']; }else{ echo $rzvy_defaultlang['to_book_more_appointment']; } ?> <a href="<?php echo SITE_URL.$saiframe; ?>"><?php if(isset($rzvy_translangArr['continue_booking'])){ echo $rzvy_translangArr['continue_booking']; }else{ echo $rzvy_defaultlang['continue_booking']; } ?></a></h6>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
		
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
		
		<!-- Custom Scripts -->
		<?php if($obj_settings->get_option('rzvy_stripe_payment_status') == 'Y'){ ?>
			<script src="https://js.stripe.com/v3/"></script>
		<?php } ?>
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/js/rzvy-set-languages.js?<?php echo time(); ?>"></script>
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/stepview/rzvy-stepview.js?<?php echo time(); ?>"></script>
	</body>
</html>