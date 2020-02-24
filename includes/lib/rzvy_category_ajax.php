<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_categories.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_services.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */

$obj_categories = new rzvy_categories();
$obj_categories->conn = $conn;

$obj_services = new rzvy_services();
$obj_services->conn = $conn;

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

/* Change category status ajax */
if(isset($_POST['change_category_status'])){
	$obj_categories->id = $_POST['id'];
	$obj_categories->status = $_POST['category_status'];
	$status_changed = $obj_categories->change_category_status();
	if($status_changed){
		echo "changed";
	}else{
		echo "failed";
	}
}
/* Delete category ajax */
else if(isset($_POST['delete_category'])){
	$obj_categories->id = $_POST['id'];
	$check_appointments = $obj_categories->check_appointments_before_delete_category();
	if($check_appointments==0){
		$deleted = $obj_categories->delete_category();
		if($deleted){
			echo "deleted";
		}else{
			echo "failed";
		}
	}else{
		echo "appointments exist";
	}
}
/* Add category ajax */
else if(isset($_POST['add_category'])){
	$obj_categories->cat_name = htmlentities($_POST['cat_name']);
	$obj_categories->status = $_POST['status'];
	$added = $obj_categories->add_category();
	if($added){
		echo "added";
	}else{
		echo "failed";
	}
}
/* Update category ajax */
else if(isset($_POST['update_category'])){
	$obj_categories->id = $_POST['id'];
	$obj_categories->cat_name = htmlentities($_POST['cat_name']);
	$updated = $obj_categories->update_category();
	if($updated){
		echo "updated";
	}else{
		echo "failed";
	}
}
/* Update category modal detail ajax */
else if(isset($_POST['update_category_modal_detail'])){
	$obj_categories->id = $_POST['id'];
	$category = $obj_categories->readone_category(); 
	?>
	<form name="rzvy_update_category_form" id="rzvy_update_category_form" method="post">
	<input type="hidden" value="<?php echo $category['id'] ?>" id="rzvy_update_categoryid_hidden" />
	  <div class="form-group">
		<label for="rzvy_update_categoryname"><?php if(isset($rzvy_translangArr['category_name'])){ echo $rzvy_translangArr['category_name']; }else{ echo $rzvy_defaultlang['category_name']; } ?></label>
		<input class="form-control" id="rzvy_update_categoryname" name="rzvy_update_categoryname" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_category_name'])){ echo $rzvy_translangArr['enter_category_name']; }else{ echo $rzvy_defaultlang['enter_category_name']; } ?>" value="<?php echo $category['cat_name']; ?>" />
	  </div>
	</form>
	<?php
}