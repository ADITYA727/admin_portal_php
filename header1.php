<?php 
$companyname = $obj_settings->get_option("rzvy_company_name"); 
$rzy_company_logo = $obj_settings->get_option("rzvy_company_logo"); 
?>
<!-- Brand and toggle get grouped for better mobile display -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" id="rzvy-main-menu-collapse">
    <a class="navbar-brand" href="<?php echo SITE_URL; ?>"><?php if($rzy_company_logo != "" && file_exists("uploads/images/".$rzy_company_logo)){ ?><img height="90px" width="90px;" class="rzvy-sacompanylogo" src="<?php echo SITE_URL; ?>uploads/images/<?php echo $rzy_company_logo; ?>" /> <?php }else{ echo ucwords($companyname); } ?></a>
    <button id="rzvy-sasa-navbarresponsive-toggler-icon" class="navbar-toggler navbar-toggler-right" type="button" >
      <span class="navbar-toggler-icon"></span>
    </button>
	<div class="collapse navbar-collapse" id="rzvy-sasa-navbarresponsive">
		<ul class="navbar-nav ml-auto">
			<?php 		
			if($lang_j>1){ 
				?>
				<li class="nav-item mx-1">
					<div class="nav-link nav-link-no-hover py-0">
						<div class="btn-danger px-2">
							<i class="fa fa-fw fa-language text-white" style="font-size:20px"></i>
							<select class="sarzy_set_language selectpicker" data-style="btn-danger">
								<?php echo $langOptions; ?>
							</select>
						</div>
					</div>
				</li>
				<?php 
			}  
			?>
			<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'register.php') != false) { echo 'rzy_active'; } ?> mx-1">
				<a class="nav-link" href="<?php echo SITE_URL; ?>backend/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['register_now'])){ echo $rzvy_translangArr['register_now']; }else{ echo $rzvy_defaultlang['register_now']; } ?></a>
			</li>
			<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') != false) { echo 'rzy_active'; } ?> mx-1">
				<a class="nav-link" href="<?php echo SITE_URL; ?>backend"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['log_in'])){ echo $rzvy_translangArr['log_in']; }else{ echo $rzvy_defaultlang['log_in']; } ?></a>
			</li>
			<li class="nav-item <?php if (strpos($_SERVER['SCRIPT_NAME'], 'forgot-password.php') != false) { echo 'rzy_active'; } ?> mx-1">
				<a class="nav-link" href="<?php echo SITE_URL; ?>backend/forgot-password.php"><i class="fa fa-user-plus" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['lost_your_password'])){ echo $rzvy_translangArr['lost_your_password']; }else{ echo $rzvy_defaultlang['lost_your_password']; } ?></a>
			</li>
			<li class="nav-item mx-1">
				<a class="nav-link btn btn-danger btn-sm rzvy_header_book_now_btn" href="<?php echo SITE_URL; ?>"><i class="fa fa-calendar" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['book_now'])){ echo $rzvy_translangArr['book_now']; }else{ echo $rzvy_defaultlang['book_now']; } ?></a>
			</li>
		</ul>
	</div>
</nav>