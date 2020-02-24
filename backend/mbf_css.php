<?php 
$cs_bfls = $obj_settings->get_option("rzvy_cs_bfls"); 
$cs_bfls_pcolor = $obj_settings->get_option("rzvy_cs_bfls_primary_color"); 
$cs_bfls_scolor = $obj_settings->get_option("rzvy_cs_bfls_secondary_color"); 
$cs_bfls_bgcolor = $obj_settings->get_option("rzvy_cs_bfls_background_color"); 
$cs_bfls_tcolor = $obj_settings->get_option("rzvy_cs_bfls_text_color"); 

if($cs_bfls == "custom"){
	?>
	<style>	
		.rzvy-mb .rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:hover,
		.rzvy-mb .rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:active,
		.rzvy-mb .rzvy-inline-calendar,
		.rzvy-mb .rzvy-booking-detail-block{ 
			background-color:<?php echo $cs_bfls_bgcolor;?> !important;
		}
		.rzvy-mb .rzvy-location-selector-bg h3{ 
			color:<?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-mb .rzvy-location-selector-bg .modal-body{
			border-color: <?php echo $cs_bfls_scolor;?> !important;
		}
		.rzvy-mb .rzvy_sticky_bottom_booking_summary{
			width: 92% !important;
			margin-bottom: 1rem !important;
		}
		.rzvy-mb .rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:hover,
		.rzvy-mb .rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:active,
		.rzvy-mb .col-md-4.rzvy-set-sm-fit.mb-5,
		.rzvy-mb .rzvy-booking-detail-main{
			background-color:<?php echo $cs_bfls_scolor;?> !important;
		}		
		.rzvy-mb .rzvy-big-block-btn,
		.rzvy-mb .rzvy-block-btn,
		.rzvy-mb .rzvy-block-btn:hover,
		.rzvy-mb .rzvy-terms-and-condition .rzvy-tc-control-input:checked ~ .rzvy-tc-control-indicator{ 
			background-color:<?php echo $cs_bfls_pcolor;?> !important;
			color:<?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-mb .rzvy-styled-radio input[type="radio"]:checked + label{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .form-control::placeholder,
		.rzvy-mb .rzvy-input-class::placeholder{
			color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-mb #rzvy_refresh_cart i{
			color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .rzvy-radio-group-block-content{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .rzvy-inline-calendar-container-main-rowcel p,
		.rzvy-mb .rzvy_full_day_available_label,
		.rzvy-mb .rzvy_fhalf_available_label,
		.rzvy-mb .rzvy_shalf_available_label,
		.rzvy-mb .rzvy_full_day_off_label,
		.rzvy-mb .rzvy-inline-calendar-container-main-rowcol,
		.rzvy-mb .rzvy_center_title,
		.rzvy-mb .btn.btn-link,
		.rzvy-mb #rzvy_refresh_cart h4,
		.rzvy-mb #rzvy_refresh_cart p,
		.rzvy-mb #rzvy_refresh_cart label,
		.rzvy-mb .rzvy-tc-control-description,
		.rzvy-mb .rzvy-payments,
		.rzvy-mb .rzvy-user-selection-label,
		.rzvy-mb .rzvy-radio-group-block p,
		.rzvy-mb .rzvy_available_slots_block b,
		.rzvy-mb .rzvy-radio-group-block-content h4{
			color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-mb .rzvy-inline-calendar-container-main-rowcel.full_day_available,
		.rzvy-mb .rzvy_full_day_available_label span{
			background: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .rzvy_fhalf_available_label span{
			background: linear-gradient(180deg, <?php echo $cs_bfls_pcolor;?> 50%, <?php echo $cs_bfls_scolor;?> 50%) !important;
		}
		.rzvy-mb .rzvy_shalf_available_label span{
			background: linear-gradient(180deg, <?php echo $cs_bfls_scolor;?> 50%, <?php echo $cs_bfls_pcolor;?> 50%) !important;
		}
		.rzvy-mb .rzvy-inline-calendar-container-main-rowcel.full_day_off,
		.rzvy-mb .rzvy_full_day_off_label span{
			background: <?php echo $cs_bfls_scolor;?> !important;
		}
		
		.rzvy-mb .rzvy-styled-radio label{
			color: <?php echo $cs_bfls_tcolor;?> !important;
			border-color: <?php echo $cs_bfls_tcolor;?> !important;
		}
		.rzvy-mb .rzvy_selected_slot_detail i,
		.rzvy-mb .rzvy_selected_slot_detail,
		.rzvy-mb .rzvy_reset_slot_selection{
			color:<?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .rzvy-terms-and-condition .rzvy-tc-control-description a,
		.rzvy-mb .rzvy-styled-radio label:hover{
			color:<?php echo $cs_bfls_pcolor;?> !important;
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .rzvy-addons-multipleqty-counter__value{
			color:<?php echo $cs_bfls_pcolor;?>;
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
			background-color: <?php echo $cs_bfls_scolor;?> !important;
		}
		.rzvy-mb .rzvy-addons-multipleqty-counter-minus:hover,
		.rzvy-mb .rzvy-addons-multipleqty-counter-plus:hover{
			color:<?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .rzvy .rzvy-companytitle,
		.rzvy-mb .rzvy-sidebar-block-content h4 span{
			color:<?php echo $cs_bfls_tcolor;?> !important;
		}
		
		.rzvy-mb .rzvy-selected-addon,
		.rzvy-mb .rzvy-services-items li label:hover,
		.rzvy-mb .rzvy-addons-singleqty-items li label:hover,
		.rzvy-mb .rzvy-services-items input[type="checkbox"]:checked + label:hover,
		.rzvy-mb .rzvy-services-items input[type="checkbox"]:checked + label:active,
		.rzvy-mb .rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:hover,
		.rzvy-mb .rzvy-addons-singleqty-items input[type="checkbox"]:checked + label:active{
			border-color: <?php echo $cs_bfls_pcolor;?> !important;
			color:<?php echo $cs_bfls_pcolor;?> !important;
		}
		
		.rzvy-mb .rzvy-services-items input[type="checkbox"]:checked + label,
		.rzvy-mb .rzvy-addons-singleqty-items input[type="checkbox"]:checked + label{
			border:2px solid <?php echo $cs_bfls_pcolor;?> !important;
			color: <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .rzvy-payments input[type="radio"]:checked + label::before,
		.rzvy-mb .rzvy-payments input[type="radio"]:checked + label::before,
		.rzvy-mb .rzvy-users-selection-div input[type="radio"]:checked + label::before{
			box-shadow:inset 0 0 0 18px <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .rzvy-users-selection-div input[type="radio"] + label::before,
		.rzvy-mb .rzvy-payments input[type="radio"] + label::before{
			box-shadow: inset 0 0 0 2px <?php echo $cs_bfls_pcolor;?> !important;
		}
		.rzvy-mb .rzvy-sidebar-block-title h4{
			text-align:center;
			color:<?php echo $cs_bfls_tcolor;?> !important;
			background-color:#fff;
		}
		</style>
	<?php 
} 
?>