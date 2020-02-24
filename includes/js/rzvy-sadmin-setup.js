/*
* rzvy
* Online Multi Business Appointment Scheduling & Reservation Booking Calendar
*/
$(document).ready(function(){
	var ajaxurl = generalObj.ajax_url;
	var site_url = generalObj.site_url;
	
	/** JS to add intltel input to phone number **/
	$("#rzvy_sadminsetup_phone, #rzvy_sadminsetup_companyphone").intlTelInput({
		separateDialCode: true,
		utilsScript: site_url+"includes/vendor/intl-tel-input/js/utils.js",
    });
	
	/** Validation patterns **/
	$.validator.addMethod("pattern_name", function(value, element) {
		return this.optional(element) || /^[a-zA-Z '.']+$/.test(value);
	}, "Please enter only alphabets");
	$.validator.addMethod("pattern_phone", function(value, element) {
		return this.optional(element) || /\d+(?:[ -]*\d+)*$/.test(value);
	}, "Please enter valid phone number [without country code]");
	$.validator.addMethod("pattern_zip", function(value, element) {
		return this.optional(element) || /^[a-zA-Z 0-9\-]*$/.test(value);
	}, "Please enter valid zip");
	
	/** Validate sadminsetup as admin form **/
	$('#rzvy_sadminsetup_form').validate({
		rules: {
			rzvy_sadminsetup_firstname:{ required: true, maxlength: 50 },
			rzvy_sadminsetup_lastname: { required:true, maxlength: 50 },
			rzvy_sadminsetup_email:{ required: true, email: true, remote: { 
				url:ajaxurl+"rzvy_check_email_ajax.php",
				type:"POST",
				async:false,
				data: {
					email: function(){ return $("#rzvy_sadminsetup_email").val(); },
					check_email_exist: 1
				}
			} },
			rzvy_sadminsetup_password:{ required: true, minlength: 8, maxlength: 20 },
			rzvy_sadminsetup_phone: { required:true, minlength: 10, maxlength: 15, pattern_phone:true },
			rzvy_sadminsetup_address: { required:true },
			rzvy_sadminsetup_city: { required:true },
			rzvy_sadminsetup_state: { required:true },
			rzvy_sadminsetup_zip: { required:true, pattern_zip:true, minlength: 5, maxlength: 10 },
			rzvy_sadminsetup_country: { required:true },
			rzvy_sadminsetup_companyname:{ required: true, maxlength: 50 },
			rzvy_sadminsetup_companyemail:{ required: true, email: true },
			rzvy_sadminsetup_companyphone: { required:true, minlength: 10, maxlength: 15, pattern_phone:true }
		},
		messages: {
			rzvy_sadminsetup_firstname:{ required: "Please enter first name", maxlength: "Please enter maximum 50 characters" },
			rzvy_sadminsetup_lastname: { required: "Please enter last name", maxlength: "Please enter maximum 50 characters" },
			rzvy_sadminsetup_email:{ required: "Please enter email", email: "Please enter valid email", remote: "Email already exist" },
			rzvy_sadminsetup_password: { required: "Please enter password", minlength: "Please enter minimum 8 characters", maxlength: "Please enter maximum 20 characters" },
			rzvy_sadminsetup_phone: { required: "Please enter phone", minlength: "Please enter minimum 10 digits", maxlength: "Please enter maximum 15 digits" },
			rzvy_sadminsetup_address: { required: "Please enter address" },
			rzvy_sadminsetup_city: { required: "Please enter city" },
			rzvy_sadminsetup_state: { required: "Please enter state" },
			rzvy_sadminsetup_zip: { required: "Please enter zip", minlength: "Please enter minimum 5 characters", maxlength: "Please enter maximum 10 characters" },
			rzvy_sadminsetup_country: { required: "Please enter country" },
			rzvy_sadminsetup_companyname:{ required: "Please enter company name", maxlength: "Please enter maximum 50 characters" },
			rzvy_sadminsetup_companyemail:{ required: "Please enter company email", email: "Please enter valid email"},
			rzvy_sadminsetup_companyphone: { required: "Please enter company phone", minlength: "Please enter minimum 10 digits", maxlength: "Please enter maximum 15 digits" }
		}
	});
});

/** sadminsetup as Admin JS **/
$(document).on('click', '#rzvy_sadminsetup_btn', function(e){
	e.preventDefault();
	var ajaxurl = generalObj.ajax_url;
	if($('#rzvy_sadminsetup_form').valid()){
		$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
		var firstname = $("#rzvy_sadminsetup_firstname").val();
		var lastname = $("#rzvy_sadminsetup_lastname").val();
		var email = $("#rzvy_sadminsetup_email").val();
		var password = $("#rzvy_sadminsetup_password").val();
		var phone = $("#rzvy_sadminsetup_phone").intlTelInput("getNumber");
		var address = $("#rzvy_sadminsetup_address").val();
		var city = $("#rzvy_sadminsetup_city").val();
		var state = $("#rzvy_sadminsetup_state").val();
		var zip = $("#rzvy_sadminsetup_zip").val();
		var country = $("#rzvy_sadminsetup_country").val();
		var companyname = $("#rzvy_sadminsetup_companyname").val();
		var companyemail = $("#rzvy_sadminsetup_companyemail").val();
		var companyphone = $("#rzvy_sadminsetup_companyphone").intlTelInput("getNumber");

		$.ajax({
			type: 'post',
			data: {
				'firstname': firstname,
				'lastname': lastname,
				'email': email,
				'password': password,
				'phone': phone,
				'address': address,
				'city': city,
				'state': state,
				'zip': zip,
				'country': country,
				'companyname': companyname,
				'companyemail': companyemail,
				'companyphone': companyphone,
				'adminsetup_settings': 1
			},
			url: ajaxurl + "rzvy_admin_setup_ajax.php",
			success: function (response) {
				$(".rzvy_main_loader").addClass("rzvy_hide_loader");
				if(response=="configured"){
					swal("Configured!", 'Your settings configured successfully.', "success");
					location.reload();
				}else{
					swal("Opps!", "Something went wrong. Please try again. "+response, "error");
				}
			}
		});
	}
});

/** Prevent enter key stroke on form inputs **/
$(document).on("keydown", '.rzvy form input', function (e) {
	if (e.keyCode == 13) {
		e.preventDefault();
		return false;
	}
});