/** set selected language for superadmin JS **/
$(document).on('change', '.sarzy_set_language', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var lang = $(this).val();
	$.ajax({
		type: 'post',
		data: {
			'lang': lang,
			'set_sarzy_selected_lang': 1
		},
		url: ajaxurl + "rzvy_set_language_ajax.php",
		success: function (res) {
			location.reload();
		}
	});
});

/** set selected language for admin JS **/
$(document).on('change', '.rzvy_set_language', function(){
	$(".rzvy_main_loader").removeClass("rzvy_hide_loader");
	var ajaxurl = generalObj.ajax_url;
	var lang = $(this).val();
	$.ajax({
		type: 'post',
		data: {
			'lang': lang,
			'set_rzvy_selected_lang': 1
		},
		url: ajaxurl + "rzvy_set_language_ajax.php",
		success: function (res) {
			location.reload();
		}
	});
});

/** Toggle comman header JS **/
$(document).on('click', '#rzvy-sasa-navbarresponsive-toggler-icon', function(){
	$("#rzvy-sasa-navbarresponsive").slideToggle();
});