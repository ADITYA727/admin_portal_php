<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_manual_booking.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */
$obj_frontend = new rzvy_manual_booking();
$obj_frontend->conn = $conn;

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');

/* pay at venue appointment ajax */
if(isset($_POST['pay_at_venue_appointment'])){
	$rzvy_location_selector_status = $obj_settings->get_option("rzvy_location_selector_status"); 
	if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
		$zip = "N/A";
	}else{
		$zip = $_POST["zip"];
	}
	$payment_method = $_POST['payment_method'];
	$cust_arr = array();
	$cust_arr['email'] = $_POST['email'];
	$cust_arr['password'] = $_POST['password'];
	$cust_arr['firstname'] = $_POST['firstname'];
	$cust_arr['lastname'] = $_POST['lastname'];
	$cust_arr['zip'] = $zip;
	$cust_arr['phone'] = $_POST['phone'];
	$cust_arr['address'] = $_POST['address'];
	$cust_arr['city'] = $_POST['city'];
	$cust_arr['state'] = $_POST['state'];
	$cust_arr['country'] = $_POST['country'];
	$cust_arr['customertype'] = $_POST['type'];
	$cust_arr['payment_method'] = $payment_method;
	
	$_SESSION['rzvy_mb_customer_detail'] = $cust_arr;
	
	$_SESSION['mb_customer_id'] = $_POST['customer_id'];
	$_SESSION['mb_transaction_id'] = '';
	header('location:'.AJAX_URL.'rzvy_mb_front_appt_process_ajax.php');
	exit(0);
}