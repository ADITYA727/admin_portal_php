<?php 
include 'header.php';
if(!isset($_GET['sid'])){
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/category.php";
	</script>
	<?php 
	exit;
} else if(!is_numeric($_GET['sid'])){
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/category.php";
	</script>
	<?php 
	exit;
} else if(!isset($_GET['cid'])){
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/category.php";
	</script>
	<?php 
	exit;
} else if(!is_numeric($_GET['cid'])){
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/category.php";
	</script>
	<?php 
	exit;
}
 ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/category.php"><?php if(isset($rzvy_translangArr['category'])){ echo $rzvy_translangArr['category']; }else{ echo $rzvy_defaultlang['category']; } ?></a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/services.php?cid=<?php echo $_GET["cid"]; ?>"><?php if(isset($rzvy_translangArr['services'])){ echo $rzvy_translangArr['services']; }else{ echo $rzvy_defaultlang['services']; } ?></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['addons'])){ echo $rzvy_translangArr['addons']; }else{ echo $rzvy_defaultlang['addons']; } ?></li>
      </ol>
      <!-- DataTables Card-->
      <div class="card mb-3">
		<input type="hidden" id="addon_ser_id" value="<?php echo $_GET["sid"]; ?>" />
        <div class="card-header">
          <i class="fa fa-fw fa-book"></i> <?php if(isset($rzvy_translangArr['addons_list'])){ echo $rzvy_translangArr['addons_list']; }else{ echo $rzvy_defaultlang['addons_list']; } ?>
		  <a class="btn btn-success btn-sm rzvy-white pull-right" data-toggle="modal" data-target="#rzvy-add-addon-modal"><i class="fa fa-plus"></i> <?php if(isset($rzvy_translangArr['add_addon'])){ echo $rzvy_translangArr['add_addon']; }else{ echo $rzvy_defaultlang['add_addon']; } ?></a>
		  </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="rzvy_addons_list_table" width="100%" cellspacing="0">
              <thead>
				<tr>
				  <th><?php if(isset($rzvy_translangArr['hash_rzy_translation'])){ echo $rzvy_translangArr['hash_rzy_translation']; }else{ echo $rzvy_defaultlang['hash_rzy_translation']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['name'])){ echo $rzvy_translangArr['name']; }else{ echo $rzvy_defaultlang['name']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['service'])){ echo $rzvy_translangArr['service']; }else{ echo $rzvy_defaultlang['service']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['rate'])){ echo $rzvy_translangArr['rate']; }else{ echo $rzvy_defaultlang['rate']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['multiple_qty'])){ echo $rzvy_translangArr['multiple_qty']; }else{ echo $rzvy_defaultlang['multiple_qty']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['status'])){ echo $rzvy_translangArr['status']; }else{ echo $rzvy_defaultlang['status']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['action'])){ echo $rzvy_translangArr['action']; }else{ echo $rzvy_defaultlang['action']; } ?></th>
				</tr>
			  </thead>
				<tbody>
					<?php 
					$obj_addons->service_id = $_GET['sid'];
					$all_addons = $obj_addons->get_all_addons();
					if(mysqli_num_rows($all_addons)>0){
						$i = 0;
						$rzvy_currency_symbol = $obj_settings->get_option('rzvy_currency_symbol');
						while($addon = mysqli_fetch_assoc($all_addons)){
							$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo ucwords($addon['title']); ?></td>
								<td><?php echo $obj_addons->get_ser_title($addon['service_id']); ?></td>
								<td><?php echo $rzvy_currency_symbol.$addon['rate']; ?></td>
								<td>
									<?php $multi_checked = ''; if($addon['multiple_qty'] == "Y"){ $multi_checked = "checked"; }; ?>
									<label class="rzvy-toggle-switch">
									  <input type="checkbox" data-id="<?php echo $addon['id']; ?>" class="rzvy-toggle-switch-input rzvy_change_addon_multiple_qty_status" <?php echo $multi_checked; ?> />
									  <span class="rzvy-toggle-switch-slider"></span>
									</label>
								</td>
								<td>
									<?php $checked = ''; if($addon['status'] == "Y"){ $checked = "checked"; }; ?>
									<label class="rzvy-toggle-switch">
									  <input type="checkbox" data-id="<?php echo $addon['id']; ?>" class="rzvy-toggle-switch-input rzvy_change_addon_status" <?php echo $checked; ?> />
									  <span class="rzvy-toggle-switch-slider"></span>
									</label>
								</td>
								<td>
									<a class="m-1 btn btn-primary rzvy-white btn-sm rzvy-update-addonmodal" data-id="<?php echo $addon['id']; ?>"><i class="fa fa-fw fa-pencil"></i></a>
									<a class="m-1 btn btn-danger rzvy-white btn-sm rzvy_delete_addon_btn" data-id="<?php echo $addon['id']; ?>"><i class="fa fa-fw fa-trash"></i></a>
									<a class="m-1 btn btn-warning btn-sm rzvy-view-addonmodal" data-id="<?php echo $addon['id']; ?>"><i class="fa fa-fw fa-eye"></i></a>
								</td>
							</tr>
							<?php 
						}
					} 
					?>
				</tbody>
           </table>
          </div>
        </div>
      </div>
	 <!-- Add Modal-->
	<div class="modal fade" id="rzvy-add-addon-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-add-addon-modal-label" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy-add-addon-modal-label"><?php if(isset($rzvy_translangArr['add_addon'])){ echo $rzvy_translangArr['add_addon']; }else{ echo $rzvy_defaultlang['add_addon']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form name="rzvy_add_addon_form" id="rzvy_add_addon_form" method="post">
			  <div class="row">
				  <div class="form-group col-md-6">
					<label for="rzvy_addonname"><?php if(isset($rzvy_translangArr['addon_name'])){ echo $rzvy_translangArr['addon_name']; }else{ echo $rzvy_defaultlang['addon_name']; } ?></label>
					<input class="form-control" id="rzvy_addonname" name="rzvy_addonname" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_addon_name'])){ echo $rzvy_translangArr['enter_addon_name']; }else{ echo $rzvy_defaultlang['enter_addon_name']; } ?>" />
				  </div>
				  <div class="form-group col-md-6">
					<label for="rzvy_addonrate"><?php if(isset($rzvy_translangArr['addon_rate'])){ echo $rzvy_translangArr['addon_rate']; }else{ echo $rzvy_defaultlang['addon_rate']; } ?></label>
					<input class="form-control" id="rzvy_addonrate" name="rzvy_addonrate" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_addon_rate'])){ echo $rzvy_translangArr['enter_addon_rate']; }else{ echo $rzvy_defaultlang['enter_addon_rate']; } ?>" />
				  </div>
				  <div class="form-group col-md-6">
					<label for="rzvy_addondescription"><?php if(isset($rzvy_translangArr['addon_description'])){ echo $rzvy_translangArr['addon_description']; }else{ echo $rzvy_defaultlang['addon_description']; } ?></label>
					<textarea class="form-control" id="rzvy_addondescription" name="rzvy_addondescription" placeholder="<?php if(isset($rzvy_translangArr['enter_addon_description'])){ echo $rzvy_translangArr['enter_addon_description']; }else{ echo $rzvy_defaultlang['enter_addon_description']; } ?>"></textarea>
				  </div>
				  <div class="form-group col-md-6">
					<label for="rzvy_addonmultipleqty"><?php if(isset($rzvy_translangArr['multiple_qty'])){ echo $rzvy_translangArr['multiple_qty']; }else{ echo $rzvy_defaultlang['multiple_qty']; } ?></label>
					<div>
						<label class="text-success"><input type="radio" name="rzvy_addonmultipleqty" value="Y" checked> <?php if(isset($rzvy_translangArr['activate'])){ echo $rzvy_translangArr['activate']; }else{ echo $rzvy_defaultlang['activate']; } ?></label> &nbsp; &nbsp;<label class="text-danger"><input type="radio" name="rzvy_addonmultipleqty" value="N"> <?php if(isset($rzvy_translangArr['deactivate'])){ echo $rzvy_translangArr['deactivate']; }else{ echo $rzvy_defaultlang['deactivate']; } ?></label>
					</div>
				  </div>
				  <div class="form-group col-md-6">
					<label for="rzvy_addonstatus"><?php if(isset($rzvy_translangArr['addon_status'])){ echo $rzvy_translangArr['addon_status']; }else{ echo $rzvy_defaultlang['addon_status']; } ?></label>
					<div>
						<label class="text-success"><input type="radio" name="rzvy_addonstatus" value="Y" checked> <?php if(isset($rzvy_translangArr['activate'])){ echo $rzvy_translangArr['activate']; }else{ echo $rzvy_defaultlang['activate']; } ?></label> &nbsp; &nbsp;<label class="text-danger"><input type="radio" name="rzvy_addonstatus" value="N"> <?php if(isset($rzvy_translangArr['deactivate'])){ echo $rzvy_translangArr['deactivate']; }else{ echo $rzvy_defaultlang['deactivate']; } ?></label>
					</div>
				  </div>
				  <div class="form-group col-md-6">
					<label for="rzvy_addonimage"><?php if(isset($rzvy_translangArr['addon_image'])){ echo $rzvy_translangArr['addon_image']; }else{ echo $rzvy_defaultlang['addon_image']; } ?></label>
					<div class="rzvy-image-upload">
						<div class="rzvy-image-edit-icon">
							<input type='hidden' id="rzvy-image-upload-file-hidden" name="rzvy-image-upload-file-hidden" />
							<input type='file' id="rzvy-image-upload-file" accept=".png, .jpg, .jpeg" />
							<label for="rzvy-image-upload-file"></label>
						</div>
						<div class="rzvy-image-preview">
							<div id="rzvy-image-upload-file-preview" style="background-image: url(<?php echo SITE_URL; ?>includes/images/default-service.png);">
							</div>
						</div>
					</div>
				  </div>
			  </div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
			<a id="rzvy_add_addon_btn" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['add'])){ echo $rzvy_translangArr['add']; }else{ echo $rzvy_defaultlang['add']; } ?></a>
		  </div>
		</div>
	  </div>
	</div>
	 <!-- Update Modal-->
	<div class="modal fade" id="rzvy-update-addon-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-update-addon-modal-label" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy-update-addon-modal-label"><?php if(isset($rzvy_translangArr['update_addon'])){ echo $rzvy_translangArr['update_addon']; }else{ echo $rzvy_defaultlang['update_addon']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body rzvy-update-addon-modal-body">
			
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
			<a id="rzvy_update_addon_btn" data-id="" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update'])){ echo $rzvy_translangArr['update']; }else{ echo $rzvy_defaultlang['update']; } ?></a>
		  </div>
		</div>
	  </div>
	</div>
	 <!-- View Modal-->
	<div class="modal fade" id="rzvy-view-addon-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-view-addon-modal-label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy-view-addon-modal-label"><?php if(isset($rzvy_translangArr['addon_detail'])){ echo $rzvy_translangArr['addon_detail']; }else{ echo $rzvy_defaultlang['addon_detail']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body rzvy-view-addon-modal-body">
			
		  </div>
		  <div class="modal-footer">
		  </div>
		</div>
	  </div>
	</div>
<?php include 'footer.php'; ?>