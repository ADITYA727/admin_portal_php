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
$datetime_format = $rzvy_date_format." ".$rzvy_time_format;

if(isset($rzvy_translangArr['pending'])){ $label_pending = $rzvy_translangArr['pending']; }else{ $label_pending = $rzvy_defaultlang['pending']; }
if(isset($rzvy_translangArr['confirmed_by_you'])){ $label_confirmed = $rzvy_translangArr['confirmed_by_you']; }else{ $label_confirmed = $rzvy_defaultlang['confirmed_by_you']; }
if(isset($rzvy_translangArr['confirmed_by_staff'])){ $label_confirmed_by_staff = $rzvy_translangArr['confirmed_by_staff']; }else{ $label_confirmed_by_staff = $rzvy_defaultlang['confirmed_by_staff']; }
if(isset($rzvy_translangArr['rescheduled_by_customer'])){ $label_rescheduled_by_customer = $rzvy_translangArr['rescheduled_by_customer']; }else{ $label_rescheduled_by_customer = $rzvy_defaultlang['rescheduled_by_customer']; }
if(isset($rzvy_translangArr['rescheduled_by_you'])){ $label_rescheduled_by_you = $rzvy_translangArr['rescheduled_by_you']; }else{ $label_rescheduled_by_you = $rzvy_defaultlang['rescheduled_by_you']; }
if(isset($rzvy_translangArr['rescheduled_by_staff'])){ $label_rescheduled_by_staff = $rzvy_translangArr['rescheduled_by_staff']; }else{ $label_rescheduled_by_staff = $rzvy_defaultlang['rescheduled_by_staff']; }
if(isset($rzvy_translangArr['cancelled_by_customer'])){ $label_cancelled_by_customer = $rzvy_translangArr['cancelled_by_customer']; }else{ $label_cancelled_by_customer = $rzvy_defaultlang['cancelled_by_customer']; }
if(isset($rzvy_translangArr['rejected_by_you'])){ $label_rejected_by_you = $rzvy_translangArr['rejected_by_you']; }else{ $label_rejected_by_you = $rzvy_defaultlang['rejected_by_you']; }
if(isset($rzvy_translangArr['rejected_by_staff'])){ $label_rejected_by_staff = $rzvy_translangArr['rejected_by_staff']; }else{ $label_rejected_by_staff = $rzvy_defaultlang['rejected_by_staff']; }
if(isset($rzvy_translangArr['completed'])){ $label_completed = $rzvy_translangArr['completed']; }else{ $label_completed = $rzvy_defaultlang['completed']; }

if(isset($_POST['get_notification_appointment_detail'])){
	?>
	<center><h5 class="dropdown-menu-titles"><?php if(isset($rzvy_translangArr['new_appointments'])){ $label_completed = $rzvy_translangArr['new_appointments']; }else{ $label_completed = $rzvy_defaultlang['new_appointments']; } ?></h5></center>
	<div class="dropdown-divider"></div>
	<?php
	$all_appointments = $obj_bookings->get_all_latest_unread_appointments();
	$status_array = array(
		'pending' => array(
			"status" => $label_pending,
			"icon" => '<i class="fa fa-info-circle" title="'.$label_pending.'"></i> ',
			"class" => 'rzvy_noti_pending'
		),
		'confirmed' => array(
			"status" => $label_confirmed,
			"icon" => '<i class="fa fa-check" title="'.$label_confirmed.'"></i> ',
			"class" => 'rzvy_noti_confirmed'
		),
		'confirmed_by_staff' => array(
			"status" => $label_confirmed_by_staff,
			"icon" => '<i class="fa fa-check" title="'.$label_confirmed_by_staff.'"></i> ',
			"class" => 'rzvy_noti_confirmed'
		),
		'rescheduled_by_customer' => array(
			"status" => $label_rescheduled_by_customer,
			"icon" => '<i class="fa fa-refresh" title="'.$label_rescheduled_by_customer.'"></i> ',
			"class" => 'rzvy_noti_rescheduled_by_customer'
		),
		'rescheduled_by_you' => array(
			"status" => $label_rescheduled_by_you,
			"icon" => '<i class="fa fa-repeat" title="'.$label_rescheduled_by_you.'"></i> ',
			"class" => 'rzvy_noti_rescheduled_by_you'
		),
		'rescheduled_by_staff' => array(
			"status" => $label_rescheduled_by_staff,
			"icon" => '<i class="fa fa-repeat" title="'.$label_rescheduled_by_staff.'"></i> ',
			"class" => 'rzvy_noti_rescheduled_by_you'
		),
		'cancelled_by_customer' => array(
			"status" => $label_cancelled_by_customer,
			"icon" => '<i class="fa fa-close" title="'.$label_cancelled_by_customer.'"></i> ',
			"class" => 'rzvy_noti_cancelled_by_customer'
		),
		'rejected_by_you' => array(
			"status" => $label_rejected_by_you,
			"icon" => '<i class="fa fa-ban" title="'.$label_rejected_by_you.'"></i> ',
			"class" => 'rzvy_noti_rejected_by_you'
		),
		'rejected_by_staff' => array(
			"status" => $label_rejected_by_staff,
			"icon" => '<i class="fa fa-ban" title="'.$label_rejected_by_staff.'"></i> ',
			"class" => 'rzvy_noti_rejected_by_you'
		),
		'completed' => array(
			"status" => $label_completed,
			"icon" => '<i class="fa fa-calendar-check-o" title="'.$label_completed.'"></i> ',
			"class" => 'rzvy_noti_completed'
		)
	);
	if(mysqli_num_rows($all_appointments)>0){
		while($appointment = mysqli_fetch_array($all_appointments)){
			$customer_name = ucwords($appointment['c_firstname']." ".$appointment['c_lastname']);
			$event_title = "<b>".$appointment['cat_name'].":</b> ".$appointment['title']." with ".$customer_name." on <b>".date($datetime_format, strtotime($appointment['booking_datetime']))."</b>";
			?>
			<div class="rzvy-notification-appointment-modal-link" data-id="<?php echo $appointment['order_id']; ?>">
				<div class="row">
					<div class="col-md-12">
						<strong class="<?php echo $status_array[$appointment['booking_status']]['class']; ?>"><?php echo $status_array[$appointment['booking_status']]['icon']; echo $status_array[$appointment['booking_status']]['status']; ?></strong>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<span class="rzvy_noti_deatil"><?php echo $event_title; ?></span>
					</div>
				</div>
			</div>
			<div class="dropdown-divider"></div>
			<?php
		}
	}else{
		?>
		<center><?php if(isset($rzvy_translangArr['opps_you_have_no_unread_notifications'])){ echo $rzvy_translangArr['opps_you_have_no_unread_notifications']; }else{ echo $rzvy_defaultlang['opps_you_have_no_unread_notifications']; } ?></center>
		<div class="dropdown-divider"></div>
		<?php
	}
}
else if(isset($_POST['mark_appointment_as_read'])){
	$obj_bookings->order_id = $_POST['order_id'];
	$updated = $obj_bookings->mark_appointment_as_read();
	if($updated){
		echo "updated";
	}
}