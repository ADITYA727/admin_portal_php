</div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#rzvy-page-top">
      <i class="fa fa-angle-up"></i>
    </a>
	
	<!-- Appointment Detail Modal-->
	<div class="modal fade" id="rzvy_appointment_detail_modal" tabindex="-1" role="dialog" aria-labelledby="rzvy_appointment_detail_modal_label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy_appointment_detail_modal_label"><?php if(isset($rzvy_translangArr['appointment_detail'])){ echo $rzvy_translangArr['appointment_detail']; }else{ echo $rzvy_defaultlang['appointment_detail']; } ?></h5>
			<div class="pull-right">
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
		  </div>
		  <div class="modal-body rzvy_appointment_detail_modal_body">
			<center><h2><?php if(isset($rzvy_translangArr['please_wait'])){ echo $rzvy_translangArr['please_wait']; }else{ echo $rzvy_defaultlang['please_wait']; } ?></h2></center>
		  </div>
		  <div class="modal-footer"> </div>
		</div>
	  </div>
	</div>	
	
    <!-- Logout Modal-->
    <div class="modal fade" id="rzvy-logout-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-logout-modal-label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rzvy-logout-modal-label"><?php if(isset($rzvy_translangArr['ready_to_leave'])){ echo $rzvy_translangArr['ready_to_leave']; }else{ echo $rzvy_defaultlang['ready_to_leave']; } ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body"><?php if(isset($rzvy_translangArr['select_logout_below'])){ echo $rzvy_translangArr['select_logout_below']; }else{ echo $rzvy_defaultlang['select_logout_below']; } ?></div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
            <a id="rzvy_logout_btn" class="btn btn-primary" href="javascript:void(0)"><?php if(isset($rzvy_translangArr['logout'])){ echo $rzvy_translangArr['logout']; }else{ echo $rzvy_defaultlang['logout']; } ?></a>
          </div>
        </div>
      </div>
    </div>
		
    <!-- Change Password Modal-->
    <div class="modal fade" id="rzvy-change-password-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-change-password-modal-label" aria-hidden="true" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rzvy-change-password-modal-label"><?php if(isset($rzvy_translangArr['change_password'])){ echo $rzvy_translangArr['change_password']; }else{ echo $rzvy_defaultlang['change_password']; } ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
			<form name="rzvy_change_password_form" id="rzvy_change_password_form" method="post">
			  <div class="form-group">
				<label for="rzvy_old_password"><?php if(isset($rzvy_translangArr['old_password'])){ echo $rzvy_translangArr['old_password']; }else{ echo $rzvy_defaultlang['old_password']; } ?></label>
				<input class="form-control" id="rzvy_old_password" name="rzvy_old_password" type="password" placeholder="<?php if(isset($rzvy_translangArr['enter_old_password'])){ echo $rzvy_translangArr['enter_old_password']; }else{ echo $rzvy_defaultlang['enter_old_password']; } ?>" autocomplete="off" />
			  </div>
			  <div class="form-group">
				<label for="rzvy_new_password"><?php if(isset($rzvy_translangArr['new_password'])){ echo $rzvy_translangArr['new_password']; }else{ echo $rzvy_defaultlang['new_password']; } ?></label>
				<input class="form-control" id="rzvy_new_password" name="rzvy_new_password" type="password" placeholder="<?php if(isset($rzvy_translangArr['enter_new_password'])){ echo $rzvy_translangArr['enter_new_password']; }else{ echo $rzvy_defaultlang['enter_new_password']; } ?>" autocomplete="off" />
			  </div>
			  <div class="form-group">
				<label for="rzvy_rtype_password"><?php if(isset($rzvy_translangArr['retype_new_password'])){ echo $rzvy_translangArr['retype_new_password']; }else{ echo $rzvy_defaultlang['retype_new_password']; } ?></label>
				<input class="form-control" id="rzvy_rtype_password" name="rzvy_rtype_password" type="password" placeholder="<?php if(isset($rzvy_translangArr['enter_retype_new_password'])){ echo $rzvy_translangArr['enter_retype_new_password']; }else{ echo $rzvy_defaultlang['enter_retype_new_password']; } ?>" autocomplete="off" />
			  </div>
			</form>
		  </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
            <a class="btn btn-primary rzvy_change_password_btn" data-id="<?php if(isset($_SESSION['staff_id'])){ echo $_SESSION['staff_id']; } ?>" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['change_password'])){ echo $rzvy_translangArr['change_password']; }else{ echo $rzvy_defaultlang['change_password']; } ?></a>
          </div>
        </div>
      </div>
    </div>
	<!-- Setup instruction Modal-->
    <div class="modal fade" id="rzvy-setup-instruction-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-setup-instruction-modal-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rzvy-setup-instruction-modal-label"><?php if(isset($rzvy_translangArr['setup_instructions'])){ echo $rzvy_translangArr['setup_instructions']; }else{ echo $rzvy_defaultlang['setup_instructions']; } ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
			<div class="row border p-4">
				<label><b><?php if(isset($rzvy_translangArr['instructions_step_1'])){ echo $rzvy_translangArr['instructions_step_1']; }else{ echo $rzvy_defaultlang['instructions_step_1']; } ?> </b> <?php if(isset($rzvy_translangArr['step_1_text'])){ echo $rzvy_translangArr['step_1_text']; }else{ echo $rzvy_defaultlang['step_1_text']; } ?></label>
			</div>
			<div class="row border p-4">
				<label><b><?php if(isset($rzvy_translangArr['instructions_step_2'])){ echo $rzvy_translangArr['instructions_step_2']; }else{ echo $rzvy_defaultlang['instructions_step_2']; } ?> </b> <?php if(isset($rzvy_translangArr['step_2_text'])){ echo $rzvy_translangArr['step_2_text']; }else{ echo $rzvy_defaultlang['step_2_text']; } ?></label>
			</div>
			<div class="row border p-4">
				<label><b><?php if(isset($rzvy_translangArr['instructions_step_3'])){ echo $rzvy_translangArr['instructions_step_3']; }else{ echo $rzvy_defaultlang['instructions_step_3']; } ?> </b> <?php if(isset($rzvy_translangArr['step_3_text'])){ echo $rzvy_translangArr['logout']; }else{ echo $rzvy_defaultlang['step_3_text']; } ?></label>
			</div>
		  </div>
        </div>
      </div>
    </div>
	<?php 
	$check_for_setup_instruction_modal = $obj_settings->check_for_setup_instruction_modal(); 
	if($check_for_setup_instruction_modal == "N"){
		if($obj_settings->get_option("rzvy_company_name") == "" || $obj_settings->get_option("rzvy_company_email") == "" || $obj_settings->get_option("rzvy_company_phone") == ""){
			$check_for_setup_instruction_modal = "Y";
		}
	} 
	
	$check_for_setup_instruction_modal = "N";
	?>	
	<!-- Bootstrap core JavaScript-->
    <script src='<?php echo SITE_URL; ?>includes/vendor/calendar/moment.min.js?<?php echo time(); ?>'></script>
	<script src="<?php echo SITE_URL; ?>includes/vendor/jquery/jquery.min.js?<?php echo time(); ?>"></script>
    <script src="<?php echo SITE_URL; ?>includes/vendor/jquery/jquery.validate.min.js?<?php echo time(); ?>"></script>
	<script src='<?php echo SITE_URL; ?>includes/vendor/calendar/fullcalendar.min.js?<?php echo time(); ?>'></script>
    <script src="<?php echo SITE_URL; ?>includes/vendor/bootstrap/js/bootstrap.bundle.min.js?<?php echo time(); ?>"></script>
    <script src="<?php echo SITE_URL; ?>includes/vendor/bootstrap/js/bootstrap-select.min.js?<?php echo time(); ?>"></script>
    <script src="<?php echo SITE_URL; ?>includes/vendor/sweetalert/sweetalert.js?<?php echo time(); ?>"></script>
    <!-- Core plugin JavaScript-->
    <script src="<?php echo SITE_URL; ?>includes/vendor/jquery-easing/jquery.easing.min.js?<?php echo time(); ?>"></script>
    <!-- Page level plugin JavaScript-->
    <script src="<?php echo SITE_URL; ?>includes/vendor/datatables/datatables.min.js?<?php echo time(); ?>"></script>
    <!-- Custom scripts for all pages-->
	<script>
		var generalObj = { 'site_url' : '<?php echo SITE_URL; ?>', 'ajax_url' : '<?php echo AJAX_URL; ?>', 'current_date' : '<?php echo date('Y-m-d', $currDateTime_withTZ); ?>', 'setup_instruction_modal_status': '<?php echo $check_for_setup_instruction_modal; ?>', 'ty_link' : '<?php echo $obj_settings->get_option('rzvy_thankyou_page_url'); ?>', 'endslot_status' : '<?php echo $obj_settings->get_option('rzvy_endtimeslot_selection_status'); ?>', 'single_category_status' : '<?php echo $obj_settings->get_option('rzvy_single_category_autotrigger_status'); ?>', 'single_service_status' : '<?php echo $obj_settings->get_option('rzvy_single_service_autotrigger_status'); ?>', 'defaultCountryCode' : '<?php $rzvy_default_country_code = $obj_settings->get_option("rzvy_default_country_code"); if($rzvy_default_country_code != ""){ echo $rzvy_default_country_code; }else{ echo "us"; } ?>',

		'today' : '<?php if(isset($rzvy_translangArr['today'])){ echo $rzvy_translangArr['today']; }else{ echo $rzvy_defaultlang['today']; } ?>',
		'calendar_view' : '<?php if(isset($rzvy_translangArr['calendar_view'])){ echo $rzvy_translangArr['calendar_view']; }else{ echo $rzvy_defaultlang['calendar_view']; } ?>',
		'month_list_view' : '<?php if(isset($rzvy_translangArr['month_list_view'])){ echo $rzvy_translangArr['month_list_view']; }else{ echo $rzvy_defaultlang['month_list_view']; } ?>',
		'year_list_view' : '<?php if(isset($rzvy_translangArr['year_list_view'])){ echo $rzvy_translangArr['year_list_view']; }else{ echo $rzvy_defaultlang['year_list_view']; } ?>',
		'reschedule_reason_ad' : '<?php if(isset($rzvy_translangArr['reschedule_reason_ad'])){ echo $rzvy_translangArr['reschedule_reason_ad']; }else{ echo $rzvy_defaultlang['reschedule_reason_ad']; } ?>',
		'enter_reschedule_reason' : '<?php if(isset($rzvy_translangArr['enter_reschedule_reason'])){ echo $rzvy_translangArr['enter_reschedule_reason']; }else{ echo $rzvy_defaultlang['enter_reschedule_reason']; } ?>',
		'rescheduled' : '<?php if(isset($rzvy_translangArr['rescheduled'])){ echo $rzvy_translangArr['rescheduled']; }else{ echo $rzvy_defaultlang['rescheduled']; } ?>',
		'appointment_rescheduled_successfully' : '<?php if(isset($rzvy_translangArr['appointment_rescheduled_successfully'])){ echo $rzvy_translangArr['appointment_rescheduled_successfully']; }else{ echo $rzvy_defaultlang['appointment_rescheduled_successfully']; } ?>',
		'opps' : '<?php if(isset($rzvy_translangArr['opps'])){ echo $rzvy_translangArr['opps']; }else{ echo $rzvy_defaultlang['opps']; } ?>',
		'something_went_wrong_please_try_again' : '<?php if(isset($rzvy_translangArr['something_went_wrong_please_try_again'])){ echo $rzvy_translangArr['something_went_wrong_please_try_again']; }else{ echo $rzvy_defaultlang['something_went_wrong_please_try_again']; } ?>',
		'you_can_not_book_on_previous_date' : '<?php if(isset($rzvy_translangArr['you_can_not_book_on_previous_date'])){ echo $rzvy_translangArr['you_can_not_book_on_previous_date']; }else{ echo $rzvy_defaultlang['you_can_not_book_on_previous_date']; } ?>',
		'please_enter_only_alphabets' : '<?php if(isset($rzvy_translangArr['please_enter_only_alphabets'])){ echo $rzvy_translangArr['please_enter_only_alphabets']; }else{ echo $rzvy_defaultlang['please_enter_only_alphabets']; } ?>',
		'please_enter_only_numerics' : '<?php if(isset($rzvy_translangArr['please_enter_only_numerics'])){ echo $rzvy_translangArr['please_enter_only_numerics']; }else{ echo $rzvy_defaultlang['please_enter_only_numerics']; } ?>',
		'please_enter_valid_phone_number_without_country_code' : '<?php if(isset($rzvy_translangArr['please_enter_valid_phone_number_without_country_code'])){ echo $rzvy_translangArr['please_enter_valid_phone_number_without_country_code']; }else{ echo $rzvy_defaultlang['please_enter_valid_phone_number_without_country_code']; } ?>',
		'please_enter_valid_zip' : '<?php if(isset($rzvy_translangArr['please_enter_valid_zip'])){ echo $rzvy_translangArr['please_enter_valid_zip']; }else{ echo $rzvy_defaultlang['please_enter_valid_zip']; } ?>','maximum_file_upload_size_1_mb' : '<?php if(isset($rzvy_translangArr['maximum_file_upload_size_1_mb'])){ echo $rzvy_translangArr['maximum_file_upload_size_1_mb']; }else{ echo $rzvy_defaultlang['maximum_file_upload_size_1_mb']; } ?>',
		'please_select_a_valid_image_file' : '<?php if(isset($rzvy_translangArr['please_select_a_valid_image_file'])){ echo $rzvy_translangArr['please_select_a_valid_image_file']; }else{ echo $rzvy_defaultlang['please_select_a_valid_image_file']; } ?>',
		'added' : '<?php if(isset($rzvy_translangArr['added'])){ echo $rzvy_translangArr['added']; }else{ echo $rzvy_defaultlang['added']; } ?>',
		'updated' : '<?php if(isset($rzvy_translangArr['updated'])){ echo $rzvy_translangArr['updated']; }else{ echo $rzvy_defaultlang['updated']; } ?>',
		'deleted' : '<?php if(isset($rzvy_translangArr['deleted'])){ echo $rzvy_translangArr['deleted']; }else{ echo $rzvy_defaultlang['deleted']; } ?>',
		'marked_as_offday' : '<?php if(isset($rzvy_translangArr['marked_as_offday'])){ echo $rzvy_translangArr['marked_as_offday']; }else{ echo $rzvy_defaultlang['marked_as_offday']; } ?>',
		'marked_as_working_day' : '<?php if(isset($rzvy_translangArr['marked_as_working_day'])){ echo $rzvy_translangArr['marked_as_working_day']; }else{ echo $rzvy_defaultlang['marked_as_working_day']; } ?>',
		'successfully' : '<?php if(isset($rzvy_translangArr['successfully'])){ echo $rzvy_translangArr['successfully']; }else{ echo $rzvy_defaultlang['successfully']; } ?>',
		'schedule_start_time_updated_successfully' : '<?php if(isset($rzvy_translangArr['schedule_start_time_updated_successfully'])){ echo $rzvy_translangArr['schedule_start_time_updated_successfully']; }else{ echo $rzvy_defaultlang['schedule_start_time_updated_successfully']; } ?>',
		'please_select_start_time_less_than_end_time' : '<?php if(isset($rzvy_translangArr['please_select_start_time_less_than_end_time'])){ echo $rzvy_translangArr['please_select_start_time_less_than_end_time']; }else{ echo $rzvy_defaultlang['please_select_start_time_less_than_end_time']; } ?>',
		'schedule_end_time_updated_successfully' : '<?php if(isset($rzvy_translangArr['schedule_end_time_updated_successfully'])){ echo $rzvy_translangArr['schedule_end_time_updated_successfully']; }else{ echo $rzvy_defaultlang['schedule_end_time_updated_successfully']; } ?>',
		'please_select_end_time_greater_than_start_time' : '<?php if(isset($rzvy_translangArr['please_select_end_time_greater_than_start_time'])){ echo $rzvy_translangArr['please_select_end_time_greater_than_start_time']; }else{ echo $rzvy_defaultlang['please_select_end_time_greater_than_start_time']; } ?>',
		'are_you_sure' : '<?php if(isset($rzvy_translangArr['are_you_sure'])){ echo $rzvy_translangArr['are_you_sure']; }else{ echo $rzvy_defaultlang['are_you_sure']; } ?>',
		'you_want_to_confirm_this_appointment' : '<?php if(isset($rzvy_translangArr['you_want_to_confirm_this_appointment'])){ echo $rzvy_translangArr['you_want_to_confirm_this_appointment']; }else{ echo $rzvy_defaultlang['you_want_to_confirm_this_appointment']; } ?>',
		'yes_confirm_it' : '<?php if(isset($rzvy_translangArr['yes_confirm_it'])){ echo $rzvy_translangArr['yes_confirm_it']; }else{ echo $rzvy_defaultlang['yes_confirm_it']; } ?>',
		'cancel' : '<?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?>',
		'confirmed' : '<?php if(isset($rzvy_translangArr['confirmed'])){ echo $rzvy_translangArr['confirmed']; }else{ echo $rzvy_defaultlang['confirmed']; } ?>',
		'appointment_confirmed_successfully' : '<?php if(isset($rzvy_translangArr['appointment_confirmed_successfully'])){ echo $rzvy_translangArr['appointment_confirmed_successfully']; }else{ echo $rzvy_defaultlang['appointment_confirmed_successfully']; } ?>',
		'you_want_to_mark_this_appointment_as_pending' : '<?php if(isset($rzvy_translangArr['you_want_to_mark_this_appointment_as_pending'])){ echo $rzvy_translangArr['you_want_to_mark_this_appointment_as_pending']; }else{ echo $rzvy_defaultlang['you_want_to_mark_this_appointment_as_pending']; } ?>',
		'yes_mark_as_pending' : '<?php if(isset($rzvy_translangArr['yes_mark_as_pending'])){ echo $rzvy_translangArr['yes_mark_as_pending']; }else{ echo $rzvy_defaultlang['yes_mark_as_pending']; } ?>',
		'marked_as_pending' : '<?php if(isset($rzvy_translangArr['marked_as_pending'])){ echo $rzvy_translangArr['marked_as_pending']; }else{ echo $rzvy_defaultlang['marked_as_pending']; } ?>',
		'appointment_marked_as_pending_successfully' : '<?php if(isset($rzvy_translangArr['appointment_marked_as_pending_successfully'])){ echo $rzvy_translangArr['appointment_marked_as_pending_successfully']; }else{ echo $rzvy_defaultlang['appointment_marked_as_pending_successfully']; } ?>',
		'yes_mark_as_completed' : '<?php if(isset($rzvy_translangArr['yes_mark_as_completed'])){ echo $rzvy_translangArr['yes_mark_as_completed']; }else{ echo $rzvy_defaultlang['yes_mark_as_completed']; } ?>',
		'you_want_to_mark_this_appointment_as_complete' : '<?php if(isset($rzvy_translangArr['you_want_to_mark_this_appointment_as_complete'])){ echo $rzvy_translangArr['you_want_to_mark_this_appointment_as_complete']; }else{ echo $rzvy_defaultlang['you_want_to_mark_this_appointment_as_complete']; } ?>',
		'marked_as_completed' : '<?php if(isset($rzvy_translangArr['marked_as_completed'])){ echo $rzvy_translangArr['marked_as_completed']; }else{ echo $rzvy_defaultlang['marked_as_completed']; } ?>',
		'appointment_marked_as_completed_successfully' : '<?php if(isset($rzvy_translangArr['appointment_marked_as_completed_successfully'])){ echo $rzvy_translangArr['appointment_marked_as_completed_successfully']; }else{ echo $rzvy_defaultlang['appointment_marked_as_completed_successfully']; } ?>',
		'rescheduled' : '<?php if(isset($rzvy_translangArr['rescheduled'])){ echo $rzvy_translangArr['rescheduled']; }else{ echo $rzvy_defaultlang['rescheduled']; } ?>',
		'appointment_rescheduled_successfully' : '<?php if(isset($rzvy_translangArr['appointment_rescheduled_successfully'])){ echo $rzvy_translangArr['appointment_rescheduled_successfully']; }else{ echo $rzvy_defaultlang['appointment_rescheduled_successfully']; } ?>',
		'rejected' : '<?php if(isset($rzvy_translangArr['rejected'])){ echo $rzvy_translangArr['rejected']; }else{ echo $rzvy_defaultlang['rejected']; } ?>',
		'appointment_rejected_successfully' : '<?php if(isset($rzvy_translangArr['appointment_rejected_successfully'])){ echo $rzvy_translangArr['appointment_rejected_successfully']; }else{ echo $rzvy_defaultlang['appointment_rejected_successfully']; } ?>',
		'please_enter_old_password' : '<?php if(isset($rzvy_translangArr['please_enter_old_password'])){ echo $rzvy_translangArr['please_enter_old_password']; }else{ echo $rzvy_defaultlang['please_enter_old_password']; } ?>',
		'please_enter_minimum_8_characters' : '<?php if(isset($rzvy_translangArr['please_enter_minimum_8_characters'])){ echo $rzvy_translangArr['please_enter_minimum_8_characters']; }else{ echo $rzvy_defaultlang['please_enter_minimum_8_characters']; } ?>',
		'please_enter_maximum_20_characters' : '<?php if(isset($rzvy_translangArr['please_enter_maximum_20_characters'])){ echo $rzvy_translangArr['please_enter_maximum_20_characters']; }else{ echo $rzvy_defaultlang['please_enter_maximum_20_characters']; } ?>',
		'new_password_and_retype_new_password_mismatch' : '<?php if(isset($rzvy_translangArr['new_password_and_retype_new_password_mismatch'])){ echo $rzvy_translangArr['new_password_and_retype_new_password_mismatch']; }else{ echo $rzvy_defaultlang['new_password_and_retype_new_password_mismatch']; } ?>',
		'please_enter_retype_new_password' : '<?php if(isset($rzvy_translangArr['please_enter_retype_new_password'])){ echo $rzvy_translangArr['please_enter_retype_new_password']; }else{ echo $rzvy_defaultlang['please_enter_retype_new_password']; } ?>',
		'please_enter_new_password' : '<?php if(isset($rzvy_translangArr['please_enter_new_password'])){ echo $rzvy_translangArr['please_enter_new_password']; }else{ echo $rzvy_defaultlang['please_enter_new_password']; } ?>',
		'changed' : '<?php if(isset($rzvy_translangArr['changed'])){ echo $rzvy_translangArr['changed']; }else{ echo $rzvy_defaultlang['changed']; } ?>',
		'your_password_changed_successfully' : '<?php if(isset($rzvy_translangArr['your_password_changed_successfully'])){ echo $rzvy_translangArr['your_password_changed_successfully']; }else{ echo $rzvy_defaultlang['your_password_changed_successfully']; } ?>',
		'incorrect_old_password' : '<?php if(isset($rzvy_translangArr['incorrect_old_password'])){ echo $rzvy_translangArr['incorrect_old_password']; }else{ echo $rzvy_defaultlang['incorrect_old_password']; } ?>',
		'changed' : '<?php if(isset($rzvy_translangArr['changed'])){ echo $rzvy_translangArr['changed']; }else{ echo $rzvy_defaultlang['changed']; } ?>',
		'disabled' : '<?php if(isset($rzvy_translangArr['disabled'])){ echo $rzvy_translangArr['disabled']; }else{ echo $rzvy_defaultlang['disabled']; } ?>',
		'enabled' : '<?php if(isset($rzvy_translangArr['enabled'])){ echo $rzvy_translangArr['enabled']; }else{ echo $rzvy_defaultlang['enabled']; } ?>',
		'staff_status_changed_successfully' : '<?php if(isset($rzvy_translangArr['staff_status_changed_successfully'])){ echo $rzvy_translangArr['staff_status_changed_successfully']; }else{ echo $rzvy_defaultlang['staff_status_changed_successfully']; } ?>',
		"please_enter_first_name" : "<?php if(isset($rzvy_translangArr['please_enter_first_name'])){ echo $rzvy_translangArr['please_enter_first_name']; }else{ echo $rzvy_defaultlang['please_enter_first_name']; } ?>",
		"please_enter_maximum_50_characters" : "<?php if(isset($rzvy_translangArr['please_enter_maximum_50_characters'])){ echo $rzvy_translangArr['please_enter_maximum_50_characters']; }else{ echo $rzvy_defaultlang['please_enter_maximum_50_characters']; } ?>",
		"please_enter_last_name" : "<?php if(isset($rzvy_translangArr['please_enter_last_name'])){ echo $rzvy_translangArr['please_enter_last_name']; }else{ echo $rzvy_defaultlang['please_enter_last_name']; } ?>",
		"please_enter_phone_number" : "<?php if(isset($rzvy_translangArr['please_enter_phone_number'])){ echo $rzvy_translangArr['please_enter_phone_number']; }else{ echo $rzvy_defaultlang['please_enter_phone_number']; } ?>",
		"please_enter_minimum_10_digits" : "<?php if(isset($rzvy_translangArr['please_enter_minimum_10_digits'])){ echo $rzvy_translangArr['please_enter_minimum_10_digits']; }else{ echo $rzvy_defaultlang['please_enter_minimum_10_digits']; } ?>",
		"please_enter_maximum_15_digits" : "<?php if(isset($rzvy_translangArr['please_enter_maximum_15_digits'])){ echo $rzvy_translangArr['please_enter_maximum_15_digits']; }else{ echo $rzvy_defaultlang['please_enter_maximum_15_digits']; } ?>",
		"please_enter_address" : "<?php if(isset($rzvy_translangArr['please_enter_address'])){ echo $rzvy_translangArr['please_enter_address']; }else{ echo $rzvy_defaultlang['please_enter_address']; } ?>",
		"please_enter_city" : "<?php if(isset($rzvy_translangArr['please_enter_city'])){ echo $rzvy_translangArr['please_enter_city']; }else{ echo $rzvy_defaultlang['please_enter_city']; } ?>",
		"please_enter_state" : "<?php if(isset($rzvy_translangArr['please_enter_state'])){ echo $rzvy_translangArr['please_enter_state']; }else{ echo $rzvy_defaultlang['please_enter_state']; } ?>",
		"please_enter_zip" : "<?php if(isset($rzvy_translangArr['please_enter_zip'])){ echo $rzvy_translangArr['please_enter_zip']; }else{ echo $rzvy_defaultlang['please_enter_zip']; } ?>",
		"please_enter_minimum_5_characters" : "<?php if(isset($rzvy_translangArr['please_enter_minimum_5_characters'])){ echo $rzvy_translangArr['please_enter_minimum_5_characters']; }else{ echo $rzvy_defaultlang['please_enter_minimum_5_characters']; } ?>",
		"please_enter_maximum_10_characters" : "<?php if(isset($rzvy_translangArr['please_enter_maximum_10_characters'])){ echo $rzvy_translangArr['please_enter_maximum_10_characters']; }else{ echo $rzvy_defaultlang['please_enter_maximum_10_characters']; } ?>",
		"please_enter_country" : "<?php if(isset($rzvy_translangArr['please_enter_country'])){ echo $rzvy_translangArr['please_enter_country']; }else{ echo $rzvy_defaultlang['please_enter_country']; } ?>",
		"please_enter_email_address" : "<?php if(isset($rzvy_translangArr['please_enter_email_address'])){ echo $rzvy_translangArr['please_enter_email_address']; }else{ echo $rzvy_defaultlang['please_enter_email_address']; } ?>",
		"please_enter_valid_email_address" : "<?php if(isset($rzvy_translangArr['please_enter_valid_email_address'])){ echo $rzvy_translangArr['please_enter_valid_email_address']; }else{ echo $rzvy_defaultlang['please_enter_valid_email_address']; } ?>",
		'your_profile_updated_successfully' : '<?php if(isset($rzvy_translangArr['your_profile_updated_successfully'])){ echo $rzvy_translangArr['your_profile_updated_successfully']; }else{ echo $rzvy_defaultlang['your_profile_updated_successfully']; } ?>',
		'your_email_changed_successfully' : '<?php if(isset($rzvy_translangArr['your_email_changed_successfully'])){ echo $rzvy_translangArr['your_email_changed_successfully']; }else{ echo $rzvy_defaultlang['your_email_changed_successfully']; } ?>',
		'exist' : '<?php if(isset($rzvy_translangArr['exist'])){ echo $rzvy_translangArr['exist']; }else{ echo $rzvy_defaultlang['exist']; } ?>',
		'email_already_exist_please_try_to_update_with_not_registered_email' : '<?php if(isset($rzvy_translangArr['email_already_exist_please_try_to_update_with_not_registered_email'])){ echo $rzvy_translangArr['email_already_exist_please_try_to_update_with_not_registered_email']; }else{ echo $rzvy_defaultlang['email_already_exist_please_try_to_update_with_not_registered_email']; } ?>',
		'service_linked_successfully' : '<?php if(isset($rzvy_translangArr['service_linked_successfully'])){ echo $rzvy_translangArr['service_linked_successfully']; }else{ echo $rzvy_defaultlang['service_linked_successfully']; } ?>',
		'please_select_start_time_less_than_end_time_for' : '<?php if(isset($rzvy_translangArr['please_select_start_time_less_than_end_time_for'])){ echo $rzvy_translangArr['please_select_start_time_less_than_end_time_for']; }else{ echo $rzvy_defaultlang['please_select_start_time_less_than_end_time_for']; } ?>',
		'please_select_end_time_greater_than_start_time_for' : '<?php if(isset($rzvy_translangArr['please_select_end_time_greater_than_start_time_for'])){ echo $rzvy_translangArr['please_select_end_time_greater_than_start_time_for']; }else{ echo $rzvy_defaultlang['please_select_end_time_greater_than_start_time_for']; } ?>',
		'please_enter_valid_no_of_booking_for' : '<?php if(isset($rzvy_translangArr['please_enter_valid_no_of_booking_for'])){ echo $rzvy_translangArr['please_enter_valid_no_of_booking_for']; }else{ echo $rzvy_defaultlang['please_enter_valid_no_of_booking_for']; } ?>',
		'schedule_updated_successfully' : '<?php if(isset($rzvy_translangArr['schedule_updated_successfully'])){ echo $rzvy_translangArr['schedule_updated_successfully']; }else{ echo $rzvy_defaultlang['schedule_updated_successfully']; } ?>',
		'break_added_successfully' : '<?php if(isset($rzvy_translangArr['break_added_successfully'])){ echo $rzvy_translangArr['break_added_successfully']; }else{ echo $rzvy_defaultlang['break_added_successfully']; } ?>',
		'please_select_break_start_less_than_break_end' : '<?php if(isset($rzvy_translangArr['please_select_break_start_less_than_break_end'])){ echo $rzvy_translangArr['please_select_break_start_less_than_break_end']; }else{ echo $rzvy_defaultlang['please_select_break_start_less_than_break_end']; } ?>',
		'break_start_should_not_be_equal_to_break_end' : '<?php if(isset($rzvy_translangArr['break_start_should_not_be_equal_to_break_end'])){ echo $rzvy_translangArr['break_start_should_not_be_equal_to_break_end']; }else{ echo $rzvy_defaultlang['break_start_should_not_be_equal_to_break_end']; } ?>',
		'you_want_to_delete_this_break' : '<?php if(isset($rzvy_translangArr['you_want_to_delete_this_break'])){ echo $rzvy_translangArr['you_want_to_delete_this_break']; }else{ echo $rzvy_defaultlang['you_want_to_delete_this_break']; } ?>',
		'break_deleted_successfully' : '<?php if(isset($rzvy_translangArr['break_deleted_successfully'])){ echo $rzvy_translangArr['break_deleted_successfully']; }else{ echo $rzvy_defaultlang['break_deleted_successfully']; } ?>',
		'days_off_added_successfully' : '<?php if(isset($rzvy_translangArr['days_off_added_successfully'])){ echo $rzvy_translangArr['days_off_added_successfully']; }else{ echo $rzvy_defaultlang['days_off_added_successfully']; } ?>',
		'you_want_to_delete_this_offday' : '<?php if(isset($rzvy_translangArr['you_want_to_delete_this_offday'])){ echo $rzvy_translangArr['you_want_to_delete_this_offday']; }else{ echo $rzvy_defaultlang['you_want_to_delete_this_offday']; } ?>',
		'days_off_deleted_successfully' : '<?php if(isset($rzvy_translangArr['days_off_deleted_successfully'])){ echo $rzvy_translangArr['days_off_deleted_successfully']; }else{ echo $rzvy_defaultlang['days_off_deleted_successfully']; } ?>',
		'email_changed_successfully' : '<?php if(isset($rzvy_translangArr['email_changed_successfully'])){ echo $rzvy_translangArr['email_changed_successfully']; }else{ echo $rzvy_defaultlang['email_changed_successfully']; } ?>',
		};
	</script>
	
	<?php if (strpos($_SERVER['SCRIPT_NAME'], 'location-selector.php') != false) { ?>
		<script src="<?php echo SITE_URL; ?>includes/vendor/bootstrap/js/bootstrap-tagsinput.js?<?php echo time(); ?>"></script>
	<?php } ?>
	<?php if (strpos($_SERVER['SCRIPT_NAME'], 'location-selector.php') != false || strpos($_SERVER['SCRIPT_NAME'], 'refund.php') != false || strpos($_SERVER['SCRIPT_NAME'], 'email-sms-templates.php') != false || strpos($_SERVER['SCRIPT_NAME'], 'settings.php') != false) { ?>
		<!-- include text editor -->
		<script type="text/javascript" src="<?php echo SITE_URL; ?>includes/vendor/text-editor/text-editor.js?<?php echo time(); ?>"></script>
	<?php } ?>
	<script src="<?php echo SITE_URL; ?>includes/vendor/intl-tel-input/js/intlTelInput.js?<?php echo time(); ?>"></script>
	<script src="<?php echo SITE_URL; ?>includes/js/rzvy-staff.js?<?php echo time(); ?>"></script>
	<script src="<?php echo SITE_URL; ?>includes/js/rzvy-set-languages.js?<?php echo time(); ?>"></script>
  </div>
</body>
</html>