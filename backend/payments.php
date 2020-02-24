<?php 
include 'header.php';
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['payments'])){ echo $rzvy_translangArr['payments']; }else{ echo $rzvy_defaultlang['payments']; } ?></li>
      </ol>
      <div class="mb-3">
		<div class="rzvy-tabbable-panel">
			<div class="rzvy-tabbable-line">
				<ul class="nav nav-tabs">
				  <li class="nav-item active custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="0" data-toggle="tab" href="#rzvy_registered_customers_payment"><i class="fa fa-credit-card"></i> <?php if(isset($rzvy_translangArr['registered_customers_payment'])){ echo $rzvy_translangArr['registered_customers_payment']; }else{ echo $rzvy_defaultlang['registered_customers_payment']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="1" data-toggle="tab" href="#rzvy_guest_customers_payment"><i class="fa fa-money"></i> <?php if(isset($rzvy_translangArr['guest_customers_payment'])){ echo $rzvy_translangArr['guest_customers_payment']; }else{ echo $rzvy_defaultlang['guest_customers_payment']; } ?></a>
				  </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane container active" id="rzvy_registered_customers_payment">
					  <div class="row">
						<div class="col-md-12">
						  <div class="table-responsive">
							<table class="table" cellspacing="0" id="rzvy_rc_payment_table">
							  <thead>
								<tr>
								  <th><?php if(isset($rzvy_translangArr['order_id'])){ echo $rzvy_translangArr['order_id']; }else{ echo $rzvy_defaultlang['order_id']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['customer_name'])){ echo $rzvy_translangArr['customer_name']; }else{ echo $rzvy_defaultlang['customer_name']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['payment_method'])){ echo $rzvy_translangArr['payment_method']; }else{ echo $rzvy_defaultlang['payment_method']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['payment_date_a'])){ echo $rzvy_translangArr['payment_date_a']; }else{ echo $rzvy_defaultlang['payment_date_a']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['transaction_id'])){ echo $rzvy_translangArr['transaction_id']; }else{ echo $rzvy_defaultlang['transaction_id']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['sub_total'])){ echo $rzvy_translangArr['sub_total']; }else{ echo $rzvy_defaultlang['sub_total']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['discount'])){ echo $rzvy_translangArr['discount']; }else{ echo $rzvy_defaultlang['discount']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['referral_discount_a'])){ echo $rzvy_translangArr['referral_discount_a']; }else{ echo $rzvy_defaultlang['referral_discount_a']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['tax'])){ echo $rzvy_translangArr['tax']; }else{ echo $rzvy_defaultlang['tax']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['net_total'])){ echo $rzvy_translangArr['net_total']; }else{ echo $rzvy_defaultlang['net_total']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['frequently_discount'])){ echo $rzvy_translangArr['frequently_discount']; }else{ echo $rzvy_defaultlang['frequently_discount']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['frequently_discount_amount'])){ echo $rzvy_translangArr['frequently_discount_amount']; }else{ echo $rzvy_defaultlang['frequently_discount_amount']; } ?></th>
								</tr>
							  </thead>
							  <tbody>
							  </tbody>
							</table>
						  </div>
						</div>
					  </div>
					</div>
					<div class="tab-pane container fade" id="rzvy_guest_customers_payment">
					  <br/>
					  <div class="row">
						<div class="col-md-12">
						  <div class="table-responsive">
							<table class="table" cellspacing="0" id="rzvy_gc_payment_table">
							  <thead>
								<tr>
								  <th><?php if(isset($rzvy_translangArr['order_id'])){ echo $rzvy_translangArr['order_id']; }else{ echo $rzvy_defaultlang['order_id']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['customer_name'])){ echo $rzvy_translangArr['customer_name']; }else{ echo $rzvy_defaultlang['customer_name']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['payment_method'])){ echo $rzvy_translangArr['payment_method']; }else{ echo $rzvy_defaultlang['payment_method']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['payment_date_a'])){ echo $rzvy_translangArr['payment_date_a']; }else{ echo $rzvy_defaultlang['payment_date_a']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['transaction_id'])){ echo $rzvy_translangArr['transaction_id']; }else{ echo $rzvy_defaultlang['transaction_id']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['sub_total'])){ echo $rzvy_translangArr['sub_total']; }else{ echo $rzvy_defaultlang['sub_total']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['discount'])){ echo $rzvy_translangArr['discount']; }else{ echo $rzvy_defaultlang['discount']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['tax'])){ echo $rzvy_translangArr['tax']; }else{ echo $rzvy_defaultlang['tax']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['net_total'])){ echo $rzvy_translangArr['net_total']; }else{ echo $rzvy_defaultlang['net_total']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['frequently_discount'])){ echo $rzvy_translangArr['frequently_discount']; }else{ echo $rzvy_defaultlang['frequently_discount']; } ?></th>
								  <th><?php if(isset($rzvy_translangArr['frequently_discount_amount'])){ echo $rzvy_translangArr['frequently_discount_amount']; }else{ echo $rzvy_defaultlang['frequently_discount_amount']; } ?></th>
								</tr>
							  </thead>
							  <tbody>
							  </tbody>
							</table>
						  </div>
						</div>
					  </div>
					</div>
			  </div>
			</div>
		</div>
	 </div>
<?php include 'footer.php'; ?>