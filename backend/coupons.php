<?php include 'header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['coupons'])){ echo $rzvy_translangArr['coupons']; }else{ echo $rzvy_defaultlang['coupons']; } ?></li>
      </ol>
      <!-- Coupon DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-fw fa-book"></i> <?php if(isset($rzvy_translangArr['coupon_list'])){ echo $rzvy_translangArr['coupon_list']; }else{ echo $rzvy_defaultlang['coupon_list']; } ?>
		  <a class="btn btn-success btn-sm rzvy-white pull-right" data-toggle="modal" data-target="#rzvy_add_coupon_modal"><i class="fa fa-plus"></i> <?php if(isset($rzvy_translangArr['add_coupon'])){ echo $rzvy_translangArr['add_coupon']; }else{ echo $rzvy_defaultlang['add_coupon']; } ?></a>
		  </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="rzvy_coupons_table" width="100%" cellspacing="0">
              <thead>
				<tr>
				  <th><?php if(isset($rzvy_translangArr['coupon_code'])){ echo $rzvy_translangArr['coupon_code']; }else{ echo $rzvy_defaultlang['coupon_code']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['coupon_type'])){ echo $rzvy_translangArr['coupon_type']; }else{ echo $rzvy_defaultlang['coupon_type']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['coupon_value'])){ echo $rzvy_translangArr['coupon_value']; }else{ echo $rzvy_defaultlang['coupon_value']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['expiry_date'])){ echo $rzvy_translangArr['expiry_date']; }else{ echo $rzvy_defaultlang['expiry_date']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['coupon_status'])){ echo $rzvy_translangArr['coupon_status']; }else{ echo $rzvy_defaultlang['coupon_status']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['action'])){ echo $rzvy_translangArr['action']; }else{ echo $rzvy_defaultlang['action']; } ?></th>
				</tr>
			  </thead>
			  <tbody>
				
			</tbody>
           </table>
          </div>
        </div>
        <div class="card-footer small text-muted"></div>
      </div>
	 <!-- Add Modal-->
	<div class="modal fade" id="rzvy_add_coupon_modal" tabindex="-1" role="dialog" aria-labelledby="rzvy_add_coupon_modal_label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy_add_coupon_modal_label"><?php if(isset($rzvy_translangArr['add_coupon'])){ echo $rzvy_translangArr['add_coupon']; }else{ echo $rzvy_defaultlang['add_coupon']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form name="rzvy_add_coupon_form" id="rzvy_add_coupon_form" method="post">
			  <div class="form-group">
				<label for="rzvy_couponcode"><?php if(isset($rzvy_translangArr['coupon_code'])){ echo $rzvy_translangArr['coupon_code']; }else{ echo $rzvy_defaultlang['coupon_code']; } ?></label>
				<input class="form-control" id="rzvy_couponcode" name="rzvy_couponcode" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_coupon_code'])){ echo $rzvy_translangArr['enter_coupon_code']; }else{ echo $rzvy_defaultlang['enter_coupon_code']; } ?>" />
			  </div>
			  <div class="form-group">
				<label for="rzvy_coupontype"><?php if(isset($rzvy_translangArr['coupon_type'])){ echo $rzvy_translangArr['coupon_type']; }else{ echo $rzvy_defaultlang['coupon_type']; } ?></label>
				<select class="form-control" id="rzvy_coupontype" name="rzvy_coupontype">
				  <option value="percentage"><?php if(isset($rzvy_translangArr['percentage'])){ echo $rzvy_translangArr['percentage']; }else{ echo $rzvy_defaultlang['percentage']; } ?></option>
				  <option value="flat"><?php if(isset($rzvy_translangArr['flat'])){ echo $rzvy_translangArr['flat']; }else{ echo $rzvy_defaultlang['flat']; } ?></option>
				</select>
			  </div>
			  <div class="form-group">
				<label for="rzvy_couponvalue"><?php if(isset($rzvy_translangArr['coupon_value'])){ echo $rzvy_translangArr['coupon_value']; }else{ echo $rzvy_defaultlang['coupon_value']; } ?></label>
				<input class="form-control" id="rzvy_couponvalue" name="rzvy_couponvalue" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_coupon_value'])){ echo $rzvy_translangArr['enter_coupon_value']; }else{ echo $rzvy_defaultlang['enter_coupon_value']; } ?>" />
			  </div>
			  <div class="form-group">
				<label for="rzvy_couponexpiry"><?php if(isset($rzvy_translangArr['expiry_date'])){ echo $rzvy_translangArr['expiry_date']; }else{ echo $rzvy_defaultlang['expiry_date']; } ?></label>
				<input class="form-control" id="rzvy_couponexpiry" name="rzvy_couponexpiry" type="date" value="<?php echo date('Y-m-d', $currDateTime_withTZ); ?>" />
			  </div>
			  <div class="form-group">
				<label for="rzvy_couponstatus"><?php if(isset($rzvy_translangArr['coupon_status'])){ echo $rzvy_translangArr['coupon_status']; }else{ echo $rzvy_defaultlang['coupon_status']; } ?></label>
				<div>
					<label class="text-success"><input type="radio" name="rzvy_couponstatus" class="rzvy_couponstatus" value="Y" checked> <?php if(isset($rzvy_translangArr['activate'])){ echo $rzvy_translangArr['activate']; }else{ echo $rzvy_defaultlang['activate']; } ?></label> &nbsp; &nbsp;<label class="text-danger"><input type="radio" name="rzvy_couponstatus" class="rzvy_couponstatus" value="N"> <?php if(isset($rzvy_translangArr['deactivate'])){ echo $rzvy_translangArr['deactivate']; }else{ echo $rzvy_defaultlang['deactivate']; } ?></label>
				</div>
			  </div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
			<a class="btn btn-primary add_coupon_btn" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['add'])){ echo $rzvy_translangArr['add']; }else{ echo $rzvy_defaultlang['add']; } ?></a>
		  </div>
		</div>
	  </div>
	</div>
	<!-- Update Modal-->
	<div class="modal fade" id="rzvy_update_coupon_modal" tabindex="-1" role="dialog" aria-labelledby="rzvy_update_coupon_modal_label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy_update_coupon_modal_label"><?php if(isset($rzvy_translangArr['update_coupon'])){ echo $rzvy_translangArr['update_coupon']; }else{ echo $rzvy_defaultlang['update_coupon']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body rzvy_update_coupon_modal_body">
			<h2><?php if(isset($rzvy_translangArr['please_wait'])){ echo $rzvy_translangArr['please_wait']; }else{ echo $rzvy_defaultlang['please_wait']; } ?></h2>
		  </div>
		  <div class="modal-footer"> </div>
		</div>
	  </div>
	</div>
<?php include 'footer.php'; ?>