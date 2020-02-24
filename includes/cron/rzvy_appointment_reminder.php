<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_appointment_cron.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_es_information.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;
$obj_cron = new rzvy_appointment_cron();
$obj_cron->conn = $conn;
$obj_es_information = new rzvy_es_information();
$obj_es_information->conn = $conn;

$appointments = array();
$rzvy_reminder_buffer_time = $obj_settings->get_option('rzvy_reminder_buffer_time');
$all_appointments = $obj_cron->get_all_business_appointments();

if(mysqli_num_rows($all_appointments)>0){
	while($appointment = mysqli_fetch_assoc($all_appointments)){
		
		$rzvy_settings_timezone = $obj_settings->get_option("rzvy_timezone");
		$rzvy_server_timezone = date_default_timezone_get();
		$currDateTime_withTZ = $obj_settings->get_current_time_according_selected_timezone($rzvy_server_timezone,$rzvy_settings_timezone); 
		
		$booking_datetime = $appointment['booking_datetime'];
		$current_datetime = date("Y-m-d H:i:s", $currDateTime_withTZ);
		$current_buffer_time = date("Y-m-d H:i:s", strtotime("+2880 minutes", strtotime($current_datetime)));
		$booking_buffer_time = date("Y-m-d H:i:s", strtotime("-".$rzvy_reminder_buffer_time." minutes", strtotime($booking_datetime)));
		
		if((strtotime($booking_buffer_time) >= strtotime($current_datetime))){
			if(strtotime($booking_datetime) <= strtotime($current_buffer_time)){
				array_push($appointments,$appointment["order_id"]);
			}
		}
	}
}

/********************** Send SMS & Email code start ***************************/
if(sizeof($appointments)>0){
	foreach($appointments as $order_id){
		$get_es_appt_detail_by_order_id = $obj_es_information->get_es_appt_detail_by_order_id($order_id);
		if(mysqli_num_rows($get_es_appt_detail_by_order_id)>0){
			$es_appt_detail = mysqli_fetch_assoc($get_es_appt_detail_by_order_id);
			$es_staff_id = $es_appt_detail['staff_id'];
			$es_template = "reminder";
			$es_category_id = $es_appt_detail['cat_id'];
			$es_service_id = $es_appt_detail['service_id'];
			$es_booking_datetime = $es_appt_detail['booking_datetime'];
			$es_transaction_id = $es_appt_detail['transaction_id'];
			$es_subtotal = $es_appt_detail['sub_total'];
			$es_coupondiscount = $es_appt_detail['discount'];
			$es_freqdiscount = $es_appt_detail['fd_amount'];
			$es_tax = $es_appt_detail['tax'];
			$es_nettotal = $es_appt_detail['net_total'];
			$es_payment_method = $es_appt_detail['payment_method'];
			$es_firstname = $es_appt_detail['c_firstname'];
			$es_lastname = $es_appt_detail['c_lastname'];
			$es_email = $es_appt_detail['c_email'];
			$es_phone = $es_appt_detail['c_phone'];
			$es_address = $es_appt_detail['c_address'];
			$es_city = $es_appt_detail['c_city'];
			$es_state = $es_appt_detail['c_state'];
			$es_country = $es_appt_detail['c_country'];
			$es_zip = $es_appt_detail['c_zip'];
			$es_addons_items_arr = $es_appt_detail['addons'];
			$es_reschedule_reason = $es_appt_detail['reschedule_reason'];
			$es_reject_reason = $es_appt_detail['reject_reason'];
			$es_cancel_reason = $es_appt_detail['cancel_reason'];
			include(dirname(dirname(__FILE__))."/lib/rzvy_send_sms_email_process.php");
			$obj_cron->change_appointment_reminder_status($order_id);
		}
	}
}
/********************** Send SMS & Email code END ****************************/