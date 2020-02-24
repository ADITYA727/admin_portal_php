<?php include 'header.php';
if(!isset($_SESSION["rzvy_staff_calendar"])){
	$_SESSION["rzvy_staff_calendar"] = "all"; 
} 
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['appointments'])){ echo $rzvy_translangArr['appointments']; }else{ echo $rzvy_defaultlang['appointments']; } ?></li>
		<div class="col-md-12">
			<a class="btn btn-primary btn-sm pull-right" href="javascript:void(0)" id="rzvy_open_manual_booking_modal"><i class="fa fa-calendar"></i> <?php if(isset($rzvy_translangArr['manual_booking'])){ echo $rzvy_translangArr['manual_booking']; }else{ echo $rzvy_defaultlang['manual_booking']; } ?></a>
		</div>
      </ol>
	  <div class="row">
		<ul class="rzvy-legend">
			<li class="rzvy_pending"><span></span> <?php if(isset($rzvy_translangArr['pending'])){ echo $rzvy_translangArr['pending']; }else{ echo $rzvy_defaultlang['pending']; } ?></li>
			<li class="rzvy_confirmed"><span></span> <?php if(isset($rzvy_translangArr['confirmed'])){ echo $rzvy_translangArr['confirmed']; }else{ echo $rzvy_defaultlang['confirmed']; } ?></li>
			<li class="rzvy_rescheduled_by_customer"><span></span> <?php if(isset($rzvy_translangArr['rescheduled_by_customer'])){ echo $rzvy_translangArr['rescheduled_by_customer']; }else{ echo $rzvy_defaultlang['rescheduled_by_customer']; } ?></li>
			<li class="rzvy_cancelled_by_customer"><span></span> <?php if(isset($rzvy_translangArr['cancelled_by_customer'])){ echo $rzvy_translangArr['cancelled_by_customer']; }else{ echo $rzvy_defaultlang['cancelled_by_customer']; } ?></li>
			<li class="rzvy_rescheduled_by_you"><span></span> <?php if(isset($rzvy_translangArr['rescheduled_by_you'])){ echo $rzvy_translangArr['rescheduled_by_you']; }else{ echo $rzvy_defaultlang['rescheduled_by_you']; } ?></li>
			<li class="rzvy_rejected_by_you"><span></span> <?php if(isset($rzvy_translangArr['rejected_by_you'])){ echo $rzvy_translangArr['rejected_by_you']; }else{ echo $rzvy_defaultlang['rejected_by_you']; } ?></li>
			<li class="rzvy_rescheduled_by_you"><span></span> <?php if(isset($rzvy_translangArr['rescheduled_by_staff'])){ echo $rzvy_translangArr['rescheduled_by_staff']; }else{ echo $rzvy_defaultlang['rescheduled_by_staff']; } ?></li>
			<li class="rzvy_rejected_by_you"><span></span> <?php if(isset($rzvy_translangArr['rejected_by_staff'])){ echo $rzvy_translangArr['rejected_by_staff']; }else{ echo $rzvy_defaultlang['rejected_by_staff']; } ?></li>
			<li class="rzvy_completed"><span></span> <?php if(isset($rzvy_translangArr['completed'])){ echo $rzvy_translangArr['completed']; }else{ echo $rzvy_defaultlang['completed']; } ?></li>
		</ul>
	 </div>
	<div class="row mb-1 mx-2">
		<div class="form-group">
			<div class="input-group">
				<div id="rzvy-staff-calendar" class="btn-group">
						<a class="btn btn-light btn-sm border rounded-0 <?php if(isset($_SESSION["rzvy_staff_calendar"])){ if($_SESSION["rzvy_staff_calendar"] == "" || $_SESSION["rzvy_staff_calendar"] == "all"){ echo "rzvy_staff_active"; } }elseif(!isset($_SESSION["rzvy_staff_calendar"])){ echo "rzvy_staff_active"; } ?>" data-id="all"><?php if(isset($rzvy_translangArr['all_staff_members'])){ echo $rzvy_translangArr['all_staff_members']; }else{ echo $rzvy_defaultlang['all_staff_members']; } ?></a>
						<?php 
						$stafflist = $obj_staff->getall_staff(); 
						if(mysqli_num_rows($stafflist)>0){ 
							while($staff = mysqli_fetch_array($stafflist)){ 
								?>
								<a class="btn btn-light btn-sm border rounded-0 <?php if(isset($_SESSION["rzvy_staff_calendar"])){ if($_SESSION["rzvy_staff_calendar"] == $staff["id"]){ echo "rzvy_staff_active"; } } ?>" data-id="<?php echo $staff["id"]; ?>"><?php echo ucwords($staff["firstname"]." ".$staff["lastname"]); ?></a>
								<?php 
							}
						} 
						?>
				</div>
			</div>
		</div>
	</div>
	<div class="mb-3">
		<div id='rzvy-appointments-calendar'></div>
	</div>
	 
	 <!-- Manual Booking modal -->
	 <div class="modal fade" id="rzvy_manual_booking_modal" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title"><?php if(isset($rzvy_translangArr['manual_booking'])){ echo $rzvy_translangArr['manual_booking']; }else{ echo $rzvy_defaultlang['manual_booking']; } ?></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<?php include(dirname(__FILE__)."/manual-booking.php"); ?>
				</div>

				<!-- Modal footer -->
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>