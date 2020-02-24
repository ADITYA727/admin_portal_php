<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

/** admin Dashboard **/
if(isset($_POST['get_cs_admin_dash'])){ 
	?>
	<form name="rzvy_cs_admin_dash_form" id="rzvy_cs_admin_dash_form" method="post">
	  <div class="form-group row">
		<div class="col-md-4 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['color_scheme'])){ echo $rzvy_translangArr['color_scheme']; }else{ echo $rzvy_defaultlang['color_scheme']; } ?></label>
			<?php $rzvy_cs_admin_dash = $obj_settings->get_option("rzvy_cs_admin_dash"); ?>
			<select name="rzvy_cs_admin_dash" id="rzvy_cs_admin_dash" class="form-control">
				<option value="default" <?php if($rzvy_cs_admin_dash == "default"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['default'])){ echo $rzvy_translangArr['default']; }else{ echo $rzvy_defaultlang['default']; } ?></option>
				<option value="custom" <?php if($rzvy_cs_admin_dash == "custom"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['custom'])){ echo $rzvy_translangArr['custom']; }else{ echo $rzvy_defaultlang['custom']; } ?></option>
			</select>
		</div>
	  </div>
	  <div class="form-group row">
		<div class="col-md-6 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['primary_color'])){ echo $rzvy_translangArr['primary_color']; }else{ echo $rzvy_defaultlang['primary_color']; } ?></label><br />
			<input name="rzvy_cs_admin_dash_primary_color" id="rzvy_cs_admin_dash_primary_color" class="form-control col-md-3" type="color" value="<?php echo $obj_settings->get_option("rzvy_cs_admin_dash_primary_color"); ?>"  />
		</div>
		<div class="col-md-6 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['secondary_color'])){ echo $rzvy_translangArr['secondary_color']; }else{ echo $rzvy_defaultlang['secondary_color']; } ?></label><br />
			<input name="rzvy_cs_admin_dash_secondary_color" id="rzvy_cs_admin_dash_secondary_color" class="form-control col-md-3" type="color" value="<?php echo $obj_settings->get_option("rzvy_cs_admin_dash_secondary_color"); ?>"  />
		</div>
	  </div>
	  <div class="form-group row">
		<div class="col-md-6 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['background_color'])){ echo $rzvy_translangArr['background_color']; }else{ echo $rzvy_defaultlang['background_color']; } ?></label><br />
			<input name="rzvy_cs_admin_dash_background_color" id="rzvy_cs_admin_dash_background_color" class="form-control col-md-3" type="color" value="<?php echo $obj_settings->get_option("rzvy_cs_admin_dash_background_color"); ?>"  />
		</div>
		<div class="col-md-6 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['text_color'])){ echo $rzvy_translangArr['text_color']; }else{ echo $rzvy_defaultlang['text_color']; } ?></label><br />
			<input name="rzvy_cs_admin_dash_text_color" id="rzvy_cs_admin_dash_text_color" class="form-control col-md-3" type="color" value="<?php echo $obj_settings->get_option("rzvy_cs_admin_dash_text_color"); ?>"  />
		</div>
	  </div>	  
	  <a id="update_cs_admin_dash_btn" class="btn btn-success btn-block py-1" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
	</form>
	<?php 
}

elseif(isset($_POST["update_cs_admin_dash"])){
	$obj_settings->update_option('rzvy_cs_admin_dash',$_POST['rzvy_cs_admin_dash']);
	$obj_settings->update_option('rzvy_cs_admin_dash_primary_color',$_POST['rzvy_cs_admin_dash_primary_color']);
	$obj_settings->update_option('rzvy_cs_admin_dash_secondary_color',$_POST['rzvy_cs_admin_dash_secondary_color']);
	$obj_settings->update_option('rzvy_cs_admin_dash_background_color',$_POST['rzvy_cs_admin_dash_background_color']);
	$obj_settings->update_option('rzvy_cs_admin_dash_text_color',$_POST['rzvy_cs_admin_dash_text_color']);
}


/** Booking form & Location Selector page **/
else if(isset($_POST['get_cs_bfls'])){ 
	?>
	<form name="rzvy_cs_bfls_form" id="rzvy_cs_bfls_form" method="post">
	  <div class="form-group row">
		<div class="col-md-4 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['color_scheme'])){ echo $rzvy_translangArr['color_scheme']; }else{ echo $rzvy_defaultlang['color_scheme']; } ?></label>
			<?php $rzvy_cs_bfls = $obj_settings->get_option("rzvy_cs_bfls"); ?>
			<select name="rzvy_cs_bfls" id="rzvy_cs_bfls" class="form-control">
				<option value="default" <?php if($rzvy_cs_bfls == "default"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['default'])){ echo $rzvy_translangArr['default']; }else{ echo $rzvy_defaultlang['default']; } ?></option>
				<option value="custom" <?php if($rzvy_cs_bfls == "custom"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['custom'])){ echo $rzvy_translangArr['custom']; }else{ echo $rzvy_defaultlang['custom']; } ?></option>
			</select>
		</div>
	  </div>
	  <div class="form-group row">
		<div class="col-md-6 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['primary_color'])){ echo $rzvy_translangArr['primary_color']; }else{ echo $rzvy_defaultlang['primary_color']; } ?></label><br />
			<input name="rzvy_cs_bfls_primary_color" id="rzvy_cs_bfls_primary_color" class="form-control col-md-3" type="color" value="<?php echo $obj_settings->get_option("rzvy_cs_bfls_primary_color"); ?>"  />
		</div>
		<div class="col-md-6 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['secondary_color'])){ echo $rzvy_translangArr['secondary_color']; }else{ echo $rzvy_defaultlang['secondary_color']; } ?></label><br />
			<input name="rzvy_cs_bfls_secondary_color" id="rzvy_cs_bfls_secondary_color" class="form-control col-md-3" type="color" value="<?php echo $obj_settings->get_option("rzvy_cs_bfls_secondary_color"); ?>"  />
		</div>
	  </div>
	  <div class="form-group row">
		<div class="col-md-6 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['background_color'])){ echo $rzvy_translangArr['background_color']; }else{ echo $rzvy_defaultlang['background_color']; } ?></label><br />
			<input name="rzvy_cs_bfls_background_color" id="rzvy_cs_bfls_background_color" class="form-control col-md-3" type="color" value="<?php echo $obj_settings->get_option("rzvy_cs_bfls_background_color"); ?>"  />
		</div>
		<div class="col-md-6 py-2">
			<label class="control-label"><?php if(isset($rzvy_translangArr['text_color'])){ echo $rzvy_translangArr['text_color']; }else{ echo $rzvy_defaultlang['text_color']; } ?></label><br />
			<input name="rzvy_cs_bfls_text_color" id="rzvy_cs_bfls_text_color" class="form-control col-md-3" type="color" value="<?php echo $obj_settings->get_option("rzvy_cs_bfls_text_color"); ?>"  />
		</div>
	  </div>	  
	  <a id="update_cs_bfls_btn" class="btn btn-success btn-block py-1" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
	</form>
	<?php 
}

elseif(isset($_POST["update_cs_bfls"])){
	$obj_settings->update_option('rzvy_cs_bfls',$_POST['rzvy_cs_bfls']);
	$obj_settings->update_option('rzvy_cs_bfls_primary_color',$_POST['rzvy_cs_bfls_primary_color']);
	$obj_settings->update_option('rzvy_cs_bfls_secondary_color',$_POST['rzvy_cs_bfls_secondary_color']);
	$obj_settings->update_option('rzvy_cs_bfls_background_color',$_POST['rzvy_cs_bfls_background_color']);
	$obj_settings->update_option('rzvy_cs_bfls_text_color',$_POST['rzvy_cs_bfls_text_color']);
}