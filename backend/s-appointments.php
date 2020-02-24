<?php 
include 'staff-header.php'; 
$_SESSION["rzvy_staff_calendar"] = $_SESSION["staff_id"]; 
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/s-appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['appointments'])){ echo $rzvy_translangArr['appointments']; }else{ echo $rzvy_defaultlang['appointments']; } ?></li>
      </ol>
	  <div class="row mb-1">
			<ul class="rzvy-legend">
			<li class="rzvy_pending"><span></span> <?php if(isset($rzvy_translangArr['pending'])){ echo $rzvy_translangArr['pending']; }else{ echo $rzvy_defaultlang['pending']; } ?></li>
			<li class="rzvy_confirmed"><span></span> <?php if(isset($rzvy_translangArr['confirmed'])){ echo $rzvy_translangArr['confirmed']; }else{ echo $rzvy_defaultlang['confirmed']; } ?></li>
			<li class="rzvy_rescheduled_by_customer"><span></span> <?php if(isset($rzvy_translangArr['rescheduled_by_customer'])){ echo $rzvy_translangArr['rescheduled_by_customer']; }else{ echo $rzvy_defaultlang['rescheduled_by_customer']; } ?></li>
			<li class="rzvy_cancelled_by_customer"><span></span> <?php if(isset($rzvy_translangArr['cancelled_by_customer'])){ echo $rzvy_translangArr['cancelled_by_customer']; }else{ echo $rzvy_defaultlang['cancelled_by_customer']; } ?></li>
			<li class="rzvy_rescheduled_by_you"><span></span> <?php if(isset($rzvy_translangArr['rescheduled_by_you'])){ echo $rzvy_translangArr['rescheduled_by_you']; }else{ echo $rzvy_defaultlang['rescheduled_by_you']; } ?></li>
			<li class="rzvy_rejected_by_you"><span></span> <?php if(isset($rzvy_translangArr['rejected_by_you'])){ echo $rzvy_translangArr['rejected_by_you']; }else{ echo $rzvy_defaultlang['rejected_by_you']; } ?></li>
			<li class="rzvy_rescheduled_by_you"><span></span> <?php if(isset($rzvy_translangArr['rescheduled_by_admin'])){ echo $rzvy_translangArr['rescheduled_by_admin']; }else{ echo $rzvy_defaultlang['rescheduled_by_admin']; } ?></li>
			<li class="rzvy_rejected_by_you"><span></span> <?php if(isset($rzvy_translangArr['rejected_by_admin'])){ echo $rzvy_translangArr['rejected_by_admin']; }else{ echo $rzvy_defaultlang['rejected_by_admin']; } ?></li>
			<li class="rzvy_completed"><span></span> <?php if(isset($rzvy_translangArr['completed'])){ echo $rzvy_translangArr['completed']; }else{ echo $rzvy_defaultlang['completed']; } ?></li>
			</ul>
	 	</div>
		<div class="rzvy-hide">
			<div id="rzvy-staff-calendar">
				<?php 
				$obj_staff->id = $_SESSION["staff_id"];
				$staff = $obj_staff->readone_staff(); 
				?>
				<a class="rzvy_staff_active" data-id="<?php echo $staff["id"]; ?>"><?php echo ucwords($staff["firstname"]." ".$staff["lastname"]); ?></a>
			</div>
	 	</div>
		<div class="row mb-3 mx-4" id="rzvy_cal_lag_list">
			
		</div>
		<hr />
	  <div class="mb-3">
			<div id='rzvy-appointments-calendar'></div>
	 	</div>
<?php include 'staff-footer.php'; ?>