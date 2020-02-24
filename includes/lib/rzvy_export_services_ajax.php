<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_categories.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_services.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_addons.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$obj_categories = new rzvy_categories();
$obj_categories->conn = $conn;

$obj_services = new rzvy_services();
$obj_services->conn = $conn;

$obj_addons = new rzvy_addons();
$obj_addons->conn = $conn;

$rzvy_currency_symbol = $obj_settings->get_option('rzvy_currency_symbol');
$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
$export_path = SITE_URL."/uploads/csv/";
$export_abs_path = dirname(dirname(dirname(__FILE__)))."/uploads/csv/";

/** Export customized services ajax  **/
if(isset($_POST["export_services"])){
	/** this condition is to export only all categories **/
	if(isset($_POST['categories']) && !isset($_POST['services']) && !isset($_POST['addons'])){
		$filename = base64_encode("all_categories").".csv";
		$filepath = $export_abs_path.$filename;
		$exported_file = $export_path.$filename;
		$file = fopen($filepath, "w");
		$header = array(
			"#",
			"Category Name",
			"Status"
		);
		fputcsv($file, $header);
		
		foreach($_POST['categories'] as $cat){
			$obj_categories->id = $cat;
			$category = $obj_categories->readone_category();
			if($category['status'] == "Y"){
				$category['status'] = "Activated";
			}else{
				$category['status'] = "Deactivated";
			}
			fputcsv($file, $category);
		}
		
		echo $exported_file;
	}
	
	/** this condition is to export only all services **/
	if(isset($_POST['services']) && !isset($_POST['categories']) && !isset($_POST['addons'])){
		$filename = base64_encode("all_services").".csv";
		$filepath = $export_abs_path.$filename;
		$exported_file = $export_path.$filename;
		$file = fopen($filepath, "w");
		$header = array(
			"#",
			"Category",
			"Service Title",
			"Service Description",
			"Service Rate",
			"Service Duration (in minutes)",
			"Padding Before (in minutes)",
			"Padding After (in minutes)",
			"Status"
		);
		fputcsv($file, $header);
		$is = 1;
		foreach($_POST['services'] as $ser){
			$obj_services->id = $ser;
			$service = $obj_services->readone_service();
			$ser_arr = array();
			$obj_categories->id = $service['cat_id'];
			$category_name = $obj_categories->readone_category_name();
			if($service['status'] == "Y"){
				$service['status'] = "Activated";
			}else{
				$service['status'] = "Deactivated";
			}
			array_push($ser_arr, $is);
			array_push($ser_arr, $category_name);
			array_push($ser_arr, ucwords($service['title']));
			array_push($ser_arr, ucfirst($service['description']));
			array_push($ser_arr, $rzvy_currency_symbol.$service['rate']);
			array_push($ser_arr, $service['duration']);
			array_push($ser_arr, $service['padding_before']);
			array_push($ser_arr, $service['padding_after']);
			array_push($ser_arr, $service['status']);
			fputcsv($file, $ser_arr);
			$is++;
		}
		
		echo $exported_file;
	}
	
	/** this condition is to export only all addons **/
	if(isset($_POST['addons']) && !isset($_POST['services']) && !isset($_POST['categories'])){
		
		$filename = base64_encode("all_addons").".csv";
		$filepath = $export_abs_path.$filename;
		$exported_file = $export_path.$filename;
		$file = fopen($filepath, "w");
		$header = array(
			"#",
			"Category",
			"Service",
			"Addon Title",
			"Addon Rate",
			"Multiple Quantity",
			"Description",
			"Status"
		);
		fputcsv($file, $header);
		
		foreach($_POST['addons'] as $add){
			$obj_addons->id = $add;
			$addons = $obj_addons->export_all_addons();
			if($addons['multiple_qty'] == "Y"){
				$addons['multiple_qty'] = "Yes";
			}else{
				$addons['multiple_qty'] = "No";
			}
			$addons['rate'] = $rzvy_currency_symbol.$addons['rate'];
			if($addons['status'] == "Y"){
				$addons['status'] = "Activated";
			}else{
				$addons['status'] = "Deactivated";
			}
			fputcsv($file, $addons);
		}
		
		echo $exported_file;
	}
	
	/** this condition is to export all categories, services and addons **/
	if(isset($_POST['categories']) && isset($_POST['services']) && isset($_POST['addons'])){
		$filename = base64_encode("export_all").".csv";
		$filepath = $export_abs_path.$filename;
		$exported_file = $export_path.$filename;
		$file = fopen($filepath, "w");
		
		/** Export category **/
		fputcsv($file, array("Categories:"));
		$header_cat = array(
			"#",
			"Category Name",
			"Status"
		);
		fputcsv($file, $header_cat);		
		foreach($_POST['categories'] as $cat){
			$obj_categories->id = $cat;
			$category = $obj_categories->readone_category();
			if($category['status'] == "Y"){
				$category['status'] = "Activated";
			}else{
				$category['status'] = "Deactivated";
			}
			fputcsv($file, $category);
		}
		
		/** Export services **/
		fputcsv($file, array("Services:"));
		$header_ser = array(
			"#",
			"Category",
			"Service Title",
			"Service Description",
			"Service Rate",
			"Service Duration (in minutes)",
			"Padding Before (in minutes)",
			"Padding After (in minutes)",
			"Status"
		);
		fputcsv($file, $header_ser);		
		$is = 1;
		foreach($_POST['services'] as $ser){
			$obj_services->id = $ser;
			$service = $obj_services->readone_service();
			$ser_arr = array();
			$obj_categories->id = $service['cat_id'];
			$category_name = $obj_categories->readone_category_name();
			if($service['status'] == "Y"){
				$service['status'] = "Activated";
			}else{
				$service['status'] = "Deactivated";
			}
			array_push($ser_arr, $is);
			array_push($ser_arr, $category_name);
			array_push($ser_arr, ucwords($service['title']));
			array_push($ser_arr, ucfirst($service['description']));
			array_push($ser_arr, $rzvy_currency_symbol.$service['rate']);
			array_push($ser_arr, $service['duration']);
			array_push($ser_arr, $service['padding_before']);
			array_push($ser_arr, $service['padding_after']);
			array_push($ser_arr, $service['status']);
			fputcsv($file, $ser_arr);
			$is++;
		}
		
		/** Export addons **/
		fputcsv($file, array("Addons:"));
		$header_addon = array(
			"#",
			"Category",
			"Service",
			"Addon Title",
			"Addon Rate",
			"Multiple Quantity",
			"Description",
			"Status"
		);
		fputcsv($file, $header_addon);		
		foreach($_POST['addons'] as $add){
			$obj_addons->id = $add;
			$addons = $obj_addons->export_all_addons();
			if($addons['multiple_qty'] == "Y"){
				$addons['multiple_qty'] = "Yes";
			}else{
				$addons['multiple_qty'] = "No";
			}
			$addons['rate'] = $rzvy_currency_symbol.$addons['rate'];
			if($addons['status'] == "Y"){
				$addons['status'] = "Activated";
			}else{
				$addons['status'] = "Deactivated";
			}
			fputcsv($file, $addons);
		}
		
		echo $exported_file;
	}
}

/** Get services and categories according category selection ajax  **/
else if(isset($_POST["get_services_and_addons"])){
	$service_options = "";
	$addon_options = "";
	foreach($_POST['categories'] as $cat){
		$obj_services->cat_id = $cat;
		$services = $obj_services->get_all_services_according_cat_id();
		while($service = mysqli_fetch_assoc($services)){
			$service_options .= "<option value='".$service['id']."'>".$service['title']."</option>";
			$obj_addons->service_id = $service['id'];
			$addons = $obj_addons->get_all_addons_according_service_id();
			while($addon = mysqli_fetch_assoc($addons)){
				$addon_options .= "<option value='".$addon['id']."'>".$addon['title']."</option>";
			}
		}
	}
	$json_array = array();
	$json_array['service_options'] = $service_options;
	$json_array['addon_options'] = $addon_options;
	echo json_encode($json_array);die;
}

/** Get addons according services selection ajax  **/
else if(isset($_POST["get_addons"])){
	$addon_options = "";
	foreach($_POST['services'] as $ser){
		$obj_addons->service_id = $ser;
		$addons = $obj_addons->get_all_addons_according_service_id();
		while($addon = mysqli_fetch_assoc($addons)){
			$addon_options .= "<option value='".$addon['id']."'>".$addon['title']."</option>";
		}
	}
	$json_array = array();
	$json_array['addon_options'] = $addon_options;
	echo json_encode($json_array);die;
}
