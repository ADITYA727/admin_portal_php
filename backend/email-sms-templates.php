<?php include 'header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['email_and_sms_templates'])){ echo $rzvy_translangArr['email_and_sms_templates']; }else{ echo $rzvy_defaultlang['email_and_sms_templates']; } ?></li>
      </ol>
      <!-- DataTables Card-->
	  <div class="mb-3">
		<div class="rzvy-tabbable-panel">
			<div class="rzvy-tabbable-line">
				<ul class="nav nav-tabs">
				  <li class="nav-item active custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="0" data-toggle="tab" href="#rzvy_emailtemplates_settings"><i class="fa fa-envelope"></i> <?php if(isset($rzvy_translangArr['email_templates'])){ echo $rzvy_translangArr['email_templates']; }else{ echo $rzvy_defaultlang['email_templates']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="1" data-toggle="tab" href="#rzvy_smstemplates_settings"><i class="fa fa-comments"></i> <?php if(isset($rzvy_translangArr['sms_templates'])){ echo $rzvy_translangArr['sms_templates']; }else{ echo $rzvy_defaultlang['sms_templates']; } ?></a>
				  </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane container active" id="rzvy_emailtemplates_settings">
						<div class="row mb-3">
							<div class="col-md-3 mb-3">
								<div class="card rzvy-boxshadow mt-1 mr-1 rzvy_emailtemplate_settings_customer">
								  <div class="card-body text-primary text-center">
									<i class="fa fa-columns" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['customer'])){ echo $rzvy_translangArr['customer']; }else{ echo $rzvy_defaultlang['customer']; } ?>
								  </div>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_emailtemplate_settings_admin">
								  <div class="card-body text-primary text-center">
									<i class="fa fa-columns" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['admin'])){ echo $rzvy_translangArr['admin']; }else{ echo $rzvy_defaultlang['admin']; } ?>
								  </div>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_emailtemplate_settings_staff">
								  <div class="card-body text-primary text-center">
									<i class="fa fa-columns" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['staff'])){ echo $rzvy_translangArr['staff']; }else{ echo $rzvy_defaultlang['staff']; } ?>
								  </div>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_emailtemplate_settings_extra">
								  <div class="card-body text-primary text-center">
									<i class="fa fa-columns" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['extra'])){ echo $rzvy_translangArr['extra']; }else{ echo $rzvy_defaultlang['extra']; } ?>
								  </div>
								</div>
							</div>
						</div>
						<div class="rzvy_customer_email_templates">
							<div class="rzvy-es-box bg-info rounded">
								<center><h4 class="text-white pt-3 pb-0 mb-0"><?php if(isset($rzvy_translangArr['customer_email_templates'])){ echo $rzvy_translangArr['customer_email_templates']; }else{ echo $rzvy_defaultlang['customer_email_templates']; } ?></h4></center>
								<div class="row mt-2 mb-4 ml-4 mr-4">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-info-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['book_new_appointment'])){ echo $rzvy_translangArr['book_new_appointment']; }else{ echo $rzvy_defaultlang['book_new_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="new" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment'])){ echo $rzvy_translangArr['confirm_appointment']; }else{ echo $rzvy_defaultlang['confirm_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirm" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment_by_staff'])){ echo $rzvy_translangArr['confirm_appointment_by_staff']; }else{ echo $rzvy_defaultlang['confirm_appointment_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirms" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-refresh fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_customer'])){ echo $rzvy_translangArr['reschedule_by_customer']; }else{ echo $rzvy_defaultlang['reschedule_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulec" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_you'])){ echo $rzvy_translangArr['reschedule_by_you']; }else{ echo $rzvy_defaultlang['reschedule_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulea" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_staff'])){ echo $rzvy_translangArr['reschedule_by_staff']; }else{ echo $rzvy_defaultlang['reschedule_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedules" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-times-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['cancel_by_customer'])){ echo $rzvy_translangArr['cancel_by_customer']; }else{ echo $rzvy_defaultlang['cancel_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="cancelc" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_you'])){ echo $rzvy_translangArr['reject_by_you']; }else{ echo $rzvy_defaultlang['reject_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejecta" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_staff'])){ echo $rzvy_translangArr['reject_by_staff']; }else{ echo $rzvy_defaultlang['reject_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejects" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-calendar-check-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['complete_appointment'])){ echo $rzvy_translangArr['complete_appointment']; }else{ echo $rzvy_defaultlang['complete_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="complete" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-bell-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['appointment_reminder'])){ echo $rzvy_translangArr['appointment_reminder']; }else{ echo $rzvy_defaultlang['appointment_reminder']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reminder" data-template_for="customer" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
								</div>
							</div>
						</div>
						<div class="rzvy_admin_email_templates">
							<div class="rzvy-es-box bg-dark rounded">
								<center><h4 class="text-white pt-3 pb-0 mb-0"><?php if(isset($rzvy_translangArr['admin_email_templates'])){ echo $rzvy_translangArr['admin_email_templates']; }else{ echo $rzvy_defaultlang['admin_email_templates']; } ?></h4></center>
								<div class="row mt-2 mb-4 ml-4 mr-4">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-info-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['book_new_appointment'])){ echo $rzvy_translangArr['book_new_appointment']; }else{ echo $rzvy_defaultlang['book_new_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="new" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment'])){ echo $rzvy_translangArr['confirm_appointment']; }else{ echo $rzvy_defaultlang['confirm_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirm" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment_by_staff'])){ echo $rzvy_translangArr['confirm_appointment_by_staff']; }else{ echo $rzvy_defaultlang['confirm_appointment_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirms" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-refresh fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_customer'])){ echo $rzvy_translangArr['reschedule_by_customer']; }else{ echo $rzvy_defaultlang['reschedule_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulec" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_you'])){ echo $rzvy_translangArr['reschedule_by_you']; }else{ echo $rzvy_defaultlang['reschedule_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulea" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_staff'])){ echo $rzvy_translangArr['reschedule_by_staff']; }else{ echo $rzvy_defaultlang['reschedule_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedules" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-times-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['cancel_by_customer'])){ echo $rzvy_translangArr['cancel_by_customer']; }else{ echo $rzvy_defaultlang['cancel_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="cancelc" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_you'])){ echo $rzvy_translangArr['reject_by_you']; }else{ echo $rzvy_defaultlang['reject_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejecta" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_staff'])){ echo $rzvy_translangArr['reject_by_staff']; }else{ echo $rzvy_defaultlang['reject_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejects" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-calendar-check-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['complete_appointment'])){ echo $rzvy_translangArr['complete_appointment']; }else{ echo $rzvy_defaultlang['complete_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="complete" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-bell-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['appointment_reminder'])){ echo $rzvy_translangArr['appointment_reminder']; }else{ echo $rzvy_defaultlang['appointment_reminder']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reminder" data-template_for="admin" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
								</div>
							</div>
						</div>
						<div class="rzvy_staff_email_templates">
							<div class="rzvy-es-box bg-danger rounded">
								<center><h4 class="text-white pt-3 pb-0 mb-0"><?php if(isset($rzvy_translangArr['staff_email_templates'])){ echo $rzvy_translangArr['staff_email_templates']; }else{ echo $rzvy_defaultlang['staff_email_templates']; } ?></h4></center>
								<div class="row mt-2 mb-4 ml-4 mr-4">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-info-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['book_new_appointment'])){ echo $rzvy_translangArr['book_new_appointment']; }else{ echo $rzvy_defaultlang['book_new_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="new" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment'])){ echo $rzvy_translangArr['confirm_appointment']; }else{ echo $rzvy_defaultlang['confirm_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirm" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment_by_staff'])){ echo $rzvy_translangArr['confirm_appointment_by_staff']; }else{ echo $rzvy_defaultlang['confirm_appointment_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirms" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-refresh fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_customer'])){ echo $rzvy_translangArr['reschedule_by_customer']; }else{ echo $rzvy_defaultlang['reschedule_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulec" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_you'])){ echo $rzvy_translangArr['reschedule_by_you']; }else{ echo $rzvy_defaultlang['reschedule_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulea" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_staff'])){ echo $rzvy_translangArr['reschedule_by_staff']; }else{ echo $rzvy_defaultlang['reschedule_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedules" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-times-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['cancel_by_customer'])){ echo $rzvy_translangArr['cancel_by_customer']; }else{ echo $rzvy_defaultlang['cancel_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="cancelc" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_you'])){ echo $rzvy_translangArr['reject_by_you']; }else{ echo $rzvy_defaultlang['reject_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejecta" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_staff'])){ echo $rzvy_translangArr['reject_by_staff']; }else{ echo $rzvy_defaultlang['reject_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejects" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-calendar-check-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['complete_appointment'])){ echo $rzvy_translangArr['complete_appointment']; }else{ echo $rzvy_defaultlang['complete_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="complete" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-bell-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['appointment_reminder'])){ echo $rzvy_translangArr['appointment_reminder']; }else{ echo $rzvy_defaultlang['appointment_reminder']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reminder" data-template_for="staff" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
								</div>
							</div>
						</div>
						<div class="rzvy_extra_email_templates">
							<div class="rzvy-es-box bg-success rounded">
								<center><h4 class="text-white pt-3 pb-0 mb-0"><?php if(isset($rzvy_translangArr['extra_email_templates'])){ echo $rzvy_translangArr['extra_email_templates']; }else{ echo $rzvy_defaultlang['extra_email_templates']; } ?></h4></center>
								<div class="row mt-2 mb-4 ml-4 mr-4">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-frown-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['rzy_emails_forgot_password'])){ echo $rzvy_translangArr['rzy_emails_forgot_password']; }else{ echo $rzvy_defaultlang['rzy_emails_forgot_password']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="forgot_password" data-template_for="all" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-recycle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['rzy_emails_reset_password'])){ echo $rzvy_translangArr['rzy_emails_reset_password']; }else{ echo $rzvy_defaultlang['rzy_emails_reset_password']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reset_password" data-template_for="all" class="rzvy-es-box-a rzvy_email_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
					<div class="tab-pane container" id="rzvy_smstemplates_settings">
						<div class="row mb-3">
							<div class="col-md-3 mb-3">
								<div class="card rzvy-boxshadow mt-1 mr-1 rzvy_smstemplate_settings_customer">
								  <div class="card-body text-primary text-center">
									<i class="fa fa-columns" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['customer'])){ echo $rzvy_translangArr['customer']; }else{ echo $rzvy_defaultlang['customer']; } ?>
								  </div>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_smstemplate_settings_admin">
								  <div class="card-body text-primary text-center">
									<i class="fa fa-columns" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['admin'])){ echo $rzvy_translangArr['admin']; }else{ echo $rzvy_defaultlang['admin']; } ?>
								  </div>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_smstemplate_settings_staff">
								  <div class="card-body text-primary text-center">
									<i class="fa fa-columns" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['staff'])){ echo $rzvy_translangArr['staff']; }else{ echo $rzvy_defaultlang['staff']; } ?>
								  </div>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_smstemplate_settings_extra">
								  <div class="card-body text-primary text-center">
									<i class="fa fa-columns" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['extra'])){ echo $rzvy_translangArr['extra']; }else{ echo $rzvy_defaultlang['extra']; } ?>
								  </div>
								</div>
							</div>
						</div>
						<div class="rzvy_customer_sms_templates">
							<div class="rzvy-es-box bg-info rounded">
								<center><h4 class="text-white pt-3 pb-0 mb-0"><?php if(isset($rzvy_translangArr['customer_sms_templates'])){ echo $rzvy_translangArr['customer_sms_templates']; }else{ echo $rzvy_defaultlang['customer_sms_templates']; } ?></h4></center>
								<div class="row mt-2 mb-4 ml-4 mr-4">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-info-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['book_new_appointment'])){ echo $rzvy_translangArr['book_new_appointment']; }else{ echo $rzvy_defaultlang['book_new_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="new" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment'])){ echo $rzvy_translangArr['confirm_appointment']; }else{ echo $rzvy_defaultlang['confirm_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirm" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment_by_staff'])){ echo $rzvy_translangArr['confirm_appointment_by_staff']; }else{ echo $rzvy_defaultlang['confirm_appointment_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirms" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-refresh fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_customer'])){ echo $rzvy_translangArr['reschedule_by_customer']; }else{ echo $rzvy_defaultlang['reschedule_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulec" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_you'])){ echo $rzvy_translangArr['reschedule_by_you']; }else{ echo $rzvy_defaultlang['reschedule_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulea" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_staff'])){ echo $rzvy_translangArr['reschedule_by_staff']; }else{ echo $rzvy_defaultlang['reschedule_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedules" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-times-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['cancel_by_customer'])){ echo $rzvy_translangArr['cancel_by_customer']; }else{ echo $rzvy_defaultlang['cancel_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="cancelc" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_you'])){ echo $rzvy_translangArr['reject_by_you']; }else{ echo $rzvy_defaultlang['reject_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejecta" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_staff'])){ echo $rzvy_translangArr['reject_by_staff']; }else{ echo $rzvy_defaultlang['reject_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejects" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-calendar-check-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['complete_appointment'])){ echo $rzvy_translangArr['complete_appointment']; }else{ echo $rzvy_defaultlang['complete_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="complete" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-bell-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['appointment_reminder'])){ echo $rzvy_translangArr['appointment_reminder']; }else{ echo $rzvy_defaultlang['appointment_reminder']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reminder" data-template_for="customer" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
								</div>
							</div>
						</div>
						<div class="rzvy_admin_sms_templates">
							<div class="rzvy-es-box bg-dark rounded">
								<center><h4 class="text-white pt-3 pb-0 mb-0"><?php if(isset($rzvy_translangArr['admin_sms_templates'])){ echo $rzvy_translangArr['admin_sms_templates']; }else{ echo $rzvy_defaultlang['admin_sms_templates']; } ?></h4></center>
								<div class="row mt-2 mb-4 ml-4 mr-4">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-info-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['book_new_appointment'])){ echo $rzvy_translangArr['book_new_appointment']; }else{ echo $rzvy_defaultlang['book_new_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="new" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment'])){ echo $rzvy_translangArr['confirm_appointment']; }else{ echo $rzvy_defaultlang['confirm_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirm" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment_by_staff'])){ echo $rzvy_translangArr['confirm_appointment_by_staff']; }else{ echo $rzvy_defaultlang['confirm_appointment_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirms" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-refresh fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_customer'])){ echo $rzvy_translangArr['reschedule_by_customer']; }else{ echo $rzvy_defaultlang['reschedule_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulec" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_you'])){ echo $rzvy_translangArr['reschedule_by_you']; }else{ echo $rzvy_defaultlang['reschedule_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulea" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_staff'])){ echo $rzvy_translangArr['reschedule_by_staff']; }else{ echo $rzvy_defaultlang['reschedule_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedules" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-times-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['cancel_by_customer'])){ echo $rzvy_translangArr['cancel_by_customer']; }else{ echo $rzvy_defaultlang['cancel_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="cancelc" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_you'])){ echo $rzvy_translangArr['reject_by_you']; }else{ echo $rzvy_defaultlang['reject_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejecta" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_staff'])){ echo $rzvy_translangArr['reject_by_staff']; }else{ echo $rzvy_defaultlang['reject_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejects" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-calendar-check-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['complete_appointment'])){ echo $rzvy_translangArr['complete_appointment']; }else{ echo $rzvy_defaultlang['complete_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="complete" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-bell-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['appointment_reminder'])){ echo $rzvy_translangArr['appointment_reminder']; }else{ echo $rzvy_defaultlang['appointment_reminder']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reminder" data-template_for="admin" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
								</div>
							</div>
						</div>
						<div class="rzvy_staff_sms_templates">
							<div class="rzvy-es-box bg-danger rounded">
								<center><h4 class="text-white pt-3 pb-0 mb-0"><?php if(isset($rzvy_translangArr['staff_sms_templates'])){ echo $rzvy_translangArr['staff_sms_templates']; }else{ echo $rzvy_defaultlang['staff_sms_templates']; } ?></h4></center>
								<div class="row mt-2 mb-4 ml-4 mr-4">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-info-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['book_new_appointment'])){ echo $rzvy_translangArr['book_new_appointment']; }else{ echo $rzvy_defaultlang['book_new_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="new" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment'])){ echo $rzvy_translangArr['confirm_appointment']; }else{ echo $rzvy_defaultlang['confirm_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirm" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-check-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['confirm_appointment_by_staff'])){ echo $rzvy_translangArr['confirm_appointment_by_staff']; }else{ echo $rzvy_defaultlang['confirm_appointment_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="confirms" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-refresh fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_customer'])){ echo $rzvy_translangArr['reschedule_by_customer']; }else{ echo $rzvy_defaultlang['reschedule_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulec" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_you'])){ echo $rzvy_translangArr['reschedule_by_you']; }else{ echo $rzvy_defaultlang['reschedule_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedulea" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-repeat fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reschedule_by_staff'])){ echo $rzvy_translangArr['reschedule_by_staff']; }else{ echo $rzvy_defaultlang['reschedule_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reschedules" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-times-circle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['cancel_by_customer'])){ echo $rzvy_translangArr['cancel_by_customer']; }else{ echo $rzvy_defaultlang['cancel_by_customer']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="cancelc" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_you'])){ echo $rzvy_translangArr['reject_by_you']; }else{ echo $rzvy_defaultlang['reject_by_you']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejecta" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-ban fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['reject_by_staff'])){ echo $rzvy_translangArr['reject_by_staff']; }else{ echo $rzvy_defaultlang['reject_by_staff']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="rejects" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-calendar-check-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['complete_appointment'])){ echo $rzvy_translangArr['complete_appointment']; }else{ echo $rzvy_defaultlang['complete_appointment']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="complete" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-bell-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['appointment_reminder'])){ echo $rzvy_translangArr['appointment_reminder']; }else{ echo $rzvy_defaultlang['appointment_reminder']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reminder" data-template_for="staff" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
								</div>
							</div>
						</div>
						<div class="rzvy_extra_sms_templates">
							<div class="rzvy-es-box bg-success rounded">
								<center><h4 class="text-white pt-3 pb-0 mb-0"><?php if(isset($rzvy_translangArr['extra_sms_templates'])){ echo $rzvy_translangArr['extra_sms_templates']; }else{ echo $rzvy_defaultlang['extra_sms_templates']; } ?></h4></center>
								<div class="row mt-2 mb-4 ml-4 mr-4">
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-frown-o fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['rzy_sms_forgot_password'])){ echo $rzvy_translangArr['rzy_sms_forgot_password']; }else{ echo $rzvy_defaultlang['rzy_sms_forgot_password']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="forgot_password" data-template_for="all" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
									<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
										<div class="rzvy-es-box-part text-center">
											<i class="fa fa-recycle fa-3x" aria-hidden="true"></i>
											<div class="rzvy-es-box-title"><h4><?php if(isset($rzvy_translangArr['rzy_sms_reset_password'])){ echo $rzvy_translangArr['rzy_sms_reset_password']; }else{ echo $rzvy_defaultlang['rzy_sms_reset_password']; } ?></h4></div>
											<a href="javascript:void(0)" data-template="reset_password" data-template_for="all" class="rzvy-es-box-a rzvy_sms_template_modal_btn"><?php if(isset($rzvy_translangArr['customize_template'])){ echo $rzvy_translangArr['customize_template']; }else{ echo $rzvy_defaultlang['customize_template']; } ?></a>
										 </div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	  </div>
	  <!-- emailtemplate Setting Form Modal-->
    <div class="modal fade" id="rzvy-emailtemplate-setting-form-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-emailtemplate-setting-form-modal-label" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rzvy-emailtemplate-setting-form-modal-label"><?php if(isset($rzvy_translangArr['customize_email_template'])){ echo $rzvy_translangArr['customize_email_template']; }else{ echo $rzvy_defaultlang['customize_email_template']; } ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body rzvy-emailtemplate-setting-form-modal-content">
		  </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
            <a id="update_emailtemplate_settings_btn" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['save_template'])){ echo $rzvy_translangArr['save_template']; }else{ echo $rzvy_defaultlang['save_template']; } ?></a>
          </div>
        </div>
      </div>
    </div>
	  <!-- smstemplate Setting Form Modal-->
    <div class="modal fade" id="rzvy-smstemplate-setting-form-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-smstemplate-setting-form-modal-label" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rzvy-smstemplate-setting-form-modal-label"><?php if(isset($rzvy_translangArr['customize_sms_template'])){ echo $rzvy_translangArr['customize_sms_template']; }else{ echo $rzvy_defaultlang['customize_sms_template']; } ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body rzvy-smstemplate-setting-form-modal-content">
		  </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
            <a id="update_smstemplate_settings_btn" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['save_template'])){ echo $rzvy_translangArr['save_template']; }else{ echo $rzvy_defaultlang['save_template']; } ?></a>
          </div>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>