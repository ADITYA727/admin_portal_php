/*
* rzvy
* Online Multi Business Appointment Scheduling & Reservation Booking Calendar
*/
var rzvy_stripe;
var rzvy_stripe_plan_card;
/** Initialization on ready state JS **/
$(document).ready(function () {
	var ajaxurl = generalObj.ajax_url;
	var site_url = generalObj.site_url;
	
	/** JS to add intltel input to phone number **/
	$("#rzvy_profile_phone, #rzvy_company_phone").intlTelInput({
	  initialCountry: generalObj.defaultCountryCode,
      separateDialCode: true,
      utilsScript: site_url+"includes/vendor/intl-tel-input/js/utils.js",
    });
	
	$('#rzvy_rzvy_show_dropdown_languages').selectpicker('val', show_dropdown_languages);
	$('.rzvy_assign_staff').selectpicker();
	
	/** Calendar JS **/
    var curdate = generalObj.current_date;
	$('#rzvy-appointments-calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,listMonth,listYear'
		},
		buttonText: {
			today: generalObj.today,
			month: generalObj.calendar_view,
			listMonth: generalObj.month_list_view,
			listYear: generalObj.year_list_view,
		},
		defaultView: "month",
		defaultDate: curdate,
		editable: true,
		eventDrop: function(event, delta, revertFunc) {
			var selected_date = event.start.format().substring(0, 10);
			var selected_datetime = event.start.format().substring(0, 10) + " " + event.start.format().substring(11, 19);
			var d =  new Date(selected_date);
			var tdate = new Date();
			tdate.setDate(tdate.getDate() - 1);
			var curr_date = d.getDate();
			var curr_month = d.getMonth()+1;
			var curr_year = d.getFullYear();
			if(d > tdate){			
				swal({
					title: generalObj.reschedule_reason_ad,
					text: "<textarea class='form-control fullwidth' id='rs_appointment_reason' placeholder='"+generalObj.enter_reschedule_reason+"'></textarea>",
					html: true,
					showCancelButton: true,
					closeOnConfirm: false
				}, function (isRescheduled) {
					if (isRescheduled) {
						$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
						var rs_reason = $("#rs_appointment_reason").val();
						$.ajax({
							type: 'post',
							data: {
								'selected_datetime': selected_datetime,
								'order_id': event.id,
								'reason': rs_reason,
								'update_dragged_appointment': 1
							},
							url: ajaxurl + "rzvy_appointment_detail_ajax.php",
							success: function (res) {
								$(".rzvy_main_loader").addClass("rzvy_hide_loader");
								if(res=="updated"){
									$('#rzvy-appointments-calendar').fullCalendar('refetchEvents');
									swal(generalObj.rescheduled, generalObj.appointment_rescheduled_successfully, "success");
								}else{
									swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
								}
							}
						});
					}else{
						revertFunc();
					}
				});
			} else {
				swal(generalObj.opps, generalObj.you_can_not_book_on_previous_date, "error");
				revertFunc();
			}
		},
		refetch: false,
		firstDay: 1,
		eventLimit: 6,
		eventTextColor: "#FFF",
		events: ajaxurl + 'rzvy_appointments_ajax.php',
		eventRender: function (event, element) {
			element.attr('href', 'javascript:void(0);');
			element.find('.fc-title').hide();
			element.find('.fc-time').hide();
			element.find('.fc-title').before(
				$("<div class='rzvy-fc-title'>"+event.event_icon+" <span>"+event.event_status+"</span></div><hr class='rzvy-hr' />")
			);
			element.find('.fc-title').after(
				$("<div class='rzvy-fc-title'>" + event.cat_name + "</div> <div class='rzvy-fc-title'>" + event.title + "</div> <div class='rzvy-fc-title'>" + event.customer_email + "</div> <div class='rzvy-fc-title'>" + event.customer_phone + "</div> <hr class='rzvy-hr' /> <div class='rzvy-fc-title'>" + event.rating + "</div>")
			);
            element.css('padding', "5px");
			element.click(function () {
				$.ajax({
					type: 'post',
					data: {
						'order_id': event.id,
						'get_appointment_detail': 1
					},
					url: ajaxurl + "rzvy_appointment_detail_ajax.php",
					success: function (res) {
						$('.rzvy_delete_appt_btn').attr('data-id', event.id);
						$('.rzvy_appointment_detail_modal_body').html(res);
						$('#rzvy_appointment_detail_modal').modal('show');
						$('.rzvy_appointment_detail_link').trigger('click');
					}
				});
			});
		},
		/*  calendar day click show manual booking  */
		dayClick: function (date, jsEvent, view) {
			var selected_datetime = new Date(date);
			var selected_date = selected_datetime.getDate();
			var selected_month = selected_datetime.getMonth() + 1;
			var selected_year = selected_datetime.getFullYear();
			var selected_date_with_format = selected_year+"-"+selected_month+"-"+selected_date;
			
			var current_datetime = new Date();
			var current_date = current_datetime.getDate();
			var current_month = current_datetime.getMonth() + 1;
			var current_year = current_datetime.getFullYear();
			var current_date_with_format = current_year + "-" + current_month + "-" + current_date;
			
			if (new Date(selected_date_with_format).getTime() < new Date(current_date_with_format).getTime()) {
				swal(generalObj.opps, generalObj.you_can_not_book_on_previous_date, "error");
			}else{
				var new_smonth = selected_month;
				var new_sdate = selected_date;
				if(new_smonth<10){ new_smonth = "0"+new_smonth; };
				var new_date_format = selected_year + "-" + new_smonth + "-" + new_sdate;
				
				$(".rzvy_cal_next_month").data('month',selected_year + "-" + new_smonth + "-01");
				$(".rzvy_cal_next_month").trigger('click');
							
				var datetrigger = setTimeout(function(){
					$(".rzvy_date_selection").each(function(){
						if($(this).data('day')==new_date_format){
							$(".rzvy_date_selection[data-day='"+new_date_format+"']").trigger("click");
							clearInterval(datetrigger);
						}
					});
				}, 1000);
				
				/** Trigger Category On Page Load **/
				var single_category_status = generalObj.single_category_status;
				if(single_category_status == "Y"){
					var countcats = 0;
					$('.rzvy-categories-radio-change').each(function(){		
						countcats++;
					});
					if(countcats==1){
						$('.rzvy-categories-radio-change').trigger('click');	
						$('.rzvy-company-services-blocks').hide();		
					}
				}
				
				$('#rzvy_manual_booking_modal').modal("show");
			}
		}
	});
	
	/** Check for setup instruction modal **/
	if(generalObj.setup_instruction_modal_status == "Y"){
		$("#rzvy-setup-instruction-modal").modal("show");
	}
	
	/** datatables JS **/
	$("#rzvy_blockoff_list_table").DataTable({
		"order": [ 0, 'desc' ],
		bPaginate: $('#rzvy_blockoff_list_table tbody tr').length>10,
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false },
			{ bSortable: false }
		] 
	});
	
	$('#rzvy_coupons_table').DataTable( {
		stripeClasses: [ 'rzvy_datatable_strip', "" ],
		processing: true,
        serverSide: true,
        ajax: {
			dataSrc: "data",
            type: "POST",
			processData: true,
			url: ajaxurl + "rzvy_coupon_ajax.php?refresh_coupon"
        },
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false }
		]
    } ); 
	$('#rzvy_rc_payment_table').DataTable( {
		stripeClasses: [ 'rzvy_datatable_strip', "" ],
		processing: true,
        serverSide: true,
        ajax: {
			dataSrc: "data",
            type: "POST",
			processData: true,
			url: ajaxurl + "rzvy_rc_payments_ajax.php?refresh_rc_payments"
        }
    } ); 
	$('#rzvy_gc_payment_table').DataTable( {
		stripeClasses: [ 'rzvy_datatable_strip', "" ],
		processing: true,
        serverSide: true,
        ajax: {
			dataSrc: "data",
            type: "POST",
			processData: true,
			url: ajaxurl + "rzvy_gc_payments_ajax.php?refresh_gc_payments"
        }
    } ); 
	$('#rzvy_registered_customers_detail').DataTable( {
		stripeClasses: [ 'rzvy_datatable_strip', "" ],
		processing: true,
        serverSide: true,
        ajax: {
			dataSrc: "data",
            type: "POST",
			processData: true,
			url: ajaxurl + "rzvy_registered_customer_ajax.php?refresh_rc_detail"
        },
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false }
		]
    } ); 
	$('#rzvy_guest_customers_detail').DataTable( {
		stripeClasses: [ 'rzvy_datatable_strip', "" ],
		processing: true,
        serverSide: true,
        ajax: {
			dataSrc: "data",
            type: "POST",
			processData: true,
			url: ajaxurl + "rzvy_guest_customer_ajax.php?refresh_gc_detail"
        },
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false }
		]
    } ); 
	$('#rzvy_feedback_list_table').DataTable( {
		"order": [ 4, 'desc' ],
		bPaginate: $('#rzvy_feedback_list_table tbody tr').length>10,
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false }
		]
    } ); 
	$('#rzvy_categories_list_table').DataTable( {
		"order": [ 0, 'desc' ],
		bPaginate: $('#rzvy_categories_list_table tbody tr').length>10,
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false },
			{ bSortable: false }
		]
    } ); 
	$('#rzvy_support_ticket_list_table').DataTable( {
		bPaginate: $('#rzvy_support_ticket_list_table tbody tr').length>10,
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false }
		]
    } ); 
	$('#rzvy_refund_request_list_table').DataTable( {
		bPaginate: $('#rzvy_refund_request_list_table tbody tr').length>10,
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false }
		]
    } ); 
	/** Validation patterns **/
	$.validator.addMethod("pattern_name", function(value, element) {
		return this.optional(element) || /^[a-zA-Z '.']+$/.test(value);
	}, generalObj.please_enter_only_alphabets);
	$.validator.addMethod("pattern_price", function(value, element) {
		return this.optional(element) || /^[0-9]\d*(\.\d{1,2})?$/.test(value);
	}, generalObj.please_enter_only_numerics);
	
	$.validator.addMethod("pattern_phone", function(value, element) {
		return this.optional(element) || /\d+(?:[ -]*\d+)*$/.test(value);
	}, generalObj.please_enter_valid_phone_number_without_country_code);
	$.validator.addMethod("pattern_zip", function(value, element) {
		return this.optional(element) || /^[a-zA-Z 0-9\-]*$/.test(value);
	}, generalObj.please_enter_valid_zip);
	
	/** Manage categories & services local session **/
	var rzvy_pagename = window.location.pathname;
	var site_url = generalObj.site_url;
	
	/** Check categories local session **/
	$('#rzvy_services_list_table').DataTable( {
		"order": [ 0, 'desc' ],
		bPaginate: $('#rzvy_services_list_table tbody tr').length>10,
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false },
			{ bSortable: false },
			{ bSortable: false }
		]
	} ); 
	
	/** Check services local session **/
	$('#rzvy_addons_list_table').DataTable( {
		"order": [ 0, 'desc' ],
		bPaginate: $('#rzvy_services_list_table tbody tr').length>10,
		aoColumns: [
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: true },
			{ bSortable: false },
			{ bSortable: false },
			{ bSortable: false }
		]
	} ); 
	
	var rzvy_pageurl = window.location.pathname;
	
	if(rzvy_pageurl.indexOf("backend/location-selector") != -1 || rzvy_pageurl.indexOf("backend/refund") != -1 || rzvy_pageurl.indexOf("backend/email-sms-templates") != -1 || rzvy_pageurl.indexOf("backend/settings") != -1){
		$('.rzvy_text_editor_container').summernote({
			height: 200,
			tabsize: 2,
			placeholder: '<p>'+generalObj.write_something+'</p>'
		});
	}
	
	if($("#rzvy_send_email_with").val() == "MAIL"){
		$(".rzvy_show_hide_on_send_email_with_change").hide();
	}else{
		$(".rzvy_show_hide_on_send_email_with_change").show();
	}
});
/** Validation JS **/
$(document).ajaxComplete( function(){
	var site_url = generalObj.site_url;
	
	/** JS to add intltel input to phone number **/
	$("#rzvy_twilio_sender_number, #rzvy_plivo_sender_number").intlTelInput({
		initialCountry: generalObj.defaultCountryCode,
		separateDialCode: true,
		utilsScript: site_url+"includes/vendor/intl-tel-input/js/utils.js",
    });
	
	var rzvy_pageurl = window.location.pathname;
	
	if(rzvy_pageurl.indexOf("backend/location-selector") != -1 || rzvy_pageurl.indexOf("backend/refund") != -1 || rzvy_pageurl.indexOf("backend/email-sms-templates") != -1 || rzvy_pageurl.indexOf("backend/settings") != -1){
		$('.rzvy_text_editor_container').summernote({
			height: 200,
			tabsize: 2,
			placeholder: '<p>'+generalObj.write_something+'</p>'
		});
	}
});
$(document).bind('ready ajaxComplete',function(){	
	/** Validate add coupon form **/
	$('#rzvy_add_coupon_form').validate({
		rules: {
			rzvy_couponcode:{ required: true },
			rzvy_coupontype: { required:true },
			rzvy_couponvalue: { required:true, pattern_price:true },
			rzvy_couponexpiry: { required:true }
		},
		messages: {
			rzvy_couponcode:{ required: generalObj.please_enter_coupon_code },
			rzvy_coupontype: { required: generalObj.please_select_coupon_type },
			rzvy_couponvalue: { required: generalObj.please_enter_coupon_value },
			rzvy_couponexpiry: { required: generalObj.please_enter_coupon_expiry }
		}
	});
	/** Validate update coupon form **/
	$('#rzvy_update_coupon_form').validate({
		rules: {
			rzvy_update_couponcode:{ required: true },
			rzvy_update_coupontype: { required:true },
			rzvy_update_couponvalue: { required:true, pattern_price:true },
			rzvy_update_couponexpiry: { required:true }
		},
		messages: {
			rzvy_update_couponcode:{ required: generalObj.please_enter_coupon_code },
			rzvy_update_coupontype: { required: generalObj.please_select_coupon_type },
			rzvy_update_couponvalue: { required: generalObj.please_enter_coupon_value },
			rzvy_update_couponexpiry: { required: generalObj.please_enter_coupon_expiry }
		}
	});
	/** Validate update frequently discount form **/
	$('#rzvy_update_fd_form').validate({
		rules: {
			rzvy_fdlabel:{ required: true },
			rzvy_fdtype: { required:true },
			rzvy_fdvalue: { required:true, pattern_price:true },
			rzvy_fddescription: { required:true }
		},
		messages: {
			rzvy_fdlabel:{ required: generalObj.please_enter_frequently_discount_label },
			rzvy_fdtype: { required: generalObj.please_select_frequently_discount_type },
			rzvy_fdvalue: { required: generalObj.please_enter_frequently_discount_value },
			rzvy_fddescription: { required: generalObj.please_enter_frequently_discount_description }
		}
	});
	/** Validate add category form **/
	$('#rzvy_add_category_form').validate({
		rules: {
			rzvy_categoryname:{ required: true }
		},
		messages: {
			rzvy_categoryname:{ required: generalObj.please_enter_category_name }
		}
	});
	/** Validate update category form **/
	$('#rzvy_update_category_form').validate({
		rules: {
			rzvy_update_categoryname:{ required: true }
		},
		messages: {
			rzvy_update_categoryname:{ required: generalObj.please_enter_category_name }
		}
	});
	/** Validate add service form **/
	$('#rzvy_add_service_form').validate({
		rules: {
			rzvy_servicetitle:{ required: true },
			rzvy_servicerate:{ required: true, pattern_price:true },
			rzvy_serviceduration:{ required: true, number: true, min: 1, max: 1440 },
			rzvy_servicepbefore:{ required: true, number: true, min: 0, max: 1440 },
			rzvy_servicepafter:{ required: true, number: true, min: 0, max: 1440 },
			rzvy_servicedescription:{ required: true }
		},
		messages: {
			rzvy_servicetitle:{ required: generalObj.please_enter_service_title },
			rzvy_servicerate:{ required: generalObj.please_enter_service_rate },
			rzvy_serviceduration:{ required: generalObj.please_enter_service_duration, number: generalObj.enter_only_numerics, min: generalObj.please_enter_a_value_greater_than_or_equal_to_1, max: generalObj.please_enter_a_value_less_than_or_equal_to_1440 },
			rzvy_servicepbefore:{ required: generalObj.please_enter_service_padding_before, number: generalObj.enter_only_numerics, min: generalObj.please_enter_a_value_greater_than_or_equal_to_0, max: generalObj.please_enter_a_value_less_than_or_equal_to_1440 },
			rzvy_servicepafter:{ required: generalObj.please_enter_service_padding_after, number: generalObj.enter_only_numerics, min: generalObj.please_enter_a_value_greater_than_or_equal_to_0, max: generalObj.please_enter_a_value_less_than_or_equal_to_1440 },
			rzvy_servicedescription:{ required: generalObj.please_enter_service_description }
		}
	});
	/** Validate update service form **/
	$('#rzvy_update_service_form').validate({
		rules: {
			rzvy_update_servicetitle:{ required: true },
			rzvy_update_servicerate:{ required: true, pattern_price:true },
			rzvy_update_serviceduration:{ required: true, number: true, min: 1, max: 1440 },
			rzvy_update_servicepbefore:{ required: true, number: true, min: 0, max: 1440 },
			rzvy_update_servicepafter:{ required: true, number: true, min: 0, max: 1440 },
			rzvy_update_servicedescription:{ required: true }
		},
		messages: {
			rzvy_update_servicetitle:{ required: generalObj.please_enter_service_title },
			rzvy_update_servicerate:{ required: generalObj.please_enter_service_rate },
			rzvy_update_serviceduration:{ required: generalObj.please_enter_service_duration, number: generalObj.enter_only_numerics, min: generalObj.please_enter_a_value_greater_than_or_equal_to_1, max: generalObj.please_enter_a_value_less_than_or_equal_to_1440 },
			rzvy_update_servicepbefore:{ required: generalObj.please_enter_service_padding_before, number: generalObj.enter_only_numerics, min: generalObj.please_enter_a_value_greater_than_or_equal_to_0, max: generalObj.please_enter_a_value_less_than_or_equal_to_1440 },
			rzvy_update_servicepafter:{ required: generalObj.please_enter_service_padding_after, number: generalObj.enter_only_numerics, min: generalObj.please_enter_a_value_greater_than_or_equal_to_0, max: generalObj.please_enter_a_value_less_than_or_equal_to_1440 },
			rzvy_update_servicedescription:{ required: generalObj.please_enter_service_description }
		}
	});
	/** Validate add addon form **/
	$('#rzvy_add_addon_form').validate({
		rules: {
			rzvy_addonname:{ required: true },
			rzvy_addonrate:{ required: true, pattern_price:true },
			rzvy_addondescription:{ required: true }
		},
		messages: {
			rzvy_addonname:{ required: generalObj.please_enter_addon_name },
			rzvy_addonrate:{ required: generalObj.please_enter_addon_rate },
			rzvy_addondescription:{ required: generalObj.please_enter_addon_description }
		}
	});
	/** Validate update addon form **/
	$('#rzvy_update_addon_form').validate({
		rules: {
			rzvy_update_addonname:{ required: true },
			rzvy_update_addonrate:{ required: true, pattern_price:true },
			rzvy_update_addondescription:{ required: true }
		},
		messages: {
			rzvy_update_addonname:{ required: generalObj.please_enter_addon_name },
			rzvy_update_addonrate:{ required: generalObj.please_enter_addon_rate },
			rzvy_update_addondescription:{ required: generalObj.please_enter_addon_description }
		}
	});
});
/** image upload js */
function rzvy_read_uploaded_file_url(input) {
    if (input.files && input.files[0]) {
		if((input.files[0].size/1000) > 1000){
			swal(generalObj.opps, generalObj.maximum_file_upload_size_1_mb, "error");
		}else if(input.files[0].type =="image/jpeg" || input.files[0].type =="image/jpg" || input.files[0].type =="image/png"){
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#rzvy-image-upload-file-hidden').val(e.target.result);
				$('#rzvy-image-upload-file-preview').css('background-image', 'url('+e.target.result +')');
				$('#rzvy-image-upload-file-preview').hide();
				$('#rzvy-image-upload-file-preview').fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}else{
			swal(generalObj.opps, generalObj.please_select_a_valid_image_file, "error");
		}
    }
}
$(document).on('change', "#rzvy-image-upload-file", function() {
    rzvy_read_uploaded_file_url(this);
});
/** image upload js */
function rzvy_update_read_uploaded_file_url(input) {
    if (input.files && input.files[0]) {
		if((input.files[0].size/1000) > 1000){
			swal(generalObj.opps, generalObj.maximum_file_upload_size_1_mb, "error");
		}else if(input.files[0].type =="image/jpeg" || input.files[0].type =="image/jpg" || input.files[0].type =="image/png"){
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#rzvy-update-image-upload-file-hidden').val(e.target.result);
				$('#rzvy-update-image-upload-file-preview').css('background-image', 'url('+e.target.result +')');
				$('#rzvy-update-image-upload-file-preview').hide();
				$('#rzvy-update-image-upload-file-preview').fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}else{
			swal(generalObj.opps, generalObj.please_select_a_valid_image_file, "error");
		}
    }
}
$(document).on('change', "#rzvy-update-image-upload-file", function() {
    rzvy_update_read_uploaded_file_url(this);
});
function rzvy_second_read_uploaded_file_url(input) {
    if (input.files && input.files[0]) {
		if((input.files[0].size/1000) > 1000){
			swal(generalObj.opps, generalObj.maximum_file_upload_size_1_mb, "error");
		}else if(input.files[0].type =="image/jpeg" || input.files[0].type =="image/jpg" || input.files[0].type =="image/png"){
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#rzvy_seo_og_tag_image-hidden').val(e.target.result);
				$('#rzvy_seo_og_tag_image-preview').css('background-image', 'url('+e.target.result +')');
				$('#rzvy_seo_og_tag_image-preview').hide();
				$('#rzvy_seo_og_tag_image-preview').fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}else{
			swal(generalObj.opps, generalObj.please_select_a_valid_image_file, "error");
		}
    }
}
$(document).on('change', "#rzvy_seo_og_tag_image", function() {
    rzvy_second_read_uploaded_file_url(this);
});
function rzvy_third_read_uploaded_file_url(input) {
    if (input.files && input.files[0]) {
		if((input.files[0].size/1000) > 1000){
			swal(generalObj.opps, generalObj.maximum_file_upload_size_1_mb, "error");
		}else if(input.files[0].type =="image/jpeg" || input.files[0].type =="image/jpg" || input.files[0].type =="image/png"){
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#rzvy_bookingform_bg_image-hidden').val(e.target.result);
				$('#rzvy_bookingform_bg_image-preview').css('background-image', 'url('+e.target.result +')');
				$('#rzvy_bookingform_bg_image-preview').hide();
				$('#rzvy_bookingform_bg_image-preview').fadeIn(650);
			}
			reader.readAsDataURL(input.files[0]);
		}else{
			swal(generalObj.opps, generalObj.please_select_a_valid_image_file, "error");
		}
    }
}
$(document).on('change', "#rzvy_bookingform_bg_image", function() {
    rzvy_third_read_uploaded_file_url(this);
});
/** Tab view js */
$(document).on('click', '.rzvy_tab_view_nav_link', function(){
	var tabNo = $(this).data('tabno');
	$('.custom-nav-item').removeClass('active');
	$(".custom-nav-item:eq("+tabNo+")").addClass("active");
});
/** Add coupon JS **/
$(document).on('click', '.add_coupon_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var coupon_code = $('#rzvy_couponcode').val();
	var coupon_type = $('#rzvy_coupontype').val();
	var coupon_value = $('#rzvy_couponvalue').val();
	var coupon_expiry = $('#rzvy_couponexpiry').val();
	var coupon_status = $('.rzvy_couponstatus:checked').val();
	if($('#rzvy_add_coupon_form').valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'coupon_code': coupon_code,
				'coupon_type': coupon_type,
				'coupon_value': coupon_value,
				'coupon_expiry': coupon_expiry,
				'status': coupon_status,
				'add_coupon': 1
			},
			url: ajaxurl + "rzvy_coupon_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				$('#rzvy_add_coupon_modal').modal('hide');
				if(res=="added"){
					swal(generalObj.added, generalObj.coupon_added_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
				$('#rzvy_couponcode').val('');
				$('#rzvy_coupontype').val('');
				$('#rzvy_couponvalue').val('');
				$('#rzvy_couponexpiry').val('');
				$('#rzvy_coupons_table').DataTable().ajax.reload();
			}
		});
	}
});
/** Change coupon status JS **/
$(document).on('change', '.rzvy_change_coupon_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var coupon_status_check = $(this).prop('checked');
	var coupon_status_text = generalObj.disabled;
	var coupon_status = 'N';
	if(coupon_status_check){
		coupon_status_text = generalObj.enabled;
		coupon_status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'status': coupon_status,
			'change_coupon_status': 1
		},
		url: ajaxurl + "rzvy_coupon_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="changed"){
				swal(coupon_status_text+"!", generalObj.coupon_status_changed_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Change feedback status JS **/
$(document).on('change', '.rzvy_change_feedback_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var feedback_status_check = $(this).prop('checked');
	var feedback_status_text = generalObj.disabled;
	var feedback_status = 'N';
	if(feedback_status_check){
		feedback_status_text = generalObj.enabled;
		feedback_status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'status': feedback_status,
			'change_feedback_status': 1
		},
		url: ajaxurl + "rzvy_feedback_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="updated"){
				swal(feedback_status_text+"!", generalObj.feedback_status_changed_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Delete coupon JS **/
$(document).on('click', '.rzvy-delete-coupon-sweetalert', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_delete_this_coupon,
	  type: "error",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_delete_it,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'delete_coupon': 1
			},
			url: ajaxurl + "rzvy_coupon_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="deleted"){
					swal(generalObj.deleted, generalObj.coupon_deleted_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
				$('#rzvy_coupons_table').DataTable().ajax.reload();
			}
		});
	});
});
/** Update coupon modal JS **/
$(document).on('click', '.rzvy-update-couponmodal', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'update_coupon_modal': 1
		},
		url: ajaxurl + "rzvy_coupon_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('.rzvy_update_coupon_modal_body').html(res);
			$('#rzvy_update_coupon_modal').modal('show');
		}
	});
});
/** Update coupon JS **/
$(document).on('click', '.rzvy_update_coupon_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var coupon_code = $('#rzvy_update_couponcode').val();
	var coupon_type = $('#rzvy_update_coupontype').val();
	var coupon_value = $('#rzvy_update_couponvalue').val();
	var coupon_expiry = $('#rzvy_update_couponexpiry').val();
	if($('#rzvy_update_coupon_form').valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'coupon_code': coupon_code,
				'coupon_type': coupon_type,
				'coupon_value': coupon_value,
				'coupon_expiry': coupon_expiry,
				'id': id,
				'update_coupon': 1
			},
			url: ajaxurl + "rzvy_coupon_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				$('#rzvy_update_coupon_modal').modal('hide');
				if(res=="updated"){
					swal(generalObj.updated, generalObj.coupon_updated_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
				$('#rzvy_coupons_table').DataTable().ajax.reload();
			}
		});
	}
});
/** Update Frequently Discount modal JS **/
$(document).on('click', '.rzvy-update-fdmodal', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'update_fd_modal': 1
		},
		url: ajaxurl + "rzvy_frequently_discount_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('.rzvy_update_fd_modal_body').html(res);
			$('#rzvy_update_fd_modal').modal('show');
		}
	});
});
/** Update Frequently Discount JS **/
$(document).on('click', '.rzvy_update_fd_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var fd_label = $('#rzvy_fdlabel').val();
	var fd_type = $('#rzvy_fdtype').val();
	var fd_value = $('#rzvy_fdvalue').val();
	var fd_description = $('#rzvy_fddescription').val();
	if($('#rzvy_update_fd_form').valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'fd_label': fd_label,
				'fd_type': fd_type,
				'fd_value': fd_value,
				'fd_description': fd_description,
				'id': id,
				'update_frequently_discount': 1
			},
			url: ajaxurl + "rzvy_frequently_discount_ajax.php",
			success: function (res) {
				$('#rzvy_update_fd_modal').modal('hide');
				if(res=="updated"){
					swal(generalObj.updated, generalObj.frequently_discount_updated_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
				$.ajax({
					type: 'post',
					data: {
						'refresh_frequently_discount': 1
					},
					url: ajaxurl + "rzvy_frequently_discount_ajax.php",
					success: function (res) {
						$(".rzvy_main_loader").addClass("rzvy_hide_loader");
						$('.rzvy_frequently_discount_tbody').html(res);
					}
				});
			}
		});
	}
});
/** Change Frequently Discount status JS **/
$(document).on('change', '.rzvy_change_fd_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var fd_status_check = $(this).prop('checked');
	var fd_status_text = generalObj.disabled;
	var fd_status = 'N';
	if(fd_status_check){
		fd_status_text = generalObj.enabled;
		fd_status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'fd_status': fd_status,
			'change_fd_status': 1
		},
		url: ajaxurl + "rzvy_frequently_discount_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="changed"){
				swal(fd_status_text+"!", generalObj.frequently_discount_status_changed_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Change Schedule status JS **/
$(document).on('change', '.rzvy_change_schedule_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var schedule_offday_check = $(this).prop('checked');
	var schedule_offday_text = generalObj.marked_as_offday;
	var schedule_offday = 'Y';
	if(schedule_offday_check){
		schedule_offday_text = generalObj.marked_as_working_day;
		schedule_offday = 'N';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'offday': schedule_offday,
			'change_schedule_offday': 1
		},
		url: ajaxurl + "rzvy_schedule_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="changed"){
				swal(schedule_offday_text+"!", schedule_offday_text+' '+generalObj.successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Change Schedule start time JS **/
$(document).on('changed.bs.select', 'select.rzvy_starttime_dropdown', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var db_starttime = $(".rzvy_starttime_dropdown_hidden_"+id).val();
	var starttime = $(this).val();
	var position = $('option:selected', this).data('position');
	var endtime_position = $('#rzvy_endtime_dropdown_'+id+' option:selected').data('position');
	if(endtime_position>position){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'starttime': starttime,
				'update_schedule_starttime': 1
			},
			url: ajaxurl + "rzvy_schedule_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					$(".rzvy_starttime_dropdown_hidden_"+id).val(starttime);
					swal(generalObj.updated, generalObj.schedule_start_time_updated_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}else{
		$("#rzvy_starttime_dropdown_"+id).val(db_starttime);
		$("#rzvy_starttime_dropdown_"+id).selectpicker("refresh");
		swal(generalObj.opps, generalObj.please_select_start_time_less_than_end_time, "error");
	}
});
/** Change Schedule end time JS **/
$(document).on('changed.bs.select', 'select.rzvy_endtime_dropdown', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var endtime = $(this).val();
	var db_endtime = $(".rzvy_endtime_dropdown_hidden_"+id).val();
	var position = $('option:selected', this).data('position');
	var starttime_position = $('#rzvy_starttime_dropdown_'+id+' option:selected').data('position');
	if(starttime_position<position){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'endtime': endtime,
				'update_schedule_endtime': 1
			},
			url: ajaxurl + "rzvy_schedule_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					$(".rzvy_endtime_dropdown_hidden_"+id).val(starttime);
					swal(generalObj.updated, generalObj.schedule_end_time_updated_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}else{
		$("#rzvy_endtime_dropdown_"+id).val(db_endtime);
		$("#rzvy_endtime_dropdown_"+id).selectpicker("refresh");
		swal(generalObj.opps, generalObj.please_select_end_time_greater_than_start_time, "error");
	}
});
/** Registered Customer appointments modal JS **/
$(document).on('click', '.rzvy_customer_appointments_btn', function(){
	$('#rzvy_customer_appointments_listing').DataTable().destroy();
	$('#rzvy_customer_appointments_listing tbody').empty();
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var ctype = $(this).data('ctype');
	$('#rzvy_customer_appointment_modal').modal('show');
	$('#rzvy_customer_appointments_listing').DataTable( {
		stripeClasses: [ 'rzvy_datatable_strip', "" ],
		processing: true,
        serverSide: true,
        ajax: {
			dataSrc: "data",
            type: "POST",
			processData: true,
			url: ajaxurl + "rzvy_customer_appointments_ajax.php?refresh_appt_detail&c_id="+id+"&ctype="+ctype
        }
    } );
});
/** Appointment detail tab content **/
$(document).on('click', '.rzvy_appointment_detail_link', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$.ajax({
		type: 'post',
		data: {
			'order_id': id,
			'appointment_detail_tab': 1
		},
		url: ajaxurl + "rzvy_appointment_detail_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('#rzvy_appointment_detail').html(res);
			$('#rzvy_appointment_detail').show();
			$('#rzvy_payment_detail').hide();
			$('#rzvy_customer_detail').hide();
			$('#rzvy_reschedule_appointment').hide();
			$('#rzvy_reject_appointment').hide();
			$('#rzvy_feedback_appointment').hide();
		}
	});
});
/** Payment detail tab content **/
$(document).on('click', '.rzvy_payment_detail_link', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$.ajax({
		type: 'post',
		data: {
			'order_id': id,
			'payment_detail_tab': 1
		},
		url: ajaxurl + "rzvy_appointment_detail_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('#rzvy_payment_detail').html(res);
			$('#rzvy_appointment_detail').hide();
			$('#rzvy_payment_detail').show();
			$('#rzvy_customer_detail').hide();
			$('#rzvy_reschedule_appointment').hide();
			$('#rzvy_reject_appointment').hide();
			$('#rzvy_feedback_appointment').hide();
		}
	});
});
/** Customer detail tab content **/
$(document).on('click', '.rzvy_customer_detail_link', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$.ajax({
		type: 'post',
		data: {
			'order_id': id,
			'customer_detail_tab': 1
		},
		url: ajaxurl + "rzvy_appointment_detail_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('#rzvy_customer_detail').html(res);
			$('#rzvy_appointment_detail').hide();
			$('#rzvy_payment_detail').hide();
			$('#rzvy_feedback_appointment').hide();
			$('#rzvy_customer_detail').show();
			$('#rzvy_reschedule_appointment').hide();
			$('#rzvy_reject_appointment').hide();
		}
	});
});
/** Reschedule Appointment detail tab content **/
$(document).on('click', '.rzvy_reschedule_appointment_link', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$.ajax({
		type: 'post',
		data: {
			'order_id': id,
			'rzvy_reschedule_appointment_tab': 1
		},
		url: ajaxurl + "rzvy_appointment_detail_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('#rzvy_reschedule_appointment').html(res);
			$('#rzvy_appointment_detail').hide();
			$('#rzvy_payment_detail').hide();
			$('#rzvy_customer_detail').hide();
			$('#rzvy_reschedule_appointment').show();
			$('#rzvy_reject_appointment').hide();
			$('#rzvy_feedback_appointment').hide();
		}
	});
});
/** Rating & Review Appointment detail tab content **/
$(document).on('click', '.rzvy_feedback_appointment_link', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$.ajax({
		type: 'post',
		data: {
			'order_id': id,
			'rzvy_feedback_appointment_tab': 1
		},
		url: ajaxurl + "rzvy_appointment_detail_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('#rzvy_feedback_appointment').html(res);
			$('#rzvy_appointment_detail').hide();
			$('#rzvy_payment_detail').hide();
			$('#rzvy_customer_detail').hide();
			$('#rzvy_reschedule_appointment').hide();
			$('#rzvy_reject_appointment').hide();
			$('#rzvy_feedback_appointment').show();
		}
	});
});
/** Reject Appointment detail tab content **/
$(document).on('click', '.rzvy_reject_appointment_link', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$.ajax({
		type: 'post',
		data: {
			'order_id': id,
			'rzvy_reject_appointment_tab': 1
		},
		url: ajaxurl + "rzvy_appointment_detail_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('#rzvy_reject_appointment').html(res);
			$('#rzvy_appointment_detail').hide();
			$('#rzvy_payment_detail').hide();
			$('#rzvy_customer_detail').hide();
			$('#rzvy_reschedule_appointment').hide();
			$('#rzvy_reject_appointment').show();
			$('#rzvy_feedback_appointment').hide();
		}
	});
});
/** Delete Appointment JS **/
$(document).on('click', '.rzvy_delete_appt_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_delete_this_appointment,
	  type: "error",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_delete_it,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'order_id': id,
				'delete_appointment': 1
			},
			url: ajaxurl + "rzvy_appointment_detail_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="deleted"){
					$('#rzvy-appointments-calendar').fullCalendar('refetchEvents');
					swal(generalObj.deleted, generalObj.appointment_deleted_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Confirm Appointment JS **/
$(document).on('click', '.rzvy_confirm_appointment_link', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_confirm_this_appointment,
	  type: "success",
	  showCancelButton: true,
	  confirmButtonClass: "btn-success",
	  confirmButtonText: generalObj.yes_confirm_it,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'order_id': id,
				'confirm_appointment': 1
			},
			url: ajaxurl + "rzvy_appointment_detail_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="confirmed"){
					$('.rzvy_confirm_appointment_link').parent().addClass('rzvy-hide');
					$('.rzvy_pending_appointment_link').parent().removeClass('rzvy-hide');
					$('.rzvy_reschedule_appointment_link').parent().removeClass('rzvy-hide');
					$('.rzvy_reject_appointment_link').parent().removeClass('rzvy-hide');
					$('.rzvy_complete_appointment_link').parent().removeClass('rzvy-hide');
					$('#rzvy-appointments-calendar').fullCalendar('refetchEvents');
					$('.rzvy_appointment_detail_link').trigger('click');
					swal(generalObj.confirmed+"!", generalObj.appointment_confirmed_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Mark as Pending Appointment JS **/
$(document).on('click', '.rzvy_pending_appointment_link', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_mark_this_appointment_as_pending,
	  type: "success",
	  showCancelButton: true,
	  confirmButtonClass: "btn-warning",
	  confirmButtonText: generalObj.yes_mark_as_pending,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'order_id': id,
				'mark_as_pending_appointment': 1
			},
			url: ajaxurl + "rzvy_appointment_detail_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="pending"){
					$('.rzvy_confirm_appointment_link').parent().removeClass('rzvy-hide');
					$('.rzvy_pending_appointment_link').parent().addClass('rzvy-hide');
					$('.rzvy_reschedule_appointment_link').parent().removeClass('rzvy-hide');
					$('.rzvy_reject_appointment_link').parent().removeClass('rzvy-hide');
					$('.rzvy_complete_appointment_link').parent().removeClass('rzvy-hide');
					$('#rzvy-appointments-calendar').fullCalendar('refetchEvents');
					$('.rzvy_appointment_detail_link').trigger('click');
					swal(generalObj.marked_as_pending, generalObj.appointment_marked_as_pending_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Mark as Complete Appointment JS **/
$(document).on('click', '.rzvy_complete_appointment_link', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_mark_this_appointment_as_complete,
	  type: "success",
	  showCancelButton: true,
	  confirmButtonClass: "btn-success",
	  confirmButtonText: generalObj.yes_mark_as_completed,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'order_id': id,
				'mark_as_completed_appointment': 1
			},
			url: ajaxurl + "rzvy_appointment_detail_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="completed"){
					$('.rzvy_confirm_appointment_link').parent().addClass('rzvy-hide');
					$('.rzvy_pending_appointment_link').parent().addClass('rzvy-hide');
					$('.rzvy_reschedule_appointment_link').parent().addClass('rzvy-hide');
					$('.rzvy_reject_appointment_link').parent().addClass('rzvy-hide');
					$('.rzvy_complete_appointment_link').parent().addClass('rzvy-hide');
					$('#rzvy-appointments-calendar').fullCalendar('refetchEvents');
					$('.rzvy_appointment_detail_link').trigger('click');
					swal(generalObj.marked_as_completed, generalObj.appointment_marked_as_completed_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Mark as Refunded request JS **/
$(document).on('click', '.rzvy_markasrefunded_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.refund_process_has_been_transferred,
	  type: "success",
	  showCancelButton: true,
	  confirmButtonClass: "btn-success",
	  confirmButtonText: generalObj.yes_refunded,
	  cancelButtonText: generalObj.not_now,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'markasrefunded_appointment': 1
			},
			url: ajaxurl + "rzvy_refund_request_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="changed"){
					swal(generalObj.refunded+"!", generalObj.refund_request_processed_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Mark as Cancel refund request JS **/
$(document).on('click', '.rzvy_cancel_refundrequest_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_cancel_refund_request,
	  type: "success",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_cancel_it,
	  cancelButtonText: generalObj.not_now,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'cancel_refundrequest': 1
			},
			url: ajaxurl + "rzvy_refund_request_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="changed"){
					swal(generalObj.cancelled, generalObj.refund_request_cancelled_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** On date change get slots **/
$(document).on('change', '#rzvy_appt_rs_date', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var datetime = $(this).data('datetime');
	var selected_date = $(this).val();
	var service_id = $("#rzvy_appt_rs_sid").val();
	var staff_id = $("#rzvy_appt_rs_staffid").val();
	$.ajax({
		type: 'post',
		data: {
			'booking_datetime': datetime,
			'selected_date': selected_date,
			'service_id': service_id,
			'staff_id': staff_id,
			'rzvy_slots_on_date_change': 1
		},
		url: ajaxurl + "rzvy_appointment_detail_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('.rzvy_appt_rs_timeslot').html(res);
			$('.rzvy_appt_rs_endtimeslot').html("");
			$('.rzvy_appt_rs_timeslot option:first').trigger("change");
		}
	});
});
/** Reschedule Appointment JS **/
$(document).on('click', '.rzvy_appt_rs_now_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var date = $("#rzvy_appt_rs_date").val();
	var slot = $(".rzvy_appt_rs_timeslot").val();
	var endslot = $(".rzvy_appt_rs_endtimeslot").val();
	var reason = $("#rzvy_appt_rs_reason").val();
	if(date != "" && slot != "" && slot !== null && endslot != "" && endslot !== null){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'order_id': id,
				'date': date,
				'slot': slot,
				'endslot': endslot,
				'reason': reason,
				'reschedule_appointment_detail': 1
			},
			url: ajaxurl + "rzvy_appointment_detail_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					$('.rzvy_confirm_appointment_link').parent().removeClass('rzvy-hide');
					$('.rzvy_pending_appointment_link').parent().addClass('rzvy-hide');
					$('.rzvy_reschedule_appointment_link').parent().removeClass('rzvy-hide');
					$('.rzvy_reject_appointment_link').parent().removeClass('rzvy-hide');
					$('.rzvy_complete_appointment_link').parent().removeClass('rzvy-hide');
					$('#rzvy-appointments-calendar').fullCalendar('refetchEvents');
					$('.rzvy_appointment_detail_link').trigger('click');
					swal(generalObj.rescheduled, generalObj.appointment_rescheduled_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Reject Appointment JS **/
$(document).on('click', '.rzvy_appt_reject_now_btn', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var reason = $("#rzvy_appt_reject_reason").val();
	$.ajax({
		type: 'post',
		data: {
			'order_id': id,
			'reason': reason,
			'reject_appointment_detail': 1
		},
		url: ajaxurl + "rzvy_appointment_detail_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="updated"){
				$('.rzvy_confirm_appointment_link').parent().addClass('rzvy-hide');
				$('.rzvy_pending_appointment_link').parent().addClass('rzvy-hide');
				$('.rzvy_reschedule_appointment_link').parent().addClass('rzvy-hide');
				$('.rzvy_reject_appointment_link').parent().addClass('rzvy-hide');
				$('.rzvy_complete_appointment_link').parent().addClass('rzvy-hide');
				$('#rzvy-appointments-calendar').fullCalendar('refetchEvents');
				$('.rzvy_appointment_detail_link').trigger('click');
				swal(generalObj.rejected, generalObj.appointment_rejected_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Change Password JS **/
$(document).on('click', '.rzvy_change_password_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	/** Validate change password form **/
	$('#rzvy_change_password_form').validate({
		rules: {
			rzvy_old_password:{ required: true, minlength: 8, maxlength: 20 },
			rzvy_new_password: { required:true, minlength: 8, maxlength: 20 },
			rzvy_rtype_password: { required:true, equalTo: "#rzvy_new_password", minlength: 8, maxlength: 20 }
		},
		messages: {
			rzvy_old_password:{ required: generalObj.please_enter_old_password, minlength: generalObj.please_enter_minimum_8_characters, maxlength: generalObj.please_enter_maximum_20_characters },
			rzvy_new_password: { required: generalObj.please_enter_new_password, minlength: generalObj.please_enter_minimum_8_characters, maxlength: generalObj.please_enter_maximum_20_characters },
			rzvy_rtype_password: { required: generalObj.please_enter_retype_new_password, equalTo: generalObj.new_password_and_retype_new_password_mismatch, minlength: generalObj.please_enter_minimum_8_characters, maxlength: generalObj.please_enter_maximum_20_characters }
		}
	});
	if($("#rzvy_change_password_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var id = $(this).data('id');
		var old_password = $("#rzvy_old_password").val();
		var new_password = $("#rzvy_rtype_password").val();
		$.ajax({
			type: 'post',
			data: {
				'admin_id': id,
				'old_password': old_password,
				'new_password': new_password,
				'change_admin_password': 1
			},
			url: ajaxurl + "rzvy_admin_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="changed"){
					$("#rzvy_old_password").val("");
					$("#rzvy_new_password").val("");
					$("#rzvy_rtype_password").val("");
					$("#rzvy-change-password-modal").modal("hide");
					swal(generalObj.changed, generalObj.your_password_changed_successfully, "success");
				}else if(res=="wrong"){
					swal(generalObj.opps, generalObj.incorrect_old_password, "error");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Display appointment notification detail JS **/
$(document).on('click', '.rzvy-notification-dropdown-link', function(){
	if($('#rzvy-notification-dropdown-content').css('display') === 'none'){
		/* hide refund dropdown start */
		$("#rzvy-mainnav .navbar-collapse .navbar-nav > .nav-item.dropdown.rzvy-refundrequest-dd").removeClass("show");
		$('#rzvy-refund-dropdown-content').html("");
		$('#rzvy-refund-dropdown-content').slideUp();
		/* hide refund dropdown end */
		
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$("#rzvy-mainnav .navbar-collapse .navbar-nav > .nav-item.dropdown.rzvy-notification-dd").addClass("show");
		var ajaxurl = generalObj.ajax_url;
		$.ajax({
			type: 'post',
			data: {
				'get_notification_appointment_detail': 1
			},
			url: ajaxurl + "rzvy_notification_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				$('#rzvy-notification-dropdown-content').html(res);
				$('#rzvy-notification-dropdown-content').slideDown();
			}
		});
	}else{
		$("#rzvy-mainnav .navbar-collapse .navbar-nav > .nav-item.dropdown.rzvy-notification-dd").removeClass("show");
		$('#rzvy-notification-dropdown-content').html("");
		$('#rzvy-notification-dropdown-content').slideUp();
	}
});
/** Display refund request detail JS **/
$(document).on('click', '.rzvy-refund-dropdown-link', function(){
	if($('#rzvy-refund-dropdown-content').css('display') === 'none'){
		/* hide notification dropdown start */
		$("#rzvy-mainnav .navbar-collapse .navbar-nav > .nav-item.dropdown.rzvy-notification-dd").removeClass("show");
		$('#rzvy-notification-dropdown-content').html("");
		$('#rzvy-notification-dropdown-content').slideUp();
		/* hide notification dropdown start */
		
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$("#rzvy-mainnav .navbar-collapse .navbar-nav > .nav-item.dropdown.rzvy-refundrequest-dd").addClass("show");
		var ajaxurl = generalObj.ajax_url;
		$.ajax({
			type: 'post',
			data: {
				'get_refund_request_detail': 1
			},
			url: ajaxurl + "rzvy_refund_request_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				$('#rzvy-refund-dropdown-content').html(res);
				$('#rzvy-refund-dropdown-content').slideDown();
			}
		});
	}else{
		$("#rzvy-mainnav .navbar-collapse .navbar-nav > .nav-item.dropdown.rzvy-refundrequest-dd").removeClass("show");
		$('#rzvy-refund-dropdown-content').html("");
		$('#rzvy-refund-dropdown-content').slideUp();
	}
});
/** Display appointment notification detail modal JS **/
$(document).on('click', '.rzvy-notification-appointment-modal-link', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$('.rzvy-notification-dropdown-link').trigger("click");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$.ajax({
		type: 'post',
		data: {
			'order_id': id,
			'mark_appointment_as_read': 1
		},
		url: ajaxurl + "rzvy_notification_ajax.php"
	});
	$.ajax({
		type: 'post',
		data: {
			'order_id': id,
			'get_appointment_detail': 1
		},
		url: ajaxurl + "rzvy_appointment_detail_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('.rzvy_delete_appt_btn').attr('data-id', id);
			$('.rzvy_appointment_detail_modal_body').html(res);
			$('#rzvy_appointment_detail_modal').modal('show');
			$('.rzvy_appointment_detail_link').trigger('click');
		}
	});
});
/** Mark as read refund request from notification JS **/
$(document).on('click', '.rzvy-notification-refundrequest-modal-link', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'mark_refund_request_as_read': 1
		},
		url: ajaxurl + "rzvy_refund_request_ajax.php",
		success: function (res) {
			$.ajax({
				type: 'post',
				data: {
					'get_refund_request_detail': 1
				},
				url: ajaxurl + "rzvy_refund_request_ajax.php",
				success: function (res) {
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					$('#rzvy-refund-dropdown-content').html(res);
				}
			});
		}
	});
});
/** Export All Categories JS **/
$(document).on('click', '.rzvy_export_services_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var categories = $("#rzvy_export_categories").val();
	var services = $("#rzvy_export_services").val();
	var addons = $("#rzvy_export_addons").val();
	if(categories == "" && services == "" && addons == ""){
		swal(generalObj.opps, generalObj.please_select_atleast_any_of_one_option_to_export, "error");
	}else if(categories != "" && services != "" && addons == ""){
		swal(generalObj.opps, generalObj.please_select_addon, "error");
	}else if(categories != "" && services == "" && addons != ""){
		swal(generalObj.opps, generalObj.please_select_service, "error");
	}else if(categories == "" && services != "" && addons != ""){
		swal(generalObj.opps, generalObj.please_select_category, "error");
	}else{
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'categories': categories,
				'services': services,
				'addons': addons,
				'export_services': 1
			},
			url: ajaxurl + "rzvy_export_services_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				window.location.href = res;
			}
		});
	}
});
/** Get services on Categories JS **/
$(document).on('change', '#rzvy_export_categories', function(){
	var ajaxurl = generalObj.ajax_url;
	var categories = $(this).val();
	if(categories != ""){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'categories': categories,
				'get_services_and_addons': 1
			},
			url: ajaxurl + "rzvy_export_services_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				var detail = $.parseJSON(res);
				$("#rzvy_export_services").html(detail['service_options']);
				$("#rzvy_export_addons").html(detail['addon_options']);
				$("#rzvy_export_services").selectpicker("refresh");
				$("#rzvy_export_addons").selectpicker("refresh");
			}
		});
	}else{
		swal(generalObj.opps, generalObj.please_select_category, "error");
	}
});
/** Get addons on services JS **/
$(document).on('change', '#rzvy_export_services', function(){
	var ajaxurl = generalObj.ajax_url;
	var services = $(this).val();
	if(services != ""){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'services': services,
				'get_addons': 1
			},
			url: ajaxurl + "rzvy_export_services_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				var detail = $.parseJSON(res);
				$("#rzvy_export_addons").html(detail['addon_options']);
				$("#rzvy_export_addons").selectpicker("refresh");
			}
		});
	}else{
		swal(generalObj.opps, generalObj.please_select_service, "error");
	}
});
/** Export Appointments JS **/
$(document).on('click', '.rzvy_export_appt_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var from_date = $("#rzvy_export_appt_from").val();
	var to_date = $("#rzvy_export_appt_to").val();
	var appt_type = $("#rzvy_export_appt_type").val();
	if(from_date == ""){
		swal(generalObj.opps, generalObj.please_select_from_date, "error");
	}else if(to_date == ""){
		swal(generalObj.opps, generalObj.please_select_to_date, "error");
	}else{
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'from_date': from_date,
				'to_date': to_date,
				'appt_type': appt_type,
				'export_appointments': 1
			},
			url: ajaxurl + "rzvy_export_appointments_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				window.location.href = res;
			}
		});
	}
});
/** Export Payments JS **/
$(document).on('click', '.rzvy_export_payment_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var from_date = $("#rzvy_export_payment_from").val();
	var to_date = $("#rzvy_export_payment_to").val();
	var payment_type = $("#rzvy_export_payment_type").val();
	if(from_date == ""){
		swal(generalObj.opps, generalObj.please_select_from_date, "error");
	}else if(to_date == ""){
		swal(generalObj.opps, generalObj.please_select_to_date, "error");
	}else{
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'from_date': from_date,
				'to_date': to_date,
				'payment_type': payment_type,
				'export_payments': 1
			},
			url: ajaxurl + "rzvy_export_payments_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				window.location.href = res;
			}
		});
	}
});
/** Export Customers JS **/
$(document).on('click', '.rzvy_export_customers_btn', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var customer_type = $("#rzvy_export_customers_type").val();
	$.ajax({
		type: 'post',
		data: {
			'customer_type': customer_type,
			'export_customers': 1
		},
		url: ajaxurl + "rzvy_export_customers_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			window.location.href = res;
		}
	});
});
/** Update Profile JS **/
$(document).on('click', '.rzvy_update_profile_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var uploaded_file = $("#rzvy-image-upload-file-hidden").val();
	var firstname = $("#rzvy_profile_firstname").val();
	var lastname = $("#rzvy_profile_lastname").val();
	var phone = $("#rzvy_profile_phone").intlTelInput("getNumber");
	var address = $("#rzvy_profile_address").val();
	var city = $("#rzvy_profile_city").val();
	var state = $("#rzvy_profile_state").val();
	var zip = $("#rzvy_profile_zip").val();
	var country = $("#rzvy_profile_country").val();
	var id = $("#rzvy-profile-admin-id-hidden").val();
	
	/** Validate update Profile form **/
	$('#rzvy_profile_form').validate({
		rules: {
			rzvy_profile_firstname:{ required: true, maxlength: 50 },
			rzvy_profile_lastname: { required:true, maxlength: 50 },
			rzvy_profile_phone: { required:true, minlength: 10, maxlength: 15, pattern_phone:true },
			rzvy_profile_address: { required:true },
			rzvy_profile_city: { required:true },
			rzvy_profile_state: { required:true },
			rzvy_profile_zip: { required:true, pattern_zip:true, minlength: 5, maxlength: 10 },
			rzvy_profile_country: { required:true }
		},
		messages: {
			rzvy_profile_firstname:{ required: generalObj.please_enter_first_name, maxlength: generalObj.please_enter_maximum_50_characters },
			rzvy_profile_lastname: { required: generalObj.please_enter_last_name, maxlength: generalObj.please_enter_maximum_50_characters },
			rzvy_profile_phone: { required: generalObj.please_enter_phone_number, minlength: generalObj.please_enter_minimum_10_digits, maxlength: generalObj.please_enter_maximum_15_digits },
			rzvy_profile_address: { required: generalObj.please_enter_address },
			rzvy_profile_city: { required: generalObj.please_enter_city },
			rzvy_profile_state: { required: generalObj.please_enter_state },
			rzvy_profile_zip: { required: generalObj.please_enter_zip, minlength: generalObj.please_enter_minimum_5_characters, maxlength: generalObj.please_enter_maximum_10_characters },
			rzvy_profile_country: { required: generalObj.please_enter_country }
		}
	});
	
	if($("#rzvy_profile_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'uploaded_file': uploaded_file,
				'firstname': firstname,
				'lastname': lastname,
				'phone': phone,
				'address': address,
				'city': city,
				'state': state,
				'zip': zip,
				'country': country,
				'id': id,
				'update_profile': 1
			},
			url: ajaxurl + "rzvy_admin_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					swal(generalObj.updated, generalObj.your_profile_updated_successfully, "success");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Change Profile email JS **/
$(document).on('click', '#rzvy_change_profile_email_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	/** Validate Change Email form **/
	$('#rzvy_change_profile_email_form').validate({
		rules: {
			rzvy_change_profile_email:{ required: true, email: true }
		},
		messages: {
			rzvy_change_profile_email:{ required: generalObj.please_enter_email_address, email: generalObj.please_enter_valid_email_address }
		}
	});
	if($("#rzvy_change_profile_email_form").valid()){
		var email = $("#rzvy_change_profile_email").val();
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'email': email,
				'change_email': 1
			},
			url: ajaxurl + "rzvy_admin_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					swal(generalObj.changed, generalObj.your_email_changed_successfully, "success");
					location.reload();
				}else if(res=="exist"){
					swal(generalObj.exist, generalObj.email_already_exist_please_try_to_update_with_not_registered_email, "error");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Update company settings JS **/
$(document).on('click', '#update_company_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var uploaded_file = $("#rzvy-image-upload-file-hidden").val();
	var rzvy_company_name = $("#rzvy_company_name").val();
	var rzvy_company_email = $("#rzvy_company_email").val();
	var rzvy_company_phone = $("#rzvy_company_phone").intlTelInput("getNumber");
	var rzvy_company_address = $("#rzvy_company_address").val();
	var rzvy_company_city = $("#rzvy_company_city").val();
	var rzvy_company_state = $("#rzvy_company_state").val();
	var rzvy_company_zip = $("#rzvy_company_zip").val();
	var rzvy_company_country = $("#rzvy_company_country").val();
	var rzvy_default_country_code = $("#rzvy_default_country_code").val();
	
	/** Validate company settings form **/
	$('#rzvy_company_settings_form').validate({
		rules: {
			rzvy_company_name:{ required: true },
			rzvy_company_email:{ required: true, email: true },
			rzvy_company_phone:{ required: true, minlength: 10, maxlength: 15, pattern_phone:true },
			rzvy_company_address:{ required: true },
			rzvy_company_city:{ required: true },
			rzvy_company_state:{ required: true },
			rzvy_company_zip:{ required: true, pattern_zip:true, minlength: 5, maxlength: 10 },
			rzvy_company_country:{ required: true }
		},
		messages: {
			rzvy_company_name:{ required: generalObj.please_enter_company_name },
			rzvy_company_email:{ required: generalObj.please_enter_company_email, email: generalObj.please_enter_valid_email_address },
			rzvy_company_phone:{ required: generalObj.please_enter_company_phone, minlength: generalObj.please_enter_minimum_10_digits, maxlength: generalObj.please_enter_maximum_15_digits },
			rzvy_company_address:{ required: generalObj.please_enter_address },
			rzvy_company_city:{ required: generalObj.please_enter_city },
			rzvy_company_state:{ required: generalObj.please_enter_state },
			rzvy_company_zip:{ required: generalObj.please_enter_zip, minlength: generalObj.please_enter_minimum_5_characters, maxlength: generalObj.please_enter_maximum_10_characters },
			rzvy_company_country:{ required: generalObj.please_enter_country }
		}
	});
	
	if($("#rzvy_company_settings_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'rzvy_company_name': rzvy_company_name,
				'rzvy_company_email': rzvy_company_email,
				'rzvy_company_phone': rzvy_company_phone,
				'rzvy_company_address': rzvy_company_address,
				'rzvy_company_city': rzvy_company_city,
				'rzvy_company_state': rzvy_company_state,
				'rzvy_company_zip': rzvy_company_zip,
				'rzvy_company_country': rzvy_company_country,
				'uploaded_file': uploaded_file,
				'rzvy_default_country_code': rzvy_default_country_code,
				'update_company_settings': 1
			},
			url: ajaxurl + "rzvy_settings_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(generalObj.updated, generalObj.company_settings_updated_successfully, "success");
			}
		});
	}
});
/** Update Appearance settings JS **/
$(document).on('click', '#update_appearance_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var rzvy_timeslot_interval = $("#rzvy_timeslot_interval").val();
	var rzvy_endtimeslot_selection_status = $("#rzvy_endtimeslot_selection_status").val();
	var rzvy_maximum_endtimeslot_limit = $("#rzvy_maximum_endtimeslot_limit").val();
	var rzvy_currency = $("#rzvy_currency").val();
	var rzvy_currency_symbol = $("#rzvy_currency option:selected").data("symbol");
	var rzvy_auto_confirm_appointment = $("#rzvy_auto_confirm_appointment").val();
	var rzvy_tax_status = $("#rzvy_tax_status").val();
	var rzvy_tax_type = $("#rzvy_tax_type").val();
	var rzvy_tax_value = $("#rzvy_tax_value").val();
	var rzvy_minimum_booking_amount = $("#rzvy_minimum_booking_amount").val();
	var rzvy_minimum_advance_booking_time = $("#rzvy_minimum_advance_booking_time").val();
	var rzvy_maximum_advance_booking_time = $("#rzvy_maximum_advance_booking_time").val();
	var rzvy_cancellation_buffer_time = $("#rzvy_cancellation_buffer_time").val();
	var rzvy_reschedule_buffer_time = $("#rzvy_reschedule_buffer_time").val();
	var rzvy_date_format = $("#rzvy_date_format").val();
	var rzvy_time_format = $("#rzvy_time_format").val();
	var rzvy_timezone = $("#rzvy_timezone").val();
	var rzvy_show_frontend_rightside_feedback_list = $("#rzvy_show_frontend_rightside_feedback_list").val();
	var rzvy_show_frontend_rightside_feedback_form = $("#rzvy_show_frontend_rightside_feedback_form").val();
	var rzvy_show_guest_user_checkout = $("#rzvy_show_guest_user_checkout").val();
	var rzvy_show_existing_new_user_checkout = $("#rzvy_show_existing_new_user_checkout").val();
	var rzvy_hide_already_booked_slots_from_frontend_calendar = $("#rzvy_hide_already_booked_slots_from_frontend_calendar").val();
	var rzvy_thankyou_page_url = $("#rzvy_thankyou_page_url").val();
	var rzvy_terms_and_condition_link = $("#rzvy_terms_and_condition_link").val();
	
	/** Check End Time Slot Limit **/
	if(rzvy_endtimeslot_selection_status == "Y"){
		if(parseInt(rzvy_maximum_endtimeslot_limit)<parseInt(rzvy_timeslot_interval)){
			swal(generalObj.opps, generalObj.maximum_end_time_slot_limit_should_be_greater_than_equal_to_time_slot_interval, "error");
			return false;
		}
	}
	
	/** Validate Appearance settings form **/
	$('#rzvy_appearance_settings_form').validate();
	$("#rzvy_thankyou_page_url").rules("add",
	{
		required: true,
		messages: { required: generalObj.please_enter_thankyou_page_url }
	});
	$("#rzvy_terms_and_condition_link").rules("add",
	{
		required: true,
		messages: { required: generalObj.please_enter_terms_condition_link }
	});
	if(rzvy_tax_status == "Y"){
		$("#rzvy_tax_value").rules("add",
        {
            required: true, pattern_price: true,
            messages: { required: generalObj.please_enter_tax_value }
        });
	}else{
		$("#rzvy_tax_value").rules("add",
        {
            required: false, pattern_price: true,
            messages: { required: generalObj.please_enter_tax_value }
        });
	}
	
	$("#rzvy_minimum_booking_amount").rules("add",
	{
		required: false, pattern_price: true,
		messages: { required: generalObj.please_minimum_booking_amount }
	});
	if($("#rzvy_appearance_settings_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'rzvy_timeslot_interval': rzvy_timeslot_interval,
				'rzvy_endtimeslot_selection_status': rzvy_endtimeslot_selection_status,
				'rzvy_maximum_endtimeslot_limit': rzvy_maximum_endtimeslot_limit,
				'rzvy_currency': rzvy_currency,
				'rzvy_currency_symbol': rzvy_currency_symbol,
				'rzvy_auto_confirm_appointment': rzvy_auto_confirm_appointment,
				'rzvy_tax_status': rzvy_tax_status,
				'rzvy_tax_type': rzvy_tax_type,
				'rzvy_tax_value': rzvy_tax_value,
				'rzvy_minimum_advance_booking_time': rzvy_minimum_advance_booking_time,
				'rzvy_maximum_advance_booking_time': rzvy_maximum_advance_booking_time,
				'rzvy_cancellation_buffer_time': rzvy_cancellation_buffer_time,
				'rzvy_reschedule_buffer_time': rzvy_reschedule_buffer_time,
				'rzvy_date_format': rzvy_date_format,
				'rzvy_time_format': rzvy_time_format,
				'rzvy_timezone': rzvy_timezone,
				'rzvy_show_frontend_rightside_feedback_list': rzvy_show_frontend_rightside_feedback_list,
				'rzvy_show_frontend_rightside_feedback_form': rzvy_show_frontend_rightside_feedback_form,
				'rzvy_show_guest_user_checkout': rzvy_show_guest_user_checkout,
				'rzvy_show_existing_new_user_checkout': rzvy_show_existing_new_user_checkout,
				'rzvy_hide_already_booked_slots_from_frontend_calendar': rzvy_hide_already_booked_slots_from_frontend_calendar,
				'rzvy_thankyou_page_url': rzvy_thankyou_page_url,
				'rzvy_terms_and_condition_link': rzvy_terms_and_condition_link,
				'rzvy_minimum_booking_amount': rzvy_minimum_booking_amount,
				'update_appearance_settings': 1
			},
			url: ajaxurl + "rzvy_settings_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(generalObj.updated, generalObj.appearance_settings_updated_successfully, "success");
			}
		});
	}
});
/** Update Referral settings JS **/
$(document).on('click', '#update_referral_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var rzvy_referral_discount_status = 'N';
	var rzvy_referral_discount_status_check = $("#rzvy_referral_discount_status").prop('checked');
	if(rzvy_referral_discount_status_check){
		rzvy_referral_discount_status = 'Y';
	}
	var rzvy_referral_discount_type = $("#rzvy_referral_discount_type").val();
	var rzvy_referral_discount_value = $("#rzvy_referral_discount_value").val();
		
	/** Validate Appearance settings form **/
	$('#rzvy_referral_settings_form').validate();
	$("#rzvy_referral_discount_type").rules("add",
	{
		required: true,
		messages: { required: generalObj.please_enter_referral_discount_type }
	});
	$("#rzvy_referral_discount_value").rules("add",
	{
		required: true, pattern_price: true,
		messages: { required: generalObj.please_enter_referral_discount_value }
	});
	
	if($("#rzvy_referral_settings_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'rzvy_referral_discount_status': rzvy_referral_discount_status,
				'rzvy_referral_discount_type': rzvy_referral_discount_type,
				'rzvy_referral_discount_value': rzvy_referral_discount_value,
				'update_referral_discount_settings': 1
			},
			url: ajaxurl + "rzvy_settings_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(generalObj.updated, generalObj.referral_discount_settings_updated_successfully, "success");
			}
		});
	}
});
/** Update Refund settings JS **/
$(document).on('click', '#update_refund_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var rzvy_refund_status = 'N';
	var rzvy_refund_status_check = $("#rzvy_refund_status").prop('checked');
	if(rzvy_refund_status_check){
		rzvy_refund_status = 'Y';
	}
	var rzvy_refund_type = $("#rzvy_refund_type option:selected").val();
	var rzvy_refund_value = $("#rzvy_refund_value").val();
	var rzvy_refund_request_buffer_time = $("#rzvy_refund_request_buffer_time option:selected").val();
	var rzvy_refund_summary = $("#rzvy_refund_summary").summernote('code');
	
	/** Validate Refund settings form **/
	$('#rzvy_refund_settings_form').validate();
	if(rzvy_refund_status == "Y"){
		$("#rzvy_refund_value").rules("add",
        {
            required: true, pattern_price: true,
            messages: { required: generalObj.please_enter_refund_value }
        });
		$("#rzvy_refund_type").rules("add",
        {
            required: true,
            messages: { required: generalObj.please_enter_refund_type }
        });
		$("#rzvy_refund_request_buffer_time").rules("add",
        {
            required: true,
            messages: { required: generalObj.please_select_refund_request_buffer_time }
        });
	}else{
		$("#rzvy_refund_value").rules("add",
        {
            required: false, pattern_price: true,
            messages: { required: generalObj.please_enter_refund_value }
        });
		$("#rzvy_refund_type").rules("add",
        {
            required: false,
            messages: { required: generalObj.please_enter_refund_type }
        });
		$("#rzvy_refund_request_buffer_time").rules("add",
        {
            required: false,
            messages: { required: generalObj.please_select_refund_request_buffer_time }
        });
	}
	
	if($("#rzvy_refund_settings_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'rzvy_refund_status': rzvy_refund_status,
				'rzvy_refund_type': rzvy_refund_type,
				'rzvy_refund_value': rzvy_refund_value,
				'rzvy_refund_request_buffer_time': rzvy_refund_request_buffer_time,
				'rzvy_refund_summary': rzvy_refund_summary,
				'update_refund_settings': 1
			},
			url: ajaxurl + "rzvy_settings_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(generalObj.updated, generalObj.refund_settings_updated_successfully, "success");
			}
		});
	}
});
/** Update Email settings JS **/
$(document).on('click', '#update_email_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var rzvy_admin_email_notification_status = 'N';
	var rzvy_customer_email_notification_status = 'N';
	var rzvy_staff_email_notification_status = 'N';
	var rzvy_admin_email_notification_status_check = $("#rzvy_admin_email_notification_status").prop('checked');
	var rzvy_customer_email_notification_status_check = $("#rzvy_customer_email_notification_status").prop('checked');
	var rzvy_staff_email_notification_status_check = $("#rzvy_staff_email_notification_status").prop('checked');
	if(rzvy_admin_email_notification_status_check){
		rzvy_admin_email_notification_status = 'Y';
	}
	if(rzvy_customer_email_notification_status_check){
		rzvy_customer_email_notification_status = 'Y';
	}
	if(rzvy_staff_email_notification_status_check){
		rzvy_staff_email_notification_status = 'Y';
	}
	var rzvy_email_sender_name = $("#rzvy_email_sender_name").val();
	var rzvy_email_sender_email = $("#rzvy_email_sender_email").val();
	var rzvy_email_smtp_hostname = $("#rzvy_email_smtp_hostname").val();
	var rzvy_email_smtp_username = $("#rzvy_email_smtp_username").val();
	var rzvy_email_smtp_password = $("#rzvy_email_smtp_password").val();
	var rzvy_email_smtp_port = $("#rzvy_email_smtp_port").val();
	var rzvy_email_encryption_type = $("#rzvy_email_encryption_type").val();
	var rzvy_email_smtp_authentication = $("#rzvy_email_smtp_authentication").val();
	var rzvy_send_email_with = $("#rzvy_send_email_with").val();
	
	/** Validate Email settings form **/
	$('#rzvy_email_settings_form').validate({
		rules: {
			rzvy_email_sender_name:{ required: true },
			rzvy_email_sender_email:{ required: true, email: true }
		},
		messages: {
			rzvy_email_sender_name:{ required: generalObj.please_enter_sender_name },
			rzvy_email_sender_email:{ required: generalObj.please_enter_sender_email, email: generalObj.please_enter_valid_email_address }
		}
	});
	
	if($("#rzvy_email_settings_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'rzvy_admin_email_notification_status': rzvy_admin_email_notification_status,
				'rzvy_customer_email_notification_status': rzvy_customer_email_notification_status,
				'rzvy_staff_email_notification_status': rzvy_staff_email_notification_status,
				'rzvy_email_sender_name': rzvy_email_sender_name,
				'rzvy_email_sender_email': rzvy_email_sender_email,
				'rzvy_email_smtp_hostname': rzvy_email_smtp_hostname,
				'rzvy_email_smtp_username': rzvy_email_smtp_username,
				'rzvy_email_smtp_password': rzvy_email_smtp_password,
				'rzvy_email_smtp_port': rzvy_email_smtp_port,
				'rzvy_email_encryption_type': rzvy_email_encryption_type,
				'rzvy_email_smtp_authentication': rzvy_email_smtp_authentication,
				'rzvy_send_email_with': rzvy_send_email_with,
				'update_email_settings': 1
			},
			url: ajaxurl + "rzvy_settings_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(generalObj.updated, generalObj.email_settings_updated_successfully, "success");
			}
		});
	}
});
/** Update SEO settings JS **/
$(document).on('click', '#update_seo_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var uploaded_file = $("#rzvy_seo_og_tag_image-hidden").val();
	var rzvy_seo_ga_code = $("#rzvy_seo_ga_code").val();
	var rzvy_seo_meta_tag = $("#rzvy_seo_meta_tag").val();
	var rzvy_seo_meta_description = $("#rzvy_seo_meta_description").val();
	var rzvy_seo_og_meta_tag = $("#rzvy_seo_og_meta_tag").val();
	var rzvy_seo_og_tag_type = $("#rzvy_seo_og_tag_type").val();
	var rzvy_seo_og_tag_url = $("#rzvy_seo_og_tag_url").val();
	
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'rzvy_seo_ga_code': rzvy_seo_ga_code,
			'rzvy_seo_meta_tag': rzvy_seo_meta_tag,
			'rzvy_seo_meta_description': rzvy_seo_meta_description,
			'rzvy_seo_og_meta_tag': rzvy_seo_og_meta_tag,
			'rzvy_seo_og_tag_type': rzvy_seo_og_tag_type,
			'rzvy_seo_og_tag_url': rzvy_seo_og_tag_url,
			'uploaded_file': uploaded_file,
			'update_seo_settings': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.updated, generalObj.seo_settings_updated_successfully, "success");
		}
	});
});
/** Update Location selector settings JS **/
$(document).on('click', '#save_location_selector_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var rzvy_location_selector = $("#rzvy_location_selector").val();
	rzvy_location_selector = rzvy_location_selector.replace(/\s/g, '');
	
	var rzvy_location_selector_status = "N";
	var rzvy_location_selector_status_check = $("#rzvy_location_selector_status").prop('checked');
	if(rzvy_location_selector_status_check){
		rzvy_location_selector_status = 'Y';
	}
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'rzvy_location_selector_status': rzvy_location_selector_status,
			'rzvy_location_selector': rzvy_location_selector,
			'save_location_selector_settings': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.updated, generalObj.location_selector_setting_updated_successfully, "success");
		}
	});
});
/** Update Payment settings JS **/
$(document).on('click', '#update_payment_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var payment = $(this).data("payment");
	
	/** Paypal payment settings **/
	if(payment == "1"){
		var rzvy_paypal_payment_status = 'N';
		var rzvy_paypal_guest_payment = 'N';
		
		var rzvy_paypal_payment_status_check = $("#rzvy_paypal_payment_status").prop('checked');
		var rzvy_paypal_guest_payment_check = $("#rzvy_paypal_guest_payment").prop('checked');
		
		if(rzvy_paypal_payment_status_check){
			rzvy_paypal_payment_status = 'Y';
		}
		if(rzvy_paypal_guest_payment_check){
			rzvy_paypal_guest_payment = 'Y';
		}
		
		var rzvy_paypal_api_username = $("#rzvy_paypal_api_username").val();
		var rzvy_paypal_api_password = $("#rzvy_paypal_api_password").val();
		var rzvy_paypal_signature = $("#rzvy_paypal_signature").val();
		
		/** Validate Paypal payment form **/
		$('#rzvy_paypal_payment_settings_form').validate();
		if(rzvy_paypal_payment_status == "Y"){
			$("#rzvy_paypal_api_username").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_api_username }
			});
			$("#rzvy_paypal_api_password").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_api_password }
			});
			$("#rzvy_paypal_signature").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_signature }
			});
		}else{
			$("#rzvy_paypal_api_username").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_api_username }
			});
			$("#rzvy_paypal_api_password").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_api_password }
			});
			$("#rzvy_paypal_signature").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_signature }
			});
		}
		
		if($("#rzvy_paypal_payment_settings_form").valid()){
			$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
			$.ajax({
				type: 'post',
				data: {
					'rzvy_paypal_payment_status': rzvy_paypal_payment_status,
					'rzvy_paypal_guest_payment': rzvy_paypal_guest_payment,
					'rzvy_paypal_api_username': rzvy_paypal_api_username,
					'rzvy_paypal_api_password': rzvy_paypal_api_password,
					'rzvy_paypal_signature': rzvy_paypal_signature,
					'update_paypal_settings': 1
				},
				url: ajaxurl + "rzvy_settings_ajax.php",
				success: function (res) {
					$("#rzvy-payment-setting-form-modal").modal("hide");
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					swal(generalObj.updated, generalObj.paypal_payment_settings_updated_successfully, "success");
					location.reload();
				}
			});
		}
	}
	/** Stripe payment settings **/
	else if(payment == "2"){
		var rzvy_stripe_payment_status = 'N';
		var rzvy_stripe_payment_status_check = $("#rzvy_stripe_payment_status").prop('checked');
		if(rzvy_stripe_payment_status_check){
			rzvy_stripe_payment_status = 'Y';
		}
		var rzvy_stripe_secret_key = $("#rzvy_stripe_secret_key").val();
		var rzvy_stripe_publishable_key = $("#rzvy_stripe_publishable_key").val();
		
		/** Validate payment form **/
		$('#rzvy_stripe_payment_settings_form').validate();
		if(rzvy_stripe_payment_status == "Y"){
			$("#rzvy_stripe_secret_key").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_secret_key }
			});
			$("#rzvy_stripe_publishable_key").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_publishable_key }
			});
		}else{
			$("#rzvy_stripe_secret_key").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_secret_key }
			});
			$("#rzvy_stripe_publishable_key").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_publishable_key }
			});
		}
		
		if($("#rzvy_stripe_payment_settings_form").valid()){
			$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
			$.ajax({
				type: 'post',
				data: {
					'rzvy_stripe_payment_status': rzvy_stripe_payment_status,
					'rzvy_stripe_secret_key': rzvy_stripe_secret_key,
					'rzvy_stripe_publishable_key': rzvy_stripe_publishable_key,
					'update_stripe_settings': 1
				},
				url: ajaxurl + "rzvy_settings_ajax.php",
				success: function (res) {
					$("#rzvy-payment-setting-form-modal").modal("hide");
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					swal(generalObj.updated, generalObj.stripe_payment_settings_updated_successfully, "success");
					location.reload();
				}
			});
		}
	}
	/** Authorize.net payment settings **/
	else if(payment == "3"){
		var rzvy_authorizenet_payment_status = 'N';
		var rzvy_authorizenet_payment_status_check = $("#rzvy_authorizenet_payment_status").prop('checked');
		if(rzvy_authorizenet_payment_status_check){
			rzvy_authorizenet_payment_status = 'Y';
		}
		var rzvy_authorizenet_api_login_id = $("#rzvy_authorizenet_api_login_id").val();
		var rzvy_authorizenet_transaction_key = $("#rzvy_authorizenet_transaction_key").val();
		
		/** Validate payment form **/
		$('#rzvy_authorizenet_payment_settings_form').validate();
		if(rzvy_authorizenet_payment_status == "Y"){
			$("#rzvy_authorizenet_api_login_id").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_api_login_id }
			});
			$("#rzvy_authorizenet_transaction_key").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_transaction_key }
			});
		}else{
			$("#rzvy_authorizenet_api_login_id").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_api_login_id }
			});
			$("#rzvy_authorizenet_transaction_key").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_transaction_key }
			});
		}
		
		if($("#rzvy_authorizenet_payment_settings_form").valid()){
			$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
			$.ajax({
				type: 'post',
				data: {
					'rzvy_authorizenet_payment_status': rzvy_authorizenet_payment_status,
					'rzvy_authorizenet_api_login_id': rzvy_authorizenet_api_login_id,
					'rzvy_authorizenet_transaction_key': rzvy_authorizenet_transaction_key,
					'update_authorizenet_settings': 1
				},
				url: ajaxurl + "rzvy_settings_ajax.php",
				success: function (res) {
					$("#rzvy-payment-setting-form-modal").modal("hide");
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					swal(generalObj.updated, generalObj.authorizenet_payment_settings_updated_successfully, "success");
					location.reload();
				}
			});
		}
	}
	/** 2Checkout payment settings **/
	else if(payment == "4"){
		var rzvy_twocheckout_payment_status = 'N';
		var rzvy_twocheckout_payment_status_check = $("#rzvy_twocheckout_payment_status").prop('checked');
		if(rzvy_twocheckout_payment_status_check){
			rzvy_twocheckout_payment_status = 'Y';
		}
		var rzvy_twocheckout_publishable_key = $("#rzvy_twocheckout_publishable_key").val();
		var rzvy_twocheckout_private_key = $("#rzvy_twocheckout_private_key").val();
		var rzvy_twocheckout_seller_id = $("#rzvy_twocheckout_seller_id").val();
		
		/** Validate payment form **/
		$('#rzvy_twocheckout_payment_settings_form').validate();
		if(rzvy_twocheckout_payment_status == "Y"){
			$("#rzvy_twocheckout_publishable_key").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_publishable_key }
			});
			$("#rzvy_twocheckout_private_key").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_private_key }
			});
			$("#rzvy_twocheckout_seller_id").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_seller_id }
			});
		}else{
			$("#rzvy_twocheckout_publishable_key").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_publishable_key }
			});
			$("#rzvy_twocheckout_private_key").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_private_key }
			});
			$("#rzvy_twocheckout_seller_id").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_seller_id }
			});
		}
		
		if($("#rzvy_twocheckout_payment_settings_form").valid()){
			$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
			$.ajax({
				type: 'post',
				data: {
					'rzvy_twocheckout_payment_status': rzvy_twocheckout_payment_status,
					'rzvy_twocheckout_publishable_key': rzvy_twocheckout_publishable_key,
					'rzvy_twocheckout_private_key': rzvy_twocheckout_private_key,
					'rzvy_twocheckout_seller_id': rzvy_twocheckout_seller_id,
					'update_twocheckout_settings': 1
				},
				url: ajaxurl + "rzvy_settings_ajax.php",
				success: function (res) {
					$("#rzvy-payment-setting-form-modal").modal("hide");
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					swal(generalObj.updated, generalObj.twocheckout_payment_settings_updated_successfully, "success");
					location.reload();
				}
			});
		}
	}
});
/** Payment Collapsible JS **/
$(document).on("click", ".rzvy_payment_settings_admin", function(e){
	e.preventDefault();
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	
	$(".rzvy_payment_settings_admin").each(function(){
		if($(this).attr("id") != "rzvy_payment_settings_admin_"+id){
			$(this).removeClass("rzvy-boxshadow_active");
		}
	});
	if(!$("#rzvy_payment_settings_admin_"+id).hasClass("rzvy-boxshadow_active")){
		$(this).addClass("rzvy-boxshadow_active");
	}
	$.ajax({
		type: 'post',
		data: {
			'get_payment_settings': id
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$("#update_payment_settings_btn").attr("data-payment", id)
			$(".rzvy-payment-setting-form-modal-content").html(res);
			$("#rzvy-payment-setting-form-modal").modal("show");
		}
	});
});
/** Change Categories status JS **/
$(document).on('change', '.rzvy_change_category_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var category_status_check = $(this).prop('checked');
	var category_status_text = generalObj.disabled;
	var category_status = 'N';
	if(category_status_check){
		category_status_text = generalObj.enabled;
		category_status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'category_status': category_status,
			'change_category_status': 1
		},
		url: ajaxurl + "rzvy_category_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="changed"){
				swal(category_status_text+"!", generalObj.category_status_changed_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Delete Categories JS **/
$(document).on('click', '.rzvy_delete_category_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_delete_this_category,
	  type: "error",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_delete_it,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'delete_category': 1
			},
			url: ajaxurl + "rzvy_category_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="deleted"){
					swal(generalObj.deleted, generalObj.category_deleted_successfully, "success");
					location.reload();
				}else if(res=="appointments exist"){
					swal(generalObj.opps, generalObj.you_cannot_delete_this_category_you_have_appointment_with_this_category, "error");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Add Categories JS **/
$(document).on('click', '#rzvy_add_category_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	if($('#rzvy_add_category_form').valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var cat_name = $("#rzvy_categoryname").val();
		var cat_status = $("input[name='rzvy_categorystatus']:checked").val();
		$.ajax({
			type: 'post',
			data: {
				'cat_name': cat_name,
				'status': cat_status,
				'add_category': 1
			},
			url: ajaxurl + "rzvy_category_ajax.php",
			success: function (res) {
				$("#rzvy-add-category-modal").modal("hide");
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="added"){
					swal(generalObj.added, generalObj.category_added_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Update Categories modal detail JS **/
$(document).on('click', '.rzvy-update-categorymodal', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'update_category_modal_detail': 1
		},
		url: ajaxurl + "rzvy_category_ajax.php",
		success: function (res) {
			$(".rzvy-update-category-modal-body").html(res);
			$("#rzvy-update-category-modal").modal("show");
			$("#rzvy_update_category_btn").attr("data-id",id);
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
/** Update Categories JS **/
$(document).on('click', '#rzvy_update_category_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $("#rzvy_update_categoryid_hidden").val();
	var cat_name = $("#rzvy_update_categoryname").val();
	if($("#rzvy_update_category_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'cat_name': cat_name,
				'update_category': 1
			},
			url: ajaxurl + "rzvy_category_ajax.php",
			success: function (res) {
				$("#rzvy-update-category-modal").modal("hide");
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					swal(generalObj.updated, generalObj.category_updated_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Add Services JS **/
$(document).on('click', '#rzvy_add_service_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	if($('#rzvy_add_service_form').valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var cat_id = $("#service_cat_id").val();
		var title = $("#rzvy_servicetitle").val();
		var rate = $("#rzvy_servicerate").val();
		var duration = $("#rzvy_serviceduration").val();
		var padding_before = $("#rzvy_servicepbefore").val();
		var padding_after = $("#rzvy_servicepafter").val();
		var ser_image = $("#rzvy-image-upload-file-hidden").val();
		var description = $("#rzvy_servicedescription").val();
		var ser_status = $("input[name='rzvy_servicestatus']:checked").val();
		$.ajax({
			type: 'post',
			data: {
				'cat_id': cat_id,
				'title': title,
				'rate': rate,
				'duration': duration,
				'padding_before': padding_before,
				'padding_after': padding_after,
				'uploaded_file': ser_image,
				'description': description,
				'status': ser_status,
				'add_service': 1
			},
			url: ajaxurl + "rzvy_services_ajax.php",
			success: function (res) {
				$("#rzvy-add-service-modal").modal("hide");
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="added"){
					swal(generalObj.added, generalObj.service_added_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Update Services JS **/
$(document).on('click', '#rzvy_update_service_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	if($('#rzvy_update_service_form').valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var id = $("#rzvy_update_serviceid_hidden").val();
		var rate = $("#rzvy_update_servicerate").val();
		var duration = $("#rzvy_update_serviceduration").val();
		var padding_before = $("#rzvy_update_servicepbefore").val();
		var padding_after = $("#rzvy_update_servicepafter").val();
		var title = $("#rzvy_update_servicetitle").val();
		var ser_image = $("#rzvy-update-image-upload-file-hidden").val();
		var description = $("#rzvy_update_servicedescription").val();
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'rate': rate,
				'duration': duration,
				'padding_before': padding_before,
				'padding_after': padding_after,
				'title': title,
				'uploaded_file': ser_image,
				'description': description,
				'update_service': 1
			},
			url: ajaxurl + "rzvy_services_ajax.php",
			success: function (res) {
				$("#rzvy-update-service-modal").modal("hide");
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					swal(generalObj.updated, generalObj.service_updated_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Update Services modal detail JS **/
$(document).on('click', '.rzvy-update-servicemodal', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'update_service_modal_detail': 1
		},
		url: ajaxurl + "rzvy_services_ajax.php",
		success: function (res) {
			$(".rzvy-update-service-modal-body").html(res);
			$("#rzvy-update-service-modal").modal("show");
			$("#rzvy_update_service_btn").attr("data-id",id);
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
/** View Services modal detail JS **/
$(document).on('click', '.rzvy-view-servicemodal', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'view_service_modal_detail': 1
		},
		url: ajaxurl + "rzvy_services_ajax.php",
		success: function (res) {
			$(".rzvy-view-service-modal-body").html(res);
			$("#rzvy-view-service-modal").modal("show");
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
/** View addons modal detail JS **/
$(document).on('click', '.rzvy-view-addonmodal', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'view_addon_modal_detail': 1
		},
		url: ajaxurl + "rzvy_addons_ajax.php",
		success: function (res) {
			$(".rzvy-view-addon-modal-body").html(res);
			$("#rzvy-view-addon-modal").modal("show");
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
/** Delete Services JS **/
$(document).on('click', '.rzvy_delete_service_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_delete_this_service,
	  type: "error",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_delete_it,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'delete_service': 1
			},
			url: ajaxurl + "rzvy_services_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="deleted"){
					swal(generalObj.deleted, generalObj.service_deleted_successfully, "success");
					location.reload();
				}else if(res=="appointments exist"){
					swal(generalObj.opps, generalObj.you_cannot_delete_this_service_you_have_appointment_with_this_service, "error");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Delete Addons JS **/
$(document).on('click', '.rzvy_delete_addon_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var service_id = $("#addon_ser_id").val();
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_delete_this_addon,
	  type: "error",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_delete_it,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'service_id': service_id,
				'delete_addon': 1
			},
			url: ajaxurl + "rzvy_addons_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="deleted"){
					swal(generalObj.deleted, generalObj.addon_deleted_successfully, "success");
					location.reload();
				}else if(res=="appointments exist"){
					swal(generalObj.opps, generalObj.you_cannot_delete_this_addon_you_have_appointment_with_this_addon, "error");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Change Service status JS **/
$(document).on('change', '.rzvy_change_service_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var service_status_check = $(this).prop('checked');
	var service_status_text = generalObj.disabled;
	var service_status = 'N';
	if(service_status_check){
		service_status_text = generalObj.enabled;
		service_status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'status': service_status,
			'change_service_status': 1
		},
		url: ajaxurl + "rzvy_services_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="changed"){
				swal(service_status_text+"!", generalObj.service_status_changed_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Change Addon status JS **/
$(document).on('change', '.rzvy_change_addon_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var addon_status_check = $(this).prop('checked');
	var addon_status_text = generalObj.disabled;
	var addon_status = 'N';
	if(addon_status_check){
		addon_status_text = generalObj.enabled;
		addon_status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'status': addon_status,
			'change_addon_status': 1
		},
		url: ajaxurl + "rzvy_addons_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="changed"){
				swal(addon_status_text+"!", generalObj.addon_status_changed_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Change Addon multiple qty status JS **/
$(document).on('change', '.rzvy_change_addon_multiple_qty_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var addon_status_check = $(this).prop('checked');
	var addon_status_text = generalObj.disabled;
	var addon_status = 'N';
	if(addon_status_check){
		addon_status_text = generalObj.enabled;
		addon_status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'multiple_qty': addon_status,
			'change_addon_multiple_qty_status': 1
		},
		url: ajaxurl + "rzvy_addons_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="changed"){
				swal(addon_status_text+"!", generalObj.addon_multiple_qty_status_changed_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Add Addons JS **/
$(document).on('click', '#rzvy_add_addon_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	if($('#rzvy_add_addon_form').valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var service_id = $("#addon_ser_id").val();
		var title = $("#rzvy_addonname").val();
		var addon_image = $("#rzvy-image-upload-file-hidden").val();
		var rate = $("#rzvy_addonrate").val();
		var description = $("#rzvy_addondescription").val();
		var addon_multipleqty_status = $("input[name='rzvy_addonmultipleqty']:checked").val();
		var addon_status = $("input[name='rzvy_addonstatus']:checked").val();
		$.ajax({
			type: 'post',
			data: {
				'service_id': service_id,
				'title': title,
				'uploaded_file': addon_image,
				'description': description,
				'rate': rate,
				'multiple_qty': addon_multipleqty_status,
				'status': addon_status,
				'add_addon': 1
			},
			url: ajaxurl + "rzvy_addons_ajax.php",
			success: function (res) {
				$("#rzvy-add-addon-modal").modal("hide");
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="added"){
					swal(generalObj.added, generalObj.addon_added_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Update Addons modal detail JS **/
$(document).on('click', '.rzvy-update-addonmodal', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'update_addon_modal_detail': 1
		},
		url: ajaxurl + "rzvy_addons_ajax.php",
		success: function (res) {
			$(".rzvy-update-addon-modal-body").html(res);
			$("#rzvy-update-addon-modal").modal("show");
			$("#rzvy_update_addon_btn").attr("data-id",id);
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
/** Update Addons JS **/
$(document).on('click', '#rzvy_update_addon_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	if($('#rzvy_update_addon_form').valid()){
		var id = $("#rzvy_update_addonid_hidden").val();
		var title = $("#rzvy_update_addonname").val();
		var addon_image = $("#rzvy-update-image-upload-file-hidden").val();
		var rate = $("#rzvy_update_addonrate").val();
		var description = $("#rzvy_update_addondescription").val();
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'title': title,
				'uploaded_file': addon_image,
				'rate': rate,
				'description': description,
				'update_addon': 1
			},
			url: ajaxurl + "rzvy_addons_ajax.php",
			success: function (res) {
				$("#rzvy-update-addon-modal").modal("hide");
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					swal(generalObj.updated, generalObj.addon_updated_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});

/** support ticket discussion JS **/
(function () {
    var rzvy_support_ticket_object;
    rzvy_support_ticket_object = function (arg) {
        this.text = arg.text, this.rzvy_support_ticket_reply_side = arg.rzvy_support_ticket_reply_side;
        this.draw = function (_this) {
            return function () {
				var $message;
                $message = $($('.rzvy_support_ticket_reply_template').clone().html());
                $message.addClass(_this.rzvy_support_ticket_reply_side).find('.rzvy_support_ticket_reply_wrapper_content').html(_this.text);
				$('.rzvy_support_ticket_reply_list').append($message);
                return setTimeout(function () {
                    return $message.addClass('rzvy_show_support_ticket_reply');
                }, 0);
            };
        }(this);
        return this;
    };
    $(function () {
        var rzvy_get_support_ticket_reply, rzvy_support_ticket_reply_side, rzvy_send_support_ticket_reply;
        rzvy_support_ticket_reply_side = 'rzvy_show_support_ticket_on_right';
        rzvy_get_support_ticket_reply = function () {
            var $rzvy_support_ticket_reply_input;
            $rzvy_support_ticket_reply_input = $('.rzvy_support_ticket_reply_input');
            return $rzvy_support_ticket_reply_input.val();
        };
        rzvy_send_support_ticket_reply = function (text, ticket_id) {
            var $rzvy_support_ticket_reply_list, message;
            if (text.trim() === '') {
                return;
            }
			
			/** Add ticket discussion reply JS start */
			var ajaxurl = generalObj.ajax_url;
			$.ajax({
				type: 'post',
				data: {
					'reply': text,
					'ticket_id': ticket_id,
					'add_ticket_discussion_reply': 1
				},
				url: ajaxurl + "rzvy_support_ticket_discussions_ajax.php",
				success: function (res) { 
				}
			});
			/** Add ticket discussion reply JS end */
			
            $('.rzvy_support_ticket_reply_input').val('');
            $rzvy_support_ticket_reply_list = $('.rzvy_support_ticket_reply_list');
            rzvy_support_ticket_reply_side = 'rzvy_show_support_ticket_on_right';
            message = new rzvy_support_ticket_object({
                text: text,
                rzvy_support_ticket_reply_side: rzvy_support_ticket_reply_side
            });
            message.draw();
			$(".rzvy_remove_empty_discussion_li").remove();
            return $rzvy_support_ticket_reply_list.animate({ scrollTop: $rzvy_support_ticket_reply_list.prop('scrollHeight') }, 300);		
        };
        $('.rzvy_support_ticket_send_reply_btndiv').click(function (e) {
			var ticket_id = $(this).data("id");
            return rzvy_send_support_ticket_reply(rzvy_get_support_ticket_reply(), ticket_id);
        });
        $('.rzvy_support_ticket_reply_input').keyup(function (e) {
            if (e.which === 13) {
                var ticket_id = $(this).data("id");
				return rzvy_send_support_ticket_reply(rzvy_get_support_ticket_reply(), ticket_id);
            }
        });
    });
}.call(this));

/** Mark as read all support ticket reply modal detail JS **/
$(document).on('click', '.markasread_all_support_ticket_reply', function(){
	var site_url = generalObj.site_url;
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'markasread_all_support_ticket_reply': 1
		},
		url: ajaxurl + "rzvy_support_tickets_ajax.php",
		success: function (res) {
			window.location.href = site_url+'backend/ticket-discussion.php?tid='+id;
		}
	});
});
/** Delete support ticket JS **/
$(document).on('click', '.rzvy_delete_support_ticket_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_delete_this_support_ticket,
	  type: "error",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_delete_it,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'delete_support_ticket': 1
			},
			url: ajaxurl + "rzvy_support_tickets_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="deleted"){
					swal(generalObj.deleted, generalObj.support_ticket_added_successfully, "success");
					location.reload();
				}else if(res=="replyexist"){
					swal(generalObj.opps, generalObj.you_cannot_delete_this_support_ticket_you_have_discussion_on_this_support_ticket, "error");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Mark support ticket as completed JS **/
$(document).on('click', '.rzvy_markascomplete_support_ticket_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_mark_this_support_ticket_as_complete,
	  type: "success",
	  showCancelButton: true,
	  confirmButtonClass: "btn-success",
	  confirmButtonText: generalObj.yes_mark_as_completed,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'markascomplete_support_ticket': 1
			},
			url: ajaxurl + "rzvy_support_tickets_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					swal(generalObj.marked_as_completed, generalObj.support_ticket_marked_as_completed_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Logout JS **/
$(document).on('click','#rzvy_logout_btn',function(){
	var ajax_url = generalObj.ajax_url;
	var site_url = generalObj.site_url;
	$.ajax({
		type: 'post',
		data: {
			'logout_process': 1
		},
		url: ajax_url + "rzvy_login_ajax.php",
		success: function (res) {
			window.location = site_url+"backend";
		}
	});
});
/** Prevent enter key stroke on form inputs **/
$(document).on("keydown", '.rzvy form input', function (e) {
	if (e.keyCode == 13) {
		e.preventDefault();
		return false;
	}
});
/** Show & Hide block off custom div on change of block off type **/
$(document).on("change", ".rzvy_blockoff_type", function(){
	var btype = $(this).val();
	if(btype == "custom"){
		$(".rzvy_hide_blockoff_custom_box").slideDown();
	}else{
		$(".rzvy_hide_blockoff_custom_box").slideUp();
	}
});
/** Add Block Off JS **/
$(document).on("click", "#rzvy_add_blockoff_btn", function(){
	var ajaxurl = generalObj.ajax_url;
	
	/** Validate add block off form **/
	$('#rzvy_add_blockoff_form').validate({
		rules: {
			rzvy_blockofftitle:{ required: true },
			rzvy_blockoff_fromdate:{ required: true, date: true },
			rzvy_blockoff_todate:{ required: true, date: true },
			rzvy_blockoff_type:{ required: true },
			rzvy_blockoff_fromtime:{ required: true },
			rzvy_blockoff_totime:{ required: true },
			rzvy_blockoff_status:{ required: true }
		},
		messages: {
			rzvy_blockofftitle:{ required: generalObj.please_enter_block_off_title },
			rzvy_blockoff_fromdate:{ required: generalObj.please_select_from_date, date: generalObj.please_select_proper_date },
			rzvy_blockoff_todate:{ required: generalObj.please_select_to_date, date: generalObj.please_select_proper_date },
			rzvy_blockoff_type:{ required: generalObj.please_select_block_off_type },
			rzvy_blockoff_fromtime:{ required: generalObj.please_select_from_time },
			rzvy_blockoff_totime:{ required: generalObj.please_select_to_time },
			rzvy_blockoff_status:{ required: generalObj.please_select_status }
		}
	});
	
	var rzvy_blockoff_fromdate = $("#rzvy_blockoff_fromdate").val();
	var rzvy_blockoff_todate = $("#rzvy_blockoff_todate").val();
	
	if(new Date(rzvy_blockoff_fromdate) > new Date(rzvy_blockoff_todate)){
		swal(generalObj.opps, generalObj.please_select_from_date_less_than_to_date, "error");
		return;
	}
	
	var rzvy_blockoff_fromtime = $("#rzvy_blockoff_fromtime").val();
	var rzvy_blockoff_totime = $("#rzvy_blockoff_totime").val();
	var fromtime = new Date("May 18, 2019 "+rzvy_blockoff_fromtime);
	var totime = new Date("May 18, 2019 "+rzvy_blockoff_totime);
	
	if(fromtime.getTime() > totime.getTime()){
		swal(generalObj.opps, generalObj.please_select_from_time_less_than_to_time, "error");
		return;
	}
		
	if($("#rzvy_add_blockoff_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var rzvy_blockofftitle = $("#rzvy_blockofftitle").val();
		var rzvy_blockoff_type = $(".rzvy_blockoff_type:checked").val();
		var rzvy_blockoff_status = $(".rzvy_blockoff_status:checked").val();
		$.ajax({
			type: 'post',
			data: {
				'title': rzvy_blockofftitle,
				'from_date': rzvy_blockoff_fromdate,
				'to_date': rzvy_blockoff_todate,
				'blockoff_type': rzvy_blockoff_type,
				'from_time': rzvy_blockoff_fromtime,
				'to_time': rzvy_blockoff_totime,
				'status': rzvy_blockoff_status,
				'add_blockoff': 1
			},
			url: ajaxurl + "rzvy_block_off_ajax.php",
			success: function (res) {
				if(res=="added"){
					swal(generalObj.added, generalObj.block_off_added_successfully, "success");
					location.reload();
				}else{
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Update Block Off modal detail JS **/
$(document).on('click', '.rzvy-update-blockoffmodal', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'update_blockoff_modal_detail': 1
		},
		url: ajaxurl + "rzvy_block_off_ajax.php",
		success: function (res) {
			$(".rzvy-update-blockoff-modal-body").html(res);
			$("#rzvy-update-blockoff-modal").modal("show");
			$("#rzvy_update_blockoff_btn").attr("data-id",id);
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
/** Update block off JS **/
$(document).on('click', '#rzvy_update_blockoff_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	
	/** Validate update block off form **/
	$('#rzvy_update_blockoff_form').validate({
		rules: {
			rzvy_update_blockofftitle:{ required: true },
			rzvy_update_blockoff_fromdate:{ required: true, date: true },
			rzvy_update_blockoff_todate:{ required: true, date: true },
			rzvy_update_blockoff_type:{ required: true },
			rzvy_update_blockoff_fromtime:{ required: true },
			rzvy_update_blockoff_totime:{ required: true }
		},
		messages: {
			rzvy_update_blockofftitle:{ required: generalObj.please_enter_block_off_title },
			rzvy_update_blockoff_fromdate:{ required: generalObj.please_select_from_date, date: generalObj.please_select_proper_date },
			rzvy_update_blockoff_todate:{ required: generalObj.please_select_to_date, date: generalObj.please_select_proper_date },
			rzvy_update_blockoff_type:{ required: generalObj.please_select_block_off_type },
			rzvy_update_blockoff_fromtime:{ required: generalObj.please_select_from_time },
			rzvy_update_blockoff_totime:{ required: generalObj.please_select_to_time }
		}
	});
	
	var rzvy_update_blockoff_fromdate = $("#rzvy_update_blockoff_fromdate").val();
	var rzvy_update_blockoff_todate = $("#rzvy_update_blockoff_todate").val();
	
	if(new Date(rzvy_update_blockoff_fromdate) > new Date(rzvy_update_blockoff_todate)){
		swal(generalObj.opps, generalObj.please_select_from_date_less_than_to_date, "error");
		return;
	}
	
	var rzvy_update_blockoff_fromtime = $("#rzvy_update_blockoff_fromtime").val();
	var rzvy_update_blockoff_totime = $("#rzvy_update_blockoff_totime").val();
	var fromtime = new Date("May 18, 2019 "+rzvy_update_blockoff_fromtime);
	var totime = new Date("May 18, 2019 "+rzvy_update_blockoff_totime);
	
	if(fromtime.getTime() > totime.getTime()){
		swal(generalObj.opps, generalObj.please_select_from_time_less_than_to_time, "error");
		return;
	}
	
	if($("#rzvy_update_blockoff_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var rzvy_update_blockofftitle = $("#rzvy_update_blockofftitle").val();
		var rzvy_update_blockoff_type = $(".rzvy_update_blockoff_type:checked").val();
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'title': rzvy_update_blockofftitle,
				'from_date': rzvy_update_blockoff_fromdate,
				'to_date': rzvy_update_blockoff_todate,
				'blockoff_type': rzvy_update_blockoff_type,
				'from_time': rzvy_update_blockoff_fromtime,
				'to_time': rzvy_update_blockoff_totime,
				'update_blockoff': 1
			},
			url: ajaxurl + "rzvy_block_off_ajax.php",
			success: function (res) {
				$("#rzvy-update-blockoff-modal").modal("hide");
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					swal(generalObj.updated, generalObj.block_off_updated_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});
/** Delete blockoff JS **/
$(document).on('click', '.rzvy_delete_blockoff_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_delete_this_block_off,
	  type: "error",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_delete_it,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'delete_blockoff': 1
			},
			url: ajaxurl + "rzvy_block_off_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="deleted"){
					swal(generalObj.deleted, generalObj.block_off_deleted_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});
/** Change Block off status JS **/
$(document).on('change', '.rzvy_change_blockoff_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var status_check = $(this).prop('checked');
	var status_text = generalObj.disabled;
	var status = 'N';
	if(status_check){
		status_text = generalObj.enabled;
		status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'status': status,
			'change_blockoff_status': 1
		},
		url: ajaxurl + "rzvy_block_off_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="changed"){
				swal(status_text+"!", generalObj.block_off_status_changed_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Show hide card payemnt box JS **/
$(document).on("change", ".rzvy_payment_method_radio", function(){
	if($(this).val() == "stripe" || $(this).val() == "authorize.net" || $(this).val() == "2checkout"){
		$(".rzvy-card-payment-div").fadeIn();
	}else{
		$(".rzvy-card-payment-div").fadeOut();
	}
});
/** Customer Email Collapsible JS **/
$(document).on("click", ".rzvy_emailtemplate_settings_customer", function(){
	$(".rzvy_emailtemplate_settings_extra").removeClass("rzvy-boxshadow_active");
	$(".rzvy_emailtemplate_settings_staff").removeClass("rzvy-boxshadow_active");
	$(".rzvy_emailtemplate_settings_admin").removeClass("rzvy-boxshadow_active");
	if(!$(".rzvy_emailtemplate_settings_customer").hasClass("rzvy-boxshadow_active")){
		$(".rzvy_emailtemplate_settings_customer").addClass("rzvy-boxshadow_active");
	}
	$(".rzvy_extra_email_templates").slideUp(500);
	$(".rzvy_staff_email_templates").slideUp(500);
	$(".rzvy_admin_email_templates").slideUp(500);
	$(".rzvy_customer_email_templates").slideDown(500);
});
/** Admin Email Collapsible JS **/
$(document).on("click", ".rzvy_emailtemplate_settings_admin", function(){
	$(".rzvy_emailtemplate_settings_extra").removeClass("rzvy-boxshadow_active");
	$(".rzvy_emailtemplate_settings_staff").removeClass("rzvy-boxshadow_active");
	$(".rzvy_emailtemplate_settings_customer").removeClass("rzvy-boxshadow_active");
	if(!$(".rzvy_emailtemplate_settings_admin").hasClass("rzvy-boxshadow_active")){
		$(".rzvy_emailtemplate_settings_admin").addClass("rzvy-boxshadow_active");
	}
	$(".rzvy_extra_email_templates").slideUp(500);
	$(".rzvy_staff_email_templates").slideUp(500);
	$(".rzvy_customer_email_templates").slideUp(500);
	$(".rzvy_admin_email_templates").slideDown(500);
});
/** Staff Email Collapsible JS **/
$(document).on("click", ".rzvy_emailtemplate_settings_staff", function(){
	$(".rzvy_emailtemplate_settings_extra").removeClass("rzvy-boxshadow_active");
	$(".rzvy_emailtemplate_settings_admin").removeClass("rzvy-boxshadow_active");
	$(".rzvy_emailtemplate_settings_customer").removeClass("rzvy-boxshadow_active");
	if(!$(".rzvy_emailtemplate_settings_staff").hasClass("rzvy-boxshadow_active")){
		$(".rzvy_emailtemplate_settings_staff").addClass("rzvy-boxshadow_active");
	}
	$(".rzvy_extra_email_templates").slideUp(500);
	$(".rzvy_admin_email_templates").slideUp(500);
	$(".rzvy_customer_email_templates").slideUp(500);
	$(".rzvy_staff_email_templates").slideDown(500);
});
/** Extra Email Collapsible JS **/
$(document).on("click", ".rzvy_emailtemplate_settings_extra", function(){
	$(".rzvy_emailtemplate_settings_staff").removeClass("rzvy-boxshadow_active");
	$(".rzvy_emailtemplate_settings_admin").removeClass("rzvy-boxshadow_active");
	$(".rzvy_emailtemplate_settings_customer").removeClass("rzvy-boxshadow_active");
	if(!$(".rzvy_emailtemplate_settings_extra").hasClass("rzvy-boxshadow_active")){
		$(".rzvy_emailtemplate_settings_extra").addClass("rzvy-boxshadow_active");
	}
	$(".rzvy_admin_email_templates").slideUp(500);
	$(".rzvy_customer_email_templates").slideUp(500);
	$(".rzvy_staff_email_templates").slideUp(500);
	$(".rzvy_extra_email_templates").slideDown(500);
});
/** Customer SMS Collapsible JS **/
$(document).on("click", ".rzvy_smstemplate_settings_customer", function(){
	$(".rzvy_smstemplate_settings_extra").removeClass("rzvy-boxshadow_active");
	$(".rzvy_smstemplate_settings_staff").removeClass("rzvy-boxshadow_active");
	$(".rzvy_smstemplate_settings_admin").removeClass("rzvy-boxshadow_active");
	if(!$(".rzvy_smstemplate_settings_customer").hasClass("rzvy-boxshadow_active")){
		$(".rzvy_smstemplate_settings_customer").addClass("rzvy-boxshadow_active");
	}
	$(".rzvy_staff_sms_templates").slideUp(500);
	$(".rzvy_admin_sms_templates").slideUp(500);
	$(".rzvy_extra_sms_templates").slideUp(500);
	$(".rzvy_customer_sms_templates").slideDown(500);
});
/** Admin SMS Collapsible JS **/
$(document).on("click", ".rzvy_smstemplate_settings_admin", function(){
	$(".rzvy_smstemplate_settings_extra").removeClass("rzvy-boxshadow_active");
	$(".rzvy_smstemplate_settings_staff").removeClass("rzvy-boxshadow_active");
	$(".rzvy_smstemplate_settings_customer").removeClass("rzvy-boxshadow_active");
	if(!$(".rzvy_smstemplate_settings_admin").hasClass("rzvy-boxshadow_active")){
		$(".rzvy_smstemplate_settings_admin").addClass("rzvy-boxshadow_active");
	}
	$(".rzvy_extra_sms_templates").slideUp(500);
	$(".rzvy_staff_sms_templates").slideUp(500);
	$(".rzvy_customer_sms_templates").slideUp(500);
	$(".rzvy_admin_sms_templates").slideDown(500);
});
/** Staff SMS Collapsible JS **/
$(document).on("click", ".rzvy_smstemplate_settings_staff", function(){
	$(".rzvy_smstemplate_settings_extra").removeClass("rzvy-boxshadow_active");
	$(".rzvy_smstemplate_settings_admin").removeClass("rzvy-boxshadow_active");
	$(".rzvy_smstemplate_settings_customer").removeClass("rzvy-boxshadow_active");
	if(!$(".rzvy_smstemplate_settings_staff").hasClass("rzvy-boxshadow_active")){
		$(".rzvy_smstemplate_settings_staff").addClass("rzvy-boxshadow_active");
	}
	$(".rzvy_extra_sms_templates").slideUp(500);
	$(".rzvy_admin_sms_templates").slideUp(500);
	$(".rzvy_customer_sms_templates").slideUp(500);
	$(".rzvy_staff_sms_templates").slideDown(500);
});
/** Extra SMS Collapsible JS **/
$(document).on("click", ".rzvy_smstemplate_settings_extra", function(){
	$(".rzvy_smstemplate_settings_admin").removeClass("rzvy-boxshadow_active");
	$(".rzvy_smstemplate_settings_customer").removeClass("rzvy-boxshadow_active");
	$(".rzvy_smstemplate_settings_staff").removeClass("rzvy-boxshadow_active");
	if(!$(".rzvy_smstemplate_settings_extra").hasClass("rzvy-boxshadow_active")){
		$(".rzvy_smstemplate_settings_extra").addClass("rzvy-boxshadow_active");
	}
	$(".rzvy_admin_sms_templates").slideUp(500);
	$(".rzvy_customer_sms_templates").slideUp(500);
	$(".rzvy_staff_sms_templates").slideUp(500);
	$(".rzvy_extra_sms_templates").slideDown(500);
});
/** Customize Email Template JS **/
$(document).on("click", ".rzvy_email_template_modal_btn", function(){
	var ajaxurl = generalObj.ajax_url;
	var template = $(this).data("template");
	var template_for = $(this).data("template_for");
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'template': template,
			'template_for': template_for,
			'get_email_template': 1
		},
		url: ajaxurl + "rzvy_email_sms_templates_ajax.php",
		success: function (res) {
			$(".rzvy-emailtemplate-setting-form-modal-content").html(res);
			$("#rzvy-emailtemplate-setting-form-modal").modal("show");
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
/** Customize SMS Template JS **/
$(document).on("click", ".rzvy_sms_template_modal_btn", function(){
	var ajaxurl = generalObj.ajax_url;
	var template = $(this).data("template");
	var template_for = $(this).data("template_for");
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'template': template,
			'template_for': template_for,
			'get_sms_template': 1
		},
		url: ajaxurl + "rzvy_email_sms_templates_ajax.php",
		success: function (res) {
			$(".rzvy-smstemplate-setting-form-modal-content").html(res);
			$("#rzvy-smstemplate-setting-form-modal").modal("show");
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
/** Update Email Template JS **/
$(document).on("click", "#update_emailtemplate_settings_btn", function(){
	var ajaxurl = generalObj.ajax_url;
	var template = $("#rzvy_emailtemplate_template").val();
	var template_for = $("#rzvy_emailtemplate_template_for").val();
	var subject = $("#rzvy_email_template_subject").val();
	var email_content = $("#rzvy_email_template_content").summernote('code');
	var email_status = "N";
	if($("#rzvy_email_template_status").prop('checked')){
		email_status = "Y";
	} 
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'template': template,
			'template_for': template_for,
			'email_status': email_status,
			'subject': subject,
			'email_content': email_content,
			'update_email_template': 1
		},
		url: ajaxurl + "rzvy_email_sms_templates_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="updated"){
				$("#rzvy-emailtemplate-setting-form-modal").modal("hide");
				swal(generalObj.customized, generalObj.email_template_customized_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Update SMS Template JS **/
$(document).on("click", "#update_smstemplate_settings_btn", function(){
	var ajaxurl = generalObj.ajax_url;
	var template = $("#rzvy_smstemplate_template").val();
	var template_for = $("#rzvy_smstemplate_template_for").val();
	var sms_content = $("#rzvy_sms_template_content").val();
	var sms_status = "N";
	if($("#rzvy_sms_template_status").prop('checked')){
		sms_status = "Y";
	} 
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'template': template,
			'template_for': template_for,
			'sms_status': sms_status,
			'sms_content': sms_content,
			'update_sms_template': 1
		},
		url: ajaxurl + "rzvy_email_sms_templates_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="updated"){
				$("#rzvy-smstemplate-setting-form-modal").modal("hide");
				swal(generalObj.customized, generalObj.sms_template_customized_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});
/** Change endslot on startslot selection JS **/
$(document).on('change', '.rzvy_appt_rs_timeslot', function(){
	var ajaxurl = generalObj.ajax_url;
	var datetime = $("#rzvy_appt_rs_date").data('datetime');
	var service_id = $("#rzvy_appt_rs_sid").val();
	var staff_id = $("#rzvy_appt_rs_staffid").val();
	var selected_date = $("#rzvy_appt_rs_date").val();
	var selected_startslot = $(this).val();
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	if(generalObj.endslot_status == "Y"){
		$.ajax({
			type: 'post',
			data: {
				'booking_datetime': datetime,
				'service_id': service_id,
				'staff_id': staff_id,
				'selected_date': selected_date,
				'selected_startslot': selected_startslot,
				'get_endtimeslots': 1
			},
			url: ajaxurl + "rzvy_appointment_detail_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				$(".rzvy_appt_rs_endtimeslot").html(res);
			}
		});
	}else{
		$.ajax({
			type: 'post',
			data: {
				'booking_datetime': datetime,
				'service_id': service_id,
				'staff_id': staff_id,
				'selected_date': selected_date,
				'selected_startslot': selected_startslot,
				'get_without_endtimeslots': 1
			},
			url: ajaxurl + "rzvy_appointment_detail_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				$(".rzvy_appt_rs_endtimeslot").val(res);
			}
		});
	}
});
/** Schedule Services modal detail JS **/
$(document).on('click', '.rzvy-schedule-servicemodal', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'schedule_service_modal_detail': 1
		},
		url: ajaxurl + "rzvy_services_ajax.php",
		success: function (res) {
			$(".rzvy-schedule-service-modal-body").html(res);
			$("#rzvy-schedule-service-modal").modal("show");
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
/** Schedule Services modal detail JS **/
$(document).on('click', '#rzvy_update_service_schedule_btn', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $("#rzvy_schedule_service_id").val();
	var schedule_status = $("input[name='rzvy_service_schedule_status\\[\\]']").map(function(){ if($(this).prop("checked")){ return "N";}else{ return "Y";} }).get();
	var starttime = $("select[name='rzvy_service_starttime_dropdown\\[\\]']").map(function(){return $(this).val();}).get();
	var endtime = $("select[name='rzvy_service_endtime_dropdown\\[\\]']").map(function(){return $(this).val();}).get();
	var no_of_booking = $("input[name='rzvy_service_booking\\[\\]']").map(function(){return $(this).val();}).get();
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'schedule_status': schedule_status,
			'starttime': starttime,
			'endtime': endtime,
			'no_of_booking': no_of_booking,
			'save_service_schedule': 1
		},
		url: ajaxurl + "rzvy_services_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$("#rzvy-schedule-service-modal").modal("hide");
			swal(generalObj.updated, generalObj.service_schedule_updated_successfully, "success");
		}
	});
});
/** Update Booking Form settings JS **/
$(document).on('click', '#update_bookingform_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var uploaded_file = $("#rzvy_bookingform_bg_image-hidden").val();
	var rzvy_frontend = $("#rzvy_frontend").val();
	var rzvy_single_category_autotrigger_status = $("#rzvy_single_category_autotrigger_status").val();
	var rzvy_single_service_autotrigger_status = $("#rzvy_single_service_autotrigger_status").val();
	
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'rzvy_frontend': rzvy_frontend,
			'rzvy_single_category_autotrigger_status': rzvy_single_category_autotrigger_status,
			'rzvy_single_service_autotrigger_status': rzvy_single_service_autotrigger_status,
			'update_bookingform_settings': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.updated, generalObj.booking_form_settings_updated_successfully, "success");
		}
	});
});
/** Update Welcome Message settings JS **/
$(document).on('click', '#update_welcome_message_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var rzvy_welcome_message_container = $("#rzvy_welcome_message_container").summernote('code');
	var rzvy_welcome_message_status = $("#rzvy_welcome_message_status").val();
	var rzvy_welcome_as_more_info_status = $("#rzvy_welcome_as_more_info_status").val();
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'rzvy_welcome_message_container': rzvy_welcome_message_container,
			'rzvy_welcome_message_status': rzvy_welcome_message_status,
			'rzvy_welcome_as_more_info_status': rzvy_welcome_as_more_info_status,
			'update_welcome_message_settings': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.updated, generalObj.welcome_message_updated_successfully, "success");
		}
	});
});
/** Change pay at venue payment status JS **/
$(document).on('change', '#rzvy_pay_at_venue_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var status_text = generalObj.disabled;
	var rzvy_pay_at_venue_status = "N";
	if($("#rzvy_pay_at_venue_status").prop('checked')){
		status_text = generalObj.enabled;
		rzvy_pay_at_venue_status = "Y";
	} 
	$.ajax({
		type: 'post',
		data: {
			'rzvy_pay_at_venue_status': rzvy_pay_at_venue_status,
			'change_pay_at_venue_status': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(status_text+"!", generalObj.pay_at_venue_payment_status_changed_successfully, "success");
		}
	});
});
/** Change Existing & New User Form Fields status JS **/
$(document).on('change', '.rzvy_change_en_ff_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var fieldname = $(this).data('id');
	var fieldlabel = $(this).data('label');
	var status_check = $(this).prop('checked');
	var status_text = generalObj.disabled;
	var status = 'N';
	if(status_check){
		status_text = generalObj.enabled;
		status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'fieldname': fieldname,
			'status': status,
			'update_en_ff_settings': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$(".rzvy_change_en_ff_optional").each(function(){
				if($(this).data('id') == fieldname){
					$(this).prop('checked', false);
				}
			});
			swal(status_text+"!", fieldlabel+' '+generalObj.form_field_status_changed_successfully, "success");
		}
	});
});
/** Change Guest Form Fields status JS **/
$(document).on('change', '.rzvy_change_g_ff_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var fieldname = $(this).data('id');
	var fieldlabel = $(this).data('label');
	var status_check = $(this).prop('checked');
	var status_text = generalObj.disabled;
	var status = 'N';
	if(status_check){
		status_text = generalObj.enabled;
		status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'fieldname': fieldname,
			'status': status,
			'update_g_ff_settings': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$(".rzvy_change_g_ff_optional").each(function(){
				if($(this).data('id') == fieldname){
					$(this).prop('checked', false);
				}
			});
			swal(status_text+"!", fieldlabel+' '+generalObj.form_field_status_changed_successfully, "success");
		}
	});
});
/** Change Existing & New User Form Fields Optional status JS **/
$(document).on('change', '.rzvy_change_en_ff_optional', function(){
	var ajaxurl = generalObj.ajax_url;
	var fieldname = $(this).data('id');
	var fieldlabel = $(this).data('label');
	var status_check = $(this).prop('checked');
	var status_text = generalObj.disabled;
	var status = 'N';
	if(status_check){
		status_text = generalObj.enabled;
		status = 'Y';
	}
	
	var check_enabled = "N";
	$(".rzvy_change_en_ff_status").each(function(){
		if($(this).data('id') == fieldname){
			if($(this).prop('checked')){
				check_enabled = "Y";
			}
		}
	});
	if(check_enabled == "Y"){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'fieldname': fieldname,
				'status': status,
				'update_en_ff_optional_settings': 1
			},
			url: ajaxurl + "rzvy_settings_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(status_text+"!", fieldlabel+' '+generalObj.form_field_status_changed_successfully, "success");
			}
		});
	}else{
		$(this).prop('checked', false);
		swal(generalObj.opps, generalObj.please_enable_status, "error");
	}
});
/** Change Guest Form Fields Optional status JS **/
$(document).on('change', '.rzvy_change_g_ff_optional', function(){
	var ajaxurl = generalObj.ajax_url;
	var fieldname = $(this).data('id');
	var fieldlabel = $(this).data('label');
	var status_check = $(this).prop('checked');
	var status_text = generalObj.disabled;
	var status = 'N';
	if(status_check){
		status_text = generalObj.enabled;
		status = 'Y';
	}
	var check_enabled = "N";
	$(".rzvy_change_g_ff_status").each(function(){
		if($(this).data('id') == fieldname){
			if($(this).prop('checked')){
				check_enabled = "Y";
			}
		}
	});
	if(check_enabled == "Y"){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'fieldname': fieldname,
				'status': status,
				'update_g_ff_optional_settings': 1
			},
			url: ajaxurl + "rzvy_settings_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(status_text+"!", fieldlabel+' '+generalObj.form_field_optional_status_changed_successfully, "success");
			}
		});
	}else{
		$(this).prop('checked', false);
		swal(generalObj.opps, generalObj.please_enable_status, "error");
	}
});
/*********************************************************************/
/***********************Admin Translation Start***********************/
/*********************************************************************/
/** Save language translation JS **/
$(document).on('click', '.rzvy_rzvy_save_btn', function(){
	var lang = $('#rzvy_rzvy_langauges').val();
	if(lang != "none"){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var ajaxurl = generalObj.ajax_url;
		var group_key = $(this).data("j");
		var lang_array = {};
		
		$(".rzvy_rzvy_lang_input_"+group_key).each(function(){
			lang_array[$(this).attr('id')] =  $(this).val();
		});
		$.ajax({
			type: 'post',
			data: {
				'lang': lang,
				'lang_array': lang_array,
				'rzvy_save_selected_lang_labels': 1
			},
			url: ajaxurl + "admin_languages_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res != "notexist"){
					swal(generalObj.translated, generalObj.language_translation_saved_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}else{
		swal(generalObj.opps, generalObj.please_select_language_for_translation, "error");
	}
});
/** Get language translation JS **/
$(document).on('change', '#rzvy_rzvy_langauges', function(){
	var lang = $('#rzvy_rzvy_langauges').val();
	if(lang != "none"){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var ajaxurl = generalObj.ajax_url;
		$.ajax({
			type: 'post',
			data: {
				'lang': lang,
				'type': "C",
				'rzvy_get_selected_lang_labels': 1
			},
			url: ajaxurl + "admin_languages_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				$(".rzvy_manage_languages_container").html(res);
			}
		});
	}else{
		swal(generalObj.opps, generalObj.please_select_language_for_translation, "error");
		$(".rzvy_manage_languages_container").html("");
	}
});
/** Get language translation JS **/
$(document).on('click', '.rzvy_rzvy_edit_language', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var lang = $(this).data("lang");
	var type = $(this).data("type");
	$.ajax({
		type: 'post',
		data: {
			'lang': lang,
			'type': type,
			'rzvy_get_selected_lang_labels': 1
		},
		url: ajaxurl + "admin_languages_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$(".rzvy_manage_languages_container").html(res);
			$('#rzvy_rzvy_langauges').val(lang);
			$('#rzvy_rzvy_langauges').selectpicker('refresh');
		}
	});
});
/** Remove language JS **/
$(document).on('click', '.rzvy_rzvy_remove_language', function(){
	var ajaxurl = generalObj.ajax_url;
	var lang = $(this).data('lang');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_delete_this_language,
	  type: "error",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_delete_it,
	  cancelButtonText: generalObj.cancel,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'lang': lang,
				'rzvy_delete_lang': 1
			},
			url: ajaxurl + "admin_languages_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				$(".rzvy_remove_language_"+lang).remove();
				swal(generalObj.deleted, generalObj.language_deleted_successfully, "success");
				location.reload();
			}
		});
	});
});
/** save selected language for dd JS **/
$(document).on('change', '#rzvy_rzvy_show_dropdown_languages', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var lang = $(this).val();
	$.ajax({
		type: 'post',
		data: {
			'lang': lang,
			'save_rzvy_show_dropdown_languages': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});

/** Color Scheme Start **/
$(document).on('click', '#update_cs_admin_dash_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var rzvy_cs_admin_dash = $("#rzvy_cs_admin_dash").val();
	var rzvy_cs_admin_dash_primary_color = $("#rzvy_cs_admin_dash_primary_color").val();
	var rzvy_cs_admin_dash_secondary_color = $("#rzvy_cs_admin_dash_secondary_color").val();
	var rzvy_cs_admin_dash_background_color = $("#rzvy_cs_admin_dash_background_color").val();
	var rzvy_cs_admin_dash_text_color = $("#rzvy_cs_admin_dash_text_color").val();
	$.ajax({
		type: 'post',
		data: {
			'rzvy_cs_admin_dash': rzvy_cs_admin_dash,
			'rzvy_cs_admin_dash_primary_color': rzvy_cs_admin_dash_primary_color,
			'rzvy_cs_admin_dash_secondary_color': rzvy_cs_admin_dash_secondary_color,
			'rzvy_cs_admin_dash_background_color': rzvy_cs_admin_dash_background_color,
			'rzvy_cs_admin_dash_text_color': rzvy_cs_admin_dash_text_color,
			'update_cs_admin_dash': 1
		},
		url: ajaxurl + "rzvy_ma_colorscheme_ajax.php",
		success: function (res) {
			swal(generalObj.updated, generalObj.color_scheme_updated_successfully, "success");
			location.reload();
		}
	});
});

$(document).on('click', '#update_cs_bfls_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var rzvy_cs_bfls = $("#rzvy_cs_bfls").val();
	var rzvy_cs_bfls_primary_color = $("#rzvy_cs_bfls_primary_color").val();
	var rzvy_cs_bfls_secondary_color = $("#rzvy_cs_bfls_secondary_color").val();
	var rzvy_cs_bfls_background_color = $("#rzvy_cs_bfls_background_color").val();
	var rzvy_cs_bfls_text_color = $("#rzvy_cs_bfls_text_color").val();
	$.ajax({
		type: 'post',
		data: {
			'rzvy_cs_bfls': rzvy_cs_bfls,
			'rzvy_cs_bfls_primary_color': rzvy_cs_bfls_primary_color,
			'rzvy_cs_bfls_secondary_color': rzvy_cs_bfls_secondary_color,
			'rzvy_cs_bfls_background_color': rzvy_cs_bfls_background_color,
			'rzvy_cs_bfls_text_color': rzvy_cs_bfls_text_color,
			'update_cs_bfls': 1
		},
		url: ajaxurl + "rzvy_ma_colorscheme_ajax.php",
		success: function (res) {
			swal(generalObj.updated, generalObj.color_scheme_updated_successfully, "success");
			location.reload();
		}
	});
});

$(document).on('click', '#rzvy_cs_admin_dashboard', function(){
	var title = $("#rzvy_cs_admin_dashboard .card-body").text();
	
	var ajaxurl = generalObj.ajax_url;
	$(".rzvy-color-scheme-modal-content").html("");
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'get_cs_admin_dash': 1
		},
		url: ajaxurl + "rzvy_ma_colorscheme_ajax.php",
		success: function (res) {
			$(".rzvy-color-scheme-modal-content").html(res);
			$("#rzvy-color-scheme-modal-label").html(title);
			$("#rzvy-color-scheme-modal").modal("show");
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
$(document).on('click', '#rzvy_cs_bf_and_ls_page', function(){
	var title = $("#rzvy_cs_bf_and_ls_page .card-body").text();
	
	var ajaxurl = generalObj.ajax_url;
	$(".rzvy-color-scheme-modal-content").html("");
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'get_cs_bfls': 1
		},
		url: ajaxurl + "rzvy_ma_colorscheme_ajax.php",
		success: function (res) {
			$(".rzvy-color-scheme-modal-content").html(res);
			$("#rzvy-color-scheme-modal-label").html(title);
			$("#rzvy-color-scheme-modal").modal("show");
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});

/** Import language translation JS **/
$(document).on('click', '.rzvy_rzvy_import_language', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var lang = $(this).data("lang");
	$.ajax({
		type: 'post',
		data: {
			'lang': lang,
			'rzvy_import_selected_lang_labels': 1
		},
		url: ajaxurl + "admin_languages_ajax.php",
		success: function (res) {
			location.reload();
		}
	});
});

/** Change reminder buffer time JS **/
$(document).on('change', '#rzvy_reminder_buffer_time', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var rbtime = $(this).val();
	$.ajax({
		type: 'post',
		data: {
			'rzvy_reminder_buffer_time': rbtime,
			'change_reminder_buffer_time': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.changed, generalObj.appointment_reminder_buffer_time_changed_successfully, "success");
		}
	});
});

$(document).on("change", "#rzvy_send_email_with", function(){
	if($(this).val() == "MAIL"){
		$(".rzvy_show_hide_on_send_email_with_change").hide();
	}else{
		$(".rzvy_show_hide_on_send_email_with_change").show();
	}
});

/** SMS Settings JS **/
$(document).on("click", ".rzvy_sms_settings_sadmin", function(e){
	e.preventDefault();
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	
	$(".rzvy_sms_settings_sadmin").each(function(){
		if($(this).attr("id") != "rzvy_collapsible_"+id){
			$(this).removeClass("rzvy-boxshadow_active");
		}
	});
	if(!$("#rzvy_sms_settings_sadmin_"+id).hasClass("rzvy-boxshadow_active")){
		$(this).addClass("rzvy-boxshadow_active");
	}
	$.ajax({
		type: 'post',
		data: {
			'get_sms_settings': id
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$("#update_sms_settings_btn").attr("data-sms", id)
			$(".rzvy-sms-setting-form-modal-content").html(res);
			$("#rzvy-sms-setting-form-modal").modal("show");
		}
	});
});

/** Update SMS settings JS **/
$(document).on('click', '#update_sms_settings_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var sms = $(this).data("sms");
	
	/** Twilio SMS settings **/
	if(sms == "1"){
		var rzvy_twilio_sms_status = 'N';
		var rzvy_twilio_sms_status_check = $("#rzvy_twilio_sms_status").prop('checked');
		if(rzvy_twilio_sms_status_check){
			rzvy_twilio_sms_status = 'Y';
		}
		
		var rzvy_twilio_account_SID = $("#rzvy_twilio_account_SID").val();
		var rzvy_twilio_auth_token = $("#rzvy_twilio_auth_token").val();
		var rzvy_twilio_sender_number = $("#rzvy_twilio_sender_number").intlTelInput("getNumber");
		
		/** Validate SMS form **/
		$("#rzvy_twilio_sms_settings_form").validate();
		if(rzvy_twilio_sms_status == "Y"){
			$("#rzvy_twilio_account_SID").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_account_sid }
			});
			$("#rzvy_twilio_auth_token").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_auth_token }
			});
			$("#rzvy_twilio_sender_number").rules("add", {
				required: true, minlength: 10, maxlength: 15, pattern_phone:true, 
				messages: { required: generalObj.please_enter_sender_number, minlength: generalObj.please_enter_minimum_10_digits, maxlength: generalObj.please_enter_maximum_15_digits }
			});
		}else{
			$("#rzvy_twilio_account_SID").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_account_sid }
			});
			$("#rzvy_twilio_auth_token").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_auth_token }
			});
			$("#rzvy_twilio_sender_number").rules("add", {
				required: false, minlength: 10, maxlength: 15, pattern_phone:true, 
				messages: { required: generalObj.please_enter_sender_number, minlength: generalObj.please_enter_minimum_10_digits, maxlength: generalObj.please_enter_maximum_15_digits }
			});
		}
		if($("#rzvy_twilio_sms_settings_form").valid()){
			$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
			$.ajax({
				type: 'post',
				data: {
					'rzvy_twilio_sms_status': rzvy_twilio_sms_status,
					'rzvy_twilio_account_SID': rzvy_twilio_account_SID,
					'rzvy_twilio_auth_token': rzvy_twilio_auth_token,
					'rzvy_twilio_sender_number': rzvy_twilio_sender_number,
					'update_twilio_settings': 1
				},
				url: ajaxurl + "rzvy_settings_ajax.php",
				success: function (res) {
					$("#rzvy-sms-setting-form-modal").modal("hide");
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					swal(generalObj.updated, generalObj.twilio_sms_settings_updated_successfully, "success");
					location.reload();
				}
			});
		}
	}
	/** Plivo SMS settings **/
	else if(sms == "2"){
		var rzvy_plivo_sms_status = 'N';
		var rzvy_plivo_sms_status_check = $("#rzvy_plivo_sms_status").prop('checked');
		if(rzvy_plivo_sms_status_check){
			rzvy_plivo_sms_status = 'Y';
		}
		
		var rzvy_plivo_account_SID = $("#rzvy_plivo_account_SID").val();
		var rzvy_plivo_auth_token = $("#rzvy_plivo_auth_token").val();
		var rzvy_plivo_sender_number = $("#rzvy_plivo_sender_number").intlTelInput("getNumber");
		
		/** Validate SMS form **/
		$("#rzvy_plivo_sms_settings_form").validate();
		if(rzvy_plivo_sms_status == "Y"){
			$("#rzvy_plivo_account_SID").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_account_sid }
			});
			$("#rzvy_plivo_auth_token").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_auth_token }
			});
			$("#rzvy_plivo_sender_number").rules("add", {
				required: true, minlength: 10, maxlength: 15, pattern_phone:true, 
				messages: { required: generalObj.please_enter_sender_number, minlength: generalObj.please_enter_minimum_10_digits, maxlength: generalObj.please_enter_maximum_15_digits }
			});
		}else{
			$("#rzvy_plivo_account_SID").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_account_sid }
			});
			$("#rzvy_plivo_auth_token").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_auth_token }
			});
			$("#rzvy_plivo_sender_number").rules("add", {
				required: false, minlength: 10, maxlength: 15, pattern_phone:true, 
				messages: { required: generalObj.please_enter_sender_number, minlength: generalObj.please_enter_minimum_10_digits, maxlength: generalObj.please_enter_maximum_15_digits }
			});
		}
		if($("#rzvy_plivo_sms_settings_form").valid()){
			$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
			$.ajax({
				type: 'post',
				data: {
					'rzvy_plivo_sms_status': rzvy_plivo_sms_status,
					'rzvy_plivo_account_SID': rzvy_plivo_account_SID,
					'rzvy_plivo_auth_token': rzvy_plivo_auth_token,
					'rzvy_plivo_sender_number': rzvy_plivo_sender_number,
					'update_plivo_settings': 1
				},
				url: ajaxurl + "rzvy_settings_ajax.php",
				success: function (res) {
					$("#rzvy-sms-setting-form-modal").modal("hide");
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					swal(generalObj.updated, generalObj.plivo_sms_settings_updated_successfully, "success");
					location.reload();
				}
			});
		}
	}
	/** Nexmo SMS settings **/
	else if(sms == "3"){
		var rzvy_nexmo_sms_status = 'N';
		var rzvy_nexmo_sms_status_check = $("#rzvy_nexmo_sms_status").prop('checked');
		if(rzvy_nexmo_sms_status_check){
			rzvy_nexmo_sms_status = 'Y';
		}
		
		var rzvy_nexmo_api_key = $("#rzvy_nexmo_api_key").val();
		var rzvy_nexmo_api_secret = $("#rzvy_nexmo_api_secret").val();
		var rzvy_nexmo_from = $("#rzvy_nexmo_from").val();
		
		/** Validate SMS form **/
		$("#rzvy_nexmo_sms_settings_form").validate();
		if(rzvy_nexmo_sms_status == "Y"){
			$("#rzvy_nexmo_api_key").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_api_key }
			});
			$("#rzvy_nexmo_api_secret").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_api_secret }
			});
			$("#rzvy_nexmo_from").rules("add", {
				required: true, 
				messages: { required: generalObj.please_enter_nexmo_from }
			});
		}else{
			$("#rzvy_nexmo_api_key").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_api_key }
			});
			$("#rzvy_nexmo_api_secret").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_api_secret }
			});
			$("#rzvy_nexmo_from").rules("add", {
				required: false, 
				messages: { required: generalObj.please_enter_nexmo_from }
			});
		}
		if($("#rzvy_nexmo_sms_settings_form").valid()){
			$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
			$.ajax({
				type: 'post',
				data: {
					'rzvy_nexmo_sms_status': rzvy_nexmo_sms_status,
					'rzvy_nexmo_api_key': rzvy_nexmo_api_key,
					'rzvy_nexmo_api_secret': rzvy_nexmo_api_secret,
					'rzvy_nexmo_from': rzvy_nexmo_from,
					'update_nexmo_settings': 1
				},
				url: ajaxurl + "rzvy_settings_ajax.php",
				success: function (res) {
					$("#rzvy-sms-setting-form-modal").modal("hide");
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					swal(generalObj.updated, generalObj.nexmo_sms_settings_updated_successfully, "success");
					location.reload();
				}
			});
		}
	}
	/** TextLocal SMS settings **/
	else if(sms == "4"){
		var rzvy_textlocal_sms_status = 'N';
		var rzvy_textlocal_sms_status_check = $("#rzvy_textlocal_sms_status").prop('checked');
		if(rzvy_textlocal_sms_status_check){
			rzvy_textlocal_sms_status = 'Y';
		}
		
		var rzvy_textlocal_api_key = $("#rzvy_textlocal_api_key").val();
		var rzvy_textlocal_sender = $("#rzvy_textlocal_sender").val();
		var rzvy_textlocal_country = $("#rzvy_textlocal_country").val();
		
		/** Validate SMS form **/
		$("#rzvy_textlocal_sms_settings_form").validate();
		if(rzvy_textlocal_sms_status == "Y"){
			$("#rzvy_textlocal_api_key").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_api_key }
			});
			$("#rzvy_textlocal_sender").rules("add", {
				required: true,
				messages: { required: generalObj.please_enter_textlocal_sender }
			});
			$("#rzvy_textlocal_country").rules("add", {
				required: true, 
				messages: { required: generalObj.please_enter_country }
			});
		}else{
			$("#rzvy_textlocal_api_key").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_api_key }
			});
			$("#rzvy_textlocal_sender").rules("add", {
				required: false,
				messages: { required: generalObj.please_enter_textlocal_sender }
			});
			$("#rzvy_textlocal_country").rules("add", {
				required: false, 
				messages: { required: generalObj.please_enter_country }
			});
		}
		if($("#rzvy_textlocal_sms_settings_form").valid()){
			$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
			$.ajax({
				type: 'post',
				data: {
					'rzvy_textlocal_sms_status': rzvy_textlocal_sms_status,
					'rzvy_textlocal_api_key': rzvy_textlocal_api_key,
					'rzvy_textlocal_sender': rzvy_textlocal_sender,
					'rzvy_textlocal_country': rzvy_textlocal_country,
					'update_textlocal_settings': 1
				},
				url: ajaxurl + "rzvy_settings_ajax.php",
				success: function (res) {
					$("#rzvy-sms-setting-form-modal").modal("hide");
					$(".rzvy_main_loader").addClass("rzvy_hide_loader");
					swal(generalObj.updated, generalObj.textlocal_sms_settings_updated_successfully, "success");
					location.reload();
				}
			});
		}
	}
});
/** Update SMS settings JS **/
$(document).on('change', '#rzvy_admin_sms_notification_status', function(){
	var ajaxurl = generalObj.ajax_url;
	var rzvy_admin_sms_notification_status = 'N';
	var rzvy_admin_sms_notification_status_check = $("#rzvy_admin_sms_notification_status").prop('checked');
	
	if(rzvy_admin_sms_notification_status_check){
		rzvy_admin_sms_notification_status = 'Y';
	}
	
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'rzvy_admin_sms_notification_status': rzvy_admin_sms_notification_status,
			'update_admin_sms_settings': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.updated, generalObj.sms_settings_updated_successfully, "success");
		}
	});
});
/** Update SMS settings JS **/
$(document).on('change', '#rzvy_staff_sms_notification_status', function(){
	var ajaxurl = generalObj.ajax_url;
	var rzvy_staff_sms_notification_status = 'N';
	var rzvy_staff_sms_notification_status_check = $("#rzvy_staff_sms_notification_status").prop('checked');
	
	if(rzvy_staff_sms_notification_status_check){
		rzvy_staff_sms_notification_status = 'Y';
	}
	
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'rzvy_staff_sms_notification_status': rzvy_staff_sms_notification_status,
			'update_staff_sms_settings': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.updated, generalObj.sms_settings_updated_successfully, "success");
		}
	});
});
/** Update SMS settings JS **/
$(document).on('change', '#rzvy_customer_sms_notification_status', function(){
	var ajaxurl = generalObj.ajax_url;
	var rzvy_customer_sms_notification_status = 'N';
	var rzvy_customer_sms_notification_status_check = $("#rzvy_customer_sms_notification_status").prop('checked');
	
	if(rzvy_customer_sms_notification_status_check){
		rzvy_customer_sms_notification_status = 'Y';
	}

	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'rzvy_customer_sms_notification_status': rzvy_customer_sms_notification_status,
			'update_customer_sms_settings': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.updated, generalObj.sms_settings_updated_successfully, "success");
		}
	});
});
$(document).on('changed.bs.select', 'select.rzvy_assign_staff', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var staff_ids = $(this).val();
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'staff_ids': staff_ids,
			'assign_staff_services': 1
		},
		url: ajaxurl + "rzvy_services_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
		}
	});
});
$(document).on('click', '#rzvy_open_manual_booking_modal', function(){
	/** Trigger Category On Page Load **/
	var single_category_status = generalObj.single_category_status;
	if(single_category_status == "Y"){
		var countcats = 0;
		$('.rzvy-categories-radio-change').each(function(){		
			countcats++;
		});
		if(countcats==1){
			$('.rzvy-categories-radio-change').trigger('click');	
			$('.rzvy-company-services-blocks').hide();		
		}
	}
	
	$('#rzvy_manual_booking_modal').modal("show");
});

/** Change rzvy_default_language_on_page_load JS **/
$(document).on('change', '#rzvy_default_language_on_page_load', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var pageload_lang = $(this).val();
	$.ajax({
		type: 'post',
		data: {
			'rzvy_default_language_on_page_load': pageload_lang,
			'change_pageload_lang': 1
		},
		url: ajaxurl + "rzvy_settings_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.changed, generalObj.changed_successfully, "success");
		}
	});
});