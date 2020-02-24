/*
* rzvy
* Online Multi Business Appointment Scheduling & Reservation Booking Calendar
*/
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
	
	var site_url = generalObj.site_url;
	/** JS to add intltel input to phone number **/
	if(formfieldsObj.en_ff_phone_status == "Y"){
		$("#rzvy_user_phone").intlTelInput({ initialCountry: generalObj.defaultCountryCode, separateDialCode: true, utilsScript: site_url+"includes/vendor/intl-tel-input/js/utils.js" });
	}
	if(formfieldsObj.g_ff_phone_status == "Y"){
		$("#rzvy_guest_phone").intlTelInput({ initialCountry: generalObj.defaultCountryCode, separateDialCode: true, utilsScript: site_url+"includes/vendor/intl-tel-input/js/utils.js" });
	}
	
	/** JS to load calendar **/
	var ajax_url = generalObj.ajax_url;
	$.ajax({
		type: 'post',
		data: {
			'offline': "Y",
			'get_calendar_on_load': 1
		},
		url: ajax_url + "rzvy_calendar_ajax.php",
		success: function (res) {
			$(".rzvy-inline-calendar-container").html(res);
		}
	});
	
	/** JS to get frequently discount **/
	var ajax_url = generalObj.ajax_url;
	$.ajax({
		type: 'post',
		data: {
			'get_all_frequently_discount': 1
		},
		url: ajax_url + "rzvy_mb_front_ajax.php",
		success: function (res) {
			if(res != ""){
				$("#rzvy_frequently_discount_content").html(res);
				$(".show_hide_frequently_discount").show();
			}else{
				$("#rzvy_frequently_discount_content").html("");
				$(".show_hide_frequently_discount").hide();
			}
		}
	});
	
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

});

$(document).bind("ready ajaxComplete", function(){
	var ajaxurl = generalObj.ajax_url;
    $('[data-toggle="tooltip"]').tooltip();
	
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
});

/** JS to add multiple qty addons into cart **/
$(document).on("click", ".rzvy-frequently-discount-change", function(){
	var id = $(this).val();
	var ajax_url = generalObj.ajax_url;
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'update_frequently_discount': 1
		},
		url: ajax_url + "rzvy_mb_front_ajax.php",
		success: function (res) {
			$.ajax({
				type: 'post',
				data: {
					'refresh_cart_sidebar': 1
				},
				url: ajax_url + "rzvy_mb_front_cart_ajax.php",
				success: function (response) {
					$("#rzvy_refresh_cart").html(response);
				}
			});
		}
	});
});

/** JS to add multiple qty addons into cart **/
$(document).on("click", ".rzvy-addons-multipleqty-js-counter-btn", function(){
	var id = $(this).data("id");
	var ajax_url = generalObj.ajax_url;
	if($(this).data('action') == "plus") {
		var qty = Number($('.rzvy-addons-multipleqty-unit-'+id).val()) + 1;
	}else{
		if($('.rzvy-addons-multipleqty-unit-'+id).val()>0){
			var qty = Number($('.rzvy-addons-multipleqty-unit-'+id).val()) - 1;
		}else{
			var qty = 0;
		}
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'qty': qty,
			'add_to_cart_item': 1
		},
		url: ajax_url + "rzvy_mb_front_cart_ajax.php",
		success: function (res) {
			$(".rzvy_remove_applied_coupon").trigger("click");
			$(".rzvy-frequently-discount-change:checked").trigger("click");
			$.ajax({
				type: 'post',
				data: {
					'refresh_cart_sidebar': 1
				},
				url: ajax_url + "rzvy_mb_front_cart_ajax.php",
				success: function (response) {
					$("#rzvy_refresh_cart").html(response);
					if(qty>0){
						$('.rzvy-addons-multipleqty-unit-'+id).val(qty);
						$('.rzvy-addons-multipleqty-box-'+id+' .rzvy-addons-multipleqty-box-icon').addClass("rzvy-selected-addon");
						$('.rzvy-addons-multipleqty-box-'+id+' .rzvy-addons-multipleqty-counter').addClass("rzvy-selected-addon");
						$('.rzvy-addons-multipleqty-box-'+id+' .rzvy-addons-multipleqty-counter-item-center').addClass("rzvy-selected-addon");
					}else{
						$('.rzvy-addons-multipleqty-unit-'+id).val(qty);
						$('.rzvy-addons-multipleqty-box-'+id+' .rzvy-addons-multipleqty-box-icon').removeClass("rzvy-selected-addon");
						$('.rzvy-addons-multipleqty-box-'+id+' .rzvy-addons-multipleqty-counter').removeClass("rzvy-selected-addon");
						$('.rzvy-addons-multipleqty-box-'+id+' .rzvy-addons-multipleqty-counter-item-center').removeClass("rzvy-selected-addon");
					}
				}
			});
		}
	});
});

/** JS to add single qty addons into cart **/
$(document).on("click", ".rzvy-addons-singleqty-unit-selection", function(){
	var id = $(this).val();
	var check = $(this).prop("checked");
	var ajax_url = generalObj.ajax_url;
	if(check){
		var qty = 1;
	}else{
		var qty = 0;
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'qty': qty,
			'add_to_cart_item': 1
		},
		url: ajax_url + "rzvy_mb_front_cart_ajax.php",
		success: function (res) {
			$.ajax({
				type: 'post',
				data: {
					'refresh_cart_sidebar': 1
				},
				url: ajax_url + "rzvy_mb_front_cart_ajax.php",
				success: function (response) {
					$("#rzvy_refresh_cart").html(response);
					if(qty==0){
						$('#rzvy-addons-singleqty-unit-'+id).prop("checked", false);
					}
				}
			});
		}
	});
});

/** JS to remove item from cart **/
$(document).on("click", ".rzvy_remove_addon_from_cart", function(){
	var id = $(this).data("id");
	var ajax_url = generalObj.ajax_url;
	var qty = 0;
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'qty': qty,
			'add_to_cart_item': 1
		},
		url: ajax_url + "rzvy_mb_front_cart_ajax.php",
		success: function (res) {
			$.ajax({
				type: 'post',
				data: {
					'refresh_cart_sidebar': 1
				},
				url: ajax_url + "rzvy_mb_front_cart_ajax.php",
				success: function (response) {
					$("#rzvy_refresh_cart").html(response);
					$('#rzvy-addons-singleqty-unit-'+id).prop("checked", false);
					$('.rzvy-addons-multipleqty-unit-'+id).val(qty);
					$('.rzvy-addons-multipleqty-box-'+id+' .rzvy-addons-multipleqty-box-icon').removeClass("rzvy-selected-addon");
					$('.rzvy-addons-multipleqty-box-'+id+' .rzvy-addons-multipleqty-counter').removeClass("rzvy-selected-addon");
					$('.rzvy-addons-multipleqty-box-'+id+' .rzvy-addons-multipleqty-counter-item-center').removeClass("rzvy-selected-addon");
				}
			});
		}
	});
});

/** Show hide customer detail box according selection JS **/
$(document).on("change", ".rzvy-user-selection", function(){
	if($(this).attr("id") == "rzvy-new-user"){
		$("#rzvy-guest-user-box").removeClass("rzvy_show");
		$("#rzvy-guest-user-box").slideUp(1000);
		$("#rzvy-existing-user-box").slideUp(1000);
		$("#rzvy-new-user-box").slideDown(2000);
	}else if($(this).attr("id") == "rzvy-guest-user"){
		$("#rzvy-guest-user-box").removeClass("rzvy_show");
		$("#rzvy-existing-user-box").slideUp(1000);
		$("#rzvy-new-user-box").slideUp(1000);
		$("#rzvy-guest-user-box").slideDown(2000);
	}else{
		$("#rzvy-guest-user-box").removeClass("rzvy_show");
		$("#rzvy-guest-user-box").slideUp(1000);
		$("#rzvy-new-user-box").slideUp(1000);
		$("#rzvy-existing-user-box").slideDown(2000);
	}
});

/** JS to show services according category selection **/
$(document).on("click", ".rzvy-categories-radio-change", function(){
	$("#rzvy_refresh_cart").html("<label>"+langObj.no_items_in_cart+"</label>");
	$("#rzvy_services_html_content").html("");
	$("#rzvy-staff-main").html("");
	$(".rzvy_show_hide_services").hide();
	$(".rzvy_show_hide_addons").hide();
	var ajax_url = generalObj.ajax_url;
	var id = $(this).val();
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'get_services_by_cat_id': 1
		},
		url: ajax_url + "rzvy_mb_front_ajax.php",
		success: function (res) {
			$("#rzvy_services_html_content").html(res);
			$(".rzvy_show_hide_services").show();
			
			/** Auto Trigger Service Check **/
			var single_service_status = generalObj.single_service_status;
			if(single_service_status == "Y"){
				var countservices = 0;
				$('.rzvy-services-radio-change').each(function(){		
					countservices++;
				});
				
				if(countservices==1){
					$('.rzvy-services-radio-change').trigger('click');	
					$('.rzvy_show_hide_services').hide();	
				}
			}
		}
	});
});

/** JS to show addons according services selection **/
$(document).on("click", ".rzvy-services-radio-change", function(){
	$("#rzvy_refresh_cart").html("<label>"+langObj.no_items_in_cart+"</label>");
	$("#rzvy_multipleqty_addon_html_content").html("");
	$("#rzvy_singleqty_addon_html_content").html("");
	$("#rzvy-staff-main").html("");
	$(".rzvy_show_hide_addons").hide();
	var ajax_url = generalObj.ajax_url;
	var id = $(this).val();
	
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'get_multi_and_single_qty_addons_content': 1
		},
		url: ajax_url + "rzvy_mb_front_ajax.php",
		success: function (res) {
			$("#rzvy_multi_and_single_qty_addons_content").html(res);
			$(".rzvy_reset_slot_selection").trigger("click");
			if($(".rzvy-addons-multipleqty-js-counter-value").length>0 || $(".rzvy-addons-singleqty-unit-selection").length>0){
				$(".rzvy_show_hide_addons").show();
			}else{
				$(".rzvy_show_hide_addons").hide();
			}
			rzvy_staff_according_service(ajax_url, id);
			if($(".rzvy-frequently-discount-change:checked").val() !== undefined){
				$(".rzvy-frequently-discount-change").trigger("click");
			}else{
				$.ajax({
					type: 'post',
					data: {
						'refresh_cart_sidebar': 1
					},
					url: ajax_url + "rzvy_mb_front_cart_ajax.php",
					success: function (response) {
						$("#rzvy_refresh_cart").html(response);
					}
				});
			}
		}
	});
});

/** JS to get customer detail on change **/
$(document).on("click", "#rzvy_existing_customer_selection", function(e){
	e.preventDefault();
	var ajax_url = generalObj.ajax_url;
	var id = $(this).val();
	if($.isNumeric(id) && id>0){
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'get_customer_detail': 1
			},
			url: ajax_url + "rzvy_mb_front_ajax.php",
			success: function (res) {
				var detail = $.parseJSON(res);
				if(detail['status'] == "success"){
					$(".rzvy_loggedin_name").html(detail['firstname']+" "+detail['lastname']);
					$("#rzvy_user_customer_id").val(detail['id']);
					$("#rzvy_user_email").val(detail['email']);
					$("#rzvy_user_password").val(detail['password']);
					$("#rzvy_user_firstname").val(detail['firstname']);
					$("#rzvy_user_lastname").val(detail['lastname']);
					$("#rzvy_user_zip").val(detail['zip']);
					$("#rzvy_user_phone").intlTelInput("setNumber", detail['phone']);
					$("#rzvy_user_address").val(detail['address']);
					$("#rzvy_user_city").val(detail['city']);
					$("#rzvy_user_state").val(detail['state']);
					$("#rzvy_user_country").val(detail['country']);
					
					$("#rzvy-existing-user-box").hide();
					$(".rzvy-users-selection-div").hide();
					$(".rzvy_hide_after_login").hide();
					$(".rzvy-logout-div").show();
					$("#rzvy-new-user-box").show();
					
					$(".rzvy_remove_applied_coupon").trigger("click");
				}else{
					swal(langObj.opps_your_entered_email_not_registered_please_book_an_appointment_as_new_customer, "", "error");
				}
			}
		});
	}
});

/** JS to make logout on frontend **/
$(document).on("click", "#rzvy_change_customer_btn", function(){
	$("#rzvy_existing_customer_selection").val($("#rzvy_existing_customer_selection option:first").val());
	$(".rzvy_loggedin_name").html("");
	$("#rzvy_user_customer_id").val("");
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
});

/** JS to trigger counter on click of multiple qty box **/
$(document).on("click", ".rzvy_make_multipleqty_addon_selected", function(){
	var id = $(this).data("id");
	if($(".rzvy-addons-multipleqty-unit-"+id).val()==0){
		$("#rzvy-addons-multipleqty-plus-js-counter-btn-"+id).trigger("click");
	} else if($(".rzvy-addons-multipleqty-unit-"+id).val()==1){
		$("#rzvy-addons-multipleqty-minus-js-counter-btn-"+id).trigger("click");
	} else {
		/** do nothing **/
	}
});

/** validate date **/
function rzvy_isValidDate(dateString) {
  var regEx = /^\d{4}-\d{2}-\d{2}$/;
  if(!dateString.match(regEx)) return false;  /** Invalid format **/
  var d = new Date(dateString);
  if(Number.isNaN(d.getTime())) return false; /** Invalid date **/
  return d.toISOString().slice(0,10) === dateString;
}

/** JS to book an appointment **/
$(document).on("click", "#rzvy_book_appointment_btn", function(){
	var ajax_url = generalObj.ajax_url;
	if($(".rzvy-categories-radio-change:checked").val() === undefined || $(".rzvy-services-radio-change:checked").val() === undefined){
		swal(langObj.please_add_item_in_your_cart, "", "error");
	}else{
		if($("#rzvy_fdate").val() == ""){
			swal(langObj.please_select_appointment_slot, "", "error");
		}else if($(".rzvy-staff-change:checked").val()<=0 || $(".rzvy-staff-change:checked").val() == ""){
			swal(generalObj.please_select_staff_member, "", "error");
		}else{
			if($("#rzvy_fstime").val() == ""){
				swal(langObj.please_select_appointment_slot, "", "error");
			}else if($("#rzvy_fetime").val() == "" && generalObj.endslot_status == "Y"){
				swal(langObj.please_select_appointment_slot, "", "error");
			}else{
				var user_selection = $(".rzvy-user-selection:checked").val();
				if(user_selection == "ec"){
					var customer_selection = $("#rzvy_existing_customer_selection").val();
					if($.isNumeric(customer_selection) && customer_selection>0){
						if($("#rzvy_user_detail_form").valid()){
							/** book existing customer appointment **/
							var customer_id = $("#rzvy_user_customer_id").val();
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
							var payment_method = "pay-at-venue";
							rzvy_pay_at_venue_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, customer_id);
						}
					}else{
						swal(langObj.please_select_customer_to_book_an_appointment, "", "error");
					}
				} else if(user_selection == "nc"){
					if($("#rzvy_user_detail_form").valid()){
						/** book new customer appointment **/
						var customer_id = "";
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
						var payment_method = "pay-at-venue";
						rzvy_pay_at_venue_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, customer_id);
					}
				} else if(user_selection == "gc"){
					if($("#rzvy_guestuser_detail_form").valid()){
						/** book guest customer appointment **/
						var customer_id = "";
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
						var payment_method = "pay-at-venue";
						rzvy_pay_at_venue_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, customer_id);
					}
				}
			}
		}
	}
});
function rzvy_pay_at_venue_appointment(email, password, firstname, lastname, zip, phone, address, city, state, country, payment_method, user_selection, ajax_url, customer_id){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'customer_id': customer_id,
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
		url: ajax_url + "rzvy_mb_front_checkout_ajax.php",
		success: function (res) {
			if(res == "BOOKED"){
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(langObj.booked, langObj.appointment_booked_successfully, "success");
				location.reload();
			}
		}
	});
}

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
			url: ajax_url + "rzvy_mb_front_ajax.php",
			success: function (res) {
				$("#rzvy_time_slots_selection_date").val(selected_date);
				$(".rzvy-inline-calendar-container-main").slideUp(1000);
				$(".rzvy_available_slots_block").html(res);
				$(".rzvy_available_slots_block").slideDown(1000);
			}
		});
	}
});

/** Reset available slots JS **/
$(document).on("click", ".rzvy_reset_slot_selection", function(){
	var selected_date = $(this).data("day");
	if (selected_date.length>0) {
		$(".rzvy_reset_slot_selection i").addClass("fa-spin");
		var ajax_url = generalObj.ajax_url;
		$.ajax({
			type: 'post',
			data: {
				'selected_date': selected_date,
				'get_slots': 1
			},
			url: ajax_url + "rzvy_mb_front_ajax.php",
			success: function (res) {
				$(".rzvy_available_slots_block").show();
				$(".rzvy_available_slots_block").html(res);
			}
		});
	}
});

/** JS to get end time slots **/
$(document).on("click", ".rzvy_time_slots_selection", function(){
	var ajax_url = generalObj.ajax_url;
	var check_endslot_status = generalObj.endslot_status;
	var selected_slot = $(this).val();
	var selected_date = $("#rzvy_time_slots_selection_date").val();
	if(selected_slot != "" && selected_date != "" && check_endslot_status == "Y"){
		$.ajax({
			type: 'post',
			data: {
				'selected_date': selected_date,
				'selected_slot': selected_slot,
				'get_endtime_slots': 1
			},
			url: ajax_url + "rzvy_mb_front_ajax.php",
			success: function (res) {
				$("#rzvy_time_slots_selection_starttime").val(selected_slot);
				$(".rzvy_available_slots_block").html(res);
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
			url: ajax_url + "rzvy_mb_front_ajax.php",
			success: function (res) {
				$(".rzvy_selected_slot_detail").html(res);
				$(".rzvy_selected_slot_detail").show();
				/* $(".rzvy_back_to_calendar").trigger("click"); */
				$("#rzvy_fdate").val(selected_date);
				$("#rzvy_fstime").val(selected_slot);
				/* $("#rzvy_fetime").val(selected_endslot); */
				$("#rzvy_time_slots_selection_date").val(selected_date);
				$("#rzvy_time_slots_selection_starttime").val(selected_slot);
				/* $("#rzvy_time_slots_selection_endtime").val(selected_endslot); */
				$.ajax({
					type: 'post',
					data: {
						'refresh_cart_sidebar': 1
					},
					url: ajax_url + "rzvy_mb_front_cart_ajax.php",
					success: function (response) {
						$("#rzvy_refresh_cart").html(response);
					}
				});
			}
		});
	}
});

/** JS to add slots **/
$(document).on("click", ".rzvy_endtime_slots_selection", function(){
	var ajax_url = generalObj.ajax_url;
	var selected_endslot = $(this).val();
	var selected_startslot = $("#rzvy_time_slots_selection_starttime").val();
	var selected_date = $("#rzvy_time_slots_selection_date").val();
	if(selected_endslot != "" && selected_startslot != "" && selected_date != ""){
		$.ajax({
			type: 'post',
			data: {
				'selected_date': selected_date,
				'selected_startslot': selected_startslot,
				'selected_endslot': selected_endslot,
				'add_selected_slot': 1
			},
			url: ajax_url + "rzvy_mb_front_ajax.php",
			success: function (res) {
				$(".rzvy_selected_slot_detail").html(res);
				$(".rzvy_selected_slot_detail").show();
				/* $(".rzvy_back_to_calendar").trigger("click"); */
				$("#rzvy_fdate").val(selected_date);
				$("#rzvy_fstime").val(selected_startslot);
				$("#rzvy_fetime").val(selected_endslot);
				$("#rzvy_time_slots_selection_date").val(selected_date);
				$("#rzvy_time_slots_selection_starttime").val(selected_startslot);
				$("#rzvy_time_slots_selection_endtime").val(selected_endslot);
				$.ajax({
					type: 'post',
					data: {
						'refresh_cart_sidebar': 1
					},
					url: ajax_url + "rzvy_mb_front_cart_ajax.php",
					success: function (response) {
						$("#rzvy_refresh_cart").html(response);
					}
				});
			}
		});
	}
});

/** Get available slots JS **/
$(document).on("click", ".rzvy_back_to_calendar", function(){
	$(".rzvy-inline-calendar-container-main").slideDown(1000);
	$(".rzvy_available_slots_block").slideUp(1000);
});

/** Staff according service */
function rzvy_staff_according_service(ajax_url, id){
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'get_staff_according_service': 1
		},
		url: ajax_url + "rzvy_mb_front_ajax.php",
		success: function (res) {
			$("#rzvy-staff-main").html(res);
		}
	});
}

$(document).on("click", ".rzvy_cal_prev_month, .rzvy_cal_next_month", function(){
	var ajax_url = generalObj.ajax_url;
	var selected_month = $(this).data("month");
	$.ajax({
		type: 'post',
		data: {
			'offline': "Y",
			'selected_month': selected_month,
			'get_calendar_on_next_prev': 1
		},
		url: ajax_url + "rzvy_calendar_ajax.php",
		success: function (res) {
			$(".rzvy-inline-calendar-container").html(res);
		}
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
		url: ajax_url + "rzvy_mb_front_ajax.php",
		success: function (res) {
			/** JS to load calendar **/
			$.ajax({
				type: 'post',
				data: {
					'offline': "Y",
					'get_calendar_on_load': 1
				},
				url: ajax_url + "rzvy_calendar_ajax.php",
				success: function (res) {
					$(".rzvy-inline-calendar-container").html(res);
					$(".rzvy_selected_slot_detail").html("");
					$(".rzvy_selected_slot_detail").hide();
					$("#rzvy_fdate").val("");
					$("#rzvy_fstime").val("");
					$("#rzvy_time_slots_selection_date").val("");
					$("#rzvy_time_slots_selection_starttime").val("");
					$.ajax({
						type: 'post',
						data: {
							'refresh_cart_sidebar': 1
						},
						url: ajax_url + "rzvy_mb_front_cart_ajax.php",
						success: function (response) {
							$("#rzvy_refresh_cart").html(response);
						}
					});
				}
			});
		}
	});
});