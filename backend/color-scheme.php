<?php include 'header.php'; ?>
<script>
window.location.href = "<?php echo SITE_URL; ?>backend/appointments.php";
</script>
<?php exit; ?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a></li>
	<li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['color_scheme'])){ echo $rzvy_translangArr['color_scheme']; }else{ echo $rzvy_defaultlang['color_scheme']; } ?></li>
</ol>
<div class="row">
	<div class="col-md-6 my-2">
		<div class="card rzvy-boxshadow mt-1 mr-1" id="rzvy_cs_admin_dashboard">
			<div class="card-body text-primary text-center">
				<?php if(isset($rzvy_translangArr['dashboard'])){ echo $rzvy_translangArr['dashboard']; }else{ echo $rzvy_defaultlang['dashboard']; } ?>
			</div>
		</div>
	</div>
	<div class="col-md-6 my-2">
		<div class="card rzvy-boxshadow mt-1 mr-1" id="rzvy_cs_bf_and_ls_page">
			<div class="card-body text-primary text-center">
				<?php if(isset($rzvy_translangArr['booking_form_and_location_selector_page'])){ echo $rzvy_translangArr['booking_form_and_location_selector_page']; }else{ echo $rzvy_defaultlang['booking_form_and_location_selector_page']; } ?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="rzvy-color-scheme-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-color-scheme-modal-label" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="rzvy-color-scheme-modal-label"></h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body rzvy-color-scheme-modal-content mb-4 mx-3">

			</div>
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>