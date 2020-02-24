<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_admins.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_schedule.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_frequently_discount.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_templates.php");

/* Create object of classes */

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$obj_admins = new rzvy_admins();
$obj_admins->conn = $conn;

$obj_schedule = new rzvy_schedule();
$obj_schedule->conn = $conn;

$obj_frequently_discount = new rzvy_frequently_discount();
$obj_frequently_discount->conn = $conn;

$obj_templates = new rzvy_templates();
$obj_templates->conn = $conn;

/** Admin Setup Ajax **/
if(isset($_POST['adminsetup_settings'])){
	/** Check admin exist **/
	$obj_admins->email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
	$check_admin = $obj_admins->check_admin();
	
	if(mysqli_num_rows($check_admin)==0){
		/** add admin **/
		$obj_admins->email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
		$obj_admins->password = md5($_POST['password']);
		$obj_admins->firstname = htmlentities($_POST['firstname']);
		$obj_admins->lastname = htmlentities($_POST['lastname']);
		$obj_admins->phone = $_POST['phone'];
		$obj_admins->address = htmlentities($_POST['address']);
		$obj_admins->city = htmlentities($_POST['city']);
		$obj_admins->state = htmlentities($_POST['state']);
		$obj_admins->country = htmlentities($_POST['country']);
		$obj_admins->zip = htmlentities($_POST['zip']);
		$obj_admins->image = "";
		$obj_admins->status = "Y";
		$admin_id = $obj_admins->add_admin();
		
		if(is_numeric($admin_id)){				
			/** add default frequently discount **/
			$obj_frequently_discount->add_default_frequently_discount();
				
			/** add default schedule **/
			$obj_schedule->add_default_schedule();
			
			/** add default settings **/
			$companyname = htmlentities($_POST['companyname']);
			$companyemail = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['companyemail'])));
			$companyphone = $_POST['companyphone'];
			$companyaddress = htmlentities($_POST['address']);
			$companycity = htmlentities($_POST['city']);
			$companystate = htmlentities($_POST['state']);
			$companyzip = htmlentities($_POST['zip']);
			$companycountry = htmlentities($_POST['country']);
			
			$rzvy_cs_admin_dash = "default";
			$rzvy_cs_admin_dash_primary_color = "";
			$rzvy_cs_admin_dash_secondary_color = "";
			$rzvy_cs_admin_dash_background_color = "";
			$rzvy_cs_admin_dash_text_color = "";
			$rzvy_cs_bfls = "default";
			$rzvy_cs_bfls_primary_color = "";
			$rzvy_cs_bfls_secondary_color = "";
			$rzvy_cs_bfls_background_color = "";
			$rzvy_cs_bfls_text_color = "";
			
			$settings_added = $obj_settings->add_default_settings(SITE_URL, $companyname, $companyemail, $companyphone, $companyaddress, $companycity, $companystate, $companyzip, $companycountry, $rzvy_cs_admin_dash ,$rzvy_cs_admin_dash_primary_color ,$rzvy_cs_admin_dash_secondary_color ,$rzvy_cs_admin_dash_background_color ,$rzvy_cs_admin_dash_text_color ,$rzvy_cs_bfls ,$rzvy_cs_bfls_primary_color ,$rzvy_cs_bfls_secondary_color ,$rzvy_cs_bfls_background_color ,$rzvy_cs_bfls_text_color);
			
			if($settings_added){
				/** add default templates **/
				$obj_templates->add_default_email_sms_templates();
				echo "configured";
			}
		}
	}else{
		$obj_admins->email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
		$obj_admins->update_admin_status();
		echo "configured";
	}
}