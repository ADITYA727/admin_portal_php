/*
* rzvy
* Online Multi Business Appointment Scheduling & Reservation Booking Calendar
*/
/** Initialization on ready state JS **/
$(document).ready(function () {
	var ajaxurl = generalObj.ajax_url;
	var site_url = generalObj.site_url;
	var rzvy_pageurl = window.location.pathname;
	if(rzvy_pageurl.indexOf("backend/staff") != -1){
		$('#rzvy-staff-list li:first').trigger("click");
	}
});

$(document).ajaxComplete( function(){
	var site_url = generalObj.site_url;
	/** JS to add intltel input to phone number **/
	$("#rzvy_staff_phone").intlTelInput({
		initialCountry: generalObj.defaultCountryCode,
		separateDialCode: true,
		utilsScript: site_url+"includes/vendor/intl-tel-input/js/utils.js",
	});
	$(".rzvy_staff_starttime_dropdown, .rzvy_staff_endtime_dropdown").selectpicker();
	$('#rzvy_staffdaysoff_list_table').DataTable().destroy();
	$("#rzvy_staffdaysoff_list_table").DataTable({
		bPaginate: $('#rzvy_staffdaysoff_list_table tbody tr').length>10
	});
});

$(document).bind('ready ajaxComplete',function(){
	$(".rzvy_assign_staff").selectpicker();
});

/** STAFF Module JS START **/
$(document).on('click', ".rzvy_uncheckall_services_btn", function() {
	$(".rzvy-cat-services").prop("checked", false);
});

/** Get Staff detail card content */
$(document).on('click', ".rzvy-staff-selection", function() {
	var ajaxurl = generalObj.ajax_url;
	$(".rzvy-staff-selection").removeClass("active");
	$(this).addClass("active");
	var id = $(this).data('id');
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'staff_detail_card': 1
		},
		url: ajaxurl + "rzvy_staff_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$("#rzvy-staff-detail-card").html(res);
			$("#rzvy_staff_detail_tab_selection").trigger("click");
		}
	});
});

/** Get Staff detail tab content */
$(document).on('click', "#rzvy_staff_detail_tab_selection", function() {
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'staff_detail_tab': 1
		},
		url: ajaxurl + "rzvy_staff_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$("#rzvy-staff-tab-content").html(res);
		}
	});
});

/** Get Staff services tab content */
$(document).on('click', "#rzvy_staff_services_tab_selection", function() {
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'staff_services_tab': 1
		},
		url: ajaxurl + "rzvy_staff_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$("#rzvy-staff-tab-content").html(res);
		}
	});
});

/** Get Staff schedule tab content */
$(document).on('click', "#rzvy_staff_schedule_tab_selection", function() {
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'staff_schedule_tab': 1
		},
		url: ajaxurl + "rzvy_staff_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$("#rzvy-staff-tab-content").html(res);
		}
	});
});

/** Get Staff blockoff tab content */
$(document).on('click', "#rzvy_staff_blockoff_tab_selection", function() {
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'staff_blockoff_tab': 1
		},
		url: ajaxurl + "rzvy_staff_ajax.php",
		success: function (res) {
			$("#rzvy-add-staffdaysoff-modal").modal("hide");
			$("#rzvy-mainnav").removeAttr("style");
			$("#rzvy-page-top").removeAttr("style");
			$("#rzvy-page-top").removeClass("modal-open");
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$("#rzvy-staff-tab-content").html(res);
		}
	});
});

/** Change staff status JS **/
$(document).on('change', '#rzvy_staff_status', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	var staff_status_check = $(this).prop('checked');
	var staff_status_text = generalObj.disabled;
	var staff_status = 'N';
	if(staff_status_check){
		staff_status_text = generalObj.enabled;
		staff_status = 'Y';
	}
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'status': staff_status,
			'change_staff_status': 1
		},
		url: ajaxurl + "rzvy_staff_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			if(res=="changed"){
				swal(staff_status_text+"!", generalObj.staff_status_changed_successfully, "success");
			}else{
				swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
			}
		}
	});
});

/** Save staff detail JS **/
$(document).on('click', '.rzvy_save_staff_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var uploaded_file = $("#rzvy-image-upload-file-hidden").val();
	var firstname = $("#rzvy_staff_firstname").val();
	var lastname = $("#rzvy_staff_lastname").val();
	var phone = $("#rzvy_staff_phone").intlTelInput("getNumber");
	var address = $("#rzvy_staff_address").val();
	var city = $("#rzvy_staff_city").val();
	var state = $("#rzvy_staff_state").val();
	var zip = $("#rzvy_staff_zip").val();
	var country = $("#rzvy_staff_country").val();
	var id = $("#rzvy-staff-detail-id-hidden").val();
	
	/** Validate update Profile form **/
	$('#rzvy_staff_detail_form').validate({
		rules: {
			rzvy_staff_firstname:{ required: true, maxlength: 50 },
			rzvy_staff_lastname: { required:true, maxlength: 50 },
			rzvy_staff_phone: { required:true, minlength: 10, maxlength: 15, pattern_phone:true },
			rzvy_staff_address: { required:true },
			rzvy_staff_city: { required:true },
			rzvy_staff_state: { required:true },
			rzvy_staff_zip: { required:true, pattern_zip:true, minlength: 5, maxlength: 10 },
			rzvy_staff_country: { required:true }
		},
		messages: {
			rzvy_staff_firstname:{ required: generalObj.please_enter_first_name, maxlength: generalObj.please_enter_maximum_50_characters },
			rzvy_staff_lastname: { required: generalObj.please_enter_last_name, maxlength: generalObj.please_enter_maximum_50_characters },
			rzvy_staff_phone: { required: generalObj.please_enter_phone_number, minlength: generalObj.please_enter_minimum_10_digits, maxlength: generalObj.please_enter_maximum_15_digits },
			rzvy_staff_address: { required: generalObj.please_enter_address },
			rzvy_staff_city: { required: generalObj.please_enter_city },
			rzvy_staff_state: { required: generalObj.please_enter_state },
			rzvy_staff_zip: { required: generalObj.please_enter_zip, minlength: generalObj.please_enter_minimum_5_characters, maxlength: generalObj.please_enter_maximum_10_characters },
			rzvy_staff_country: { required: generalObj.please_enter_country }
		}
	});
	
	if($("#rzvy_staff_detail_form").valid()){
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
				'save_staff': 1
			},
			url: ajaxurl + "rzvy_staff_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					swal(generalObj.updated, generalObj.staff_detail_updated_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});

/** Add staff JS **/
$(document).on('click', '.rzvy_addstaff_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var firstname = $("#rzvy_addstaff_firstname").val();
	var lastname = $("#rzvy_addstaff_lastname").val();
	var email = $("#rzvy_addstaff_email").val();
	var password = $("#rzvy_addstaff_password").val();
	
	/** Validate add staff form **/
	$('#rzvy_addstaff_form').validate({
		rules: {
			rzvy_addstaff_firstname:{ required: true, maxlength: 50 },
			rzvy_addstaff_lastname: { required:true, maxlength: 50 },
			rzvy_addstaff_email: { required:true, email:true, remote: { 
				url:ajaxurl+"rzvy_check_email_ajax.php",
				type:"POST",
				async:false,
				data: {
					email: function(){ return $("#rzvy_addstaff_email").val(); },
					check_front_email_exist: 1
				}
			} },
			rzvy_addstaff_password: { required:true, minlength: 8, maxlength: 20 },
			rzvy_addstaff_cpassword: { required:true, equalTo: "#rzvy_addstaff_password", minlength: 8, maxlength: 20 }
		},
		messages: {
			rzvy_addstaff_firstname:{ required: generalObj.please_enter_first_name, maxlength: generalObj.please_enter_maximum_50_characters },
			rzvy_addstaff_lastname: { required: generalObj.please_enter_last_name, maxlength: generalObj.please_enter_maximum_50_characters },
			rzvy_addstaff_email:{ required: generalObj.please_enter_email_address, email: generalObj.please_enter_valid_email_address, remote: generalObj.email_already_exist },
			rzvy_addstaff_password: { required: generalObj.please_enter_password, minlength: generalObj.please_enter_minimum_8_characters, maxlength: generalObj.please_enter_maximum_20_characters },
			rzvy_addstaff_cpassword: { required: generalObj.please_enter_confirm_password, equalTo: generalObj.password_and_confirm_password_mismatch, minlength: generalObj.please_enter_minimum_8_characters, maxlength: generalObj.please_enter_maximum_20_characters }
		}
	});
	if($("#rzvy_addstaff_form").valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'firstname': firstname,
				'lastname': lastname,
				'email': email,
				'password': password,
				'add_staff': 1
			},
			url: ajaxurl + "rzvy_staff_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="added"){
					swal(generalObj.added, generalObj.staff_added_successfully, "success");
					location.reload();
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});

/** Delete staff JS **/
$(document).on('click', '.rzvy_delete_staff_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data('id');
	swal({
	  title: generalObj.are_you_sure,
	  text: generalObj.you_want_to_delete_this_staff,
	  type: "error",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: generalObj.yes_delete_it,
	  closeOnConfirm: false
	},
	function(){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'delete_staff': 1
			},
			url: ajaxurl + "rzvy_staff_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="deleted"){
					swal(generalObj.deleted, generalObj.staff_deleted_successfully, "success");
					location.reload();
				}else if(res=="appointments exist"){
					swal(generalObj.opps, generalObj.You_cannot_delete_this_staff_you_have_appointment_with_this_staff, "error");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	});
});

/** Save Staff Services **/
$(document).on("click", ".rzvy_update_staff_services_btn", function(){
	var id = $("#rzvy-staff-detail-id-hidden").val();
	var ajaxurl = generalObj.ajax_url;
	var services = "";
	var i = 0;
	$(".rzvy-cat-services").each(function(){
		if($(this).prop("checked")){
			if(i==0){
				services = services+$(this).data("id");
				i++;
			}else{
				services = services+','+$(this).data("id");
				i++;
			}
		}
	});
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'services': services,
			'save_staff_services': 1
		},
		url: ajaxurl + "rzvy_staff_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			swal(generalObj.updated, generalObj.staff_service_updated_successfully, "success");
		}
	});
});

function rzvy_isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

/** Add Staff breaks **/
$(document).on("click", ".rzvy_update_staff_schedule_btn", function(){
	var id = $("#rzvy-staff-detail-id-hidden").val();
	var ajaxurl = generalObj.ajax_url;
	var offday = [];
	var starttime = [];
	var endtime = [];
	var no_of_booking = [];
	var starttime_error = [];
	var endtime_error = [];
	var no_of_booking_error = [];

	$(".rzvy_staff_schedule_offday").each(function(){
		if($(this).prop("checked")){
			offday.push("N");
		}else{
			offday.push("Y");
		}
	});

	$(".rzvy_staff_starttime_dropdown").each(function(){
		if($(this).val() != ""){
			var id = $(this).data('id');
			var start_time = $(this).val();
			var position = $('option:selected', this).data('position');
			var dayname = $(this).data('dayname');
			var endtime_position = $('#rzvy_staff_endtime_dropdown_'+id+' option:selected').data('position');
			if(endtime_position>position){
				starttime.push(start_time);
			}else{
				starttime_error.push(dayname);
			}
		}
	});
	
	$(".rzvy_staff_endtime_dropdown").each(function(){
		if($(this).val() != ""){
			var id = $(this).data('id');
			var end_time = $(this).val();
			var position = $('option:selected', this).data('position');
			var dayname = $(this).data('dayname');
			var starttime_position = $('#rzvy_staff_starttime_dropdown_'+id+' option:selected').data('position');
			if(starttime_position<position){
				endtime.push(end_time);
			}else{
				endtime_error.push(dayname);
			}
		}
	});
	
	$(".rzvy_staff_no_of_booking").each(function(){
		var no_of_b = $(this).val();
		var dayname = $(this).data('dayname');
		if(no_of_b != ""){
			if(rzvy_isNumber(no_of_b)){
				if(no_of_b>=0){
					no_of_booking.push(no_of_b);
				}else{
					no_of_booking_error.push(dayname);
				}
			}else{
				no_of_booking_error.push(dayname);
			}
		}else{
			no_of_booking_error.push(dayname);
		}
	});
	
	if(starttime_error.length>0){
		var start_error = starttime_error.join(", ");
		swal(generalObj.opps, generalObj.please_select_start_time_less_than_end_time_for+" "+start_error+".", "error");
	}else if(endtime_error.length>0){
		var end_error = endtime_error.join(", ");
		swal(generalObj.opps, generalObj.please_select_end_time_greater_than_start_time_for+" "+end_error+".", "error");
	}else if(no_of_booking_error.length>0){
		var nob_error = no_of_booking_error.join(", ");
		swal(generalObj.opps, generalObj.please_enter_valid_no_of_booking_for+" "+nob_error+".", "error");
	}else{
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'offday': offday,
				'starttime': starttime,
				'endtime': endtime,
				'no_of_booking': no_of_booking,
				'save_staff_schedule': 1
			},
			url: ajaxurl + "rzvy_staff_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				swal(generalObj.updated, generalObj.staff_schedule_updated_successfully, "success");
			}
		});
	}
});

/** Add Staff breaks **/
$(document).on("click", ".rzvy_addbreak_btn", function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $("#rzvy-staff-detail-id-hidden").val();
	var dayid = $(this).data("dayid");
	var break_start = $("#rzvy_addbreak_starttime_"+dayid+' option:selected').val();
	var break_end = $("#rzvy_addbreak_endtime_"+dayid+' option:selected').val();
	
	if(break_start != "" && break_end != ""){
		if(break_start < break_end){
			$("#rzvy-add-break-modal_"+id).modal("hide");
			$('body').removeClass('modal-open');
			$('.modal-backdrop').fadeOut();
			$.ajax({
				type: 'post',
				data: {
					'id': id,
					'dayid': dayid,
					'break_start': break_start,
					'break_end': break_end,
					'add_staff_breaks': 1
				},
				url: ajaxurl + "rzvy_staff_ajax.php",
				success: function (res) {
					if(res == "added"){
						swal(generalObj.added, generalObj.staff_break_added_successfully, "success");
						$("#rzvy_staff_schedule_tab_selection").trigger("click");
					}
				}
			});
		}else if(break_start > break_end){
			swal(generalObj.opps, generalObj.please_select_break_start_less_than_break_end, "error");
		}else if(break_start == break_end){
			swal(generalObj.opps, generalObj.break_start_should_not_be_equal_to_break_end, "error");
		}
	}
});

/** Delete Staff breaks **/
$(document).on("click", ".rzvy_delete_staffbreak", function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	swal({
		title: generalObj.are_you_sure,
		text: generalObj.you_want_to_delete_this_break,
		type: "error",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: generalObj.yes_delete_it,
		closeOnConfirm: false
	  },
	  function(){
		  $(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		  $.ajax({
			  type: 'post',
			  data: {
				  'id': id,
				  'delete_staffbreak': 1
			  },
			  url: ajaxurl + "rzvy_staff_ajax.php",
			  success: function (res) {
				  $(".rzvy_main_loader").addClass("rzvy_hide_loader");
				  if(res=="deleted"){
					  swal(generalObj.deleted, generalObj.break_deleted_successfully, "success");
					  $("#rzvy_staff_schedule_tab_selection").trigger("click");
				  }else{
					  swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				  }
			  }
		  });
	  });
});

/** Add staff days off JS */
$(document).on("click", "#rzvy_add_staffdaysoff_btn", function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $("#rzvy-staff-detail-id-hidden").val();
	var off_date = $("#rzvy_staffdaysoff_date").val();
	if(rzvy_isValidDate(off_date)){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'off_date': off_date,
				'add_staff_daysoff': 1
			},
			url: ajaxurl + "rzvy_staff_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res == "added"){
					swal(generalObj.added, generalObj.days_off_added_successfully, "success");
					$("#rzvy-add-staffdaysoff-modal").modal('hide');		
					$(".modal-backdrop").remove();
					$("#rzvy_staff_blockoff_tab_selection").trigger("click");
				}
			}
		});
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

/** Delete Staff days off **/
$(document).on("click", ".rzvy_delete_staff_daysoff_btn", function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	swal({
		title: generalObj.are_you_sure,
		text: generalObj.you_want_to_delete_this_offday,
		type: "error",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: generalObj.yes_delete_it,
		closeOnConfirm: false
	  },
	  function(){
		  $(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		  $.ajax({
			  type: 'post',
			  data: {
				  'id': id,
				  'delete_staffdaysoff': 1
			  },
			  url: ajaxurl + "rzvy_staff_ajax.php",
			  success: function (res) {
				  $(".rzvy_main_loader").addClass("rzvy_hide_loader");
				  if(res=="deleted"){
					  swal(generalObj.deleted, generalObj.days_off_deleted_successfully, "success");
					  $("#rzvy_staff_blockoff_tab_selection").trigger("click");
				  }else{
					  swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				  }
			  }
		  });
	  });
});
/** STAFF Module JS END **/

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

$(document).on('click', '.rzvy_addbreak_popover', function(){
	var ajaxurl = generalObj.ajax_url;
	var id = $(this).data("id");
	var weekday_id = $(this).data("weekday_id");
	var start_time = $('#rzvy_staff_starttime_dropdown_'+id+' option:selected').val();
	var end_time = $('#rzvy_staff_endtime_dropdown_'+id+' option:selected').val();

	$.ajax({
		type: 'post',
		data: {
			'start_time': start_time,
			'end_time': end_time,
			'weekday_id': weekday_id,
			'update_break_data_content': 1
		},
		url: ajaxurl + "rzvy_staff_ajax.php",
		success: function (res) {
			$("#rzvy_addbreak_popover_datacontent_"+id).html(res);
			$("#rzvy-add-break-modal_"+id).modal("show");
		}
	});
});

/**  Staff Calendar Filters START */
$(document).on('click', '#rzvy-staff-calendar a', function(){
	var ajaxurl = generalObj.ajax_url;
    var id = $(this).data('id');	
	$('#rzvy-staff-calendar a').removeClass("rzvy_staff_active");
	$(this).addClass("rzvy_staff_active");
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	$.ajax({
		type: 'post',
		data: {
			'id': id,
			'set_staff_calendar': 1
		},
		url: ajaxurl + "rzvy_staff_ajax.php",
		success: function (res) {
			$(".rzvy_main_loader").addClass("rzvy_hide_loader");
			$('#rzvy-appointments-calendar').fullCalendar('refetchEvents');
		}
	});
});

/** Change Staff email JS **/
$(document).on('click', '#rzvy_change_staff_email_btn', function(){
	var ajaxurl = generalObj.ajax_url;
	/** Validate Change Email form **/
	$('#rzvy_change_staff_email_form').validate({
		rules: {
			rzvy_change_staff_email:{ required: true, email: true }
		},
		messages: {
			rzvy_change_staff_email:{ required: generalObj.please_enter_email_address, email: generalObj.please_enter_valid_email_address }
		}
	});
	if($("#rzvy_change_staff_email_form").valid()){
		var id = $("#rzvy-staff-detail-id-hidden").val();
		var email = $("#rzvy_change_staff_email").val();
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		$.ajax({
			type: 'post',
			data: {
				'id': id,
				'email': email,
				'change_email': 1
			},
			url: ajaxurl + "rzvy_staff_ajax.php",
			success: function (res) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(res=="updated"){
					swal(generalObj.changed, generalObj.email_changed_successfully, "success");
					$("#rzvy_staff_detail_tab_selection").trigger("click");
				}else if(res=="exist"){
					swal(generalObj.exist, generalObj.email_already_exist_please_try_to_update_with_not_registered_email, "error");
				}else{
					swal(generalObj.opps, generalObj.something_went_wrong_please_try_again, "error");
				}
			}
		});
	}
});