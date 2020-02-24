<?php 
session_start();
/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_login.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */
$obj_login = new rzvy_login();
$obj_login->conn = $conn;
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

/* Login process ajax */
if(isset($_POST['login_process'])){
	$obj_login->email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
	$obj_login->password = $_POST['password'];
	$obj_login->remember_me = $_POST['remember_me'];
	
	/* Function to check login details */
	$obj_login->login_process();
}

/* Logout process ajax */
else if(isset($_POST['logout_process'])){
	session_destroy();
}

/* Reset password process ajax */
else if(isset($_POST['reset_password'])){
	$email = trim(strip_tags(mysqli_real_escape_string($conn, $_SESSION["rzvy_rp_cemail"])));
	$obj_login->email = $email;
	$obj_login->password = md5($_POST["password"]);
	$reset = $obj_login->reset_password();
	if($reset){		
		$existing_email_check = $obj_login->existing_email_check();
		if(mysqli_num_rows($existing_email_check)>0){
			$val = mysqli_fetch_array($existing_email_check);
			
			/********************** Send SMS & Email code start ***************************/
			$es_firstname = $val['firstname'];
			$es_lastname = $val['lastname'];
			$es_email = $email;
			$es_phone = $val['phone'];
			$es_reset_password_link = "";
			$es_template = "reset_password";
			include("rzvy_send_sms_email_process.php");
			/********************** Send SMS & Email code END ****************************/
		}
		echo 'reset';
	}
}

/* Forgot password ajax */
else if(isset($_POST['forgot_password'])){
	$email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
	$obj_login->email = $email;
	$existing_email_check = $obj_login->existing_email_check();
	if(mysqli_num_rows($existing_email_check)>0){
		$val = mysqli_fetch_array($existing_email_check);
		$userID = $email;
		$currentTime = date('Y-m-d H:i:s');
		$ency_code = base64_encode(base64_encode($userID) . '#####' . strtotime("+120 minutes", strtotime($currentTime)));
		
		/********************** Send SMS & Email code start ***************************/
		$es_firstname = $val['firstname'];
		$es_lastname = $val['lastname'];
		$es_email = $email;
		$es_phone = $val['phone'];
		$es_reset_password_link = SITE_URL.'backend/reset-password.php?code='.$ency_code;
		$es_template = "forgot_password";
		include("rzvy_send_sms_email_process.php");
		/********************** Send SMS & Email code END ****************************/
		
		echo 'mailsent';
	}
}