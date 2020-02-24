<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$image_upload_path = SITE_URL."/uploads/images/";
$image_upload_abs_path = dirname(dirname(dirname(__FILE__)))."/uploads/images/";

/** Update company settings Ajax **/
if(isset($_POST['update_company_settings'])){
	$obj_settings->update_option('rzvy_company_name',$_POST['rzvy_company_name']);
	$obj_settings->update_option('rzvy_company_email',$_POST['rzvy_company_email']);
	$obj_settings->update_option('rzvy_company_phone',$_POST['rzvy_company_phone']);
	$obj_settings->update_option('rzvy_company_address',$_POST['rzvy_company_address']);
	$obj_settings->update_option('rzvy_company_city',$_POST['rzvy_company_city']);
	$obj_settings->update_option('rzvy_company_state',$_POST['rzvy_company_state']);
	$obj_settings->update_option('rzvy_company_zip',$_POST['rzvy_company_zip']);
	$obj_settings->update_option('rzvy_company_country',$_POST['rzvy_company_country']);
	$obj_settings->update_option('rzvy_default_country_code',$_POST['rzvy_default_country_code']);
	
	if($_POST['uploaded_file'] != ""){
		$old_image = $obj_settings->get_option("rzvy_company_logo");
		if($old_image != ""){
			if(file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image)){
				unlink(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image);
			}
		}
		$new_filename = time();
		$uploaded_filename = $obj_settings->rzvy_base64_to_jpeg($_POST['uploaded_file'], $image_upload_abs_path, $new_filename);
		$obj_settings->update_option('rzvy_company_logo',$uploaded_filename);
	}
}

/** Update appearance settings Ajax **/
else if(isset($_POST['update_appearance_settings'])){
	$obj_settings->update_option('rzvy_timeslot_interval',$_POST['rzvy_timeslot_interval']);
	$obj_settings->update_option('rzvy_endtimeslot_selection_status',$_POST['rzvy_endtimeslot_selection_status']);
	$obj_settings->update_option('rzvy_maximum_endtimeslot_limit',$_POST['rzvy_maximum_endtimeslot_limit']);
	$obj_settings->update_option('rzvy_currency',$_POST['rzvy_currency']);
	$obj_settings->update_option('rzvy_currency_symbol',$_POST['rzvy_currency_symbol']);
	$obj_settings->update_option('rzvy_auto_confirm_appointment',$_POST['rzvy_auto_confirm_appointment']);
	$obj_settings->update_option('rzvy_tax_status',$_POST['rzvy_tax_status']);
	$obj_settings->update_option('rzvy_tax_type',$_POST['rzvy_tax_type']);
	$obj_settings->update_option('rzvy_tax_value',$_POST['rzvy_tax_value']);
	$obj_settings->update_option('rzvy_minimum_booking_amount',$_POST['rzvy_minimum_booking_amount']);
	$obj_settings->update_option('rzvy_minimum_advance_booking_time',$_POST['rzvy_minimum_advance_booking_time']);
	$obj_settings->update_option('rzvy_maximum_advance_booking_time',$_POST['rzvy_maximum_advance_booking_time']);
	$obj_settings->update_option('rzvy_cancellation_buffer_time',$_POST['rzvy_cancellation_buffer_time']);
	$obj_settings->update_option('rzvy_reschedule_buffer_time',$_POST['rzvy_reschedule_buffer_time']);
	$obj_settings->update_option('rzvy_date_format',$_POST['rzvy_date_format']);
	$obj_settings->update_option('rzvy_time_format',$_POST['rzvy_time_format']);
	$obj_settings->update_option('rzvy_timezone',$_POST['rzvy_timezone']);
	$obj_settings->update_option('rzvy_show_frontend_rightside_feedback_list',$_POST['rzvy_show_frontend_rightside_feedback_list']);
	$obj_settings->update_option('rzvy_show_frontend_rightside_feedback_form',$_POST['rzvy_show_frontend_rightside_feedback_form']);
	$obj_settings->update_option('rzvy_show_guest_user_checkout',$_POST['rzvy_show_guest_user_checkout']);
	$obj_settings->update_option('rzvy_show_existing_new_user_checkout',$_POST['rzvy_show_existing_new_user_checkout']);
	$obj_settings->update_option('rzvy_hide_already_booked_slots_from_frontend_calendar',$_POST['rzvy_hide_already_booked_slots_from_frontend_calendar']);
	$obj_settings->update_option('rzvy_thankyou_page_url',$_POST['rzvy_thankyou_page_url']);
	$obj_settings->update_option('rzvy_terms_and_condition_link',$_POST['rzvy_terms_and_condition_link']);
}

/** Update email settings Ajax **/
else if(isset($_POST['update_email_settings'])){
	$obj_settings->update_option('rzvy_admin_email_notification_status',$_POST['rzvy_admin_email_notification_status']);
	$obj_settings->update_option('rzvy_customer_email_notification_status',$_POST['rzvy_customer_email_notification_status']);
	$obj_settings->update_option('rzvy_staff_email_notification_status',$_POST['rzvy_staff_email_notification_status']);
	$obj_settings->update_option('rzvy_email_sender_name',$_POST['rzvy_email_sender_name']);
	$obj_settings->update_option('rzvy_email_sender_email',$_POST['rzvy_email_sender_email']);
	$obj_settings->update_option('rzvy_email_smtp_hostname',$_POST['rzvy_email_smtp_hostname']);
	$obj_settings->update_option('rzvy_email_smtp_username',$_POST['rzvy_email_smtp_username']);
	$obj_settings->update_option('rzvy_email_smtp_password',$_POST['rzvy_email_smtp_password']);
	$obj_settings->update_option('rzvy_email_smtp_port',$_POST['rzvy_email_smtp_port']);
	$obj_settings->update_option('rzvy_email_encryption_type',$_POST['rzvy_email_encryption_type']);
	$obj_settings->update_option('rzvy_email_smtp_authentication',$_POST['rzvy_email_smtp_authentication']);
	$obj_settings->update_option('rzvy_send_email_with',$_POST['rzvy_send_email_with']);
}

/** Update change_pageload_lang Ajax **/
else if(isset($_POST['change_pageload_lang'])){
	$obj_settings->update_option('rzvy_default_language_on_page_load',$_POST['rzvy_default_language_on_page_load']);
}

/** Update SMS settings Ajax **/
else if(isset($_POST['update_admin_sms_settings'])){
	$obj_settings->update_option('rzvy_admin_sms_notification_status',$_POST['rzvy_admin_sms_notification_status']);
}

/** Update SMS settings Ajax **/
else if(isset($_POST['update_staff_sms_settings'])){
	$obj_settings->update_option('rzvy_staff_sms_notification_status',$_POST['rzvy_staff_sms_notification_status']);
}

/** Update SMS settings Ajax **/
else if(isset($_POST['update_customer_sms_settings'])){
	$obj_settings->update_option('rzvy_customer_sms_notification_status',$_POST['rzvy_customer_sms_notification_status']);
}

/** Update Pay at Venue Payment Status Ajax **/
else if(isset($_POST['change_pay_at_venue_status'])){
	$obj_settings->update_option('rzvy_pay_at_venue_status',$_POST['rzvy_pay_at_venue_status']);
}

/** Update Referral settings Ajax **/
else if(isset($_POST['update_referral_discount_settings'])){
	$obj_settings->update_option('rzvy_referral_discount_status',$_POST['rzvy_referral_discount_status']);
	$obj_settings->update_option('rzvy_referral_discount_type',$_POST['rzvy_referral_discount_type']);
	$obj_settings->update_option('rzvy_referral_discount_value',$_POST['rzvy_referral_discount_value']);
}

/** Update SEO settings Ajax **/
else if(isset($_POST['update_seo_settings'])){
	$obj_settings->update_option('rzvy_seo_ga_code',$_POST['rzvy_seo_ga_code']);
	$obj_settings->update_option('rzvy_seo_meta_tag',$_POST['rzvy_seo_meta_tag']);
	$obj_settings->update_option('rzvy_seo_meta_description',$_POST['rzvy_seo_meta_description']);
	$obj_settings->update_option('rzvy_seo_og_meta_tag',$_POST['rzvy_seo_og_meta_tag']);
	$obj_settings->update_option('rzvy_seo_og_tag_type',$_POST['rzvy_seo_og_tag_type']);
	$obj_settings->update_option('rzvy_seo_og_tag_url',$_POST['rzvy_seo_og_tag_url']);
	
	if($_POST['uploaded_file'] != ""){
		$old_image = $obj_settings->get_option("rzvy_seo_og_tag_image");
		if($old_image != ""){
			if(file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image)){
				unlink(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image);
			}
		}
		$new_filename = time();
		$uploaded_filename = $obj_settings->rzvy_base64_to_jpeg($_POST['uploaded_file'], $image_upload_abs_path, $new_filename);
		$obj_settings->update_option('rzvy_seo_og_tag_image',$uploaded_filename);
	}
}

/** Update Welcome Message settings Ajax **/
else if(isset($_POST['update_welcome_message_settings'])){
	$obj_settings->update_option('rzvy_welcome_message_container',base64_encode($_POST['rzvy_welcome_message_container']));
	$obj_settings->update_option('rzvy_welcome_message_status',$_POST['rzvy_welcome_message_status']);
	$obj_settings->update_option('rzvy_welcome_as_more_info_status',$_POST['rzvy_welcome_as_more_info_status']);
}

/** Update Booking Form settings Ajax **/
else if(isset($_POST['update_bookingform_settings'])){
	$obj_settings->update_option('rzvy_frontend', $_POST['rzvy_frontend']);
	$obj_settings->update_option('rzvy_single_category_autotrigger_status', $_POST['rzvy_single_category_autotrigger_status']);
	$obj_settings->update_option('rzvy_single_service_autotrigger_status', $_POST['rzvy_single_service_autotrigger_status']);
}
/** Update Location Selector settings Ajax **/
else if(isset($_POST['save_location_selector_settings'])){
	$rzvy_location_selector = htmlentities($_POST['rzvy_location_selector']);
	$obj_settings->update_option('rzvy_location_selector_status',$_POST["rzvy_location_selector_status"]);
	$obj_settings->update_option('rzvy_location_selector',$rzvy_location_selector);
}

/** Update Refund settings Ajax **/
else if(isset($_POST['update_refund_settings'])){
	$rzvy_refund_summary = base64_encode($_POST['rzvy_refund_summary']);
	$obj_settings->update_option('rzvy_refund_status', $_POST["rzvy_refund_status"]);
	$obj_settings->update_option('rzvy_refund_type', $_POST["rzvy_refund_type"]);
	$obj_settings->update_option('rzvy_refund_value', $_POST["rzvy_refund_value"]);
	$obj_settings->update_option('rzvy_refund_request_buffer_time', $_POST["rzvy_refund_request_buffer_time"]);
	$obj_settings->update_option('rzvy_refund_summary', $rzvy_refund_summary);
}

/** Update Paypal Payment settings Ajax **/
else if(isset($_POST['update_paypal_settings'])){
	$obj_settings->update_option('rzvy_paypal_payment_status',$_POST['rzvy_paypal_payment_status']);
	$obj_settings->update_option('rzvy_paypal_guest_payment',$_POST['rzvy_paypal_guest_payment']);
	$obj_settings->update_option('rzvy_paypal_api_username',$_POST['rzvy_paypal_api_username']);
	$obj_settings->update_option('rzvy_paypal_api_password',$_POST['rzvy_paypal_api_password']);
	$obj_settings->update_option('rzvy_paypal_signature',$_POST['rzvy_paypal_signature']);
}

/** Update stripe Payment settings Ajax **/
else if(isset($_POST['update_stripe_settings'])){
	$obj_settings->update_option('rzvy_authorizenet_payment_status',"N");
	$obj_settings->update_option('rzvy_twocheckout_payment_status',"N");
	$obj_settings->update_option('rzvy_stripe_payment_status',$_POST['rzvy_stripe_payment_status']);
	$obj_settings->update_option('rzvy_stripe_secret_key',$_POST['rzvy_stripe_secret_key']);
	$obj_settings->update_option('rzvy_stripe_publishable_key',$_POST['rzvy_stripe_publishable_key']);
}

/** Update Authorize.net Payment settings Ajax **/
else if(isset($_POST['update_authorizenet_settings'])){
	$obj_settings->update_option('rzvy_stripe_payment_status',"N");
	$obj_settings->update_option('rzvy_twocheckout_payment_status',"N");
	$obj_settings->update_option('rzvy_authorizenet_payment_status',$_POST['rzvy_authorizenet_payment_status']);
	$obj_settings->update_option('rzvy_authorizenet_api_login_id',$_POST['rzvy_authorizenet_api_login_id']);
	$obj_settings->update_option('rzvy_authorizenet_transaction_key',$_POST['rzvy_authorizenet_transaction_key']);
}

/** Update 2Checkout Payment settings Ajax **/
else if(isset($_POST['update_twocheckout_settings'])){
	$obj_settings->update_option('rzvy_stripe_payment_status',"N");
	$obj_settings->update_option('rzvy_authorizenet_payment_status',"N");
	$obj_settings->update_option('rzvy_twocheckout_payment_status',$_POST['rzvy_twocheckout_payment_status']);
	$obj_settings->update_option('rzvy_twocheckout_publishable_key',$_POST['rzvy_twocheckout_publishable_key']);
	$obj_settings->update_option('rzvy_twocheckout_private_key',$_POST['rzvy_twocheckout_private_key']);
	$obj_settings->update_option('rzvy_twocheckout_seller_id',$_POST['rzvy_twocheckout_seller_id']);
}

/* Get payment setting form ajax */
else if(isset($_POST['get_payment_settings'])){
	if($_POST['get_payment_settings'] == "1"){
		?>
		<form name="rzvy_paypal_payment_settings_form" id="rzvy_paypal_payment_settings_form" method="post">
			<div class="row">
				<label class="col-md-6"><?php if(isset($rzvy_translangArr['paypal_payment_status'])){ echo $rzvy_translangArr['paypal_payment_status']; }else{ echo $rzvy_defaultlang['paypal_payment_status']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_paypal_payment_status" id="rzvy_paypal_payment_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_paypal_payment_status")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="row">
				<label class="col-md-6"><?php if(isset($rzvy_translangArr['paypal_guest_payment'])){ echo $rzvy_translangArr['paypal_guest_payment']; }else{ echo $rzvy_defaultlang['paypal_guest_payment']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_paypal_guest_payment" id="rzvy_paypal_guest_payment" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_paypal_guest_payment")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="rzvy_paypal_api_username"><?php if(isset($rzvy_translangArr['api_username'])){ echo $rzvy_translangArr['api_username']; }else{ echo $rzvy_defaultlang['api_username']; } ?></label>
				<input class="form-control" id="rzvy_paypal_api_username" name="rzvy_paypal_api_username" type="text" value="<?php echo $obj_settings->get_option("rzvy_paypal_api_username"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_paypal_api_password"><?php if(isset($rzvy_translangArr['api_password'])){ echo $rzvy_translangArr['api_password']; }else{ echo $rzvy_defaultlang['api_password']; } ?></label>
				<input class="form-control" id="rzvy_paypal_api_password" name="rzvy_paypal_api_password" type="text" value="<?php echo $obj_settings->get_option("rzvy_paypal_api_password"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_paypal_signature"><?php if(isset($rzvy_translangArr['signature'])){ echo $rzvy_translangArr['signature']; }else{ echo $rzvy_defaultlang['signature']; } ?></label>
				<input class="form-control" id="rzvy_paypal_signature" name="rzvy_paypal_signature" type="text" value="<?php echo $obj_settings->get_option("rzvy_paypal_signature"); ?>" />
			</div>
		</form>
		<?php
	}
	else if($_POST['get_payment_settings'] == "2"){
		?>
		<form name="rzvy_stripe_payment_settings_form" id="rzvy_stripe_payment_settings_form" method="post">
			<div class="row">
				<label class="col-md-6"><?php if(isset($rzvy_translangArr['stripe_payment_status'])){ echo $rzvy_translangArr['stripe_payment_status']; }else{ echo $rzvy_defaultlang['stripe_payment_status']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_stripe_payment_status" id="rzvy_stripe_payment_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_stripe_payment_status")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="rzvy_stripe_secret_key"><?php if(isset($rzvy_translangArr['secret_key'])){ echo $rzvy_translangArr['secret_key']; }else{ echo $rzvy_defaultlang['secret_key']; } ?></label>
				<input class="form-control" id="rzvy_stripe_secret_key" name="rzvy_stripe_secret_key" type="text" value="<?php echo $obj_settings->get_option("rzvy_stripe_secret_key"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_stripe_publishable_key"><?php if(isset($rzvy_translangArr['publishable_key'])){ echo $rzvy_translangArr['publishable_key']; }else{ echo $rzvy_defaultlang['publishable_key']; } ?></label>
				<input class="form-control" id="rzvy_stripe_publishable_key" name="rzvy_stripe_publishable_key" type="text" value="<?php echo $obj_settings->get_option("rzvy_stripe_publishable_key"); ?>" />
			</div>
		</form>
		<?php
	}
	else if($_POST['get_payment_settings'] == "3"){
		?>
		<form name="rzvy_authorizenet_payment_settings_form" id="rzvy_authorizenet_payment_settings_form" method="post">
			<div class="row">
				<label class="col-md-6"><?php if(isset($rzvy_translangArr['authorizenet_payment_status'])){ echo $rzvy_translangArr['authorizenet_payment_status']; }else{ echo $rzvy_defaultlang['authorizenet_payment_status']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_authorizenet_payment_status" id="rzvy_authorizenet_payment_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_authorizenet_payment_status")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="rzvy_authorizenet_api_login_id"><?php if(isset($rzvy_translangArr['api_login_id'])){ echo $rzvy_translangArr['api_login_id']; }else{ echo $rzvy_defaultlang['api_login_id']; } ?></label>
				<input class="form-control" id="rzvy_authorizenet_api_login_id" name="rzvy_authorizenet_api_login_id" type="text" value="<?php echo $obj_settings->get_option("rzvy_authorizenet_api_login_id"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_authorizenet_transaction_key"><?php if(isset($rzvy_translangArr['transaction_key'])){ echo $rzvy_translangArr['transaction_key']; }else{ echo $rzvy_defaultlang['transaction_key']; } ?></label>
				<input class="form-control" id="rzvy_authorizenet_transaction_key" name="rzvy_authorizenet_transaction_key" type="text" value="<?php echo $obj_settings->get_option("rzvy_authorizenet_transaction_key"); ?>" />
			</div>
		</form>
		<?php
	}
	else if($_POST['get_payment_settings'] == "4"){ 
		?>
		<form name="rzvy_twocheckout_payment_settings_form" id="rzvy_twocheckout_payment_settings_form" method="post">
			<div class="row">
				<label class="col-md-6"><?php if(isset($rzvy_translangArr['2checkout_payment_status'])){ $rzvy_translangArr['2checkout_payment_status']; }else{ echo $rzvy_defaultlang['2checkout_payment_status']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_twocheckout_payment_status" id="rzvy_twocheckout_payment_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_twocheckout_payment_status")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="rzvy_twocheckout_publishable_key"><?php if(isset($rzvy_translangArr['publishable_key'])){ echo $rzvy_translangArr['publishable_key']; }else{ echo $rzvy_defaultlang['publishable_key']; } ?></label>
				<input class="form-control" id="rzvy_twocheckout_publishable_key" name="rzvy_twocheckout_publishable_key" type="text" value="<?php echo $obj_settings->get_option("rzvy_twocheckout_publishable_key"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_twocheckout_private_key"><?php if(isset($rzvy_translangArr['private_key'])){ echo $rzvy_translangArr['private_key']; }else{ echo $rzvy_defaultlang['private_key']; } ?></label>
				<input class="form-control" id="rzvy_twocheckout_private_key" name="rzvy_twocheckout_private_key" type="text" value="<?php echo $obj_settings->get_option("rzvy_twocheckout_private_key"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_twocheckout_seller_id"><?php if(isset($rzvy_translangArr['seller_id'])){ echo $rzvy_translangArr['seller_id']; }else{ echo $rzvy_defaultlang['seller_id']; } ?></label>
				<input class="form-control" id="rzvy_twocheckout_seller_id" name="rzvy_twocheckout_seller_id" type="text" value="<?php echo $obj_settings->get_option("rzvy_twocheckout_seller_id"); ?>" />
			</div>
		</form>
		<?php
	}
}

/** Update Existing & New User Form Fields settings Ajax **/
else if(isset($_POST['update_en_ff_settings'])){
	$obj_settings->update_option('rzvy_en_ff_'.$_POST["fieldname"].'_status',$_POST['status']);
	if($_POST['status'] == "N"){
		$obj_settings->update_option('rzvy_en_ff_'.$_POST["fieldname"].'_optional',$_POST['status']);
	}
}

/** Update Guest User Form Fields settings Ajax **/
else if(isset($_POST['update_g_ff_settings'])){
	$obj_settings->update_option('rzvy_g_ff_'.$_POST["fieldname"].'_status',$_POST['status']);
	if($_POST['status'] == "N"){
		$obj_settings->update_option('rzvy_g_ff_'.$_POST["fieldname"].'_optional',$_POST['status']);
	}
}

/** Update Existing & New User Form Fields optional settings Ajax **/
else if(isset($_POST['update_en_ff_optional_settings'])){
	$obj_settings->update_option('rzvy_en_ff_'.$_POST["fieldname"].'_optional',$_POST['status']);
}

/** Update Guest User Form Fields optional settings Ajax **/
else if(isset($_POST['update_g_ff_optional_settings'])){
	$obj_settings->update_option('rzvy_g_ff_'.$_POST["fieldname"].'_optional',$_POST['status']);
}

/** Update language dropdown option Ajax **/
else if(isset($_POST['save_rzvy_show_dropdown_languages'])){
	if(isset($_POST['lang'])){
		$selection = implode(",", $_POST['lang']);
	}else{
		$selection = "";
	}
	$obj_settings->update_option('rzvy_rzvy_show_dropdown_languages',$selection);
}

/** change reminder buffer time settings Ajax **/
else if(isset($_POST['change_reminder_buffer_time'])){
	$obj_settings->update_option('rzvy_reminder_buffer_time',$_POST['rzvy_reminder_buffer_time']);
}

/** Update Twilio SMS settings Ajax **/
else if(isset($_POST['update_twilio_settings'])){
	$obj_settings->update_option('rzvy_twilio_sms_status',$_POST['rzvy_twilio_sms_status']);
	$obj_settings->update_option('rzvy_twilio_account_SID',$_POST['rzvy_twilio_account_SID']);
	$obj_settings->update_option('rzvy_twilio_auth_token',$_POST['rzvy_twilio_auth_token']);
	$obj_settings->update_option('rzvy_twilio_sender_number',$_POST['rzvy_twilio_sender_number']);
}

/** Update Plivo SMS settings Ajax **/
else if(isset($_POST['update_plivo_settings'])){
	$obj_settings->update_option('rzvy_plivo_sms_status',$_POST['rzvy_plivo_sms_status']);
	$obj_settings->update_option('rzvy_plivo_account_SID',$_POST['rzvy_plivo_account_SID']);
	$obj_settings->update_option('rzvy_plivo_auth_token',$_POST['rzvy_plivo_auth_token']);
	$obj_settings->update_option('rzvy_plivo_sender_number',$_POST['rzvy_plivo_sender_number']);
}

/** Update Nexmo SMS settings Ajax **/
else if(isset($_POST['update_nexmo_settings'])){
	$obj_settings->update_option('rzvy_nexmo_sms_status',$_POST['rzvy_nexmo_sms_status']);
	$obj_settings->update_option('rzvy_nexmo_api_key',$_POST['rzvy_nexmo_api_key']);
	$obj_settings->update_option('rzvy_nexmo_api_secret',$_POST['rzvy_nexmo_api_secret']);
	$obj_settings->update_option('rzvy_nexmo_from',$_POST['rzvy_nexmo_from']);
}

/** Update TextLocal SMS settings Ajax **/
else if(isset($_POST['update_textlocal_settings'])){
	$obj_settings->update_option('rzvy_textlocal_sms_status',$_POST['rzvy_textlocal_sms_status']);
	$obj_settings->update_option('rzvy_textlocal_api_key',$_POST['rzvy_textlocal_api_key']);
	$obj_settings->update_option('rzvy_textlocal_sender',$_POST['rzvy_textlocal_sender']);
	$obj_settings->update_option('rzvy_textlocal_country',$_POST['rzvy_textlocal_country']);
}

/* Get SMS setting form ajax */
else if(isset($_POST['get_sms_settings'])){
	if($_POST['get_sms_settings'] == "1"){ 
		?>
		<form name="rzvy_twilio_sms_settings_form" id="rzvy_twilio_sms_settings_form" method="post">
			<div class="row">
				<label class="col-md-7"><?php if(isset($rzvy_translangArr['twilio_sms_gateway_status'])){ echo $rzvy_translangArr['twilio_sms_gateway_status']; }else{ echo $rzvy_defaultlang['twilio_sms_gateway_status']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_twilio_sms_status" id="rzvy_twilio_sms_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_twilio_sms_status")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="rzvy_twilio_account_SID"><?php if(isset($rzvy_translangArr['account_sid'])){ echo $rzvy_translangArr['account_sid']; }else{ echo $rzvy_defaultlang['account_sid']; } ?></label>
				<input class="form-control" id="rzvy_twilio_account_SID" name="rzvy_twilio_account_SID" type="text" value="<?php echo $obj_settings->get_option("rzvy_twilio_account_SID"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_twilio_auth_token"><?php if(isset($rzvy_translangArr['auth_token'])){ echo $rzvy_translangArr['auth_token']; }else{ echo $rzvy_defaultlang['auth_token']; } ?></label>
				<input class="form-control" id="rzvy_twilio_auth_token" name="rzvy_twilio_auth_token" type="text" value="<?php echo $obj_settings->get_option("rzvy_twilio_auth_token"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_twilio_sender_number"><?php if(isset($rzvy_translangArr['twilio_sender_number'])){ echo $rzvy_translangArr['twilio_sender_number']; }else{ echo $rzvy_defaultlang['twilio_sender_number']; } ?></label>
				<input class="form-control" id="rzvy_twilio_sender_number" name="rzvy_twilio_sender_number" type="text" placeholder="e.g. 3899815981" value="<?php echo $obj_settings->get_option("rzvy_twilio_sender_number"); ?>" />
			</div>
		</form>
		<?php 
	}
	else if($_POST['get_sms_settings'] == "2"){ 
		?>
		<form name="rzvy_plivo_sms_settings_form" id="rzvy_plivo_sms_settings_form" method="post">
			<div class="row">
				<label class="col-md-7"><?php if(isset($rzvy_translangArr['plivo_sms_gateway_status'])){ echo $rzvy_translangArr['plivo_sms_gateway_status']; }else{ echo $rzvy_defaultlang['plivo_sms_gateway_status']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_plivo_sms_status" id="rzvy_plivo_sms_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_plivo_sms_status")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="rzvy_plivo_account_SID"><?php if(isset($rzvy_translangArr['account_sid'])){ echo $rzvy_translangArr['account_sid']; }else{ echo $rzvy_defaultlang['account_sid']; } ?></label>
				<input class="form-control" id="rzvy_plivo_account_SID" name="rzvy_plivo_account_SID" type="text" value="<?php echo $obj_settings->get_option("rzvy_plivo_account_SID"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_plivo_auth_token"><?php if(isset($rzvy_translangArr['auth_token'])){ echo $rzvy_translangArr['auth_token']; }else{ echo $rzvy_defaultlang['auth_token']; } ?></label>
				<input class="form-control" id="rzvy_plivo_auth_token" name="rzvy_plivo_auth_token" type="text" value="<?php echo $obj_settings->get_option("rzvy_plivo_auth_token"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_plivo_sender_number"><?php if(isset($rzvy_translangArr['plivo_sender_number'])){ echo $rzvy_translangArr['plivo_sender_number']; }else{ echo $rzvy_defaultlang['plivo_sender_number']; } ?></label>
				<input class="form-control" id="rzvy_plivo_sender_number" name="rzvy_plivo_sender_number" type="text" placeholder="e.g. 7513842981" value="<?php echo $obj_settings->get_option("rzvy_plivo_sender_number"); ?>" />
			</div>
		</form>
		<?php 
	}
	else if($_POST['get_sms_settings'] == "3"){ 
		?>
		<form name="rzvy_nexmo_sms_settings_form" id="rzvy_nexmo_sms_settings_form" method="post">
			<div class="row">
				<label class="col-md-7"><?php if(isset($rzvy_translangArr['nexmo_sms_gateway_status'])){ echo $rzvy_translangArr['nexmo_sms_gateway_status']; }else{ echo $rzvy_defaultlang['nexmo_sms_gateway_status']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_nexmo_sms_status" id="rzvy_nexmo_sms_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_nexmo_sms_status")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="rzvy_nexmo_api_key"><?php if(isset($rzvy_translangArr['api_key'])){ echo $rzvy_translangArr['api_key']; }else{ echo $rzvy_defaultlang['api_key']; } ?></label>
				<input class="form-control" id="rzvy_nexmo_api_key" name="rzvy_nexmo_api_key" type="text" value="<?php echo $obj_settings->get_option("rzvy_nexmo_api_key"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_nexmo_api_secret"><?php if(isset($rzvy_translangArr['api_secret'])){ echo $rzvy_translangArr['api_secret']; }else{ echo $rzvy_defaultlang['api_secret']; } ?></label>
				<input class="form-control" id="rzvy_nexmo_api_secret" name="rzvy_nexmo_api_secret" type="text" value="<?php echo $obj_settings->get_option("rzvy_nexmo_api_secret"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_nexmo_from"><?php if(isset($rzvy_translangArr['nexmo_from'])){ echo $rzvy_translangArr['nexmo_from']; }else{ echo $rzvy_defaultlang['nexmo_from']; } ?></label>
				<input class="form-control" id="rzvy_nexmo_from" name="rzvy_nexmo_from" type="text" placeholder="e.g. NEXMO" value="<?php echo $obj_settings->get_option("rzvy_nexmo_from"); ?>" />
			</div>
		</form>
		<?php 
	}
	else if($_POST['get_sms_settings'] == "4"){ 
		?>
		<form name="rzvy_textlocal_sms_settings_form" id="rzvy_textlocal_sms_settings_form" method="post">
			<div class="row">
				<label class="col-md-7"><?php if(isset($rzvy_translangArr['textlocal_sms_gateway_status'])){ echo $rzvy_translangArr['textlocal_sms_gateway_status']; }else{ echo $rzvy_defaultlang['textlocal_sms_gateway_status']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_textlocal_sms_status" id="rzvy_textlocal_sms_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_textlocal_sms_status")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="form-group">
				<label for="rzvy_textlocal_api_key"><?php if(isset($rzvy_translangArr['api_key'])){ echo $rzvy_translangArr['api_key']; }else{ echo $rzvy_defaultlang['api_key']; } ?></label>
				<input class="form-control" id="rzvy_textlocal_api_key" name="rzvy_textlocal_api_key" type="text" value="<?php echo $obj_settings->get_option("rzvy_textlocal_api_key"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_textlocal_sender"><?php if(isset($rzvy_translangArr['textlocal_sender'])){ echo $rzvy_translangArr['textlocal_sender']; }else{ echo $rzvy_defaultlang['textlocal_sender']; } ?></label>
				<input class="form-control" id="rzvy_textlocal_sender" name="rzvy_textlocal_sender" type="text" placeholder="e.g. TXTLCL" value="<?php echo $obj_settings->get_option("rzvy_textlocal_sender"); ?>" />
			</div>
			<div class="form-group">
				<label for="rzvy_textlocal_country"><?php if(isset($rzvy_translangArr['textlocal_country'])){ echo $rzvy_translangArr['textlocal_country']; }else{ echo $rzvy_defaultlang['textlocal_country']; } ?></label>
				<?php $rzvy_textlocal_country = $obj_settings->get_option('rzvy_textlocal_country'); ?>
				<select name="rzvy_textlocal_country" id="rzvy_textlocal_country" class="form-control">
					<optgroup label="Europe">
						<option <?php if($rzvy_textlocal_country == 'Denmark'){ echo "selected"; } ?> value="Denmark">Denmark (English)</option>
						<option <?php if($rzvy_textlocal_country == 'Finland'){ echo "selected"; } ?> value="Finland">Finland (English)</option>
						<option <?php if($rzvy_textlocal_country == 'France'){ echo "selected"; } ?> value="France">France (English)</option>
						<option <?php if($rzvy_textlocal_country == 'Germany'){ echo "selected"; } ?> value="Germany">Germany (English)</option>
						<option <?php if($rzvy_textlocal_country == 'Iceland'){ echo "selected"; } ?> value="Iceland">Iceland (English)</option>
						<option <?php if($rzvy_textlocal_country == 'Ireland'){ echo "selected"; } ?> value="Ireland">Ireland (English)</option>
						<option <?php if($rzvy_textlocal_country == 'Italy'){ echo "selected"; } ?> value="Italy">Italy (English)</option>
						<option <?php if($rzvy_textlocal_country == 'Netherlands'){ echo "selected"; } ?> value="Netherlands">Netherlands (English)</option>
						<option <?php if($rzvy_textlocal_country == 'Norway'){ echo "selected"; } ?> value="Norway">Norway (English)</option>
						<option <?php if($rzvy_textlocal_country == 'Portugal'){ echo "selected"; } ?> value="Portugal">Portugal (English)</option>
						<option <?php if($rzvy_textlocal_country == 'Espana'){ echo "selected"; } ?> value="Espana">Espana (Espanol)</option>
						<option <?php if($rzvy_textlocal_country == 'Sweden'){ echo "selected"; } ?> value="Sweden">Sweden (English)</option>
						<option <?php if($rzvy_textlocal_country == 'UnitedKingdom'){ echo "selected"; } ?> value="UnitedKingdom">United Kingdom (English)</option>
					</optgroup>
					<optgroup label="Asia">
						<option <?php if($rzvy_textlocal_country == 'India'){ echo "selected"; } ?> value="India">India</option>
					</optgroup>
				</select>
			</div>
		</form>
		<?php 
	}
}