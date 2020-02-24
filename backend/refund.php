<?php 
include 'header.php'; 
$all_refund_requests = $obj_refund_request->readall_refund_request_detail(); 

$rzvy_currency_symbol = $obj_settings->get_option('rzvy_currency_symbol');
$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
$rzvy_datetime_format = $rzvy_date_format." ".$rzvy_time_format; 
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['refund_request_and_settings'])){ echo $rzvy_translangArr['refund_request_and_settings']; }else{ echo $rzvy_defaultlang['refund_request_and_settings']; } ?></li>
      </ol>
	  <div class="mb-3">
		<div class="rzvy-tabbable-panel">
			<div class="rzvy-tabbable-line">
				<ul class="nav nav-tabs">
				  <li class="nav-item active custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="0" data-toggle="tab" href="#rzvy_refund_request_list"><i class="fa fa-exchange"></i> <?php if(isset($rzvy_translangArr['refund_request'])){ echo $rzvy_translangArr['refund_request']; }else{ echo $rzvy_defaultlang['refund_request']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="1" data-toggle="tab" href="#rzvy_refund_settings"><i class="fa fa-cog"></i> <?php if(isset($rzvy_translangArr['refund_settings'])){ echo $rzvy_translangArr['refund_settings']; }else{ echo $rzvy_defaultlang['refund_settings']; } ?></a>
				  </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane container active" id="rzvy_refund_request_list">
					  <br />
					  <div class="row">
						<div class="col-md-12">
						  <div class="table-responsive">
							<table class="table" id="rzvy_refund_request_list_table" width="100%" cellspacing="0">
							  <thead>
								<tr>
								  <th><?php if(isset($rzvy_translangArr['hash_rzy_translation'])){ echo $rzvy_translangArr['hash_rzy_translation']; }else{ echo $rzvy_defaultlang['hash_rzy_translation']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['customer_name'])){ echo $rzvy_translangArr['customer_name']; }else{ echo $rzvy_defaultlang['customer_name']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['customer_email'])){ echo $rzvy_translangArr['customer_email']; }else{ echo $rzvy_defaultlang['customer_email']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['customer_phone'])){ echo $rzvy_translangArr['customer_phone']; }else{ echo $rzvy_defaultlang['customer_phone']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['appointment_detail'])){ echo $rzvy_translangArr['appointment_detail']; }else{ echo $rzvy_defaultlang['appointment_detail']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['refund_amount'])){ echo $rzvy_translangArr['refund_amount']; }else{ echo $rzvy_defaultlang['refund_amount']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['requested_on'])){ echo $rzvy_translangArr['requested_on']; }else{ echo $rzvy_defaultlang['requested_on']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['status'])){ echo $rzvy_translangArr['status']; }else{ echo $rzvy_defaultlang['status']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['refund_request'])){ echo $rzvy_translangArr['refund_request']; }else{ echo $rzvy_defaultlang['refund_request']; } ?></th>
								</tr>
							  </thead>
							  <tbody>
								<?php 
								if(mysqli_num_rows($all_refund_requests)>0){
									while($refund_request = mysqli_fetch_array($all_refund_requests)){ 
										$appointment = $obj_refund_request->get_appointment_detail_by_order_id($refund_request["order_id"]); 
										?>
										<tr>
										  <td><?php echo $refund_request['order_id']; ?></td>
										  <td><?php echo ucwords($appointment['c_firstname']." ".$appointment['c_lastname']); ?></td>
										  <td><?php echo $appointment['c_email']; ?> </td>
										  <td><?php echo $appointment['c_phone']; ?> </td>
										  <td>
											<?php echo ucwords($appointment['cat_name']." - ".$appointment['title'])." on ".date($rzvy_datetime_format, strtotime($appointment["booking_datetime"]));  
											?>
										  </td>
										  <td><?php echo $rzvy_currency_symbol.$refund_request['amount']; ?></td>
										  <td><?php echo date($rzvy_datetime_format, strtotime($refund_request['requested_on'])); ?></td>
										  <td><?php if($refund_request['status'] == "refunded"){ ?><label class="text-success"><?php echo ucwords($refund_request['status']); ?></label><?php }else if($refund_request['status'] == "cancelled_by_admin"){ ?><label class="text-primary"><?php echo "Cancelled by You"; ?></label><?php }else if($refund_request['status'] == "cancelled_by_customer"){ ?><label class="text-danger"><?php echo "Cancelled by Customer"; ?></label><?php }else{ ?><label class="text-primary"><?php echo ucwords($refund_request['status']); ?></label><?php } ?></td>
										  <td>
											<?php if($refund_request['status'] == "pending"){ ?>
												<a class="btn btn-success btn-sm rzvy_markasrefunded_btn" href="javascript:void(0);" data-id="<?php echo $refund_request['id']; ?>"><i class="fa fa-fw fa-exchange"></i></a> <a class="btn btn-danger btn-sm rzvy_cancel_refundrequest_btn" href="javascript:void(0);" data-id="<?php echo $refund_request['id']; ?>"><i class="fa fa-fw fa-ban"></i></a>
											<?php 
											}else if($refund_request['status'] == "refunded"){
												echo '<i class="fa fa-fw fa-2x text-success fa-exchange"></i>';
											}else if($refund_request['status'] == "cancelled_by_customer"){
												echo '<i class="fa fa-fw fa-ban text-danger fa-2x"></i>'; 
											}else{
												echo '<i class="fa fa-fw fa-minus-circle text-primary fa-2x"></i>'; 
											} ?>
										  </td>
										</tr>
										<?php 
									} 
								} 
								?>
							  </tbody>
						   </table>
						  </div>
						</div>
					  </div>
					</div>
					<div class="tab-pane container fade" id="rzvy_refund_settings">
					  <br/>
					  <div class="row">
						<div class="col-md-12">
							<form name="rzvy_refund_settings_form" id="rzvy_refund_settings_form" method="post">
								<div class="row">
									<label class="col-md-2"><?php if(isset($rzvy_translangArr['allow_refund'])){ echo $rzvy_translangArr['allow_refund']; }else{ echo $rzvy_defaultlang['allow_refund']; } ?></label>
									<label class="rzvy-toggle-switch">
										<input type="checkbox" name="rzvy_refund_status" id="rzvy_refund_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_refund_status")=="Y"){ echo "checked"; } ?> />
										<span class="rzvy-toggle-switch-slider"></span>
									</label>
								</div>
								<hr />
								<div class="form-group row">								
									<div class="col-md-3">
										<label class="control-label"><?php if(isset($rzvy_translangArr['refund_type'])){ echo $rzvy_translangArr['refund_type']; }else{ echo $rzvy_defaultlang['refund_type']; } ?></label>
										<?php $rzvy_refund_type = $obj_settings->get_option("rzvy_refund_type"); ?>
										<select name="rzvy_refund_type" id="rzvy_refund_type" class="form-control selectpicker">
										  <option value="percentage" <?php if($rzvy_refund_type == "percentage"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['percentage'])){ echo $rzvy_translangArr['percentage']; }else{ echo $rzvy_defaultlang['percentage']; } ?></option>
										  <option value="flat" <?php if($rzvy_refund_type == "flat"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['flat'])){ echo $rzvy_translangArr['flat']; }else{ echo $rzvy_defaultlang['flat']; } ?></option>
										</select>
									</div>
									<div class="col-md-3">
										<label class="control-label"><?php if(isset($rzvy_translangArr['refund_value'])){ echo $rzvy_translangArr['refund_value']; }else{ echo $rzvy_defaultlang['refund_value']; } ?></label>
										<input type="text" name="rzvy_refund_value" id="rzvy_refund_value" placeholder="<?php if(isset($rzvy_translangArr['e_g_5'])){ echo $rzvy_translangArr['e_g_5']; }else{ echo $rzvy_defaultlang['e_g_5']; } ?>" class="form-control" value="<?php echo $obj_settings->get_option("rzvy_refund_value"); ?>" />
									</div>
									<div class="col-md-6">
										<label class="control-label"><?php if(isset($rzvy_translangArr['refund_request_buffer_time'])){ echo $rzvy_translangArr['refund_request_buffer_time']; }else{ echo $rzvy_defaultlang['refund_request_buffer_time']; } ?></label>
										<?php $rzvy_refund_request_buffer_time = $obj_settings->get_option("rzvy_refund_request_buffer_time"); ?>
										<select name="rzvy_refund_request_buffer_time" id="rzvy_refund_request_buffer_time" class="form-control selectpicker">
										  <option value="20" <?php if($rzvy_refund_request_buffer_time == "20"){ echo "selected"; } ?>>20 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="30" <?php if($rzvy_refund_request_buffer_time == "30"){ echo "selected"; } ?>>30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="45" <?php if($rzvy_refund_request_buffer_time == "45"){ echo "selected"; } ?>>45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="60" <?php if($rzvy_refund_request_buffer_time == "60"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="75" <?php if($rzvy_refund_request_buffer_time == "75"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="90" <?php if($rzvy_refund_request_buffer_time == "90"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="105" <?php if($rzvy_refund_request_buffer_time == "105"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="120" <?php if($rzvy_refund_request_buffer_time == "120"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="135" <?php if($rzvy_refund_request_buffer_time == "135"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="150" <?php if($rzvy_refund_request_buffer_time == "150"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="165" <?php if($rzvy_refund_request_buffer_time == "165"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="180" <?php if($rzvy_refund_request_buffer_time == "180"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="195" <?php if($rzvy_refund_request_buffer_time == "195"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="210" <?php if($rzvy_refund_request_buffer_time == "210"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="225" <?php if($rzvy_refund_request_buffer_time == "225"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
										  <option value="240" <?php if($rzvy_refund_request_buffer_time == "240"){ echo "selected"; } ?>>4 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="300" <?php if($rzvy_refund_request_buffer_time == "300"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="360" <?php if($rzvy_refund_request_buffer_time == "360"){ echo "selected"; } ?>>6 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="420" <?php if($rzvy_refund_request_buffer_time == "420"){ echo "selected"; } ?>>7 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="480" <?php if($rzvy_refund_request_buffer_time == "480"){ echo "selected"; } ?>>8 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="540" <?php if($rzvy_refund_request_buffer_time == "540"){ echo "selected"; } ?>>9 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="600" <?php if($rzvy_refund_request_buffer_time == "600"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="660" <?php if($rzvy_refund_request_buffer_time == "660"){ echo "selected"; } ?>>11 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="720" <?php if($rzvy_refund_request_buffer_time == "720"){ echo "selected"; } ?>>12 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="1440" <?php if($rzvy_refund_request_buffer_time == "1440"){ echo "selected"; } ?>>24 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="2160" <?php if($rzvy_refund_request_buffer_time == "2160"){ echo "selected"; } ?>>36 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="2880" <?php if($rzvy_refund_request_buffer_time == "2880"){ echo "selected"; } ?>>48 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="3600" <?php if($rzvy_refund_request_buffer_time == "3600"){ echo "selected"; } ?>>60 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										  <option value="4320" <?php if($rzvy_refund_request_buffer_time == "4320"){ echo "selected"; } ?>>72 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
										</select>
									</div>
								</div>
								<hr />
								<div class="form-group row">
									<div class="col-md-12">
										<label class="control-label"><?php if(isset($rzvy_translangArr['refund_policy'])){ echo $rzvy_translangArr['refund_policy']; }else{ echo $rzvy_defaultlang['refund_policy']; } ?></label>
										<textarea name="rzvy_refund_summary" class="rzvy_refund_summary rzvy_text_editor_container" id="rzvy_refund_summary" autocomplete="off"><?php echo base64_decode($obj_settings->get_option("rzvy_refund_summary")); ?></textarea>
									</div>
								</div>
								<a id="update_refund_settings_btn" class="btn btn-success btn-block" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
							</form>
						</div>
					  </div>
				    </div>
				</div>
			</div>
		</div>
	 </div>
<?php include 'footer.php'; ?>