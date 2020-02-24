<?php 
$cs_bfls = $obj_settings->get_option("rzvy_cs_bfls"); 
$cs_bfls_pcolor = $obj_settings->get_option("rzvy_cs_bfls_primary_color"); 
$cs_bfls_scolor = $obj_settings->get_option("rzvy_cs_bfls_secondary_color"); 
$cs_bfls_bgcolor = $obj_settings->get_option("rzvy_cs_bfls_background_color"); 
$cs_bfls_tcolor = $obj_settings->get_option("rzvy_cs_bfls_text_color"); 

if($cs_bfls == "custom"){
	?>
	<style>	
		.rzvy-connecting-line,
		body.rzvy,
		.rzvy-inline-calendar,
		.rzvy-location-selector-bg,
		.rzvy-booking-detail-block{ 
			background-color:<?php echo $cs_bfls_bgcolor;?> !important;
		}
		.rzvy-location-selector-bg h3{ 
			color:<?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-wizard,
		.rzvy-location-selector-bg .modal-body{
			border-color: <?php echo $cs_bfls_scolor;?> !important;
			background-color: <?php echo $cs_bfls_scolor;?> !important;
		}
		.rzvy .border{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-round-tab{
			border-color: <?php echo $cs_bfls_scolor;?> !important;
		}
		.rzvy-wizard li a.active .rzvy-round-tab,
		.rzvy-round-tab:hover{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-wizard .nav-tabs > li a{
			color: <?php echo $cs_bfls_tcolor;?> !important;
			background-color: transparent !important;
			border-color: transparent !important;
		}
		.rzvy-custom-radio-main input[type="radio"] + label{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		:checked + .rzvy_addons_label,
		.rzvy-custom-radio-main input[type="radio"]:checked + label{
			border-color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy_addons_label::before{
			color: <?php echo $cs_bfls_pcolor;?> !important;
			border-color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		:checked + .rzvy_addons_label::before{
			background-color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy_addons_label,
		.rzvy hr{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy h1,
		.rzvy h2,
		.rzvy h3,
		.rzvy h4,
		.rzvy h5,
		.rzvy h6{
			color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy label,
		.rzvy .rzvy_txt_color,
		.rzvy-wizard li a .rzvy-round-tab i{
			color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-wizard li a .rzvy-round-tab{
			background-color: <?php echo $cs_bfls_scolor;?> !important;
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-wizard li a.active .rzvy-round-tab{
			background-color: <?php echo $cs_bfls_scolor;?> !important;
			border-color: <?php echo $cs_bfls_bgcolor;?> !important;
		}
		.rzvy-wizard li a.active .rzvy-round-tab i{
			color: <?php echo $cs_bfls_bgcolor;?> !important;
		}
		.rzvy-custom-btn, 
		#rzvy_main_wizard .rzvy_previousstep_btn, 
		#rzvy_main_wizard .rzvy_nextstep_btn{
			background-color: <?php echo $cs_bfls_pcolor;?> !important;
			color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-custom-btn:hover, 
		#rzvy_main_wizard .rzvy_previousstep_btn:hover, 
		#rzvy_main_wizard .rzvy_nextstep_btn:hover{
			background-color: <?php echo $cs_bfls_tcolor;?> !important;
			color: <?php echo $cs_bfls_pcolor;?> !important;
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
		.rzvy-inline-calendar-container-main-rowcel p,
		.rzvy_full_day_available_label,
		.rzvy_fhalf_available_label,
		.rzvy_shalf_available_label,
		.rzvy_full_day_off_label,
		.rzvy-inline-calendar-container-main-rowcol,
		.rzvy_center_title,
		.btn.btn-link,
		#rzvy_refresh_cart h4,
		#rzvy_refresh_cart p,
		#rzvy_refresh_cart label,
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
		.rzvy .rzvy-companytitle,
		.rzvy-sidebar-block-content h4 span{
			color:<?php echo $cs_bfls_tcolor;?> !important;
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
			color:<?php echo $cs_bfls_tcolor;?> !important;
			background-color:#fff;
		}
		
		.rzvy_cart_calculations{ 
			border-color:<?php echo $cs_bfls_pcolor;?> !important;
		}
		#rzvy_refresh_cart th{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		
		#rzvy-thankyou h4,
		#rzvy-thankyou h6,
		#rzvy-thankyou .rzvy-h span,
		#rzvy_refresh_cart th,
		#rzvy_refresh_cart td,
		#rzvy_apply_referral_coupon,
		#rzvy-available-coupons-open-modal{ 
			color:<?php echo $cs_bfls_tcolor;?> !important;
		}
		#rzvy-thankyou i,
		.rzvy a{ 
			color:<?php echo $cs_bfls_pcolor;?> !important;
		}

		.rzvy-inline-calendar-container-main-rowcel.second_half_available_date{
			background: linear-gradient(180deg, <?php echo $cs_bfls_scolor;?> 50%, <?php echo $cs_bfls_pcolor;?> 50%) !important;
		}
		.rzvy-inline-calendar-container-main-rowcel.first_half_available_date{
			background: linear-gradient(180deg, <?php echo $cs_bfls_pcolor;?> 50%, <?php echo $cs_bfls_scolor;?> 50%) !important;
		}
		.rzvy-inline-calendar-container-main-rowcel p:hover,
		.rzvy-inline-calendar-container-main-rowcel.active_selected_date p{
			color: #fff !important;
		}
		</style>
	<?php 
} 
?>