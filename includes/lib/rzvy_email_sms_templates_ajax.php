<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_templates.php");

/* Create object of classes */ 
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$obj_templates = new rzvy_templates();
$obj_templates->conn = $conn;

/** Update Email template Ajax **/
if(isset($_POST["update_email_template"])){
	$obj_templates->template = $_POST['template'];
	$obj_templates->subject = htmlentities($_POST['subject']);
	$obj_templates->email_content = base64_encode($_POST['email_content']);
	$obj_templates->template_for = $_POST['template_for'];
	$obj_templates->email_status = $_POST['email_status'];
	$updated = $obj_templates->update_email_template();
	if($updated){
		echo "updated";
	}
}

/** Update Email template Ajax **/
else if(isset($_POST["update_sms_template"])){
	$obj_templates->template = $_POST['template'];
	$obj_templates->sms_content = base64_encode($_POST['sms_content']);
	$obj_templates->template_for = $_POST['template_for'];
	$obj_templates->sms_status = $_POST['sms_status'];
	$updated = $obj_templates->update_sms_template();
	if($updated){
		echo "updated";
	}
}

/** Get Email template Ajax **/
else if(isset($_POST['get_email_template'])){ 
	$template = $_POST["template"];
	$template_for = $_POST["template_for"]; 
	$obj_templates->template = $template;
	$obj_templates->template_for = $template_for;
	$template_data = $obj_templates->readone_template(); 
	if(mysqli_num_rows($template_data)>0){
		$tdetail = mysqli_fetch_array($template_data);
		$status = $tdetail["email_status"];
		$subject = $tdetail["subject"];
		$content = $tdetail["email_content"]; 
		?>
		<form name="rzvy_email_templates_settings_form" id="rzvy_email_templates_settings_form" method="post">
			<input type="hidden" id="rzvy_emailtemplate_template" value="<?php echo $template; ?>" />
			<input type="hidden" id="rzvy_emailtemplate_template_for" value="<?php echo $template_for; ?>" />
			<div class="form-group row">
				<div class="col-md-12">
					<label class="col-md-4 rzvy-va-top pt-1"><?php echo ucwords($template_for); ?> <?php if(isset($rzvy_translangArr['email_status'])){ echo $rzvy_translangArr['email_status']; }else{ echo $rzvy_defaultlang['email_status']; } ?></label>
					<label class="rzvy-toggle-switch">
						<input type="checkbox" id="rzvy_email_template_status" class="rzvy-toggle-switch-input" <?php if($status == "Y"){ echo "checked"; } ?> />
						<span class="rzvy-toggle-switch-slider"></span>
					</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label class="control-label"><?php if(isset($rzvy_translangArr['email_subject'])){ echo $rzvy_translangArr['email_subject']; }else{ echo $rzvy_defaultlang['email_subject']; } ?></label>
					<input name="rzvy_email_template_subject" id="rzvy_email_template_subject" class="form-control" type="text" value="<?php echo $subject; ?>" placeholder="<?php if(isset($rzvy_translangArr['enter_subject'])){ echo $rzvy_translangArr['enter_subject']; }else{ echo $rzvy_defaultlang['enter_subject']; } ?>" />
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12">
					<label class="control-label"><?php if(isset($rzvy_translangArr['email_template'])){ echo $rzvy_translangArr['email_template']; }else{ echo $rzvy_defaultlang['email_template']; } ?></label>
					<textarea name="rzvy_email_template_content" class="rzvy_text_editor_container" id="rzvy_email_template_content" autocomplete="off"><?php if($content != ""){ echo base64_decode($content); } ?></textarea>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-12">
					<center><h4 class="control-label"><?php if(isset($rzvy_translangArr['dynamic_tags'])){ echo $rzvy_translangArr['dynamic_tags']; }else{ echo $rzvy_defaultlang['dynamic_tags']; } ?></h4></center>
					<center><small><b><?php if(isset($rzvy_translangArr['copy_tags_info_message'])){ echo $rzvy_translangArr['copy_tags_info_message']; }else{ echo $rzvy_defaultlang['copy_tags_info_message']; } ?></b></small></center>
					<hr />
					<ul class="list-inline ml-3 text-white">
						<?php 
						if($template_for == "all"){ 
							?>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{email}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{phone}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_email}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_phone}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_address}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_logo}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{reset_password_link}}}</li>
							<?php 
						}else{ 
							?>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{category}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{service}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{addons}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{booking_date}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{booking_time}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{payment_method}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{payment_date}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{transaction_id}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{sub_total}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{coupon_discount}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{frequently_discount}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{tax}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{net_total}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{customer_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{customer_email}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{customer_phone}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{customer_address}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{admin_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{staff_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_email}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_phone}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_address}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_logo}}}</li>
							<?php 
							} 
						?>
					</ul>
				</div>
			</div>
		</form>
		<?php 
	}else{
		if(isset($rzvy_translangArr['template_unavailable'])){ 
			$template_unavailable = $rzvy_translangArr['template_unavailable']; 
		}else{ 
			$template_unavailable = $rzvy_defaultlang['template_unavailable']; 
		}		
		echo "<center class='m-5'><h4>".$template_unavailable."</h4></center>";
	} 
}

/** Get SMS template Ajax **/
else if(isset($_POST['get_sms_template'])){ 
	$template = $_POST["template"];
	$template_for = $_POST["template_for"]; 
	$obj_templates->template = $template;
	$obj_templates->template_for = $template_for;
	$template_data = $obj_templates->readone_template(); 
	if(mysqli_num_rows($template_data)>0){
		$tdetail = mysqli_fetch_array($template_data);
		$status = $tdetail["sms_status"];
		$content = $tdetail["sms_content"];
		?>
		<form name="rzvy_sms_templates_settings_form" id="rzvy_sms_templates_settings_form" method="post">
			<input type="hidden" id="rzvy_smstemplate_template" value="<?php echo $template; ?>" />
			<input type="hidden" id="rzvy_smstemplate_template_for" value="<?php echo $template_for; ?>" />
			<div class="form-group row">
				<div class="col-md-12">
					<label class="col-md-4 rzvy-va-top pt-1"><?php echo ucwords($template_for); ?> <?php if(isset($rzvy_translangArr['sms_status'])){ echo $rzvy_translangArr['sms_status']; }else{ echo $rzvy_defaultlang['sms_status']; } ?></label>
					<label class="rzvy-toggle-switch">
						<input type="checkbox" id="rzvy_sms_template_status" class="rzvy-toggle-switch-input" <?php if($status == "Y"){ echo "checked"; } ?> />
						<span class="rzvy-toggle-switch-slider"></span>
					</label>
				</div>
			</div>
			<div class="form-group row">
				<div class="col-md-12 pl-4">
					<label class="control-label"><?php if(isset($rzvy_translangArr['sms_template'])){ echo $rzvy_translangArr['sms_template']; }else{ echo $rzvy_defaultlang['sms_template']; } ?></label>
					<textarea class="form-control" name="rzvy_sms_template_content" id="rzvy_sms_template_content" rows="5" placeholder="<?php if(isset($rzvy_translangArr['write_something'])){ echo $rzvy_translangArr['write_something']; }else{ echo $rzvy_defaultlang['write_something']; } ?>"><?php echo base64_decode($content); ?></textarea>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-md-12">
					<center><h4 class="control-label"><?php if(isset($rzvy_translangArr['dynamic_tags'])){ echo $rzvy_translangArr['dynamic_tags']; }else{ echo $rzvy_defaultlang['dynamic_tags']; } ?></h4></center>
					<center><small><b><?php if(isset($rzvy_translangArr['copy_tags_info_message'])){ echo $rzvy_translangArr['copy_tags_info_message']; }else{ echo $rzvy_defaultlang['copy_tags_info_message']; } ?></b></small></center>
					<hr />
					<ul class="list-inline ml-3 text-white">
						<?php 
						if($template_for == "all"){ 
							?>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{email}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{phone}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_email}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_phone}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_address}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_logo}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{reset_password_link}}}</li>
							<?php 
						}else{ 
							?>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{category}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{service}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{addons}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{booking_date}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{booking_time}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{payment_method}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{payment_date}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{transaction_id}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{sub_total}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{coupon_discount}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{frequently_discount}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{tax}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{net_total}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{customer_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{customer_email}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{customer_phone}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{customer_address}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{admin_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{staff_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_name}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_email}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_phone}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_address}}}</li>
							<li class="list-inline-item badge bg-dark p-2 mb-2">{{{company_logo}}}</li>
							<?php 
							} 
						?>
					</ul>
				</div>
			</div>
		</form>
		<?php 
	}else{
		if(isset($rzvy_translangArr['template_unavailable'])){ 
			$template_unavailable = $rzvy_translangArr['template_unavailable']; 
		}else{ 
			$template_unavailable = $rzvy_defaultlang['template_unavailable']; 
		}
		
		echo "<center class='m-5'><h4>".$template_unavailable."</h4></center>";
	} 
}