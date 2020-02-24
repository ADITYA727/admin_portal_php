<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_frequently_discount.php");

/* Create object of classes */
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;
$obj_frequently_discount = new rzvy_frequently_discount();
$obj_frequently_discount->conn = $conn;

/* Change coupon status ajax */
if(isset($_POST['change_fd_status'])){
	$obj_frequently_discount->id = $_POST['id'];
	$obj_frequently_discount->fd_status = $_POST['fd_status'];
	$status_changed = $obj_frequently_discount->change_frequently_discount_status();
	if($status_changed){
		echo "changed";
	}else{
		echo "failed";
	}
}
/* Update Frequently Discount modal ajax */
else if(isset($_REQUEST['update_fd_modal'])){
	$obj_frequently_discount->id = $_POST['id'];
	$fd = $obj_frequently_discount->readone_frequently_discount();
	?>
	<form name="rzvy_update_fd_form" id="rzvy_update_fd_form" method="post">
	  <div class="form-group">
		<label for="rzvy_fdlabel"><?php if(isset($rzvy_translangArr['frequently_discount_label'])){ echo $rzvy_translangArr['frequently_discount_label']; }else{ echo $rzvy_defaultlang['frequently_discount_label']; } ?></label>
		<input class="form-control" id="rzvy_fdlabel" name="rzvy_fdlabel" type="text" placeholder="Enter <?php if(isset($rzvy_translangArr['label'])){ echo $rzvy_translangArr['label']; }else{ echo $rzvy_defaultlang['label']; } ?>Frequently Discount Label" value="<?php echo $fd['fd_label']; ?>" />
	  </div>
	  <div class="form-group">
		<label for="rzvy_fdtype"><?php if(isset($rzvy_translangArr['frequently_discount_type'])){ echo $rzvy_translangArr['frequently_discount_type']; }else{ echo $rzvy_defaultlang['frequently_discount_type']; } ?></label>
		<select class="form-control" id="rzvy_fdtype" name="rzvy_fdtype">
		  <option value="percentage" <?php if($fd['fd_type'] == "percentage"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['percentage'])){ echo $rzvy_translangArr['percentage']; }else{ echo $rzvy_defaultlang['percentage']; } ?></option>
		  <option value="flat" <?php if($fd['fd_type'] == "flat"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['flat'])){ echo $rzvy_translangArr['flat']; }else{ echo $rzvy_defaultlang['flat']; } ?></option>
		</select>
	  </div>
	  <div class="form-group">
		<label for="rzvy_fdvalue"><?php if(isset($rzvy_translangArr['frequently_discount_value'])){ echo $rzvy_translangArr['frequently_discount_value']; }else{ echo $rzvy_defaultlang['frequently_discount_value']; } ?></label>
		<input class="form-control" id="rzvy_fdvalue" name="rzvy_fdvalue" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_frequently_discount_value'])){ echo $rzvy_translangArr['enter_frequently_discount_value']; }else{ echo $rzvy_defaultlang['enter_frequently_discount_value']; } ?>" value="<?php echo $fd['fd_value']; ?>" />
	  </div>
	  <div class="form-group">
		<label for="rzvy_fddescription"><?php if(isset($rzvy_translangArr['Frequently_Discount_Description'])){ echo $rzvy_translangArr['label']; }else{ echo $rzvy_defaultlang['label']; } ?></label>
		<textarea class="form-control" id="rzvy_fddescription" name="rzvy_fddescription" placeholder="<?php if(isset($rzvy_translangArr['Frequently_Discount_Description'])){ echo $rzvy_translangArr['Frequently_Discount_Description']; }else{ echo $rzvy_defaultlang['Frequently_Discount_Description']; } ?>"><?php echo $fd['fd_description']; ?></textarea>
	  </div>
	  <div class="form-group pull-right">
		<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
		<a class="btn btn-primary rzvy_update_fd_btn" href="javascript:void(0);" data-id="<?php echo $fd['id']; ?>"><?php if(isset($rzvy_translangArr['update'])){ echo $rzvy_translangArr['update']; }else{ echo $rzvy_defaultlang['update']; } ?></a>
	  </div>
	</form>
	<?php
}

/* Update Frequently Discount ajax */
else if(isset($_POST['update_frequently_discount'])){
	$obj_frequently_discount->id = $_POST['id'];
	$obj_frequently_discount->fd_label = htmlentities($_POST['fd_label']);
	$obj_frequently_discount->fd_type = $_POST['fd_type'];
	$obj_frequently_discount->fd_value = $_POST['fd_value'];
	$obj_frequently_discount->fd_description = htmlentities($_POST['fd_description']);
	$fd_updated = $obj_frequently_discount->update_frequently_discount();
	if($fd_updated){
		echo "updated";
	}else{
		echo "failed";
	}
}

/* Refresh Frequently Discount ajax */
else if(isset($_POST['refresh_frequently_discount'])){
	$all_frequently_discount = $obj_frequently_discount->get_all_frequently_discount();
	while($frequently_discount = mysqli_fetch_array($all_frequently_discount)){
		?>
		<tr>
		  <td><?php echo $frequently_discount['fd_label']; ?></td>
		  <td><?php echo ucwords($frequently_discount['fd_type']); ?></td>
		  <td><?php if($frequently_discount['fd_type'] == 'flat'){ echo $obj_settings->get_option('rzvy_currency_symbol').$frequently_discount['fd_value']; }else{ echo $frequently_discount['fd_value'].'%'; } ?></td>
		  <td><?php echo $frequently_discount['fd_description']; ?></td>
		  <td>
			<label class="rzvy-toggle-switch">
			  <input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_fd_status" data-id="<?php echo $frequently_discount['id']; ?>" <?php if($frequently_discount['fd_status'] == 'Y'){ echo 'checked'; } ?> />
			  <span class="rzvy-toggle-switch-slider"></span>
			</label>
		  </td>
		  <td>
			<a class="btn btn-primary rzvy-white btn-sm rzvy-update-fdmodal" data-id="<?php echo $frequently_discount['id']; ?>"><i class="fa fa-fw fa-pencil"></i></a>
		  </td>
		</tr>
		<?php
	}
}