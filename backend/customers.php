<?php include 'header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['customers'])){ echo $rzvy_translangArr['customers']; }else{ echo $rzvy_defaultlang['customers']; } ?></li>
      </ol>
      <div class="mb-3">
		<div class="rzvy-tabbable-panel">
			<div class="rzvy-tabbable-line">
				<ul class="nav nav-tabs">
				  <li class="nav-item active custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="0" data-toggle="tab" href="#rzvy_registered_customers"><i class="fa fa-user-plus"></i> <?php if(isset($rzvy_translangArr['registered_customers'])){ echo $rzvy_translangArr['registered_customers']; }else{ echo $rzvy_defaultlang['registered_customers']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="1" data-toggle="tab" href="#rzvy_guest_customers"><i class="fa fa-user"></i> <?php if(isset($rzvy_translangArr['guest_customers'])){ echo $rzvy_translangArr['guest_customers']; }else{ echo $rzvy_defaultlang['guest_customers']; } ?></a>
				  </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane container active" id="rzvy_registered_customers">
					  <div class="row">
						<div class="col-md-12">
						  <div class="table-responsive">
							<table class="table" cellspacing="0" id="rzvy_registered_customers_detail">
							  <thead>
								<tr>
								  <th><?php if(isset($rzvy_translangArr['customer_name'])){ echo $rzvy_translangArr['customer_name']; }else{ echo $rzvy_defaultlang['customer_name']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['email'])){ echo $rzvy_translangArr['email']; }else{ echo $rzvy_defaultlang['email']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['phone'])){ echo $rzvy_translangArr['phone']; }else{ echo $rzvy_defaultlang['phone']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['referral_code'])){ echo $rzvy_translangArr['referral_code']; }else{ echo $rzvy_defaultlang['referral_code']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['booked_appointments'])){ echo $rzvy_translangArr['booked_appointments']; }else{ echo $rzvy_defaultlang['booked_appointments']; } ?></th>
								</tr>
							  </thead>
							  <tbody>
							  </tbody>
							</table>
						  </div>
						</div>
					  </div>
					</div>
					<div class="tab-pane container fade" id="rzvy_guest_customers">
					  <br/>
					  <div class="row">
						<div class="col-md-12">
						  <div class="table-responsive">
							<table class="table" cellspacing="0" id="rzvy_guest_customers_detail">
							  <thead>
								<tr>
								  <th><?php if(isset($rzvy_translangArr['customer_name'])){ echo $rzvy_translangArr['customer_name']; }else{ echo $rzvy_defaultlang['customer_name']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['email'])){ echo $rzvy_translangArr['email']; }else{ echo $rzvy_defaultlang['email']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['phone'])){ echo $rzvy_translangArr['phone']; }else{ echo $rzvy_defaultlang['phone']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['booked_appointments'])){ echo $rzvy_translangArr['booked_appointments']; }else{ echo $rzvy_defaultlang['booked_appointments']; } ?></th>
								</tr>
							  </thead>
							  <tbody>
							  </tbody>
							</table>
						  </div>
						</div>
					  </div>
					</div>
			  </div>
			</div>
		</div>
	 </div>
	 <!-- Appointments Modal-->
	<div class="modal fade" id="rzvy_customer_appointment_modal" tabindex="-1" role="dialog" aria-labelledby="rzvy_customer_appointment_modal_label" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy_customer_appointment_modal_label"><?php if(isset($rzvy_translangArr['booked_appointments'])){ echo $rzvy_translangArr['booked_appointments']; }else{ echo $rzvy_defaultlang['booked_appointments']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body rzvy_customer_appointment_modal_body">
			<div class="table-responsive">
				<table class="table" cellspacing="0" id="rzvy_customer_appointments_listing">
				  <thead>
					<tr>
					  <th><?php if(isset($rzvy_translangArr['order_id'])){ echo $rzvy_translangArr['order_id']; }else{ echo $rzvy_defaultlang['order_id']; } ?></th>
					  <th><?php if(isset($rzvy_translangArr['category'])){ echo $rzvy_translangArr['category']; }else{ echo $rzvy_defaultlang['category']; } ?></th>
					  <th><?php if(isset($rzvy_translangArr['service'])){ echo $rzvy_translangArr['service']; }else{ echo $rzvy_defaultlang['service']; } ?></th>
					  <th><?php if(isset($rzvy_translangArr['addons'])){ echo $rzvy_translangArr['addons']; }else{ echo $rzvy_defaultlang['addons']; } ?></th>
					  <th><?php if(isset($rzvy_translangArr['booking_datetime'])){ echo $rzvy_translangArr['booking_datetime']; }else{ echo $rzvy_defaultlang['booking_datetime']; } ?></th>
					  <th><?php if(isset($rzvy_translangArr['booking_status'])){ echo $rzvy_translangArr['booking_status']; }else{ echo $rzvy_defaultlang['booking_status']; } ?></th>
					  <th><?php if(isset($rzvy_translangArr['payment_method'])){ echo $rzvy_translangArr['payment_method']; }else{ echo $rzvy_defaultlang['payment_method']; } ?></th>
					</tr>
				  </thead>
				  <tbody>
				  </tbody>
				</table>
			  </div>
		  </div>
		  <div class="modal-footer"> </div>
		</div>
	  </div>
	</div>
<?php include 'footer.php'; ?>