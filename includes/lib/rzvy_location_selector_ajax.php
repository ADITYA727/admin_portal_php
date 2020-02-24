<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

/** check zip location Ajax **/
if(isset($_POST['check_zip_location'])){
	/* check location selector status */
	$rzvy_location_selector_status = $obj_settings->get_option("rzvy_location_selector_status"); 
	if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
		$_SESSION['rzvy_location_selector_zipcode'] = "N/A";
		echo "available";
	}else{
		$zipcode = strtolower(str_replace(' ', '', $_POST["zipcode"]));
		$rzvy_location_selector = strtolower($obj_settings->get_option('rzvy_location_selector'));
		$exploded_rzvy_location_selector = explode(",", $rzvy_location_selector);
		
		$j=0;
		for($i=0;$i<sizeof($exploded_rzvy_location_selector);$i++){
			if(strtolower($exploded_rzvy_location_selector[$i]) == strtolower($zipcode)){
				$j++;
			}
		}
		if($j>0){
			$_SESSION['rzvy_location_selector_zipcode'] = $zipcode;
			echo "available";
		}
	}
}
