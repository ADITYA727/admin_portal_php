<?php include 'header.php'; ?>
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
        <li class="breadcrumb-item">
			<a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['embed_frontend'])){ echo $rzvy_translangArr['embed_frontend']; }else{ echo $rzvy_defaultlang['embed_frontend']; } ?></li>
	</ol>
	<h4 class="pl-2 pb-2 pt-2"><?php if(isset($rzvy_translangArr['get_embed_code_to_show_booking_widget_on_your_website'])){ echo $rzvy_translangArr['get_embed_code_to_show_booking_widget_on_your_website']; }else{ echo $rzvy_defaultlang['get_embed_code_to_show_booking_widget_on_your_website']; } ?></h4>
	<h6 class="pl-2 pb-2 pt-2"><?php if(isset($rzvy_translangArr['please_copy_below_code_and_paste'])){ echo $rzvy_translangArr['please_copy_below_code_and_paste']; }else{ echo $rzvy_defaultlang['please_copy_below_code_and_paste']; } ?></h6>
	<!-- Embed as IFrame Cards-->
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-code"></i> <?php if(isset($rzvy_translangArr['embed_as_iframe'])){ echo $rzvy_translangArr['embed_as_iframe']; }else{ echo $rzvy_defaultlang['embed_as_iframe']; } ?></div>
		<div class="card-body">
			<div class="row">
				<div class="col-xl-12 col-sm-6">
					<code>&lt;div id="sa-embed" class="direct-load" data-url="<?php echo SITE_URL; ?>"&gt;&lt;/div&gt;&lt;script src="<?php echo SITE_URL; ?>includes/vendor/jquery/jquery.min.js?<?php echo time(); ?>" type="text/javascript"&gt;&lt;/script&gt;&lt;script src="<?php echo SITE_URL; ?>includes/js/embed.js?<?php echo time(); ?>" type="text/javascript"&gt;&lt;/script&gt;</code>
				</div>
			</div>
		</div>
	</div>
	<!-- Embed as Button Cards-->
	<div class="card mb-3">
        <div class="card-header"><i class="fa fa-code"></i> <?php if(isset($rzvy_translangArr['embed_as_link'])){ echo $rzvy_translangArr['embed_as_link']; }else{ echo $rzvy_defaultlang['embed_as_link']; } ?></div>
		<div class="card-body">
			<div class="row">
				<div class="col-xl-12 col-sm-6">
					<code>&lt;a target="_blank" href="<?php echo SITE_URL; ?>"&gt;<?php if(isset($rzvy_translangArr['book_now'])){ echo $rzvy_translangArr['book_now']; }else{ echo $rzvy_defaultlang['book_now']; } ?>&lt;/a&gt;</code>
				</div>
			</div>
		</div>
	</div>
<?php include 'footer.php'; ?>