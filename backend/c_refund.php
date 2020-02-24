<?php 
include 'c_header.php'; 
$obj_refund_request->customer_id = $_SESSION["customer_id"];
$all_refund_requests = $obj_refund_request->readall_refund_request_detail_for_customer(); 

$rzvy_currency_symbol = $obj_settings->get_option('rzvy_currency_symbol');
$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
$rzvy_company_name = $obj_settings->get_option('rzvy_company_name');
$rzvy_company_email = $obj_settings->get_option('rzvy_company_email');
$rzvy_company_phone = $obj_settings->get_option('rzvy_company_phone');

$rzvy_datetime_format = $rzvy_date_format." ".$rzvy_time_format; 
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/my-appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['refund'])){ echo $rzvy_translangArr['refund']; }else{ echo $rzvy_defaultlang['refund']; } ?></li>
      </ol>
	  <!-- DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-fw fa-exchange"></i> <?php if(isset($rzvy_translangArr['refund_request'])){ echo $rzvy_translangArr['refund_request']; }else{ echo $rzvy_defaultlang['refund_request']; } ?>
		</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="rzvy_refund_request_list_table" width="100%" cellspacing="0">
              <thead>
				<tr>
				  <th><?php if(isset($rzvy_translangArr['hash_rzy_translation'])){ echo $rzvy_translangArr['hash_rzy_translation']; }else{ echo $rzvy_defaultlang['hash_rzy_translation']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['appointment_detail'])){ echo $rzvy_translangArr['appointment_detail']; }else{ echo $rzvy_defaultlang['appointment_detail']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['refund_amount'])){ echo $rzvy_translangArr['refund_amount']; }else{ echo $rzvy_defaultlang['refund_amount']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['requested_on'])){ echo $rzvy_translangArr['requested_on']; }else{ echo $rzvy_defaultlang['requested_on']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['status'])){ echo $rzvy_translangArr['status']; }else{ echo $rzvy_defaultlang['status']; } ?></th>
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
						  <td>
							<?php echo ucwords($appointment['cat_name']." - ".$appointment['title'])." on ".date($rzvy_datetime_format, strtotime($appointment["booking_datetime"]));  
							?>
						  </td>
						  <td><?php echo $rzvy_currency_symbol.$refund_request['amount']; ?></td>
						  <td><?php echo date($rzvy_datetime_format, strtotime($refund_request['requested_on'])); ?></td>
						  <td><?php if($refund_request['status'] == "refunded"){ ?><label class="text-success"><?php echo ucwords($refund_request['status']); ?></label><?php }else if($refund_request['status'] == "cancelled_by_admin"){ ?><label class="text-primary"><?php echo "Cancelled by Admin"; ?></label><?php }else if($refund_request['status'] == "cancelled_by_customer"){ ?><label class="text-danger"><?php echo "Cancelled by You"; ?></label><?php }else{ ?><label class="text-primary"><?php echo ucwords($refund_request['status']); ?></label><?php } ?></td>
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
<?php include 'c_footer.php'; ?>