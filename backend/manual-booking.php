<?php 
/** Set default sessions **/
$_SESSION['rzvy_mb_cart_items'] = array();
$_SESSION['mb_customer_id'] = "";
$_SESSION['rzvy_mb_cart_category_id'] = "";
$_SESSION['rzvy_mb_cart_service_id'] = "";
$_SESSION['rzvy_mb_cart_service_price'] = 0;
$_SESSION['rzvy_mb_cart_datetime'] = "";
$_SESSION['rzvy_mb_cart_end_datetime'] = "";
$_SESSION['rzvy_mb_cart_freqdiscount_label'] = "";
$_SESSION['rzvy_mb_cart_freqdiscount_key'] = "";
$_SESSION['rzvy_mb_cart_freqdiscount_id'] = "";
$_SESSION['rzvy_mb_cart_subtotal'] = 0;
$_SESSION['rzvy_mb_cart_freqdiscount'] = 0;
$_SESSION['rzvy_mb_cart_coupondiscount'] = 0;
$_SESSION['rzvy_mb_cart_couponid'] = "";
$_SESSION['rzvy_mb_cart_tax'] = 0;
$_SESSION['rzvy_mb_cart_nettotal'] = 0;

if(isset($_SESSION['rzvy_staff_calendar'])){
	if(is_numeric($_SESSION['rzvy_staff_calendar'])){
		$_SESSION['rzvy_mb_staff_id'] = $_SESSION['rzvy_staff_calendar'];
	}else{
		$_SESSION['rzvy_mb_staff_id'] = "";
	}
}else{
	$_SESSION['rzvy_mb_staff_id'] = "";
}

/* Include class files */
include(dirname(dirname(__FILE__))."/classes/class_manual_booking.php");
include(dirname(dirname(__FILE__))."/classes/class_customers.php");

/* Create object of classes */
$obj_frontend = new rzvy_manual_booking();
$obj_frontend->conn = $conn; 
$obj_frontend->staff_id = $_SESSION['rzvy_mb_staff_id'];

$obj_customers = new rzvy_customers();
$obj_customers->conn = $conn;

$rzvy_location_selector_status = $obj_settings->get_option("rzvy_location_selector_status"); 
$all_customers = $obj_customers->get_business_customers();
$all_categories = $obj_frontend->get_all_categories(); 

/** get form fields options **/
$rzvy_en_ff_firstname_status = $obj_settings->get_option('rzvy_en_ff_firstname_status');
$rzvy_en_ff_lastname_status = $obj_settings->get_option('rzvy_en_ff_lastname_status');
$rzvy_en_ff_phone_status = $obj_settings->get_option('rzvy_en_ff_phone_status');
$rzvy_en_ff_address_status = $obj_settings->get_option('rzvy_en_ff_address_status');
$rzvy_en_ff_city_status = $obj_settings->get_option('rzvy_en_ff_city_status');
$rzvy_en_ff_state_status = $obj_settings->get_option('rzvy_en_ff_state_status');
$rzvy_en_ff_country_status = $obj_settings->get_option('rzvy_en_ff_country_status');

$rzvy_g_ff_firstname_status = $obj_settings->get_option('rzvy_g_ff_firstname_status');
$rzvy_g_ff_lastname_status = $obj_settings->get_option('rzvy_g_ff_lastname_status');
$rzvy_g_ff_phone_status = $obj_settings->get_option('rzvy_g_ff_phone_status');
$rzvy_g_ff_address_status = $obj_settings->get_option('rzvy_g_ff_address_status');
$rzvy_g_ff_city_status = $obj_settings->get_option('rzvy_g_ff_city_status');
$rzvy_g_ff_state_status = $obj_settings->get_option('rzvy_g_ff_state_status');
$rzvy_g_ff_country_status = $obj_settings->get_option('rzvy_g_ff_country_status');

/** get form fields required options **/
$rzvy_en_ff_firstname_optional = $obj_settings->get_option('rzvy_en_ff_firstname_optional');
$rzvy_en_ff_lastname_optional = $obj_settings->get_option('rzvy_en_ff_lastname_optional');
$rzvy_en_ff_phone_optional = $obj_settings->get_option('rzvy_en_ff_phone_optional');
$rzvy_en_ff_address_optional = $obj_settings->get_option('rzvy_en_ff_address_optional');
$rzvy_en_ff_city_optional = $obj_settings->get_option('rzvy_en_ff_city_optional');
$rzvy_en_ff_state_optional = $obj_settings->get_option('rzvy_en_ff_state_optional');
$rzvy_en_ff_country_optional = $obj_settings->get_option('rzvy_en_ff_country_optional');

$rzvy_g_ff_firstname_optional = $obj_settings->get_option('rzvy_g_ff_firstname_optional');
$rzvy_g_ff_lastname_optional = $obj_settings->get_option('rzvy_g_ff_lastname_optional');
$rzvy_g_ff_phone_optional = $obj_settings->get_option('rzvy_g_ff_phone_optional');
$rzvy_g_ff_address_optional = $obj_settings->get_option('rzvy_g_ff_address_optional');
$rzvy_g_ff_city_optional = $obj_settings->get_option('rzvy_g_ff_city_optional');
$rzvy_g_ff_state_optional = $obj_settings->get_option('rzvy_g_ff_state_optional');
$rzvy_g_ff_country_optional = $obj_settings->get_option('rzvy_g_ff_country_optional'); 

include("mbf_css.php"); 
?>
	<div class="rzvy-mb">
		<section class="rzvy-booking-detail-block rzvy-center-block rzvy-main-block-before">
			<div class="container">
				<div class="row">
					<div class="col-md-12 rzvy-set-sm-fit mb-4">
						<div class="rzvy-booking-detail-main">
							<div class="rzvy-radio-group-block rzvy-company-services-blocks">
								<div class="rzvy-radio-group-block-content rzvy-no-border-bottom pt-3 pb-2">
									<h5><?php if(isset($rzvy_translangArr['what_type_of_service'])){ echo $rzvy_translangArr['what_type_of_service']; }else{ echo $rzvy_defaultlang['what_type_of_service']; } ?></h5>
								</div>
								<div class="d-flex flex-wrap">
									<?php 
									$i=0;
									$total_cat = mysqli_num_rows($all_categories);
									if($total_cat>0){
										while($category = mysqli_fetch_array($all_categories)){ 
											$i++;
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
										<div class="row">
											<div class="col-xs-12 col-md-12 rzvy-sm-box">
												<label><?php if(isset($rzvy_translangArr['please_configure_first_services_from_admin_area'])){ echo $rzvy_translangArr['please_configure_first_services_from_admin_area']; }else{ echo $rzvy_defaultlang['please_configure_first_services_from_admin_area']; } ?></label>
											</div>
										</div>
										<?php 
									} 
									?>
								</div>
							</div>
							<div class="row rzvy_show_hide_services">
								<div class="col-md-12">
									<div class="rzvy-radio-group-block-content rzvy-no-border-bottom m-0 border-0 pb-2 pt-1">
										<h5><?php if(isset($rzvy_translangArr['tell_us_about_your_service'])){ echo $rzvy_translangArr['tell_us_about_your_service']; }else{ echo $rzvy_defaultlang['tell_us_about_your_service']; } ?></h5>
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
									<div class="rzvy-radio-group-block-content rzvy-no-border-bottom m-0 border-0 pb-2 pt-1">
										<h5><?php if(isset($rzvy_translangArr['select_additional_services'])){ echo $rzvy_translangArr['select_additional_services']; }else{ echo $rzvy_defaultlang['select_additional_services']; } ?></h5>
									</div>
								</div>
							</div>
							<div id="rzvy_multi_and_single_qty_addons_content">
								<!-- multipleqty & singleqty addons will go here -->
							</div>
							
							<!-- STAFF SECTION START -->
							<div id="rzvy-staff-main"></div>
							
							<div class="row">
								<div class="col-md-12">
									<div class="rzvy-radio-group-block-content rzvy-no-border-bottom mt-1 pt-2 pb-3">
										<h5><?php if(isset($rzvy_translangArr['choose_your_appointment_slot'])){ echo $rzvy_translangArr['choose_your_appointment_slot']; }else{ echo $rzvy_defaultlang['choose_your_appointment_slot']; } ?></h5>
									</div>
								</div>
							</div>
							<div class="row pt-0">
								<div class="col-md-12">
									<div class="rzvy-inline-calendar">
										<div class="rzvy-inline-calendar-container rzvy-inline-calendar-container-boxshadow">
											<center><h3><?php if(isset($rzvy_translangArr['please_wait'])){ echo $rzvy_translangArr['please_wait']; }else{ echo $rzvy_defaultlang['please_wait']; } ?>.</h3></center>
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
								<h5 class="pb-2"><?php if(isset($rzvy_translangArr['how_often_would_you_like_service'])){ echo $rzvy_translangArr['how_often_would_you_like_service']; }else{ echo $rzvy_defaultlang['how_often_would_you_like_service']; } ?></h5>
								<div id="rzvy_frequently_discount_content" class="show_hide_frequently_discount">
									<!-- frequently discount will go here -->
								</div>
							</div>
							<?php 
							$useremail = "";
							$userpassword = "";
							$userfirstname = "";
							$userlastname = "";
							$userzip = "";
							$userphone = "";
							$useraddress = "";
							$usercity = "";
							$userstate = "";
							$usercountry = "";
							?>
							<div class="row">
								<div class="col-md-12">
									<div class="rzvy-radio-group-block-content rzvy-no-border-bottom my-1 py-3">
										<h5><?php if(isset($rzvy_translangArr['personal_information'])){ echo $rzvy_translangArr['personal_information']; }else{ echo $rzvy_defaultlang['personal_information']; } ?></h5>
										<div class="rzvy-users-selection-div">
											<input type="radio" class="rzvy-user-selection" id="rzvy-existing-user" name="rzvy-user-selection" checked value="ec" />
											<label class="rzvy-user-selection-label" for="rzvy-existing-user"><?php if(isset($rzvy_translangArr['existing_customer'])){ echo $rzvy_translangArr['existing_customer']; }else{ echo $rzvy_defaultlang['existing_customer']; } ?></label>

											<input type="radio" class="rzvy-user-selection" id="rzvy-new-user" name="rzvy-user-selection" value="nc" />
											<label class="rzvy-user-selection-label" for="rzvy-new-user"><?php if(isset($rzvy_translangArr['new_customer'])){ echo $rzvy_translangArr['new_customer']; }else{ echo $rzvy_defaultlang['new_customer']; } ?></label>
											
											<input type="radio" class="rzvy-user-selection" id="rzvy-guest-user" name="rzvy-user-selection" value="gc" />
											<label class="rzvy-user-selection-label" for="rzvy-guest-user"><?php if(isset($rzvy_translangArr['guest_customer'])){ echo $rzvy_translangArr['guest_customer']; }else{ echo $rzvy_defaultlang['guest_customer']; } ?></label>
										</div>
										<div class="rzvy-logout-div mt-2">
											<label><?php if(isset($rzvy_translangArr['you_selected'])){ echo $rzvy_translangArr['you_selected']; }else{ echo $rzvy_defaultlang['you_selected']; } ?> <b class="rzvy_loggedin_name"></b>. <a href="javascript:void(0)" id="rzvy_change_customer_btn"><?php if(isset($rzvy_translangArr['change_customer'])){ echo $rzvy_translangArr['change_customer']; }else{ echo $rzvy_defaultlang['change_customer']; } ?></a></label>
										</div>
									</div>
								</div>
							</div>
							<div class="rzvy-radio-group-block mt24" id="rzvy-existing-user-box">
								<div class="row">
									<div class="col-md-12">
										<select class="form-control" name="rzvy_existing_customer_selection" id="rzvy_existing_customer_selection">
											<option value="0" disabled selected><?php if(isset($rzvy_translangArr['select_customer'])){ echo $rzvy_translangArr['select_customer']; }else{ echo $rzvy_defaultlang['select_customer']; } ?></option>
											<?php 
											if(mysqli_num_rows($all_customers)>0){ 
												while($customer = mysqli_fetch_array($all_customers)){ 
													?>
													<option value="<?php echo $customer['id']; ?>"><?php echo ucwords($customer['firstname']." ".$customer["lastname"])." [".$customer["email"]."]"; ?></option>
													<?php 
												}
											} 
											?>
										</select>
									</div>
								</div>
							</div>
							<form method="post" name="rzvy_user_detail_form" id="rzvy_user_detail_form">
								<div class="rzvy-radio-group-block mt24" id="rzvy-new-user-box">
									<div class="row">
										<div class="col-md-6 rzvy_hide_after_login">
											<div class="rzvy-input-class-div">
												<input type="hidden" id="rzvy_user_customer_id" name="rzvy_user_customer_id" value="">
												<input type="email" id="rzvy_user_email" name="rzvy_user_email" placeholder="<?php if(isset($rzvy_translangArr['email_address'])){ echo $rzvy_translangArr['email_address']; }else{ echo $rzvy_defaultlang['email_address']; } ?>" value="<?php echo $useremail; ?>" class="rzvy-input-class">
											</div>
										</div>
										<div class="col-md-6 rzvy_hide_after_login">
											<div class="rzvy-input-class-div">
												<input type="password" id="rzvy_user_password" name="rzvy_user_password" placeholder="<?php if(isset($rzvy_translangArr['password'])){ echo $rzvy_translangArr['password']; }else{ echo $rzvy_defaultlang['password']; } ?>" value="<?php echo $userpassword; ?>" class="rzvy-input-class">
											</div>
										</div>
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
										
										
										$show_zip_input = "";
										if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
											$show_zip_input= "rzvy_hide";
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
										?>
										<div class="col-md-6 <?php echo $show_zip_input; ?>">
											<div class="rzvy-input-class-div">
												<input type="text" id="rzvy_user_zip" name="rzvy_user_zip" placeholder="<?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?>" value="<?php echo $userzip; ?>" class="rzvy-input-class">
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
							<form method="post" name="rzvy_guestuser_detail_form" id="rzvy_guestuser_detail_form">
								<div class="rzvy-radio-group-block mt24" id="rzvy-guest-user-box">
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
										$show_gzip_input = "";
										if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
											$show_gzip_input= "rzvy_hide";
										} 
										?>
										<div class="col-md-3 <?php echo $show_gzip_input; ?>">
											<div class="rzvy-input-class-div">
												<input type="text" id="rzvy_guest_zip" name="rzvy_guest_zip" placeholder="<?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?>" class="rzvy-input-class">
											</div>
										</div>
										<?php 
										if($rzvy_g_ff_city_status == "Y"){ 
											?>
											<div class="col-md-4">
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
											<div class="col-md-4">
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
											<div class="col-md-4">
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
							<div class="rzvy-radio-group-block">
								<div class="row mt-4">
									<div class="col-md-12">
										<button id="rzvy_book_appointment_btn" class="btn btn-block rzvy-big-block-btn" type="submit"><span class="fa fa-calendar-check-o"></span><?php if(isset($rzvy_translangArr['book_now'])){ echo $rzvy_translangArr['book_now']; }else{ echo $rzvy_defaultlang['book_now']; } ?></button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12 rzvy-set-sm-fit">
						<div>
							<div class="rzvy-sidebar-block-title">
								<h5><?php if(isset($rzvy_translangArr['booking_summary'])){ echo $rzvy_translangArr['booking_summary']; }else{ echo $rzvy_defaultlang['booking_summary']; } ?></h5>
							</div>
							<div id="rzvy_refresh_cart" class="rzvy-sidebar-block-content">
								<label><?php if(isset($rzvy_translangArr['no_items_in_cart'])){ echo $rzvy_translangArr['no_items_in_cart']; }else{ echo $rzvy_defaultlang['no_items_in_cart']; } ?></label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<script>
		var formfieldsObj = { 'en_ff_phone_status' : '<?php echo $rzvy_en_ff_phone_status; ?>', 'g_ff_phone_status' : '<?php echo $rzvy_g_ff_phone_status; ?>', 'en_ff_firstname' : '<?php echo $rzvy_en_ff_firstname_optional; ?>', 'en_ff_lastname' : '<?php echo $rzvy_en_ff_lastname_optional; ?>', 'en_ff_phone' : '<?php echo $rzvy_en_ff_phone_optional; ?>', 'en_ff_address' : '<?php echo $rzvy_en_ff_address_optional; ?>', 'en_ff_city' : '<?php echo $rzvy_en_ff_city_optional; ?>', 'en_ff_state' : '<?php echo $rzvy_en_ff_state_optional; ?>', 'en_ff_country' : '<?php echo $rzvy_en_ff_country_optional; ?>', 'g_ff_firstname' : '<?php echo $rzvy_g_ff_firstname_optional; ?>', 'g_ff_lastname' : '<?php echo $rzvy_g_ff_lastname_optional; ?>', 'g_ff_phone' : '<?php echo $rzvy_g_ff_phone_optional; ?>', 'g_ff_address' : '<?php echo $rzvy_g_ff_address_optional; ?>', 'g_ff_city' : '<?php echo $rzvy_g_ff_city_optional; ?>', 'g_ff_state' : '<?php echo $rzvy_g_ff_state_optional; ?>', 'g_ff_country' : '<?php echo $rzvy_g_ff_country_optional; ?>' }; 
	</script>