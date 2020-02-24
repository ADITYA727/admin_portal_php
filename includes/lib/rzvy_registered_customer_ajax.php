<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_customers.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */
$obj_customers = new rzvy_customers();
$obj_customers->conn = $conn;
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

/* Refresh Registered customers ajax */
if(isset($_REQUEST['refresh_rc_detail'])){
	$all_rc_detail = $obj_customers->get_all_rc_detail($_POST['start'],($_POST['start']+$_POST['length']), $_POST['search']['value'],$_POST['order'][0]['column'],$_POST['order'][0]['dir'],$_POST['draw']);
	$customers = array();
	$customers["draw"] = $_POST['draw'];
	$count_all_payments = $obj_customers->count_all_rc($_POST['search']['value']);
	if($count_all_payments == "" || $count_all_payments == null){
		$count_all_payments = 0;
	}
	$customers["recordsTotal"] = $count_all_payments;
	$customers["recordsFiltered"] = $count_all_payments;
	$customers['data'] =array();
	if(mysqli_num_rows($all_rc_detail)>0){
		$i=$_POST['start'];
		while($rc = mysqli_fetch_assoc($all_rc_detail)){
			$i++;
			$total_appointments = $obj_customers->count_all_rc_booked_appt($rc['id']);
			$reff_url = $rc['refferral_code'];
			$addr = "";
			if($rc['address'] != ""){
				$addr .= ucwords($rc['address']);
			}
			if($rc['city'] != ""){
				$addr .= ', '.ucwords($rc['city']);
			}
			if($rc['state'] != ""){
				$addr .= ', '.ucwords($rc['state']);
			}
			if($rc['country'] != ""){
				$addr .= ', '.ucwords($rc['country']);
			}
			if($rc['zip'] != "" && $rc['zip'] != "N/A"){
				$addr .= '-'.ucwords($rc['zip']);
			}
			
			if(isset($rzvy_translangArr['booked_appointments'])){ 			
				$appointments_trans = $rzvy_translangArr['appointments']; 			
			}else{ 			
				$appointments_trans =  $rzvy_defaultlang['appointments'];			
			}
			
			
			$rc_arr = array();
			array_push($rc_arr, ucwords($rc['firstname'].' '.$rc['lastname']));
			array_push($rc_arr, $rc['email']);
			array_push($rc_arr, $rc['phone']);
			array_push($rc_arr, $addr);
			array_push($rc_arr, $reff_url);
			array_push($rc_arr, '<a data-ctype="R" data-id="'.$rc['id'].'" class="btn btn-outline-secondary rzvy_customer_appointments_btn"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> '.$appointments_trans.' <span class="badge badge-success">'.$total_appointments.'</span></a>');
			array_push($customers['data'], $rc_arr);
		}
	}
	echo json_encode($customers);
}