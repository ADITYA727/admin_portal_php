<?php 
include 'header.php';
$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
$time_interval = $obj_settings->get_option('rzvy_timeslot_interval');
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['schedule'])){ echo $rzvy_translangArr['schedule']; }else{ echo $rzvy_defaultlang['schedule']; } ?></li>
      </ol>
	  <div class="mb-3">
		<div class="pull-left">
			<h4> <?php if(isset($rzvy_translangArr['manage_weekly_schedule'])){ echo $rzvy_translangArr['manage_weekly_schedule']; }else{ echo $rzvy_defaultlang['manage_weekly_schedule']; } ?> </h4>
		</div>
		<div class="pull-right mb-3">
			<a href="<?php echo SITE_URL; ?>backend/manage-blockoff.php" class="btn btn-info text-white btn-sm"><i class="fa fa-calendar-o"></i> <?php if(isset($rzvy_translangArr['manage_block_off'])){ echo $rzvy_translangArr['manage_block_off']; }else{ echo $rzvy_defaultlang['manage_block_off']; } ?></a>
		</div>
		<div class="table-responsive">
            <table class="table" class="table" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th><?php if(isset($rzvy_translangArr['day'])){ echo $rzvy_translangArr['day']; }else{ echo $rzvy_defaultlang['day']; } ?></th>
                  <th><?php if(isset($rzvy_translangArr['working_day'])){ echo $rzvy_translangArr['working_day']; }else{ echo $rzvy_defaultlang['working_day']; } ?></th>
                  <th><?php if(isset($rzvy_translangArr['start_time'])){ echo $rzvy_translangArr['start_time']; }else{ echo $rzvy_defaultlang['start_time']; } ?></th>
                  <th><?php if(isset($rzvy_translangArr['end_time'])){ echo $rzvy_translangArr['end_time']; }else{ echo $rzvy_defaultlang['end_time']; } ?></th>
                </tr>
              </thead>
              <tbody>
				<?php 
				if(isset($rzvy_translangArr['monday'])){ $monday =  $rzvy_translangArr['monday']; }else{  $monday =  $rzvy_defaultlang['monday']; } 				if(isset($rzvy_translangArr['tuesday'])){ $tuesday =  $rzvy_translangArr['tuesday']; }else{  $tuesday =  $rzvy_defaultlang['tuesday']; } 				if(isset($rzvy_translangArr['wednesday'])){ $wednesday =  $rzvy_translangArr['wednesday']; }else{  $wednesday =  $rzvy_defaultlang['wednesday']; } 				if(isset($rzvy_translangArr['thursday'])){ $thursday =  $rzvy_translangArr['thursday']; }else{  $thursday =  $rzvy_defaultlang['thursday']; } 				if(isset($rzvy_translangArr['friday'])){ $friday =  $rzvy_translangArr['friday']; }else{  $friday =  $rzvy_defaultlang['friday']; } 				if(isset($rzvy_translangArr['saturday'])){ $saturday =  $rzvy_translangArr['saturday']; }else{  $saturday =  $rzvy_defaultlang['saturday']; } 				if(isset($rzvy_translangArr['sunday'])){ $sunday =  $rzvy_translangArr['sunday']; }else{  $sunday =  $rzvy_defaultlang['sunday']; } 										$day_array = array("$monday", "$tuesday", "$wednesday", "$thursday", "$friday", "$saturday", "$sunday");
				$get_schedule = $obj_schedule->get_schedule();
				while($schedule = mysqli_fetch_array($get_schedule)){ 
					?>
					<tr>
					  <td><?php echo $day_array[$schedule['weekday_id']-1]; ?></td>
					  <td>
						<label class="rzvy-toggle-switch">
						<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_schedule_status" data-id="<?php echo $schedule['id']; ?>" <?php if($schedule['offday'] == 'N'){ echo "checked"; } ?> />
						  <span class="rzvy-toggle-switch-slider"></span>
						</label>
					  </td>
					  <td>
						<input type="hidden" class="rzvy_starttime_dropdown_hidden_<?php echo $schedule['id']; ?>" value="<?php echo $schedule['starttime']; ?>" />
						<select class="form-control selectpicker rzvy_starttime_dropdown" data-id="<?php echo $schedule['id']; ?>" id="rzvy_starttime_dropdown_<?php echo $schedule['id']; ?>">
							<?php 
							$schedule_starttime = $schedule['starttime'];
							echo $obj_schedule->generate_slot_dropdown_options($time_interval, $rzvy_time_format, $schedule_starttime);
							?>
						</select>
					  </td>
					  <td>
						<input type="hidden" class="rzvy_endtime_dropdown_hidden_<?php echo $schedule['id']; ?>" value="<?php echo $schedule['endtime']; ?>" />
						<select class="form-control selectpicker rzvy_endtime_dropdown" data-id="<?php echo $schedule['id']; ?>" data-db_endtime="<?php echo $schedule['endtime']; ?>" id="rzvy_endtime_dropdown_<?php echo $schedule['id']; ?>">
							<?php 
							$schedule_endtime = $schedule['endtime'];
							echo $obj_schedule->generate_slot_dropdown_options($time_interval, $rzvy_time_format, $schedule_endtime);
							?>
						</select>
					  </td>
					</tr>
					<?php 
				} 
				?>
              </tbody>
            </table>
		</div>
      </div>
<?php include 'footer.php'; ?>