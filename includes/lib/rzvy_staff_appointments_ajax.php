<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_bookings.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;
$obj_bookings = new rzvy_bookings();
$obj_bookings->conn = $conn;

$rzvy_currency_symbol = $obj_settings->get_option('rzvy_currency_symbol');
$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');

$appointments = array();
$obj_bookings->staff_id = $_SESSION["staff_id"];
$all_appointments = $obj_bookings->get_all_staff_appointments();

if(isset($rzvy_translangArr['pending'])){ $label_pending = $rzvy_translangArr['pending']; }else{ $label_pending = $rzvy_defaultlang['pending']; }
if(isset($rzvy_translangArr['confirmed_by_you'])){ $label_confirmed_by_you = $rzvy_translangArr['confirmed_by_you']; }else{ $label_confirmed_by_you = $rzvy_defaultlang['confirmed_by_you']; }
if(isset($rzvy_translangArr['confirmed_by_admin'])){ $label_confirmed_by_admin = $rzvy_translangArr['confirmed_by_admin']; }else{ $label_confirmed_by_admin = $rzvy_defaultlang['confirmed_by_admin']; }
if(isset($rzvy_translangArr['rescheduled_by_customer'])){ $label_rescheduled_by_customer = $rzvy_translangArr['rescheduled_by_customer']; }else{ $label_rescheduled_by_customer = $rzvy_defaultlang['rescheduled_by_customer']; }
if(isset($rzvy_translangArr['rescheduled_by_you'])){ $label_rescheduled_by_you = $rzvy_translangArr['rescheduled_by_you']; }else{ $label_rescheduled_by_you = $rzvy_defaultlang['rescheduled_by_you']; }
if(isset($rzvy_translangArr['rescheduled_by_admin'])){ $label_rescheduled_by_admin = $rzvy_translangArr['rescheduled_by_admin']; }else{ $label_rescheduled_by_admin = $rzvy_defaultlang['rescheduled_by_admin']; }
if(isset($rzvy_translangArr['cancelled_by_customer'])){ $label_cancelled_by_customer = $rzvy_translangArr['cancelled_by_customer']; }else{ $label_cancelled_by_customer = $rzvy_defaultlang['cancelled_by_customer']; }
if(isset($rzvy_translangArr['rejected_by_you'])){ $label_rejected_by_you = $rzvy_translangArr['rejected_by_you']; }else{ $label_rejected_by_you = $rzvy_defaultlang['rejected_by_you']; }
if(isset($rzvy_translangArr['rejected_by_admin'])){ $label_rejected_by_admin = $rzvy_translangArr['rejected_by_admin']; }else{ $label_rejected_by_admin = $rzvy_defaultlang['rejected_by_admin']; }
if(isset($rzvy_translangArr['completed'])){ $label_completed = $rzvy_translangArr['completed']; }else{ $label_completed = $rzvy_defaultlang['completed']; }
if(isset($rzvy_translangArr['rating_pending'])){ $label_rating_pending = $rzvy_translangArr['rating_pending']; }else{ $label_rating_pending = $rzvy_defaultlang['rating_pending']; }

$status_array = array(
	'pending' => array(
		"status" => $label_pending,
		"icon" => '<i class="fa fa-info-circle" title="'.$label_pending.'"></i>',
		"color" => '#1589FF'
	),
	'confirmed' => array(
		"status" => $label_confirmed_by_admin,
		"icon" => '<i class="fa fa-check" title="'.$label_confirmed_by_admin.'"></i>',
		"color" => 'green'
	),
	'confirmed_by_staff' => array(
		"status" => $label_confirmed_by_you,
		"icon" => '<i class="fa fa-check" title="'.$label_confirmed_by_you.'"></i>',
		"color" => 'green'
	),
	'rescheduled_by_customer' => array(
		"status" => $label_rescheduled_by_customer,
		"icon" => '<i class="fa fa-refresh" title="'.$label_rescheduled_by_customer.'"></i>',
		"color" => '#04B4AE'
	),
	'rescheduled_by_you' => array(
		"status" => $label_rescheduled_by_admin,
		"icon" => '<i class="fa fa-repeat" title="'.$label_rescheduled_by_admin.'"></i>',
		"color" => '#6960EC'
	),
	'rescheduled_by_staff' => array(
		"status" => $label_rescheduled_by_you,
		"icon" => '<i class="fa fa-repeat" title="'.$label_rescheduled_by_you.'"></i>',
		"color" => '#6960EC'
	),
	'cancelled_by_customer' => array(
		"status" => $label_cancelled_by_customer,
		"icon" => '<i class="fa fa-close" title="'.$label_cancelled_by_customer.'"></i>',
		"color" => '#FF4500'
	),
	'rejected_by_you' => array(
		"status" => $label_rejected_by_admin,
		"icon" => '<i class="fa fa-ban" title="'.$label_rejected_by_admin.'"></i>',
		"color" => '#F70D1A'
	),
	'rejected_by_staff' => array(
		"status" => $label_rejected_by_you,
		"icon" => '<i class="fa fa-ban" title="'.$label_rejected_by_you.'"></i>',
		"color" => '#F70D1A'
	),
	'completed' => array(
		"status" => $label_completed,
		"icon" => '<i class="fa fa-calendar-check-o" title="'.$label_completed.'"></i>',
		"color" => '#b7950b'
	)
);
while($appointment = mysqli_fetch_array($all_appointments)){
	$obj_bookings->staff_id = $appointment['staff_id'];
	$get_staffname = $obj_bookings->readone_staff();
	$staff_name = " with ".ucwords($get_staffname['firstname']." ".$get_staffname['lastname']);

	$customer_name = ucwords($appointment['c_firstname']." ".$appointment['c_lastname']);
	if($customer_name != "" && $customer_name != " "){
		$cnames = $customer_name." for ";
	}else{
		$cnames = "";
	}

	$event_title = $cnames.$appointment['title']." ".$staff_name." on ".date($rzvy_time_format, strtotime($appointment['booking_datetime']))." to ".date($rzvy_time_format, strtotime($appointment['booking_end_datetime']));
	
	$get_feedback = $obj_bookings->get_appointment_rating($appointment['order_id']);
	$ratings = "";
	if(mysqli_num_rows($get_feedback)>0){
		$feedback = mysqli_fetch_array($get_feedback);
		if($feedback['rating']>0){
			for($star_i=0;$star_i<$feedback['rating'];$star_i++){ 
				$ratings .= '<i class="fa fa-star" aria-hidden="true"></i>';
			} 
			for($star_j=0;$star_j<(5-$feedback['rating']);$star_j++){ 
				$ratings .= '<i class="fa fa-star-o" aria-hidden="true"></i>';
			} 
		}else{ 
			$ratings .= '<i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i>';
		} 
	}else{
		$ratings .= '<i class="fa fa-star-o" aria-hidden="true"></i> Rating pending';
	} 
	
	$appointment_array = array(
		  "id" => $appointment['order_id'],
		  "cat_name" => $appointment['cat_name'],
		  "title" => $event_title,
		  "start" => $appointment['booking_datetime'],
		  "end" => $appointment['booking_end_datetime'],
		  "customer_name" => $customer_name,
		  "customer_phone" => $appointment['c_phone'],
		  "customer_email" => $appointment['c_email'],
		  "event_status" => $status_array[$appointment['booking_status']]['status'],
		  "event_icon" => $status_array[$appointment['booking_status']]['icon'],
		  "color" => $status_array[$appointment['booking_status']]['color'],
		  "rating" => $ratings
	);
	array_push($appointments,$appointment_array);
}
echo json_encode($appointments);