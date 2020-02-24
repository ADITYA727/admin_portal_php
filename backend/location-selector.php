<?php include 'header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['location_selector'])){ echo $rzvy_translangArr['location_selector']; }else{ echo $rzvy_defaultlang['location_selector']; } ?></li>
      </ol>
      <!-- Coupon DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-fw fa-map-marker"></i> <?php if(isset($rzvy_translangArr['location_list'])){ echo $rzvy_translangArr['location_list']; }else{ echo $rzvy_defaultlang['location_list']; } ?>
		  </div>
        <div class="card-body">
			<div class="row mb-3 pl-3">
				<label class="col-md-3"><?php if(isset($rzvy_translangArr['location_selector_status'])){ echo $rzvy_translangArr['location_selector_status']; }else{ echo $rzvy_defaultlang['location_selector_status']; } ?></label>
				<label class="rzvy-toggle-switch">
					<input type="checkbox" name="rzvy_location_selector_status" id="rzvy_location_selector_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_location_selector_status")=="Y"){ echo "checked"; } ?> />
					<span class="rzvy-toggle-switch-slider"></span>
				</label>
			</div>
			<div class="col-md-12">
				<input id="rzvy_location_selector" type="text" class="w-100" value="<?php echo $obj_settings->get_option("rzvy_location_selector"); ?>" data-role="tagsinput" placeholder="<?php if(isset($rzvy_translangArr['enter_zipcode'])){ echo $rzvy_translangArr['enter_zipcode']; }else{ echo $rzvy_defaultlang['enter_zipcode']; } ?>" />
			</div>
			<div class="col-md-12 mt-4">
				<a id="save_location_selector_settings_btn" class="btn btn-success btn-block" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['save_location_selector_settings'])){ echo $rzvy_translangArr['save_location_selector_settings']; }else{ echo $rzvy_defaultlang['save_location_selector_settings']; } ?></a>
			</div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
<?php include 'footer.php'; ?>