<?php 
$cs_cdash = $obj_settings->get_option("rzvy_cs_admin_dash"); 
$cs_cdash_pcolor = $obj_settings->get_option("rzvy_cs_admin_dash_primary_color"); 
$cs_cdash_scolor = $obj_settings->get_option("rzvy_cs_admin_dash_secondary_color"); 
$cs_cdash_bgcolor = $obj_settings->get_option("rzvy_cs_admin_dash_background_color"); 
$cs_cdash_tcolor = $obj_settings->get_option("rzvy_cs_admin_dash_text_color"); 

if($cs_cdash == "custom"){
	?>
	<style>
	.rzvy{ background-color: <?php echo $cs_cdash_pcolor; ?> !important; } 
	.rzvy .breadcrumb{ background-color: <?php echo $cs_cdash_scolor; ?> !important; } 
	.rzvy .rzvy-content-wrapper{ background-color: <?php echo $cs_cdash_bgcolor; ?> !important; color: <?php echo $cs_cdash_tcolor; ?> !important; } 
	.rzvy #rzvy-mainnav{ background-color: <?php echo $cs_cdash_pcolor; ?> !important; } 
	.rzvy #rzvy-mainnav.navbar-dark .navbar-collapse .navbar-sidenav{ background: <?php echo $cs_cdash_pcolor; ?> !important; } 

	.rzvy #rzvy-mainnav a.navbar-brand,
	.rzvy #rzvy-mainnav.navbar-dark .navbar-collapse .navbar-sidenav > .nav-item > .nav-link:hover,
	.rzvy #rzvy-mainnav.navbar-dark .navbar-collapse .navbar-sidenav > .nav-item > .nav-link{ color: <?php echo $cs_cdash_tcolor; ?> !important; }
	
	#rzvy-mainnav .navbar-collapse .navbar-nav .nav-item .nav-link{ color: <?php echo $cs_cdash_tcolor; ?> !important; }
	
	#rzvy-menu-accordion .nav-item:hover,
	#rzvy-menu-accordion .nav-item.rzy_active{ background: <?php echo $cs_cdash_scolor; ?> !important; } 
	
	#rzvy-mainnav .navbar-collapse .navbar-nav .nav-item .nav-link{ color: <?php echo $cs_cdash_tcolor; ?> !important; }
	#rzvy-mainnav .navbar-collapse .navbar-nav .nav-item .nav-link:hover,
	#rzvy-mainnav .navbar-collapse .navbar-nav .nav-item .nav-link.rzy_active{ color: <?php echo $cs_cdash_scolor; ?> !important; } 
	.rzvy .breadcrumb .breadcrumb-item + .breadcrumb-item::before,
	.rzvy .breadcrumb .breadcrumb-item.active,
	.rzvy .breadcrumb .breadcrumb-item a{ color: <?php echo $cs_cdash_tcolor; ?> !important; } 
	
	.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover,
	.dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate,
	.dataTables_wrapper .dataTables_paginate .paginate_button.disabled, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:active,
	.table-responsive label,
	.table-responsive{
		 color: <?php echo $cs_cdash_tcolor; ?> !important; 
	}
	
	.rzvy select.form-control:not([size]):not([multiple]),
	.rzvy .card,
	.rzvy .modal-dialog,
	.form-control::placeholder{ color: <?php echo $cs_cdash_tcolor; ?> !important; }
	
	.rzvy-tabbable-panel{
		background: <?php echo $cs_cdash_scolor; ?> !important;
		border-color: <?php echo $cs_cdash_scolor; ?> !important;
	}
	.rzvy-tabbable-line > .nav-tabs > li.open, 
	.rzvy-tabbable-line > .nav-tabs > li:hover,
	.rzvy-tabbable-line > .nav-tabs > li.active,
	.rzvy-tabbable-line > .nav-tabs > li.active > a > i,
	.rzvy-tabbable-line > .nav-tabs > li.active > a{
		background: <?php echo $cs_cdash_pcolor; ?> !important;
		border-color: <?php echo $cs_cdash_scolor; ?> !important;
		color: <?php echo $cs_cdash_tcolor; ?> !important;
	}
	
	.rzvy-tabbable-line > .nav-tabs > li > a > i,
	.rzvy-tabbable-line > .nav-tabs > li > a{
		color: <?php echo $cs_cdash_tcolor; ?> !important;
	}
	
	.rzvy-boxshadow.card{
		box-shadow: unset !important;
		background: <?php echo $cs_cdash_scolor; ?> !important;
		border-color: <?php echo $cs_cdash_pcolor; ?> !important;
	}
	
	.rzvy .dropdown-menu-titles,
	#rzvy-refund-dropdown-content,
	#rzvy-notification-dropdown-content{
		color: <?php echo $cs_cdash_tcolor; ?> !important;
	}
	
	.rzvy-subscription-pricing-table{
		background: <?php echo $cs_cdash_pcolor; ?> !important;
	}
	
	.rzvy-subscription-pricing-table .rzvy-subscription-pricing-table-button{
		border-color: <?php echo $cs_cdash_scolor; ?> !important;
	}
	.rzvy-subscription-pricing-table .rzvy-subscription-pricing-table-button::after{
		border-color: transparent <?php echo $cs_cdash_scolor; ?> transparent transparent !important;
	}
	.rzvy-subscription-pricing-table .rzvy-subscription-pricing-table-button::before{
		border-color: transparent transparent transparent <?php echo $cs_cdash_scolor; ?> !important;
	}
	.rzvy-subscription-pricing-table .rzvy-subscription-pricing-table-button,
	.rzvy-subscription-pricing-table .rzvy-white,
	.rzvy-subscription-pricing-table .rzvy-subscription-pricing-table-title,
	.rzvy-subscription-pricing-table .rzvy-subscription-pricing-table-plan-name{
		color: <?php echo $cs_cdash_tcolor; ?> !important;
	}
	</style>
	<?php 
} 
?>