<?php include 'header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['appointment_reminder'])){ echo $rzvy_translangArr['appointment_reminder']; }else{ echo $rzvy_defaultlang['appointment_reminder']; } ?></li>
      </ol>
      <!-- DataTables Card-->
	  <div class="mb-3">
		<div class="rzvy-tabbable-panel">
			<div class="rzvy-tabbable-line">
				<ul class="nav nav-tabs">
				 <li class="nav-item active custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="0" data-toggle="tab" href="#rzvy_templates_reminder_settings"><i class="fa fa-bell"></i><?php if(isset($rzvy_translangArr['email_sms_reminder_cron_job_settings'])){ echo $rzvy_translangArr['email_sms_reminder_cron_job_settings']; }else{ echo $rzvy_defaultlang['email_sms_reminder_cron_job_settings']; } ?></a>
				  </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active container" id="rzvy_templates_reminder_settings">
						<div class="row mb-3 mt-3">
							<div class="col-md-12">
								<h5><?php if(isset($rzvy_translangArr['appointment_reminder_buffer_time'])){ echo $rzvy_translangArr['appointment_reminder_buffer_time']; }else{ echo $rzvy_defaultlang['appointment_reminder_buffer_time']; } ?></h5>
							</div>
							<div class="col-md-4">
								<?php $rzvy_reminder_buffer_time = $obj_settings->get_option("rzvy_reminder_buffer_time"); ?>
								<select name="rzvy_reminder_buffer_time" id="rzvy_reminder_buffer_time" class="form-control selectpicker">
								  <option value="15" <?php if($rzvy_reminder_buffer_time == "15"){ echo "selected"; } ?>>15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="20" <?php if($rzvy_reminder_buffer_time == "20"){ echo "selected"; } ?>>20 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="30" <?php if($rzvy_reminder_buffer_time == "30"){ echo "selected"; } ?>>30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="45" <?php if($rzvy_reminder_buffer_time == "45"){ echo "selected"; } ?>>45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="60" <?php if($rzvy_reminder_buffer_time == "60"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="75" <?php if($rzvy_reminder_buffer_time == "75"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="90" <?php if($rzvy_reminder_buffer_time == "90"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="105" <?php if($rzvy_reminder_buffer_time == "105"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="120" <?php if($rzvy_reminder_buffer_time == "120"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="135" <?php if($rzvy_reminder_buffer_time == "135"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="150" <?php if($rzvy_reminder_buffer_time == "150"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="165" <?php if($rzvy_reminder_buffer_time == "165"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="180" <?php if($rzvy_reminder_buffer_time == "180"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="195" <?php if($rzvy_reminder_buffer_time == "195"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="210" <?php if($rzvy_reminder_buffer_time == "210"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="225" <?php if($rzvy_reminder_buffer_time == "225"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
								  <option value="240" <?php if($rzvy_reminder_buffer_time == "240"){ echo "selected"; } ?>>4 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="300" <?php if($rzvy_reminder_buffer_time == "300"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="360" <?php if($rzvy_reminder_buffer_time == "360"){ echo "selected"; } ?>>6 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="420" <?php if($rzvy_reminder_buffer_time == "420"){ echo "selected"; } ?>>7 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="480" <?php if($rzvy_reminder_buffer_time == "480"){ echo "selected"; } ?>>8 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="540" <?php if($rzvy_reminder_buffer_time == "540"){ echo "selected"; } ?>>9 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="600" <?php if($rzvy_reminder_buffer_time == "600"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="660" <?php if($rzvy_reminder_buffer_time == "660"){ echo "selected"; } ?>>11 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="720" <?php if($rzvy_reminder_buffer_time == "720"){ echo "selected"; } ?>>12 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="1440" <?php if($rzvy_reminder_buffer_time == "1440"){ echo "selected"; } ?>>24 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="2160" <?php if($rzvy_reminder_buffer_time == "2160"){ echo "selected"; } ?>>36 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								  <option value="2880" <?php if($rzvy_reminder_buffer_time == "2880"){ echo "selected"; } ?>>48 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
								</select>
							</div>
						</div>
						<div class="row mb-3 mt-3">
							<div class="col-md-12 mb-3 border p-3">
								<h4 class="mb-3 text-center"><i class="fa fa-bell-o"></i><?php if(isset($rzvy_translangArr['appointment_reminder_cron_job'])){ echo $rzvy_translangArr['appointment_reminder_cron_job']; }else{ echo $rzvy_defaultlang['appointment_reminder_cron_job']; } ?></h4>
								<p class="border p-2"><?php if(isset($rzvy_translangArr['use_this_url'])){ echo $rzvy_translangArr['use_this_url']; }else{ echo $rzvy_defaultlang['use_this_url']; } ?> <code><?php echo SITE_URL; ?>includes/cron/rzvy_appointment_reminder.php</code></p>
								<p class="border p-2"><i class="fa fa-info-circle"></i><?php if(isset($rzvy_translangArr['manually_setup_a_cron'])){ echo $rzvy_translangArr['manually_setup_a_cron']; }else{ echo $rzvy_defaultlang['manually_setup_a_cron']; } ?></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	  </div>
<?php include 'footer.php'; ?>