/*
* rzvy
* Online Multi Business Appointment Scheduling & Reservation Booking Calendar
*/

/** Prevent enter key stroke on form inputs **/
$(document).on("keydown", '.rzvy input', function (e) {
	if (e.keyCode == 13) {
		e.preventDefault();
		return false;
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
						swal(generalObj.available_our_service_available_at_your_location, "", "success");
						window.location.href = siteurl;
					}else{
						swal(generalObj.opps_we_are_not_available_at_your_location, "", "error");
					}
				}
			});
		}else{
			swal(generalObj.please_enter_valid_zipcode, "", "error");
		}
	}else{
		swal(generalObj.please_enter_valid_zipcode, "", "error");
	}
});