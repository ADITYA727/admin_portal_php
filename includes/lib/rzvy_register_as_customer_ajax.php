<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_frontend.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */
$obj_frontend = new rzvy_frontend();
$obj_frontend->conn = $conn;

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

/** register customer ajax **/
if(isset($_POST["customer_register"])){
	$obj_frontend->email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
	$obj_frontend->password = md5($_POST['password']);
	$obj_frontend->firstname = htmlentities($_POST['firstname']);
	$obj_frontend->lastname = htmlentities($_POST['lastname']);
	$obj_frontend->phone = $_POST['phone'];
	$obj_frontend->address = htmlentities($_POST['address']);
	$obj_frontend->city = htmlentities($_POST['city']);
	$obj_frontend->state = htmlentities($_POST['state']);
	$obj_frontend->country = htmlentities($_POST['country']);
	$obj_frontend->zip = htmlentities($_POST['zip']);
	$customer_id = $obj_frontend->add_customers();
	if(is_numeric($customer_id)){
		/* Set session values for logged in customer */
		unset($_SESSION['staff_id']);
		unset($_SESSION['admin_id']);
		$_SESSION['customer_id'] = $customer_id;
		$_SESSION['login_type'] = "customer";
		echo "registered";
	}
}