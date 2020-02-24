<?php include 'c_header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/my-appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['my_appointments'])){ echo $rzvy_translangArr['my_appointments']; }else{ echo $rzvy_defaultlang['my_appointments']; } ?></li>
      </ol>
	  <div class="row mb-3">
		<ul class="rzvy-legend">
			<li class="rzvy_pending"><span></span> <?php if(isset($rzvy_translangArr['pending'])){ echo $rzvy_translangArr['pending']; }else{ echo $rzvy_defaultlang['pending']; } ?></li>
			<li class="rzvy_confirmed"><span></span> <?php if(isset($rzvy_translangArr['confirmed'])){ echo $rzvy_translangArr['confirmed']; }else{ echo $rzvy_defaultlang['confirmed']; } ?></li>
			<li class="rzvy_rescheduled_by_customer"><span></span> <?php if(isset($rzvy_translangArr['rescheduled_by_you'])){ echo $rzvy_translangArr['rescheduled_by_you']; }else{ echo $rzvy_defaultlang['rescheduled_by_you']; } ?></li>
			<li class="rzvy_cancelled_by_customer"><span></span> <?php if(isset($rzvy_translangArr['cancelled_by_you'])){ echo $rzvy_translangArr['cancelled_by_you']; }else{ echo $rzvy_defaultlang['cancelled_by_you']; } ?></li>
			<li class="rzvy_rescheduled_by_you"><span></span> <?php if(isset($rzvy_translangArr['rescheduled_by_admin'])){ echo $rzvy_translangArr['rescheduled_by_admin']; }else{ echo $rzvy_defaultlang['rescheduled_by_admin']; } ?></li>
			<li class="rzvy_rejected_by_you"><span></span> <?php if(isset($rzvy_translangArr['rejected_by_admin'])){ echo $rzvy_translangArr['rejected_by_admin']; }else{ echo $rzvy_defaultlang['rejected_by_admin']; } ?></li>
			<li class="rzvy_rescheduled_by_you"><span></span> <?php if(isset($rzvy_translangArr['rescheduled_by_staff'])){ echo $rzvy_translangArr['rescheduled_by_staff']; }else{ echo $rzvy_defaultlang['rescheduled_by_staff']; } ?></li>
			<li class="rzvy_rejected_by_you"><span></span> <?php if(isset($rzvy_translangArr['rejected_by_staff'])){ echo $rzvy_translangArr['rejected_by_staff']; }else{ echo $rzvy_defaultlang['rejected_by_staff']; } ?></li>
			<li class="rzvy_completed"><span></span> <?php if(isset($rzvy_translangArr['completed'])){ echo $rzvy_translangArr['completed']; }else{ echo $rzvy_defaultlang['completed']; } ?></li>
		</ul>
	 </div>
	  <div class="mb-3">
		<div id='rzvy-appointments-calendar'></div>
	 </div>
<?php include 'c_footer.php'; ?>