<?php 
include 'header.php';
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['manage_booking_form_field'])){ echo $rzvy_translangArr['manage_booking_form_field']; }else{ echo $rzvy_defaultlang['manage_booking_form_field']; } ?></li>
      </ol>
	  <div class="mb-3">
		<div class="pull-left my-2">
			<h4> <?php if(isset($rzvy_translangArr['manage_booking_form_field'])){ echo $rzvy_translangArr['manage_booking_form_field']; }else{ echo $rzvy_defaultlang['manage_booking_form_field']; } ?> </h4>
		</div>
		<div class="table-responsive">
            <table class="table" class="table" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th><?php if(isset($rzvy_translangArr['existing_new_customer'])){ echo $rzvy_translangArr['existing_new_customer']; }else{ echo $rzvy_defaultlang['existing_new_customer']; } ?></th>
						<th><?php if(isset($rzvy_translangArr['guest_customer'])){ echo $rzvy_translangArr['guest_customer']; }else{ echo $rzvy_defaultlang['guest_customer']; } ?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							<div class="table-responsive">
								<table class="table" class="table" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th><?php if(isset($rzvy_translangArr['field_name'])){ echo $rzvy_translangArr['field_name']; }else{ echo $rzvy_defaultlang['field_name']; } ?></th>
											<th><?php if(isset($rzvy_translangArr['status'])){ echo $rzvy_translangArr['status']; }else{ echo $rzvy_defaultlang['status']; } ?></th>
											<th><?php if(isset($rzvy_translangArr['optional'])){ echo $rzvy_translangArr['optional']; }else{ echo $rzvy_defaultlang['optional']; } ?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php if(isset($rzvy_translangArr['email'])){ echo $rzvy_translangArr['email']; }else{ echo $rzvy_defaultlang['email']; } ?></td>
											<td><label><?php if(isset($rzvy_translangArr['enabled'])){ echo $rzvy_translangArr['enabled']; }else{ echo $rzvy_defaultlang['enabled']; } ?></label></td>
											<td><label><?php if(isset($rzvy_translangArr['required'])){ echo $rzvy_translangArr['required']; }else{ echo $rzvy_defaultlang['required']; } ?></label></td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['password'])){ echo $rzvy_translangArr['password']; }else{ echo $rzvy_defaultlang['password']; } ?></td>
											<td><label><?php if(isset($rzvy_translangArr['enabled'])){ echo $rzvy_translangArr['enabled']; }else{ echo $rzvy_defaultlang['enabled']; } ?></label></td>
											<td><label><?php if(isset($rzvy_translangArr['required'])){ echo $rzvy_translangArr['required']; }else{ echo $rzvy_defaultlang['required']; } ?></label></td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['first_name'])){ echo $rzvy_translangArr['first_name']; }else{ echo $rzvy_defaultlang['first_name']; } ?></td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_status" data-id="firstname" data-label="First Name" <?php if($obj_settings->get_option("rzvy_en_ff_firstname_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_optional" data-id="firstname" data-label="First Name" <?php if($obj_settings->get_option("rzvy_en_ff_firstname_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['last_name'])){ echo $rzvy_translangArr['last_name']; }else{ echo $rzvy_defaultlang['last_name']; } ?></td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_status" data-id="lastname" data-label="Last Name" <?php if($obj_settings->get_option("rzvy_en_ff_lastname_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_optional" data-id="lastname" data-label="Last Name" <?php if($obj_settings->get_option("rzvy_en_ff_lastname_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['phone_number'])){ echo $rzvy_translangArr['phone_number']; }else{ echo $rzvy_defaultlang['phone_number']; } ?></td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_status" data-id="phone" data-label="Phone Number" <?php if($obj_settings->get_option("rzvy_en_ff_phone_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_optional" data-id="phone" data-label="Phone Number" <?php if($obj_settings->get_option("rzvy_en_ff_phone_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?></td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_status" data-id="address" data-label="Address" <?php if($obj_settings->get_option("rzvy_en_ff_address_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_optional" data-id="address" data-label="Address" <?php if($obj_settings->get_option("rzvy_en_ff_address_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?></td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_status" data-id="city" data-label="City" <?php if($obj_settings->get_option("rzvy_en_ff_city_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_optional" data-id="city" data-label="City" <?php if($obj_settings->get_option("rzvy_en_ff_city_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?></td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_status" data-id="state" data-label="State" <?php if($obj_settings->get_option("rzvy_en_ff_state_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_optional" data-id="state" data-label="State" <?php if($obj_settings->get_option("rzvy_en_ff_state_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?></td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_status" data-id="country" data-label="Country" <?php if($obj_settings->get_option("rzvy_en_ff_country_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_en_ff_optional" data-id="country" data-label="Country" <?php if($obj_settings->get_option("rzvy_en_ff_country_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
								  </tbody>
								</table>
							</div>
						</td>
						<td>
							<div class="table-responsive">
								<table class="table" class="table" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th><?php if(isset($rzvy_translangArr['field_name'])){ echo $rzvy_translangArr['field_name']; }else{ echo $rzvy_defaultlang['field_name']; } ?></th>
											<th><?php if(isset($rzvy_translangArr['status'])){ echo $rzvy_translangArr['status']; }else{ echo $rzvy_defaultlang['status']; } ?></th>
											<th><?php if(isset($rzvy_translangArr['optional'])){ echo $rzvy_translangArr['optional']; }else{ echo $rzvy_defaultlang['optional']; } ?></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?php if(isset($rzvy_translangArr['email'])){ echo $rzvy_translangArr['email']; }else{ echo $rzvy_defaultlang['email']; } ?></td>
											<td><label><?php if(isset($rzvy_translangArr['enabled'])){ echo $rzvy_translangArr['enabled']; }else{ echo $rzvy_defaultlang['enabled']; } ?></label></td>
											<td><label><?php if(isset($rzvy_translangArr['required'])){ echo $rzvy_translangArr['required']; }else{ echo $rzvy_defaultlang['required']; } ?></label></td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['first_name'])){ echo $rzvy_translangArr['first_name']; }else{ echo $rzvy_defaultlang['first_name']; } ?></td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_status" data-id="firstname" data-label="First Name" <?php if($obj_settings->get_option("rzvy_g_ff_firstname_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_optional" data-id="firstname" data-label="First Name" <?php if($obj_settings->get_option("rzvy_g_ff_firstname_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['last_name'])){ echo $rzvy_translangArr['last_name']; }else{ echo $rzvy_defaultlang['last_name']; } ?></td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_status" data-id="lastname" data-label="Last Name" <?php if($obj_settings->get_option("rzvy_g_ff_lastname_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_optional" data-id="lastname" data-label="Last Name" <?php if($obj_settings->get_option("rzvy_g_ff_lastname_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['phone_number'])){ echo $rzvy_translangArr['phone_number']; }else{ echo $rzvy_defaultlang['phone_number']; } ?></td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_status" data-id="phone" data-label="Phone Number" <?php if($obj_settings->get_option("rzvy_g_ff_phone_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											<td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_optional" data-id="phone" data-label="Phone Number" <?php if($obj_settings->get_option("rzvy_g_ff_phone_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?></td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_status" data-id="address" data-label="Address" <?php if($obj_settings->get_option("rzvy_g_ff_address_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_optional" data-id="address" data-label="Address" <?php if($obj_settings->get_option("rzvy_g_ff_address_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?></td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_status" data-id="city" data-label="City" <?php if($obj_settings->get_option("rzvy_g_ff_city_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_optional" data-id="city" data-label="City" <?php if($obj_settings->get_option("rzvy_g_ff_city_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?></td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_status" data-id="state" data-label="State" <?php if($obj_settings->get_option("rzvy_g_ff_state_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_optional" data-id="state" data-label="State" <?php if($obj_settings->get_option("rzvy_g_ff_state_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
										<tr>
											<td><?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?></td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_status" data-id="country" data-label="Country" <?php if($obj_settings->get_option("rzvy_g_ff_country_status") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
											 <td>
												<label class="rzvy-toggle-switch">
													<input type="checkbox" class="rzvy-toggle-switch-input rzvy_change_g_ff_optional" data-id="country" data-label="Country" <?php if($obj_settings->get_option("rzvy_g_ff_country_optional") == "Y"){ echo "checked"; } ?> />
													<span class="rzvy-toggle-switch-slider"></span>
												</label>
											</td>
										</tr>
								  </tbody>
								</table>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
      </div>
<?php include 'footer.php'; ?>