<?php 
include(dirname(__FILE__)."/constants.php"); 
$obj_database->check_admin_setup_detail($conn);

/* Include class files */
include(dirname(__FILE__)."/classes/class_frontend.php");
include(dirname(__FILE__)."/classes/class_settings.php");

/* Create object of classes */
$obj_frontend = new rzvy_frontend();
$obj_frontend->conn = $conn; 

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$saiframe = '';
if(isset($_GET['if'])){
	$saiframe = '?if=y';  
}

$show_location_selector = "N";
if(!isset($_SESSION["rzvy_location_selector_zipcode"])){
	$show_location_selector = "Y";
}else if($_SESSION["rzvy_location_selector_zipcode"] == ""){
	$show_location_selector = "Y";
}

$_SESSION['rzvy_customer_detail'] = array();
$_SESSION['rzvy_cart_items'] = array();
$_SESSION['rzvy_cart_category_id'] = "";
$_SESSION['rzvy_cart_service_id'] = "";
$_SESSION['rzvy_cart_service_price'] = 0;
$_SESSION['rzvy_cart_datetime'] = "";
$_SESSION['rzvy_cart_end_datetime'] = "";
$_SESSION['rzvy_cart_freqdiscount_label'] = "";
$_SESSION['rzvy_cart_freqdiscount_key'] = "";
$_SESSION['rzvy_cart_freqdiscount_id'] = "";
$_SESSION['rzvy_cart_subtotal'] = 0;
$_SESSION['rzvy_cart_freqdiscount'] = 0;
$_SESSION['rzvy_cart_coupondiscount'] = 0;
$_SESSION['rzvy_cart_couponid'] = "";
$_SESSION['rzvy_cart_tax'] = 0;
$_SESSION['rzvy_cart_nettotal'] = 0;
$_SESSION['rzvy_referral_discount_amount'] = 0;
$_SESSION['rzvy_applied_ref_customer_id'] = "";
$_SESSION['rzvy_ref_customer_id'] = "";
$_SESSION['rzvy_staff_id'] = "";

/* check location selector status */
$rzvy_location_selector_status = $obj_settings->get_option("rzvy_location_selector_status"); 
if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
	$show_location_selector = "N";
	$_SESSION['rzvy_location_selector_zipcode'] = "N/A";
} 
if(isset($_SESSION["rzvy_location_selector_zipcode"])){
	if($rzvy_location_selector_status == "Y" && ($_SESSION["rzvy_location_selector_zipcode"]=="" && $_SESSION["rzvy_location_selector_zipcode"]!="N/A")){
		$show_location_selector = "Y";
		$_SESSION['rzvy_location_selector_zipcode'] = "";
	}
}

/** zipcode checker **/
if(isset($_SESSION["rzvy_location_selector_zipcode"])){
	if($_SESSION['rzvy_location_selector_zipcode'] != "N/A"){
		$selector_zipcode = $_SESSION["rzvy_location_selector_zipcode"];
		$rzvy_location_selector = $obj_settings->get_option('rzvy_location_selector');
		$exploded_rzvy_location_selector = explode(",", $rzvy_location_selector);
		
		$j=0;
		for($i=0;$i<sizeof($exploded_rzvy_location_selector);$i++){
			if(strtolower($exploded_rzvy_location_selector[$i]) == strtolower($selector_zipcode)){
				$j++;
			}
		}
		if($j==0){
			$show_location_selector = "Y";
		}
	}
}
$all_categories = $obj_frontend->get_all_categories(); 

/** get form fields options **/
$rzvy_en_ff_firstname_status = $obj_settings->get_option('rzvy_en_ff_firstname_status');
$rzvy_en_ff_lastname_status = $obj_settings->get_option('rzvy_en_ff_lastname_status');
$rzvy_en_ff_phone_status = $obj_settings->get_option('rzvy_en_ff_phone_status');
$rzvy_en_ff_address_status = $obj_settings->get_option('rzvy_en_ff_address_status');
$rzvy_en_ff_city_status = $obj_settings->get_option('rzvy_en_ff_city_status');
$rzvy_en_ff_state_status = $obj_settings->get_option('rzvy_en_ff_state_status');
$rzvy_en_ff_country_status = $obj_settings->get_option('rzvy_en_ff_country_status');

$rzvy_g_ff_firstname_status = $obj_settings->get_option('rzvy_g_ff_firstname_status');
$rzvy_g_ff_lastname_status = $obj_settings->get_option('rzvy_g_ff_lastname_status');
$rzvy_g_ff_phone_status = $obj_settings->get_option('rzvy_g_ff_phone_status');
$rzvy_g_ff_address_status = $obj_settings->get_option('rzvy_g_ff_address_status');
$rzvy_g_ff_city_status = $obj_settings->get_option('rzvy_g_ff_city_status');
$rzvy_g_ff_state_status = $obj_settings->get_option('rzvy_g_ff_state_status');
$rzvy_g_ff_country_status = $obj_settings->get_option('rzvy_g_ff_country_status');

/** get form fields required options **/
$rzvy_en_ff_firstname_optional = $obj_settings->get_option('rzvy_en_ff_firstname_optional');
$rzvy_en_ff_lastname_optional = $obj_settings->get_option('rzvy_en_ff_lastname_optional');
$rzvy_en_ff_phone_optional = $obj_settings->get_option('rzvy_en_ff_phone_optional');
$rzvy_en_ff_address_optional = $obj_settings->get_option('rzvy_en_ff_address_optional');
$rzvy_en_ff_city_optional = $obj_settings->get_option('rzvy_en_ff_city_optional');
$rzvy_en_ff_state_optional = $obj_settings->get_option('rzvy_en_ff_state_optional');
$rzvy_en_ff_country_optional = $obj_settings->get_option('rzvy_en_ff_country_optional');

$rzvy_g_ff_firstname_optional = $obj_settings->get_option('rzvy_g_ff_firstname_optional');
$rzvy_g_ff_lastname_optional = $obj_settings->get_option('rzvy_g_ff_lastname_optional');
$rzvy_g_ff_phone_optional = $obj_settings->get_option('rzvy_g_ff_phone_optional');
$rzvy_g_ff_address_optional = $obj_settings->get_option('rzvy_g_ff_address_optional');
$rzvy_g_ff_city_optional = $obj_settings->get_option('rzvy_g_ff_city_optional');
$rzvy_g_ff_state_optional = $obj_settings->get_option('rzvy_g_ff_state_optional');
$rzvy_g_ff_country_optional = $obj_settings->get_option('rzvy_g_ff_country_optional'); 

/* Check Zip Codes */
$rzvy_location_selector = $obj_settings->get_option('rzvy_location_selector');
$exploded_rzvy_location_selector = explode(",", $rzvy_location_selector);

$rzvy_frontend = $obj_settings->get_option("rzvy_frontend");
if($rzvy_frontend == "stepview"){
	include(dirname(__FILE__)."/stepview.php");
}else{
	include(dirname(__FILE__)."/onepage.php");
}