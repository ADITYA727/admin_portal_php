<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_staff.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;
$obj_staff = new rzvy_staff();
$obj_staff->conn = $conn;

$image_upload_path = SITE_URL."/uploads/images/";
$image_upload_abs_path = dirname(dirname(dirname(__FILE__)))."/uploads/images/";

/** Staff Detail Tab Ajax **/
if(isset($_POST['staff_detail_tab'])){ 
    $staffid = $_POST["id"];
    $obj_staff->id = $staffid;
    $staff_data = $obj_staff->readone_staff(); 
	?>
	<div class="tab-pane container active" id="rzvy_staff_detail">
        <form name="rzvy_staff_detail_form" id="rzvy_staff_detail_form" method="post">
            <input type='hidden' id="rzvy-staff-detail-id-hidden" name="rzvy-staff-detail-id-hidden" value="<?php echo $staffid; ?>" />
            <div class="form-group row">
                <div class="col-md-12">
                    <span class="pull-right"><a href="javascript:void(0);"  data-toggle="modal" data-target="#rzvy_change_staffemail_modal"><?php if(isset($rzvy_translangArr['want_to_change_email'])){ echo $rzvy_translangArr['want_to_change_email']; }else{ echo $rzvy_defaultlang['want_to_change_email']; } ?></a></span>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-3">
                    <div class="rzvy-image-upload">
                        <div class="rzvy-image-edit-icon">
                            <input type='hidden' id="rzvy-image-upload-file-hidden" name="rzvy-image-upload-file-hidden" />
                            <input type='file' id="rzvy-image-upload-file" accept=".png, .jpg, .jpeg" />
                            <label for="rzvy-image-upload-file"></label>
                        </div>
                        <div class="rzvy-image-preview">
                            <div id="rzvy-image-upload-file-preview" style="<?php if($staff_data['image'] != '' && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$staff_data['image'])){ echo "background-image: url(".SITE_URL."uploads/images/".$staff_data['image'].");"; }else{ echo "background-image: url(".SITE_URL."includes/images/staff-lg.png);"; } ?>"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 pt-2">
                    <p><h3><?php echo ucwords($staff_data["firstname"]." ".$staff_data["lastname"]); ?></h3></p>
                    <p class="text-muted"><i class="fa fa-envelope"></i> <?php echo $staff_data["email"]; ?></p>
                </div>
                <div class="col-md-2 pt-4">
                    <?php if(!isset($_SESSION["staff_id"])){ ?>
                    <label class="rzvy-toggle-switch">
                        <input type="checkbox" name="rzvy_staff_status" id="rzvy_staff_status" class="rzvy-toggle-switch-input" <?php if($staff_data["status"]=="Y"){ echo "checked"; } ?> data-id="<?php echo $staffid; ?>" />
                        <span class="rzvy-toggle-switch-slider"></span>
                    </label>
                    <?php } ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-4">
                    <label class="control-label"><?php if(isset($rzvy_translangArr['first_name'])){ echo $rzvy_translangArr['first_name']; }else{ echo $rzvy_defaultlang['first_name']; } ?></label>
                    <input class="form-control" id="rzvy_staff_firstname" name="rzvy_staff_firstname" type="text" value="<?php echo $staff_data["firstname"]; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_first_name'])){ echo $rzvy_translangArr['enter_first_name']; }else{ echo $rzvy_defaultlang['enter_first_name']; } ?>" />
                </div>
                <div class="col-md-4">
                    <label class="control-label"><?php if(isset($rzvy_translangArr['last_name'])){ echo $rzvy_translangArr['last_name']; }else{ echo $rzvy_defaultlang['last_name']; } ?></label>
                    <input class="form-control" id="rzvy_staff_lastname" name="rzvy_staff_lastname" type="text" value="<?php echo $staff_data["lastname"]; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_last_name'])){ echo $rzvy_translangArr['enter_last_name']; }else{ echo $rzvy_defaultlang['enter_last_name']; } ?>" />
                </div>
                <div class="col-md-4">
                    <label class="control-label"><?php if(isset($rzvy_translangArr['phone'])){ echo $rzvy_translangArr['phone']; }else{ echo $rzvy_defaultlang['phone']; } ?></label>
                    <input class="form-control" id="rzvy_staff_phone" name="rzvy_staff_phone" type="text" value="<?php echo $staff_data["phone"]; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_phone'])){ echo $rzvy_translangArr['enter_phone']; }else{ echo $rzvy_defaultlang['enter_phone']; } ?>" />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <label class="control-label"><?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?></label>
                    <textarea class="form-control" id="rzvy_staff_address" name="rzvy_staff_address" rows="1" placeholder="<?php if(isset($rzvy_translangArr['enter_address'])){ echo $rzvy_translangArr['enter_address']; }else{ echo $rzvy_defaultlang['enter_address']; } ?>" ><?php echo $staff_data["address"]; ?></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="control-label"><?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?></label>
                    <input class="form-control" id="rzvy_staff_city" name="rzvy_staff_city" type="text" value="<?php echo $staff_data["city"]; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_city'])){ echo $rzvy_translangArr['enter_city']; }else{ echo $rzvy_defaultlang['enter_city']; } ?>" />
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?></label>
                    <input class="form-control" id="rzvy_staff_state" name="rzvy_staff_state" type="text" value="<?php echo $staff_data["state"]; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_state'])){ echo $rzvy_translangArr['enter_state']; }else{ echo $rzvy_defaultlang['enter_state']; } ?>" />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label class="control-label"><?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?></label>
                    <input class="form-control" id="rzvy_staff_zip" name="rzvy_staff_zip" type="text" value="<?php echo $staff_data["zip"]; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_zip'])){ echo $rzvy_translangArr['enter_zip']; }else{ echo $rzvy_defaultlang['enter_zip']; } ?>" />
                </div>
                <div class="col-md-6">
                    <label class="control-label"><?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?></label>
                    <input class="form-control" id="rzvy_staff_country" name="rzvy_staff_country" type="text" value="<?php echo $staff_data["country"]; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_country'])){ echo $rzvy_translangArr['enter_country']; }else{ echo $rzvy_defaultlang['enter_country']; } ?>" />
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                    <?php if(!isset($_SESSION["staff_id"])){ ?><a class="btn btn-danger rzvy_delete_staff_btn" href="javascript:void(0);" data-id="<?php echo $staffid; ?>"><i class="fa fa-trash"></i> <?php if(isset($rzvy_translangArr['delete_staff'])){ echo $rzvy_translangArr['delete_staff']; }else{ echo $rzvy_defaultlang['delete_staff']; } ?></a><?php } ?>
                    <a class="btn btn-success rzvy_save_staff_btn pull-right" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['save_staff'])){ echo $rzvy_translangArr['save_staff']; }else{ echo $rzvy_defaultlang['save_staff']; } ?></a>
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane container" id="rzvy_staff_services"></div>
    <div class="tab-pane container" id="rzvy_staff_schedule"></div>
    <div class="tab-pane container" id="rzvy_staff_blockoff"></div>
	
	<!-- Change email modal -->
	<div class="modal fade" id="rzvy_change_staffemail_modal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title"><?php if(isset($rzvy_translangArr['change_email'])){ echo $rzvy_translangArr['change_email']; }else{ echo $rzvy_defaultlang['change_email']; } ?></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form name="rzvy_change_staff_email_form" id="rzvy_change_staff_email_form" method="post">
						<div class="row m-2">
							<div class="col-md-9 p-1">
								<input type="text" class="form-control" placeholder="<?php if(isset($rzvy_translangArr['enter_new_email'])){ echo $rzvy_translangArr['enter_new_email']; }else{ echo $rzvy_defaultlang['enter_new_email']; } ?>" name="rzvy_change_staff_email" id="rzvy_change_staff_email" />
							</div>
							<div class="col-md-3 p-1">
								<a href="javascript:void(0)" class="btn btn-success w-100" id="rzvy_change_staff_email_btn"><?php if(isset($rzvy_translangArr['change'])){ echo $rzvy_translangArr['change']; }else{ echo $rzvy_defaultlang['change']; } ?></a>
							</div>
						</div>
					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
    <?php 
}

/** Staff Services Tab Ajax **/
else if(isset($_POST['staff_services_tab'])){ 
    $staffid = $_POST["id"];
    $allcategories = $obj_staff->get_all_categories(); 
	?>
	<div class="tab-pane container" id="rzvy_staff_detail"></div>
    <div class="tab-pane container active" id="rzvy_staff_services">
        <form name="rzvy_staff_service_form" id="rzvy_staff_service_form" method="post">
            <input type='hidden' id="rzvy-staff-detail-id-hidden" name="rzvy-staff-detail-id-hidden" value="<?php echo $staffid; ?>" />
            <div class="form-group row">
                <ul class="rzvy-staff-services-treeview">
                    <?php 
                    while($cat = mysqli_fetch_array($allcategories)){ 
                        $obj_staff->category_id = $cat["id"];
                        $services = $obj_staff->get_services_by_cat_id();
                        ?>
                        <li>
                            <label for="rzvy-cat-services-ul-<?php echo $cat["id"]; ?>"><i class="fa fa-hand-o-right" aria-hidden="true"></i> <?php echo ucwords($cat["cat_name"]); ?></label>
                            <ul id="rzvy-cat-services-ul-<?php echo $cat["id"]; ?>">
                                <?php 
                                while($ser = mysqli_fetch_array($services)){ 
                                    $obj_staff->id = $staffid;
                                    $obj_staff->service_id = $ser["id"];
                                    $staff_service = $obj_staff->get_staff_service();
                                    $checked = "";
                                    if(mysqli_num_rows($staff_service)>0){
                                        $checked = "checked";
                                    }
                                    ?>
                                    <li>
                                        <input type="checkbox" name="rzvy-cat-services-<?php echo $ser["id"]; ?>" class="rzvy-cat-services" data-id="<?php echo $ser["id"]; ?>" id="rzvy-cat-services-<?php echo $ser["id"]; ?>" <?php echo $checked; ?> />
                                        <label for="rzvy-cat-services-<?php echo $ser["id"]; ?>" class="custom-unchecked"><?php echo ucwords($ser["title"]); ?></label>
                                    </li>
                                    <?php 
                                } 
                                ?>
                            </ul>
                        </li>
                        <?php 
                    } 
                    ?>
                </ul>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                <a class="btn btn-info rzvy_uncheckall_services_btn" href="javascript:void(0);"><i class="fa fa-square-o"></i> <?php if(isset($rzvy_translangArr['uncheck_all'])){ echo $rzvy_translangArr['uncheck_all']; }else{ echo $rzvy_defaultlang['uncheck_all']; } ?></a>
                <a class="btn btn-success rzvy_update_staff_services_btn pull-right" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['save'])){ echo $rzvy_translangArr['save']; }else{ echo $rzvy_defaultlang['save']; } ?></a>
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane container" id="rzvy_staff_schedule"></div>
    <div class="tab-pane container" id="rzvy_staff_blockoff"></div>
    <?php 
}

/** Staff Schedule Tab Ajax **/
else if(isset($_POST['staff_schedule_tab'])){ 
    $staffid = $_POST["id"]; 
    $rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
    $time_interval = $obj_settings->get_option('rzvy_timeslot_interval');
    if(isset($rzvy_translangArr['monday'])){ $monday =  $rzvy_translangArr['monday']; }else{  $monday =  $rzvy_defaultlang['monday']; } 
	if(isset($rzvy_translangArr['tuesday'])){ $tuesday =  $rzvy_translangArr['tuesday']; }else{  $tuesday =  $rzvy_defaultlang['tuesday']; } 
	if(isset($rzvy_translangArr['wednesday'])){ $wednesday =  $rzvy_translangArr['wednesday']; }else{  $wednesday =  $rzvy_defaultlang['wednesday']; } 
	if(isset($rzvy_translangArr['thursday'])){ $thursday =  $rzvy_translangArr['thursday']; }else{  $thursday =  $rzvy_defaultlang['thursday']; } 
	if(isset($rzvy_translangArr['friday'])){ $friday =  $rzvy_translangArr['friday']; }else{  $friday =  $rzvy_defaultlang['friday']; } 
	if(isset($rzvy_translangArr['saturday'])){ $saturday =  $rzvy_translangArr['saturday']; }else{  $saturday =  $rzvy_defaultlang['saturday']; } 
	if(isset($rzvy_translangArr['sunday'])){ $sunday =  $rzvy_translangArr['sunday']; }else{  $sunday =  $rzvy_defaultlang['sunday']; } 
	$day_array = array("$monday", "$tuesday", "$wednesday", "$thursday", "$friday", "$saturday", "$sunday");
    $obj_staff->id = $staffid;
    $time_interval = $obj_settings->get_option('rzvy_timeslot_interval');
    $get_schedule = $obj_staff->get_schedule(); 
	?>
	<div class="tab-pane container" id="rzvy_staff_detail"></div>
    <div class="tab-pane container" id="rzvy_staff_services"></div>
    <div class="tab-pane container active" id="rzvy_staff_schedule">
        <form name="rzvy_staff_schedule_form" id="rzvy_staff_schedule_form" method="post">
            <input type='hidden' id="rzvy-staff-detail-id-hidden" name="rzvy-staff-detail-id-hidden" value="<?php echo $staffid; ?>" />
            <div class="form-group row">
                <div class="table-responsive">
                <table class="table" width="100%" cellspacing="0">
                    <tbody>
                    <?php 
                    while($schedule = mysqli_fetch_array($get_schedule)){  
						$schedule_starttime = $schedule['starttime'];
						$schedule_endtime = $schedule['endtime'];
						$slot_options = $obj_staff->generate_slot_dropdown_options($time_interval, $rzvy_time_format, $schedule_starttime, $schedule_endtime);
                        ?>
                        <tr class="bg-light">
                            <td colspan="2"><b class="mr-2"><?php echo $day_array[$schedule['weekday_id']-1]; ?></b><br /><div class="my-2"><?php if(isset($rzvy_translangArr['no_of_bookings'])){ echo $rzvy_translangArr['no_of_bookings']; }else{ echo $rzvy_defaultlang['no_of_bookings']; } ?> <input type="text" class="w-25 rzvy_staff_no_of_booking" value="<?php echo $schedule['no_of_booking']; ?>" data-dayname="<?php echo $day_array[$schedule['weekday_id']-1]; ?>" /></div></td>
                            <td><b><?php if(isset($rzvy_translangArr['working_day'])){ echo $rzvy_translangArr['working_day']; }else{ echo $rzvy_defaultlang['working_day']; } ?></b></td>
                            <td><b><?php if(isset($rzvy_translangArr['breaks'])){ echo $rzvy_translangArr['breaks']; }else{ echo $rzvy_defaultlang['breaks']; } ?></b></td>
                        </tr>
                        <tr>
                            <td class="w-50" colspan="2">
                                <div class="row">
                                    <select class="form-control selectpicker rzvy_staff_starttime_dropdown col-md-4" data-dayname="<?php echo $day_array[$schedule['weekday_id']-1]; ?>" data-db_starttime="<?php echo $schedule['starttime']; ?>" data-id="<?php echo $schedule['id']; ?>" id="rzvy_staff_starttime_dropdown_<?php echo $schedule['id']; ?>">
                                        <?php echo $slot_options["slot_starttime"]; ?>
                                    </select>
                                    <span class="col-md-2 text-center pt-2"><?php if(isset($rzvy_translangArr['to'])){ echo $rzvy_translangArr['to']; }else{ echo $rzvy_defaultlang['to']; } ?></span>
                                    <select class="form-control selectpicker rzvy_staff_endtime_dropdown col-md-4" data-dayname="<?php echo $day_array[$schedule['weekday_id']-1]; ?>" data-id="<?php echo $schedule['id']; ?>" data-db_endtime="<?php echo $schedule['endtime']; ?>" id="rzvy_staff_endtime_dropdown_<?php echo $schedule['id']; ?>">
                                        <?php echo $slot_options["slot_endtime"]; ?>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <label class="rzvy-toggle-switch">
                                <input type="checkbox" class="rzvy-toggle-switch-input rzvy_staff_schedule_offday" data-id="<?php echo $schedule['id']; ?>" <?php if($schedule['offday'] == 'N'){ echo "checked"; } ?> />
                                    <span class="rzvy-toggle-switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                <a id="rzvy_addbreak_popover_<?php echo $schedule['id']; ?>" data-id="<?php echo $schedule['id']; ?>" data-weekday_id="<?php echo $schedule['weekday_id']; ?>" class="btn btn-link rzvy_addbreak_popover" href="javascript:void(0);"><i class="fa fa-plus"></i> <?php if(isset($rzvy_translangArr['add'])){ echo $rzvy_translangArr['add']; }else{ echo $rzvy_defaultlang['add']; } ?></a>
								<!-- Add Break Modal-->
								<div class="modal fade" id="rzvy-add-break-modal_<?php echo $schedule['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="rzvy-add-break-modal-label_<?php echo $schedule['id']; ?>" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="rzvy-add-break-modal-label_<?php echo $schedule['id']; ?>"><?php if(isset($rzvy_translangArr['add_break'])){ echo $rzvy_translangArr['add_break']; }else{ echo $rzvy_defaultlang['add_break']; } ?></h5>
										<button class="close" type="button" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">×</span>
										</button>
									  </div>
									  <div class="modal-body" id="rzvy_addbreak_popover_datacontent_<?php echo $schedule['id']; ?>">
											
									  </div>
									  <div class="modal-footer">
										<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
										<a class="btn btn-primary rzvy_addbreak_btn" href="javascript:void(0);" data-dayid="<?php echo $schedule['weekday_id']; ?>"><?php if(isset($rzvy_translangArr['add'])){ echo $rzvy_translangArr['add']; }else{ echo $rzvy_defaultlang['add']; } ?></a>
									  </div>
									</div>
								  </div>
								</div>
								<?php 
                                    $obj_staff->weekday_id = $schedule['weekday_id'];
                                    $obj_staff->id = $staffid;
                                    $all_breaks = $obj_staff->get_staff_breaks();
                                    if(mysqli_num_rows($all_breaks)>0){
                                        echo "<div class='colmd-12'>";
										if(isset($rzvy_translangArr['to'])){ $to_label = $rzvy_translangArr['to']; }else{ $to_label = $rzvy_defaultlang['to']; }
                                        while($break = mysqli_fetch_array($all_breaks)){ 
                                            ?>
                                            <div class="btn-group btn-group-sm my-1">
                                                <a href="javascript:void(0)" class="btn btn-info"><?php echo date($rzvy_time_format, strtotime($break["break_start"]))." ".$to_label." ".date($rzvy_time_format, strtotime($break["break_end"])); ?></a>
                                                <a href="javascript:void(0)" class="btn btn-info rzvy_delete_staffbreak" data-id="<?php echo $break["id"]; ?>"><i class="fa fa-trash"></i></a>
                                            </div>
                                            <?php                                             
                                        }
                                        echo "</div>";
                                    } 
                                ?>
                                
                            </td>
                        </tr>
                        <?php 
                    } 
                    ?>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-12">
                <a class="btn btn-success rzvy_update_staff_schedule_btn pull-right" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['save_schedule'])){ echo $rzvy_translangArr['save_schedule']; }else{ echo $rzvy_defaultlang['save_schedule']; } ?></a>
                </div>
            </div>
        </form>
    </div>
    <div class="tab-pane container" id="rzvy_staff_blockoff"></div>
    <?php 
}

/** Staff BlockOff Tab Ajax **/
else if(isset($_POST['staff_blockoff_tab'])){ 
    $staffid = $_POST["id"]; 
    ?>
	<div class="tab-pane container" id="rzvy_staff_detail"></div>
    <div class="tab-pane container" id="rzvy_staff_services"></div>
    <div class="tab-pane container" id="rzvy_staff_schedule"></div>
    <div class="tab-pane container active" id="rzvy_staff_blockoff">
        <input type='hidden' id="rzvy-staff-detail-id-hidden" name="rzvy-staff-detail-id-hidden" value="<?php echo $staffid; ?>" />
        <!-- DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-fw fa-calendar-o"></i> <?php if(isset($rzvy_translangArr['days_off_list'])){ echo $rzvy_translangArr['days_off_list']; }else{ echo $rzvy_defaultlang['days_off_list']; } ?>
                <a class="btn btn-success btn-sm rzvy-white pull-right" data-toggle="modal" data-target="#rzvy-add-staffdaysoff-modal"><i class="fa fa-plus"></i> <?php if(isset($rzvy_translangArr['add_days_off'])){ echo $rzvy_translangArr['add_days_off']; }else{ echo $rzvy_defaultlang['add_days_off']; } ?></a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="rzvy_staffdaysoff_list_table" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><?php if(isset($rzvy_translangArr['hash_rzy_translation'])){ echo $rzvy_translangArr['hash_rzy_translation']; }else{ echo $rzvy_defaultlang['hash_rzy_translation']; } ?></th>
                                <th><?php if(isset($rzvy_translangArr['days_off'])){ echo $rzvy_translangArr['days_off']; }else{ echo $rzvy_defaultlang['days_off']; } ?></th>
                                <th><?php if(isset($rzvy_translangArr['action'])){ echo $rzvy_translangArr['action']; }else{ echo $rzvy_defaultlang['action']; } ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
                            $obj_staff->id = $staffid;
                            $all_daysoff = $obj_staff->readall_staff_daysoff();
                            if(mysqli_num_rows($all_daysoff)>0){
                                $i = 1;
                                while($offday = mysqli_fetch_array($all_daysoff)){ 
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo date($rzvy_date_format, strtotime($offday['off_date'])); ?></td>
                                        <td>
                                            <a href="javascript:void(0);" class="btn btn-danger rzvy-white btn-sm rzvy_delete_staff_daysoff_btn" data-id="<?php echo $offday['id']; ?>"><i class="fa fa-fw fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php 
                                    $i++;
                                } 
                            } 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal-->
	<div class="modal fade" id="rzvy-add-staffdaysoff-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-add-staffdaysoff-modal-label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy-add-staffdaysoff-modal-label"><?php if(isset($rzvy_translangArr['add_days_off'])){ echo $rzvy_translangArr['add_days_off']; }else{ echo $rzvy_defaultlang['add_days_off']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form name="rzvy_add_staffdaysoff_form" id="rzvy_add_staffdaysoff_form" method="post">
				<div class="row">
				  <div class="form-group col-md-12">
					<label for="rzvy_staffdaysoff_date"><?php if(isset($rzvy_translangArr['off_date'])){ echo $rzvy_translangArr['off_date']; }else{ echo $rzvy_defaultlang['off_date']; } ?></label>
					<input class="form-control" id="rzvy_staffdaysoff_date" name="rzvy_staffdaysoff_date" type="date" />
				  </div>
				</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
			<a id="rzvy_add_staffdaysoff_btn" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['add'])){ echo $rzvy_translangArr['add']; }else{ echo $rzvy_defaultlang['add']; } ?></a>
		  </div>
		</div>
	  </div>
	</div>
    <?php 
}

/** Staff Detail Card AJAX */
elseif(isset($_POST["staff_detail_card"])){ 
    $staffid = $_POST["id"];
    $obj_staff->id = $staffid;
    $staff_data = $obj_staff->readone_staff(); 
    ?>
    <div class="card">
        <div class="card-body p-0">
            <div class="rzvy-tabbable-panel">
                <div class="rzvy-tabbable-line">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active custom-nav-item" id="rzvy_staff_detail_tab_selection" data-id="<?php echo $staffid; ?>">
                            <a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="0" data-toggle="tab" href="#rzvy_staff_detail"><i class="fa fa-info-circle"></i> <?php if(isset($rzvy_translangArr['detail'])){ echo $rzvy_translangArr['detail']; }else{ echo $rzvy_defaultlang['detail']; } ?></a>
                        </li>
                        <li class="nav-item custom-nav-item" id="rzvy_staff_services_tab_selection" data-id="<?php echo $staffid; ?>">
                            <a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="1" data-toggle="tab" href="#rzvy_staff_services"><i class="fa fa-check-square-o"></i> <?php if(isset($rzvy_translangArr['services'])){ echo $rzvy_translangArr['services']; }else{ echo $rzvy_defaultlang['services']; } ?></a>
                        </li>
                        <li class="nav-item custom-nav-item" id="rzvy_staff_schedule_tab_selection" data-id="<?php echo $staffid; ?>">
                            <a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="2" data-toggle="tab" href="#rzvy_staff_schedule"><i class="fa fa-calendar"></i> <?php if(isset($rzvy_translangArr['schedule'])){ echo $rzvy_translangArr['schedule']; }else{ echo $rzvy_defaultlang['schedule']; } ?></a>
                        </li>
                        <li class="nav-item custom-nav-item" id="rzvy_staff_blockoff_tab_selection" data-id="<?php echo $staffid; ?>">
                            <a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="3" data-toggle="tab" href="#rzvy_staff_blockoff"><i class="fa fa-calendar-o"></i> <?php if(isset($rzvy_translangArr['days_off'])){ echo $rzvy_translangArr['days_off']; }else{ echo $rzvy_defaultlang['days_off']; } ?></a>
                        </li>
                    </ul>
                    <div id="rzvy-staff-tab-content" class="tab-content py-4">
                        <!-- Staff Content Goes Here -->
                    </div>
                </div>  
            </div>
        </div>
    </div>
    <?php 
}

/* Change staff status Ajax */
else if(isset($_POST["change_staff_status"])){
    $obj_staff->id = $_POST["id"];
    $obj_staff->status = $_POST["status"];
    $changed = $obj_staff->update_status();
    if($changed){
        echo "changed";
    }
}

/* Delete staff Ajax */
else if(isset($_POST['delete_staff'])){
	$obj_staff->id = $_POST["id"];
	$check_appointments = $obj_staff->check_appointments_before_delete_staff();
	if(mysqli_num_rows($check_appointments)>0){
		echo "appointments exist";
	}else{
		$staff = $obj_staff->readone_staff();
		$old_image = $staff['image'];
		if($old_image != ""){
			if(file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image)){
				unlink(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image);
			}
		}
		$deleted = $obj_staff->delete_staff();
		if($deleted){
			echo "deleted";
		}else{
			echo "failed";
		}
	}
}

/* Save staff detail Ajax */
else if(isset($_POST["save_staff"])){
    $obj_staff->id = $_POST['id'];
	$obj_staff->firstname = htmlentities($_POST['firstname']);
	$obj_staff->lastname = htmlentities($_POST['lastname']);
	$obj_staff->phone = $_POST['phone'];
	$obj_staff->address = htmlentities($_POST['address']);
	$obj_staff->city = htmlentities($_POST['city']);
	$obj_staff->state = htmlentities($_POST['state']);
	$obj_staff->country = htmlentities($_POST['country']);
	$obj_staff->zip = htmlentities($_POST['zip']);
	if($_POST['uploaded_file'] != ""){
		$old_image = $obj_staff->get_image_name_of_staff();
		if($old_image != ""){
			if(file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image)){
				unlink(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$old_image);
			}
		}
		$new_filename = time();
		$uploaded_filename = $obj_settings->rzvy_base64_to_jpeg($_POST['uploaded_file'], $image_upload_abs_path, $new_filename);
		$obj_staff->image = $uploaded_filename;
		$updated = $obj_staff->update_staff_with_image();
		if($updated){
			echo "updated";
		}
	}else{
		$updated = $obj_staff->update_staff_without_image();
		if($updated){
			echo "updated";
		}
	}
}

/* add staff Ajax */
else if(isset($_POST["add_staff"])){
	$obj_staff->firstname = htmlentities($_POST['firstname']);
	$obj_staff->lastname = htmlentities($_POST['lastname']);
    $obj_staff->password = md5($_POST['password']);
    $obj_staff->email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
    $obj_staff->status = "Y";
    $obj_staff->position = "0";
    $added = $obj_staff->add_staff();
    if($added){
        echo "added";
    }
}

/* link staff services Ajax */
else if(isset($_POST["save_staff_services"])){
	$obj_staff->id = $_POST['id'];
	$services = $_POST['services'];
    $truncated = $obj_staff->truncate_staff_services();
    if($services != ""){
        $exploded_services = explode(",",$services);
        foreach($exploded_services as $service){
            $obj_staff->service_id = $service;
            $obj_staff->save_staff_services();
        }
    }
}

/* add staff schedule Ajax */
else if(isset($_POST["save_staff_schedule"])){
	$obj_staff->id = $_POST['id'];
	$starttime = $_POST['starttime'];
	$endtime = $_POST['endtime'];
	$offday = $_POST['offday'];
	$no_of_booking = $_POST['no_of_booking'];
    if(sizeof($offday)>0){
        for($i=0;$i<sizeof($offday);$i++){
            $obj_staff->weekday_id = ($i+1);
            $obj_staff->starttime = $starttime[$i];
            $obj_staff->endtime = $endtime[$i];
            $obj_staff->offday = $offday[$i];
            $obj_staff->no_of_booking = $no_of_booking[$i];
            $obj_staff->add_service_schedule();
        }
    }
}

/* add staff breaks Ajax */
else if(isset($_POST["add_staff_breaks"])){
	$obj_staff->id = $_POST['id'];
	$obj_staff->weekday_id = $_POST['dayid'];
	$obj_staff->break_start = $_POST['break_start'];
    $obj_staff->break_end = $_POST['break_end'];
    $added = $obj_staff->add_staff_breaks();
    if($added){
        echo "added";
    }
}

/** Delete Staff break AJAX */
else if(isset($_POST["delete_staffbreak"])){
    $obj_staff->id = $_POST['id'];
    $deleted = $obj_staff->delete_staff_break();
    if($deleted){
        echo "deleted";
    }
}

/*** Add Staff Days off Ajax */
else if(isset($_POST["add_staff_daysoff"])){
    $obj_staff->id = $_POST['id'];
    $obj_staff->off_date = $_POST["off_date"];
    $added = $obj_staff->add_staff_daysoff();
    if($added){
        echo "added";
    }
}

/** Delete Staff daysoff AJAX */
else if(isset($_POST["delete_staffdaysoff"])){
    $obj_staff->id = $_POST['id'];
    $deleted = $obj_staff->delete_staffdaysoff();
    if($deleted){
        echo "deleted";
    }
}

/** Set staff calendar */
else if(isset($_POST["set_staff_calendar"])){
    $_SESSION["rzvy_staff_calendar"] = $_POST["id"];
}

else if(isset($_POST["update_break_data_content"])){ 
    $rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
    $time_interval = $obj_settings->get_option('rzvy_timeslot_interval');
	$weekday_id = $_POST["weekday_id"];
	$schedule_starttime = $_POST['start_time'];
	$schedule_endtime = $_POST['end_time'];
	$slot_options = $obj_staff->generate_break_dropdown_options($time_interval, $rzvy_time_format, $schedule_starttime, $schedule_endtime); 

	?>
	<div class="col-md-12"> 
		<div class="form-group row"> 
			<div class="col-md-6"> 
				<label class="control-label"><?php if(isset($rzvy_translangArr['break_start'])){ echo $rzvy_translangArr['break_start']; }else{ echo $rzvy_defaultlang['break_start']; } ?></label> 
				<select class="form-control" id="rzvy_addbreak_starttime_<?php echo $weekday_id; ?>" name="rzvy_addbreak_starttime_<?php echo $weekday_id; ?>">
					<?php echo $slot_options["break_starttime"]; ?>
				</select> 
			</div> 
			<div class="col-md-6">
				<label class="control-label"><?php if(isset($rzvy_translangArr['break_end'])){ echo $rzvy_translangArr['break_end']; }else{ echo $rzvy_defaultlang['break_end']; } ?></label> 
				<select class="form-control" id="rzvy_addbreak_endtime_<?php echo $weekday_id; ?>" name="rzvy_addbreak_endtime_<?php echo $weekday_id; ?>">
					<?php echo $slot_options["break_endtime"]; ?>
				</select> 
			</div> 
		</div> 
	</div>
	<?php  
}

/** Change Password Ajax **/
else if(isset($_POST['change_staff_password'])){
	$obj_staff->id = $_SESSION['staff_id'];
	$obj_staff->password = md5($_POST['old_password']);
	$check_old_password = $obj_staff->check_old_password();
	if($check_old_password){
		$obj_staff->id = $_SESSION['staff_id'];
		$obj_staff->password = md5($_POST['new_password']);
		$change_password = $obj_staff->change_password();
		if($change_password){
			echo "changed";
		}
	}else{
		echo "wrong";
	}
}

/** Change Email Ajax **/
else if(isset($_POST['change_email'])){
	$email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
	$obj_staff->id = $_POST["id"];
	$obj_staff->email = $email;
	$staff_email = $obj_staff->get_staff_email();

	if($email == $staff_email){
		echo "updated";
	}else{
		$is_available = $obj_staff->check_email_availability($staff_email);
		if($is_available){
			$updated = $obj_staff->update_email();
			if($updated){
				echo "updated";
			}
		}else{
			echo "exist";
		}
	}
}