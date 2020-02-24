<?php include 'header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['staff'])){ echo $rzvy_translangArr['staff']; }else{ echo $rzvy_defaultlang['staff']; } ?></li>
      </ol>
      <!-- Staff DataTables Card-->
      <div class="card mb-2">
        <div class="card-body">
			    <div class="row">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-header border-0">
                  <b class="pull-left"><?php if(isset($rzvy_translangArr['staff_members'])){ echo $rzvy_translangArr['staff_members']; }else{ echo $rzvy_defaultlang['staff_members']; } ?></b>
                  <a class="btn btn-link pull-right p-0 text-primary" data-toggle="modal" data-target="#rzvy-add-staff-modal"><i class="fa fa-user-plus"></i></a>
                </div>
                <div class="card-body p-0 border-0">
                  <ul class="list-group" id="rzvy-staff-list">
                    <?php 
                    $stafflist = $obj_staff->getall_staff(); 
                    if(mysqli_num_rows($stafflist)>0){ 
                      while($staff = mysqli_fetch_array($stafflist)){ 
                        ?>
                        <li data-id="<?php echo $staff["id"]; ?>" class="rzvy-staff-selection list-group-item border-0"><img class="rounded mr-2" src="<?php if($staff['image'] != '' && file_exists("../uploads/images/".$staff['image'])){ echo SITE_URL."uploads/images/".$staff['image']; }else{ echo SITE_URL."includes/images/staff-sm.png"; } ?>" alt="<?php echo ucwords($staff["firstname"]." ".$staff["lastname"]); ?>" /> <?php echo ucwords($staff["firstname"]." ".$staff["lastname"]); ?></li>
                        <?php 
                      }
                    }else{
                      echo '<p class="list-group-item border-0">';
					  if(isset($rzvy_translangArr['no_staff'])){ echo $rzvy_translangArr['no_staff']; }else{ echo $rzvy_defaultlang['no_staff']; }
                      echo '</p>';
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
            <div id="rzvy-staff-detail-card" class="col-md-8 mb-3">

            </div>
			    </div>
        </div>
			</div>
	<!-- Add Modal-->
	<div class="modal fade" id="rzvy-add-staff-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-add-staff-modal-label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy-add-staff-modal-label"><?php if(isset($rzvy_translangArr['add_staff'])){ echo $rzvy_translangArr['add_staff']; }else{ echo $rzvy_defaultlang['add_staff']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body">
				<form name="rzvy_addstaff_form" id="rzvy_addstaff_form" method="post">
					<div class="form-group row"> 
						<div class="col-md-6"> 
							<input class="form-control" id="rzvy_addstaff_firstname" name="rzvy_addstaff_firstname" type="text" value="" placeholder="<?php if(isset($rzvy_translangArr['enter_first_name'])){ echo $rzvy_translangArr['enter_first_name']; }else{ echo $rzvy_defaultlang['enter_first_name']; } ?>"> 
						</div> 
						<div class="col-md-6"> 
							<input class="form-control" id="rzvy_addstaff_lastname" name="rzvy_addstaff_lastname" type="text" value="" placeholder="<?php if(isset($rzvy_translangArr['enter_last_name'])){ echo $rzvy_translangArr['enter_last_name']; }else{ echo $rzvy_defaultlang['enter_last_name']; } ?>"> 
						</div> 
					</div> 
					<div class="form-group row"> 
						<div class="col-md-12"> 
							<input class="form-control" id="rzvy_addstaff_email" name="rzvy_addstaff_email" type="email" value="" placeholder="<?php if(isset($rzvy_translangArr['enter_email'])){ echo $rzvy_translangArr['enter_email']; }else{ echo $rzvy_defaultlang['enter_email']; } ?>"> 
						</div> 
					</div> 
					<div class="form-group row"> 
						<div class="col-md-6"> 
							<input class="form-control" id="rzvy_addstaff_password" name="rzvy_addstaff_password" type="password" value="" placeholder="<?php if(isset($rzvy_translangArr['enter_password'])){ echo $rzvy_translangArr['enter_password']; }else{ echo $rzvy_defaultlang['enter_password']; } ?>"> 
						</div> 
						<div class="col-md-6"> 
							<input class="form-control" id="rzvy_addstaff_cpassword" name="rzvy_addstaff_cpassword" type="password" value="" placeholder="<?php if(isset($rzvy_translangArr['confirm_password'])){ echo $rzvy_translangArr['confirm_password']; }else{ echo $rzvy_defaultlang['confirm_password']; } ?>"> 
						</div> 
					</div> 
				</form>
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
			<a class="btn btn-primary rzvy_addstaff_btn" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['add'])){ echo $rzvy_translangArr['add']; }else{ echo $rzvy_defaultlang['add']; } ?></a>
		  </div>
		</div>
	  </div>
	</div>
<?php include 'footer.php'; ?>