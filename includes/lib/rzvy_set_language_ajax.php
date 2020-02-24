<?php 
session_start();
/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

/* Set selected language ajax */
if(isset($_POST['set_sarzy_selected_lang'])){ 
	$selected_lang = $_POST["lang"];
	if(file_exists(dirname(dirname(dirname(__FILE__))).'/uploads/languages/rzvy-'.$selected_lang.'.php')){
		setcookie('rzvy_language',$selected_lang, time() + (86400 * 30), "/");
	}
}	

/* Set selected language ajax */
else if(isset($_POST['set_rzvy_selected_lang'])){ 
	$selected_lang = $_POST["lang"];
	if(file_exists(dirname(dirname(dirname(__FILE__))).'/uploads/languages/rzvy-'.$selected_lang.'.php')){ 
		setcookie('rzvy_language',$selected_lang, time() + (86400 * 30), "/");
	}
}	