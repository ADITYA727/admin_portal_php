<?php include 'staff-header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/s-appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['profile'])){ echo $rzvy_translangArr['profile']; }else{ echo $rzvy_defaultlang['profile']; } ?></li>
      </ol>
      <!-- Staff DataTables Card-->
      <div class="card mb-2">
        <div class="card-body">
			    <div class="row">
            <div class="col-md-0 mb-3 rzvy-hide">
              <div class="card">
                <div class="card-header border-0">
                  <b class="pull-left"><?php if(isset($rzvy_translangArr['profile'])){ echo $rzvy_translangArr['profile']; }else{ echo $rzvy_defaultlang['profile']; } ?></b>
                </div>
                <div class="card-body p-0 border-0">
                  <ul class="list-group" id="rzvy-staff-list">
					<?php 
					$obj_staff->id = $_SESSION["staff_id"];
					$staff = $obj_staff->readone_staff(); 
					?>
					<li data-id="<?php echo $staff["id"]; ?>" class="rzvy-staff-selection list-group-item border-0"><img class="rounded mr-2" src="<?php if($staff['image'] != '' && file_exists("../uploads/images/".$staff['image'])){ echo SITE_URL."uploads/images/".$staff['image']; }else{ echo SITE_URL."includes/images/staff-sm.png"; } ?>" alt="<?php echo ucwords($staff["firstname"]." ".$staff["lastname"]); ?>" /> <?php echo ucwords($staff["firstname"]." ".$staff["lastname"]); ?></li>
                  </ul>
                </div>
              </div>
            </div>
            <div id="rzvy-staff-detail-card" class="col-md-12 mb-3">

            </div>
			    </div>
        </div>
			</div>
<?php include 'staff-footer.php'; ?>