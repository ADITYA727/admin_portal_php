<?php 
$cs_bdp_lr = $obj_settings->get_option("rzvy_cs_admin_dash"); 
$cs_bdp_lr_pcolor = $obj_settings->get_option("rzvy_cs_admin_dash_primary_color"); 
$cs_bdp_lr_scolor = $obj_settings->get_option("rzvy_cs_admin_dash_secondary_color"); 
$cs_bdp_lr_bgcolor = $obj_settings->get_option("rzvy_cs_admin_dash_background_color"); 
$cs_bdp_lr_tcolor = $obj_settings->get_option("rzvy_cs_admin_dash_text_color"); 

if($cs_bdp_lr == "custom"){
	?>
	<style>
	.rzvy, .rzvy .rzvy-login-main, .rzvy .rzvy-register-main{ background-color: <?php echo $cs_bdp_lr_bgcolor; ?> !important; } 
	
	.rzvy-register-container{ background: <?php echo $cs_bdp_lr_bgcolor; ?> !important; } 
	.rzvy_header_bg_clr{ background-color: <?php echo $cs_bdp_lr_pcolor; ?> !important; } 
	.rzvy_header_bg_clr .navbar-brand{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; } 
	.rzvy-register-right-block{ background-color: <?php echo $cs_bdp_lr_scolor; ?> !important; } 
	#rzvy-main-menu-collapse .nav-link{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; } 
	
	.rzvy .rzvy-login-form-block{ border-color: <?php echo $cs_bdp_lr_scolor; ?> !important; background-color: <?php echo $cs_bdp_lr_scolor; ?> !important; }
	.rzvy .rzvy-login-form-block h2::after{ background: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-login-form-block h2{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-login-form-block label, 
	.rzvy .rzvy-login-form-block small{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-login-form-block a{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-login-form-block p{ color: <?php echo $cs_bdp_lr_pcolor; ?> !important; }
	
	.rzvy .rzvy-register-container h2::after{ background: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-register-container h2{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-register-container label, 
	.rzvy .rzvy-register-container small{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-register-container a{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-register-container p, 
	.rzvy .rzvy-register-container span{ color: <?php echo $cs_bdp_lr_pcolor; ?> !important; }
	
	.rzvy .rzvy-register-right-block{ border-color: <?php echo $cs_bdp_lr_bgcolor; ?> !important; }
	.rzvy .rzvy-register-right-block small{ color: <?php echo $cs_bdp_lr_pcolor; ?> !important; }
	
	.rzvy .rzvy_register_btn, 
	.rzvy .rzvy_reset_password_btn, 
	.rzvy #rzvy_forgot_password_btn, 
	.rzvy #rzvy_login_btn{
		border-color: <?php echo $cs_bdp_lr_pcolor; ?> !important;
		background: <?php echo $cs_bdp_lr_pcolor; ?> !important;
		color: <?php echo $cs_bdp_lr_tcolor; ?> !important;
	}
	
	/** Business Directory **/
	.rzvy .rzvy-banner-overlay { background: <?php echo $cs_bdp_lr_scolor; ?> !important; }
	.rzvy .rzvy-footer-bg { background: <?php echo $cs_bdp_lr_pcolor; ?> !important; }
	.rzvy .rzvy-footer-bg p{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-paddingtb60 .list-group .list-group-item.bg-light{ background: <?php echo $cs_bdp_lr_scolor; ?> !important; color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-paddingtb60 .list-group .rzvy_set_btype_filter{ background: <?php echo $cs_bdp_lr_scolor; ?>; color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	
	.rzvy #rzvy_get_all_business_list .rzvy-business-card i, .rzvy #rzvy_get_all_business_list .rzvy-business-card h5{ color: <?php echo $cs_bdp_lr_pcolor; ?> !important; }
	
	.rzvy .rzvy_set_btype_filter.btype_active, 
	.rzvy .rzvy_set_btype_filter:hover,
	.rzvy #rzvy_search_business_btn, 
	.rzvy #rzvy_get_all_business_list .rzvy-business-card a, 
	.rzvy #rzvy_get_all_business_list .rzvy-business-card a i, 
	.rzvy #rzvy_reset_business_btn{
		border-color: <?php echo $cs_bdp_lr_pcolor; ?> !important;
		background: <?php echo $cs_bdp_lr_pcolor; ?> !important;
		color: <?php echo $cs_bdp_lr_tcolor; ?> !important;
	}
	.rzvy .rzvy-bsearch-result-heading{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy .rzvy-bsearch-result-heading h3{ text-shadow: 3px 4px 6px <?php echo $cs_bdp_lr_pcolor; ?> !important; }
	
	.rzvy #rzvy_get_all_business_list .rzvy-business-card{ border-color: <?php echo $cs_bdp_lr_scolor; ?> !important; background: <?php echo $cs_bdp_lr_scolor; ?> !important; }
	
	.rzvy #rzvy_get_all_business_list .rzvy-business-card b,
	.rzvy #rzvy_get_all_business_list .rzvy-business-card div,
	.rzvy #rzvy_get_all_business_list .rzvy-business-card p{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	.rzvy #rzvy_get_all_business_list .rzvy-business-card .btn.focus, .rzvy #rzvy_get_all_business_list .rzvy-business-card .btn:focus{ box-shadow: unset !important; }
	
	.rzvy .rzvy_header_book_now_btn.btn.focus, .rzvy .rzvy_header_book_now_btn.btn:focus{ box-shadow: unset !important; }
	.rzvy .rzvy_header_book_now_btn{
		border-color: <?php echo $cs_bdp_lr_scolor; ?> !important;
		background: <?php echo $cs_bdp_lr_scolor; ?> !important;
		color: <?php echo $cs_bdp_lr_tcolor; ?> !important;
	}
	.form-control::placeholder{ color: <?php echo $cs_bdp_lr_tcolor; ?> !important; }
	</style>
	<?php 
} 
?>