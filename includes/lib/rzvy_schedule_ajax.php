<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_schedule.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;
$obj_schedule = new rzvy_schedule();
$obj_schedule->conn = $conn;

/* Change schedule offday ajax */
if(isset($_POST['change_schedule_offday'])){
	$obj_schedule->id = $_POST['id'];
	$obj_schedule->offday = $_POST['offday'];
	$status_changed = $obj_schedule->change_offday_status();
	if($status_changed){
		echo "changed";
	}else{
		echo "failed";
	}
}

/* Update Schedule start time ajax */
else if(isset($_POST['update_schedule_starttime'])){
	$obj_schedule->id = $_POST['id'];
	$obj_schedule->starttime = $_POST['starttime'];
	$updated = $obj_schedule->update_schedule_starttime();
	if($updated){
		echo "updated";
	}else{
		echo "failed";
	}
}

/* Update Schedule end time ajax */
else if(isset($_POST['update_schedule_endtime'])){
	$obj_schedule->id = $_POST['id'];
	$obj_schedule->endtime = $_POST['endtime'];
	$updated = $obj_schedule->update_schedule_endtime();
	if($updated){
		echo "updated";
	}else{
		echo "failed";
	}
}