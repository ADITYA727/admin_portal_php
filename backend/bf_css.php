<?php 
$cs_bfls = $obj_settings->get_option("rzvy_cs_bfls"); 
$cs_bfls_pcolor = $obj_settings->get_option("rzvy_cs_bfls_primary_color"); 
$cs_bfls_scolor = $obj_settings->get_option("rzvy_cs_bfls_secondary_color"); 
$cs_bfls_bgcolor = $obj_settings->get_option("rzvy_cs_bfls_background_color"); 
$cs_bfls_tcolor = $obj_settings->get_option("rzvy_cs_bfls_text_color"); 

if($cs_bfls == "custom"){
	?>
	<style>	
		.rzvy-inline-calendar,
		.rzvy-location-selector-bg,
		.rzvy-booking-detail-block{ 
			background-color:<?php echo $cs_bfls_bgcolor;?> !important;
		}
		
		#rzvy_refresh_cart h4,
		#rzvy_refresh_cart p,
		#rzvy_refresh_cart label{ 
			color:<?php echo $cs_bfls_scolor;?> !important;
		}
		.rzvy label,
		.rzvy .rzvy_txt_color,
		.rzvy p{
			color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy_list_of_feedbacks p{
			color: <?php echo $cs_bfls_scolor;?> !important;
		}
		#rzvy_logout_btn,
		.rzvy h1,
		.rzvy h2,
		.rzvy h3,
		.rzvy h4,
		.rzvy h5,
		.rzvy h6{
			color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		
		.rzvy-location-selector-bg h3{ 
			color:<?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-location-selector-bg .modal-body{
			border-color: <?php echo $cs_bfls_scolor;?> !important;
		}
		.rzvy_sticky_bottom_booking_summary{
			width: 92% !important;
			margin-bottom: 1rem !important;
		}
		.rzvy .rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:hover,
		.rzvy .rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:active,
		.col-md-4.rzvy-set-sm-fit.mb-5,
		.rzvy-booking-detail-main{
			background-color:<?php echo $cs_bfls_scolor;?> !important;
		}		
		.rzvy-big-block-btn,
		.rzvy-block-btn,
		.rzvy-block-btn:hover,
		.rzvy-terms-and-condition .rzvy-tc-control-input:checked ~ .rzvy-tc-control-indicator{ 
			background-color:<?php echo $cs_bfls_pcolor;?> !important;
			color:<?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-header-style{
			border-top: 5px solid <?php echo $cs_bfls_bgcolor;?> !important;
			border-bottom: 5px solid <?php echo $cs_bfls_bgcolor;?> !important;
			background: <?php echo $cs_bfls_scolor;?> !important;
		}
		.rzvy-styled-radio input[type="radio"]:checked + label{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		#rzvy_apply_referral_coupon,
		#rzvy-available-coupons-open-modal{
			color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.form-control::placeholder,
		.rzvy-input-class::placeholder{
			color: <?php echo $cs_bfls_scolor;?> !important;
		}
		#rzvy_refresh_cart i{
			color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-radio-group-block-content{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		
		.rzvy-addons-multipleqty-counter-item-center,
		.rzvy-addons-multipleqty-counter-minus, .rzvy-addons-multipleqty-counter-plus,
		.rzvy-addons-multipleqty-counter,
		.rzvy-addons-multipleqty-box-icon{
			border-color: <?php echo $cs_bfls_tcolor;?> !important;
			color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		
		.rzvy-inline-calendar-container-main-rowcel p,
		.rzvy_full_day_available_label,
		.rzvy_fhalf_available_label,
		.rzvy_shalf_available_label,
		.rzvy_full_day_off_label,
		.rzvy-inline-calendar-container-main-rowcol,
		.rzvy_center_title,
		.btn.btn-link,
		.rzvy_apply_referral_coupon_div,
		.rzvy_applied_referral_coupon_div_text,
		.rzvy_referral_code_applied_div,
		.rzvy-tc-control-description,
		.rzvy_referral_code_div,
		.rzvy-payments,
		.rzvy-user-selection-label,
		.rzvy-radio-group-block p,
		.rzvy_available_slots_block b,
		.rzvy-radio-group-block-content h4{
			color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-inline-calendar-container-main-rowcel.full_day_available,
		.rzvy_full_day_available_label span{
			background: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy_fhalf_available_label span{
			background: linear-gradient(180deg, <?php echo $cs_bfls_pcolor;?> 50%, <?php echo $cs_bfls_scolor;?> 50%) !important;
		}
		.rzvy_shalf_available_label span{
			background: linear-gradient(180deg, <?php echo $cs_bfls_scolor;?> 50%, <?php echo $cs_bfls_pcolor;?> 50%) !important;
		}
		.rzvy-inline-calendar-container-main-rowcel.full_day_off,
		.rzvy_full_day_off_label span{
			background: <?php echo $cs_bfls_scolor;?> !important;
		}
		
		.rzvy-styled-radio label{
			color: <?php echo $cs_bfls_tcolor;?> !important;
			border-color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy_selected_slot_detail i,
		.rzvy_selected_slot_detail,
		.rzvy_reset_slot_selection{
			color:<?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-terms-and-condition .rzvy-tc-control-description a,
		.rzvy-styled-radio label:hover{
			color:<?php echo $cs_bfls_pcolor;?> !important;
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-addons-multipleqty-counter__value{
			color:<?php echo $cs_bfls_pcolor;?>;
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
			background-color: <?php echo $cs_bfls_scolor;?> !important;
		}
		.rzvy-addons-multipleqty-counter-minus:hover,
		.rzvy-addons-multipleqty-counter-plus:hover{
			color:<?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy .rzvy-companytitle{
			color:<?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-sidebar-block-content h4 span{
			color:<?php echo $cs_bfls_pcolor;?> !important;
		}
		
		.rzvy-selected-addon,
		.rzvy-services-items li label:hover,
		.rzvy-addons-singleqty-items li label:hover,
		.rzvy-services-items input[type="checkbox"]:checked + label:hover,
		.rzvy-services-items input[type="checkbox"]:checked + label:active,
		.rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:hover,
		.rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:active{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
			color:<?php echo $cs_bfls_pcolor;?> !important;
		}
		
		.rzvy-services-items input[type="checkbox"]:checked + label,
		.rzvy-addons-singleqty-items input[type="checkbox"]:checked + label{
			border:2px solid <?php echo $cs_bfls_pcolor;?> !important;
			color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-payments input[type="radio"]:checked + label::before,
		.rzvy-payments input[type="radio"]:checked + label::before,
		.rzvy-users-selection-div input[type="radio"]:checked + label::before{
			box-shadow:inset 0 0 0 18px <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-users-selection-div input[type="radio"] + label::before,
		.rzvy-payments input[type="radio"] + label::before{
			box-shadow: inset 0 0 0 2px <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-sidebar-block-title h4{
			text-align:center;
			color:<?php echo $cs_bfls_scolor;?> !important;
			background-color:<?php echo $cs_bfls_bgcolor;?> !important;
		}
		.rzvy-inline-calendar-container-main-rowcel.second_half_available_date{
			background: linear-gradient(180deg, <?php echo $cs_bfls_scolor;?> 50%, <?php echo $cs_bfls_pcolor;?> 50%) !important;
		}
		.rzvy-inline-calendar-container-main-rowcel.first_half_available_date{
			background: linear-gradient(180deg, <?php echo $cs_bfls_pcolor;?> 50%, <?php echo $cs_bfls_scolor;?> 50%) !important;
		}
		</style>
	<?php 
} 
?>