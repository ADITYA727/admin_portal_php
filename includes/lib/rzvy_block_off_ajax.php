<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_block_off.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_services.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */

$obj_block_off = new rzvy_block_off();
$obj_block_off->conn = $conn;

/* Change block off status ajax */
if(isset($_POST['change_blockoff_status'])){
	$obj_block_off->id = $_POST['id'];
	$obj_block_off->status = $_POST['status'];
	$status_changed = $obj_block_off->update_block_off_status();
	if($status_changed){
		echo "changed";
	}else{
		echo "failed";
	}
}
/* Delete block off ajax */
else if(isset($_POST['delete_blockoff'])){
	$obj_block_off->id = $_POST['id'];
	$deleted = $obj_block_off->delete_block_off();
	if($deleted){
		echo "deleted";
	}else{
		echo "failed";
	}
}
/* Add block off ajax */
else if(isset($_POST['add_blockoff'])){
	$obj_block_off->title = htmlentities($_POST['title']);
	$obj_block_off->from_date = date("Y-m-d", strtotime($_POST['from_date']));
	$obj_block_off->to_date = date("Y-m-d", strtotime($_POST['to_date']));
	$obj_block_off->pattern = "daily";
	$obj_block_off->blockoff_type = $_POST["blockoff_type"];
	$obj_block_off->from_time = date("H:i:s", strtotime($_POST['from_time']));
	$obj_block_off->to_time = date("H:i:s", strtotime($_POST['to_time']));
	$obj_block_off->status = $_POST["status"];
	$added = $obj_block_off->add_block_off();
	if($added){
		echo "added";
	}else{
		echo "failed";
	}
}
/* Update Block Off ajax */
else if(isset($_POST['update_blockoff'])){
	$obj_block_off->id = $_POST['id'];
	$obj_block_off->title = htmlentities($_POST['title']);
	$obj_block_off->from_date = date("Y-m-d", strtotime($_POST['from_date']));
	$obj_block_off->to_date = date("Y-m-d", strtotime($_POST['to_date']));
	$obj_block_off->pattern = "daily";
	$obj_block_off->blockoff_type = $_POST["blockoff_type"];
	$obj_block_off->from_time = date("H:i:s", strtotime($_POST['from_time']));
	$obj_block_off->to_time = date("H:i:s", strtotime($_POST['to_time']));
	$updated = $obj_block_off->update_block_off();
	if($updated){
		echo "updated";
	}else{
		echo "failed";
	}
}

/* Update Block Off modal detail ajax */
else if(isset($_POST['update_blockoff_modal_detail'])){
	$obj_block_off->id = $_POST['id'];
	$block_off = $obj_block_off->readone_block_off(); 
	?>
	<form name="rzvy_update_blockoff_form" id="rzvy_update_blockoff_form" method="post">
		<div class="row">
		  <div class="form-group col-md-12">
			<label for="rzvy_update_blockofftitle"><?php if(isset($rzvy_translangArr['block_off_title'])){ echo $rzvy_translangArr['block_off_title']; }else{ echo $rzvy_defaultlang['block_off_title']; } ?></label>
			<input class="form-control" id="rzvy_update_blockofftitle" name="rzvy_update_blockofftitle" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_block_off_title'])){ echo $rzvy_translangArr['enter_block_off_title']; }else{ echo $rzvy_defaultlang['enter_block_off_title']; } ?>" value="<?php echo $block_off["title"]; ?>" />
		  </div>
		</div>
		<div class="row">
		  <div class="form-group col-md-6">
			<label for="rzvy_update_blockoff_fromdate"><?php if(isset($rzvy_translangArr['from_date'])){ echo $rzvy_translangArr['from_date']; }else{ echo $rzvy_defaultlang['from_date']; } ?></label>
			<input class="form-control" id="rzvy_update_blockoff_fromdate" name="rzvy_update_blockoff_fromdate" type="date"  value="<?php echo $block_off["from_date"]; ?>" />
		  </div>
		  <div class="form-group col-md-6">
			<label for="rzvy_update_blockoff_todate"><?php if(isset($rzvy_translangArr['to_date'])){ echo $rzvy_translangArr['to_date']; }else{ echo $rzvy_defaultlang['to_date']; } ?></label>
			<input class="form-control" id="rzvy_update_blockoff_todate" name="rzvy_update_blockoff_todate" type="date" value="<?php echo $block_off["to_date"]; ?>" />
		  </div>
		</div>
		<div class="row">
		  <div class="form-group col-md-12">
			<label for="rzvy_update_blockoff_type"><?php if(isset($rzvy_translangArr['block_off_type'])){ echo $rzvy_translangArr['block_off_type']; }else{ echo $rzvy_defaultlang['block_off_type']; } ?></label>
			<div>
				<label><input type="radio" class="rzvy_update_blockoff_type" name="rzvy_update_blockoff_type" value="fullday" <?php if($block_off["blockoff_type"] == "fullday"){ echo "checked"; } ?> /> <?php if(isset($rzvy_translangArr['fullday'])){ echo $rzvy_translangArr['fullday']; }else{ echo $rzvy_defaultlang['fullday']; } ?></label> &nbsp; <label><input type="radio" class="rzvy_update_blockoff_type" name="rzvy_update_blockoff_type" value="custom" <?php if($block_off["blockoff_type"] == "custom"){ echo "checked"; } ?> /> <?php if(isset($rzvy_translangArr['custom'])){ echo $rzvy_translangArr['custom']; }else{ echo $rzvy_defaultlang['custom']; } ?></label>
			</div>
		  </div>
		</div>
		<div class="rzvy_hide_blockoff_custom_box" <?php if($block_off["blockoff_type"] == "custom"){ echo "style='display:block'"; } ?>>
			<div class="row">
			  <div class="form-group col-md-6">
				<label for="rzvy_update_blockoff_fromtime"><?php if(isset($rzvy_translangArr['from_time'])){ echo $rzvy_translangArr['from_time']; }else{ echo $rzvy_defaultlang['from_time']; } ?></label>
				<input class="form-control" id="rzvy_update_blockoff_fromtime" name="rzvy_update_blockoff_fromtime" type="time" value="<?php echo date("H:i", strtotime($block_off["from_time"])); ?>" />
			  </div>
			  <div class="form-group col-md-6">
				<label for="rzvy_update_blockoff_totime"><?php if(isset($rzvy_translangArr['to_time'])){ echo $rzvy_translangArr['to_time']; }else{ echo $rzvy_defaultlang['to_time']; } ?></label>
				<input class="form-control" id="rzvy_update_blockoff_totime" name="rzvy_update_blockoff_totime" type="time" value="<?php echo date("H:i", strtotime($block_off["to_time"])); ?>" />
			  </div>
			</div>
		</div>
	</form>
	<?php
}