<?php include 'header.php';
$export_current_date = date("Y-m-d", $currDateTime_withTZ);
$export_current_date_str = strtotime($export_current_date);
 ?>
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
			<a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['export'])){ echo $rzvy_translangArr['export']; }else{ echo $rzvy_defaultlang['export']; } ?></li>
	</ol>
	<!-- Export Services Cards-->
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-th-list"></i> <?php if(isset($rzvy_translangArr['export_services'])){ echo $rzvy_translangArr['export_services']; }else{ echo $rzvy_defaultlang['export_services']; } ?></div>
		<div class="card-body">
			<div class="row">
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['categories'])){ echo $rzvy_translangArr['categories']; }else{ echo $rzvy_defaultlang['categories']; } ?></h5>
					<select class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box='true' id="rzvy_export_categories" multiple>
						<?php
						$all_categories = $obj_categories->get_all_categories_name();
						while($category = mysqli_fetch_assoc($all_categories)){
							echo "<option value='".$category['id']."'>".$category['cat_name']."</option>";
						}
						?>
					</select>
				</div>
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['services'])){ echo $rzvy_translangArr['services']; }else{ echo $rzvy_defaultlang['services']; } ?></h5>
					<select class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box='true' id="rzvy_export_services" multiple>
						<?php
						$all_services = $obj_services->get_all_services_title();
						while($service = mysqli_fetch_assoc($all_services)){
							echo "<option value='".$service['id']."'>".$service['title']."</option>";
						}
						?>
					</select>
				</div>
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['addons'])){ echo $rzvy_translangArr['addons']; }else{ echo $rzvy_defaultlang['addons']; } ?></h5>
					<select class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search" data-actions-box='true' id="rzvy_export_addons" multiple>
						<?php
						$all_addons = $obj_addons->get_all_addons_title();
						while($addon = mysqli_fetch_assoc($all_addons)){
							echo "<option value='".$addon['id']."'>".$addon['title']."</option>";
						}
						?>
					</select>
				</div>
				<div class="col-xl-3 col-sm-6 mt-4">
					<a href="javascript:void(0)" class="btn btn-success rzvy_export_services_btn"><i class="fa fa-cloud-upload"></i> <?php if(isset($rzvy_translangArr['export'])){ echo $rzvy_translangArr['export']; }else{ echo $rzvy_defaultlang['export']; } ?></a>
				</div>
			</div>
		</div>
	</div>
	<!-- Export Appointments Cards-->
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-calendar-check-o"></i> <?php if(isset($rzvy_translangArr['export_appointments'])){ echo $rzvy_translangArr['export_appointments']; }else{ echo $rzvy_defaultlang['export_appointments']; } ?></div>
		<div class="card-body">
			<div class="row">
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['from'])){ echo $rzvy_translangArr['from']; }else{ echo $rzvy_defaultlang['from']; } ?></h5>
					<input class="form-control" id="rzvy_export_appt_from" name="rzvy_export_appt_from" value="<?php echo date("Y-m-d", strtotime("-1 months", $export_current_date_str)); ?>" type="date">
				</div>
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['to'])){ echo $rzvy_translangArr['to']; }else{ echo $rzvy_defaultlang['to']; } ?></h5>
					<input class="form-control" id="rzvy_export_appt_to" name="rzvy_export_appt_to" value="<?php echo $export_current_date; ?>" type="date">
				</div>
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['appointments'])){ echo $rzvy_translangArr['appointments']; }else{ echo $rzvy_defaultlang['appointments']; } ?></h5>
					<select class="form-control" id="rzvy_export_appt_type">
						<option selected value='all'><?php if(isset($rzvy_translangArr['all_appointments'])){ echo $rzvy_translangArr['all_appointments']; }else{ echo $rzvy_defaultlang['all_appointments']; } ?></option>
						<option value='registered'><?php if(isset($rzvy_translangArr['registered_customer_appointments'])){ echo $rzvy_translangArr['registered_customer_appointments']; }else{ echo $rzvy_defaultlang['registered_customer_appointments']; } ?></option>
						<option value='guest'><?php if(isset($rzvy_translangArr['guest_customer_appointments'])){ echo $rzvy_translangArr['guest_customer_appointments']; }else{ echo $rzvy_defaultlang['guest_customer_appointments']; } ?></option>
					</select>
				</div>
				<div class="col-xl-3 col-sm-6 mt-4">
					<a href="javascript:void(0)" class="btn btn-success rzvy_export_appt_btn"><i class="fa fa-cloud-upload"></i> <?php if(isset($rzvy_translangArr['export'])){ echo $rzvy_translangArr['export']; }else{ echo $rzvy_defaultlang['export']; } ?></a>
				</div>
			</div>
		</div>
	</div>
	<!-- Export Payments Cards-->
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-money"></i> <?php if(isset($rzvy_translangArr['export_payments'])){ echo $rzvy_translangArr['export_payments']; }else{ echo $rzvy_defaultlang['export_payments']; } ?></div>
		<div class="card-body">
			<div class="row">
				
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['from'])){ echo $rzvy_translangArr['from']; }else{ echo $rzvy_defaultlang['from']; } ?></h5>
					<input class="form-control" id="rzvy_export_payment_from" name="rzvy_export_appt_from" value="<?php echo date("Y-m-d", strtotime("-1 months", $export_current_date_str)); ?>" type="date">
				</div>
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['to'])){ echo $rzvy_translangArr['to']; }else{ echo $rzvy_defaultlang['to']; } ?></h5>
					<input class="form-control" id="rzvy_export_payment_to" name="rzvy_export_appt_to" value="<?php echo $export_current_date; ?>" type="date">
				</div>
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['payments'])){ echo $rzvy_translangArr['payments']; }else{ echo $rzvy_defaultlang['payments']; } ?></h5>
					<select class="form-control" id="rzvy_export_payment_type">
						<option selected value='all'><?php if(isset($rzvy_translangArr['all_payments'])){ echo $rzvy_translangArr['all_payments']; }else{ echo $rzvy_defaultlang['all_payments']; } ?></option>
						<option value='registered'><?php if(isset($rzvy_translangArr['registered_customer_payments'])){ echo $rzvy_translangArr['registered_customer_payments']; }else{ echo $rzvy_defaultlang['registered_customer_payments']; } ?></option>
						<option value='guest'><?php if(isset($rzvy_translangArr['guest_customer_payments'])){ echo $rzvy_translangArr['guest_customer_payments']; }else{ echo $rzvy_defaultlang['guest_customer_payments']; } ?></option>
					</select>
				</div>
				<div class="col-xl-3 col-sm-6 mt-4">
					<a href="javascript:void(0)" class="btn btn-success rzvy_export_payment_btn"><i class="fa fa-cloud-upload"></i> <?php if(isset($rzvy_translangArr['export'])){ echo $rzvy_translangArr['export']; }else{ echo $rzvy_defaultlang['export']; } ?></a>
				</div>
			</div>
		</div>
	</div>
	<!-- Export Customers Cards-->
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-users"></i> <?php if(isset($rzvy_translangArr['export_customers'])){ echo $rzvy_translangArr['export_customers']; }else{ echo $rzvy_defaultlang['export_customers']; } ?></div>
		<div class="card-body">
			<div class="row">
				<div class="col-xl-3 col-sm-6 mb-3">
					<h5><?php if(isset($rzvy_translangArr['customers'])){ echo $rzvy_translangArr['customers']; }else{ echo $rzvy_defaultlang['customers']; } ?></h5>
					<select class="form-control" id="rzvy_export_customers_type">
						<option selected value='all'><?php if(isset($rzvy_translangArr['all_customers'])){ echo $rzvy_translangArr['all_customers']; }else{ echo $rzvy_defaultlang['all_customers']; } ?></option>
						<option value='registered'><?php if(isset($rzvy_translangArr['registered_customers'])){ echo $rzvy_translangArr['registered_customers']; }else{ echo $rzvy_defaultlang['registered_customers']; } ?></option>
						<option value='guest'><?php if(isset($rzvy_translangArr['guest_customers'])){ echo $rzvy_translangArr['guest_customers']; }else{ echo $rzvy_defaultlang['guest_customers']; } ?></option>
					</select>
				</div>
				<div class="col-xl-3 col-sm-6 mt-4">
					<a href="javascript:void(0)" class="btn btn-success rzvy_export_customers_btn"><i class="fa fa-cloud-upload"></i> <?php if(isset($rzvy_translangArr['export'])){ echo $rzvy_translangArr['export']; }else{ echo $rzvy_defaultlang['export']; } ?></a>
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>