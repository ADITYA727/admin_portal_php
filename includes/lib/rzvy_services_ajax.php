<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_categories.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_services.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_addons.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_schedule.php");		   

/* Create object of classes */
$obj_categories = new rzvy_categories();
$obj_categories->conn = $conn;

$obj_services = new rzvy_services();
$obj_services->conn = $conn;

$obj_addons = new rzvy_addons();
$obj_addons->conn = $conn;

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$obj_schedule = new rzvy_schedule();
$obj_schedule->conn = $conn;

$image_upload_path = SITE_URL."/uploads/images/";
$image_upload_abs_path = dirname(dirname(dirname(__FILE__)))."/uploads/images/";

/* Add service ajax */
if(isset($_POST['add_service'])){
	$obj_services->cat_id = $_POST['cat_id'];
	$obj_services->rate = $_POST['rate'];
	$obj_services->duration = $_POST['duration'];
	$obj_services->padding_before = $_POST['padding_before'];
	$obj_services->padding_after = $_POST['padding_after'];
	$obj_services->title = htmlentities($_POST['title']);
	$obj_services->description = htmlentities($_POST['description']);
	$obj_services->status = $_POST['status'];
	
	if($_POST['uploaded_file'] != ""){
		$new_filename = time();
		$uploaded_filename = $obj_settings->rzvy_base64_to_jpeg($_POST['uploaded_file'], $image_upload_abs_path, $new_filename);
		$obj_services->image = $uploaded_filename;
	}else{
		$obj_services->image = "";
	}
	$added = $obj_services->add_service();
	if($added){
		echo "added";
	}else{
		echo "failed";
	}
}

/* Update service modal detail ajax */
else if(isset($_POST['update_service_modal_detail'])){
	$obj_services->id = $_POST['id'];
	$service = $obj_services->readone_service();
	?>
	<form name="rzvy_update_service_form" id="rzvy_update_service_form" method="post">
	  <input type="hidden" value="<?php echo $service['id'] ?>" id="rzvy_update_serviceid_hidden" />
	  <div class="row">
		  <div class="form-group col-md-4">
			<label for="rzvy_update_servicetitle"><?php if(isset($rzvy_translangArr['service_title'])){ echo $rzvy_translangArr['service_title']; }else{ echo $rzvy_defaultlang['service_title']; } ?></label>
			<input class="form-control" id="rzvy_update_servicetitle" name="rzvy_update_servicetitle" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_service_title'])){ echo $rzvy_translangArr['enter_service_title']; }else{ echo $rzvy_defaultlang['enter_service_title']; } ?>" value="<?php echo $service['title']; ?>" />
		  </div>
		  <div class="form-group col-md-4">
			<label for="rzvy_update_servicerate"><?php if(isset($rzvy_translangArr['rate'])){ echo $rzvy_translangArr['rate']; }else{ echo $rzvy_defaultlang['rate']; } ?></label>
			<input class="form-control" id="rzvy_update_servicerate" name="rzvy_update_servicerate" type="text" placeholder="99.99" value="<?php echo $service['rate']; ?>" />
		  </div>
		  <div class="form-group col-md-4">
			<label for="rzvy_update_serviceduration"><?php if(isset($rzvy_translangArr['service_duration'])){ echo $rzvy_translangArr['service_duration']; }else{ echo $rzvy_defaultlang['service_duration']; } ?></label>
			<input class="form-control" id="rzvy_update_serviceduration" name="rzvy_update_serviceduration" type="number" placeholder="<?php if(isset($rzvy_translangArr['enter_service_duration'])){ echo $rzvy_translangArr['enter_service_duration']; }else{ echo $rzvy_defaultlang['enter_service_duration']; } ?>" value="<?php echo $service['duration']; ?>" />
		  </div>
		  <div class="form-group col-md-6">
			<label for="rzvy_update_servicepbefore"><?php if(isset($rzvy_translangArr['service_padding_before'])){ echo $rzvy_translangArr['service_padding_before']; }else{ echo $rzvy_defaultlang['service_padding_before']; } ?></label>
			<input class="form-control" id="rzvy_update_servicepbefore" name="rzvy_update_servicepbefore" type="number" placeholder="<?php if(isset($rzvy_translangArr['enter_service_padding_before'])){ echo $rzvy_translangArr['enter_service_padding_before']; }else{ echo $rzvy_defaultlang['enter_service_padding_before']; } ?>" value="<?php echo $service['padding_before']; ?>" />
		  </div>
		  <div class="form-group col-md-6">
			<label for="rzvy_update_servicepafter"><?php if(isset($rzvy_translangArr['service_padding_after'])){ echo $rzvy_translangArr['service_padding_after']; }else{ echo $rzvy_defaultlang['service_padding_after']; } ?></label>
			<input class="form-control" id="rzvy_update_servicepafter" name="rzvy_update_servicepafter" type="number" placeholder="<?php if(isset($rzvy_translangArr['enter_service_padding_after'])){ echo $rzvy_translangArr['enter_service_padding_after']; }else{ echo $rzvy_defaultlang['enter_service_padding_after']; } ?>" value="<?php echo $service['padding_after']; ?>" />
		  </div>
		  <div class="form-group col-md-6">
			<label for="rzvy_update_servicedescription"><?php if(isset($rzvy_translangArr['service_description'])){ echo $rzvy_translangArr['service_description']; }else{ echo $rzvy_defaultlang['service_description']; } ?></label>
			<textarea class="form-control" id="rzvy_update_servicedescription" name="rzvy_update_servicedescription" placeholder="<?php if(isset($rzvy_translangArr['enter_service_description'])){ echo $rzvy_translangArr['enter_service_description']; }else{ echo $rzvy_defaultlang['enter_service_description']; } ?>"><?php echo $service['description']; ?></textarea>
		  </div>
		  <div class="form-group col-md-6">
			<label for="rzvy_update_serviceimage"><?php if(isset($rzvy_translangArr['service_image'])){ echo $rzvy_translangArr['service_image']; }else{ echo $rzvy_defaultlang['service_image']; } ?></label>
			<div class="rzvy-image-upload">
				<div class="rzvy-image-edit-icon">
					<input type='hidden' id="rzvy-update-image-upload-file-hidden" name="rzvy-update-image-upload-file-hidden" />
					<input type='file' id="rzvy-update-image-upload-file" accept=".png, .jpg, .jpeg" />
					<label for="rzvy-update-image-upload-file"></label>
				</div>
				<div class="rzvy-image-preview">
					<div id="rzvy-update-image-upload-file-preview" style="<?php $service_image = $service['image']; if($service_image != '' && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$service_image)){ echo "background-image: url(".SITE_URL."uploads/images/".$service_image.");"; }else{ echo "background-image: url(".SITE_URL."includes/images/default-service.png);"; } ?>">
					</div>
				</div>
			</div>
		  </div>
		</div>
	</form>
	<?php
}

/* View service modal detail ajax */
else if(isset($_POST['view_service_modal_detail'])){
	$obj_services->id = $_POST['id'];
	$service = $obj_services->readone_service();
	?>
	<div class="block">
		<div class="row ml-4 mr-4">
			<div class="col-md-3">
				<img class="rzvy-view-modal-image" src="<?php $service_image = $service['image']; if($service_image != '' && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$service_image)){ echo SITE_URL."uploads/images/".$service_image; }else{ echo SITE_URL."includes/images/default-service.png"; } ?>"/>
			</div>
			<div class="col-md-2"></div>
			<div class="col-md-6">
				<div class="content-heading"><h3><?php echo ucwords($service['title']); ?> &nbsp </h3></div>
				<p><?php if(isset($rzvy_translangArr['rate_ad'])){ echo $rzvy_translangArr['rate_ad']; }else{ echo $rzvy_defaultlang['rate_ad']; } ?> <label class="text-primary"><?php echo $obj_settings->get_option('rzvy_currency_symbol').$service['rate']; ?></label></p>
				<p><?php if(isset($rzvy_translangArr['duration_ad'])){ echo $rzvy_translangArr['duration_ad']; }else{ echo $rzvy_defaultlang['duration_ad']; } ?> <label class="text-primary"><?php echo $service['duration']." Minutes"; ?></label></p>
				<p><?php if(isset($rzvy_translangArr['padding_before_ad'])){ echo $rzvy_translangArr['padding_before_ad']; }else{ echo $rzvy_defaultlang['padding_before_ad']; } ?> <label class="text-primary"><?php echo $service['padding_before']." Minutes"; ?></label></p>
				<p><?php if(isset($rzvy_translangArr['padding_after_ad'])){ echo $rzvy_translangArr['padding_after_ad']; }else{ echo $rzvy_defaultlang['padding_after_ad']; } ?> <label class="text-primary"><?php echo $service['padding_after']." Minutes"; ?></label></p>
				<p><?php if(isset($rzvy_translangArr['status_ad'])){ echo $rzvy_translangArr['status_ad']; }else{ echo $rzvy_defaultlang['status_ad']; } ?> <?php if($service['status'] == "Y"){ ?><label class="text-success"><?php if(isset($rzvy_translangArr['activated'])){ echo $rzvy_translangArr['activated']; }else{ echo $rzvy_defaultlang['activated']; } ?></label><?php }else{ ?><label class="text-danger"><?php if(isset($rzvy_translangArr['deactivated'])){ echo $rzvy_translangArr['deactivated']; }else{ echo $rzvy_defaultlang['deactivated']; } ?></label><?php } ?></p>
				<p><?php echo ucfirst($service['description']); ?></p>
			</div>
		</div>
	</div>
	<?php
}

/* Update service ajax */
else if(isset($_POST['update_service'])){
	$obj_services->id = $_POST['id'];
	$obj_services->rate = $_POST['rate'];
	$obj_services->duration = $_POST['duration'];
	$obj_services->padding_before = $_POST['padding_before'];
	$obj_services->padding_after = $_POST['padding_after'];
	$obj_services->title = htmlentities($_POST['title']);
	$obj_services->description = htmlentities($_POST['description']);
	$service = $obj_services->readone_service();
	$old_image = $service['image'];
	if($_POST['uploaded_file'] != ""){
		if($old_image != ""){
			if(file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image)){
				unlink(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image);
			}
		}
		$new_filename = time();
		$uploaded_filename = $obj_settings->rzvy_base64_to_jpeg($_POST['uploaded_file'], $image_upload_abs_path, $new_filename);
		$obj_services->image = $uploaded_filename;
	}else{
		$obj_services->image = $old_image;
	}
	$updated = $obj_services->update_service();
	if($updated){
		echo "updated";
	}else{
		echo "failed";
	}
}

/* Delete service ajax */
else if(isset($_POST['delete_service'])){
	$obj_services->id = $_POST['id'];
	$check_appointments = $obj_services->check_appointments_before_delete_service();
	if($check_appointments==0){
		$service = $obj_services->readone_service();
		$old_image = $service['image'];
		if($old_image != ""){
			if(file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image)){
				unlink(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image);
			}
		}
		$deleted = $obj_services->delete_service();
		if($deleted){
			echo "deleted";
		}else{
			echo "failed";
		}
	}else{
		echo "appointments exist";
	}
}

/* Change service status ajax */
else if(isset($_POST['change_service_status'])){
	$obj_services->id = $_POST['id'];
	$obj_services->status = $_POST['status'];
	$status_changed = $obj_services->change_service_status();
	if($status_changed){
		echo "changed";
	}else{
		echo "failed";
	}
}

/* Schedule service modal detail ajax */
else if(isset($_POST['schedule_service_modal_detail'])){
	$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
	$time_interval = $obj_settings->get_option('rzvy_timeslot_interval');
	$service_id = $_POST['id']; 
	?>
	<input type="hidden" value="<?php echo $service_id; ?>" name="rzvy_schedule_service_id" id="rzvy_schedule_service_id" />
	<div class="table-responsive">
		<table class="table" width="100%" cellspacing="0">
		  <thead>
			<tr>
			  <th><?php if(isset($rzvy_translangArr['day'])){ echo $rzvy_translangArr['day']; }else{ echo $rzvy_defaultlang['day']; } ?></th>
			  <th><?php if(isset($rzvy_translangArr['working_day'])){ echo $rzvy_translangArr['working_day']; }else{ echo $rzvy_defaultlang['working_day']; } ?></th>
			  <th><?php if(isset($rzvy_translangArr['start_time'])){ echo $rzvy_translangArr['start_time']; }else{ echo $rzvy_defaultlang['start_time']; } ?></th>
			  <th><?php if(isset($rzvy_translangArr['end_time'])){ echo $rzvy_translangArr['end_time']; }else{ echo $rzvy_defaultlang['end_time']; } ?></th>
			  <th><?php if(isset($rzvy_translangArr['no_of_bookings'])){ echo $rzvy_translangArr['no_of_bookings']; }else{ echo $rzvy_defaultlang['no_of_bookings']; } ?></th>
			</tr>
		  </thead>
		  <tbody>
			<?php 
			
			if(isset($rzvy_translangArr['monday'])){ $monday =  $rzvy_translangArr['monday']; }else{  $monday =  $rzvy_defaultlang['monday']; } 
			if(isset($rzvy_translangArr['tuesday'])){ $tuesday =  $rzvy_translangArr['tuesday']; }else{  $tuesday =  $rzvy_defaultlang['tuesday']; } 
			if(isset($rzvy_translangArr['wednesday'])){ $wednesday =  $rzvy_translangArr['wednesday']; }else{  $wednesday =  $rzvy_defaultlang['wednesday']; } 
			if(isset($rzvy_translangArr['thursday'])){ $thursday =  $rzvy_translangArr['thursday']; }else{  $thursday =  $rzvy_defaultlang['thursday']; } 
			if(isset($rzvy_translangArr['friday'])){ $friday =  $rzvy_translangArr['friday']; }else{  $friday =  $rzvy_defaultlang['friday']; } 
			if(isset($rzvy_translangArr['saturday'])){ $saturday =  $rzvy_translangArr['saturday']; }else{  $saturday =  $rzvy_defaultlang['saturday']; } 
			if(isset($rzvy_translangArr['sunday'])){ $sunday =  $rzvy_translangArr['sunday']; }else{  $sunday =  $rzvy_defaultlang['sunday']; } 

			
			
			$day_array = array("$monday", "$tuesday", "$wednesday", "$thursday", "$friday", "$saturday", "$sunday");
			$obj_schedule->service_id = $service_id;
			$get_schedule = $obj_schedule->get_service_schedule();
			while($schedule = mysqli_fetch_array($get_schedule)){ 
				?>
				<tr>
				  <td><?php echo $day_array[$schedule['weekday_id']-1]; ?></td>
				  <td>
					<label class="rzvy-toggle-switch">
					<input name="rzvy_service_schedule_status[]" type="checkbox" class="rzvy-toggle-switch-input rzvy_service_schedule_status" id="rzvy_service_schedule_status_<?php echo $schedule['id']; ?>" data-id="<?php echo $schedule['id']; ?>" <?php if($schedule['offday'] == 'N'){ echo "checked"; } ?> />
					  <span class="rzvy-toggle-switch-slider"></span>
					</label>
				  </td>
				  <td>
					<select name="rzvy_service_starttime_dropdown[]" class="form-control rzvy_service_starttime_dropdown" id="rzvy_service_starttime_dropdown_<?php echo $schedule['id']; ?>">
						<?php 
						$schedule_starttime = $schedule['starttime'];
						echo $obj_schedule->generate_slot_dropdown_options($time_interval, $rzvy_time_format, $schedule_starttime);
						?>
					</select>
				  </td>
				  <td>
					<select name="rzvy_service_endtime_dropdown[]" class="form-control rzvy_service_endtime_dropdown" id="rzvy_service_endtime_dropdown_<?php echo $schedule['id']; ?>">
						<?php 
						$schedule_endtime = $schedule['endtime'];
						echo $obj_schedule->generate_slot_dropdown_options($time_interval, $rzvy_time_format, $schedule_endtime);
						?>
					</select>
				  </td>
				  <td>
					<input class="form-control rzvy_service_booking" id="rzvy_service_booking_<?php echo $schedule['id']; ?>" name="rzvy_service_booking[]" type="text" placeholder="<?php if(isset($rzvy_translangArr['e_g_5'])){ echo $rzvy_translangArr['e_g_5']; }else{ echo $rzvy_defaultlang['e_g_5']; } ?>" value="<?php echo $schedule['no_of_booking']; ?>" />
				  </td>
				</tr>
				<?php 
			} 
			?>
		  </tbody>
		</table>
	</div>
	<?php
}

/* Save Schedule service detail ajax */
else if(isset($_POST['save_service_schedule'])){
	$service_id = $_POST["id"];
	$obj_schedule->service_id = $service_id;
	$truncated = $obj_schedule->truncate_service_schedule();
	if($truncated){
		for($i=0;$i<7;$i++){
			$obj_schedule->weekday_id = $i+1;
			$obj_schedule->starttime = $_POST["starttime"][$i];
			$obj_schedule->endtime = $_POST["endtime"][$i];
			$obj_schedule->offday = $_POST["schedule_status"][$i];
			$obj_schedule->no_of_booking = $_POST["no_of_booking"][$i];
			$obj_schedule->service_id = $service_id;
			$obj_schedule->add_service_schedule();
		}
	}
}
/* Change service group type ajax */
else if(isset($_POST['assign_staff_services'])){
	$obj_services->id = $_POST['id'];
	$staff_ids = $_POST['staff_ids'];
	$obj_services->unlink_all_staff_for_selected_service();
	if(sizeof($staff_ids)>0){
		for($i=0; $i<sizeof($staff_ids);$i++){
			$obj_services->link_staff_to_selected_service($staff_ids[$i]);
		}
	}
}