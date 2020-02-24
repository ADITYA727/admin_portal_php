var rzvy_stripe, rzvy_stripe_plan_card;

$(document).ready(function () {
    var site_url = generalObj.site_url;
	var ajax_url = generalObj.ajax_url;
    /* Initialize tooltips */
	$('#rzvy_main_wizard .nav-tabs > li a[title]').tooltip();
	
	/** Show Location selector Modal **/
	if(generalObj.location_selector == "Y"){
		$("#rzvy-location-selector-modal").modal("show");
	}
	
	/** Validation patterns **/
	$.validator.addMethod("pattern_name", function(value, element) {
		return this.optional(element) || /^[a-zA-Z '.']+$/.test(value);
	}, langObj.please_enter_only_alphabets);
	$.validator.addMethod("pattern_price", function(value, element) {
		return this.optional(element) || /^[0-9]\d*(\.\d{1,2})?$/.test(value);
	}, langObj.please_enter_only_numerics);
	
	$.validator.addMethod("pattern_phone", function(value, element) {
		return this.optional(element) || /\d+(?:[ -]*\d+)*$/.test(value);
	}, langObj.please_enter_valid_phone_number_without_country_code);
	$.validator.addMethod("pattern_zip", function(value, element) {
		return this.optional(element) || /^[a-zA-Z 0-9\-]*$/.test(value);
	}, langObj.please_enter_valid_zip);
	
	/** Trigger Category On Page Load **/
	var single_category_status = generalObj.single_category_status;
	if(single_category_status == "Y"){
		var countcats = 0;
		$('.rzvy-categories-radio-change').each(function(){		
			countcats++;
		});
		if(countcats==1){
			$('.rzvy-categories-radio-change').trigger('click');	
			$('.rzvy-category-container').hide();		
		}
	}
});
$(document).bind("ready ajaxComplete", function(){
	var site_url = generalObj.site_url;
	var ajaxurl = generalObj.ajax_url;
    $('[data-toggle="tooltip"]').tooltip();

	$('#rzvy_start_slot').selectpicker();
	$('#rzvy_end_slot').selectpicker();
	
	/** card payment validation **/
	if(generalObj.authorizenet_status == "Y" || generalObj.twocheckout_status == "Y"){
		$('#rzvy-cardnumber').payment('formatCardNumber');
		$('#rzvy-cardcvv').payment('formatCardCVC');
		$('#rzvy-cardexmonth').payment('restrictNumeric');
		$('#rzvy-cardexyear').payment('restrictNumeric');
	}

	/** JS to add intltel input to phone number **/
	if(formfieldsObj.en_ff_phone_status == "Y"){
		$("#rzvy_user_phone").intlTelInput({ initialCountry: generalObj.defaultCountryCode, separateDialCode: true, utilsScript: site_url+"includes/vendor/intl-tel-input/js/utils.js" });
	}
	if(formfieldsObj.g_ff_phone_status == "Y"){
		$("#rzvy_guest_phone").intlTelInput({ initialCountry: generalObj.defaultCountryCode, separateDialCode: true, utilsScript: site_url+"includes/vendor/intl-tel-input/js/utils.js" });
	}
	
	/** validate login form **/
	$('#rzvy_login_form').validate({
		rules: {
			rzvy_login_email: { required:true, email:true },
			rzvy_login_password: { required:true, minlength: 8, maxlength: 20 }
		},
		messages: {
			rzvy_login_email: { required: langObj.please_enter_email, email: langObj.please_enter_valid_email },
			rzvy_login_password: { required: langObj.please_enter_password, minlength: langObj.please_enter_minimum_8_characters, maxlength: langObj.please_enter_maximum_20_characters },
		}
	});
	
	if(formfieldsObj.en_ff_firstname == "Y"){ var is_required_firstname = true; }else{ var is_required_firstname = false; }
	if(formfieldsObj.en_ff_lastname == "Y"){ var is_required_lastname = true; }else{ var is_required_lastname = false; }
	if(formfieldsObj.en_ff_phone == "Y"){ var is_required_phone = true; }else{ var is_required_phone = false; }
	if(formfieldsObj.en_ff_address == "Y"){ var is_required_address = true; }else{ var is_required_address = false; }
	if(formfieldsObj.en_ff_city == "Y"){ var is_required_city = true; }else{ var is_required_city = false; }
	if(formfieldsObj.en_ff_state == "Y"){ var is_required_state = true; }else{ var is_required_state = false; }
	if(formfieldsObj.en_ff_country == "Y"){ var is_required_country = true; }else{ var is_required_country = false; }
	
	if(formfieldsObj.g_ff_firstname == "Y"){ var is_required_gfirstname = true; }else{ var is_required_gfirstname = false; }
	if(formfieldsObj.g_ff_lastname == "Y"){ var is_required_glastname = true; }else{ var is_required_glastname = false; }
	if(formfieldsObj.g_ff_phone == "Y"){ var is_required_gphone = true; }else{ var is_required_gphone = false; }
	if(formfieldsObj.g_ff_address == "Y"){ var is_required_gaddress = true; }else{ var is_required_gaddress = false; }
	if(formfieldsObj.g_ff_city == "Y"){ var is_required_gcity = true; }else{ var is_required_gcity = false; }
	if(formfieldsObj.g_ff_state == "Y"){ var is_required_gstate = true; }else{ var is_required_gstate = false; }
	if(formfieldsObj.g_ff_country == "Y"){ var is_required_gcountry = true; }else{ var is_required_gcountry = false; }
	
	/** validate user detail form **/
	$("#rzvy_user_detail_form").validate({
		rules: {
			rzvy_user_email:{ required: true, email:true, remote: { 
				url:ajaxurl+"rzvy_check_email_ajax.php",
				type:"POST",
				async:false,
				data: {
					email: function(){ return $("#rzvy_user_email").val(); },
					check_front_email_exist: 1
				}
			} },
			rzvy_user_password: { required:true, minlength: 8, maxlength: 20 },
			rzvy_user_firstname:{ required: is_required_firstname, maxlength: 50 },
			rzvy_user_lastname: { required:is_required_lastname, maxlength: 50 },
			rzvy_user_phone: { required:is_required_phone, minlength: 10, maxlength: 15, pattern_phone:true },
			rzvy_user_address: { required:is_required_address },
			rzvy_user_city: { required:is_required_city },
			rzvy_user_state: { required:is_required_state },
			rzvy_user_zip: { required:true, pattern_zip:true, minlength: 5, maxlength: 10 },
			rzvy_user_country: { required:is_required_country }
		},
		messages: {
			rzvy_user_email:{ required: langObj.please_enter_email, email: langObj.please_enter_valid_email, remote: langObj.email_already_exist },
			rzvy_user_password: { required: langObj.please_enter_password, minlength: langObj.please_enter_minimum_8_characters, maxlength: langObj.please_enter_maximum_20_characters },
			rzvy_user_firstname:{ required: langObj.please_enter_first_name, maxlength: langObj.please_enter_maximum_50_characters },
			rzvy_user_lastname: { required: langObj.please_enter_last_name, maxlength: langObj.please_enter_maximum_50_characters },
			rzvy_user_phone: { required: langObj.please_enter_phone_number, minlength: langObj.please_enter_minimum_10_digits, maxlength: langObj.please_enter_maximum_15_digits },
			rzvy_user_address: { required: langObj.please_enter_address },
			rzvy_user_city: { required: langObj.please_enter_city },
			rzvy_user_state: { required: langObj.please_enter_state },
			rzvy_user_zip: { required: langObj.please_enter_state, minlength: langObj.please_enter_minimum_5_characters, maxlength: langObj.please_enter_maximum_10_characters },
			rzvy_user_country: { required: langObj.please_enter_country }
		}
	});
	
	/** validate guest user detail form **/
	$("#rzvy_guestuser_detail_form").validate({
		rules: {
			rzvy_guest_email:{ required: true, email:true },
			rzvy_guest_firstname:{ required: is_required_gfirstname, maxlength: 50 },
			rzvy_guest_lastname: { required:is_required_glastname, maxlength: 50 },
			rzvy_guest_phone: { required:is_required_gphone, minlength: 10, maxlength: 15, pattern_phone:true },
			rzvy_guest_address: { required:is_required_gaddress },
			rzvy_guest_city: { required:is_required_gcity },
			rzvy_guest_state: { required:is_required_gstate },
			rzvy_guest_zip: { required:true, pattern_zip:true, minlength: 5, maxlength: 10 },
			rzvy_guest_country: { required:is_required_gcountry }
		},
		messages: {
			rzvy_guest_email:{ required: langObj.please_enter_email, email: langObj.please_enter_valid_email },
			rzvy_guest_firstname:{ required: langObj.please_enter_first_name, maxlength: langObj.please_enter_maximum_50_characters },
			rzvy_guest_lastname: { required: langObj.please_enter_last_name, maxlength: langObj.please_enter_maximum_50_characters },
			rzvy_guest_phone: { required: langObj.please_enter_phone_number, minlength: langObj.please_enter_minimum_10_digits, maxlength: langObj.please_enter_maximum_15_digits },
			rzvy_guest_address: { required: langObj.please_enter_address },
			rzvy_guest_city: { required: langObj.please_enter_city },
			rzvy_guest_state: { required: langObj.please_enter_state },
			rzvy_guest_zip: { required: langObj.please_enter_state, minlength: langObj.please_enter_minimum_5_characters, maxlength: langObj.please_enter_maximum_10_characters },
			rzvy_guest_country: { required: langObj.please_enter_country }
		}
	});
	
	/** validate forget password form **/
	$('#rzvy_forgot_password_form').validate({
        rules: {
            rzvy_forgot_password_email: {required: true, email: true}
        },
        messages: {
            rzvy_forgot_password_email: { required: langObj.please_enter_email_address, email: langObj.please_enter_valid_email_address }
        }
    });
});

/** JS to show services according category selection **/
$(document).on("click", ".rzvy-categories-radio-change", function(){
	$(".rzvy-services-container").html("");
	$(".rzvy-addons-container").html("");
	var ajax_url = generalObj.ajax_url;
	var id = $(this).val();
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'get_services_by_cat_id': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) {
			$(".rzvy-services-container").html(res);
			
			/** Auto Trigger Service Check **/
			var single_service_status = generalObj.single_service_status;
			if(single_service_status == "Y"){
				var countservices = 0;
				$('.rzvy-services-radio-change').each(function(){		
					countservices++;
				});
				
				if(countservices==1){
					$('.rzvy-services-radio-change').trigger('click');
					$('.rzvy-services-container').hide();		
				}
			}
		}
	});
});

/** JS to show addons according services selection **/
$(document).on("click", ".rzvy-services-radio-change", function(){
	$(".rzvy-addons-container").html("");
	var ajax_url = generalObj.ajax_url;
	var id = $(this).val();
	/** To get addons **/
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'get_multi_and_single_qty_addons_content': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) {
			$(".rzvy-addons-container").html(res);
			$(".rzvy_nextstep_btn_bottom").show();
		}
	});
});

/** JS to make addons qty inc & desc **/
$(document).on("click", ".rzvy_plusminus_addons_btns", function(){
	var ajax_url = generalObj.ajax_url;
	var id = $(this).data("id");
	var currentVal = parseInt($("#rzvy_plusminus_addons_input_"+id).val());
	if($(this).hasClass("rzvy_flag_minus")){
		currentVal -= 1;
		if (currentVal >= 0) {
			$("#rzvy_plusminus_addons_input_"+id).val(currentVal);
		}
	} else if($(this).hasClass("rzvy_flag_plus")){
		currentVal += 1;
		if (currentVal <= 15) {
			$("#rzvy_plusminus_addons_input_"+id).val(currentVal);
		}
	}else{}
	
	if(currentVal > 0){
		$("#rzvy-addons-multipleqty-box-"+id).prop("checked", true);
	}else{
		$("#rzvy-addons-multipleqty-box-"+id).prop("checked", false);
	}
	if(currentVal <= 0){
		$(".rzvy_plusminus_addons_minus_btn_"+id).prop('disabled', true);
	}else{
		$(".rzvy_plusminus_addons_minus_btn_"+id).prop('disabled', false);
	}
	if(currentVal >= 15){
		$(".rzvy_plusminus_addons_plus_btn_"+id).prop('disabled', true);
	}else{
		$(".rzvy_plusminus_addons_plus_btn_"+id).prop('disabled', false);
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'qty': currentVal,
			'add_to_cart_item': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) {
		}
	});
});

/** JS to add single qty addons **/
$(document).on("click", ".rzvy_addons_input", function(){
	var ajax_url = generalObj.ajax_url;
	var id = $(this).val();
	
	if($(this).prop("checked") == true){
		var qty = 1;
	}else{
		var qty = 0;
	}
	$("#rzvy_plusminus_addons_input_"+id).val(qty);
	if(qty <= 0){
		$(".rzvy_plusminus_addons_minus_btn_"+id).prop('disabled', true);
	}else{
		$(".rzvy_plusminus_addons_minus_btn_"+id).prop('disabled', false);
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'qty': qty,
			'add_to_cart_item': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) {
		}
	});
});

/** JS to make addons qty inc & desc in cart **/
$(document).on("click", ".rzvy_plusminus_addons_btns_cart", function(){
	var ajax_url = generalObj.ajax_url;
	var id = $(this).data("id");
	var currentVal = parseInt($("#rzvy_plusminus_addons_input_"+id).val());
	if($(this).hasClass("rzvy_flag_minus")){
		currentVal -= 1;
		if (currentVal >= 0) {
			$("#rzvy_plusminus_addons_input_"+id).val(currentVal);
		}
	} else if($(this).hasClass("rzvy_flag_plus")){
		currentVal += 1;
		if (currentVal <= 15) {
			$("#rzvy_plusminus_addons_input_"+id).val(currentVal);
		}
	}else{}
	
	if(currentVal <= 0){
		$(".rzvy_plusminus_addons_minus_btn_"+id).prop('disabled', true);
	}else{
		$(".rzvy_plusminus_addons_minus_btn_"+id).prop('disabled', false);
	}
	if(currentVal >= 15){
		$(".rzvy_plusminus_addons_plus_btn_"+id).prop('disabled', true);
	}else{
		$(".rzvy_plusminus_addons_plus_btn_"+id).prop('disabled', false);
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'qty': currentVal,
			'add_to_cart_item': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) { 
			$.ajax({
				type: 'post',
				data: {
					'refresh_cart_sidebar': 1
				},
				url: ajax_url + "rzvy_front_stepview_ajax.php",
				success: function (response) {
					$("#rzvy_refresh_cart").html(response);
				}
			});
		}
	});
});

/** JS to get Second box with frequently discount, staff & calendar **/
$(document).on("click", "#rzvy-get-second-next-box-btn", function(){
	if($(".rzvy-categories-radio-change:checked").val() === undefined || $(".rzvy-services-radio-change:checked").val() === undefined){
		swal(langObj.please_add_item_in_your_cart, "", "error");
	}else{
		var ajax_url = generalObj.ajax_url;
		$.ajax({
			type: 'post',
			data: {
				'get_second_step_box': 1
			},
			url: ajax_url + "rzvy_front_stepview_ajax.php",
			success: function (res) {
				/** To Enable Disable Menus START **/
				$('#rzvy_main_wizard a[data-toggle="tab"]').removeClass('active');
				$('#rzvy_main_wizard a[data-toggle="tab"]').addClass('disabled');
				$('.rzvy-second-step-tab').removeClass('disabled');
				$('.rzvy-second-step-tab').addClass('active');
				$(".rzvy-steps").removeClass("active");
				$(".rzvy-steps").removeClass("fade");
				$(".rzvy-steps").removeClass("show");
				$("#rzvy-second-step").addClass("fade show active");
				/** To Enable Disable Menus END **/
				
				$("#rzvy-second-step").html(res);
				if($(".rzvy-staff-change").length==1){
					$(".rzvy-staff-change").trigger("click");
					$(".rzvy-staff-container").hide();
					$(".rzvy-staff-container-hr").hide();
				}
			}
		});
	}
});

/** JS to get Third box with booking summary **/
$(document).on("click", "#rzvy-get-third-next-box-btn", function(){
	if($(".rzvy-staff-change:checked").val() === undefined || $(".rzvy-staff-change:checked").val()<=0 || $(".rzvy-staff-change:checked").val() == ""){
		swal(langObj.please_select_staff_member, "", "error");
	}else if ($("#rzvy_start_slot").val() === undefined || $("#rzvy_start_slot").val() == null || $("#rzvy_start_slot").val() == "") {
		swal(langObj.please_select_appointment_slot, "", "error");
	}else{
		var ajax_url = generalObj.ajax_url;
		$.ajax({
			type: 'post',
			data: {
				'get_third_step_box': 1
			},
			url: ajax_url + "rzvy_front_stepview_ajax.php",
			success: function (res) {
				/** To Enable Disable Menus START **/
				$('#rzvy_main_wizard a[data-toggle="tab"]').removeClass('active');
				$('#rzvy_main_wizard a[data-toggle="tab"]').addClass('disabled');
				$('.rzvy-third-step-tab').removeClass('disabled');
				$('.rzvy-third-step-tab').addClass('active');
				$(".rzvy-steps").removeClass("active");
				$(".rzvy-steps").removeClass("fade");
				$(".rzvy-steps").removeClass("show");
				$("#rzvy-third-step").addClass("fade show active");
				/** To Enable Disable Menus END **/
				
				$("#rzvy-third-step").html(res);
				$.ajax({
					type: 'post',
					data: {
						'refresh_cart_sidebar': 1
					},
					url: ajax_url + "rzvy_front_stepview_ajax.php",
					success: function (response) {
						$("#rzvy_refresh_cart").html(response);
					}
				});
			}
		});
	}
});

/** JS to make frequently discount selected **/
$(document).on("click", ".rzvy-frequently-discount-change", function(){
	var id = $(this).val();
	var ajax_url = generalObj.ajax_url;
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'update_frequently_discount': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) {}
	});
});

/** JS to set staff on service selection **/
$(document).on("click", ".rzvy-staff-change", function(){
	var id = $(this).val();
	var ajax_url = generalObj.ajax_url;
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'set_staff_according_service': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) {
			$(".rzvy-calendar-slots-container").html(res);
		}
	});
});

/** Get available slots JS **/
$(document).on("click", ".rzvy_date_selection", function(){
	var selected_date = $(this).data("day");
	if (selected_date.length>0) {
		$(".rzvy_available_slots_block").html("");
		var ajax_url = generalObj.ajax_url;
		$(".rzvy_date_selection").removeClass("active_selected_date");
		$(this).addClass("active_selected_date");
		$.ajax({
			type: 'post',
			data: {
				'selected_date': selected_date,
				'get_slots': 1
			},
			url: ajax_url + "rzvy_front_stepview_ajax.php",
			success: function (res) {
				$("#rzvy_start_slot").html(res);
				$('#rzvy_start_slot').selectpicker('refresh');
				$('#rzvy_start_slot').selectpicker('val', $(".rzvy_time_slots_selection:first").val());
				$("#rzvy_start_slot").trigger("change");
				$("#rzvy_end_slot").html("");
				$('#rzvy_end_slot').selectpicker('refresh');
				$(".rzvy_end_slot_div").hide();
			}
		});
	}
});

/** JS to get end time slots **/
$(document).on("change", "#rzvy_start_slot", function(){
	var ajax_url = generalObj.ajax_url;
	var check_endslot_status = generalObj.endslot_status;
	var selected_slot = $(this).val();
	var selected_date = $(".rzvy_date_selection.active_selected_date").data("day");
	if(selected_slot != "" && selected_date != "" && check_endslot_status == "Y"){
		$.ajax({
			type: 'post',
			data: {
				'selected_date': selected_date,
				'selected_slot': selected_slot,
				'get_endtime_slots': 1
			},
			url: ajax_url + "rzvy_front_stepview_ajax.php",
			success: function (res) {
				$("#rzvy_end_slot").html(res);
				$('#rzvy_end_slot').selectpicker('refresh');
				$('#rzvy_end_slot').selectpicker('val', $(".rzvy_endtime_slots_selection:first").val());
				$("#rzvy_end_slot").trigger("change");
				$(".rzvy_end_slot_div").show();
			}
		});
	}else{
		$.ajax({
			type: 'post',
			data: {
				'selected_date': selected_date,
				'selected_startslot': selected_slot,
				'add_selected_slot_withendslot': 1
			},
			url: ajax_url + "rzvy_front_stepview_ajax.php",
			success: function (res) {
			}
		});
	}
});

/** JS to add slots **/
$(document).on("change", "#rzvy_end_slot", function(){
	var ajax_url = generalObj.ajax_url;
	var selected_endslot = $(this).val();
	var selected_startslot = $("#rzvy_start_slot").val();
	var selected_date = $(".rzvy_date_selection.active_selected_date").data("day");
	if(selected_endslot != "" && selected_startslot != "" && selected_date != ""){
		$.ajax({
			type: 'post',
			data: {
				'selected_date': selected_date,
				'selected_startslot': selected_startslot,
				'selected_endslot': selected_endslot,
				'add_selected_slot': 1
			},
			url: ajax_url + "rzvy_front_stepview_ajax.php",
			success: function (res) {
			}
		});
	}
});

/** Check location JS **/
$(document).on('click', '#rzvy_location_check_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var siteurl = generalObj.site_url;
	var zipcode = $("#rzvy_ls_input_keyword").val();
	var zip_pattern = /^[a-zA-Z 0-9\-]*$/;
	
	if(zipcode != "" && zipcode !== null){
		if(zipcode.match(zip_pattern)){
			$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
			$.ajax({
				type: 'post',
				data: {
					'zipcode': zipcode,
					'check_zip_location': 1
				},
				url: ajaxurl + "rzvy_location_selector_ajax.php",
				success: function (res) {
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					if(res=="available"){
						$("#rzvy_user_zip").val(zipcode);
						$("#rzvy_guest_zip").val(zipcode);
						swal(langObj.available_our_service_available_at_your_location, "", "success");
						$("#rzvy-location-selector-modal").modal("hide");
					}else{
						swal(langObj.opps_we_are_not_available_at_your_location, "", "error");
					}
				}
			});
		}else{
			swal(langObj.please_enter_valid_zipcode, "", "error");
		}
	}else{
		swal(langObj.please_enter_valid_zipcode, "", "error");
	}
});

/** JS to show available coupons **/
$(document).on("click", ".rzvy-coupon-radio", function(){
	var ajax_url = generalObj.ajax_url;
	var id = $(this).val();
	var coupon_code = $(this).data("promo");
	$(".rzvy-available-coupons-list").removeClass("rzvy-coupon-radio-checked");
	$("#rzvy-coupon-radio-"+id).parent().addClass("rzvy-coupon-radio-checked");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'apply_coupon': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) {
			if(res=="available"){
				$("#rzvy-available-coupons-modal").modal("hide");
				$(".rzvy_remove_applied_coupon").attr('data-id', id);
				$(".rzvy_applied_coupon_badge").html('<i class="fa fa-ticket"></i> '+coupon_code);
				$(".rzvy_remove_applied_coupon").show();
				$(".rzvy_applied_coupon_div").show();
				swal(langObj.applied_promo_applied_successfully, "", "success");
				$.ajax({
					type: 'post',
					data: {
						'refresh_cart_sidebar': 1
					},
					url: ajax_url + "rzvy_front_stepview_ajax.php",
					success: function (response) {
						$("#rzvy_refresh_cart").html(response);
					}
				});
			}else{
				swal(langObj.opps_something_went_wrong_please_try_again, "", "error");
			}
		}
	});
});

/** JS to revert coupon **/
$(document).on("click", ".rzvy_remove_applied_coupon", function(){
	var ajax_url = generalObj.ajax_url;
	var id = $(this).data("id");
	if(id!=""){
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'remove_applied_coupon': 1
			},
			url: ajax_url + "rzvy_front_stepview_ajax.php",
			success: function (res) {
				$(".rzvy_remove_applied_coupon").attr('data-id', "");
				$(".rzvy_applied_coupon_badge").html('');
				$(".rzvy-available-coupons-list").removeClass("rzvy-coupon-radio-checked");
				$(".rzvy-coupon-radio").prop("checked", false);
				$(".rzvy_remove_applied_coupon").hide();
				$(".rzvy_applied_coupon_div").hide();

				$.ajax({
					type: 'post',
					data: {
						'refresh_cart_sidebar': 1
					},
					url: ajax_url + "rzvy_front_stepview_ajax.php",
					success: function (response) {
						$("#rzvy_refresh_cart").html(response);
					}
				});
			}
		});
	}
});

/** JS to show available coupons in modal **/
$(document).on("click", "#rzvy-available-coupons-open-modal", function(){
	var ajax_url = generalObj.ajax_url;
	if($("#rzvy-guest-user").prop("checked") || $("#rzvy-user-forget-password").prop("checked")){
		swal(langObj.opps_please_book_your_appointment_as_new_or_existing_customer, "", "error");
	}else{
		$.ajax({
			type: 'post',
			data: {
				'get_available_coupons': 1
			},
			url: ajax_url + "rzvy_front_ajax.php",
			success: function (res) {
				$(".rzvy_avail_promo_modal_body").html(res);
				$("#rzvy-available-coupons-modal").modal("show");
			}
		});
	}
});

/** swal to apply referral discount coupon **/
$(document).on("click", "#rzvy_apply_referral_coupon", function(){
	var ajax_url = generalObj.ajax_url;
	swal({
		title: langObj.enter_your_referral_discount_coupon_code,
		text: "",
		type: "input",
		showCancelButton: true,
		closeOnConfirm: false,
		animation: "slide-from-bottom",
		confirmButtonText: langObj.apply,
		cancelButtonText: langObj.cancel,
		inputPlaceholder: langObj.enter_discount_coupon
	}, function (ref_discount_coupon) {
		if(ref_discount_coupon){
			if(ref_discount_coupon != ""){
				ref_discount_coupon = ref_discount_coupon.toUpperCase();
				$.ajax({
					type: 'post',
					data: {
						'ref_discount_coupon': ref_discount_coupon,
						'apply_referral_discount': 1
					},
					url: ajax_url + "rzvy_front_stepview_ajax.php",
					success: function (res) {
						if(res == "notexist"){
							$(".rzvy_applied_referral_coupon_code").html("");
							$(".rzvy_applied_referral_coupon_div_text").hide();
							$(".rzvy_apply_referral_coupon_div").show();
							swal(langObj.please_enter_valid_referral_discount_coupon, "", "error");
						}else if(res == "used"){
							$(".rzvy_applied_referral_coupon_code").html("");
							$(".rzvy_applied_referral_coupon_div_text").hide();
							$(".rzvy_apply_referral_coupon_div").show();
							swal(langObj.referral_discount_coupon_already_used, "", "error");
						}else if(res == "applied"){
							$(".rzvy_applied_referral_coupon_code").html(ref_discount_coupon);
							$(".rzvy_applied_referral_coupon_div_text").show();
							$(".rzvy_apply_referral_coupon_div").hide();
							swal(langObj.applied_referral_discount_coupon_applied_successfully, "", "success");
							$.ajax({
								type: 'post',
								data: {
									'refresh_cart_sidebar': 1
								},
								url: ajax_url + "rzvy_front_stepview_ajax.php",
								success: function (response) {
									$("#rzvy_refresh_cart").html(response);
								}
							});
						}else {
							$(".rzvy_applied_referral_coupon_code").html("");
							$(".rzvy_applied_referral_coupon_div_text").hide();
							$(".rzvy_apply_referral_coupon_div").show();
							swal(langObj.opps_something_went_wrong_please_try_again, "", "error");
						}
					}
				});
			}else{
				swal(langObj.please_enter_referral_discount_coupon_code, "", "error");
			}
		}
	});
});

/** JS to get Fourth box with customer detail **/
$(document).on("click", "#rzvy-get-fourth-next-box-btn", function(){
	var ajax_url = generalObj.ajax_url;
	$.ajax({
		type: 'post',
		data: {
			'get_fourth_step_box': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) {
			/** To Enable Disable Menus START **/
			$('#rzvy_main_wizard a[data-toggle="tab"]').removeClass('active');
			$('#rzvy_main_wizard a[data-toggle="tab"]').addClass('disabled');
			$('.rzvy-fourth-step-tab').removeClass('disabled');
			$('.rzvy-fourth-step-tab').addClass('active');
			$(".rzvy-steps").removeClass("active");
			$(".rzvy-steps").removeClass("fade");
			$(".rzvy-steps").removeClass("show");
			$("#rzvy-fourth-step").addClass("fade show active");
			/** To Enable Disable Menus END **/
			
			$("#rzvy-fourth-step").html(res);
			
			/** stripe check **/
			var stripe_status = generalObj.stripe_status;
			if(stripe_status == "Y"){
				var stripe_pkey = generalObj.stripe_pkey;
				if(stripe_pkey != ""){
					/* Create a Stripe client. */
					rzvy_stripe = Stripe(stripe_pkey);

					/* Create an instance of Elements. */
					var rzvy_stripe_elements = rzvy_stripe.elements();

					/* Custom styling can be passed to options when creating an Element. */
					var rzvy_stripe_plan_style = {
						base: {
							color: '#32325d',
							lineHeight: '18px',
							fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
							fontSmoothing: 'antialiased',
							fontSize: '16px',
							'::placeholder': {
								color: '#aab7c4'
							}
						},
						invalid: {
							color: '#fa755a',
							iconColor: '#fa755a'
						}
					};

					/* Create an instance of the card Element. */
					rzvy_stripe_plan_card = rzvy_stripe_elements.create('card', {style: rzvy_stripe_plan_style});

					/* Add an instance of the card Element. */
					rzvy_stripe_plan_card.mount('#rzvy_stripe_plan_card_errors');
				}
			}
				
			/** two checkout configuration **/
			var twocheckout_status = generalObj.twocheckout_status;
			if(twocheckout_status == 'Y'){
				$(function(){ TCO.loadPubKey('sandbox'); });
			}
		}
	});
});

/** JS to apply referral code on frontend **/
$(document).on("click", "#rzvy_apply_referral_code_btn", function(){
	var ajax_url = generalObj.ajax_url;
	var referral_code = $("#rzvy_referral_code").val().toUpperCase();
	var email = $("#rzvy_user_email").val();
	
	if(referral_code.length==15){
		if(email != "" && ($(".rzvy-user-selection:checked").val() == "ec" || $(".rzvy-user-selection:checked").val() == "nc")){
			$.ajax({
				type: 'post',
				data: {
					'email': email,
					'referral_code': referral_code,
					'apply_referral_code': 1
				},
				url: ajax_url + "rzvy_front_ajax.php",
				success: function (res) {
					if(res == "applied"){
						$(".rzvy_referral_code_div").hide();
						$(".rzvy_referral_code_applied_div").show();
						$(".rzvy_referral_code_applied_text").html(referral_code);
						swal(langObj.referral_code_applied_successfully, "", "success");
					}else if(res == "owncode"){
						$(".rzvy_referral_code_div").show();
						$(".rzvy_referral_code_applied_div").hide();
						$(".rzvy_referral_code_applied_text").html("");
						swal(langObj.you_cannot_use_your_own_referral_code, "", "error");
					}else if(res == "onfirstbookingonly"){
						$(".rzvy_referral_code_div").show();
						$(".rzvy_referral_code_applied_div").hide();
						$(".rzvy_referral_code_applied_text").html("");
						swal(langObj.you_can_apply_referral_code_only_on_first_booking, "", "error");
					}else if(res == "notexist"){
						$(".rzvy_referral_code_div").show();
						$(".rzvy_referral_code_applied_div").hide();
						$(".rzvy_referral_code_applied_text").html("");
						swal(langObj.opps_youve_entered_incorrect_referral_code, "", "error");
					}else{
						$(".rzvy_referral_code_div").show();
						$(".rzvy_referral_code_applied_div").hide();
						$(".rzvy_referral_code_applied_text").html("");
						swal(langObj.opps_something_went_wrong_please_try_again, "", "error");
					}
				}
			});
		}else{
			$.ajax({
				type: 'post',
				data: {
					'remove_referral_code': 1
				},
				url: ajax_url + "rzvy_front_ajax.php",
				success: function (res) {
					$(".rzvy_referral_code_div").show();
					$(".rzvy_referral_code_applied_div").hide();
					$(".rzvy_referral_code_applied_text").html("");
					swal(langObj.please_register_or_login_to_use_referral_code_feature, "", "error");
				}
			});
		}
	}else if(referral_code.length>1){
		swal(langObj.please_enter_15_characters_long_referral_code, "", "error");
	}
});

/** JS to book an appointment **/
$(document).on("click", "#rzvy_book_appointment_btn", function(){
	var ajax_url = generalObj.ajax_url;
	var ty_page = generalObj.ty_link;
	
	/** Check for location **/
	var location_zipcode = "";
	if($(".rzvy-user-selection:checked").val() == "ec" || $(".rzvy-user-selection:checked").val() == "nc"){
		location_zipcode = $("#rzvy_user_zip").val();
	}else if($(".rzvy-user-selection:checked").val() == "gc"){
		location_zipcode = $("#rzvy_guest_zip").val();
	}
	if(location_zipcode != ""){
		$.ajax({
			type: 'post',
			data: {
				'zipcode': location_zipcode,
				'check_zip_location': 1
			},
			url: ajax_url + "rzvy_location_selector_ajax.php",
			success: function (res) {
				if(res!="available"){
					swal(langObj.opps_we_are_not_available_at_your_location, "", "error");
					$("#rzvy-location-selector-modal").modal("show");
				}else{
					/*** Booking code START ***/
					var user_selection = $(".rzvy-user-selection:checked").val();
					if(user_selection == "ec"){
						if($("#rzvy_login_btn").is(":visible")){
							$("#rzvy_login_btn").trigger("click");
							swal(langObj.please_login_to_book_an_appointment, "", "error");
						}else{
							if($("#rzvy_user_detail_form").valid()){
								if($(".rzvy-tc-control-input").prop("checked")){
									
									/** book existing customer appointment **/
									var email = $("#rzvy_user_email").val();
									var password = $("#rzvy_user_password").val();
									var firstname = $("#rzvy_user_firstname").val();
									var lastname = $("#rzvy_user_lastname").val();
									var zip = $("#rzvy_user_zip").val();
									if(formfieldsObj.en_ff_phone_status == "Y"){
										var phone = $("#rzvy_user_phone").intlTelInput("getNumber");
									}else{
										var phone = $("#rzvy_user_phone").val();
									}
									var address = $("#rzvy_user_address").val();
									var city = $("#rzvy_user_city").val();
									var state = $("#rzvy_user_state").val();
									var country = $("#rzvy_user_country").val();
									var payment_method = $(".rzvy-payment-method-check:checked").val();
		
									if(payment_method == "paypal"){
										rzvy_paypal_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page);
									}else if(payment_method == "stripe"){
										var stripe_pkey = generalObj.stripe_pkey;
										if(stripe_pkey != ""){
											rzvy_stripe.createToken(rzvy_stripe_plan_card).then(function(result) {
												if (result.error) {
													/* Inform the user if there was an error. */
													$(".rzvy_main_loader").addClass("rzvy_hide_loader");
													$("#rzvy_stripe_plan_card_errors").html(result.error.message);
												} else {
													/* Send the token via ajax */
													var token = result.token.id;
													rzvy_stripe_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, token);
												}
											});
										}else{
											swal(langObj.opps, langObj.please_contact_business_admin_to_set_payment_accounts_credentials, "error");
										}
									}else if(payment_method == "authorize.net"){
										var cardnumber = $("#rzvy-cardnumber").val();
										var cardcvv = $("#rzvy-cardcvv").val();
										var cardexmonth = $("#rzvy-cardexmonth").val();
										var cardexyear = $("#rzvy-cardexyear").val();
										var cardholdername = $("#rzvy-cardholdername").val();
										
										var cdetail_valid = $.payment.validateCardNumber(cardnumber);
										if (!cdetail_valid) {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											swal(langObj.opps_your_card_number_is_not_valid, "", "error");
											return false;
										}else{
											var ymdetail_valid = $.payment.validateCardExpiry(cardexmonth, cardexyear);
											if (!ymdetail_valid) {
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												swal(langObj.opps_your_card_expiry_is_not_valid, "", "error");
												return false;
											}else{
												var cvvdetail_valid = $.payment.validateCardCVC(cardcvv);
												if (!cvvdetail_valid) {
													$(".rzvy_main_loader").addClass("rzvy_hide_loader");
													swal(langObj.opps_your_cvv_is_not_valid, "", "error");
													return false;
												}else{
													if(cardholdername == ""){
														$(".rzvy_main_loader").addClass("rzvy_hide_loader");
														swal(langObj.please_enter_card_holder_name, "", "error");
														return false;
													}
												}
											}
										}
										cardnumber = cardnumber.replace(/\s+/g, '');
										
										rzvy_authorizenet_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, cardnumber, cardcvv, cardexmonth, cardexyear, cardholdername);
									
									}else if(payment_method == "2checkout"){
										
										var cardnumber = $("#rzvy-cardnumber").val();
										var cardcvv = $("#rzvy-cardcvv").val();
										var cardexmonth = $("#rzvy-cardexmonth").val();
										var cardexyear = $("#rzvy-cardexyear").val();
										var cardholdername = $("#rzvy-cardholdername").val();
										
										var cdetail_valid = $.payment.validateCardNumber(cardnumber);
										if (!cdetail_valid) {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											swal(langObj.opps_your_card_number_is_not_valid, "", "error");
											return false;
										}else{
											var ymdetail_valid = $.payment.validateCardExpiry(cardexmonth, cardexyear);
											if (!ymdetail_valid) {
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												swal(langObj.opps_your_card_expiry_is_not_valid, "", "error");
												return false;
											}else{
												var cvvdetail_valid = $.payment.validateCardCVC(cardcvv);
												if (!cvvdetail_valid) {
													$(".rzvy_main_loader").addClass("rzvy_hide_loader");
													swal(langObj.opps_your_cvv_is_not_valid, "", "error");
													return false;
												}else{
													if(cardholdername == ""){
														$(".rzvy_main_loader").addClass("rzvy_hide_loader");
														swal(langObj.please_enter_card_holder_name, "", "error");
														return false;
													}
												}
											}
										}
										cardnumber = cardnumber.replace(/\s+/g, '');
										
										var twocheckout_sid = generalObj.twocheckout_sid;
										var twocheckout_pkey = generalObj.twocheckout_pkey;
										/*  Called when token created successfully. */
										function successCallback(data) {
											/* Set the token as the value for the token input */
											var token = data.response.token.token;
											rzvy_2checkout_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, token);
										};

										/*  Called when token creation fails. */
										function errorCallback(data) {
											if (data.errorCode === 200) {
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												tokenRequest();
											} else {
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												swal(data.errorMsg, "", "error");
											}
										};

										function tokenRequest() {
											/* Setup token request arguments */
											var args = {
												sellerId: twocheckout_sid,
												publishableKey: twocheckout_pkey,
												ccNo: $("#rzvy-cardnumber").val(),
												cvv: $("#rzvy-cardcvv").val(),
												expMonth: $("#rzvy-cardexmonth").val(),
												expYear: $("#rzvy-cardexyear").val()
											};
											/* Make the token request */
											TCO.requestToken(successCallback, errorCallback, args);
										};

										tokenRequest();
									}else{
										payment_method = "pay-at-venue";
										rzvy_pay_at_venue_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page);
									}
								}else{
									swal(langObj.please_accept_our_terms_conditions, "", "error");
								}
							}
						}
					} else if(user_selection == "nc"){
						if($("#rzvy_user_detail_form").valid()){
							if($(".rzvy-tc-control-input").prop("checked")){
								/** book new customer appointment **/
								var email = $("#rzvy_user_email").val();
								var password = $("#rzvy_user_password").val();
								var firstname = $("#rzvy_user_firstname").val();
								var lastname = $("#rzvy_user_lastname").val();
								var zip = $("#rzvy_user_zip").val();
								if(formfieldsObj.en_ff_phone_status == "Y"){
									var phone = $("#rzvy_user_phone").intlTelInput("getNumber");
								}else{
									var phone = $("#rzvy_user_phone").val();
								}
								var address = $("#rzvy_user_address").val();
								var city = $("#rzvy_user_city").val();
								var state = $("#rzvy_user_state").val();
								var country = $("#rzvy_user_country").val();
								var payment_method = $(".rzvy-payment-method-check:checked").val();
								
								if(payment_method == "paypal"){
									rzvy_paypal_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page);
								}else if(payment_method == "stripe"){
									var stripe_pkey = generalObj.stripe_pkey;
									if(stripe_pkey != ""){
										rzvy_stripe.createToken(rzvy_stripe_plan_card).then(function(result) {
											if (result.error) {
												/* Inform the user if there was an error. */
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												$("#rzvy_stripe_plan_card_errors").html(result.error.message);
											} else {
												/* Send the token via ajax */
												var token = result.token.id;
												rzvy_stripe_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, token);
											}
										});
									}else{
										swal(langObj.opps, langObj.please_contact_business_admin_to_set_payment_accounts_credentials, "error");
									}
								}else if(payment_method == "authorize.net"){
									var cardnumber = $("#rzvy-cardnumber").val();
									var cardcvv = $("#rzvy-cardcvv").val();
									var cardexmonth = $("#rzvy-cardexmonth").val();
									var cardexyear = $("#rzvy-cardexyear").val();
									var cardholdername = $("#rzvy-cardholdername").val();
									
									var cdetail_valid = $.payment.validateCardNumber(cardnumber);
									if (!cdetail_valid) {
										$(".rzvy_main_loader").addClass("rzvy_hide_loader");
										swal(langObj.opps_your_card_number_is_not_valid, "", "error");
										return false;
									}else{
										var ymdetail_valid = $.payment.validateCardExpiry(cardexmonth, cardexyear);
										if (!ymdetail_valid) {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											swal(langObj.opps_your_card_expiry_is_not_valid, "", "error");
											return false;
										}else{
											var cvvdetail_valid = $.payment.validateCardCVC(cardcvv);
											if (!cvvdetail_valid) {
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												swal(langObj.opps_your_cvv_is_not_valid, "", "error");
												return false;
											}else{
												if(cardholdername == ""){
													$(".rzvy_main_loader").addClass("rzvy_hide_loader");
													swal(langObj.please_enter_card_holder_name, "", "error");
													return false;
												}
											}
										}
									}
									cardnumber = cardnumber.replace(/\s+/g, '');
									
									rzvy_authorizenet_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, cardnumber, cardcvv, cardexmonth, cardexyear, cardholdername);
								}else if(payment_method == "2checkout"){
									
									var cardnumber = $("#rzvy-cardnumber").val();
									var cardcvv = $("#rzvy-cardcvv").val();
									var cardexmonth = $("#rzvy-cardexmonth").val();
									var cardexyear = $("#rzvy-cardexyear").val();
									var cardholdername = $("#rzvy-cardholdername").val();
									
									var cdetail_valid = $.payment.validateCardNumber(cardnumber);
									if (!cdetail_valid) {
										$(".rzvy_main_loader").addClass("rzvy_hide_loader");
										swal(langObj.opps_your_card_number_is_not_valid, "", "error");
										return false;
									}else{
										var ymdetail_valid = $.payment.validateCardExpiry(cardexmonth, cardexyear);
										if (!ymdetail_valid) {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											swal(langObj.opps_your_card_expiry_is_not_valid, "", "error");
											return false;
										}else{
											var cvvdetail_valid = $.payment.validateCardCVC(cardcvv);
											if (!cvvdetail_valid) {
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												swal(langObj.opps_your_cvv_is_not_valid, "", "error");
												return false;
											}else{
												if(cardholdername == ""){
													$(".rzvy_main_loader").addClass("rzvy_hide_loader");
													swal(langObj.please_enter_card_holder_name, "", "error");
													return false;
												}
											}
										}
									}
									cardnumber = cardnumber.replace(/\s+/g, '');
									
									var twocheckout_sid = generalObj.twocheckout_sid;
									var twocheckout_pkey = generalObj.twocheckout_pkey;
									/*  Called when token created successfully. */
									function successCallback(data) {
										/* Set the token as the value for the token input */
										var token = data.response.token.token;
										rzvy_2checkout_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, token);
									};

									/*  Called when token creation fails. */
									function errorCallback(data) {
										if (data.errorCode === 200) {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											tokenRequest();
										} else {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											swal(data.errorMsg, "", "error");
										}
									};

									function tokenRequest() {
										/* Setup token request arguments */
										var args = {
											sellerId: twocheckout_sid,
											publishableKey: twocheckout_pkey,
											ccNo: $("#rzvy-cardnumber").val(),
											cvv: $("#rzvy-cardcvv").val(),
											expMonth: $("#rzvy-cardexmonth").val(),
											expYear: $("#rzvy-cardexyear").val()
										};
										/* Make the token request */
										TCO.requestToken(successCallback, errorCallback, args);
									};

									tokenRequest();
								}else{
									payment_method = "pay-at-venue";
									rzvy_pay_at_venue_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page);
								}
							}else{
								swal(langObj.please_accept_our_terms_conditions, "", "error");
							}
						}
					} else if(user_selection == "gc"){
						if($("#rzvy_guestuser_detail_form").valid()){
							if($(".rzvy-tc-control-input").prop("checked")){
								/** book guest customer appointment **/
								var email = $("#rzvy_guest_email").val();
								var password = "";
								var firstname = $("#rzvy_guest_firstname").val();
								var lastname = $("#rzvy_guest_lastname").val();
								var zip = $("#rzvy_guest_zip").val();
								if(formfieldsObj.g_ff_phone_status == "Y"){
									var phone = $("#rzvy_guest_phone").intlTelInput("getNumber");
								}else{
									var phone = $("#rzvy_guest_phone").val();
								}
								var address = $("#rzvy_guest_address").val();
								var city = $("#rzvy_guest_city").val();
								var state = $("#rzvy_guest_state").val();
								var country = $("#rzvy_guest_country").val();
								var payment_method = $(".rzvy-payment-method-check:checked").val();

								if(payment_method == "paypal"){
									rzvy_paypal_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page);
								}else if(payment_method == "stripe"){
									var stripe_pkey = generalObj.stripe_pkey;
									if(stripe_pkey != ""){
										rzvy_stripe.createToken(rzvy_stripe_plan_card).then(function(result) {
											if (result.error) {
												/* Inform the user if there was an error. */
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												$("#rzvy_stripe_plan_card_errors").html(result.error.message);
											} else {
												/* Send the token via ajax */
												var token = result.token.id;
												rzvy_stripe_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, token);
											}
										});
									}else{
										swal(langObj.opps, langObj.please_contact_business_admin_to_set_payment_accounts_credentials, "error");
									}
								}else if(payment_method == "authorize.net"){
									var cardnumber = $("#rzvy-cardnumber").val();
									var cardcvv = $("#rzvy-cardcvv").val();
									var cardexmonth = $("#rzvy-cardexmonth").val();
									var cardexyear = $("#rzvy-cardexyear").val();
									var cardholdername = $("#rzvy-cardholdername").val();
									
									var cdetail_valid = $.payment.validateCardNumber(cardnumber);
									if (!cdetail_valid) {
										$(".rzvy_main_loader").addClass("rzvy_hide_loader");
										swal(langObj.opps_your_card_number_is_not_valid, "", "error");
										return false;
									}else{
										var ymdetail_valid = $.payment.validateCardExpiry(cardexmonth, cardexyear);
										if (!ymdetail_valid) {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											swal(langObj.opps_your_card_expiry_is_not_valid, "", "error");
											return false;
										}else{
											var cvvdetail_valid = $.payment.validateCardCVC(cardcvv);
											if (!cvvdetail_valid) {
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												swal(langObj.opps_your_cvv_is_not_valid, "", "error");
												return false;
											}else{
												if(cardholdername == ""){
													$(".rzvy_main_loader").addClass("rzvy_hide_loader");
													swal(langObj.please_enter_card_holder_name, "", "error");
													return false;
												}
											}
										}
									}
									cardnumber = cardnumber.replace(/\s+/g, '');
									
									rzvy_authorizenet_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, cardnumber, cardcvv, cardexmonth, cardexyear, cardholdername);

								}else if(payment_method == "2checkout"){
									
									var cardnumber = $("#rzvy-cardnumber").val();
									var cardcvv = $("#rzvy-cardcvv").val();
									var cardexmonth = $("#rzvy-cardexmonth").val();
									var cardexyear = $("#rzvy-cardexyear").val();
									var cardholdername = $("#rzvy-cardholdername").val();
									
									var cdetail_valid = $.payment.validateCardNumber(cardnumber);
									if (!cdetail_valid) {
										$(".rzvy_main_loader").addClass("rzvy_hide_loader");
										swal(langObj.opps_your_card_number_is_not_valid, "", "error");
										return false;
									}else{
										var ymdetail_valid = $.payment.validateCardExpiry(cardexmonth, cardexyear);
										if (!ymdetail_valid) {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											swal(langObj.opps_your_card_expiry_is_not_valid, "", "error");
											return false;
										}else{
											var cvvdetail_valid = $.payment.validateCardCVC(cardcvv);
											if (!cvvdetail_valid) {
												$(".rzvy_main_loader").addClass("rzvy_hide_loader");
												swal(langObj.opps_your_cvv_is_not_valid, "", "error");
												return false;
											}else{
												if(cardholdername == ""){
													$(".rzvy_main_loader").addClass("rzvy_hide_loader");
													swal(langObj.please_enter_card_holder_name, "", "error");
													return false;
												}
											}
										}
									}
									cardnumber = cardnumber.replace(/\s+/g, '');
									
									var twocheckout_sid = generalObj.twocheckout_sid;
									var twocheckout_pkey = generalObj.twocheckout_pkey;
									/*  Called when token created successfully. */
									function successCallback(data) {
										/* Set the token as the value for the token input */
										var token = data.response.token.token;
										rzvy_2checkout_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, token);
									};

									/*  Called when token creation fails. */
									function errorCallback(data) {
										if (data.errorCode === 200) {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											tokenRequest();
										} else {
											$(".rzvy_main_loader").addClass("rzvy_hide_loader");
											swal(data.errorMsg, "", "error");
										}
									};

									function tokenRequest() {
										/* Setup token request arguments */
										var args = {
											sellerId: twocheckout_sid,
											publishableKey: twocheckout_pkey,
											ccNo: $("#rzvy-cardnumber").val(),
											cvv: $("#rzvy-cardcvv").val(),
											expMonth: $("#rzvy-cardexmonth").val(),
											expYear: $("#rzvy-cardexyear").val()
										};
										/* Make the token request */
										TCO.requestToken(successCallback, errorCallback, args);
									};

									tokenRequest();
								}else{
									payment_method = "pay-at-venue";
									rzvy_pay_at_venue_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page);
								}
							}else{
								swal(langObj.please_accept_our_terms_conditions, "", "error");
							}
						}
					}	
					/*** Booking code END ***/
				}
			}
		});
	}else{
		swal(langObj.opps_please_check_for_services_available_at_your_location_or_not, "", "error");
		$("#rzvy-location-selector-modal").modal("show");
		return false;
	}
});

function rzvy_pay_at_venue_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'email': email,
			'password': password,
			'firstname': firstname,
			'lastname': lastname,
			'zip': zip,
			'phone': phone,
			'address': address,
			'city': city,
			'state': state,
			'country': country,
			'payment_method': payment_method,
			'type': user_selection,
			'pay_at_venue_appointment': 1
		},
		url: ajax_url + "rzvy_front_checkout_ajax.php",
		success: function (res) {
			if(res == "BOOKED"){
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				/** To Enable Disable Menus START **/
				$('#rzvy_main_wizard a[data-toggle="tab"]').removeClass('active');
				$('#rzvy_main_wizard a[data-toggle="tab"]').addClass('disabled');
				$('.rzvy-fifth-step-tab').removeClass('disabled');
				$('.rzvy-fifth-step-tab').addClass('active');
				$(".rzvy-steps").removeClass("active");
				$(".rzvy-steps").removeClass("fade");
				$(".rzvy-steps").removeClass("show");
				$("#rzvy-fifth-step").addClass("fade show active");
				/** To Enable Disable Menus END **/
			}
		}
	});
}

function rzvy_paypal_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'email': email,
			'password': password,
			'firstname': firstname,
			'lastname': lastname,
			'zip': zip,
			'phone': phone,
			'address': address,
			'city': city,
			'state': state,
			'country': country,
			'payment_method': payment_method,
			'type': user_selection,
			'paypal_appointment': 1
		},
		url: ajax_url + "rzvy_front_checkout_ajax.php",
		success: function (res) { 
			var response_detail = $.parseJSON(res);
			if(response_detail.status=='success'){
				window.location.href = response_detail.value; 
			}
			if(response_detail.status=='error'){
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(response_detail.value, "", "error");
			}
		}
	});
}

function rzvy_authorizenet_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, cardnumber, cardcvv, cardexmonth, cardexyear, cardholdername){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'email': email,
			'password': password,
			'firstname': firstname,
			'lastname': lastname,
			'zip': zip,
			'phone': phone,
			'address': address,
			'city': city,
			'state': state,
			'country': country,
			'payment_method': payment_method,
			'type': user_selection,
			'cardnumber': cardnumber,
			'cardcvv': cardcvv,
			'cardexmonth': cardexmonth,
			'cardexyear': cardexyear,
			'cardholdername': cardholdername,
			'authorizenet_appointment': 1
		},
		url: ajax_url + "rzvy_front_checkout_ajax.php",
		success: function (res) { 
			var response_detail = $.parseJSON(res);
			if(response_detail.status==false){
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(response_detail.error, "", "error");
			} else {
				 $.ajax({
					type: "POST",
					url: ajax_url + "rzvy_front_appt_process_ajax.php",
					success:function(response){
						if(response == 'BOOKED'){
							window.location=ty_page; 
						}
					}
				});
			}
		}
	});
}

function rzvy_2checkout_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, token){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'email': email,
			'password': password,
			'firstname': firstname,
			'lastname': lastname,
			'zip': zip,
			'phone': phone,
			'address': address,
			'city': city,
			'state': state,
			'country': country,
			'payment_method': payment_method,
			'type': user_selection,
			'token': token,
			'2checkout_appointment': 1
		},
		url: ajax_url + "rzvy_front_checkout_ajax.php",
		success: function (res) { 
			var response_detail = $.parseJSON(res);
			if(response_detail.status==false){
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(response_detail.error, "", "error");
			} else {
				 $.ajax({
					type: "POST",
					url: ajax_url + "rzvy_front_appt_process_ajax.php",
					success:function(response){
						if(response == 'BOOKED'){
							window.location=ty_page; 
						}
					}
				});
			}
		}
	});
}

function rzvy_stripe_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, ty_page, token){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'email': email,
			'password': password,
			'firstname': firstname,
			'lastname': lastname,
			'zip': zip,
			'phone': phone,
			'address': address,
			'city': city,
			'state': state,
			'country': country,
			'payment_method': payment_method,
			'type': user_selection,
			'token': token,
			'stripe_appointment': 1
		},
		url: ajax_url + "rzvy_front_checkout_ajax.php",
		success: function (res) { 
			var response_detail = $.parseJSON(res);
			if(response_detail.status==false){
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(response_detail.error, "", "error");
			} else {
				 $.ajax({
					type: "POST",
					url: ajax_url + "rzvy_front_appt_process_ajax.php",
					success:function(response){
						if(response == 'BOOKED'){
							window.location=ty_page; 
						}
					}
				});
			}
		}
	});
}

/** Show hide card payemnt box JS **/
$(document).on("change", ".rzvy-payment-method-check", function(){
	if($(this).val() == "stripe" || $(this).val() == "2checkout" || $(this).val() == "authorize.net"){
		$(".rzvy-card-detail-box").slideDown(2000);
	}else{
		$(".rzvy-card-detail-box").slideUp(1000);
	}
});


/** Show hide customer detail box according selection JS **/
$(document).on("change", ".rzvy-user-selection", function(){
	if($(this).attr("id") == "rzvy-new-user"){
		$("#rzvy-guest-user-box").removeClass("rzvy_show");
		$("#rzvy-guest-user-box").slideUp(1000);
		$("#rzvy-existing-user-box").slideUp(1000);
		$("#rzvy-user-forget-password-box").slideUp(1000);
		$("#rzvy-new-user-box").slideDown(2000);
	}else if($(this).attr("id") == "rzvy-guest-user"){
		$("#rzvy_apply_referral_code_btn").trigger("click");
		$("#rzvy-guest-user-box").removeClass("rzvy_show");
		$("#rzvy-existing-user-box").slideUp(1000);
		$("#rzvy-user-forget-password-box").slideUp(1000);
		$("#rzvy-new-user-box").slideUp(1000);
		$("#rzvy-guest-user-box").slideDown(2000);
	}else if($(this).attr("id") == "rzvy-user-forget-password"){
		$("#rzvy_apply_referral_code_btn").trigger("click");
		$("#rzvy-guest-user-box").removeClass("rzvy_show");
		$("#rzvy-guest-user-box").slideUp(1000);
		$("#rzvy-existing-user-box").slideUp(1000);
		$("#rzvy-new-user-box").slideUp(2000);
		$("#rzvy-user-forget-password-box").slideDown(1000);
	}else{
		$("#rzvy-guest-user-box").removeClass("rzvy_show");
		$("#rzvy-guest-user-box").slideUp(1000);
		$("#rzvy-new-user-box").slideUp(1000);
		$("#rzvy-user-forget-password-box").slideUp(1000);
		$("#rzvy-existing-user-box").slideDown(2000);
	}
});

/** JS to make login on frontend **/
$(document).on("click", "#rzvy_login_btn", function(e){
	e.preventDefault();
	var ajax_url = generalObj.ajax_url;
	var email = $("#rzvy_login_email").val();
	var password = $("#rzvy_login_password").val();
	if($("#rzvy_login_form").valid()){
		$.ajax({
			type: 'post',
			data: {
				'email': email,
				'password': password,
				'front_login': 1
			},
			url: ajax_url + "rzvy_front_ajax.php",
			success: function (res) {
				var detail = $.parseJSON(res);
				if(detail['status'] == "success"){
					$(".rzvy_loggedin_name").html(detail['email']);
					$("#rzvy_user_email").val(detail['email']);
					$("#rzvy_user_password").val(detail['password']);
					$("#rzvy_user_firstname").val(detail['firstname']);
					$("#rzvy_user_lastname").val(detail['lastname']);
					$("#rzvy_user_zip").val(detail['zip']);
					if(formfieldsObj.en_ff_phone_status == "Y"){
						$("#rzvy_user_phone").intlTelInput("setNumber", detail['phone']);
					}else{
						$("#rzvy_user_phone").val(detail['phone']);
					}
					$("#rzvy_user_address").val(detail['address']);
					$("#rzvy_user_city").val(detail['city']);
					$("#rzvy_user_state").val(detail['state']);
					$("#rzvy_user_country").val(detail['country']);
					
					$("#rzvy-existing-user-box").hide();
					$(".rzvy-users-selection-div").hide();
					$(".rzvy_hide_after_login").hide();
					$(".rzvy-logout-div").show();
					$("#rzvy-new-user-box").show();
				}else{
					swal(langObj.opps_your_entered_email_not_registered_please_book_an_appointment_as_new_customer, "", "error");
				}
			}
		});
	}
});

/** JS to make logout on frontend **/
$(document).on("click", "#rzvy_logout_btn", function(){
	var ajax_url = generalObj.ajax_url;	
	$.ajax({
		type: 'post',
		data: {
			'front_logout': 1
		},
		url: ajax_url + "rzvy_front_ajax.php",
		success: function (res) {
			
			$(".rzvy_loggedin_name").html("");
			$("#rzvy_user_email").val("");
			$("#rzvy_user_password").val("");
			$("#rzvy_user_firstname").val("");
			$("#rzvy_user_lastname").val("");
			$("#rzvy_user_zip").val("");
			if(formfieldsObj.en_ff_phone_status == "Y"){
				$("#rzvy_user_phone").intlTelInput("setNumber", "");
			}else{
				$("#rzvy_user_phone").val("");
			}
			$("#rzvy_user_address").val("");
			$("#rzvy_user_city").val("");
			$("#rzvy_user_state").val("");
			$("#rzvy_user_country").val("");
			$("#rzvy_login_email").val("");
			$("#rzvy_login_password").val("");
			
			$("#rzvy-existing-user-box").show();
			$(".rzvy-users-selection-div").show();
			$(".rzvy_hide_after_login").show();
			$(".rzvy-logout-div").hide();
			$("#rzvy-new-user-box").hide();
		}
	});
});

$(document).on("click", ".rzvy_cal_prev_month, .rzvy_cal_next_month", function(){
	var ajax_url = generalObj.ajax_url;
	var selected_month = $(this).data("month");
	$.ajax({
		type: 'post',
		data: {
			'online': "Y",
			'selected_month': selected_month,
			'get_calendar_on_next_prev': 1
		},
		url: ajax_url + "rzvy_calendar_ajax.php",
		success: function (res) {
			$(".rzvy-inline-calendar-container").html(res);
		}
	});
});

/** JS to add single qty addons **/
$(document).on("click", ".rzvy_remove_addon_from_cart", function(){
	var ajax_url = generalObj.ajax_url;
	var id = $(this).data("id");
	var qty = 0;
	
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'qty': qty,
			'add_to_cart_item': 1
		},
		url: ajax_url + "rzvy_front_stepview_ajax.php",
		success: function (res) {
			$("#rzvy_addon_tr_"+id).remove();
			if($(".rzvy_count_addon_tr").length == 0){
				$("#rzvy_remove_addon_head").remove();
			}
			$.ajax({
				type: 'post',
				data: {
					'refresh_cart_sidebar': 1
				},
				url: ajax_url + "rzvy_front_stepview_ajax.php",
				success: function (response) {
					$("#rzvy_refresh_cart").html(response);
				}
			});
		}
	});
});