<?php include 'header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['services'])){ echo $rzvy_translangArr['services']; }else{ echo $rzvy_defaultlang['services']; } ?></li>
      </ol>
      <!-- DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-fw fa-book"></i> <?php if(isset($rzvy_translangArr['category_list'])){ echo $rzvy_translangArr['category_list']; }else{ echo $rzvy_defaultlang['category_list']; } ?>
		  <a class="btn btn-success btn-sm rzvy-white pull-right" data-toggle="modal" data-target="#rzvy-add-category-modal"><i class="fa fa-plus"></i> <?php if(isset($rzvy_translangArr['add_category'])){ echo $rzvy_translangArr['add_category']; }else{ echo $rzvy_defaultlang['add_category']; } ?></a>
		</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="rzvy_categories_list_table" width="100%" cellspacing="0">
              <thead>
				<tr>
				  <th><?php if(isset($rzvy_translangArr['hash_rzy_translation'])){ echo $rzvy_translangArr['hash_rzy_translation']; }else{ echo $rzvy_defaultlang['hash_rzy_translation']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['category_name'])){ echo $rzvy_translangArr['category_name']; }else{ echo $rzvy_defaultlang['category_name']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['category_status'])){ echo $rzvy_translangArr['category_status']; }else{ echo $rzvy_defaultlang['category_status']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['action'])){ echo $rzvy_translangArr['action']; }else{ echo $rzvy_defaultlang['action']; } ?></th>
				</tr>
			  </thead>
			  <tbody>
				<?php 
				$all_categories = $obj_categories->get_all_categories();
				if(mysqli_num_rows($all_categories)>0){
					$i = 1;
					while($category = mysqli_fetch_assoc($all_categories)){
						?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo ucwords($category['cat_name']); ?></td>
							<td>
								<?php $checked = ''; if($category['status'] == "Y"){ $checked = "checked"; } ?> 
								<label class="rzvy-toggle-switch">
									<input type="checkbox" data-id="<?php echo $category['id']; ?>" class="rzvy-toggle-switch-input rzvy_change_category_status" <?php echo $checked; ?> />
									<span class="rzvy-toggle-switch-slider"></span>
								</label>
							</td>
							<td>
								<?php
								$obj_services->cat_id = $category['id'];
								$total_services = $obj_services->count_all_services_by_cat_id();
								if(isset($rzvy_translangArr['services'])){ 
									$services_trans = $rzvy_translangArr['services']; 
								}else{ 
									$services_trans = $rzvy_defaultlang['services']; 
								} 
								?>
								<a class="btn btn-secondary btn-sm m-1" href="<?php echo SITE_URL; ?>backend/services.php?cid=<?php echo $category["id"]; ?>" data-id="<?php echo $category['id']; ?>"><i class="fa fa-fw fa-th-list"></i> <?php echo $services_trans; ?> <span class="badge badge-light"><?php echo $total_services; ?></span></a>
								<a class="btn btn-primary rzvy-white btn-sm rzvy-update-categorymodal m-1" data-id="<?php echo $category['id']; ?>"><i class="fa fa-fw fa-pencil"></i></a> 
								<a class="btn btn-danger rzvy-white btn-sm rzvy_delete_category_btn m-1" data-id="<?php echo $category['id']; ?>"><i class="fa fa-fw fa-trash"></i></a>
							</td>
						</tr>
						<?php 
						$i++;
					}
				} 
				?>
			</tbody>
           </table>
          </div>
        </div>
      </div>
	 <!-- Add Modal-->
	<div class="modal fade" id="rzvy-add-category-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-add-category-modal-label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy-add-category-modal-label"><?php if(isset($rzvy_translangArr['add_category'])){ echo $rzvy_translangArr['add_category']; }else{ echo $rzvy_defaultlang['add_category']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form name="rzvy_add_category_form" id="rzvy_add_category_form" method="post">
			  <div class="form-group">
				<label for="rzvy_categoryname"><?php if(isset($rzvy_translangArr['category_name'])){ echo $rzvy_translangArr['category_name']; }else{ echo $rzvy_defaultlang['category_name']; } ?></label>
				<input class="form-control" id="rzvy_categoryname" name="rzvy_categoryname" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_category_name'])){ echo $rzvy_translangArr['enter_category_name']; }else{ echo $rzvy_defaultlang['enter_category_name']; } ?>" />
			  </div>
			  <div class="form-group">
				<label for="rzvy_categorystatus"><?php if(isset($rzvy_translangArr['category_status'])){ echo $rzvy_translangArr['category_status']; }else{ echo $rzvy_defaultlang['category_status']; } ?></label>
				<div>
					<label class="text-success"><input type="radio" name="rzvy_categorystatus" value="Y" checked> <?php if(isset($rzvy_translangArr['activate'])){ echo $rzvy_translangArr['activate']; }else{ echo $rzvy_defaultlang['activate']; } ?></label> &nbsp; &nbsp;<label class="text-danger"><input type="radio" name="rzvy_categorystatus" value="N"> <?php if(isset($rzvy_translangArr['deactivate'])){ echo $rzvy_translangArr['deactivate']; }else{ echo $rzvy_defaultlang['deactivate']; } ?></label>
				</div>
			  </div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
			<a id="rzvy_add_category_btn" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['add'])){ echo $rzvy_translangArr['add']; }else{ echo $rzvy_defaultlang['add']; } ?></a>
		  </div>
		</div>
	  </div>
	</div>
	 <!-- Update Modal-->
	<div class="modal fade" id="rzvy-update-category-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-update-category-modal-label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy-update-category-modal-label"><?php if(isset($rzvy_translangArr['update_category'])){ echo $rzvy_translangArr['update_category']; }else{ echo $rzvy_defaultlang['update_category']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body rzvy-update-category-modal-body">
			
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
			<a id="rzvy_update_category_btn" data-id="" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update'])){ echo $rzvy_translangArr['update']; }else{ echo $rzvy_defaultlang['update']; } ?></a>
		  </div>
		</div>
	  </div>
	</div>
<?php include 'footer.php'; ?>