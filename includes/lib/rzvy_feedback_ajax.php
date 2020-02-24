<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_feedback.php");

/* Create object of classes */
$obj_feedback = new rzvy_feedback();
$obj_feedback->conn = $conn;

/* Update feedback status ajax */
if(isset($_POST['change_feedback_status'])){
	$obj_feedback->id = $_POST['id'];
	$obj_feedback->status = $_POST['status'];
	$feedback_updated = $obj_feedback->change_feedback_status();
	if($feedback_updated){
		echo "updated";
	}else{
		echo "failed";
	}
}