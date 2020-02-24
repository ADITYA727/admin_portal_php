<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_refund_request.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */
$obj_refund_request = new rzvy_refund_request();
$obj_refund_request->conn = $conn;

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

if(isset($rzvy_translangArr['pending'])){ $label_pending = $rzvy_translangArr['pending']; }else{ $label_pending = $rzvy_defaultlang['pending']; }
if(isset($rzvy_translangArr['cancelled_by_customer'])){ $label_cancelled_by_customer = $rzvy_translangArr['cancelled_by_customer']; }else{ $label_cancelled_by_customer = $rzvy_defaultlang['cancelled_by_customer']; }
if(isset($rzvy_translangArr['cancelled_by_you'])){ $label_cancelled_by_you = $rzvy_translangArr['cancelled_by_you']; }else{ $label_cancelled_by_you = $rzvy_defaultlang['cancelled_by_you']; }
if(isset($rzvy_translangArr['refunded'])){ $label_refunded = $rzvy_translangArr['refunded']; }else{ $label_refunded = $rzvy_defaultlang['refunded']; }

/* Mark as refunded appointment ajax */
if(isset($_POST['markasrefunded_appointment'])){
	$obj_refund_request->id = $_POST['id'];
	$obj_refund_request->status = "refunded";
	$obj_refund_request->read_status = "U";
	$status_changed = $obj_refund_request->change_refund_request_status();
	if($status_changed){
		echo "changed";
	}else{
		echo "failed";
	}
}

/* cancel refund request ajax */
else if(isset($_POST['cancel_refundrequest'])){
	$obj_refund_request->id = $_POST['id'];
	$obj_refund_request->status = "cancelled_by_admin";
	$obj_refund_request->read_status = "U";
	$status_changed = $obj_refund_request->change_refund_request_status();
	if($status_changed){
		echo "changed";
	}else{
		echo "failed";
	}
}

/** Refund request notifications detail modal content */
else if(isset($_POST['get_refund_request_detail'])){ 
	$rzvy_currency_symbol = $obj_settings->get_option('rzvy_currency_symbol');
	$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
	$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
	$rzvy_datetime_format = $rzvy_date_format." ".$rzvy_time_format; 
	?>
	<center><h5 class="dropdown-menu-titles"><?php if(isset($rzvy_translangArr['new_refund_request'])){ echo $rzvy_translangArr['new_refund_request']; }else{ echo $rzvy_defaultlang['new_refund_request']; } ?></h5></center>
	<div class="dropdown-divider"></div>
	<?php
	$all_refund_request = $obj_refund_request->readall_unread_refund_requests();
	$status_array = array(
		'pending' => array(
			"status" => $label_pending,
			"icon" => '<i class="fa fa-info-circle fa-fw" title="'.$label_pending.'"></i>',
			"class" => 'rzvy_noti_pending'
		),
		'cancelled_by_customer' => array(
			"status" => $label_cancelled_by_customer,
			"icon" => '<i class="fa fa-close fa-fw" title="'.$label_cancelled_by_customer.'"></i>',
			"class" => 'rzvy_noti_cancelled_by_customer'
		),
		'cancelled_by_admin' => array(
			"status" => $label_cancelled_by_you,
			"icon" => '<i class="fa fa-ban fa-fw" title="'.$label_cancelled_by_you.'"></i>',
			"class" => 'rzvy_noti_rejected_by_you'
		),
		'refunded' => array(
			"status" => $label_refunded,
			"icon" => '<i class="fa fa-exchange fa-fw" title="'.$label_refunded.'"></i>',
			"class" => 'text-success'
		)
	);
	if(mysqli_num_rows($all_refund_request)>0){
		while($refundrequest = mysqli_fetch_array($all_refund_request)){
			$appointment = $obj_refund_request->get_appointment_detail_by_order_id($refundrequest["order_id"]);
			$customer_name = ucwords($appointment['c_firstname']." ".$appointment['c_lastname']);			
			if($appointment["booking_status"] == "rejected_by_you" || $appointment["booking_status"] == "rejected_by_staff"){
				$event_title = "<p>You have requested refund for <b>".$customer_name."</b> on <b>".date($rzvy_datetime_format, strtotime($refundrequest["requested_on"]))."</b><br />Refund amount: <b>".$rzvy_currency_symbol.$refundrequest['amount']."</b></p>"; 
			}else{
				$event_title = "<p><b>".$customer_name."</b> raised refund request on <b>".date($rzvy_datetime_format, strtotime($refundrequest["requested_on"]))."</b><br />Refund amount: <b>".$rzvy_currency_symbol.$refundrequest['amount']."</b></p>"; 
			} 
			?>
			<div class="rzvy-notification-refundrequest-modal-link" data-id="<?php echo $refundrequest['id']; ?>">
				<div class="row">
					<div class="col-md-12">
						<strong class="<?php echo $status_array[$refundrequest['status']]['class']; ?>"><?php echo $status_array[$refundrequest['status']]['icon']." ".$status_array[$refundrequest['status']]['status']; ?></strong>
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
		<center><?php if(isset($rzvy_translangArr['opps_you_have_no_unread_refund_request'])){ echo $rzvy_translangArr['opps_you_have_no_unread_refund_request']; }else{ echo $rzvy_defaultlang['opps_you_have_no_unread_refund_request']; } ?></center>
		<div class="dropdown-divider"></div>
		<?php
	}
}

else if(isset($_POST['mark_refund_request_as_read'])){
	$obj_refund_request->id = $_POST['id'];
	$obj_refund_request->read_status = 'R';
	$updated = $obj_refund_request->mark_as_read_refund_request_status();
	if($updated){
		echo "updated";
	}
}