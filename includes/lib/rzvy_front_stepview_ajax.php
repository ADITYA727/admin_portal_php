<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_frontend.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_slots.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_calendar.php");

/* Create object of classes */
$obj_frontend = new rzvy_frontend();
$obj_frontend->conn = $conn;

$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

$obj_slots = new rzvy_slots();
$obj_slots->conn = $conn;

$obj_calendar = new rzvy_calendar();
$obj_calendar->conn = $conn;

$obj_slots = new rzvy_slots();
$obj_slots->conn = $conn;

if(isset($_SESSION['rzvy_staff_id'])){
	$obj_slots->staff_id = $_SESSION['rzvy_staff_id'];
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
	?>
	<div class="col-md-12">
		<h4><?php if(isset($rzvy_translangArr['tell_us_about_your_service'])){ echo $rzvy_translangArr['tell_us_about_your_service']; }else{ echo $rzvy_defaultlang['tell_us_about_your_service']; } ?></h4>
		<?php	
		if(mysqli_num_rows($all_services)>0){ 
			$_SESSION['rzvy_cart_category_id'] = $_POST['id'];
			$_SESSION['rzvy_cart_items'] = array();
			$_SESSION['rzvy_cart_service_id'] = "";
			?>
			<div class="py-1 rzvy-custom-radio-main">
				<?php 
				while($service = mysqli_fetch_array($all_services)){ 
					?>	
						<input type="radio" id="rzvy-services-radio-<?php echo $service['id']; ?>" name="rzvy-services-radio" value="<?php echo $service['id']; ?>" class="rzvy-services-radio-change" />
						<label class="col-md-3" for="rzvy-services-radio-<?php echo $service['id']; ?>"><?php echo ucwords($service['title'])." - ".$obj_settings->get_option('rzvy_currency_symbol').$service['rate']; ?></label>
					<?php 
				} 
				?>
			</div>
			<?php 
		}else{ 
			?>
			<label><?php if(isset($rzvy_translangArr['there_is_no_services_for_this_category'])){ echo $rzvy_translangArr['there_is_no_services_for_this_category']; }else{ echo $rzvy_defaultlang['there_is_no_services_for_this_category']; } ?></label>
			<?php 
		} 
		?>
	</div>
	<?php 
}

/* get addons by service id ajax */
else if(isset($_POST['get_multi_and_single_qty_addons_content'])){
	$obj_frontend->service_id = $_POST['id'];
	$service = $obj_frontend->readone_service(); 
	$all_mq_addons = $obj_frontend->get_multiple_qty_addons_by_service_id(); 
	$all_sq_addons = $obj_frontend->get_single_qty_addons_by_service_id(); 
	$_SESSION['rzvy_cart_service_id'] = $_POST['id'];
	$_SESSION['rzvy_cart_service_price'] = $service['rate'];
	$_SESSION['rzvy_cart_subtotal'] = $service['rate'];
	$_SESSION['rzvy_cart_nettotal'] = $service['rate'];
	$_SESSION['rzvy_cart_freqdiscount'] = 0;
	$_SESSION['rzvy_cart_coupondiscount'] = 0;
	$_SESSION['rzvy_cart_couponid'] = "";
	$_SESSION['rzvy_referral_discount_amount'] = 0;
	$_SESSION['rzvy_cart_tax'] = 0;
	$_SESSION['rzvy_cart_items'] = array(); 
	?>
	<div class="row m-3 p-3 border">
		<div class="col-md-2 text-center">
			<img class="img-fluid" src="<?php if($service['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$service['image'])){ echo SITE_URL."uploads/images/".$service['image']; }else{ echo SITE_URL."includes/images/no-image.jpg"; } ?>" />
		</div>
		<div class="col-md-9">
			<h3 class="row"><?php echo ucwords($service['title'])." - ".$obj_settings->get_option('rzvy_currency_symbol').$service['rate']; ?></h3>
			<div class="row px-2 rzvy_txt_color"><?php if($service['description'] != ""){ echo $service['description']; } ?></div>
		</div>
		<?php 
		if(mysqli_num_rows($all_mq_addons)>0 || mysqli_num_rows($all_sq_addons)>0){ 
			?>
			<div class="col-md-12 pt-2">
				<hr />
				<h4><?php if(isset($rzvy_translangArr['select_additional_services'])){ echo $rzvy_translangArr['select_additional_services']; }else{ echo $rzvy_defaultlang['select_additional_services']; } ?></h4>
				<ul class="rzvy_addons">
					<?php 
					/** Multiple Qty Addons **/
					while($addon = mysqli_fetch_array($all_mq_addons)){ 
						?>
						<li class="rzvy_addons_li">
							<input class="rzvy_addons_mqty rzvy_addons_input" type="checkbox" id="rzvy-addons-multipleqty-box-<?php echo $addon['id']; ?>" value="<?php echo $addon['id']; ?>" />
							<label class="rzvy_addons_label text-center" for="rzvy-addons-multipleqty-box-<?php echo $addon['id']; ?>">
								<img class="rzvy_addons_img" src="<?php if($addon['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$addon['image'])){ echo SITE_URL."uploads/images/".$addon['image']; }else{ echo SITE_URL."includes/images/no-image.jpg"; } ?>" />
								<p class="mt-2"><?php echo ucwords($addon['title'])." - ".$obj_settings->get_option('rzvy_currency_symbol').$addon['rate']; ?></p>
								<div class="input-group rzvy_plusminus_addons_input_maindiv">
									<div class="input-group-prepend">
										<button class="btn btn-danger btn-sm rzvy_plusminus_addons_btns rzvy_plusminus_addons_minus_btn_<?php echo $addon['id']; ?> rzvy_flag_minus" data-id="<?php echo $addon['id']; ?>" disabled=""><span class="fa fa-minus"></span></button>
									</div>
									<input type="text" readonly value="0" class="form-control rzvy_plusminus_addons_input text-center" id="rzvy_plusminus_addons_input_<?php echo $addon['id']; ?>" />
									<div class="input-group-append">
										<button class="btn btn-danger btn-sm rzvy_plusminus_addons_btns rzvy_plusminus_addons_plus_btn_<?php echo $addon['id']; ?> rzvy_flag_plus" data-id="<?php echo $addon['id']; ?>"><span class="fa fa-plus"></span></button>
									</div>
								</div>
							</label>
						</li>
						<?php 
					} 
					/** Single Qty Addons **/
					while($addon = mysqli_fetch_array($all_sq_addons)){ 
						?>
						<li class="rzvy_addons_li">
							<input class="rzvy_addons_input" type="checkbox" id="rzvy-addons-singleqty-box-<?php echo $addon['id']; ?>" value="<?php echo $addon['id']; ?>" />
							<label class="rzvy_addons_label text-center" for="rzvy-addons-singleqty-box-<?php echo $addon['id']; ?>">
								<img class="rzvy_addons_img" src="<?php if($addon['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$addon['image'])){ echo SITE_URL."uploads/images/".$addon['image']; }else{ echo SITE_URL."includes/images/no-image.jpg"; } ?>" />
								<p class="mt-2"><?php echo ucwords($addon['title'])." - ".$obj_settings->get_option('rzvy_currency_symbol').$addon['rate']; ?></p>
								<input class="w-75" type="number" value="1" style="opacity:0" />
							</label>
						</li>
						<?php 
					} 
					?>
				</ul>
			</div>
			<?php 
		} 
		?>
	</div>
	<?php 
}

/** Get Second box with frequently discount, staff & calendar **/
else if(isset($_POST['get_second_step_box'])){ 
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="rzvy-steps-btn">
				<div class="pull-right">
					<a href="javascript:void(0)" id="rzvy-get-third-next-box-btn" class="btn btn-common next-step next-button rzvy_nextstep_btn rounded-0" style="width:158.4px"><?php if(isset($rzvy_translangArr['next'])){ echo $rzvy_translangArr['next']; }else{ echo $rzvy_defaultlang['next']; } ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
	<?php 
	$all_frequently_discount = $obj_frontend->get_all_frequently_discount(); 
	if(mysqli_num_rows($all_frequently_discount)>0){ 
		?>
		<div class="row rzvy-freqdisc-container">
			<div class="col-md-12">
				<label for="rzvy-custom-radio-main"><?php if(isset($rzvy_translangArr['how_often_would_you_like_service'])){ echo $rzvy_translangArr['how_often_would_you_like_service']; }else{ echo $rzvy_defaultlang['how_often_would_you_like_service']; } ?></label>
				<div id="rzvy-custom-radio-main" class="py-1 rzvy-custom-radio-main">
					<?php 
					while($fd_discount = mysqli_fetch_array($all_frequently_discount)){ 
						?>
						<input type="radio" id="rzvy-frequently-discount-<?php echo $fd_discount['id']; ?>" name="rzvy-frequently-discount" class="rzvy-frequently-discount-change" value="<?php echo $fd_discount['id']; ?>" <?php if($_SESSION['rzvy_cart_freqdiscount_id'] == $fd_discount['id']){ echo "checked"; } ?> />
						<label class="col-md-2" for="rzvy-frequently-discount-<?php echo $fd_discount['id']; ?>" <?php if($fd_discount['fd_description'] != ""){ echo ' data-toggle="tooltip" data-placement="bottom" title="'.$fd_discount['fd_description'].'"'; } ?>><?php echo $fd_discount['fd_label']; ?></label>
						<?php 
					} 
					?>
				</div>
			</div>
		</div>
		<hr />
		<?php 
	}else{
		$_SESSION['rzvy_cart_freqdiscount_id'] = "";
		$_SESSION['rzvy_cart_freqdiscount'] = 0;
		$_SESSION['rzvy_cart_freqdiscount_label'] = "";
		$_SESSION['rzvy_cart_freqdiscount_key'] = "";
	} 
	?>
	<div class="row rzvy-staff-container">
		<div class="col-md-12">
			<label for="rzvy-custom-radio-main"><?php if(isset($rzvy_translangArr['choose_staff_member'])){ echo $rzvy_translangArr['choose_staff_member']; }else{ echo $rzvy_defaultlang['choose_staff_member']; } ?></label>
			<div id="rzvy-custom-radio-main" class="rzvy-custom-radio-main">
				<?php 
				$service_id = $_SESSION['rzvy_cart_service_id'];
				$getall_service_staffid = $obj_frontend->getall_service_staff($service_id);
				if(mysqli_num_rows($getall_service_staffid)>0){ 
					while($staffid = mysqli_fetch_array($getall_service_staffid)){ 
						$staffdata = $obj_frontend->get_staff($staffid["staff_id"]);
						?>
						<input type="radio" id="rzvy-staff-<?php echo $staffdata["id"]; ?>" name="rzvy-staff" class="rzvy-staff-change" value="<?php echo $staffdata["id"]; ?>" <?php if(isset($_SESSION['rzvy_staff_id'])){ if($_SESSION['rzvy_staff_id'] == $staffdata["id"]){ echo "checked"; } } ?> />
						<label for="rzvy-staff-<?php echo $staffdata["id"]; ?>">
							<div class="rzy_ser_div_left">
								<img class="img-fluid img-thumbnail" src="<?php if($staffdata['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$staffdata['image'])){ echo SITE_URL."uploads/images/".$staffdata['image']; }else{ echo SITE_URL."includes/images/staff-lg.png"; } ?>" />
							</div>
							<div class="rzy_ser_div_right">
								<p><?php if(strlen($staffdata["firstname"]." ".$staffdata["lastname"])<=17){ echo "<br />"; } echo ucwords($staffdata["firstname"]." ".$staffdata["lastname"]); ?></p>
							</div>
						</label>
						<?php 
					}
				} 
				?>
			</div>
		</div>
	</div>
	<hr class="rzvy-staff-container-hr" />
	<div class="row rzvy-calendar-slots-container">
		
	</div>
	<div class="row py-2">
		<div class="col-md-12">
			<div class="rzvy-steps-btn">
				<div class="pull-right">
					<a href="javascript:void(0)" id="rzvy-get-third-next-box-btn" class="btn btn-common next-step next-button rzvy_nextstep_btn rounded-0" style="width:158.4px"><?php if(isset($rzvy_translangArr['next'])){ echo $rzvy_translangArr['next']; }else{ echo $rzvy_defaultlang['next']; } ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
	<?php 
}

/* on change update frequently discount */
else if(isset($_POST['update_frequently_discount'])){
	$obj_frontend->frequently_discount_id = $_POST["id"];
	$fd_discount = $obj_frontend->readone_frequently_discount(); 
	if(is_array($fd_discount)){
		$_SESSION['rzvy_cart_freqdiscount_id'] = $_POST["id"];
		$_SESSION['rzvy_cart_freqdiscount_label'] = $fd_discount["fd_label"];
		$_SESSION['rzvy_cart_freqdiscount_key'] = $fd_discount["fd_key"];
	}
}

/** Set staff id in session on selection */
else if(isset($_POST["set_staff_according_service"])){ 
	$_SESSION['rzvy_staff_id'] = $_POST["id"];
	?>
	<div class="col-md-6">
		<label for="rzvy-custom-radio-main"><?php if(isset($rzvy_translangArr['choose_your_appointment_slot'])){ echo $rzvy_translangArr['choose_your_appointment_slot']; }else{ echo $rzvy_defaultlang['choose_your_appointment_slot']; } ?></label>
		<div class="rzvy-inline-calendar">
			<div class="rzvy-inline-calendar-container rzvy-inline-calendar-container-boxshadow">
				<?php 
				include "stepview_calendar.php"; 
				?>
			</div>
		</div>
	</div>
	<div class="col-md-6 pt-3 rzvy-calendar-slots">
		<div class="row py-3 px-3"> 
			<label class="col-md-12 pt-2" for="rzvy_start_slot"><?php if(isset($rzvy_translangArr['choose_your_slot'])){ echo $rzvy_translangArr['choose_your_slot']; }else{ echo $rzvy_defaultlang['choose_your_slot']; } ?></label>
			<select id="rzvy_start_slot" class="col-md-12 form-control selectpicker" title="<?php if(isset($rzvy_translangArr['choose_your_slot'])){ echo $rzvy_translangArr['choose_your_slot']; }else{ echo $rzvy_defaultlang['choose_your_slot']; } ?>"></select>
		</div>
		<div class="row py-3 px-3 rzvy_end_slot_div" style="display:none;">
			<label class="col-md-12 pt-2" for="rzvy_end_slot"><?php if(isset($rzvy_translangArr['choose_your_end_slot'])){ echo $rzvy_translangArr['choose_your_end_slot']; }else{ echo $rzvy_defaultlang['choose_your_end_slot']; } ?></label>
			<select id="rzvy_end_slot" class="col-md-12 form-control selectpicker" title="<?php if(isset($rzvy_translangArr['choose_your_end_slot'])){ echo $rzvy_translangArr['choose_your_end_slot']; }else{ echo $rzvy_defaultlang['choose_your_end_slot']; } ?>"></select>
		</div>
	</div>
	<?php 
}

/* Get available slots ajax */
else if(isset($_POST['get_slots'])){ 
	$rzvy_settings_timezone = $obj_settings->get_option("rzvy_timezone");
	$rzvy_server_timezone = date_default_timezone_get();
	$currDateTime_withTZ = $obj_settings->get_current_time_according_selected_timezone($rzvy_server_timezone,$rzvy_settings_timezone); 

	$selected_date = date("Y-m-d", strtotime($_POST['selected_date']));
	$selected_date = date($selected_date, $currDateTime_withTZ);
	
	$isEndTime = false;
	$available_slots = $obj_slots->generate_available_slots_dropdown($time_interval, $rzvy_time_format, $selected_date, $advance_bookingtime, $currDateTime_withTZ, $isEndTime, $_SESSION['rzvy_cart_service_id']);
	
	$no_booking = $available_slots['no_booking'];
	if($available_slots['no_booking']<0){
		$no_booking = 0;
	}
	$rzvy_hide_already_booked_slots_from_frontend_calendar = $obj_settings->get_option('rzvy_hide_already_booked_slots_from_frontend_calendar');
	$rzvy_minimum_advance_booking_time = $obj_settings->get_option('rzvy_minimum_advance_booking_time');
	$rzvy_maximum_advance_booking_time = $obj_settings->get_option('rzvy_maximum_advance_booking_time');

	/** check for maximum advance booking time **/
	$current_datetime = strtotime(date("Y-m-d H:i:s", $currDateTime_withTZ));
	$maximum_date = date("Y-m-d", strtotime('+'.$rzvy_maximum_advance_booking_time.' months', $current_datetime));
	$maximum_date = date($maximum_date, $currDateTime_withTZ);

	/** check for minimum advance booking time **/
	$minimum_date = date("Y-m-d H:i:s", strtotime("+".$rzvy_minimum_advance_booking_time." minutes", $current_datetime));  

	/** maximum date check **/		
	if(strtotime($selected_date)>strtotime($maximum_date)){ }
	/** time slots **/
	else if(isset($available_slots['slots']) && sizeof($available_slots['slots'])>0){
		$i = 1;
		$j = 0;
		foreach($available_slots['slots'] as $slot){
			$no_curr_boookings = $obj_slots->get_slot_bookings($selected_date." ".$slot,$_SESSION['rzvy_cart_service_id']);
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
				}else if($booked_slot_exist && $rzvy_hide_already_booked_slots_from_frontend_calendar == "N" && $no_booking==0){ 
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
					$j++;
				}else if($booked_slot_exist && $rzvy_hide_already_booked_slots_from_frontend_calendar == "N" && $no_booking!=0 && $no_curr_boookings>=$no_booking){ 
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
					<option class="rzvy_time_slots_selection" value="<?php echo $slot; ?>"><?php echo date($rzvy_time_format, strtotime($selected_date." ".$slot)); ?></option>
					<?php 
					$j++;
				}
				$i++;
			}
		}
		if($j == 0){ }
	}else{ } 
}

/* Endtime available slots ajax */
else if(isset($_POST['get_endtime_slots'])){ 
	$rzvy_settings_timezone = $obj_settings->get_option("rzvy_timezone");
	$rzvy_server_timezone = date_default_timezone_get();
	$currDateTime_withTZ = $obj_settings->get_current_time_according_selected_timezone($rzvy_server_timezone,$rzvy_settings_timezone); 

	$selected_date = date("Y-m-d", strtotime($_POST['selected_date']));
	$selected_date = date($selected_date, $currDateTime_withTZ);

	$isEndTime = true;
	$available_slots = $obj_slots->generate_available_slots_dropdown($time_interval, $rzvy_time_format, $selected_date, $advance_bookingtime, $currDateTime_withTZ, $isEndTime, $_SESSION['rzvy_cart_service_id']);
	
	$no_booking = $available_slots['no_booking'];
	if($available_slots['no_booking']<0){
		$no_booking = 0;
	}
	
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
	
	/** maximum date check **/		
	if(strtotime($selected_date)>strtotime($maximum_date)){ }
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
						$no_curr_boookings = $obj_slots->get_slot_bookings($selected_date." ".$slot,$_SESSION['rzvy_cart_service_id']);
						if($no_booking!=0 && $no_curr_boookings>=$no_booking){
							continue;
						}
						if($blockoff_exist){
							break;
						} 
						?>
						<option class="rzvy_endtime_slots_selection" value="<?php echo $slot; ?>"><?php echo date($rzvy_time_format,strtotime($selected_date." ".$slot)); ?></option>
						<?php 
						$j++;
					}
				}
				$i++;
			}
		}
		if($j == 0){ 
			if(is_numeric($_SESSION['rzvy_cart_service_id']) && $_SESSION['rzvy_cart_service_id'] != "0"){
				$time_interval=$obj_slots->get_service_time_interval($_SESSION['rzvy_cart_service_id'],$time_interval);
			}
			$sdate_stime = strtotime($selected_date." ".$_POST["selected_slot"]);
			$sdate_etime = date("Y-m-d H:i:s", strtotime("+".$time_interval." minutes", $sdate_stime));
			$sdate_estime = date("H:i:s", strtotime($sdate_etime));
			$no_curr_boookings = $obj_slots->get_slot_bookings($sdate_etime,$_SESSION['rzvy_cart_service_id']);
			if($no_booking!=0 && $no_curr_boookings>=$no_booking){ }else{
				?>
				<option class="rzvy_endtime_slots_selection" value="<?php echo $sdate_estime; ?>"><?php echo date($rzvy_time_format,strtotime($sdate_etime)); ?></option>
				<?php 
			}
		}
	}else{ } 
}

/* Add selected slot to session ajax */
else if(isset($_POST['add_selected_slot'])){ 
	$selected_startdatetime = date("Y-m-d H:i:s", strtotime($_POST['selected_date']." ".$_POST['selected_startslot']));
	$selected_enddatetime = date("Y-m-d H:i:s", strtotime($_POST['selected_date']." ".$_POST['selected_endslot']));
	$_SESSION['rzvy_cart_datetime'] = $selected_startdatetime;
	$_SESSION['rzvy_cart_end_datetime'] = $selected_enddatetime;
	
	$rzvy_cart_date = date($rzvy_date_format, strtotime($_SESSION['rzvy_cart_datetime'])); 
	$rzvy_cart_starttime = date($rzvy_time_format, strtotime($_SESSION['rzvy_cart_datetime'])); 
	$rzvy_cart_endtime = date($rzvy_time_format, strtotime($_SESSION['rzvy_cart_end_datetime'])); 
}

/* Add selected slot to session ajax */
else if(isset($_POST['add_selected_slot_withendslot'])){ 
	if(is_numeric($_SESSION['rzvy_cart_service_id']) && $_SESSION['rzvy_cart_service_id'] != "0"){
		$time_interval=$obj_slots->get_service_time_interval($_SESSION['rzvy_cart_service_id'],$time_interval);
	}
	$selected_startdatetime = date("Y-m-d H:i:s", strtotime($_POST['selected_date']." ".$_POST['selected_startslot']));
	$selected_enddatetime = date("Y-m-d H:i:s", strtotime("+".$time_interval." minutes", strtotime($selected_startdatetime)));
	$_SESSION['rzvy_cart_datetime'] = $selected_startdatetime;
	$_SESSION['rzvy_cart_end_datetime'] = $selected_enddatetime;
	
	$rzvy_cart_date = date($rzvy_date_format, strtotime($_SESSION['rzvy_cart_datetime'])); 
	$rzvy_cart_starttime = date($rzvy_time_format, strtotime($_SESSION['rzvy_cart_datetime'])); 
	$rzvy_cart_endtime = date($rzvy_time_format, strtotime($_SESSION['rzvy_cart_end_datetime'])); 
}

/** Get Third box having booking summary **/
else if(isset($_POST['get_third_step_box'])){ 
	$obj_frontend->category_id = $_SESSION['rzvy_cart_category_id'];
	$obj_frontend->service_id = $_SESSION['rzvy_cart_service_id'];
	$category_name = $obj_frontend->readone_category_name();
	$servicedata = $obj_frontend->readone_service(); 
	$service_name = $servicedata['title']; 
	$service_rate = $servicedata['rate'];  
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="rzvy-steps-btn">
				<div class="pull-right">
					<a href="javascript:void(0)" id="rzvy-get-fourth-next-box-btn" class="btn btn-common next-step next-button rzvy_nextstep_btn rounded-0" style="width:158.4px"><?php if(isset($rzvy_translangArr['next'])){ echo $rzvy_translangArr['next']; }else{ echo $rzvy_defaultlang['next']; } ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-8" id="rzvy_refresh_cart">
			<!-- Cart will display here -->
		</div>
		<div class="col-md-4 p-3 border">
			<div class="w-100">
				<h5><?php if(isset($rzvy_translangArr['have_a_promocode'])){ echo $rzvy_translangArr['have_a_promocode']; }else{ echo $rzvy_defaultlang['have_a_promocode']; } ?></h5>
				<p style="text-align: end;"><a href="javascript:void(0)" id="rzvy-available-coupons-open-modal"><i class="fa fa-ticket" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['check_available_promo'])){ echo $rzvy_translangArr['check_available_promo']; }else{ echo $rzvy_defaultlang['check_available_promo']; } ?></a><p>
				<div>
					<span class="fa-border rzvy_applied_coupon_div rzvy_applied_coupon_badge p-2"><i class="fa fa-ticket"></i> </span>
					<a href="javascript:void(0)" class="rzvy_remove_applied_coupon" data-id=""><i class="fa fa-times-circle-o fa-lg"></i></a>
				</div>
			</div>
			<?php 
			if(isset($_SESSION['customer_id']) && $obj_settings->get_option("rzvy_referral_discount_status") == "Y"){ 
				?>
				<hr />
				<div>
					<div class="rzvy_applied_referral_coupon_div_text" style="display:none;">
						<p><span><?php if(isset($rzvy_translangArr['applied_referral_discount_coupon'])){ echo $rzvy_translangArr['applied_referral_discount_coupon']; }else{ echo $rzvy_defaultlang['applied_referral_discount_coupon']; } ?>: <b class="rzvy_applied_referral_coupon_code"></b></span></p>
					</div>
					<div class="rzvy_apply_referral_coupon_div">
						<h5><?php if(isset($rzvy_translangArr['do_you_have_referral_discount_coupon'])){ echo $rzvy_translangArr['do_you_have_referral_discount_coupon']; }else{ echo $rzvy_defaultlang['do_you_have_referral_discount_coupon']; } ?></h5>
						<p>
							<a href="javascript:void(0)" id="rzvy_apply_referral_coupon"><span><?php if(isset($rzvy_translangArr['apply_referral_discount_coupon'])){ echo $rzvy_translangArr['apply_referral_discount_coupon']; }else{ echo $rzvy_defaultlang['apply_referral_discount_coupon']; } ?></span></a>
						</p>
					</div>
				</div>
				<?php 
			} 
			?>
		</div>
	</div>
	<div class="row py-2">
		<div class="col-md-12">
			<div class="rzvy-steps-btn">
				<div class="pull-right">
					<a href="javascript:void(0)" id="rzvy-get-fourth-next-box-btn" class="btn btn-common next-step next-button rzvy_nextstep_btn rounded-0" style="width:158.4px"><?php if(isset($rzvy_translangArr['next'])){ echo $rzvy_translangArr['next']; }else{ echo $rzvy_defaultlang['next']; } ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>
			</div>
		</div>
	</div>
	<?php 
}

/* add to cart item ajax */
if(isset($_POST['add_to_cart_item'])){
	$id = $_POST['id'];
	$qty = $_POST['qty'];
	
	if($_POST['qty']>0){
		/** Add and update item into cart **/
		$obj_frontend->addon_id = $id;
		$addon_rate = $obj_frontend->get_addon_rate();
		$rate = ($addon_rate*$qty);
		$item_arr = array();
		$item_arr['id'] = $id;
		$item_arr['qty'] = $qty;
		$item_arr['rate'] = $rate;
		
		$cart_item_key = $obj_frontend->rzvy_check_existing_cart_item($_SESSION['rzvy_cart_items'], $id);
		if(is_numeric($cart_item_key)){
			$_SESSION['rzvy_cart_items'][$cart_item_key] = $item_arr;
			$_SESSION['rzvy_cart_items'] = array_values($_SESSION['rzvy_cart_items']);
		}else{
			array_push($_SESSION['rzvy_cart_items'], $item_arr);
			$_SESSION['rzvy_cart_items'] = array_values($_SESSION['rzvy_cart_items']);
		}
		
		$subtotal = $_SESSION['rzvy_cart_service_price'];
		foreach($_SESSION['rzvy_cart_items'] as $val){ 
			$subtotal = $subtotal+$val['rate'];
		}
		$_SESSION['rzvy_cart_subtotal'] = $subtotal;
		$_SESSION['rzvy_cart_nettotal'] = $subtotal;
	}else{
		/** remove item from cart **/	
		$subtotal = $_SESSION['rzvy_cart_service_price'];
		foreach($_SESSION['rzvy_cart_items'] as $val){ 
			$subtotal = $subtotal+$val['rate'];
		} 
		$cart_item_key = $obj_frontend->rzvy_check_existing_cart_item($_SESSION['rzvy_cart_items'], $id);
		if(is_numeric($cart_item_key)){
			$subtotal = $subtotal-$_SESSION['rzvy_cart_items'][$cart_item_key]['rate'];
			unset($_SESSION['rzvy_cart_items'][$cart_item_key]);
			$_SESSION['rzvy_cart_items'] = array_values($_SESSION['rzvy_cart_items']);			
			$_SESSION['rzvy_cart_subtotal'] = $subtotal;
			$_SESSION['rzvy_cart_nettotal'] = $subtotal;
		}
	}
}

/* Check and apply coupon ajax */
else if(isset($_POST['apply_coupon'])){
	/** calculate coupon discount **/
	$_SESSION['rzvy_cart_couponid'] = $_POST["id"];
	echo "available";
}

/* remove applied coupon ajax */
else if(isset($_POST['remove_applied_coupon'])){
	$_SESSION['rzvy_cart_couponid'] = "";
	$_SESSION['rzvy_cart_coupondiscount'] = 0;
}

/* refresh cart ajax */
if(isset($_POST['refresh_cart_sidebar'])){
	$obj_frontend->category_id = $_SESSION['rzvy_cart_category_id'];
	$obj_frontend->service_id = $_SESSION['rzvy_cart_service_id'];
	$category_name = $obj_frontend->readone_category_name();
	$servicedata = $obj_frontend->readone_service(); 
	$service_name = $servicedata['title']; 
	$service_rate = $servicedata['rate'];  
	
	$rzvy_tax_status = $obj_settings->get_option('rzvy_tax_status');
	$rzvy_tax_type = $obj_settings->get_option('rzvy_tax_type');
	$rzvy_tax_value = $obj_settings->get_option('rzvy_tax_value'); 
	
	/** Calculate frequently-discount **/
	$net_total = $_SESSION['rzvy_cart_subtotal'];
	if(is_numeric($_SESSION['rzvy_cart_freqdiscount_id'])){
		$obj_frontend->frequently_discount_id = $_SESSION['rzvy_cart_freqdiscount_id'];
		$fd_discount = $obj_frontend->readone_frequently_discount(); 
		if(is_array($fd_discount)){
			if($_SESSION['rzvy_cart_subtotal']>0){
				if($fd_discount['fd_type'] == "percentage"){
					$cart_fd = ($_SESSION['rzvy_cart_subtotal']*$fd_discount["fd_value"]/100);
				}else{
					$cart_fd = $fd_discount["fd_value"];
				}
				$cart_fd = number_format($cart_fd,2,".",',');
				$net_total = ($_SESSION['rzvy_cart_subtotal']-$cart_fd);
				$_SESSION['rzvy_cart_freqdiscount'] = $cart_fd;
			}else{
				$_SESSION['rzvy_cart_freqdiscount'] = 0;
			}	
		} 
	}
	
	/** Calculate coupon-discount **/
	if(is_numeric($_SESSION['rzvy_cart_couponid'])){
		$obj_frontend->coupon_id = $_SESSION['rzvy_cart_couponid'];
		$coupon_detail = $obj_frontend->apply_coupon(); 
		if($net_total>0){
			if($coupon_detail['coupon_type'] == "percentage"){
				$cart_coupon = ($net_total*$coupon_detail["coupon_value"]/100);
			}else{
				$cart_coupon = $coupon_detail["coupon_value"];
			}
			$cart_coupon = number_format($cart_coupon,2,".",',');
			$net_total = ($net_total-$cart_coupon);
			$_SESSION['rzvy_cart_coupondiscount'] = $cart_coupon;
		}else{
			$_SESSION['rzvy_cart_coupondiscount'] = 0;
			$_SESSION['rzvy_cart_couponid'] = "";
		}
	}
	
	/** calculate referral-discount **/
	if($_SESSION['rzvy_applied_ref_customer_id'] != "" && is_numeric($_SESSION['rzvy_applied_ref_customer_id'])){
		if($net_total>0){
			$rzvy_referral_discount_type = $obj_settings->get_option('rzvy_referral_discount_type');
			$rzvy_referral_discount_value = $obj_settings->get_option('rzvy_referral_discount_value');
			if($rzvy_referral_discount_type == "percentage"){
				$cart_referral_coupon = ($net_total*$rzvy_referral_discount_value/100);
			}else{
				$cart_referral_coupon = $rzvy_referral_discount_value;
			}
			$cart_referral_coupon = number_format($cart_referral_coupon,2,".",',');
			$net_total = ($net_total-$cart_referral_coupon);
			$_SESSION['rzvy_referral_discount_amount'] = $cart_referral_coupon;
		}else{
			$_SESSION['rzvy_referral_discount_amount'] = 0;
			$_SESSION['rzvy_applied_ref_customer_id'] = "";
		}
	}else{
		$_SESSION['rzvy_referral_discount_amount'] = 0;
		$_SESSION['rzvy_applied_ref_customer_id'] = "";
	}
				
	/** calculate Tax/Vat/GST **/
	if($rzvy_tax_status == "Y"){
		if($net_total>0){
			if($rzvy_tax_type == "percentage"){
				$cart_tax = ($net_total*$rzvy_tax_value/100);
			}else{
				$cart_tax = $rzvy_tax_value;
			}
			$cart_tax = number_format($cart_tax,2,".",',');
			$_SESSION['rzvy_cart_tax'] = $cart_tax;
			$net_total = ($net_total+$cart_tax);
		}else{
			$_SESSION['rzvy_cart_tax'] = 0;
		}
	}else{
		$_SESSION['rzvy_cart_tax'] = 0;
	}
	$_SESSION['rzvy_cart_nettotal'] = $net_total; 
	?>
	<div class="table-responsive">
		<table class="table">
			<thead>
				<tr>
					<th class="text-center" colspan="4"><i class="fa fa-cog"></i> <?php echo $category_name; ?><?php if($_SESSION['rzvy_cart_freqdiscount_label'] != ""){ echo " - ".$_SESSION['rzvy_cart_freqdiscount_label'];	} ?></th>
				</tr>
				<tr>
					<th colspan="4"><i class="fa fa-calendar"></i> <?php echo date($rzvy_date_format." ".$rzvy_time_format, strtotime($_SESSION['rzvy_cart_datetime'])); if($_SESSION['rzvy_cart_end_datetime'] != ""){ echo " - ".date($rzvy_time_format, strtotime($_SESSION['rzvy_cart_end_datetime'])); } ?></th>
				</tr>
				<tr>
					<th colspan="2"><?php if(isset($rzvy_translangArr['service'])){ echo $rzvy_translangArr['service']; }else{ echo $rzvy_defaultlang['service']; } ?></th>
					<th></th>
					<th class="text-right"><?php if(isset($rzvy_translangArr['subtotal'])){ echo $rzvy_translangArr['subtotal']; }else{ echo $rzvy_defaultlang['subtotal']; } ?></th>
				</tr>
				<tr>
					<td colspan="2" style="vertical-align: inherit;"><img class="rzvy_addons_img" width="50" height="50" src="<?php if($servicedata['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$servicedata['image'])){ echo SITE_URL."uploads/images/".$servicedata['image']; }else{ echo SITE_URL."includes/images/no-image.jpg"; } ?>" /> <?php echo $service_name; ?></td>
					<td></td>
					<td style="vertical-align: inherit;" class="text-right"><?php echo $rzvy_currency_symbol.number_format($service_rate,2,".",','); ?></td>
				</tr>
				<?php 
					if(sizeof($_SESSION['rzvy_cart_items'])>0){ 
						?>
						<tr id="rzvy_remove_addon_head">
							<th colspan="2"><?php if(isset($rzvy_translangArr['additional_services'])){ echo $rzvy_translangArr['additional_services']; }else{ echo $rzvy_defaultlang['additional_services']; } ?></th>
							<th class="text-center"><?php if(isset($rzvy_translangArr['qty_ad'])){ echo $rzvy_translangArr['qty_ad']; }else{ echo $rzvy_defaultlang['qty_ad']; } ?></th>
							<th class="text-right"><?php if(isset($rzvy_translangArr['subtotal'])){ echo $rzvy_translangArr['subtotal']; }else{ echo $rzvy_defaultlang['subtotal']; } ?></th>
						</tr>
						<?php 
					} 
				?>
			</thead>
			<tbody>
				<?php 
				if(sizeof($_SESSION['rzvy_cart_items'])>0){ 
					foreach($_SESSION['rzvy_cart_items'] as $val){ 
						$obj_frontend->addon_id = $val['id'];
						$addon = $obj_frontend->readone_addon(); 
						?>
						<tr class="rzvy_count_addon_tr" id="rzvy_addon_tr_<?php echo $val['id']; ?>">
							<td class="px-0 text-center" style="vertical-align: inherit;"><a class="rzvy_remove_addon_from_cart" href="javascript:void(0)" data-id="<?php echo $val['id']; ?>"><i class="fa fa-trash rzvy_remove_addon_icon text-danger fa-2x" aria-hidden="true"></i></a></td>
							<td style="vertical-align: inherit;" class="w-50"><img class="rzvy_addons_img" width="50" height="50" src="<?php if($addon['image'] != "" && file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/images/".$addon['image'])){ echo SITE_URL."uploads/images/".$addon['image']; }else{ echo SITE_URL."includes/images/no-image.jpg"; } ?>" /> <?php echo ucwords($addon["title"]); ?></td>
							<td style="vertical-align: inherit;" class="text-center">
								<?php 
								if($addon["multiple_qty"] == "Y"){ 
									?>
									<div class="input-group rzvy_plusminus_addons_input_maindiv">
										<div class="input-group-prepend">
											<button class="btn btn-danger btn-sm rzvy_plusminus_addons_btns_cart rzvy_plusminus_addons_minus_btn_<?php echo $addon['id']; ?> rzvy_flag_minus" data-id="<?php echo $addon['id']; ?>"><span class="fa fa-minus"></span></button>
										</div>
										<input type="text" readonly value="<?php echo $val['qty']; ?>" class="form-control rzvy_plusminus_addons_input text-center w-50" id="rzvy_plusminus_addons_input_<?php echo $addon['id']; ?>" />
										<div class="input-group-append">
											<button class="btn btn-danger btn-sm rzvy_plusminus_addons_btns_cart rzvy_plusminus_addons_plus_btn_<?php echo $addon['id']; ?> rzvy_flag_plus" data-id="<?php echo $addon['id']; ?>"><span class="fa fa-plus"></span></button>
										</div>
									</div>
									<?php 
								}else{
									echo $val['qty'];
								} 
								?>
							</td>
							<td style="vertical-align: inherit;" class="text-right"><?php echo $rzvy_currency_symbol.number_format($val['rate'],2,".",','); ?></td>
						</tr>
						<?php 
					}
				} 
				?>
				<tr class="rzvy_cart_calculations">
					<td class="text-right" colspan="3"><b><?php if(isset($rzvy_translangArr['sub_total'])){ echo $rzvy_translangArr['sub_total']; }else{ echo $rzvy_defaultlang['sub_total']; } ?></b></td>
					<td class="text-right"><?php echo $rzvy_currency_symbol.number_format($_SESSION['rzvy_cart_subtotal'],2,".",','); ?></td>
				</tr>
				<?php
				if($_SESSION['rzvy_cart_freqdiscount']>0){  
					?>
					<tr class="rzvy_cart_calculations_no_border">
						<td class="text-right" colspan="3"><b><?php if(isset($rzvy_translangArr['frequently_discount'])){ echo $rzvy_translangArr['frequently_discount']; }else{ echo $rzvy_defaultlang['frequently_discount']; } ?></b></td>
						<td class="text-right">-<?php echo $rzvy_currency_symbol.$_SESSION['rzvy_cart_freqdiscount']; ?></td>
					</tr>
					<?php 
				} 
				
				if($_SESSION['rzvy_cart_coupondiscount']>0){ 
					?>
					<tr class="rzvy_cart_calculations_no_border">
						<td class="text-right" colspan="3"><b><?php if(isset($rzvy_translangArr['coupon_discount'])){ echo $rzvy_translangArr['coupon_discount']; }else{ echo $rzvy_defaultlang['coupon_discount']; } ?></b></td>
						<td class="text-right">-<?php echo $rzvy_currency_symbol.$_SESSION['rzvy_cart_coupondiscount']; ?></td>
					</tr>
					<?php 
				} 
				if($_SESSION['rzvy_referral_discount_amount']>0){ 
					?>
					<tr class="rzvy_cart_calculations_no_border">
						<td class="text-right" colspan="3"><b><?php if(isset($rzvy_translangArr['referral_coupon_discount'])){ echo $rzvy_translangArr['referral_coupon_discount']; }else{ echo $rzvy_defaultlang['referral_coupon_discount']; } ?></b></td>
						<td class="text-right">-<?php echo $rzvy_currency_symbol.$_SESSION['rzvy_referral_discount_amount']; ?></td>
					</tr>
					<?php 
				} 
				
				if($_SESSION['rzvy_cart_tax']>0){
					?>
					<tr class="rzvy_cart_calculations_no_border">
						<td class="text-right" colspan="3"><b><?php if(isset($rzvy_translangArr['tax'])){ echo $rzvy_translangArr['tax']; }else{ echo $rzvy_defaultlang['tax']; } ?></b></td>
						<td class="text-right">+<?php echo $rzvy_currency_symbol.$_SESSION['rzvy_cart_tax']; ?></td>
					</tr>
					<?php 
				} 
				?>
				<tr>
					<td class="text-right rzvy_cart_calculations_no_border_td" colspan="3"><b><?php if(isset($rzvy_translangArr['net_total'])){ echo $rzvy_translangArr['net_total']; }else{ echo $rzvy_defaultlang['net_total']; } ?></b></td>
					<td class="text-right rzvy_cart_calculations"><?php echo $rzvy_currency_symbol.number_format($_SESSION['rzvy_cart_nettotal'],2,".",','); ?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php 
}

/** Get Fourth box having customer detail **/
else if(isset($_POST['get_fourth_step_box'])){ 
	/** get form fields options **/
	$rzvy_en_ff_firstname_status = $obj_settings->get_option('rzvy_en_ff_firstname_status');
	$rzvy_en_ff_lastname_status = $obj_settings->get_option('rzvy_en_ff_lastname_status');
	$rzvy_en_ff_phone_status = $obj_settings->get_option('rzvy_en_ff_phone_status');
	$rzvy_en_ff_address_status = $obj_settings->get_option('rzvy_en_ff_address_status');
	$rzvy_en_ff_city_status = $obj_settings->get_option('rzvy_en_ff_city_status');
	$rzvy_en_ff_state_status = $obj_settings->get_option('rzvy_en_ff_state_status');
	$rzvy_en_ff_country_status = $obj_settings->get_option('rzvy_en_ff_country_status');

	$rzvy_g_ff_firstname_status = $obj_settings->get_option('rzvy_g_ff_firstname_status');
	$rzvy_g_ff_lastname_status = $obj_settings->get_option('rzvy_g_ff_lastname_status');
	$rzvy_g_ff_phone_status = $obj_settings->get_option('rzvy_g_ff_phone_status');
	$rzvy_g_ff_address_status = $obj_settings->get_option('rzvy_g_ff_address_status');
	$rzvy_g_ff_city_status = $obj_settings->get_option('rzvy_g_ff_city_status');
	$rzvy_g_ff_state_status = $obj_settings->get_option('rzvy_g_ff_state_status');
	$rzvy_g_ff_country_status = $obj_settings->get_option('rzvy_g_ff_country_status');

	/** get form fields required options **/
	$rzvy_en_ff_firstname_optional = $obj_settings->get_option('rzvy_en_ff_firstname_optional');
	$rzvy_en_ff_lastname_optional = $obj_settings->get_option('rzvy_en_ff_lastname_optional');
	$rzvy_en_ff_phone_optional = $obj_settings->get_option('rzvy_en_ff_phone_optional');
	$rzvy_en_ff_address_optional = $obj_settings->get_option('rzvy_en_ff_address_optional');
	$rzvy_en_ff_city_optional = $obj_settings->get_option('rzvy_en_ff_city_optional');
	$rzvy_en_ff_state_optional = $obj_settings->get_option('rzvy_en_ff_state_optional');
	$rzvy_en_ff_country_optional = $obj_settings->get_option('rzvy_en_ff_country_optional');

	$rzvy_g_ff_firstname_optional = $obj_settings->get_option('rzvy_g_ff_firstname_optional');
	$rzvy_g_ff_lastname_optional = $obj_settings->get_option('rzvy_g_ff_lastname_optional');
	$rzvy_g_ff_phone_optional = $obj_settings->get_option('rzvy_g_ff_phone_optional');
	$rzvy_g_ff_address_optional = $obj_settings->get_option('rzvy_g_ff_address_optional');
	$rzvy_g_ff_city_optional = $obj_settings->get_option('rzvy_g_ff_city_optional');
	$rzvy_g_ff_state_optional = $obj_settings->get_option('rzvy_g_ff_state_optional');
	$rzvy_g_ff_country_optional = $obj_settings->get_option('rzvy_g_ff_country_optional'); 

	/** Customer detail **/
	$useremail = "";
	$userpassword = "";
	$userfirstname = "";
	$userlastname = "";
	if(isset($_SESSION['rzvy_location_selector_zipcode'])){
		$userzip = $_SESSION['rzvy_location_selector_zipcode'];
	}else{
		$userzip = "";
	}
	$userphone = "";
	$useraddress = "";
	$usercity = "";
	$userstate = "";
	$usercountry = "";
	if(isset($_SESSION['customer_id'])){
		$obj_frontend->customer_id = $_SESSION['customer_id'];
		$customer_detail = $obj_frontend->readone_customer();
		$useremail = $customer_detail['email'];
		$userpassword = $customer_detail['password'];
		$userfirstname = ucwords($customer_detail['firstname']);
		$userlastname = ucwords($customer_detail['lastname']);
		if(isset($_SESSION['rzvy_location_selector_zipcode'])){
			$userzip = $_SESSION['rzvy_location_selector_zipcode'];
		}else{
			$userzip = "";
		}
		$userphone = $customer_detail['phone'];
		$useraddress = $customer_detail['address'];
		$usercity = $customer_detail['city'];
		$userstate = $customer_detail['state'];
		$usercountry = $customer_detail['country'];
	}
	/* check location selector status */
	$rzvy_location_selector_status = $obj_settings->get_option("rzvy_location_selector_status"); 
	if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
		$show_location_selector = "N";
		$_SESSION['rzvy_location_selector_zipcode'] = "N/A";
	} 
	if(isset($_SESSION["rzvy_location_selector_zipcode"])){
		if($rzvy_location_selector_status == "Y" && ($_SESSION["rzvy_location_selector_zipcode"]=="" && $_SESSION["rzvy_location_selector_zipcode"]!="N/A")){
			$show_location_selector = "Y";
			$_SESSION['rzvy_location_selector_zipcode'] = "";
		}
	} 
	?>
	<div class="row">
		<div class="col-md-12">
			<div class="rzvy-steps-btn">
				<a id="rzvy_book_appointment_btn" href="javascript:void(0)" class="btn btn-common next-step next-button pull-right rzvy_nextstep_btn rounded-0"><?php if(isset($rzvy_translangArr['proceed_to_checkout'])){ echo $rzvy_translangArr['proceed_to_checkout']; }else{ echo $rzvy_defaultlang['proceed_to_checkout']; } ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-8">			
			<?php 			
			if($obj_settings->get_option("rzvy_referral_discount_status") == "Y"){ 
				?>
				<div>
					<div class="rzvy_referral_code_applied_div" style="display:none;">
						<p><span><?php if(isset($rzvy_translangArr['applied_referral_code'])){ echo $rzvy_translangArr['applied_referral_code']; }else{ echo $rzvy_defaultlang['applied_referral_code']; } ?>: <b class="rzvy_referral_code_applied_text"></b></span></p>
					</div>
					<div class="rzvy_referral_code_div">
						<h5><?php if(isset($rzvy_translangArr['do_you_have_referral_code'])){ echo $rzvy_translangArr['do_you_have_referral_code']; }else{ echo $rzvy_defaultlang['do_you_have_referral_code']; } ?></h5>
						<div class="input-group mb-3">
							<input type="text" id="rzvy_referral_code" name="rzvy_referral_code" placeholder="<?php if(isset($rzvy_translangArr['enter_your_referral_code'])){ echo $rzvy_translangArr['enter_your_referral_code']; }else{ echo $rzvy_defaultlang['enter_your_referral_code']; } ?>" minlength="15" maxlength="15" class="form-control rounded-0 text-uppercase">
							<div class="input-group-append">
								<button class="btn rzvy-custom-btn rounded-0" id="rzvy_apply_referral_code_btn" type="submit"><?php if(isset($rzvy_translangArr['apply'])){ echo $rzvy_translangArr['apply']; }else{ echo $rzvy_defaultlang['apply']; } ?></button>
							</div>
						</div>
					</div>
				</div>
				<hr />
				<?php
			}
			?>		
			<div class="row">
				<div class="col-md-12">
					<div class="rzvy-radio-group-block-content rzvy-no-border-bottom my-1 py-3">
						<h4><?php if(isset($rzvy_translangArr['personal_information'])){ echo $rzvy_translangArr['personal_information']; }else{ echo $rzvy_defaultlang['personal_information']; } ?></h4>
						<div class="rzvy-users-selection-div" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:none;'"; } ?>>
							<?php 
							$rzvy_show_existing_new_user_checkout = $obj_settings->get_option("rzvy_show_existing_new_user_checkout");
							$rzvy_show_guest_user_checkout = $obj_settings->get_option("rzvy_show_guest_user_checkout");
							if($rzvy_show_existing_new_user_checkout == "Y"){ 
								?>
								<input type="radio" class="rzvy-user-selection" id="rzvy-existing-user" name="rzvy-user-selection" checked value="ec" />
								<label class="rzvy-user-selection-label" for="rzvy-existing-user"><?php if(isset($rzvy_translangArr['existing_customer'])){ echo $rzvy_translangArr['existing_customer']; }else{ echo $rzvy_defaultlang['existing_customer']; } ?></label>

								<input type="radio" class="rzvy-user-selection" id="rzvy-new-user" name="rzvy-user-selection" value="nc" />
								<label class="rzvy-user-selection-label" for="rzvy-new-user"><?php if(isset($rzvy_translangArr['new_customer'])){ echo $rzvy_translangArr['new_customer']; }else{ echo $rzvy_defaultlang['new_customer']; } ?></label>
							
							<?php 
							}
							
							if($rzvy_show_guest_user_checkout == "Y"){ 
								?>
								<input type="radio" class="rzvy-user-selection" id="rzvy-guest-user" name="rzvy-user-selection" <?php if($rzvy_show_existing_new_user_checkout == "N"){ echo "checked"; } ?> value="gc" />
								<label class="rzvy-user-selection-label" for="rzvy-guest-user"><?php if(isset($rzvy_translangArr['guest_customer'])){ echo $rzvy_translangArr['guest_customer']; }else{ echo $rzvy_defaultlang['guest_customer']; } ?></label>
								<?php 
							} 
							
							if($rzvy_show_existing_new_user_checkout == "Y" || $rzvy_show_guest_user_checkout == "Y"){ 
								?>
								<input type="radio" class="rzvy-user-selection" id="rzvy-user-forget-password" name="rzvy-user-selection" value="fp" />
								<label class="rzvy-user-selection-label" for="rzvy-user-forget-password"><?php if(isset($rzvy_translangArr['forget_password'])){ echo $rzvy_translangArr['forget_password']; }else{ echo $rzvy_defaultlang['forget_password']; } ?></label>
								<?php 
							} 
							?>
						</div>
						<div class="rzvy-logout-div mt-2" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:block;'"; } ?> >
							<label><?php if(isset($rzvy_translangArr['you_are_logged_in_as'])){ echo $rzvy_translangArr['you_are_logged_in_as']; }else{ echo $rzvy_defaultlang['you_are_logged_in_as']; } ?> <b class="rzvy_loggedin_name"><?php echo $useremail; ?></b>. <a href="javascript:void(0)" id="rzvy_logout_btn"><?php if(isset($rzvy_translangArr['logout'])){ echo $rzvy_translangArr['logout']; }else{ echo $rzvy_defaultlang['logout']; } ?></a></label>
						</div>
					</div>
				</div>
			</div>
			<?php 
			if($rzvy_show_existing_new_user_checkout == "Y"){ 
				?>
				<form method="post" name="rzvy_login_form" id="rzvy_login_form">
					<div class="rzvy-radio-group-block mt24" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:none;'"; } ?> id="rzvy-existing-user-box">
						<div class="row">
							<div class="col-md-6">
								<div class="rzvy-input-class-div">
									<input type="email" name="rzvy_login_email" id="rzvy_login_email" placeholder="<?php if(isset($rzvy_translangArr['email_address'])){ echo $rzvy_translangArr['email_address']; }else{ echo $rzvy_defaultlang['email_address']; } ?>" class="rzvy-input-class">
								</div>
							</div>
							<div class="col-md-6">
								<div class="rzvy-input-class-div">
									<input type="password" name="rzvy_login_password" id="rzvy_login_password" placeholder="<?php if(isset($rzvy_translangArr['password'])){ echo $rzvy_translangArr['password']; }else{ echo $rzvy_defaultlang['password']; } ?>" class="rzvy-input-class">
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-md-12">
								<button id="rzvy_login_btn" class="btn btn-block rzvy-block-btn" type="submit"><i class="fa fa-lock"></i> <?php if(isset($rzvy_translangArr['login'])){ echo $rzvy_translangArr['login']; }else{ echo $rzvy_defaultlang['login']; } ?></button>
							</div>
						</div>
					</div>
				</form>
				<form method="post" name="rzvy_user_detail_form" id="rzvy_user_detail_form">
					<div class="rzvy-radio-group-block mt24" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:block;'"; } ?> id="rzvy-new-user-box">
						<div class="row rzvy_hide_after_login" <?php if(isset($_SESSION['customer_id'])){ echo "style='display:none;'"; } ?>>
							<div class="col-md-6">
								<div class="rzvy-input-class-div">
									<input type="email" id="rzvy_user_email" name="rzvy_user_email" placeholder="<?php if(isset($rzvy_translangArr['email_address'])){ echo $rzvy_translangArr['email_address']; }else{ echo $rzvy_defaultlang['email_address']; } ?>" value="<?php echo $useremail; ?>" class="rzvy-input-class">
								</div>
							</div>
							<div class="col-md-6">
								<div class="rzvy-input-class-div">
									<input type="password" id="rzvy_user_password" name="rzvy_user_password" placeholder="<?php if(isset($rzvy_translangArr['password'])){ echo $rzvy_translangArr['password']; }else{ echo $rzvy_defaultlang['password']; } ?>" value="<?php echo $userpassword; ?>" class="rzvy-input-class">
								</div>
							</div>
						</div>
						<div class="row">
							<?php 
							if($rzvy_en_ff_firstname_status == "Y"){ 
								?>
								<div class="col-md-6">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_user_firstname" name="rzvy_user_firstname" placeholder="<?php if(isset($rzvy_translangArr['first_name'])){ echo $rzvy_translangArr['first_name']; }else{ echo $rzvy_defaultlang['first_name']; } ?>" value="<?php echo $userfirstname; ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php  
							}else{ 
								?>
								<input type="hidden" id="rzvy_user_firstname" name="rzvy_user_firstname" value="<?php echo $userfirstname; ?>" />
								<?php 
							} 
							
							if($rzvy_en_ff_lastname_status == "Y"){ 
								?>
								<div class="col-md-6">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_user_lastname" name="rzvy_user_lastname" placeholder="<?php if(isset($rzvy_translangArr['last_name'])){ echo $rzvy_translangArr['last_name']; }else{ echo $rzvy_defaultlang['last_name']; } ?>" value="<?php echo $userlastname; ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php  
							}else{ 
								?>
								<input type="hidden" id="rzvy_user_lastname" name="rzvy_user_lastname" value="<?php echo $userlastname; ?>" />
								<?php 
							} 
							
							if($rzvy_en_ff_phone_status == "Y"){ 
								?>
								<div class="col-md-6">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_user_phone" name="rzvy_user_phone" placeholder="<?php if(isset($rzvy_translangArr['phone_number'])){ echo $rzvy_translangArr['phone_number']; }else{ echo $rzvy_defaultlang['phone_number']; } ?>" value="<?php echo $userphone; ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php  
							}else{ 
								?>
								<input type="hidden" id="rzvy_user_phone" name="rzvy_user_phone" value="<?php echo $userphone; ?>" />
								<?php 
							} 
							
							$show_zip_input = "";
							if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
								$show_zip_input= "rzvy_hide";
							}
							?>
							<div class="col-md-6 <?php echo $show_zip_input; ?>">
								<div class="rzvy-input-class-div">
									<input type="text" id="rzvy_user_zip" name="rzvy_user_zip" placeholder="<?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?>" disabled value="<?php echo $userzip; ?>" class="rzvy-input-class">
								</div>
							</div>
							
							<?php  
							if($rzvy_en_ff_address_status == "Y"){ 
								?>
								<div class="col-md-12">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_user_address" name="rzvy_user_address" placeholder="<?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?>" value="<?php echo $useraddress; ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php  
							}else{ 
								?>
								<input type="hidden" id="rzvy_user_address" name="rzvy_user_address" value="<?php echo $useraddress; ?>" />
								<?php 
							} 
							
							if($rzvy_en_ff_city_status == "Y"){ 
								?>
								<div class="col-md-4">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_user_city" name="rzvy_user_city" placeholder="<?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?>" value="<?php echo $usercity; ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php  
							}else{ 
								?>
								<input type="hidden" id="rzvy_user_city" name="rzvy_user_city" value="<?php echo $usercity; ?>" />
								<?php 
							} 
							
							if($rzvy_en_ff_state_status == "Y"){ 
								?>
								<div class="col-md-4">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_user_state" name="rzvy_user_state" placeholder="<?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?>" value="<?php echo $userstate; ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php  
							}else{ 
								?>
								<input type="hidden" id="rzvy_user_state" name="rzvy_user_state" value="<?php echo $userstate; ?>" />
								<?php 
							} 
							
							if($rzvy_en_ff_country_status == "Y"){ 
								?>
								<div class="col-md-4">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_user_country" name="rzvy_user_country" placeholder="<?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?>" value="<?php echo $usercountry; ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php  
							}else{ 
								?>
								<input type="hidden" id="rzvy_user_country" name="rzvy_user_country" value="<?php echo $usercountry; ?>" />
								<?php 
							} 
							?>
						</div>
					</div>
				</form>
			<?php } ?>
			<?php if($rzvy_show_guest_user_checkout == "Y"){ ?>
				<form method="post" name="rzvy_guestuser_detail_form" id="rzvy_guestuser_detail_form">
					<div class="rzvy-radio-group-block mt24" <?php if($rzvy_show_existing_new_user_checkout == "N"){ echo "style='display:block;'"; } ?> id="rzvy-guest-user-box">
						<div class="row">
							<?php 
							if($rzvy_g_ff_firstname_status == "Y"){ 
								?>
								<div class="col-md-6">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_guest_firstname" name="rzvy_guest_firstname" placeholder="<?php if(isset($rzvy_translangArr['first_name'])){ echo $rzvy_translangArr['first_name']; }else{ echo $rzvy_defaultlang['first_name']; } ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php 
							}else{ 
								?>
								<input type="hidden" id="rzvy_guest_firstname" name="rzvy_guest_firstname" />
								<?php 
							} 
							
							if($rzvy_g_ff_lastname_status == "Y"){ 
								?>
								<div class="col-md-6">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_guest_lastname" name="rzvy_guest_lastname" placeholder="<?php if(isset($rzvy_translangArr['last_name'])){ echo $rzvy_translangArr['last_name']; }else{ echo $rzvy_defaultlang['last_name']; } ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php 
							}else{ 
								?>
								<input type="hidden" id="rzvy_guest_lastname" name="rzvy_guest_lastname" />
								<?php 
							} 
							?>
							<div class="col-md-6">
								<div class="rzvy-input-class-div">
									<input type="text" id="rzvy_guest_email" name="rzvy_guest_email" placeholder="<?php if(isset($rzvy_translangArr['email_address'])){ echo $rzvy_translangArr['email_address']; }else{ echo $rzvy_defaultlang['email_address']; } ?>" class="rzvy-input-class">
								</div>
							</div>
							<?php 
							if($rzvy_g_ff_phone_status == "Y"){ 
								?>
								<div class="col-md-6">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_guest_phone" name="rzvy_guest_phone" placeholder="<?php if(isset($rzvy_translangArr['phone_number'])){ echo $rzvy_translangArr['phone_number']; }else{ echo $rzvy_defaultlang['phone_number']; } ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php 
							}else{ 
								?>
								<input type="hidden" id="rzvy_guest_phone" name="rzvy_guest_phone" />
								<?php 
							}
							
							$show_gzip_input = "";
							if($rzvy_location_selector_status == "N" || $rzvy_location_selector_status == ""){ 
								$show_gzip_input= "rzvy_hide";
							}
							
							if($rzvy_g_ff_address_status == "Y"){ 
								?>
								<div class="col-md-12">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_guest_address" name="rzvy_guest_address" placeholder="<?php if(isset($rzvy_translangArr['address'])){ echo $rzvy_translangArr['address']; }else{ echo $rzvy_defaultlang['address']; } ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php 
							}else{ 
								?>
								<input type="hidden" id="rzvy_guest_address" name="rzvy_guest_address" />
								<?php 
							} 
							?>
							<div class="col-md-6 <?php echo $show_gzip_input; ?>">
								<div class="rzvy-input-class-div">
									<input type="text" id="rzvy_guest_zip" name="rzvy_guest_zip" placeholder="<?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?>" disabled value="<?php echo $userzip; ?>" class="rzvy-input-class">
								</div>
							</div>
							<?php 
							if($rzvy_g_ff_city_status == "Y"){ 
								?>
								<div class="col-md-6">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_guest_city" name="rzvy_guest_city" placeholder="<?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php 
							}else{ 
								?>
								<input type="hidden" id="rzvy_guest_city" name="rzvy_guest_city" />
								<?php 
							} 
							if($rzvy_g_ff_state_status == "Y"){ 
								?>
								<div class="col-md-6">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_guest_state" name="rzvy_guest_state" placeholder="<?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php 
							}else{ 
								?>
								<input type="hidden" id="rzvy_guest_state" name="rzvy_guest_state" />
								<?php 
							} 
							if($rzvy_g_ff_country_status == "Y"){ 
								?>
								<div class="col-md-6">
									<div class="rzvy-input-class-div">
										<input type="text" id="rzvy_guest_country" name="rzvy_guest_country" placeholder="<?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?>" class="rzvy-input-class">
									</div>
								</div>
								<?php 
							}else{ 
								?>
								<input type="hidden" id="rzvy_guest_country" name="rzvy_guest_country" />
								<?php 
							} 
							?>
						</div>
					</div>
				</form>
			<?php } ?>
			<?php if($rzvy_show_existing_new_user_checkout == "Y" || $rzvy_show_guest_user_checkout == "Y"){ ?>
				<form id="rzvy_forgot_password_form" name="rzvy_forgot_password_form">
					<div class="rzvy-radio-group-block mt24" id="rzvy-user-forget-password-box">
						<div class="row">
							<div class="col-md-12">
								<div class="rzvy-input-class-div">
									<input type="email" id="rzvy_forgot_password_email" name="rzvy_forgot_password_email" placeholder="<?php if(isset($rzvy_translangArr['your_registered_email_address'])){ echo $rzvy_translangArr['your_registered_email_address']; }else{ echo $rzvy_defaultlang['your_registered_email_address']; } ?>" class="rzvy-input-class">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<button class="btn btn-block rzvy-block-btn" id="rzvy_forgot_password_btn" type="submit"><i class="fa fa-envelope"></i> <?php if(isset($rzvy_translangArr['send_mail'])){ echo $rzvy_translangArr['send_mail']; }else{ echo $rzvy_defaultlang['send_mail']; } ?></button>
							</div>
						</div>
					</div>
				</form>
			<?php } ?>
		</div>
		<div class="col-md-4 border">
			<h5 class="py-2"><?php if(isset($rzvy_translangArr['payment_method'])){ echo $rzvy_translangArr['payment_method']; }else{ echo $rzvy_defaultlang['payment_method']; } ?></h5>
			
			<div class="row mt-2">
				<div class="rzvy-payments ml-3">
					<?php 
					if($obj_settings->get_option("rzvy_pay_at_venue_status") == "Y"){ 
						?>
						<input type="radio" class="rzvy-payment-method-check" id="rzvy-pay-at-venue" name="rzvy-payment-method-radio" value="pay-at-venue" checked />
						<label for="rzvy-pay-at-venue"><?php if(isset($rzvy_translangArr['pay_at_venue'])){ echo $rzvy_translangArr['pay_at_venue']; }else{ echo $rzvy_defaultlang['pay_at_venue']; } ?></label>
						<?php 
					} 
					if($obj_settings->get_option("rzvy_paypal_payment_status") == "Y"){ 
						?>
						<input type="radio" class="rzvy-payment-method-check" id="rzvy-paypal-payment" name="rzvy-payment-method-radio" value="paypal" />
						<label for="rzvy-paypal-payment"><?php if(isset($rzvy_translangArr['paypal'])){ echo $rzvy_translangArr['paypal']; }else{ echo $rzvy_defaultlang['paypal']; } ?></label>
						<?php 
					} 
					if($obj_settings->get_option("rzvy_stripe_payment_status") == "Y" && $obj_settings->get_option("rzvy_authorizenet_payment_status") == "N" && $obj_settings->get_option("rzvy_twocheckout_payment_status") == "N"){ 
						$payment_method = "stripe";
					} else if($obj_settings->get_option("rzvy_stripe_payment_status") == "N" && $obj_settings->get_option("rzvy_authorizenet_payment_status") == "Y" && $obj_settings->get_option("rzvy_twocheckout_payment_status") == "N"){ 
						$payment_method = "authorize.net";
					}  else if($obj_settings->get_option("rzvy_stripe_payment_status") == "N" && $obj_settings->get_option("rzvy_authorizenet_payment_status") == "N" && $obj_settings->get_option("rzvy_twocheckout_payment_status") == "Y"){ 
						$payment_method = "2checkout";
					} else{
						$payment_method = "N";
					}
					if($payment_method != "N"){ 
						?>
						<input type="radio" class="rzvy-payment-method-check" id="rzvy-card-payment" name="rzvy-payment-method-radio" value="<?php echo $payment_method; ?>" />
						<label for="rzvy-card-payment"><?php if(isset($rzvy_translangArr['card_payment'])){ echo $rzvy_translangArr['card_payment']; }else{ echo $rzvy_defaultlang['card_payment']; } ?></label>
						<?php 
					} 
					?>
				</div>
			</div>
			<hr />
			<div class="rzvy-radio-group-block mt-2 mx-2">
				<div class="rzvy-card-detail-box">
					<h5 style="margin-left:-3%"><?php if(isset($rzvy_translangArr['credit_card_details'])){ echo $rzvy_translangArr['credit_card_details']; }else{ echo $rzvy_defaultlang['credit_card_details']; } ?></h5>
					<?php 
					if($obj_settings->get_option("rzvy_stripe_payment_status") == "Y" && $obj_settings->get_option("rzvy_authorizenet_payment_status") == "N" && $obj_settings->get_option("rzvy_twocheckout_payment_status") == "N"){ 
						?>
						<div class="mb-4">
							<div id="rzvy_stripe_plan_card_element">
								<!-- A Stripe Element will be inserted here. -->
							</div>
							<!-- Used to display form errors. -->
							<div id="rzvy_stripe_plan_card_errors" role="alert"></div>
						</div>
						<?php 
					}else{ 
						?>
						<div class="row">
							<div class="col-md-9 px-1">
								<div class="rzvy-input-class-div">
									<input maxlength="20" size="20" type="tel" placeholder="<?php if(isset($rzvy_translangArr['card_number'])){ echo $rzvy_translangArr['card_number']; }else{ echo $rzvy_defaultlang['card_number']; } ?>" class="rzvy-input-class rzvy-card-num p-2" name="rzvy-cardnumber" id="rzvy-cardnumber" value="" />
								</div>
							</div>
							<div class="col-md-3 px-1">
								<div class="rzvy-input-class-div">
									<input type="password" maxlength="4" size="4" placeholder="<?php if(isset($rzvy_translangArr['cvv'])){ echo $rzvy_translangArr['cvv']; }else{ echo $rzvy_defaultlang['cvv']; } ?>" class="rzvy-input-class p-2"  name="rzvy-cardcvv" id="rzvy-cardcvv" value="" />
								</div>
							</div>
						</div>
						<div class="row mt-3">
							<div class="col-md-3 px-1">
								<div class="rzvy-input-class-div">
									<input maxlength="2" type="tel" placeholder="<?php if(isset($rzvy_translangArr['mm'])){ echo $rzvy_translangArr['mm']; }else{ echo $rzvy_defaultlang['mm']; } ?>" class="rzvy-input-class p-2" name="rzvy-cardexmonth" id="rzvy-cardexmonth" value="" />
								</div>
							</div>
							<div class="col-md-3 px-1">
								<div class="rzvy-input-class-div">
									<input maxlength="4" type="tel" placeholder="<?php if(isset($rzvy_translangArr['yyyy'])){ echo $rzvy_translangArr['yyyy']; }else{ echo $rzvy_defaultlang['yyyy']; } ?>" class="rzvy-input-class p-2" name="rzvy-cardexyear" id="rzvy-cardexyear" value="" />
								</div>
							</div>
							<div class="col-md-6 px-1">
								<div class="rzvy-input-class-div">
									<input type="text" placeholder="<?php if(isset($rzvy_translangArr['name_as_on_card'])){ echo $rzvy_translangArr['name_as_on_card']; }else{ echo $rzvy_defaultlang['name_as_on_card']; } ?>" class="rzvy-input-class p-2" name="rzvy-cardholdername" id="rzvy-cardholdername" value="" />
								</div>
							</div>
						</div>
						<?php 
					} 
					?>
				</div>
			</div>
			
			<div class="col-md-12 px-0 mt-2">
				<div class="rzvy-terms-and-condition">
					<label class="custom-control custom-checkbox">
						<input type="checkbox" class="custom-control-input rzvy-tc-control-input">
						<span class="custom-control-indicator rzvy-tc-control-indicator"></span>
						<span class="custom-control-description rzvy-tc-control-description"><?php if(isset($rzvy_translangArr['i_read_and_agree_to_the'])){ echo $rzvy_translangArr['i_read_and_agree_to_the']; }else{ echo $rzvy_defaultlang['i_read_and_agree_to_the']; } ?> <a target="_blank" href="<?php $rzvy_terms_and_condition_link = $obj_settings->get_option("rzvy_terms_and_condition_link"); if($rzvy_terms_and_condition_link != ""){ echo $rzvy_terms_and_condition_link; }else{ echo "javascript:void(0)"; } ?>"><?php if(isset($rzvy_translangArr['terms_conditions'])){ echo $rzvy_translangArr['terms_conditions']; }else{ echo $rzvy_defaultlang['terms_conditions']; } ?></a></span>
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="row mt-2">
		<div class="col-md-12">
			<div class="rzvy-steps-btn">
				<a id="rzvy_book_appointment_btn" href="javascript:void(0)" class="btn btn-common next-step next-button pull-right rzvy_nextstep_btn rounded-0"><?php if(isset($rzvy_translangArr['proceed_to_checkout'])){ echo $rzvy_translangArr['proceed_to_checkout']; }else{ echo $rzvy_defaultlang['proceed_to_checkout']; } ?> <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
			</div>
		</div>
	</div>
	<?php 
}

/* cart: apply referral discount coupon */
else if(isset($_POST['apply_referral_discount'])){
	$check_referral_coupon_code_exist = $obj_frontend->check_referral_coupon_code_exist($_SESSION["customer_id"], $_POST["ref_discount_coupon"]);
	if(mysqli_num_rows($check_referral_coupon_code_exist)>0){
		$discount_value = mysqli_fetch_array($check_referral_coupon_code_exist);
		if($discount_value["used"] == "N"){
			$_SESSION["rzvy_applied_ref_customer_id"] = $discount_value["id"];
			echo "applied";
		}else{
			echo "used";
		}
	}else{
		echo "notexist";
	}
}