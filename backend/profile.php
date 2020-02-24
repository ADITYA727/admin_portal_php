<?php 
include 'header.php';
$obj_admins->id = $_SESSION['admin_id'];
$profile_data = $obj_admins->readone_profile();
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['profile'])){ echo $rzvy_translangArr['profile']; }else{ echo $rzvy_defaultlang['profile']; } ?></li>
      </ol>
	  <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-lock"></i> <?php if(isset($rzvy_translangArr['profile'])){ echo $rzvy_translangArr['profile']; }else{ echo $rzvy_defaultlang['profile']; } ?> <span class="pull-right"><a href="javascript:void(0);"  data-toggle="modal" data-target="#rzvy_change_email_modal"><?php if(isset($rzvy_translangArr['want_to_change_email'])){ echo $rzvy_translangArr['want_to_change_email']; }else{ echo $rzvy_defaultlang['want_to_change_email']; } ?></a></span></div>
        <div class="card-body">
      <div class="row">
		<div class="col-md-12">
		  <form name="rzvy_profile_form" id="rzvy_profile_form" method="post">
			  <input type='hidden' id="rzvy-profile-admin-id-hidden" name="rzvy-profile-admin-id-hidden" value="<?php echo $_SESSION['admin_id']; ?>" />
			  <div class="form-group row">
				<div class="col-md-3">
					<div class="rzvy-image-upload">
						<div class="rzvy-image-edit-icon">
							<input type='hidden' id="rzvy-image-upload-file-hidden" name="rzvy-image-upload-file-hidden" />
							<input type='file' id="rzvy-image-upload-file" accept=".png, .jpg, .jpeg" />
							<label for="rzvy-image-upload-file"></label>
						</div>
						<div class="rzvy-image-preview">
							<div id="rzvy-image-upload-file-preview" style="<?php if($profile_data['image'] != '' && file_exists("../uploads/images/".$profile_data['image'])){ echo "background-image: url(".SITE_URL."uploads/images/".$profile_data['image'].");"; }else{ echo "background-image: url(".SITE_URL."includes/images/default-avatar.jpg);"; } ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<label class="control-label"><?php if(isset($rzvy_translangArr['first_name'])){ echo $rzvy_translangArr['first_name']; }else{ echo $rzvy_defaultlang['first_name']; } ?></label>
					<input class="form-control" id="rzvy_profile_firstname" name="rzvy_profile_firstname" type="text" value="<?php echo $profile_data['firstname']; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_first_name'])){ echo $rzvy_translangArr['enter_first_name']; }else{ echo $rzvy_defaultlang['enter_first_name']; } ?>" />
				</div>
				<div class="col-md-3">
					<label class="control-label"><?php if(isset($rzvy_translangArr['last_name'])){ echo $rzvy_translangArr['last_name']; }else{ echo $rzvy_defaultlang['last_name']; } ?></label>
					<input class="form-control" id="rzvy_profile_lastname" name="rzvy_profile_lastname" type="text" value="<?php echo $profile_data['lastname']; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_last_name'])){ echo $rzvy_translangArr['enter_last_name']; }else{ echo $rzvy_defaultlang['enter_last_name']; } ?>" />
				</div>
				<div class="col-md-3">
					<label class="control-label"><?php if(isset($rzvy_translangArr['phone'])){ echo $rzvy_translangArr['phone']; }else{ echo $rzvy_defaultlang['phone']; } ?></label>
					<input class="form-control" id="rzvy_profile_phone" name="rzvy_profile_phone" type="text" value="<?php echo $profile_data['phone']; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_phone'])){ echo $rzvy_translangArr['enter_phone']; }else{ echo $rzvy_defaultlang['enter_phone']; } ?>" />
				</div>
			  </div>
			  <div class="form-group row">
				<div class="col-md-4">
					<label class="control-label"><?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?></label>
					<textarea class="form-control" id="rzvy_profile_address" name="rzvy_profile_address" rows="1" placeholder="<?php if(isset($rzvy_translangArr['enter_address'])){ echo $rzvy_translangArr['enter_address']; }else{ echo $rzvy_defaultlang['enter_address']; } ?>" ><?php echo $profile_data['address']; ?></textarea>
				</div>
				<div class="col-md-4">
					<label class="control-label"><?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?></label>
					<input class="form-control" id="rzvy_profile_city" name="rzvy_profile_city" type="text" value="<?php echo $profile_data['city']; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_city'])){ echo $rzvy_translangArr['enter_city']; }else{ echo $rzvy_defaultlang['enter_city']; } ?>" />
				</div>
				<div class="col-md-4">
					<label class="control-label"><?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?></label>
					<input class="form-control" id="rzvy_profile_state" name="rzvy_profile_state" type="text" value="<?php echo $profile_data['state']; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_state'])){ echo $rzvy_translangArr['enter_state']; }else{ echo $rzvy_defaultlang['enter_state']; } ?>" />
				</div>
			  </div>
			  <div class="form-group row">
			  </div>
			  <div class="form-group row">
				<div class="col-md-6">
					<label class="control-label"><?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?></label>
					<input class="form-control" id="rzvy_profile_zip" name="rzvy_profile_zip" type="text" value="<?php echo $profile_data['zip']; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_zip'])){ echo $rzvy_translangArr['enter_zip']; }else{ echo $rzvy_defaultlang['enter_zip']; } ?>" />
				</div>
				<div class="col-md-6">
					<label class="control-label"><?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?></label>
					<input class="form-control" id="rzvy_profile_country" name="rzvy_profile_country" type="text" value="<?php echo $profile_data['country']; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_country'])){ echo $rzvy_translangArr['enter_country']; }else{ echo $rzvy_defaultlang['enter_country']; } ?>" />
				</div>
			  </div>
			  <a class="btn btn-success btn-block rzvy_update_profile_btn" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_profile'])){ echo $rzvy_translangArr['update_profile']; }else{ echo $rzvy_defaultlang['update_profile']; } ?></a>
		 </form>
       </div>
		</div>
        <div class="card-footer small text-muted"></div>
      </div>
	 </div>
	 
	 <!-- Change email modal -->
	 <div class="modal fade" id="rzvy_change_email_modal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title"><?php if(isset($rzvy_translangArr['change_email'])){ echo $rzvy_translangArr['change_email']; }else{ echo $rzvy_defaultlang['change_email']; } ?></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form name="rzvy_change_profile_email_form" id="rzvy_change_profile_email_form" method="post">
						<div class="row m-2">
							<div class="col-md-9 p-1">
								<input type="text" class="form-control" placeholder="<?php if(isset($rzvy_translangArr['enter_new_email'])){ echo $rzvy_translangArr['enter_new_email']; }else{ echo $rzvy_defaultlang['enter_new_email']; } ?>" name="rzvy_change_profile_email" id="rzvy_change_profile_email" />
							</div>
							<div class="col-md-3 p-1">
								<a href="javascript:void(0)" class="btn btn-success w-100" id="rzvy_change_profile_email_btn"><?php if(isset($rzvy_translangArr['change'])){ echo $rzvy_translangArr['change']; }else{ echo $rzvy_defaultlang['change']; } ?></a>
							</div>
						</div>
					</form>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>