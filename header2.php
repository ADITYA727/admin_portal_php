<?php $companyname = $obj_settings->get_option("rzvy_company_name"); ?>
<header class="rzvy-header-style">
	<div class="row">
		<div class="col-md-5 pl-5"><?php if(!isset($_GET['if'])){ ?><?php if($obj_settings->get_option("rzvy_company_logo") != "" && file_exists("uploads/images/".$obj_settings->get_option("rzvy_company_logo"))){ ?><img class="rzvy-companylogo" src="<?php echo SITE_URL; ?>uploads/images/<?php echo $obj_settings->get_option("rzvy_company_logo"); ?>" /> <?php }else{ ?><b class="rzvy-companytitle"><?php echo $obj_settings->get_option("rzvy_company_name"); ?></b><?php } ?><?php } ?></div>
		<div class="col-md-7">
			<?php 		
			if($lang_j>1){ 
				?>
				<div class="pull-right btn-danger px-2">
					<i class="fa fa-language text-white" style="font-size:20px"></i>
					<select class="rzvy_set_language selectpicker" data-style="btn-danger">
						<?php echo $langOptions; ?>
					</select>
				</div>
				<?php 
			}  
			?>
			<a href="<?php echo SITE_URL; ?>backend/my-appointments.php<?php echo $saiframe; ?>" class="btn btn-link pull-right"><?php if(isset($rzvy_translangArr['my_appointments'])){ echo $rzvy_translangArr['my_appointments']; }else{ echo $rzvy_defaultlang['my_appointments']; } ?></a>
			<?php if($rzvy_location_selector_status == "Y"){ ?> <a data-toggle="modal" data-target="#rzvy-location-selector-modal" href="javascript:void(0)" class="btn btn-link pull-right"><?php if(isset($rzvy_translangArr['book_at_another_location'])){ echo $rzvy_translangArr['book_at_another_location']; }else{ echo $rzvy_defaultlang['book_at_another_location']; } ?></a><?php } ?>
		</div>
	</div>
	<?php 		
	if($lang_j>1){ 
		/* ?>
		<div class="row py-1">
			<div class="col-md-12">
				<div class="pull-right">
					<label for="rzvy_set_language" class="fa fa-fw fa-language text-danger"></label>
					<select class="rzvy_set_language selectpicker" data-style="btn-danger">
						<?php echo $langOptions; ?>
					</select>
				</div>
			</div>
		</div>
		<?php  */
	}  
	?>
</header>