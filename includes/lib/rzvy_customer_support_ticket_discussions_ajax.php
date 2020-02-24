<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_support_ticket_discussions.php");

/* Create object of classes */
$obj_support_ticket_discussions = new rzvy_support_ticket_discussions();
$obj_support_ticket_discussions->conn = $conn;

/* Add ticket discussion reply ajax */
if(isset($_POST['add_ticket_discussion_reply'])){
	$obj_support_ticket_discussions->ticket_id = $_POST['ticket_id'];
	$obj_support_ticket_discussions->replied_by_id = $_SESSION['customer_id'];
	$obj_support_ticket_discussions->reply = htmlentities($_POST['reply']);
	$obj_support_ticket_discussions->replied_on = date("Y-m-d H:i:s");
	$obj_support_ticket_discussions->replied_by = $_SESSION['login_type'];
	$obj_support_ticket_discussions->read_status = "U";
	$added = $obj_support_ticket_discussions->add_ticket_discussion_reply();
	if($added){
		echo "added";
	}else{
		echo "failed";
	}
}