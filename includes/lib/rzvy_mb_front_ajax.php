<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_manual_booking.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_slots.php");

/* Create object of classes */
$obj_frontend = new rzvy_manual_booking();
$obj_frontend->conn = $conn;

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$obj_slots = new rzvy_slots();
$obj_slots->conn = $conn;

if(isset($_SESSION['rzvy_mb_staff_id'])){
	$obj_slots->staff_id = $_SESSION['rzvy_mb_staff_id'];
}
$time_interval = $obj_settings->get_option('rzvy_timeslot_interval');
$rzvy_currency_symbol = $obj_settings->get_option('rzvy_currency_symbol');
$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
$advance_bookingtime = $obj_settings->get_option('rzvy_maximum_advance_booking_time');

/* get services by category id ajax */
if(isset($_POST['get_services_by_cat_id'])){
	$obj_frontend->category_id = $_POST['id'];
	$all_services = $obj_frontend->get_services_by_cat_id();
	if(mysqli_num_rows($all_services)>0){
		$_SESSION['rzvy_mb_cart_category_id'] = $_POST['id'];
		$_SESSION['rzvy_mb_cart_items'] = array();
		$_SESSION['rzvy_mb_cart_service_id'] = "";
		while($service = mysqli_fetch_array($all_services)){ 
			?>
			<div class="col-md-4 rzy_same_padding px-0 rzvy-sm-box">
				<div class="rzvy-styled-radio">
					<input type="radio" id="rzvy-services-radio-<?php echo $service['id']; ?>" value="<?php echo $service['id']; ?>" name="rzvy-services-radio" class="rzvy-services-radio-change">
					<label for="rzvy-services-radio-<?php echo $service['id']; ?>" <?php if($service['description'] != ""){ echo ' data-toggle="tooltip" data-placement="top" title="'.$service['description'].'"'; } ?>>
						<div class="rzy_ser_div_left">
							<img class="img-fluid img-thumbnail" src="<?php if($service['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$service['image'])){ echo SITE_URL."uploads/images/".$service['image']; }else{ echo SITE_URL."includes/images/no-image.jpg"; } ?>" />
						</div>
						<div class="rzy_ser_div_right">
							<p class="m-0"><?php echo $obj_settings->get_option('rzvy_currency_symbol').$service['rate']; ?><br /><?php echo ucwords($service['title']); ?></p>
						</div>
					</label>
				</div>
			</div>
			<?php 
		}
	}else{
		?>
		<div class="row">
			<div class="col-xs-12 col-md-12 rzvy-sm-box">
				<label><?php if(isset($rzvy_translangArr['there_is_no_services_for_this_category'])){ echo $rzvy_translangArr['there_is_no_services_for_this_category']; }else{ echo $rzvy_defaultlang['there_is_no_services_for_this_category']; } ?></label>
			</div>
		</div>
		<?php
	}
}

/* get addons by service id ajax */
else if(isset($_POST['get_multi_and_single_qty_addons_content'])){
	$obj_frontend->service_id = $_POST['id'];
	$readone_service = $obj_frontend->readone_service(); 
	$all_addons = $obj_frontend->get_multiple_qty_addons_by_service_id(); 
	$_SESSION['rzvy_mb_cart_service_id'] = $_POST['id'];
	
	$_SESSION['rzvy_mb_cart_service_price'] = $readone_service['rate'];
	$subtotal = $readone_service['rate'];	
	$_SESSION['rzvy_mb_cart_subtotal'] = $subtotal;
	$_SESSION['rzvy_mb_cart_nettotal'] = $subtotal;
	
	$_SESSION['rzvy_mb_cart_items'] = array(); 
	?>
	<div id="rzvy_multipleqty_addon_html_content" class="rzvy_show_hide_addons">
		<div class="d-flex flex-wrap">
			<?php 
			while($addon = mysqli_fetch_array($all_addons)){ 
				?>
				<div class="col-md-4 rzy_same_padding px-0 rzvy-addons-multipleqty-box-<?php echo $addon['id']; ?>" <?php if($addon['description'] != ""){ echo ' data-toggle="tooltip" data-placement="top" title="'.$addon['description'].'"'; } ?>>
					<div class="rzvy-addons-multipleqty-box-icon rzvy_make_multipleqty_addon_selected row" data-id="<?php echo $addon['id']; ?>">
						<div class="rzy_ser_div_left">
							<img class="img-fluid img-thumbnail" src="<?php if($addon['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$addon['image'])){ echo SITE_URL."uploads/images/".$addon['image']; }else{ echo SITE_URL."includes/images/no-image.jpg"; } ?>" />
						</div>
						<div class="rzy_ser_div_right">
							<p class="m-0"><?php echo $obj_settings->get_option('rzvy_currency_symbol').$addon['rate']; ?><br /><?php echo ucwords($addon['title']); ?></p>
						</div>
					</div>
					<div class="rzvy-addons-multipleqty-box-content">
						<div class="rzvy-addons-multipleqty-counter rzvy-addons-multipleqty-js-counter">
							<div class="rzvy-addons-multipleqty-counter-item">
								<a class="rzvy-addons-multipleqty-counter-minus rzvy-addons-multipleqty-js-counter-btn fa fa-minus" id="rzvy-addons-multipleqty-minus-js-counter-btn-<?php echo $addon['id']; ?>" aria-hidden="true" data-action="minus" data-id="<?php echo $addon['id']; ?>"></a>
							</div>
							<div class="rzvy-addons-multipleqty-counter-item rzvy-addons-multipleqty-counter-item-center">
								<input class="rzvy-addons-multipleqty-counter__value rzvy-addons-multipleqty-js-counter-value rzvy-addons-multipleqty-unit-<?php echo $addon['id']; ?>" type="text" data-id="<?php echo $addon['id']; ?>" value="0" disabled="disabled" tabindex="-1" min="0" max="10" required />
							</div>
							<div class="rzvy-addons-multipleqty-counter-item">
								<a class="rzvy-addons-multipleqty-counter-plus rzvy-addons-multipleqty-js-counter-btn fa fa-plus" id="rzvy-addons-multipleqty-plus-js-counter-btn-<?php echo $addon['id']; ?>" aria-hidden="true" data-action="plus" data-id="<?php echo $addon['id']; ?>"></a>
							</div>
						</div>
					</div>
				</div>
				<?php 
			} 
			?>
		</div>
	</div>
	<div class="rzvy-radio-group-block rzvy_show_hide_addons">
		<div class="row">
			<div class="col-md-12">
				<ul id="rzvy_singleqty_addon_html_content" class="rzvy-addons-singleqty-items d-flex flex-wrap">
					<?php 
					/** get single qty addons **/
					$obj_frontend->service_id = $_POST['id'];
					$all_addons = $obj_frontend->get_single_qty_addons_by_service_id();
					while($addon = mysqli_fetch_array($all_addons)){ 
						?>
						<li class="col-md-4 rzy_same_padding">
							<input type="checkbox" id="rzvy-addons-singleqty-unit-<?php echo $addon['id']; ?>" value="<?php echo $addon['id']; ?>" class="rzvy-addons-singleqty-unit-selection" />
							<label for="rzvy-addons-singleqty-unit-<?php echo $addon['id']; ?>" <?php if($addon['description'] != ""){ echo ' data-toggle="tooltip" data-placement="top" title="'.$addon['description'].'"'; } ?> class="h-100">
								<div class="rzy_ser_div_left">
									<img class="img-fluid img-thumbnail" src="<?php if($addon['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$addon['image'])){ echo SITE_URL."uploads/images/".$addon['image']; }else{ echo SITE_URL."includes/images/no-image.jpg"; } ?>" />
								</div>
								<div class="rzy_ser_div_right">
									<p class="m-0"><?php echo $obj_settings->get_option('rzvy_currency_symbol').$addon['rate']; ?><br /><?php echo ucwords($addon['title']); ?></p>
								</div>
							</label>
						</li>
						<?php 
					} 
					?>
				</ul>
			</div>
		</div>
	</div>
	<?php 
}

/* get all frequently discount */
else if(isset($_POST['get_all_frequently_discount'])){
	$all_frequently_discount = $obj_frontend->get_all_frequently_discount(); 
	if(mysqli_num_rows($all_frequently_discount)>0){ 
		?>
		<div class="row">
			<?php 
			while($fd_discount = mysqli_fetch_array($all_frequently_discount)){ 
				?>
				<div class="col-md-3 rzvy-sm-box">
					<div class="rzvy-styled-radio rzvy-styled-radio-second">
						<input type="radio" id="rzvy-frequently-discount-<?php echo $fd_discount['id']; ?>" name="rzvy-frequently-discount" class="rzvy-frequently-discount-change" value="<?php echo $fd_discount['id']; ?>" />
						<label for="rzvy-frequently-discount-<?php echo $fd_discount['id']; ?>" <?php if($fd_discount['fd_description'] != ""){ echo ' data-toggle="tooltip" data-placement="bottom" title="'.$fd_discount['fd_description'].'"'; } ?>><?php echo $fd_discount['fd_label']; ?></label>
					</div>
				</div>
				<?php 
			} 
		?>
		</div>
		<?php 
	}else{
		$_SESSION['rzvy_mb_cart_freqdiscount_id'] = "";
		$_SESSION['rzvy_mb_cart_freqdiscount'] = 0;
		$_SESSION['rzvy_mb_cart_freqdiscount_label'] = "";
		$_SESSION['rzvy_mb_cart_freqdiscount_key'] = "";
	}
}

/* on change update frequently discount */
else if(isset($_POST['update_frequently_discount'])){
	$obj_frontend->frequently_discount_id = $_POST['id'];
	$fd_discount = $obj_frontend->readone_frequently_discount(); 
	
	if(is_array($fd_discount)){
		if($_SESSION['rzvy_mb_cart_subtotal']>0){
			$new_subtotal = $_SESSION['rzvy_mb_cart_subtotal'];
			
			if($fd_discount['fd_type'] == "percentage"){
				$percentage_value = ($new_subtotal*$fd_discount["fd_value"]/100);
				$new_nettotal = ($new_subtotal-$percentage_value);
				if($new_nettotal>0){
					$_SESSION['rzvy_mb_cart_nettotal'] = $new_nettotal;
				}else{
					$_SESSION['rzvy_mb_cart_nettotal'] = 0;
				}
				$_SESSION['rzvy_mb_cart_freqdiscount_id'] = $_POST['id'];
				$_SESSION['rzvy_mb_cart_freqdiscount'] = $percentage_value;
			}else{
				$new_nettotal = ($new_subtotal-$fd_discount["fd_value"]);
				if($new_nettotal>0){
					$_SESSION['rzvy_mb_cart_nettotal'] = $new_nettotal;
				}else{
					$_SESSION['rzvy_mb_cart_nettotal'] = 0;
				}
				$_SESSION['rzvy_mb_cart_freqdiscount_id'] = $_POST["id"];
				$_SESSION['rzvy_mb_cart_freqdiscount'] = $fd_discount["fd_value"];
			}
			$_SESSION['rzvy_mb_cart_couponid'] = "";
			$_SESSION['rzvy_mb_cart_coupondiscount'] = 0;
			$_SESSION['rzvy_mb_cart_freqdiscount_label'] = $fd_discount["fd_label"];
			$_SESSION['rzvy_mb_cart_freqdiscount_key'] = $fd_discount["fd_key"];
		}else{
			$_SESSION['rzvy_mb_cart_couponid'] = "";
			$_SESSION['rzvy_mb_cart_coupondiscount'] = 0;
			$_SESSION['rzvy_mb_cart_freqdiscount_id'] = "";
			$_SESSION['rzvy_mb_cart_freqdiscount'] = 0;
			$_SESSION['rzvy_mb_cart_freqdiscount_label'] = "";
			$_SESSION['rzvy_mb_cart_freqdiscount_key'] = "";
		}
	}
}

/* Check and apply coupon ajax */
else if(isset($_POST['apply_coupon'])){
	$obj_frontend->coupon_id = $_POST['id'];
	$coupon_detail = $obj_frontend->apply_coupon(); 
	if(is_array($coupon_detail)){
		if($_SESSION['rzvy_mb_cart_subtotal']>0){
			if($_SESSION['rzvy_mb_cart_freqdiscount']>0){
				$new_subtotal = ($_SESSION['rzvy_mb_cart_subtotal']-$_SESSION['rzvy_mb_cart_freqdiscount']);
			}else{
				$new_subtotal = $_SESSION['rzvy_mb_cart_subtotal'];
			}
			
			if($coupon_detail['coupon_type'] == "percentage"){
				$percentage_value = ($new_subtotal*$coupon_detail["coupon_value"]/100);
				$new_nettotal = ($new_subtotal-$percentage_value);
				if($new_nettotal>0){
					$_SESSION['rzvy_mb_cart_nettotal'] = $new_nettotal;
				}else{
					$_SESSION['rzvy_mb_cart_nettotal'] = 0;
				}
				$_SESSION['rzvy_mb_cart_couponid'] = $_POST['id'];
				$_SESSION['rzvy_mb_cart_coupondiscount'] = $percentage_value;
			}else{
				$new_nettotal = ($new_subtotal-$coupon_detail["coupon_value"]);
				if($new_nettotal>0){
					$_SESSION['rzvy_mb_cart_nettotal'] = $new_nettotal;
				}else{
					$_SESSION['rzvy_mb_cart_nettotal'] = 0;
				}
				$_SESSION['rzvy_mb_cart_couponid'] = $_POST["id"];
				$_SESSION['rzvy_mb_cart_coupondiscount'] = $coupon_detail["coupon_value"];
			}
			echo "available";
		}else{
			$_SESSION['rzvy_mb_cart_couponid'] = "";
			$_SESSION['rzvy_mb_cart_coupondiscount'] = 0;
		}
	}
}

/* remove applied coupon ajax */
else if(isset($_POST['remove_applied_coupon'])){
	$obj_frontend->coupon_id = $_POST['id'];
	$coupon_detail = $obj_frontend->apply_coupon(); 
	if($_SESSION['rzvy_mb_cart_subtotal']>0){
		if($_SESSION['rzvy_mb_cart_freqdiscount']>0){
			$new_subtotal = ($_SESSION['rzvy_mb_cart_subtotal']-$_SESSION['rzvy_mb_cart_freqdiscount']);
		}else{
			$new_subtotal = $_SESSION['rzvy_mb_cart_subtotal'];
		}
		
		if($coupon_detail['coupon_type'] == "percentage"){
			$percentage_value = ($new_subtotal*$coupon_detail["coupon_value"]/100);
			$new_nettotal = ($new_subtotal+$percentage_value);
			if($new_nettotal>0){
				$_SESSION['rzvy_mb_cart_nettotal'] = $new_nettotal;
			}else{
				$_SESSION['rzvy_mb_cart_nettotal'] = 0;
			}
		}else{
			$new_nettotal = ($new_subtotal+$coupon_detail["coupon_value"]);
			if($new_nettotal>0){
				$_SESSION['rzvy_mb_cart_nettotal'] = $new_nettotal;
			}else{
				$_SESSION['rzvy_mb_cart_nettotal'] = 0;
			}
		}
		$_SESSION['rzvy_mb_cart_couponid'] = "";
		$_SESSION['rzvy_mb_cart_coupondiscount'] = 0;
	}
}

/* add feedback ajax */
else if(isset($_POST['add_feedback'])){
	$obj_frontend->feedback_name = htmlentities($_POST['name']);
	$obj_frontend->feedback_email = trim(strip_tags(mysqli_real_escape_string($conn, $_POST['email'])));
	$obj_frontend->feedback_rating = $_POST['rating'];
	$obj_frontend->feedback_review = htmlentities($_POST['review']);
	$obj_frontend->feedback_review_datetime = date("Y-m-d H:i:s");
	$added = $obj_frontend->add_feedback(); 
	if($added){
		echo "added";
	}
}

/* Get available slots ajax */
else if(isset($_POST['get_slots'])){ 
	$rzvy_settings_timezone = $obj_settings->get_option("rzvy_timezone");
	$rzvy_server_timezone = date_default_timezone_get();
	$currDateTime_withTZ = $obj_settings->get_current_time_according_selected_timezone($rzvy_server_timezone,$rzvy_settings_timezone); 

	$selected_date = date("Y-m-d", strtotime($_POST['selected_date']));
	$selected_date = date($selected_date, $currDateTime_withTZ);

	$isEndTime = false;
	$available_slots = $obj_slots->generate_available_slots_dropdown($time_interval, $rzvy_time_format, $selected_date, $advance_bookingtime, $currDateTime_withTZ, $isEndTime, $_SESSION['rzvy_mb_cart_service_id']);
	
	$rzvy_hide_already_booked_slots_from_frontend_calendar = $obj_settings->get_option('rzvy_hide_already_booked_slots_from_frontend_calendar');
	$rzvy_minimum_advance_booking_time = $obj_settings->get_option('rzvy_minimum_advance_booking_time');
	$rzvy_maximum_advance_booking_time = $obj_settings->get_option('rzvy_maximum_advance_booking_time');

	/** check for maximum advance booking time **/
	$current_datetime = strtotime(date("Y-m-d H:i:s", $currDateTime_withTZ));
	$maximum_date = date("Y-m-d", strtotime('+'.$rzvy_maximum_advance_booking_time.' months', $current_datetime));
	$maximum_date = date($maximum_date, $currDateTime_withTZ);

	/** check for minimum advance booking time **/
	$minimum_date = date("Y-m-d H:i:s", strtotime("+".$rzvy_minimum_advance_booking_time." minutes", $current_datetime));  
	?>
	<div class="pt-1 pb-1 pl-4 pr-4">
		<div class="row">
			<div class="col-md-12 rzvy-sm-box mb-1 text-center">
				<a href="javascript:void(0);" class="rzvy_back_to_calendar"><label><b><i class="fa fa-caret-up fa-3x"></i></b></label></a>
				<a href="javascript:void(0);" class="rzvy_reset_slot_selection pull-right" data-day="<?php echo $selected_date; ?>"><label><b><i class="fa fa-refresh"></i> <?php if(isset($rzvy_translangArr['reset'])){ echo $rzvy_translangArr['reset']; }else{ echo $rzvy_defaultlang['reset']; } ?></b></label></a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 rzvy-sm-box mb-3 text-center">
				<label><b><i class="fa fa-calendar"></i> <?php echo date($rzvy_date_format, strtotime($selected_date)); ?></b></label>
			</div>
		</div>
		<div class="row">
			<?php 
			/** maximum date check **/		
			if(strtotime($selected_date)>strtotime($maximum_date)){ 
				?>
				<div class="col-md-12 rzvy-sm-box rzvy_slot_new">
					<label><b>[ <?php if(isset($rzvy_translangArr['you_cannot_book_appointment_on'])){ echo $rzvy_translangArr['you_cannot_book_appointment_on']; }else{ echo $rzvy_defaultlang['you_cannot_book_appointment_on']; } ?> <?php echo date($rzvy_date_format, strtotime($selected_date)); ?>. <?php if(isset($rzvy_translangArr['our_maximum_advance_booking_period_is'])){ echo $rzvy_translangArr['our_maximum_advance_booking_period_is']; }else{ echo $rzvy_defaultlang['our_maximum_advance_booking_period_is']; } ?> <?php 
						if($rzvy_maximum_advance_booking_time == "1"){ echo "1 Month"; }
						else if($rzvy_maximum_advance_booking_time == "3"){ echo "3 Month"; }
						else if($rzvy_maximum_advance_booking_time == "6"){ echo "6 Month"; }
						else if($rzvy_maximum_advance_booking_time == "9"){ echo "9 Month"; }
						else if($rzvy_maximum_advance_booking_time == "12"){ echo "1 Year"; }
						else if($rzvy_maximum_advance_booking_time == "18"){ echo "1.5 Year"; }
						else if($rzvy_maximum_advance_booking_time == "24"){ echo "2 Year"; } 
					?>. <?php if(isset($rzvy_translangArr['so_you_can_book_appointment_till'])){ echo $rzvy_translangArr['so_you_can_book_appointment_till']; }else{ echo $rzvy_defaultlang['so_you_can_book_appointment_till']; } ?> <?php echo $maximum_date; ?>. ]</b></label>
				</div>
				<?php 
			}
			/** time slots **/
			else if(isset($available_slots['slots']) && sizeof($available_slots['slots'])>0){
				$i = 1;
				$j = 0;
				foreach($available_slots['slots'] as $slot){
					if(strtotime($selected_date." ".$slot)<strtotime($minimum_date)){
						continue;
					}else{
						$booked_slot_exist = false;
						foreach($available_slots['booked'] as $bslot){
							if($bslot["start_time"] <= strtotime($selected_date." ".$slot) && $bslot["end_time"] > strtotime($selected_date." ".$slot)){
								$booked_slot_exist = true;
								continue;
							} 
						}
						if($booked_slot_exist && $rzvy_hide_already_booked_slots_from_frontend_calendar == "Y"){
							continue;
						}else if($booked_slot_exist && $rzvy_hide_already_booked_slots_from_frontend_calendar == "N"){ 
							$blockoff_exist = false;
							if(sizeof($available_slots['block_off'])>0){
								foreach($available_slots['block_off'] as $block_off){
									if((strtotime($selected_date." ".$block_off["start_time"]) <= strtotime($selected_date." ".$slot)) && (strtotime($selected_date." ".$block_off["end_time"]) > strtotime($selected_date." ".$slot))){
										$blockoff_exist = true;
										continue;
									} 
								}
							} 
							if($blockoff_exist){
								continue;
							} 
							?>
							<div class="col-md-3 rzvy-sm-box rzvy_slot_new">
								<div class="rzvy-styled-radio rzvy-styled-radio-second rzvy-styled-radio-disable">
									<input type="radio" id="rzvy-booked-time-slot-<?php echo $i; ?>" name="rzvy-booked-time-slots" disabled>
									<label for="rzvy-booked-time-slot-<?php echo $i; ?>" disabled><?php echo date($rzvy_time_format,strtotime($selected_date." ".$slot)); ?></label>
								</div>
							</div>
							<?php 
							$j++;
						}else{ 
							$blockoff_exist = false;
							if(sizeof($available_slots['block_off'])>0){
								foreach($available_slots['block_off'] as $block_off){
									if((strtotime($selected_date." ".$block_off["start_time"]) <= strtotime($selected_date." ".$slot)) && (strtotime($selected_date." ".$block_off["end_time"]) > strtotime($selected_date." ".$slot))){
										$blockoff_exist = true;
										continue;
									} 
								}
							} 
							if($blockoff_exist){
								continue;
							} 
							?>
							<div class="col-md-3 rzvy-sm-box rzvy_slot_new">
								<div class="rzvy-styled-radio rzvy-styled-radio-second">
									<input type="radio" class="rzvy_time_slots_selection" id="rzvy-time-slot-<?php echo $i; ?>" name="rzvy-time-slots" value="<?php echo $slot; ?>">
									<label for="rzvy-time-slot-<?php echo $i; ?>"><?php echo date($rzvy_time_format,strtotime($selected_date." ".$slot)); ?></label>
								</div>
							</div>
							<?php 
							$j++;
						}
						$i++;
					}
				}
				if($j == 0){ 
					?>
					<div class="col-md-12 rzvy-sm-box rzvy_slot_new">
						<label><b>[ <?php if(isset($rzvy_translangArr['none_of_slots_available_on'])){ echo $rzvy_translangArr['none_of_slots_available_on']; }else{ echo $rzvy_defaultlang['none_of_slots_available_on']; } ?> <?php echo date($rzvy_date_format, strtotime($selected_date)); ?>. ]</b></label>
					</div>
					<?php 
				}
			}else{ 
				?>
				<div class="col-md-12 rzvy-sm-box rzvy_slot_new">
					<label><b>[ <?php if(isset($rzvy_translangArr['none_of_slots_available_on'])){ echo $rzvy_translangArr['none_of_slots_available_on']; }else{ echo $rzvy_defaultlang['none_of_slots_available_on']; } ?> <?php echo date($rzvy_date_format, strtotime($selected_date)); ?>. ]</b></label>
				</div>
				<?php 
			} 
			?>
		</div>
	</div>
	<?php 
}

/* Endtime available slots ajax */
else if(isset($_POST['get_endtime_slots'])){ 
	$rzvy_settings_timezone = $obj_settings->get_option("rzvy_timezone");
	$rzvy_server_timezone = date_default_timezone_get();
	$currDateTime_withTZ = $obj_settings->get_current_time_according_selected_timezone($rzvy_server_timezone,$rzvy_settings_timezone); 

	$selected_date = date("Y-m-d", strtotime($_POST['selected_date']));
	$selected_date = date($selected_date, $currDateTime_withTZ);

	$isEndTime = true;
	$available_slots = $obj_slots->generate_available_slots_dropdown($time_interval, $rzvy_time_format, $selected_date, $advance_bookingtime, $currDateTime_withTZ, $isEndTime, $_SESSION['rzvy_mb_cart_service_id']);
	
	$rzvy_hide_already_booked_slots_from_frontend_calendar = $obj_settings->get_option('rzvy_hide_already_booked_slots_from_frontend_calendar');
	$rzvy_minimum_advance_booking_time = $obj_settings->get_option('rzvy_minimum_advance_booking_time');
	$rzvy_maximum_advance_booking_time = $obj_settings->get_option('rzvy_maximum_advance_booking_time');

	/** check for maximum advance booking time **/
	$current_datetime = strtotime(date("Y-m-d H:i:s", $currDateTime_withTZ));
	$maximum_date = date("Y-m-d", strtotime('+'.$rzvy_maximum_advance_booking_time.' months', $current_datetime));
	$maximum_date = date($maximum_date, $currDateTime_withTZ);

	/** check for minimum advance booking time **/
	$minimum_date = date("Y-m-d H:i:s", strtotime("+".$rzvy_minimum_advance_booking_time." minutes", $current_datetime));  
	
	/** check for maximum end time slot limit **/
	$rzvy_maximum_endtimeslot_limit = $obj_settings->get_option('rzvy_maximum_endtimeslot_limit');
	$selected_slot_check = strtotime($selected_date." ".$_POST["selected_slot"]);
	$maximum_endslot_limit = date("Y-m-d H:i:s", strtotime("+".$rzvy_maximum_endtimeslot_limit." minutes", $selected_slot_check)); 	
	?>
	<div class="pt-1 pb-1 pl-4 pr-4">
		<div class="row">
			<div class="col-md-12 rzvy-sm-box mb-1 text-center">
				<a href="javascript:void(0);" class="rzvy_back_to_calendar"><label><b><i class="fa fa-caret-up fa-3x"></i></b></label></a>
				<a href="javascript:void(0);" class="rzvy_reset_slot_selection pull-right" data-day="<?php echo $selected_date; ?>"><label><b><i class="fa fa-refresh"></i> <?php if(isset($rzvy_translangArr['reset'])){ echo $rzvy_translangArr['reset']; }else{ echo $rzvy_defaultlang['reset']; } ?></b></label></a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 rzvy-sm-box mb-3 text-center">
				<label><b><i class="fa fa-calendar"></i> <?php echo date($rzvy_date_format, strtotime($selected_date)); ?></b></label>
				<br/>
				<label><b><?php if(isset($rzvy_translangArr['from'])){ echo $rzvy_translangArr['from']; }else{ echo $rzvy_defaultlang['from']; } ?>: <i class="fa fa-clock-o"></i> <?php echo date($rzvy_time_format, strtotime($selected_date." ".$_POST["selected_slot"])); ?></b></label>
			</div>
		</div>
		<div class="row">
			<?php 
			/** maximum date check **/		
			if(strtotime($selected_date)>strtotime($maximum_date)){ 
				?>
				<div class="col-md-12 rzvy-sm-box rzvy_slot_new">
					<label><b>[ <?php if(isset($rzvy_translangArr['you_cannot_book_appointment_on'])){ echo $rzvy_translangArr['you_cannot_book_appointment_on']; }else{ echo $rzvy_defaultlang['you_cannot_book_appointment_on']; } ?> <?php echo date($rzvy_date_format, strtotime($selected_date)); ?>. <?php if(isset($rzvy_translangArr['our_maximum_advance_booking_period_is'])){ echo $rzvy_translangArr['our_maximum_advance_booking_period_is']; }else{ echo $rzvy_defaultlang['our_maximum_advance_booking_period_is']; } ?> <?php 
						if($rzvy_maximum_advance_booking_time == "1"){ echo "1 Month"; }
						else if($rzvy_maximum_advance_booking_time == "3"){ echo "3 Month"; }
						else if($rzvy_maximum_advance_booking_time == "6"){ echo "6 Month"; }
						else if($rzvy_maximum_advance_booking_time == "9"){ echo "9 Month"; }
						else if($rzvy_maximum_advance_booking_time == "12"){ echo "1 Year"; }
						else if($rzvy_maximum_advance_booking_time == "18"){ echo "1.5 Year"; }
						else if($rzvy_maximum_advance_booking_time == "24"){ echo "2 Year"; } 
					?>. <?php if(isset($rzvy_translangArr['so_you_can_book_appointment_till'])){ echo $rzvy_translangArr['so_you_can_book_appointment_till']; }else{ echo $rzvy_defaultlang['so_you_can_book_appointment_till']; } ?> <?php echo $maximum_date; ?>. ]</b></label>
				</div>
				<?php 
			}
			/** time slots **/
			else if(isset($available_slots['slots']) && sizeof($available_slots['slots'])>0){
				$i = 1;
				$j = 0;
				foreach($available_slots['slots'] as $slot){
					if(strtotime($selected_date." ".$slot)<strtotime($minimum_date)){
						continue;
					}else{
						if(strtotime($selected_date." ".$slot) <= strtotime($selected_date." ".$_POST["selected_slot"])){
							continue;
						}elseif(strtotime($selected_date." ".$slot) > strtotime($maximum_endslot_limit)){
							continue;
						}else{
							$booked_slot_exist = false;
							foreach($available_slots['booked'] as $bslot){
								if($bslot["start_time"] <= strtotime($selected_date." ".$slot) && $bslot["end_time"] > strtotime($selected_date." ".$slot)){
									$booked_slot_exist = true;
									continue;
								} 
							}
							if($booked_slot_exist){
								break;
							}else{ 
								$blockoff_exist = false;
								if(sizeof($available_slots['block_off'])>0){
									foreach($available_slots['block_off'] as $block_off){
										if((strtotime($selected_date." ".$block_off["start_time"]) <= strtotime($selected_date." ".$slot)) && (strtotime($selected_date." ".$block_off["end_time"]) > strtotime($selected_date." ".$slot))){
											$blockoff_exist = true;
											continue;
										} 
									}
								} 
								if($blockoff_exist){
									break;
								} 
								?>
								<div class="col-md-3 rzvy-sm-box rzvy_slot_new">
									<div class="rzvy-styled-radio rzvy-styled-radio-second">
										<input type="radio" class="rzvy_endtime_slots_selection" id="rzvy-time-slot-<?php echo $i; ?>" name="rzvy-time-slots" value="<?php echo $slot; ?>">
										<label for="rzvy-time-slot-<?php echo $i; ?>"><?php echo date($rzvy_time_format,strtotime($selected_date." ".$slot)); ?></label>
									</div>
								</div>
								<?php 
								$j++;
							}
						}
						$i++;
					}
				}
				if($j == 0){ 
					if(is_numeric($_SESSION['rzvy_mb_cart_service_id']) && $_SESSION['rzvy_mb_cart_service_id'] != "0"){
						$time_interval=$obj_slots->get_service_time_interval($_SESSION['rzvy_mb_cart_service_id'],$time_interval);
					}
					$sdate_stime = strtotime($selected_date." ".$_POST["selected_slot"]);
					$sdate_etime = date("Y-m-d H:i:s", strtotime("+".$time_interval." minutes", $sdate_stime));
					$sdate_estime = date("H:i:s", strtotime($sdate_etime));
					?>
					<div class="col-md-3 rzvy-sm-box rzvy_slot_new">
						<div class="rzvy-styled-radio rzvy-styled-radio-second">
							<input type="radio" class="rzvy_endtime_slots_selection" id="rzvy-time-slot-<?php echo $i; ?>" name="rzvy-time-slots" value="<?php echo $sdate_estime; ?>">
							<label for="rzvy-time-slot-<?php echo $i; ?>"><?php echo date($rzvy_time_format,strtotime($sdate_etime)); ?></label>
						</div>
					</div>
					<?php 
				}
			}else{ 
				?>
				<div class="col-md-12 rzvy-sm-box rzvy_slot_new">
					<label><b>[ <?php if(isset($rzvy_translangArr['none_of_slots_available_on'])){ echo $rzvy_translangArr['none_of_slots_available_on']; }else{ echo $rzvy_defaultlang['none_of_slots_available_on']; } ?> <?php echo date($rzvy_date_format, strtotime($selected_date)); ?>. ]</b></label>
				</div>
				<?php 
			} 
			?>
		</div>
	</div>
	<?php 
}

/* Add selected slot to session ajax */
else if(isset($_POST['add_selected_slot'])){ 
	$selected_startdatetime = date("Y-m-d H:i:s", strtotime($_POST['selected_date']." ".$_POST['selected_startslot']));
	$selected_enddatetime = date("Y-m-d H:i:s", strtotime($_POST['selected_date']." ".$_POST['selected_endslot']));
	$_SESSION['rzvy_mb_cart_datetime'] = $selected_startdatetime;
	$_SESSION['rzvy_mb_cart_end_datetime'] = $selected_enddatetime;
	
	$rzvy_cart_date = date($rzvy_date_format, strtotime($_SESSION['rzvy_mb_cart_datetime'])); 
	$rzvy_cart_starttime = date($rzvy_time_format, strtotime($_SESSION['rzvy_mb_cart_datetime'])); 
	$rzvy_cart_endtime = date($rzvy_time_format, strtotime($_SESSION['rzvy_mb_cart_end_datetime'])); 
	echo '<span class="text-center"><b><i class="fa fa-calendar text-success"></i> '.$rzvy_cart_date." ".$rzvy_cart_starttime." to ".$rzvy_cart_endtime.'</b></span>';
}

/* Add selected slot to session ajax */
else if(isset($_POST['add_selected_slot_withendslot'])){ 
	if(is_numeric($_SESSION['rzvy_mb_cart_service_id']) && $_SESSION['rzvy_mb_cart_service_id'] != "0"){
		$time_interval=$obj_slots->get_service_time_interval($_SESSION['rzvy_mb_cart_service_id'],$time_interval);
	}
	$selected_startdatetime = date("Y-m-d H:i:s", strtotime($_POST['selected_date']." ".$_POST['selected_startslot']));
	$selected_enddatetime = date("Y-m-d H:i:s", strtotime("+".$time_interval." minutes", strtotime($selected_startdatetime)));
	$_SESSION['rzvy_mb_cart_datetime'] = $selected_startdatetime;
	$_SESSION['rzvy_mb_cart_end_datetime'] = $selected_enddatetime;
	
	$rzvy_cart_date = date($rzvy_date_format, strtotime($_SESSION['rzvy_mb_cart_datetime'])); 
	$rzvy_cart_starttime = date($rzvy_time_format, strtotime($_SESSION['rzvy_mb_cart_datetime'])); 
	$rzvy_cart_endtime = date($rzvy_time_format, strtotime($_SESSION['rzvy_mb_cart_end_datetime'])); 
	echo '<span class="text-center"><b><i class="fa fa-calendar text-success"></i> '.$rzvy_cart_date." ".$rzvy_cart_starttime.'</b></span>';
}

/* get customer detail ajax */
else if(isset($_POST['get_customer_detail'])){ 
	$obj_frontend->customer_id = $_POST['id'];
	
	/* Function to check login details */
	$login_detail = $obj_frontend->readone_customer();
	
	$array = array();
	$array['status'] = "failed";
	if(is_array($login_detail)){
		$array['id'] = $login_detail['id'];
		$array['email'] = $login_detail['email'];
		$array['password'] = $login_detail['password'];
		$array['firstname'] = ucwords($login_detail['firstname']);
		$array['lastname'] = ucwords($login_detail['lastname']);
		$array['phone'] = $login_detail['phone'];
		$array['address'] = $login_detail['address'];
		$array['city'] = $login_detail['city'];
		$array['state'] = $login_detail['state'];
		$array['zip'] = $login_detail['zip'];
		$array['country'] = $login_detail['country'];
		$array['status'] = "success";
	}
	echo json_encode($array);
}

/** Get staff according to service selection */
else if(isset($_POST["get_staff_according_service"])){ 
	$service_id = $_POST['id'];
	$getall_service_staffid = $obj_frontend->getall_service_staff($service_id);
	if(mysqli_num_rows($getall_service_staffid)>0){ 
		?>
		<div class="rzvy-radio-group-block">
			<div class="rzvy-radio-group-block-content rzvy-no-border-bottom pb-0 mb-0 mt-0 pt-0">
				<h5 class="py-2"><?php if(isset($rzvy_translangArr['choose_staff_member'])){ echo $rzvy_translangArr['choose_staff_member']; }else{ echo $rzvy_defaultlang['choose_staff_member']; } ?></h5>
				<div class="d-flex flex-wrap">
					<?php 
					while($staffid = mysqli_fetch_array($getall_service_staffid)){ 
						$staffdata = $obj_frontend->get_staff($staffid["staff_id"]);
						?>
						<div class="col-md-4 rzy_same_padding px-0 rzvy-sm-box">
							<div class="rzvy-styled-radio rzvy-styled-radio-second rzvy-staff-radiobox">
								<input type="radio" id="rzvy-staff-<?php echo $staffdata["id"]; ?>" name="rzvy-staff" class="rzvy-staff-change" value="<?php echo $staffdata["id"]; ?>" <?php if(isset($_SESSION['rzvy_staff_calendar'])){ if($_SESSION['rzvy_staff_calendar'] == $staffdata["id"]){ echo "checked"; } } ?> />
								<label for="rzvy-staff-<?php echo $staffdata["id"]; ?>">
									<div class="rzy_ser_div_left">
										<img class="img-fluid img-thumbnail" src="<?php if($staffdata['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$staffdata['image'])){ echo SITE_URL."uploads/images/".$staffdata['image']; }else{ echo SITE_URL."includes/images/staff-lg.png"; } ?>" />
									</div>
									<div class="rzy_ser_div_right">
										<p class="m-0"><?php if(strlen($staffdata["firstname"]." ".$staffdata["lastname"])<=17){ echo "<br />"; } echo ucwords($staffdata["firstname"]." ".$staffdata["lastname"]); ?></p>
									</div>
								</label>
							</div>
						</div>
						<?php 
					} 
					?>
				</div>
			</div>
		</div>
		<?php 
	}
}

/** Set staff id in session on selection */
else if(isset($_POST["set_staff_according_service"])){ 
	$_SESSION['rzvy_mb_staff_id'] = $_POST["id"];
}