<?php 
include 'header.php';
include 'currency.php'; 
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['referral_discount_settings'])){ echo $rzvy_translangArr['referral_discount_settings']; }else{ echo $rzvy_defaultlang['referral_discount_settings']; } ?></li>
      </ol>
	  <div class="mb-3">
		<div class="rzvy-tabbable-panel">
			<div class="rzvy-tabbable-line">
				<ul class="nav nav-tabs">
				  <li class="nav-item active custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="0" data-toggle="tab" href="#rzvy_referral_settings"><i class="fa fa-gift"></i> <?php if(isset($rzvy_translangArr['referral_settings'])){ echo $rzvy_translangArr['referral_settings']; }else{ echo $rzvy_defaultlang['referral_settings']; } ?></a>
				  </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane container active" id="rzvy_referral_settings">
					  <div class="row">
						<div class="col-md-12">
						  <form name="rzvy_referral_settings_form" id="rzvy_referral_settings_form" method="post">
							<div class="row my-3">
								<label class="col-md-3"><?php if(isset($rzvy_translangArr['referral_discount_status'])){ echo $rzvy_translangArr['referral_discount_status']; }else{ echo $rzvy_defaultlang['referral_discount_status']; } ?></label>
								<label class="rzvy-toggle-switch">
									<input type="checkbox" name="rzvy_referral_discount_status" id="rzvy_referral_discount_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_referral_discount_status")=="Y"){ echo "checked"; } ?> />
									<span class="rzvy-toggle-switch-slider"></span>
								</label>
							</div>
							  <div class="form-group row">
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['referral_discount_type'])){ echo $rzvy_translangArr['referral_discount_type']; }else{ echo $rzvy_defaultlang['referral_discount_type']; } ?></label>
									<?php $rzvy_referral_discount_type = $obj_settings->get_option("rzvy_referral_discount_type"); ?>
									<select name="rzvy_referral_discount_type" id="rzvy_referral_discount_type" class="form-control selectpicker">
									  <option value="percentage" <?php if($rzvy_referral_discount_type == "percentage"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['percentage'])){ echo $rzvy_translangArr['percentage']; }else{ echo $rzvy_defaultlang['percentage']; } ?></option>
									  <option value="flat" <?php if($rzvy_referral_discount_type == "flat"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['flat'])){ echo $rzvy_translangArr['flat']; }else{ echo $rzvy_defaultlang['flat']; } ?></option>
									</select>
								</div>
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['referral_discount_value'])){ echo $rzvy_translangArr['referral_discount_value']; }else{ echo $rzvy_defaultlang['referral_discount_value']; } ?></label>
									<input type="text" name="rzvy_referral_discount_value" id="rzvy_referral_discount_value" placeholder="<?php if(isset($rzvy_translangArr['e_g_5'])){ echo $rzvy_translangArr['e_g_5']; }else{ echo $rzvy_defaultlang['e_g_5']; } ?>" class="form-control" value="<?php echo $obj_settings->get_option("rzvy_referral_discount_value"); ?>" />
								</div>
							  </div>
							  <a id="update_referral_settings_btn" class="btn btn-success btn-block" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
						 </form>
						</div>
					  </div>
					</div>
			  </div>
			</div>
		</div>
	 </div>
<?php include 'footer.php'; ?>