<?php 
include 'header.php';
include 'currency.php'; 
$countrycodeArr = array("af" => "+93 Afghanistan (‫افغانستان‬‎)", "al" => "+355 Albania (Shqipëri)", "dz" => "+213 Algeria (‫الجزائر‬‎)", "as" => "+1684 American Samoa", "ad" => "+376 Andorra", "ao" => "+244 Angola", "ai" => "+1264 Anguilla", "ag" => "+1268 Antigua and Barbuda", "ar" => "+54 Argentina", "am" => "+374 Armenia (Հայաստան)", "aw" => "+297 Aruba", "au" => "+61 Australia", "at" => "+43 Austria (Österreich)", "az" => "+994 Azerbaijan (Azərbaycan)", "bs" => "+1242 Bahamas", "bh" => "+973 Bahrain (‫البحرين‬‎)", "bd" => "+880 Bangladesh (বাংলাদেশ)", "bb" => "+1246 Barbados", "by" => "+375 Belarus (Беларусь)", "be" => "+32 Belgium (België)", "bz" => "+501 Belize", "bj" => "+229 Benin (Bénin)", "bm" => "+1441 Bermuda", "bt" => "+975 Bhutan (འབྲུག)", "bo" => "+591 Bolivia", "ba" => "+387 Bosnia and Herzegovina (Босна и Херцеговина)", "bw" => "+267 Botswana", "br" => "+55 Brazil (Brasil)", "io" => "+246 British Indian Ocean Territory", "vg" => "+1284 British Virgin Islands", "bn" => "+673 Brunei", "bg" => "+359 Bulgaria (България)", "bf" => "+226 Burkina Faso", "bi" => "+257 Burundi (Uburundi)", "kh" => "+855 Cambodia (កម្ពុជា)", "cm" => "+237 Cameroon (Cameroun)", "ca" => "+1 Canada", "cv" => "+238 Cape Verde (Kabu Verdi)", "bq" => "+599 Caribbean Netherlands", "ky" => "+1345 Cayman Islands", "cf" => "+236 Central African Republic (République centrafricaine)", "td" => "+235 Chad (Tchad)", "cl" => "+56 Chile", "cn" => "+86 China (中国)", "cx" => "+61 Christmas Island", "cc" => "+61 Cocos (Keeling) Islands", "co" => "+57 Colombia", "km" => "+269 Comoros (‫جزر القمر‬‎)", "cd" => "+243 Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)", "cg" => "+242 Congo (Republic) (Congo-Brazzaville)", "ck" => "+682 Cook Islands", "cr" => "+506 Costa Rica", "ci" => "+225 Côte d’Ivoire", "hr" => "+385 Croatia (Hrvatska)", "cu" => "+53 Cuba", "cw" => "+599 Curaçao", "cy" => "+357 Cyprus (Κύπρος)", "cz" => "+420 Czech Republic (Česká republika)", "dk" => "+45 Denmark (Danmark)", "dj" => "+253 Djibouti", "dm" => "+1767 Dominica", "do" => "+1 Dominican Republic (República Dominicana)", "ec" => "+593 Ecuador", "eg" => "+20 Egypt (‫مصر‬‎)", "sv" => "+503 El Salvador", "gq" => "+240 Equatorial Guinea (Guinea Ecuatorial)", "er" => "+291 Eritrea", "ee" => "+372 Estonia (Eesti)", "et" => "+251 Ethiopia", "fk" => "+500 Falkland Islands (Islas Malvinas)", "fo" => "+298 Faroe Islands (Føroyar)", "fj" => "+679 Fiji", "fi" => "+358 Finland (Suomi)", "fr" => "+33 France", "gf" => "+594 French Guiana (Guyane française)", "pf" => "+689 French Polynesia (Polynésie française)", "ga" => "+241 Gabon", "gm" => "+220 Gambia", "ge" => "+995 Georgia (საქართველო)", "de" => "+49 Germany (Deutschland)", "gh" => "+233 Ghana (Gaana)", "gi" => "+350 Gibraltar", "gr" => "+30 Greece (Ελλάδα)", "gl" => "+299 Greenland (Kalaallit Nunaat)", "gd" => "+1473 Grenada", "gp" => "+590 Guadeloupe", "gu" => "+1671 Guam", "gt" => "+502 Guatemala", "gg" => "+44 Guernsey", "gn" => "+224 Guinea (Guinée)", "gw" => "+245 Guinea-Bissau (Guiné Bissau)", "gy" => "+592 Guyana", "ht" => "+509 Haiti", "hn" => "+504 Honduras", "hk" => "+852 Hong Kong (香港)", "hu" => "+36 Hungary (Magyarország)", "is" => "+354 Iceland (Ísland)", "in" => "+91 India (भारत)", "id" => "+62 Indonesia", "ir" => "+98 Iran (‫ایران‬‎)", "iq" => "+964 Iraq (‫العراق‬‎)", "ie" => "+353 Ireland", "im" => "+44 Isle of Man", "il" => "+972 Israel (‫ישראל‬‎)", "it" => "+39 Italy (Italia)", "jm" => "+1 Jamaica", "jp" => "+81 Japan (日本)", "je" => "+44 Jersey", "jo" => "+962 Jordan (‫الأردن‬‎)", "kz" => "+7 Kazakhstan (Казахстан)", "ke" => "+254 Kenya", "ki" => "+686 Kiribati", "xk" => "+383 Kosovo", "kw" => "+965 Kuwait (‫الكويت‬‎)", "kg" => "+996 Kyrgyzstan (Кыргызстан)", "la" => "+856 Laos (ລາວ)", "lv" => "+371 Latvia (Latvija)", "lb" => "+961 Lebanon (‫لبنان‬‎)", "ls" => "+266 Lesotho", "lr" => "+231 Liberia", "ly" => "+218 Libya (‫ليبيا‬‎)", "li" => "+423 Liechtenstein", "lt" => "+370 Lithuania (Lietuva)", "lu" => "+352 Luxembourg", "mo" => "+853 Macau (澳門)", "mk" => "+389 Macedonia (FYROM) (Македонија)", "mg" => "+261 Madagascar (Madagasikara)", "mw" => "+265 Malawi", "my" => "+60 Malaysia", "mv" => "+960 Maldives", "ml" => "+223 Mali", "mt" => "+356 Malta", "mh" => "+692 Marshall Islands", "mq" => "+596 Martinique", "mr" => "+222 Mauritania (‫موريتانيا‬‎)", "mu" => "+230 Mauritius (Moris)", "yt" => "+262 Mayotte", "mx" => "+52 Mexico (México)", "fm" => "+691 Micronesia", "md" => "+373 Moldova (Republica Moldova)", "mc" => "+377 Monaco", "mn" => "+976 Mongolia (Монгол)", "me" => "+382 Montenegro (Crna Gora)", "ms" => "+1664 Montserrat", "ma" => "+212 Morocco (‫المغرب‬‎)", "mz" => "+258 Mozambique (Moçambique)", "mm" => "+95 Myanmar (Burma) (မြန်မာ)", "na" => "+264 Namibia (Namibië)", "nr" => "+674 Nauru", "np" => "+977 Nepal (नेपाल)", "nl" => "+31 Netherlands (Nederland)", "nc" => "+687 New Caledonia (Nouvelle-Calédonie)", "nz" => "+64 New Zealand", "ni" => "+505 Nicaragua", "ne" => "+227 Niger (Nijar)", "ng" => "+234 Nigeria", "nu" => "+683 Niue", "nf" => "+672 Norfolk Island", "kp" => "+850 North Korea (조선 민주주의 인민 공화국)", "mp" => "+1670 Northern Mariana Islands", "no" => "+47 Norway (Norge)", "om" => "+968 Oman (‫عُمان‬‎)", "pk" => "+92 Pakistan (‫پاکستان‬‎)", "pw" => "+680 Palau", "ps" => "+970 Palestine (‫فلسطين‬‎)", "pa" => "+507 Panama (Panamá)", "pg" => "+675 Papua New Guinea", "py" => "+595 Paraguay", "pe" => "+51 Peru (Perú)", "ph" => "+63 Philippines", "pl" => "+48 Poland (Polska)", "pt" => "+351 Portugal", "pr" => "+1 Puerto Rico", "qa" => "+974 Qatar (‫قطر‬‎)", "re" => "+262 Réunion (La Réunion)", "ro" => "+40 Romania (România)", "ru" => "+7 Russia (Россия)", "rw" => "+250 Rwanda", "bl" => "+590 Saint Barthélemy", "sh" => "+290 Saint Helena", "kn" => "+1869 Saint Kitts and Nevis", "lc" => "+1758 Saint Lucia", "mf" => "+590 Saint Martin (Saint-Martin (partie française))", "pm" => "+508 Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)", "vc" => "+1784 Saint Vincent and the Grenadines", "ws" => "+685 Samoa", "sm" => "+378 San Marino", "st" => "+239 São Tomé and Príncipe (São Tomé e Príncipe)", "sa" => "+966 Saudi Arabia (‫المملكة العربية السعودية‬‎)", "sn" => "+221 Senegal (Sénégal)", "rs" => "+381 Serbia (Србија)", "sc" => "+248 Seychelles", "sl" => "+232 Sierra Leone", "sg" => "+65 Singapore", "sx" => "+1721 Sint Maarten", "sk" => "+421 Slovakia (Slovensko)", "si" => "+386 Slovenia (Slovenija)", "sb" => "+677 Solomon Islands", "so" => "+252 Somalia (Soomaaliya)", "za" => "+27 South Africa", "kr" => "+82 South Korea (대한민국)", "ss" => "+211 South Sudan (‫جنوب السودان‬‎)", "es" => "+34 Spain (España)", "lk" => "+94 Sri Lanka (ශ්‍රී ලංකාව)", "sd" => "+249 Sudan (‫السودان‬‎)", "sr" => "+597 Suriname", "sj" => "+47 Svalbard and Jan Mayen", "sz" => "+268 Swaziland", "se" => "+46 Sweden (Sverige)", "ch" => "+41 Switzerland (Schweiz)", "sy" => "+963 Syria (‫سوريا‬‎)", "tw" => "+886 Taiwan (台灣)", "tj" => "+992 Tajikistan", "tz" => "+255 Tanzania", "th" => "+66 Thailand (ไทย)", "tl" => "+670 Timor-Leste", "tg" => "+228 Togo", "tk" => "+690 Tokelau", "to" => "+676 Tonga", "tt" => "+1868 Trinidad and Tobago", "tn" => "+216 Tunisia (‫تونس‬‎)", "tr" => "+90 Turkey (Türkiye)", "tm" => "+993 Turkmenistan", "tc" => "+1649 Turks and Caicos Islands", "tv" => "+688 Tuvalu", "vi" => "+1340 U.S. Virgin Islands", "ug" => "+256 Uganda", "ua" => "+380 Ukraine (Україна)", "ae" => "+971 United Arab Emirates (‫الإمارات العربية المتحدة‬‎)", "gb" => "+44 United Kingdom", "us" => "+1 United States", "uy" => "+598 Uruguay", "uz" => "+998 Uzbekistan (Oʻzbekiston)", "vu" => "+678 Vanuatu", "va" => "+39 Vatican City (Città del Vaticano)", "ve" => "+58 Venezuela", "vn" => "+84 Vietnam (Việt Nam)", "wf" => "+681 Wallis and Futuna (Wallis-et-Futuna)", "eh" => "+212 Western Sahara (‫الصحراء الغربية‬‎)", "ye" => "+967 Yemen (‫اليمن‬‎)", "zm" => "+260 Zambia", "zw" => "+263 Zimbabwe", "ax" => "+358 Åland Islands"); 
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['settings'])){ echo $rzvy_translangArr['settings']; }else{ echo $rzvy_defaultlang['settings']; } ?></li>
      </ol>
	  <div class="mb-3">
		<div class="rzvy-tabbable-panel">
			<div class="rzvy-tabbable-line">
				<ul class="nav nav-tabs">
				  <li class="nav-item active custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="0" data-toggle="tab" href="#rzvy_general_settings"><i class="fa fa-home"></i> <?php if(isset($rzvy_translangArr['company_settings'])){ echo $rzvy_translangArr['company_settings']; }else{ echo $rzvy_defaultlang['company_settings']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="1" data-toggle="tab" href="#rzvy_appearance_settings"><i class="fa fa-tachometer"></i> <?php if(isset($rzvy_translangArr['appearance_settings'])){ echo $rzvy_translangArr['appearance_settings']; }else{ echo $rzvy_defaultlang['appearance_settings']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="2" data-toggle="tab" href="#rzvy_payment_settings"><i class="fa fa-money"></i> <?php if(isset($rzvy_translangArr['payment_settings'])){ echo $rzvy_translangArr['payment_settings']; }else{ echo $rzvy_defaultlang['payment_settings']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="3" data-toggle="tab" href="#rzvy_email_settings"><i class="fa fa-envelope"></i> <?php if(isset($rzvy_translangArr['email_settings'])){ echo $rzvy_translangArr['email_settings']; }else{ echo $rzvy_defaultlang['email_settings']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="4" data-toggle="tab" href="#rzvy_sms_settings"><i class="fa fa-comments"></i> <?php if(isset($rzvy_translangArr['sms_settings'])){ echo $rzvy_translangArr['sms_settings']; }else{ echo $rzvy_defaultlang['sms_settings']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="5" data-toggle="tab" href="#rzvy_seo_settings"><i class="fa fa-line-chart"></i> <?php if(isset($rzvy_translangArr['seo_settings'])){ echo $rzvy_translangArr['seo_settings']; }else{ echo $rzvy_defaultlang['seo_settings']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="6" data-toggle="tab" href="#rzvy_welcome_settings"><i class="fa fa-handshake-o"></i> <?php if(isset($rzvy_translangArr['welcome_message'])){ echo $rzvy_translangArr['welcome_message']; }else{ echo $rzvy_defaultlang['welcome_message']; } ?></a>
				  </li>
				  <li class="nav-item custom-nav-item">
					<a class="nav-link custom-nav-link rzvy_tab_view_nav_link" data-tabno="7" data-toggle="tab" href="#rzvy_bookingform_settings"><i class="fa fa-laptop"></i> <?php if(isset($rzvy_translangArr['booking_form'])){ echo $rzvy_translangArr['booking_form']; }else{ echo $rzvy_defaultlang['booking_form']; } ?></a>
				  </li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane container active" id="rzvy_general_settings">
					  <div class="row">
						<div class="col-md-12">
						  <form name="rzvy_company_settings_form" id="rzvy_company_settings_form" method="post">
							  <div class="form-group">
								<div class="rzvy-image-upload">
									<div class="rzvy-image-edit-icon">
										<input type='hidden' id="rzvy-image-upload-file-hidden" name="rzvy-image-upload-file-hidden" />
										<input type='file' id="rzvy-image-upload-file" accept=".png, .jpg, .jpeg" />
										<label for="rzvy-image-upload-file"></label>
									</div>
									<div class="rzvy-image-preview">
										<div id="rzvy-image-upload-file-preview" style="<?php $logo_image = $obj_settings->get_option("rzvy_company_logo"); if($logo_image != '' && file_exists("../uploads/images/".$logo_image)){ echo "background-image: url(".SITE_URL."uploads/images/".$logo_image.");"; }else{ echo "background-image: url(".SITE_URL."includes/images/logo-placeholder.png);"; } ?>">
										</div>
									</div>
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['company_name'])){ echo $rzvy_translangArr['company_name']; }else{ echo $rzvy_defaultlang['company_name']; } ?></label>
									<input name="rzvy_company_name" id="rzvy_company_name" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_company_name"); ?>" />
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['company_email'])){ echo $rzvy_translangArr['company_email']; }else{ echo $rzvy_defaultlang['company_email']; } ?></label>
									<input name="rzvy_company_email" id="rzvy_company_email" class="form-control" type="email" value="<?php echo $obj_settings->get_option("rzvy_company_email"); ?>" />
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['company_phone'])){ echo $rzvy_translangArr['company_phone']; }else{ echo $rzvy_defaultlang['company_phone']; } ?></label>
									<input name="rzvy_company_phone" id="rzvy_company_phone" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_company_phone"); ?>" />
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-12">
									<label class="control-label"><?php if(isset($rzvy_translangArr['company_address'])){ echo $rzvy_translangArr['company_address']; }else{ echo $rzvy_defaultlang['company_address']; } ?></label>
									<textarea name="rzvy_company_address" id="rzvy_company_address" class="form-control" rows="1" ><?php echo $obj_settings->get_option("rzvy_company_address"); ?></textarea>
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['city'])){ echo $rzvy_translangArr['city']; }else{ echo $rzvy_defaultlang['city']; } ?></label>
									<input name="rzvy_company_city" id="rzvy_company_city" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_company_city"); ?>" />
								</div>
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['state'])){ echo $rzvy_translangArr['state']; }else{ echo $rzvy_defaultlang['state']; } ?></label>
									<input name="rzvy_company_state" id="rzvy_company_state" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_company_state"); ?>" />
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['zip'])){ echo $rzvy_translangArr['zip']; }else{ echo $rzvy_defaultlang['zip']; } ?></label>
									<input name="rzvy_company_zip" id="rzvy_company_zip" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_company_zip"); ?>" />
								</div>
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['country'])){ echo $rzvy_translangArr['country']; }else{ echo $rzvy_defaultlang['country']; } ?></label>
									<input name="rzvy_company_country" id="rzvy_company_country" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_company_country"); ?>" />
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['default_country_code'])){ echo $rzvy_translangArr['default_country_code']; }else{ echo $rzvy_defaultlang['default_country_code']; } ?></label>
									<?php $rzvy_default_country_code = $obj_settings->get_option("rzvy_default_country_code"); ?>
									<select name="rzvy_default_country_code" id="rzvy_default_country_code" class="selectpicker form-control">
										<?php 
										foreach($countrycodeArr as $key=>$val){ 
											?>
											<option value="<?php echo $key; ?>" <?php if($rzvy_default_country_code == $key){ echo "selected"; } ?>><?php echo $val; ?></option>
											<?php 
										} 
										?>
									</select>
								</div>
							  </div>
							  <a id="update_company_settings_btn" class="btn btn-success btn-block" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
						 </form>
						</div>
					  </div>
					</div>
					<div class="tab-pane container fade" id="rzvy_appearance_settings">
					  <br/>
					  <div class="row">
						<div class="col-md-12">
						  <form name="rzvy_appearance_settings_form" id="rzvy_appearance_settings_form" method="post">
							  <div class="form-group row">
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['time_slot_interval'])){ echo $rzvy_translangArr['time_slot_interval']; }else{ echo $rzvy_defaultlang['time_slot_interval']; } ?></label>
									<?php $rzvy_timeslot_interval = $obj_settings->get_option("rzvy_timeslot_interval"); ?>
									<select name="rzvy_timeslot_interval" id="rzvy_timeslot_interval" class="form-control selectpicker">
									  <option value="5" <?php if($rzvy_timeslot_interval == "5"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="10" <?php if($rzvy_timeslot_interval == "10"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="15" <?php if($rzvy_timeslot_interval == "15"){ echo "selected"; } ?>>15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="20" <?php if($rzvy_timeslot_interval == "20"){ echo "selected"; } ?>>20 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="30" <?php if($rzvy_timeslot_interval == "30"){ echo "selected"; } ?>>30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="45" <?php if($rzvy_timeslot_interval == "45"){ echo "selected"; } ?>>45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="60" <?php if($rzvy_timeslot_interval == "60"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="75" <?php if($rzvy_timeslot_interval == "75"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="90" <?php if($rzvy_timeslot_interval == "90"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="105" <?php if($rzvy_timeslot_interval == "105"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="120" <?php if($rzvy_timeslot_interval == "120"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="135" <?php if($rzvy_timeslot_interval == "135"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="150" <?php if($rzvy_timeslot_interval == "150"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="165" <?php if($rzvy_timeslot_interval == "165"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="180" <?php if($rzvy_timeslot_interval == "180"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="195" <?php if($rzvy_timeslot_interval == "195"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="210" <?php if($rzvy_timeslot_interval == "210"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="225" <?php if($rzvy_timeslot_interval == "225"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="240" <?php if($rzvy_timeslot_interval == "240"){ echo "selected"; } ?>>4 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['end_time_slot_selection'])){ echo $rzvy_translangArr['end_time_slot_selection']; }else{ echo $rzvy_defaultlang['end_time_slot_selection']; } ?></label>
									<?php $rzvy_endtimeslot_selection_status = $obj_settings->get_option("rzvy_endtimeslot_selection_status"); ?>
									<select name="rzvy_endtimeslot_selection_status" id="rzvy_endtimeslot_selection_status" class="form-control selectpicker">
									  <option value="Y" <?php if($rzvy_endtimeslot_selection_status == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['enable'])){ echo $rzvy_translangArr['enable']; }else{ echo $rzvy_defaultlang['enable']; } ?></option>
									  <option value="N" <?php if($rzvy_endtimeslot_selection_status == "N"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['disable'])){ echo $rzvy_translangArr['disable']; }else{ echo $rzvy_defaultlang['disable']; } ?></option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['maximum_end_time_slot_limit'])){ echo $rzvy_translangArr['maximum_end_time_slot_limit']; }else{ echo $rzvy_defaultlang['maximum_end_time_slot_limit']; } ?></label>
									<?php $rzvy_maximum_endtimeslot_limit = $obj_settings->get_option("rzvy_maximum_endtimeslot_limit"); ?>
									<select name="rzvy_maximum_endtimeslot_limit" id="rzvy_maximum_endtimeslot_limit" class="form-control selectpicker">
									  <option value="5" <?php if($rzvy_maximum_endtimeslot_limit == "5"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="10" <?php if($rzvy_maximum_endtimeslot_limit == "10"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="15" <?php if($rzvy_maximum_endtimeslot_limit == "15"){ echo "selected"; } ?>>15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="20" <?php if($rzvy_maximum_endtimeslot_limit == "20"){ echo "selected"; } ?>>20 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="30" <?php if($rzvy_maximum_endtimeslot_limit == "30"){ echo "selected"; } ?>>30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="45" <?php if($rzvy_maximum_endtimeslot_limit == "45"){ echo "selected"; } ?>>45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="60" <?php if($rzvy_maximum_endtimeslot_limit == "60"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="75" <?php if($rzvy_maximum_endtimeslot_limit == "75"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="90" <?php if($rzvy_maximum_endtimeslot_limit == "90"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="105" <?php if($rzvy_maximum_endtimeslot_limit == "105"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="120" <?php if($rzvy_maximum_endtimeslot_limit == "120"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="135" <?php if($rzvy_maximum_endtimeslot_limit == "135"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="150" <?php if($rzvy_maximum_endtimeslot_limit == "150"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="165" <?php if($rzvy_maximum_endtimeslot_limit == "165"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="180" <?php if($rzvy_maximum_endtimeslot_limit == "180"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="195" <?php if($rzvy_maximum_endtimeslot_limit == "195"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="210" <?php if($rzvy_maximum_endtimeslot_limit == "210"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="225" <?php if($rzvy_maximum_endtimeslot_limit == "225"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="240" <?php if($rzvy_maximum_endtimeslot_limit == "240"){ echo "selected"; } ?>>4 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									</select>
								</div>
							  </div>
							  <hr />
							  <div class="form-group row">
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['tax_vat_gst_status'])){ echo $rzvy_translangArr['tax_vat_gst_status']; }else{ echo $rzvy_defaultlang['tax_vat_gst_status']; } ?></label>
									<?php $rzvy_tax_status = $obj_settings->get_option("rzvy_tax_status"); ?>
									<select name="rzvy_tax_status" id="rzvy_tax_status" class="form-control selectpicker">
									  <option value="Y" <?php if($rzvy_tax_status == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['enable'])){ echo $rzvy_translangArr['enable']; }else{ echo $rzvy_defaultlang['enable']; } ?></option>
									  <option value="N" <?php if($rzvy_tax_status == "N"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['disable'])){ echo $rzvy_translangArr['disable']; }else{ echo $rzvy_defaultlang['disable']; } ?></option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['tax_vat_gst_type'])){ echo $rzvy_translangArr['tax_vat_gst_type']; }else{ echo $rzvy_defaultlang['tax_vat_gst_type']; } ?></label>
									<?php $rzvy_tax_type = $obj_settings->get_option("rzvy_tax_type"); ?>
									<select name="rzvy_tax_type" id="rzvy_tax_type" class="form-control selectpicker">
									  <option value="percentage" <?php if($rzvy_tax_type == "percentage"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['percentage'])){ echo $rzvy_translangArr['percentage']; }else{ echo $rzvy_defaultlang['percentage']; } ?></option>
									  <option value="flat" <?php if($rzvy_tax_type == "flat"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['flat'])){ echo $rzvy_translangArr['flat']; }else{ echo $rzvy_defaultlang['flat']; } ?></option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['tax_vat_gst_value'])){ echo $rzvy_translangArr['tax_vat_gst_value']; }else{ echo $rzvy_defaultlang['tax_vat_gst_value']; } ?></label>
									<input type="text" name="rzvy_tax_value" id="rzvy_tax_value" placeholder="e.g. 10" class="form-control" value="<?php echo $obj_settings->get_option("rzvy_tax_value"); ?>" />
								</div>
							  </div>
							  <hr />
							  <div class="form-group row">
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['minimum_advance_booking_time'])){ echo $rzvy_translangArr['minimum_advance_booking_time']; }else{ echo $rzvy_defaultlang['minimum_advance_booking_time']; } ?></label>
									<?php $rzvy_minimum_advance_booking_time = $obj_settings->get_option("rzvy_minimum_advance_booking_time"); ?>
									<select name="rzvy_minimum_advance_booking_time" id="rzvy_minimum_advance_booking_time" class="form-control selectpicker">
									  <option value="5" <?php if($rzvy_minimum_advance_booking_time == "5"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="10" <?php if($rzvy_minimum_advance_booking_time == "10"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="15" <?php if($rzvy_minimum_advance_booking_time == "15"){ echo "selected"; } ?>>15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="20" <?php if($rzvy_minimum_advance_booking_time == "20"){ echo "selected"; } ?>>20 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="30" <?php if($rzvy_minimum_advance_booking_time == "30"){ echo "selected"; } ?>>30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="45" <?php if($rzvy_minimum_advance_booking_time == "45"){ echo "selected"; } ?>>45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="60" <?php if($rzvy_minimum_advance_booking_time == "60"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="75" <?php if($rzvy_minimum_advance_booking_time == "75"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="90" <?php if($rzvy_minimum_advance_booking_time == "90"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="105" <?php if($rzvy_minimum_advance_booking_time == "105"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="120" <?php if($rzvy_minimum_advance_booking_time == "120"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="135" <?php if($rzvy_minimum_advance_booking_time == "135"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="150" <?php if($rzvy_minimum_advance_booking_time == "150"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="165" <?php if($rzvy_minimum_advance_booking_time == "165"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="180" <?php if($rzvy_minimum_advance_booking_time == "180"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="195" <?php if($rzvy_minimum_advance_booking_time == "195"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="210" <?php if($rzvy_minimum_advance_booking_time == "210"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="225" <?php if($rzvy_minimum_advance_booking_time == "225"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="240" <?php if($rzvy_minimum_advance_booking_time == "240"){ echo "selected"; } ?>>4 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="300" <?php if($rzvy_minimum_advance_booking_time == "300"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="360" <?php if($rzvy_minimum_advance_booking_time == "360"){ echo "selected"; } ?>>6 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="420" <?php if($rzvy_minimum_advance_booking_time == "420"){ echo "selected"; } ?>>7 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="480" <?php if($rzvy_minimum_advance_booking_time == "480"){ echo "selected"; } ?>>8 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="540" <?php if($rzvy_minimum_advance_booking_time == "540"){ echo "selected"; } ?>>9 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="600" <?php if($rzvy_minimum_advance_booking_time == "600"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="660" <?php if($rzvy_minimum_advance_booking_time == "660"){ echo "selected"; } ?>>11 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="720" <?php if($rzvy_minimum_advance_booking_time == "720"){ echo "selected"; } ?>>12 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="1440" <?php if($rzvy_minimum_advance_booking_time == "1440"){ echo "selected"; } ?>>24 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="2160" <?php if($rzvy_minimum_advance_booking_time == "2160"){ echo "selected"; } ?>>36 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="2880" <?php if($rzvy_minimum_advance_booking_time == "2880"){ echo "selected"; } ?>>48 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['maximum_advance_booking_time'])){ echo $rzvy_translangArr['maximum_advance_booking_time']; }else{ echo $rzvy_defaultlang['maximum_advance_booking_time']; } ?></label>
									<?php $rzvy_maximum_advance_booking_time = $obj_settings->get_option("rzvy_maximum_advance_booking_time"); ?>
									<select name="rzvy_maximum_advance_booking_time" id="rzvy_maximum_advance_booking_time" class="form-control selectpicker">
									  <option value="1" <?php if($rzvy_maximum_advance_booking_time == "1"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['month'])){ echo $rzvy_translangArr['month']; }else{ echo $rzvy_defaultlang['month']; } ?></option>
									  <option value="3" <?php if($rzvy_maximum_advance_booking_time == "3"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['month'])){ echo $rzvy_translangArr['month']; }else{ echo $rzvy_defaultlang['month']; } ?></option>
									  <option value="6" <?php if($rzvy_maximum_advance_booking_time == "6"){ echo "selected"; } ?>>6 <?php if(isset($rzvy_translangArr['month'])){ echo $rzvy_translangArr['month']; }else{ echo $rzvy_defaultlang['month']; } ?></option>
									  <option value="9" <?php if($rzvy_maximum_advance_booking_time == "9"){ echo "selected"; } ?>>9 <?php if(isset($rzvy_translangArr['month'])){ echo $rzvy_translangArr['month']; }else{ echo $rzvy_defaultlang['month']; } ?></option>
									  <option value="12" <?php if($rzvy_maximum_advance_booking_time == "12"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['year'])){ echo $rzvy_translangArr['year']; }else{ echo $rzvy_defaultlang['year']; } ?></option>
									  <option value="18" <?php if($rzvy_maximum_advance_booking_time == "18"){ echo "selected"; } ?>>1.5 <?php if(isset($rzvy_translangArr['year'])){ echo $rzvy_translangArr['year']; }else{ echo $rzvy_defaultlang['year']; } ?></option>
									  <option value="24" <?php if($rzvy_maximum_advance_booking_time == "24"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['year'])){ echo $rzvy_translangArr['year']; }else{ echo $rzvy_defaultlang['year']; } ?></option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['cancellation_buffer_time'])){ echo $rzvy_translangArr['cancellation_buffer_time']; }else{ echo $rzvy_defaultlang['cancellation_buffer_time']; } ?></label>
									<?php $rzvy_cancellation_buffer_time = $obj_settings->get_option("rzvy_cancellation_buffer_time"); ?>
									<select name="rzvy_cancellation_buffer_time" id="rzvy_cancellation_buffer_time" class="form-control selectpicker">
									  <option value="5" <?php if($rzvy_cancellation_buffer_time == "5"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="10" <?php if($rzvy_cancellation_buffer_time == "10"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="15" <?php if($rzvy_cancellation_buffer_time == "15"){ echo "selected"; } ?>>15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="20" <?php if($rzvy_cancellation_buffer_time == "20"){ echo "selected"; } ?>>20 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="30" <?php if($rzvy_cancellation_buffer_time == "30"){ echo "selected"; } ?>>30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="45" <?php if($rzvy_cancellation_buffer_time == "45"){ echo "selected"; } ?>>45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="60" <?php if($rzvy_cancellation_buffer_time == "60"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="75" <?php if($rzvy_cancellation_buffer_time == "75"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="90" <?php if($rzvy_cancellation_buffer_time == "90"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="105" <?php if($rzvy_cancellation_buffer_time == "105"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="120" <?php if($rzvy_cancellation_buffer_time == "120"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="135" <?php if($rzvy_cancellation_buffer_time == "135"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="150" <?php if($rzvy_cancellation_buffer_time == "150"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="165" <?php if($rzvy_cancellation_buffer_time == "165"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="180" <?php if($rzvy_cancellation_buffer_time == "180"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="195" <?php if($rzvy_cancellation_buffer_time == "195"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="210" <?php if($rzvy_cancellation_buffer_time == "210"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="225" <?php if($rzvy_cancellation_buffer_time == "225"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="240" <?php if($rzvy_cancellation_buffer_time == "240"){ echo "selected"; } ?>>4 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="300" <?php if($rzvy_cancellation_buffer_time == "300"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="360" <?php if($rzvy_cancellation_buffer_time == "360"){ echo "selected"; } ?>>6 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="420" <?php if($rzvy_cancellation_buffer_time == "420"){ echo "selected"; } ?>>7 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="480" <?php if($rzvy_cancellation_buffer_time == "480"){ echo "selected"; } ?>>8 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="540" <?php if($rzvy_cancellation_buffer_time == "540"){ echo "selected"; } ?>>9 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="600" <?php if($rzvy_cancellation_buffer_time == "600"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="660" <?php if($rzvy_cancellation_buffer_time == "660"){ echo "selected"; } ?>>11 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="720" <?php if($rzvy_cancellation_buffer_time == "720"){ echo "selected"; } ?>>12 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="1440" <?php if($rzvy_cancellation_buffer_time == "1440"){ echo "selected"; } ?>>24 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="2160" <?php if($rzvy_cancellation_buffer_time == "2160"){ echo "selected"; } ?>>36 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="2880" <?php if($rzvy_cancellation_buffer_time == "2880"){ echo "selected"; } ?>>48 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									</select>
								</div>
							  </div>
							  <hr />
							  <div class="form-group row">
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['reschedule_buffer_time'])){ echo $rzvy_translangArr['reschedule_buffer_time']; }else{ echo $rzvy_defaultlang['reschedule_buffer_time']; } ?></label>
									<?php $rzvy_reschedule_buffer_time = $obj_settings->get_option("rzvy_reschedule_buffer_time"); ?>
									<select name="rzvy_reschedule_buffer_time" id="rzvy_reschedule_buffer_time" class="form-control selectpicker">
									  <option value="5" <?php if($rzvy_reschedule_buffer_time == "5"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="10" <?php if($rzvy_reschedule_buffer_time == "10"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="15" <?php if($rzvy_reschedule_buffer_time == "15"){ echo "selected"; } ?>>15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="20" <?php if($rzvy_reschedule_buffer_time == "20"){ echo "selected"; } ?>>20 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="30" <?php if($rzvy_reschedule_buffer_time == "30"){ echo "selected"; } ?>>30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="45" <?php if($rzvy_reschedule_buffer_time == "45"){ echo "selected"; } ?>>45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="60" <?php if($rzvy_reschedule_buffer_time == "60"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="75" <?php if($rzvy_reschedule_buffer_time == "75"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="90" <?php if($rzvy_reschedule_buffer_time == "90"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="105" <?php if($rzvy_reschedule_buffer_time == "105"){ echo "selected"; } ?>>1 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="120" <?php if($rzvy_reschedule_buffer_time == "120"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="135" <?php if($rzvy_reschedule_buffer_time == "135"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="150" <?php if($rzvy_reschedule_buffer_time == "150"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="165" <?php if($rzvy_reschedule_buffer_time == "165"){ echo "selected"; } ?>>2 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="180" <?php if($rzvy_reschedule_buffer_time == "180"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="195" <?php if($rzvy_reschedule_buffer_time == "195"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 15 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="210" <?php if($rzvy_reschedule_buffer_time == "210"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 30 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="225" <?php if($rzvy_reschedule_buffer_time == "225"){ echo "selected"; } ?>>3 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?> 45 <?php if(isset($rzvy_translangArr['minutes'])){ echo $rzvy_translangArr['minutes']; }else{ echo $rzvy_defaultlang['minutes']; } ?></option>
									  <option value="240" <?php if($rzvy_reschedule_buffer_time == "240"){ echo "selected"; } ?>>4 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="300" <?php if($rzvy_reschedule_buffer_time == "300"){ echo "selected"; } ?>>5 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="360" <?php if($rzvy_reschedule_buffer_time == "360"){ echo "selected"; } ?>>6 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="420" <?php if($rzvy_reschedule_buffer_time == "420"){ echo "selected"; } ?>>7 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="480" <?php if($rzvy_reschedule_buffer_time == "480"){ echo "selected"; } ?>>8 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="540" <?php if($rzvy_reschedule_buffer_time == "540"){ echo "selected"; } ?>>9 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="600" <?php if($rzvy_reschedule_buffer_time == "600"){ echo "selected"; } ?>>10 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="660" <?php if($rzvy_reschedule_buffer_time == "660"){ echo "selected"; } ?>>11 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="720" <?php if($rzvy_reschedule_buffer_time == "720"){ echo "selected"; } ?>>12 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="1440" <?php if($rzvy_reschedule_buffer_time == "1440"){ echo "selected"; } ?>>24 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="2160" <?php if($rzvy_reschedule_buffer_time == "2160"){ echo "selected"; } ?>>36 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									  <option value="2880" <?php if($rzvy_reschedule_buffer_time == "2880"){ echo "selected"; } ?>>48 <?php if(isset($rzvy_translangArr['hour'])){ echo $rzvy_translangArr['hour']; }else{ echo $rzvy_defaultlang['hour']; } ?></option>
									</select>
								</div>
								<div class="col-md-3">
									<label class="control-label"><?php if(isset($rzvy_translangArr['auto_confirm_appointment'])){ echo $rzvy_translangArr['auto_confirm_appointment']; }else{ echo $rzvy_defaultlang['auto_confirm_appointment']; } ?></label>
									<?php $rzvy_auto_confirm_appointment = $obj_settings->get_option("rzvy_auto_confirm_appointment"); ?>
									<select name="rzvy_auto_confirm_appointment" id="rzvy_auto_confirm_appointment" class="form-control selectpicker">
									  <option value="Y" <?php if($rzvy_auto_confirm_appointment == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['enable'])){ echo $rzvy_translangArr['enable']; }else{ echo $rzvy_defaultlang['enable']; } ?></option>
									  <option value="N" <?php if($rzvy_auto_confirm_appointment == "N"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['disable'])){ echo $rzvy_translangArr['disable']; }else{ echo $rzvy_defaultlang['disable']; } ?></option>
									</select>
								</div>
								<div class="col-md-5">
									<label class="control-label"><?php if(isset($rzvy_translangArr['timezone'])){ echo $rzvy_translangArr['timezone']; }else{ echo $rzvy_defaultlang['timezone']; } ?></label>
									<?php $rzvy_timezone = $obj_settings->get_option("rzvy_timezone"); ?>
									<select name="rzvy_timezone" id="rzvy_timezone" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search your TimeZone">
									  	<option <?php if($rzvy_timezone=='Pacific/Niue'){ echo "selected"; } ?> value="Pacific/Niue" data-posinset="3">(GMT-11:00) Niue Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Pago_Pago'){ echo "selected"; } ?> value="Pacific/Pago_Pago" data-posinset="4">(GMT-11:00) Samoa Standard Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Rarotonga'){ echo "selected"; } ?> value="Pacific/Rarotonga" data-posinset="5">(GMT-10:00) Cook Islands Standard Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Honolulu'){ echo "selected"; } ?> value="Pacific/Honolulu" data-posinset="6">(GMT-10:00) Hawaii-Aleutian Standard Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Tahiti'){ echo "selected"; } ?> value="Pacific/Tahiti" data-posinset="7">(GMT-10:00) Tahiti Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Marquesas'){ echo "selected"; } ?> value="Pacific/Marquesas" data-posinset="8">(GMT-09:30) Marquesas Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Gambier'){ echo "selected"; } ?> value="Pacific/Gambier" data-posinset="9">(GMT-09:30) Gambier Time</option>
										<option <?php if($rzvy_timezone=='America/Anchorage'){ echo "selected"; } ?> value="America/Anchorage" data-posinset="10">(GMT-08:00) Alaska Time - Anchorage</option>
										<option <?php if($rzvy_timezone=='Pacific/Pitcairn'){ echo "selected"; } ?> value="Pacific/Pitcairn" data-posinset="11">(GMT-08:00) Pitcairn Time</option>
										<option <?php if($rzvy_timezone=='America/Hermosillo'){ echo "selected"; } ?> value="America/Hermosillo" data-posinset="12">(GMT-07:00) Mexican Pacific Standard Time</option>
										<option <?php if($rzvy_timezone=='America/Dawson_Creek'){ echo "selected"; } ?> value="America/Dawson_Creek" data-posinset="13">(GMT-07:00) Mountain Standard Time - Dawson Creek</option>
										<option <?php if($rzvy_timezone=='America/Phoenix'){ echo "selected"; } ?> value="America/Phoenix" data-posinset="14">(GMT-07:00) Mountain Standard Time - Phoenix</option>
										<option <?php if($rzvy_timezone=='America/Dawson'){ echo "selected"; } ?> value="America/Dawson" data-posinset="15">(GMT-07:00) Pacific Time - Dawson</option>
										<option <?php if($rzvy_timezone=='America/Los_Angeles'){ echo "selected"; } ?> value="America/Los_Angeles" data-posinset="16">(GMT-07:00) Pacific Time - Los Angeles</option>
										<option <?php if($rzvy_timezone=='America/Tijuana'){ echo "selected"; } ?> value="America/Tijuana" data-posinset="17">(GMT-07:00) Pacific Time - Tijuana</option>
										<option <?php if($rzvy_timezone=='America/Vancouver'){ echo "selected"; } ?> value="America/Vancouver" data-posinset="18">(GMT-07:00) Pacific Time - Vancouver</option>
										<option <?php if($rzvy_timezone=='America/Whitehorse'){ echo "selected"; } ?> value="America/Whitehorse" data-posinset="19">(GMT-07:00) Pacific Time - Whitehorse</option>
										<option <?php if($rzvy_timezone=='America/Belize'){ echo "selected"; } ?> value="America/Belize" data-posinset="20">(GMT-06:00) Central Standard Time - Belize</option>
										<option <?php if($rzvy_timezone=='America/Costa_Rica'){ echo "selected"; } ?> value="America/Costa_Rica" data-posinset="21">(GMT-06:00) Central Standard Time - Costa Rica</option>
										<option <?php if($rzvy_timezone=='America/El_Salvador'){ echo "selected"; } ?> value="America/El_Salvador" data-posinset="22">(GMT-06:00) Central Standard Time - El Salvador</option>
										<option <?php if($rzvy_timezone=='America/Guatemala'){ echo "selected"; } ?> value="America/Guatemala" data-posinset="23">(GMT-06:00) Central Standard Time - Guatemala</option>
										<option <?php if($rzvy_timezone=='America/Managua'){ echo "selected"; } ?> value="America/Managua" data-posinset="24">(GMT-06:00) Central Standard Time - Managua</option>
										<option <?php if($rzvy_timezone=='America/Regina'){ echo "selected"; } ?> value="America/Regina" data-posinset="25">(GMT-06:00) Central Standard Time - Regina</option>
										<option <?php if($rzvy_timezone=='America/Tegucigalpa'){ echo "selected"; } ?> value="America/Tegucigalpa" data-posinset="26">(GMT-06:00) Central Standard Time - Tegucigalpa</option>
										<option <?php if($rzvy_timezone=='Pacific/Easter'){ echo "selected"; } ?> value="Pacific/Easter" data-posinset="27">(GMT-06:00) Easter Island Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Galapagos'){ echo "selected"; } ?> value="Pacific/Galapagos" data-posinset="28">(GMT-06:00) Galapagos Time</option>
										<option <?php if($rzvy_timezone=='America/Mazatlan'){ echo "selected"; } ?> value="America/Mazatlan" data-posinset="29">(GMT-06:00) Mexican Pacific Time - Mazatlan</option>
										<option <?php if($rzvy_timezone=='America/Boise'){ echo "selected"; } ?> value="America/Boise" data-posinset="30">(GMT-06:00) Mountain Time - Boise</option>
										<option <?php if($rzvy_timezone=='America/Denver'){ echo "selected"; } ?> value="America/Denver" data-posinset="31">(GMT-06:00) Mountain Time - Denver</option>
										<option <?php if($rzvy_timezone=='America/Edmonton'){ echo "selected"; } ?> value="America/Edmonton" data-posinset="32">(GMT-06:00) Mountain Time - Edmonton</option>
										<option <?php if($rzvy_timezone=='America/Yellowknife'){ echo "selected"; } ?> value="America/Yellowknife" data-posinset="33">(GMT-06:00) Mountain Time - Yellowknife</option>
										<option <?php if($rzvy_timezone=='America/Rio_Branco'){ echo "selected"; } ?> value="America/Rio_Branco" data-posinset="34">(GMT-05:00) Acre Standard Time - Rio Branco</option>
										<option <?php if($rzvy_timezone=='America/Chicago'){ echo "selected"; } ?> value="America/Chicago" data-posinset="35">(GMT-05:00) Central Time - Chicago</option>
										<option <?php if($rzvy_timezone=='America/Mexico_City'){ echo "selected"; } ?> value="America/Mexico_City" data-posinset="36">(GMT-05:00) Central Time - Mexico City</option>
										<option <?php if($rzvy_timezone=='America/Winnipeg'){ echo "selected"; } ?> value="America/Winnipeg" data-posinset="37">(GMT-05:00) Central Time - Winnipeg</option>
										<option <?php if($rzvy_timezone=='America/Bogota'){ echo "selected"; } ?> value="America/Bogota" data-posinset="38">(GMT-05:00) Colombia Standard Time</option>
										<option <?php if($rzvy_timezone=='America/Cancun'){ echo "selected"; } ?> value="America/Cancun" data-posinset="39">(GMT-05:00) Eastern Standard Time - Cancun</option>
										<option <?php if($rzvy_timezone=='America/Jamaica'){ echo "selected"; } ?> value="America/Jamaica" data-posinset="40">(GMT-05:00) Eastern Standard Time - Jamaica</option>
										<option <?php if($rzvy_timezone=='America/Panama'){ echo "selected"; } ?> value="America/Panama" data-posinset="41">(GMT-05:00) Eastern Standard Time - Panama</option>
										<option <?php if($rzvy_timezone=='America/Guayaquil'){ echo "selected"; } ?> value="America/Guayaquil" data-posinset="42">(GMT-05:00) Ecuador Time</option>
										<option <?php if($rzvy_timezone=='America/Lima'){ echo "selected"; } ?> value="America/Lima" data-posinset="43">(GMT-05:00) Peru Standard Time</option>
										<option <?php if($rzvy_timezone=='America/Boa_Vista'){ echo "selected"; } ?> value="America/Boa_Vista" data-posinset="44">(GMT-04:00) Amazon Standard Time - Boa Vista</option>
										<option <?php if($rzvy_timezone=='America/Manaus'){ echo "selected"; } ?> value="America/Manaus" data-posinset="45">(GMT-04:00) Amazon Standard Time - Manaus</option>
										<option <?php if($rzvy_timezone=='America/Porto_Velho'){ echo "selected"; } ?> value="America/Porto_Velho" data-posinset="46">(GMT-04:00) Amazon Standard Time - Porto Velho</option>
										<option <?php if($rzvy_timezone=='America/Campo_Grande'){ echo "selected"; } ?> value="America/Campo_Grande" data-posinset="47">(GMT-04:00) Amazon Time - Campo Grande</option>
										<option <?php if($rzvy_timezone=='America/Cuiaba'){ echo "selected"; } ?> value="America/Cuiaba" data-posinset="48">(GMT-04:00) Amazon Time - Cuiaba</option>
										<option <?php if($rzvy_timezone=='America/Barbados'){ echo "selected"; } ?> value="America/Barbados" data-posinset="49">(GMT-04:00) Atlantic Standard Time - Barbados</option>
										<option <?php if($rzvy_timezone=='America/Curacao'){ echo "selected"; } ?> value="America/Curacao" data-posinset="50">(GMT-04:00) Atlantic Standard Time - Curaçao</option>
										<option <?php if($rzvy_timezone=='America/Martinique'){ echo "selected"; } ?> value="America/Martinique" data-posinset="51">(GMT-04:00) Atlantic Standard Time - Martinique</option>
										<option <?php if($rzvy_timezone=='America/Port_of_Spain'){ echo "selected"; } ?> value="America/Port_of_Spain" data-posinset="52">(GMT-04:00) Atlantic Standard Time - Port of Spain</option>
										<option <?php if($rzvy_timezone=='America/Puerto_Rico'){ echo "selected"; } ?> value="America/Puerto_Rico" data-posinset="53">(GMT-04:00) Atlantic Standard Time - Puerto Rico</option>
										<option <?php if($rzvy_timezone=='America/Santo_Domingo'){ echo "selected"; } ?> value="America/Santo_Domingo" data-posinset="54">(GMT-04:00) Atlantic Standard Time - Santo Domingo</option>
										<option <?php if($rzvy_timezone=='America/La_Paz'){ echo "selected"; } ?> value="America/La_Paz" data-posinset="55">(GMT-04:00) Bolivia Time</option>
										<option <?php if($rzvy_timezone=='America/Santiago'){ echo "selected"; } ?> value="America/Santiago" data-posinset="56">(GMT-04:00) Chile Time</option>
										<option <?php if($rzvy_timezone=='America/Havana'){ echo "selected"; } ?> value="America/Havana" data-posinset="57">(GMT-04:00) Cuba Time</option>
										<option <?php if($rzvy_timezone=='America/Detroit'){ echo "selected"; } ?> value="America/Detroit" data-posinset="58">(GMT-04:00) Eastern Time - Detroit</option>
										<option <?php if($rzvy_timezone=='America/Grand_Turk'){ echo "selected"; } ?> value="America/Grand_Turk" data-posinset="59">(GMT-04:00) Eastern Time - Grand Turk</option>
										<option <?php if($rzvy_timezone=='America/Iqaluit'){ echo "selected"; } ?> value="America/Iqaluit" data-posinset="60">(GMT-04:00) Eastern Time - Iqaluit</option>
										<option <?php if($rzvy_timezone=='America/Nassau'){ echo "selected"; } ?> value="America/Nassau" data-posinset="61">(GMT-04:00) Eastern Time - Nassau</option>
										<option <?php if($rzvy_timezone=='America/New_York'){ echo "selected"; } ?> value="America/New_York" data-posinset="62">(GMT-04:00) Eastern Time - New York</option>
										<option <?php if($rzvy_timezone=='America/Port-au-Prince'){ echo "selected"; } ?> value="America/Port-au-Prince" data-posinset="63">(GMT-04:00) Eastern Time - Port-au-Prince</option>
										<option <?php if($rzvy_timezone=='America/Toronto'){ echo "selected"; } ?> value="America/Toronto" data-posinset="64">(GMT-04:00) Eastern Time - Toronto</option>
										<option <?php if($rzvy_timezone=='America/Guyana'){ echo "selected"; } ?> value="America/Guyana" data-posinset="65">(GMT-04:00) Guyana Time</option>
										<option <?php if($rzvy_timezone=='America/Asuncion'){ echo "selected"; } ?> value="America/Asuncion" data-posinset="66">(GMT-04:00) Paraguay Time</option>
										<option <?php if($rzvy_timezone=='America/Caracas'){ echo "selected"; } ?> value="America/Caracas" data-posinset="67">(GMT-04:00) Venezuela Time</option>
										<option <?php if($rzvy_timezone=='America/Argentina/Buenos_Aires'){ echo "selected"; } ?> value="America/Argentina/Buenos_Aires" data-posinset="68">(GMT-03:00) Argentina Standard Time - Buenos Aires</option>
										<option <?php if($rzvy_timezone=='America/Argentina/Cordoba'){ echo "selected"; } ?> value="America/Argentina/Cordoba" data-posinset="69">(GMT-03:00) Argentina Standard Time - Cordoba</option>
										<option <?php if($rzvy_timezone=='Atlantic/Bermuda'){ echo "selected"; } ?> value="Atlantic/Bermuda" data-posinset="70">(GMT-03:00) Atlantic Time - Bermuda</option>
										<option <?php if($rzvy_timezone=='America/Halifax'){ echo "selected"; } ?> value="America/Halifax" data-posinset="71">(GMT-03:00) Atlantic Time - Halifax</option>
										<option <?php if($rzvy_timezone=='America/Thule'){ echo "selected"; } ?> value="America/Thule" data-posinset="72">(GMT-03:00) Atlantic Time - Thule</option>
										<option <?php if($rzvy_timezone=='America/Araguaina'){ echo "selected"; } ?> value="America/Araguaina" data-posinset="73">(GMT-03:00) Brasilia Standard Time - Araguaina</option>
										<option <?php if($rzvy_timezone=='America/Bahia'){ echo "selected"; } ?> value="America/Bahia" data-posinset="74">(GMT-03:00) Brasilia Standard Time - Bahia</option>
										<option <?php if($rzvy_timezone=='America/Belem'){ echo "selected"; } ?> value="America/Belem" data-posinset="75">(GMT-03:00) Brasilia Standard Time - Belem</option>
										<option <?php if($rzvy_timezone=='America/Fortaleza'){ echo "selected"; } ?> value="America/Fortaleza" data-posinset="76">(GMT-03:00) Brasilia Standard Time - Fortaleza</option>
										<option <?php if($rzvy_timezone=='America/Maceio'){ echo "selected"; } ?> value="America/Maceio" data-posinset="77">(GMT-03:00) Brasilia Standard Time - Maceio</option>
										<option <?php if($rzvy_timezone=='America/Recife'){ echo "selected"; } ?> value="America/Recife" data-posinset="78">(GMT-03:00) Brasilia Standard Time - Recife</option>
										<option <?php if($rzvy_timezone=='America/Sao_Paulo'){ echo "selected"; } ?> value="America/Sao_Paulo" data-posinset="79">(GMT-03:00) Brasilia Time</option>
										<option <?php if($rzvy_timezone=='Atlantic/Stanley'){ echo "selected"; } ?> value="Atlantic/Stanley" data-posinset="80">(GMT-03:00) Falkland Islands Standard Time</option>
										<option <?php if($rzvy_timezone=='America/Cayenne'){ echo "selected"; } ?> value="America/Cayenne" data-posinset="81">(GMT-03:00) French Guiana Time</option>
										<option <?php if($rzvy_timezone=='Antarctica/Palmer'){ echo "selected"; } ?> value="Antarctica/Palmer" data-posinset="82">(GMT-03:00) Palmer Time</option>
										<option <?php if($rzvy_timezone=='America/Punta_Arenas'){ echo "selected"; } ?> value="America/Punta_Arenas" data-posinset="83">(GMT-03:00) Punta Arenas Time</option>
										<option <?php if($rzvy_timezone=='Antarctica/Rothera'){ echo "selected"; } ?> value="Antarctica/Rothera" data-posinset="84">(GMT-03:00) Rothera Time</option>
										<option <?php if($rzvy_timezone=='America/Paramaribo'){ echo "selected"; } ?> value="America/Paramaribo" data-posinset="85">(GMT-03:00) Suriname Time</option>
										<option <?php if($rzvy_timezone=='America/Montevideo'){ echo "selected"; } ?> value="America/Montevideo" data-posinset="86">(GMT-03:00) Uruguay Standard Time</option>
										<option <?php if($rzvy_timezone=='America/St_Johns'){ echo "selected"; } ?> value="America/St_Johns" data-posinset="87">(GMT-02:30) Newfoundland Time</option>
										<option <?php if($rzvy_timezone=='America/Noronha'){ echo "selected"; } ?> value="America/Noronha" data-posinset="88">(GMT-02:00) Fernando de Noronha Standard Time</option>
										<option <?php if($rzvy_timezone=='Atlantic/South_Georgia'){ echo "selected"; } ?> value="Atlantic/South_Georgia" data-posinset="89">(GMT-02:00) South Georgia Time</option>
										<option <?php if($rzvy_timezone=='America/Miquelon'){ echo "selected"; } ?> value="America/Miquelon" data-posinset="90">(GMT-02:00) St. Pierre &amp; Miquelon Time</option>
										<option <?php if($rzvy_timezone=='America/Godthab'){ echo "selected"; } ?> value="America/Godthab" data-posinset="91">(GMT-02:00) West Greenland Time</option>
										<option <?php if($rzvy_timezone=='Atlantic/Cape_Verde'){ echo "selected"; } ?> value="Atlantic/Cape_Verde" data-posinset="92">(GMT-01:00) Cape Verde Standard Time</option>
										<option <?php if($rzvy_timezone=='Atlantic/Azores'){ echo "selected"; } ?> value="Atlantic/Azores" data-posinset="93">(GMT+00:00) Azores Time</option>
										<option <?php if($rzvy_timezone=='America/Scoresbysund'){ echo "selected"; } ?> value="America/Scoresbysund" data-posinset="94">(GMT+00:00) East Greenland Time</option>
										<option <?php if($rzvy_timezone=='Etc/GMT'){ echo "selected"; } ?> value="Etc/GMT" data-posinset="95">(GMT+00:00) Greenwich Mean Time</option>
										<option <?php if($rzvy_timezone=='Africa/Abidjan'){ echo "selected"; } ?> value="Africa/Abidjan" data-posinset="96">(GMT+00:00) Greenwich Mean Time - Abidjan</option>
										<option <?php if($rzvy_timezone=='Africa/Accra'){ echo "selected"; } ?> value="Africa/Accra" data-posinset="97">(GMT+00:00) Greenwich Mean Time - Accra</option>
										<option <?php if($rzvy_timezone=='Africa/Bissau'){ echo "selected"; } ?> value="Africa/Bissau" data-posinset="98">(GMT+00:00) Greenwich Mean Time - Bissau</option>
										<option <?php if($rzvy_timezone=='America/Danmarkshavn'){ echo "selected"; } ?> value="America/Danmarkshavn" data-posinset="99">(GMT+00:00) Greenwich Mean Time - Danmarkshavn</option>
										<option <?php if($rzvy_timezone=='Africa/Monrovia'){ echo "selected"; } ?> value="Africa/Monrovia" data-posinset="100">(GMT+00:00) Greenwich Mean Time - Monrovia</option>
										<option <?php if($rzvy_timezone=='Atlantic/Reykjavik'){ echo "selected"; } ?> value="Atlantic/Reykjavik" data-posinset="101">(GMT+00:00) Greenwich Mean Time - Reykjavik</option>
										<option <?php if($rzvy_timezone=='UTC'){ echo "selected"; } ?> value="UTC" data-posinset="102">UTC</option>
										<option <?php if($rzvy_timezone=='Africa/Algiers'){ echo "selected"; } ?> value="Africa/Algiers" data-posinset="103">(GMT+01:00) Central European Standard Time - Algiers</option>
										<option <?php if($rzvy_timezone=='Africa/Tunis'){ echo "selected"; } ?> value="Africa/Tunis" data-posinset="104">(GMT+01:00) Central European Standard Time - Tunis</option>
										<option <?php if($rzvy_timezone=='Europe/Dublin'){ echo "selected"; } ?> value="Europe/Dublin" data-posinset="105">(GMT+01:00) Ireland Time</option>
										<option <?php if($rzvy_timezone=='Europe/London'){ echo "selected"; } ?> value="Europe/London" data-posinset="106">(GMT+01:00) United Kingdom Time</option>
										<option <?php if($rzvy_timezone=='Africa/Lagos'){ echo "selected"; } ?> value="Africa/Lagos" data-posinset="107">(GMT+01:00) West Africa Standard Time - Lagos</option>
										<option <?php if($rzvy_timezone=='Africa/Ndjamena'){ echo "selected"; } ?> value="Africa/Ndjamena" data-posinset="108">(GMT+01:00) West Africa Standard Time - Ndjamena</option>
										<option <?php if($rzvy_timezone=='Africa/Sao_Tome'){ echo "selected"; } ?> value="Africa/Sao_Tome" data-posinset="109">(GMT+01:00) West Africa Standard Time - São Tomé</option>
										<option <?php if($rzvy_timezone=='Atlantic/Canary'){ echo "selected"; } ?> value="Atlantic/Canary" data-posinset="110">(GMT+01:00) Western European Time - Canary</option>
										<option <?php if($rzvy_timezone=='Africa/Casablanca'){ echo "selected"; } ?> value="Africa/Casablanca" data-posinset="111">(GMT+01:00) Western European Time - Casablanca</option>
										<option <?php if($rzvy_timezone=='Africa/El_Aaiun'){ echo "selected"; } ?> value="Africa/El_Aaiun" data-posinset="112">(GMT+01:00) Western European Time - El Aaiun</option>
										<option <?php if($rzvy_timezone=='Atlantic/Faroe'){ echo "selected"; } ?> value="Atlantic/Faroe" data-posinset="113">(GMT+01:00) Western European Time - Faroe</option>
										<option <?php if($rzvy_timezone=='Europe/Lisbon'){ echo "selected"; } ?> value="Europe/Lisbon" data-posinset="114">(GMT+01:00) Western European Time - Lisbon</option>
										<option <?php if($rzvy_timezone=='Africa/Khartoum'){ echo "selected"; } ?> value="Africa/Khartoum" data-posinset="115">(GMT+02:00) Central Africa Time - Khartoum</option>
										<option <?php if($rzvy_timezone=='Africa/Maputo'){ echo "selected"; } ?> value="Africa/Maputo" data-posinset="116">(GMT+02:00) Central Africa Time - Maputo</option>
										<option <?php if($rzvy_timezone=='Africa/Windhoek'){ echo "selected"; } ?> value="Africa/Windhoek" data-posinset="117">(GMT+02:00) Central Africa Time - Windhoek</option>
										<option <?php if($rzvy_timezone=='Europe/Amsterdam'){ echo "selected"; } ?> value="Europe/Amsterdam" data-posinset="118">(GMT+02:00) Central European Time - Amsterdam</option>
										<option <?php if($rzvy_timezone=='Europe/Andorra'){ echo "selected"; } ?> value="Europe/Andorra" data-posinset="119">(GMT+02:00) Central European Time - Andorra</option>
										<option <?php if($rzvy_timezone=='Europe/Belgrade'){ echo "selected"; } ?> value="Europe/Belgrade" data-posinset="120">(GMT+02:00) Central European Time - Belgrade</option>
										<option <?php if($rzvy_timezone=='Europe/Berlin'){ echo "selected"; } ?> value="Europe/Berlin" data-posinset="121">(GMT+02:00) Central European Time - Berlin</option>
										<option <?php if($rzvy_timezone=='Europe/Brussels'){ echo "selected"; } ?> value="Europe/Brussels" data-posinset="122">(GMT+02:00) Central European Time - Brussels</option>
										<option <?php if($rzvy_timezone=='Europe/Budapest'){ echo "selected"; } ?> value="Europe/Budapest" data-posinset="123">(GMT+02:00) Central European Time - Budapest</option>
										<option <?php if($rzvy_timezone=='Africa/Ceuta'){ echo "selected"; } ?> value="Africa/Ceuta" data-posinset="124">(GMT+02:00) Central European Time - Ceuta</option>
										<option <?php if($rzvy_timezone=='Europe/Copenhagen'){ echo "selected"; } ?> value="Europe/Copenhagen" data-posinset="125">(GMT+02:00) Central European Time - Copenhagen</option>
										<option <?php if($rzvy_timezone=='Europe/Gibraltar'){ echo "selected"; } ?> value="Europe/Gibraltar" data-posinset="126">(GMT+02:00) Central European Time - Gibraltar</option>
										<option <?php if($rzvy_timezone=='Europe/Luxembourg'){ echo "selected"; } ?> value="Europe/Luxembourg" data-posinset="127">(GMT+02:00) Central European Time - Luxembourg</option>
										<option <?php if($rzvy_timezone=='Europe/Madrid'){ echo "selected"; } ?> value="Europe/Madrid" data-posinset="128">(GMT+02:00) Central European Time - Madrid</option>
										<option <?php if($rzvy_timezone=='Europe/Malta'){ echo "selected"; } ?> value="Europe/Malta" data-posinset="129">(GMT+02:00) Central European Time - Malta</option>
										<option <?php if($rzvy_timezone=='Europe/Monaco'){ echo "selected"; } ?> value="Europe/Monaco" data-posinset="130">(GMT+02:00) Central European Time - Monaco</option>
										<option <?php if($rzvy_timezone=='Europe/Oslo'){ echo "selected"; } ?> value="Europe/Oslo" data-posinset="131">(GMT+02:00) Central European Time - Oslo</option>
										<option <?php if($rzvy_timezone=='Europe/Paris'){ echo "selected"; } ?> value="Europe/Paris" data-posinset="132">(GMT+02:00) Central European Time - Paris</option>
										<option <?php if($rzvy_timezone=='Europe/Prague'){ echo "selected"; } ?> value="Europe/Prague" data-posinset="133">(GMT+02:00) Central European Time - Prague</option>
										<option <?php if($rzvy_timezone=='Europe/Rome'){ echo "selected"; } ?> value="Europe/Rome" data-posinset="134">(GMT+02:00) Central European Time - Rome</option>
										<option <?php if($rzvy_timezone=='Europe/Stockholm'){ echo "selected"; } ?> value="Europe/Stockholm" data-posinset="135">(GMT+02:00) Central European Time - Stockholm</option>
										<option <?php if($rzvy_timezone=='Europe/Tirane'){ echo "selected"; } ?> value="Europe/Tirane" data-posinset="136">(GMT+02:00) Central European Time - Tirane</option>
										<option <?php if($rzvy_timezone=='Europe/Vienna'){ echo "selected"; } ?> value="Europe/Vienna" data-posinset="137">(GMT+02:00) Central European Time - Vienna</option>
										<option <?php if($rzvy_timezone=='Europe/Warsaw'){ echo "selected"; } ?> value="Europe/Warsaw" data-posinset="138">(GMT+02:00) Central European Time - Warsaw</option>
										<option <?php if($rzvy_timezone=='Europe/Zurich'){ echo "selected"; } ?> value="Europe/Zurich" data-posinset="139">(GMT+02:00) Central European Time - Zurich</option>
										<option <?php if($rzvy_timezone=='Africa/Cairo'){ echo "selected"; } ?> value="Africa/Cairo" data-posinset="140">(GMT+02:00) Eastern European Standard Time - Cairo</option>
										<option <?php if($rzvy_timezone=='Europe/Kaliningrad'){ echo "selected"; } ?> value="Europe/Kaliningrad" data-posinset="141">(GMT+02:00) Eastern European Standard Time - Kaliningrad</option>
										<option <?php if($rzvy_timezone=='Africa/Tripoli'){ echo "selected"; } ?> value="Africa/Tripoli" data-posinset="142">(GMT+02:00) Eastern European Standard Time - Tripoli</option>
										<option <?php if($rzvy_timezone=='Africa/Johannesburg'){ echo "selected"; } ?> value="Africa/Johannesburg" data-posinset="143">(GMT+02:00) South Africa Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Baghdad'){ echo "selected"; } ?> value="Asia/Baghdad" data-posinset="144">(GMT+03:00) Arabian Standard Time - Baghdad</option>
										<option <?php if($rzvy_timezone=='Asia/Qatar'){ echo "selected"; } ?> value="Asia/Qatar" data-posinset="145">(GMT+03:00) Arabian Standard Time - Qatar</option>
										<option <?php if($rzvy_timezone=='Asia/Riyadh'){ echo "selected"; } ?> value="Asia/Riyadh" data-posinset="146">(GMT+03:00) Arabian Standard Time - Riyadh</option>
										<option <?php if($rzvy_timezone=='Africa/Nairobi'){ echo "selected"; } ?> value="Africa/Nairobi" data-posinset="147">(GMT+03:00) East Africa Time - Nairobi</option>
										<option <?php if($rzvy_timezone=='Asia/Amman'){ echo "selected"; } ?> value="Asia/Amman" data-posinset="148">(GMT+03:00) Eastern European Time - Amman</option>
										<option <?php if($rzvy_timezone=='Europe/Athens'){ echo "selected"; } ?> value="Europe/Athens" data-posinset="149">(GMT+03:00) Eastern European Time - Athens</option>
										<option <?php if($rzvy_timezone=='Asia/Beirut'){ echo "selected"; } ?> value="Asia/Beirut" data-posinset="150">(GMT+03:00) Eastern European Time - Beirut</option>
										<option <?php if($rzvy_timezone=='Europe/Bucharest'){ echo "selected"; } ?> value="Europe/Bucharest" data-posinset="151">(GMT+03:00) Eastern European Time - Bucharest</option>
										<option <?php if($rzvy_timezone=='Europe/Chisinau'){ echo "selected"; } ?> value="Europe/Chisinau" data-posinset="152">(GMT+03:00) Eastern European Time - Chisinau</option>
										<option <?php if($rzvy_timezone=='Asia/Damascus'){ echo "selected"; } ?> value="Asia/Damascus" data-posinset="153">(GMT+03:00) Eastern European Time - Damascus</option>
										<option <?php if($rzvy_timezone=='Asia/Gaza'){ echo "selected"; } ?> value="Asia/Gaza" data-posinset="154">(GMT+03:00) Eastern European Time - Gaza</option>
										<option <?php if($rzvy_timezone=='Europe/Helsinki'){ echo "selected"; } ?> value="Europe/Helsinki" data-posinset="155">(GMT+03:00) Eastern European Time - Helsinki</option>
										<option <?php if($rzvy_timezone=='Europe/Kiev'){ echo "selected"; } ?> value="Europe/Kiev" data-posinset="156">(GMT+03:00) Eastern European Time - Kiev</option>
										<option <?php if($rzvy_timezone=='Asia/Nicosia'){ echo "selected"; } ?> value="Asia/Nicosia" data-posinset="157">(GMT+03:00) Eastern European Time - Nicosia</option>
										<option <?php if($rzvy_timezone=='Europe/Riga'){ echo "selected"; } ?> value="Europe/Riga" data-posinset="158">(GMT+03:00) Eastern European Time - Riga</option>
										<option <?php if($rzvy_timezone=='Europe/Sofia'){ echo "selected"; } ?> value="Europe/Sofia" data-posinset="159">(GMT+03:00) Eastern European Time - Sofia</option>
										<option <?php if($rzvy_timezone=='Europe/Tallinn'){ echo "selected"; } ?> value="Europe/Tallinn" data-posinset="160">(GMT+03:00) Eastern European Time - Tallinn</option>
										<option <?php if($rzvy_timezone=='Europe/Vilnius'){ echo "selected"; } ?> value="Europe/Vilnius" data-posinset="161">(GMT+03:00) Eastern European Time - Vilnius</option>
										<option <?php if($rzvy_timezone=='Asia/Jerusalem'){ echo "selected"; } ?> value="Asia/Jerusalem" data-posinset="162">(GMT+03:00) Israel Time</option>
										<option <?php if($rzvy_timezone=='Europe/Minsk'){ echo "selected"; } ?> value="Europe/Minsk" data-posinset="163">(GMT+03:00) Moscow Standard Time - Minsk</option>
										<option <?php if($rzvy_timezone=='Europe/Moscow'){ echo "selected"; } ?> value="Europe/Moscow" data-posinset="164">(GMT+03:00) Moscow Standard Time - Moscow</option>
										<option <?php if($rzvy_timezone=='Antarctica/Syowa'){ echo "selected"; } ?> value="Antarctica/Syowa" data-posinset="165">(GMT+03:00) Syowa Time</option>
										<option <?php if($rzvy_timezone=='Europe/Istanbul'){ echo "selected"; } ?> value="Europe/Istanbul" data-posinset="166">(GMT+03:00) Turkey Time</option>
										<option <?php if($rzvy_timezone=='Asia/Yerevan'){ echo "selected"; } ?> value="Asia/Yerevan" data-posinset="167">(GMT+04:00) Armenia Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Baku'){ echo "selected"; } ?> value="Asia/Baku" data-posinset="168">(GMT+04:00) Azerbaijan Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Tbilisi'){ echo "selected"; } ?> value="Asia/Tbilisi" data-posinset="169">(GMT+04:00) Georgia Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Dubai'){ echo "selected"; } ?> value="Asia/Dubai" data-posinset="170">(GMT+04:00) Gulf Standard Time</option>
										<option <?php if($rzvy_timezone=='Indian/Mauritius'){ echo "selected"; } ?> value="Indian/Mauritius" data-posinset="171">(GMT+04:00) Mauritius Standard Time</option>
										<option <?php if($rzvy_timezone=='Indian/Reunion'){ echo "selected"; } ?> value="Indian/Reunion" data-posinset="172">(GMT+04:00) Réunion Time</option>
										<option <?php if($rzvy_timezone=='Europe/Samara'){ echo "selected"; } ?> value="Europe/Samara" data-posinset="173">(GMT+04:00) Samara Standard Time</option>
										<option <?php if($rzvy_timezone=='Indian/Mahe'){ echo "selected"; } ?> value="Indian/Mahe" data-posinset="174">(GMT+04:00) Seychelles Time</option>
										<option <?php if($rzvy_timezone=='Asia/Kabul'){ echo "selected"; } ?> value="Asia/Kabul" data-posinset="175">(GMT+04:30) Afghanistan Time</option>
										<option <?php if($rzvy_timezone=='Asia/Tehran'){ echo "selected"; } ?> value="Asia/Tehran" data-posinset="176">(GMT+04:30) Iran Time</option>
										<option <?php if($rzvy_timezone=='Indian/Kerguelen'){ echo "selected"; } ?> value="Indian/Kerguelen" data-posinset="177">(GMT+05:00) French Southern &amp; Antarctic Time</option>
										<option <?php if($rzvy_timezone=='Indian/Maldives'){ echo "selected"; } ?> value="Indian/Maldives" data-posinset="178">(GMT+05:00) Maldives Time</option>
										<option <?php if($rzvy_timezone=='Antarctica/Mawson'){ echo "selected"; } ?> value="Antarctica/Mawson" data-posinset="179">(GMT+05:00) Mawson Time</option>
										<option <?php if($rzvy_timezone=='Asia/Karachi'){ echo "selected"; } ?> value="Asia/Karachi" data-posinset="180">(GMT+05:00) Pakistan Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Dushanbe'){ echo "selected"; } ?> value="Asia/Dushanbe" data-posinset="181">(GMT+05:00) Tajikistan Time</option>
										<option <?php if($rzvy_timezone=='Asia/Ashgabat'){ echo "selected"; } ?> value="Asia/Ashgabat" data-posinset="182">(GMT+05:00) Turkmenistan Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Tashkent'){ echo "selected"; } ?> value="Asia/Tashkent" data-posinset="183">(GMT+05:00) Uzbekistan Standard Time - Tashkent</option>
										<option <?php if($rzvy_timezone=='Asia/Aqtau'){ echo "selected"; } ?> value="Asia/Aqtau" data-posinset="184">(GMT+05:00) West Kazakhstan Time - Aqtau</option>
										<option <?php if($rzvy_timezone=='Asia/Aqtobe'){ echo "selected"; } ?> value="Asia/Aqtobe" data-posinset="185">(GMT+05:00) West Kazakhstan Time - Aqtobe</option>
										<option <?php if($rzvy_timezone=='Asia/Yekaterinburg'){ echo "selected"; } ?> value="Asia/Yekaterinburg" data-posinset="186">(GMT+05:00) Yekaterinburg Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Colombo'){ echo "selected"; } ?> value="Asia/Colombo" data-posinset="187">(GMT+05:30) India Standard Time - Colombo</option>
										<option <?php if($rzvy_timezone=='Asia/Calcutta'){ echo "selected"; } ?> value="Asia/Calcutta" data-posinset="188">(GMT+05:30) India Standard Time - Kolkata</option>
										<option <?php if($rzvy_timezone=='Asia/Katmandu'){ echo "selected"; } ?> value="Asia/Katmandu" data-posinset="189">(GMT+05:45) Nepal Time</option>
										<option <?php if($rzvy_timezone=='Asia/Dhaka'){ echo "selected"; } ?> value="Asia/Dhaka" data-posinset="190">(GMT+06:00) Bangladesh Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Thimphu'){ echo "selected"; } ?> value="Asia/Thimphu" data-posinset="191">(GMT+06:00) Bhutan Time</option>
										<option <?php if($rzvy_timezone=='Asia/Almaty'){ echo "selected"; } ?> value="Asia/Almaty" data-posinset="192">(GMT+06:00) East Kazakhstan Time - Almaty</option>
										<option <?php if($rzvy_timezone=='Indian/Chagos'){ echo "selected"; } ?> value="Indian/Chagos" data-posinset="193">(GMT+06:00) Indian Ocean Time</option>
										<option <?php if($rzvy_timezone=='Asia/Bishkek'){ echo "selected"; } ?> value="Asia/Bishkek" data-posinset="194">(GMT+06:00) Kyrgyzstan Time</option>
										<option <?php if($rzvy_timezone=='Asia/Omsk'){ echo "selected"; } ?> value="Asia/Omsk" data-posinset="195">(GMT+06:00) Omsk Standard Time</option>
										<option <?php if($rzvy_timezone=='Antarctica/Vostok'){ echo "selected"; } ?> value="Antarctica/Vostok" data-posinset="196">(GMT+06:00) Vostok Time</option>
										<option <?php if($rzvy_timezone=='Indian/Cocos'){ echo "selected"; } ?> value="Indian/Cocos" data-posinset="197">(GMT+06:30) Cocos Islands Time</option>
										<option <?php if($rzvy_timezone=='Asia/Yangon'){ echo "selected"; } ?> value="Asia/Yangon" data-posinset="198">(GMT+06:30) Myanmar Time</option>
										<option <?php if($rzvy_timezone=='Indian/Christmas'){ echo "selected"; } ?> value="Indian/Christmas" data-posinset="199">(GMT+07:00) Christmas Island Time</option>
										<option <?php if($rzvy_timezone=='Antarctica/Davis'){ echo "selected"; } ?> value="Antarctica/Davis" data-posinset="200">(GMT+07:00) Davis Time</option>
										<option <?php if($rzvy_timezone=='Asia/Hovd'){ echo "selected"; } ?> value="Asia/Hovd" data-posinset="201">(GMT+07:00) Hovd Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Bangkok'){ echo "selected"; } ?> value="Asia/Bangkok" data-posinset="202">(GMT+07:00) Indochina Time - Bangkok</option>
										<option <?php if($rzvy_timezone=='Asia/Saigon'){ echo "selected"; } ?> value="Asia/Saigon" data-posinset="203">(GMT+07:00) Indochina Time - Ho Chi Minh City</option>
										<option <?php if($rzvy_timezone=='Asia/Krasnoyarsk'){ echo "selected"; } ?> value="Asia/Krasnoyarsk" data-posinset="204">(GMT+07:00) Krasnoyarsk Standard Time - Krasnoyarsk</option>
										<option <?php if($rzvy_timezone=='Asia/Jakarta'){ echo "selected"; } ?> value="Asia/Jakarta" data-posinset="205">(GMT+07:00) Western Indonesia Time - Jakarta</option>
										<option <?php if($rzvy_timezone=='Antarctica/Casey'){ echo "selected"; } ?> value="Antarctica/Casey" data-posinset="206">(GMT+08:00) Australian Western Standard Time - Casey</option>
										<option <?php if($rzvy_timezone=='Australia/Perth'){ echo "selected"; } ?> value="Australia/Perth" data-posinset="207">(GMT+08:00) Australian Western Standard Time - Perth</option>
										<option <?php if($rzvy_timezone=='Asia/Brunei'){ echo "selected"; } ?> value="Asia/Brunei" data-posinset="208">(GMT+08:00) Brunei Darussalam Time</option>
										<option <?php if($rzvy_timezone=='Asia/Makassar'){ echo "selected"; } ?> value="Asia/Makassar" data-posinset="209">(GMT+08:00) Central Indonesia Time</option>
										<option <?php if($rzvy_timezone=='Asia/Macau'){ echo "selected"; } ?> value="Asia/Macau" data-posinset="210">(GMT+08:00) China Standard Time - Macau</option>
										<option <?php if($rzvy_timezone=='Asia/Shanghai'){ echo "selected"; } ?> value="Asia/Shanghai" data-posinset="211">(GMT+08:00) China Standard Time - Shanghai</option>
										<option <?php if($rzvy_timezone=='Asia/Choibalsan'){ echo "selected"; } ?> value="Asia/Choibalsan" data-posinset="212">(GMT+08:00) Choibalsan Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Hong_Kong'){ echo "selected"; } ?> value="Asia/Hong_Kong" data-posinset="213">(GMT+08:00) Hong Kong Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Irkutsk'){ echo "selected"; } ?> value="Asia/Irkutsk" data-posinset="214">(GMT+08:00) Irkutsk Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Kuala_Lumpur'){ echo "selected"; } ?> value="Asia/Kuala_Lumpur" data-posinset="215">(GMT+08:00) Malaysia Time - Kuala Lumpur</option>
										<option <?php if($rzvy_timezone=='Asia/Manila'){ echo "selected"; } ?> value="Asia/Manila" data-posinset="216">(GMT+08:00) Philippine Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Singapore'){ echo "selected"; } ?> value="Asia/Singapore" data-posinset="217">(GMT+08:00) Singapore Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Taipei'){ echo "selected"; } ?> value="Asia/Taipei" data-posinset="218">(GMT+08:00) Taipei Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Ulaanbaatar'){ echo "selected"; } ?> value="Asia/Ulaanbaatar" data-posinset="219">(GMT+08:00) Ulaanbaatar Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Dili'){ echo "selected"; } ?> value="Asia/Dili" data-posinset="220">(GMT+09:00) East Timor Time</option>
										<option <?php if($rzvy_timezone=='Asia/Jayapura'){ echo "selected"; } ?> value="Asia/Jayapura" data-posinset="221">(GMT+09:00) Eastern Indonesia Time</option>
										<option <?php if($rzvy_timezone=='Asia/Tokyo'){ echo "selected"; } ?> value="Asia/Tokyo" data-posinset="222">(GMT+09:00) Japan Standard Time</option>
										<option <?php if($rzvy_timezone=='Asia/Pyongyang'){ echo "selected"; } ?> value="Asia/Pyongyang" data-posinset="223">(GMT+09:00) Korean Standard Time - Pyongyang</option>
										<option <?php if($rzvy_timezone=='Asia/Seoul'){ echo "selected"; } ?> value="Asia/Seoul" data-posinset="224">(GMT+09:00) Korean Standard Time - Seoul</option>
										<option <?php if($rzvy_timezone=='Pacific/Palau'){ echo "selected"; } ?> value="Pacific/Palau" data-posinset="225">(GMT+09:00) Palau Time</option>
										<option <?php if($rzvy_timezone=='Asia/Yakutsk'){ echo "selected"; } ?> value="Asia/Yakutsk" data-posinset="226">(GMT+09:00) Yakutsk Standard Time - Yakutsk</option>
										<option <?php if($rzvy_timezone=='Australia/Darwin'){ echo "selected"; } ?> value="Australia/Darwin" data-posinset="227">(GMT+09:30) Australian Central Standard Time</option>
										<option <?php if($rzvy_timezone=='Australia/Adelaide'){ echo "selected"; } ?> value="Australia/Adelaide" data-posinset="228">(GMT+09:30) Central Australia Time - Adelaide</option>
										<option <?php if($rzvy_timezone=='Australia/Brisbane'){ echo "selected"; } ?> value="Australia/Brisbane" data-posinset="229">(GMT+10:00) Australian Eastern Standard Time - Brisbane</option>
										<option <?php if($rzvy_timezone=='Pacific/Guam'){ echo "selected"; } ?> value="Pacific/Guam" data-posinset="230">(GMT+10:00) Chamorro Standard Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Chuuk'){ echo "selected"; } ?> value="Pacific/Chuuk" data-posinset="231">(GMT+10:00) Chuuk Time</option>
										<option <?php if($rzvy_timezone=='Antarctica/DumontDUrville'){ echo "selected"; } ?> value="Antarctica/DumontDUrville" data-posinset="232">(GMT+10:00) Dumont-d’Urville Time</option>
										<option <?php if($rzvy_timezone=='Australia/Hobart'){ echo "selected"; } ?> value="Australia/Hobart" data-posinset="233">(GMT+10:00) Eastern Australia Time - Hobart</option>
										<option <?php if($rzvy_timezone=='Australia/Melbourne'){ echo "selected"; } ?> value="Australia/Melbourne" data-posinset="234">(GMT+10:00) Eastern Australia Time - Melbourne</option>
										<option <?php if($rzvy_timezone=='Australia/Sydney'){ echo "selected"; } ?> value="Australia/Sydney" data-posinset="235">(GMT+10:00) Eastern Australia Time - Sydney</option>
										<option <?php if($rzvy_timezone=='Pacific/Port_Moresby'){ echo "selected"; } ?> value="Pacific/Port_Moresby" data-posinset="236">(GMT+10:00) Papua New Guinea Time</option>
										<option <?php if($rzvy_timezone=='Asia/Vladivostok'){ echo "selected"; } ?> value="Asia/Vladivostok" data-posinset="237">(GMT+10:00) Vladivostok Standard Time - Vladivostok</option>
										<option <?php if($rzvy_timezone=='Pacific/Kosrae'){ echo "selected"; } ?> value="Pacific/Kosrae" data-posinset="238">(GMT+11:00) Kosrae Time</option>
										<option <?php if($rzvy_timezone=='Asia/Magadan'){ echo "selected"; } ?> value="Asia/Magadan" data-posinset="239">(GMT+11:00) Magadan Standard Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Noumea'){ echo "selected"; } ?> value="Pacific/Noumea" data-posinset="240">(GMT+11:00) New Caledonia Standard Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Norfolk'){ echo "selected"; } ?> value="Pacific/Norfolk" data-posinset="241">(GMT+11:00) Norfolk Island Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Pohnpei'){ echo "selected"; } ?> value="Pacific/Pohnpei" data-posinset="242">(GMT+11:00) Ponape Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Guadalcanal'){ echo "selected"; } ?> value="Pacific/Guadalcanal" data-posinset="243">(GMT+11:00) Solomon Islands Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Efate'){ echo "selected"; } ?> value="Pacific/Efate" data-posinset="244">(GMT+11:00) Vanuatu Standard Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Fiji'){ echo "selected"; } ?> value="Pacific/Fiji" data-posinset="245">(GMT+12:00) Fiji Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Tarawa'){ echo "selected"; } ?> value="Pacific/Tarawa" data-posinset="246">(GMT+12:00) Gilbert Islands Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Kwajalein'){ echo "selected"; } ?> value="Pacific/Kwajalein" data-posinset="247">(GMT+12:00) Marshall Islands Time - Kwajalein</option>
										<option <?php if($rzvy_timezone=='Pacific/Majuro'){ echo "selected"; } ?> value="Pacific/Majuro" data-posinset="248">(GMT+12:00) Marshall Islands Time - Majuro</option>
										<option <?php if($rzvy_timezone=='Pacific/Nauru'){ echo "selected"; } ?> value="Pacific/Nauru" data-posinset="249">(GMT+12:00) Nauru Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Auckland'){ echo "selected"; } ?> value="Pacific/Auckland" data-posinset="250">(GMT+12:00) New Zealand Time</option>
										<option <?php if($rzvy_timezone=='Asia/Kamchatka'){ echo "selected"; } ?> value="Asia/Kamchatka" data-posinset="251">(GMT+12:00) Petropavlovsk-Kamchatski Standard Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Funafuti'){ echo "selected"; } ?> value="Pacific/Funafuti" data-posinset="252">(GMT+12:00) Tuvalu Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Wake'){ echo "selected"; } ?> value="Pacific/Wake" data-posinset="253">(GMT+12:00) Wake Island Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Wallis'){ echo "selected"; } ?> value="Pacific/Wallis" data-posinset="254">(GMT+12:00) Wallis &amp; Futuna Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Apia'){ echo "selected"; } ?> value="Pacific/Apia" data-posinset="255">(GMT+13:00) Apia Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Enderbury'){ echo "selected"; } ?> value="Pacific/Enderbury" data-posinset="256">(GMT+13:00) Phoenix Islands Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Fakaofo'){ echo "selected"; } ?> value="Pacific/Fakaofo" data-posinset="257">(GMT+13:00) Tokelau Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Tongatapu'){ echo "selected"; } ?> value="Pacific/Tongatapu" data-posinset="258">(GMT+13:00) Tonga Standard Time</option>
										<option <?php if($rzvy_timezone=='Pacific/Kiritimati'){ echo "selected"; } ?> value="Pacific/Kiritimati" data-posinset="259">(GMT+14:00) Line Islands Time</option>
									</select>
								</div>
							  </div>
							  <hr />
							  <div class="form-group row">
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['currency'])){ echo $rzvy_translangArr['currency']; }else{ echo $rzvy_defaultlang['currency']; } ?></label>
									<select name="rzvy_currency" id="rzvy_currency" class="form-control selectpicker" data-live-search="true" data-live-search-placeholder="Search">
										<?php
										$rzvy_currency = $obj_settings->get_option("rzvy_currency");
										foreach($rzvy_currency_array as $key=>$value){
											$selected = "";
											if($rzvy_currency == $key){
												$selected = "selected";
											}
											echo '<option value="'.$key.'" data-symbol="'.html_entity_decode($rzvy_currency_symbols[$key]).'" '.$selected.'>'.$value.' '.html_entity_decode($rzvy_currency_symbols[$key]).'</option>';
										}
										?>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['date_format'])){ echo $rzvy_translangArr['date_format']; }else{ echo $rzvy_defaultlang['date_format']; } ?></label>
									<?php $rzvy_date_format = $obj_settings->get_option("rzvy_date_format"); ?>
									<select name="rzvy_date_format" id="rzvy_date_format" class="form-control selectpicker">
										<option value="Y-m-d" <?php if($rzvy_date_format == "d-m-Y"){ echo "selected"; } ?>>yyyy-mm-dd (eg. 2018-06-13)</option>
										<option value="d-m-Y" <?php if($rzvy_date_format == "d-m-Y"){ echo "selected"; } ?>>dd-mm-yyyy (eg. 13-06-2018)</option>
										<option value="j-m-Y" <?php if($rzvy_date_format == "j-m-Y"){ echo "selected"; } ?>>d-mm-yyyy (eg. 13-6-2018)</option>
										<option value="d-M-Y" <?php if($rzvy_date_format == "d-M-Y"){ echo "selected"; } ?>>dd-m-yyyy (eg. 13-Jun-2018)</option>
										<option value="d-F-Y" <?php if($rzvy_date_format == "d-F-Y"){ echo "selected"; } ?>>dd-m-yyyy (eg. 13-June-2018)</option>
										<option value="j-M-Y" <?php if($rzvy_date_format == "j-M-Y"){ echo "selected"; } ?>>d-m-yyyy (eg. 13-Jun-2018)</option>
										<option value="j-F-Y" <?php if($rzvy_date_format == "j-F-Y"){ echo "selected"; } ?>>dd-m-yyyy (eg. 13-June-2018)</option>

										<!-- With Slashes -->
										<option value="d/m/Y" <?php if($rzvy_date_format == "d/m/Y"){ echo "selected"; } ?>>dd/mm/yyyy (eg. 13/06/2018)</option>
										<option value="j/m/Y" <?php if($rzvy_date_format == "j/m/Y"){ echo "selected"; } ?>>d/mm/yyyy (eg. 13/06/2018)</option>
										<option value="d/M/Y" <?php if($rzvy_date_format == "d/M/Y"){ echo "selected"; } ?>>dd/m/yyyy (eg. 13/Jun/2018)</option>
										<option value="d/F/Y" <?php if($rzvy_date_format == "d/F/Y"){ echo "selected"; } ?>>dd/M/yyyy (eg. 13/June/2018)</option>
										<option value="j/M/Y" <?php if($rzvy_date_format == "j/M/Y"){ echo "selected"; } ?>>d/m/yyyy (eg. 13/Jun/2018)</option>
										<option value="j/F/Y" <?php if($rzvy_date_format == "j/F/Y"){ echo "selected"; } ?>>d/M/yyyy (eg. 13/June/2018)</option>

										<!-- Month Day Year Suffled -->
										<option value="m-d-Y" <?php if($rzvy_date_format == "m-d-Y"){ echo "selected"; } ?>>mm-dd-yyyy (eg. 06-13-2018)</option>
										<option value="m-j-Y" <?php if($rzvy_date_format == "m-j-Y"){ echo "selected"; } ?>>mm-d-yyyy (eg. 06-13-2018)</option>
										<option value="M-d-Y" <?php if($rzvy_date_format == "M-d-Y"){ echo "selected"; } ?>>m-dd-yyyy (eg. Jun-13-2018)</option>
										<option value="F-d-Y" <?php if($rzvy_date_format == "F-d-Y"){ echo "selected"; } ?>>m-dd-yyyy (eg. June-13-2018)</option>
										<option value="M-j-Y" <?php if($rzvy_date_format == "M-j-Y"){ echo "selected"; } ?>>m-d-yyyy (eg. Jun-13-2018)</option>
										<option value="F-j-Y" <?php if($rzvy_date_format == "F-j-Y"){ echo "selected"; } ?>>m-dd-yyyy (eg. June-13-2018)</option>
										<!-- With Slashes -->
										<option value="m/d/Y" <?php if($rzvy_date_format == "m/d/Y"){ echo "selected"; } ?>>mm/dd/yyyy (eg. 06/13/2018)</option>
										<option value="m/j/Y" <?php if($rzvy_date_format == "m/j/Y"){ echo "selected"; } ?>>mm/d/yyyy (eg. 06/13/2018)</option>
										<option value="M/d/Y" <?php if($rzvy_date_format == "M/d/Y"){ echo "selected"; } ?>>m/dd/yyyy (eg. Jun/13/2018)</option>
										<option value="F/d/Y" <?php if($rzvy_date_format == "F/d/Y"){ echo "selected"; } ?>>m/dd/yyyy (eg. June/13/2018)</option>
										<option value="M/j/Y" <?php if($rzvy_date_format == "M/j/Y"){ echo "selected"; } ?>>m/d/yyyy (eg. Jun/13/2018)</option>
										<option value="F/j/Y" <?php if($rzvy_date_format == "F/j/Y"){ echo "selected"; } ?>>m/dd/yyyy (eg. June/13/2018)</option>

										<option value="j M,Y" <?php if($rzvy_date_format == "j M,Y"){ echo "selected"; } ?>>dd m,yyyy (eg. 13 Jun,2018)</option>
										<option value="M j, Y" <?php if($rzvy_date_format == "M j, Y"){ echo "selected"; } ?>>m dd,yyyy (eg. Jun 13, 2018)</option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['time_format'])){ echo $rzvy_translangArr['time_format']; }else{ echo $rzvy_defaultlang['time_format']; } ?></label>
									<?php $rzvy_time_format = $obj_settings->get_option("rzvy_time_format"); ?>
									<select name="rzvy_time_format" id="rzvy_time_format" class="form-control selectpicker">
									  <option value="h:i A" <?php if($rzvy_time_format == "h:i A"){ echo "selected"; } ?>>12 <?php if(isset($rzvy_translangArr['hours'])){ echo $rzvy_translangArr['hours']; }else{ echo $rzvy_defaultlang['hours']; } ?></option>
									  <option value="H:i" <?php if($rzvy_time_format == "H:i"){ echo "selected"; } ?>>24 <?php if(isset($rzvy_translangArr['hours'])){ echo $rzvy_translangArr['hours']; }else{ echo $rzvy_defaultlang['hours']; } ?></option>
									</select>
								</div>
							  </div>
							  <hr />
							  <div class="form-group row">
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['show_frontend_rightside_feedback_list'])){ echo $rzvy_translangArr['show_frontend_rightside_feedback_list']; }else{ echo $rzvy_defaultlang['show_frontend_rightside_feedback_list']; } ?></label>
									<?php $rzvy_show_frontend_rightside_feedback_list = $obj_settings->get_option("rzvy_show_frontend_rightside_feedback_list"); ?>
									<select name="rzvy_show_frontend_rightside_feedback_list" id="rzvy_show_frontend_rightside_feedback_list" class="form-control selectpicker">
									  <option value="Y" <?php if($rzvy_show_frontend_rightside_feedback_list == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['yes'])){ echo $rzvy_translangArr['yes']; }else{ echo $rzvy_defaultlang['yes']; } ?></option>
									  <option value="N" <?php if($rzvy_show_frontend_rightside_feedback_list == "N"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['no'])){ echo $rzvy_translangArr['no']; }else{ echo $rzvy_defaultlang['no']; } ?></option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['show_frontend_rightside_feedback_form'])){ echo $rzvy_translangArr['show_frontend_rightside_feedback_form']; }else{ echo $rzvy_defaultlang['show_frontend_rightside_feedback_form']; } ?></label>
									<?php $rzvy_show_frontend_rightside_feedback_form = $obj_settings->get_option("rzvy_show_frontend_rightside_feedback_form"); ?>
									<select name="rzvy_show_frontend_rightside_feedback_form" id="rzvy_show_frontend_rightside_feedback_form" class="form-control selectpicker">
									  <option value="Y" <?php if($rzvy_show_frontend_rightside_feedback_form == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['yes'])){ echo $rzvy_translangArr['yes']; }else{ echo $rzvy_defaultlang['yes']; } ?></option>
									  <option value="N" <?php if($rzvy_show_frontend_rightside_feedback_form == "N"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['no'])){ echo $rzvy_translangArr['no']; }else{ echo $rzvy_defaultlang['no']; } ?></option>
									</select>
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['show_guest_user_checkout'])){ echo $rzvy_translangArr['show_guest_user_checkout']; }else{ echo $rzvy_defaultlang['show_guest_user_checkout']; } ?></label>
									<?php $rzvy_show_guest_user_checkout = $obj_settings->get_option("rzvy_show_guest_user_checkout"); ?>
									<select name="rzvy_show_guest_user_checkout" id="rzvy_show_guest_user_checkout" class="form-control selectpicker">
									  <option value="Y" <?php if($rzvy_show_guest_user_checkout == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['yes'])){ echo $rzvy_translangArr['yes']; }else{ echo $rzvy_defaultlang['yes']; } ?></option>
									  <option value="N" <?php if($rzvy_show_guest_user_checkout == "N"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['no'])){ echo $rzvy_translangArr['no']; }else{ echo $rzvy_defaultlang['no']; } ?></option>
									</select>
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-3">
									<label class="control-label"><?php if(isset($rzvy_translangArr['minimum_booking_amount'])){ echo $rzvy_translangArr['minimum_booking_amount']; }else{ echo $rzvy_defaultlang['minimum_booking_amount']; } ?></label>
									<input type="text" name="rzvy_minimum_booking_amount" id="rzvy_minimum_booking_amount" value="<?php echo $obj_settings->get_option("rzvy_minimum_booking_amount"); ?>" class="form-control" placeholder="e.g. 10" />
								</div>
								<div class="col-md-4">
									<label class="control-label"><?php if(isset($rzvy_translangArr['show_existing_and_new_user_checkout'])){ echo $rzvy_translangArr['show_existing_and_new_user_checkout']; }else{ echo $rzvy_defaultlang['show_existing_and_new_user_checkout']; } ?></label>
									<?php $rzvy_show_existing_new_user_checkout = $obj_settings->get_option("rzvy_show_existing_new_user_checkout"); ?>
									<select name="rzvy_show_existing_new_user_checkout" id="rzvy_show_existing_new_user_checkout" class="form-control selectpicker">
									  <option value="Y" <?php if($rzvy_show_existing_new_user_checkout == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['yes'])){ echo $rzvy_translangArr['yes']; }else{ echo $rzvy_defaultlang['yes']; } ?></option>
									  <option value="N" <?php if($rzvy_show_existing_new_user_checkout == "N"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['no'])){ echo $rzvy_translangArr['no']; }else{ echo $rzvy_defaultlang['no']; } ?></option>
									</select>
								</div>
								<div class="col-md-5">
									<label class="control-label"><?php if(isset($rzvy_translangArr['hide_already_booked_slots_from_frontend_calendar'])){ echo $rzvy_translangArr['hide_already_booked_slots_from_frontend_calendar']; }else{ echo $rzvy_defaultlang['hide_already_booked_slots_from_frontend_calendar']; } ?></label>
									<?php $rzvy_hide_already_booked_slots_from_frontend_calendar = $obj_settings->get_option("rzvy_hide_already_booked_slots_from_frontend_calendar"); ?>
									<select name="rzvy_hide_already_booked_slots_from_frontend_calendar" id="rzvy_hide_already_booked_slots_from_frontend_calendar" class="form-control selectpicker">
									  <option value="Y" <?php if($rzvy_hide_already_booked_slots_from_frontend_calendar == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['yes'])){ echo $rzvy_translangArr['yes']; }else{ echo $rzvy_defaultlang['yes']; } ?></option>
									  <option value="N" <?php if($rzvy_hide_already_booked_slots_from_frontend_calendar == "N"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['no'])){ echo $rzvy_translangArr['no']; }else{ echo $rzvy_defaultlang['no']; } ?></option>
									</select>
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['thank_you_page_url'])){ echo $rzvy_translangArr['thank_you_page_url']; }else{ echo $rzvy_defaultlang['thank_you_page_url']; } ?></label>
									<input type="text" name="rzvy_thankyou_page_url" id="rzvy_thankyou_page_url" value="<?php echo $obj_settings->get_option("rzvy_thankyou_page_url"); ?>" class="form-control" placeholder="e.g. <?php echo SITE_URL; ?>thankyou.php" />
								</div>
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['terms_and_condition_link'])){ echo $rzvy_translangArr['terms_and_condition_link']; }else{ echo $rzvy_defaultlang['terms_and_condition_link']; } ?></label>
									<input type="text" name="rzvy_terms_and_condition_link" id="rzvy_terms_and_condition_link" value="<?php echo $obj_settings->get_option("rzvy_terms_and_condition_link"); ?>" class="form-control" placeholder="e.g. <?php echo SITE_URL; ?>" />
								</div>
							  </div>
							  <a id="update_appearance_settings_btn" class="btn btn-success btn-block" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
						 </form>
						</div>
					  </div>
					</div>
					<div class="tab-pane container fade" id="rzvy_payment_settings">
					  <br/>
					  <div class="row pl-3">
						<label class="col-md-3"><?php if(isset($rzvy_translangArr['pay_at_venue_payment_status'])){ echo $rzvy_translangArr['pay_at_venue_payment_status']; }else{ echo $rzvy_defaultlang['pay_at_venue_payment_status']; } ?></label>
						<label class="rzvy-toggle-switch">
							<input type="checkbox" name="rzvy_pay_at_venue_status" id="rzvy_pay_at_venue_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_pay_at_venue_status")=="Y"){ echo "checked"; } ?> />
							<span class="rzvy-toggle-switch-slider"></span>
						</label>
    				  </div>
					  <hr />
					  <div class="row">
						<div class="col-md-3">
							<div class="card rzvy-boxshadow mt-1 mr-1 rzvy_payment_settings_admin" id="rzvy_payment_settings_admin_1" data-id="1">
							  <div class="card-body text-primary text-center">
								<i class="fa fa-cog" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['paypal_settings'])){ echo $rzvy_translangArr['paypal_settings']; }else{ echo $rzvy_defaultlang['paypal_settings']; } ?>
							  </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_payment_settings_admin" id="rzvy_payment_settings_admin_2" data-id="2">
							  <div class="card-body text-primary text-center">
								<i class="fa fa-cog" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['stripe_settings'])){ echo $rzvy_translangArr['stripe_settings']; }else{ echo $rzvy_defaultlang['stripe_settings']; } ?>
							  </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_payment_settings_admin" id="rzvy_payment_settings_admin_3" data-id="3">
							  <div class="card-body text-primary text-center">
								<i class="fa fa-cog" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['authorizenet_settings'])){ echo $rzvy_translangArr['authorizenet_settings']; }else{ echo $rzvy_defaultlang['authorizenet_settings']; } ?>
							  </div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_payment_settings_admin" id="rzvy_payment_settings_admin_4" data-id="4">
							  <div class="card-body text-primary text-center">
								<i class="fa fa-cog" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['2checkout_settings'])){ echo $rzvy_translangArr['2checkout_settings']; }else{ echo $rzvy_defaultlang['2checkout_settings']; } ?>
							  </div>
							</div>
						</div>
					  </div>
					</div>
					<div class="tab-pane container fade" id="rzvy_email_settings">
					  <br/>
					  <div class="row">
						<div class="col-md-12">
							<form name="rzvy_email_settings_form" id="rzvy_email_settings_form" method="post">
								<div class="row">
									<label class="col-md-4"><?php if(isset($rzvy_translangArr['admin_email_notifications'])){ echo $rzvy_translangArr['admin_email_notifications']; }else{ echo $rzvy_defaultlang['admin_email_notifications']; } ?></label>
									<label class="rzvy-toggle-switch">
										<input type="checkbox" name="rzvy_admin_email_notification_status" id="rzvy_admin_email_notification_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_admin_email_notification_status")=="Y"){ echo "checked"; } ?> />
										<span class="rzvy-toggle-switch-slider"></span>
									</label>
								</div>
								<div class="row">
									<label class="col-md-4"><?php if(isset($rzvy_translangArr['staff_email_notifications'])){ echo $rzvy_translangArr['staff_email_notifications']; }else{ echo $rzvy_defaultlang['staff_email_notifications']; } ?></label>
									<label class="rzvy-toggle-switch">
										<input type="checkbox" name="rzvy_staff_email_notification_status" id="rzvy_staff_email_notification_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_staff_email_notification_status")=="Y"){ echo "checked"; } ?> />
										<span class="rzvy-toggle-switch-slider"></span>
									</label>
								</div>
								<div class="row">
									<label class="col-md-4"><?php if(isset($rzvy_translangArr['customer_email_notifications'])){ echo $rzvy_translangArr['customer_email_notifications']; }else{ echo $rzvy_defaultlang['customer_email_notifications']; } ?></label>
									<label class="rzvy-toggle-switch">
										<input type="checkbox" name="rzvy_customer_email_notification_status" id="rzvy_customer_email_notification_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_customer_email_notification_status")=="Y"){ echo "checked"; } ?> />
										<span class="rzvy-toggle-switch-slider"></span>
									</label>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label class="control-label"><?php if(isset($rzvy_translangArr['sender_name'])){ echo $rzvy_translangArr['sender_name']; }else{ echo $rzvy_defaultlang['sender_name']; } ?></label>
										<input name="rzvy_email_sender_name" id="rzvy_email_sender_name" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_email_sender_name"); ?>" />
									</div>
									<div class="col-md-6">
										<label class="control-label"><?php if(isset($rzvy_translangArr['sender_email'])){ echo $rzvy_translangArr['sender_email']; }else{ echo $rzvy_defaultlang['sender_email']; } ?></label>
										<input name="rzvy_email_sender_email" id="rzvy_email_sender_email" class="form-control" type="email" value="<?php echo $obj_settings->get_option("rzvy_email_sender_email"); ?>" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label class="control-label"><?php if(isset($rzvy_translangArr['send_email_with'])){ echo $rzvy_translangArr['send_email_with']; }else{ echo $rzvy_defaultlang['send_email_with']; } ?></label>
										<?php $rzvy_send_email_with = $obj_settings->get_option("rzvy_send_email_with"); ?>
										<select id="rzvy_send_email_with" class="form-control">
										  <option <?php if($rzvy_send_email_with == "SMTP"){ echo "selected"; } ?> value="SMTP">SMTP</option>
										  <option <?php if($rzvy_send_email_with == "MAIL"){ echo "selected"; } ?> value="MAIL">MAIL Function</option>
										</select>
									</div>
									<div class="col-md-6 rzvy_show_hide_on_send_email_with_change">
										<label class="control-label"><?php if(isset($rzvy_translangArr['smtp_hostname'])){ echo $rzvy_translangArr['smtp_hostname']; }else{ echo $rzvy_defaultlang['smtp_hostname']; } ?></label>
										<input name="rzvy_email_smtp_hostname" id="rzvy_email_smtp_hostname" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_email_smtp_hostname"); ?>" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6 rzvy_show_hide_on_send_email_with_change">
										<label class="control-label"><?php if(isset($rzvy_translangArr['smtp_username'])){ echo $rzvy_translangArr['smtp_username']; }else{ echo $rzvy_defaultlang['smtp_username']; } ?></label>
										<input name="rzvy_email_smtp_username" id="rzvy_email_smtp_username" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_email_smtp_username"); ?>" />
									</div>
									<div class="col-md-6 rzvy_show_hide_on_send_email_with_change">
										<label class="control-label"><?php if(isset($rzvy_translangArr['smtp_password'])){ echo $rzvy_translangArr['smtp_password']; }else{ echo $rzvy_defaultlang['smtp_password']; } ?></label>
										<input name="rzvy_email_smtp_password" id="rzvy_email_smtp_password" class="form-control" type="password" value="<?php echo $obj_settings->get_option("rzvy_email_smtp_password"); ?>" />
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-6 rzvy_show_hide_on_send_email_with_change">
										<label class="control-label"><?php if(isset($rzvy_translangArr['smtp_port'])){ echo $rzvy_translangArr['smtp_port']; }else{ echo $rzvy_defaultlang['smtp_port']; } ?></label>
										<input name="rzvy_email_smtp_port" id="rzvy_email_smtp_port" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_email_smtp_port"); ?>" />
									</div>
									<div class="col-md-6 rzvy_show_hide_on_send_email_with_change">
										<label class="control-label"><?php if(isset($rzvy_translangArr['encryption_type'])){ echo $rzvy_translangArr['encryption_type']; }else{ echo $rzvy_defaultlang['encryption_type']; } ?></label>
										<?php $rzvy_email_encryption_type = $obj_settings->get_option("rzvy_email_encryption_type"); ?>
										<select id="rzvy_email_encryption_type" class="form-control">
										  <option <?php if($rzvy_email_encryption_type == "plain"){ echo "selected"; } ?> value="plain">Plain</option>
										  <option <?php if($rzvy_email_encryption_type == "tls"){ echo "selected"; } ?> value="tls">TLS</option>
										  <option <?php if($rzvy_email_encryption_type == "ssl"){ echo "selected"; } ?> value="ssl">SSL</option>
										</select>
									</div>
									
								</div>
								<div class="form-group row">
									<div class="col-md-6 rzvy_show_hide_on_send_email_with_change">
										<label class="control-label"><?php if(isset($rzvy_translangArr['smtp_authentication'])){ echo $rzvy_translangArr['smtp_authentication']; }else{ echo $rzvy_defaultlang['smtp_authentication']; } ?></label>
										<?php $rzvy_email_smtp_authentication = $obj_settings->get_option("rzvy_email_smtp_authentication"); ?>
										<select id="rzvy_email_smtp_authentication" class="form-control">
										  <option <?php if($rzvy_email_smtp_authentication == "true"){ echo "selected"; } ?> value="true"><?php if(isset($rzvy_translangArr['true'])){ echo $rzvy_translangArr['true']; }else{ echo $rzvy_defaultlang['true']; } ?></option>
										  <option <?php if($rzvy_email_smtp_authentication == "false"){ echo "selected"; } ?> value="false"><?php if(isset($rzvy_translangArr['false'])){ echo $rzvy_translangArr['false']; }else{ echo $rzvy_defaultlang['false']; } ?></option>
										</select>
									</div>
								</div>
								<a id="update_email_settings_btn" class="btn btn-success btn-block" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
							</form>
						</div>
					  </div>
					</div>
					<div class="tab-pane container fade" id="rzvy_sms_settings">
					  <div class="row">
						<div class="col-md-12">
							<div class="row mt-3">
								<label class="col-md-3"><?php if(isset($rzvy_translangArr['admin_sms_notifications'])){ echo $rzvy_translangArr['admin_sms_notifications']; }else{ echo $rzvy_defaultlang['admin_sms_notifications']; } ?></label>
								<label class="rzvy-toggle-switch">
									<input type="checkbox" id="rzvy_admin_sms_notification_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_admin_sms_notification_status")=="Y"){ echo "checked"; } ?> />
									<span class="rzvy-toggle-switch-slider"></span>
								</label>
							</div>
							<div class="row">
								<label class="col-md-3"><?php if(isset($rzvy_translangArr['staff_sms_notifications'])){ echo $rzvy_translangArr['staff_sms_notifications']; }else{ echo $rzvy_defaultlang['staff_sms_notifications']; } ?></label>
								<label class="rzvy-toggle-switch">
									<input type="checkbox" id="rzvy_staff_sms_notification_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_staff_sms_notification_status")=="Y"){ echo "checked"; } ?> />
									<span class="rzvy-toggle-switch-slider"></span>
								</label>
							</div>
							<div class="row">
								<label class="col-md-3"><?php if(isset($rzvy_translangArr['customer_sms_notifications'])){ echo $rzvy_translangArr['customer_sms_notifications']; }else{ echo $rzvy_defaultlang['customer_sms_notifications']; } ?></label>
								<label class="rzvy-toggle-switch">
									<input type="checkbox" id="rzvy_customer_sms_notification_status" class="rzvy-toggle-switch-input" <?php if($obj_settings->get_option("rzvy_customer_sms_notification_status")=="Y"){ echo "checked"; } ?> />
									<span class="rzvy-toggle-switch-slider"></span>
								</label>
							</div>
							<br/>
							  <div class="row">
								<div class="col-md-3">
									<div class="card rzvy-boxshadow mt-1 mr-1 rzvy_sms_settings_sadmin" id="rzvy_sms_settings_sadmin_1" data-id="1">
									  <div class="card-body text-primary text-center">
										<i class="fa fa-cog" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['twilio_settings'])){ echo $rzvy_translangArr['twilio_settings']; }else{ echo $rzvy_defaultlang['twilio_settings']; } ?>
									  </div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_sms_settings_sadmin" id="rzvy_sms_settings_sadmin_2" data-id="2">
									  <div class="card-body text-primary text-center">
										<i class="fa fa-cog" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['plivo_settings'])){ echo $rzvy_translangArr['plivo_settings']; }else{ echo $rzvy_defaultlang['plivo_settings']; } ?>
									  </div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_sms_settings_sadmin" id="rzvy_sms_settings_sadmin_3" data-id="3">
									  <div class="card-body text-primary text-center">
										<i class="fa fa-cog" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['nexmo_settings'])){ echo $rzvy_translangArr['nexmo_settings']; }else{ echo $rzvy_defaultlang['nexmo_settings']; } ?>
									  </div>
									</div>
								</div>
								<div class="col-md-3">
									<div class="mt-1 mr-1 card rzvy-boxshadow rzvy_sms_settings_sadmin" id="rzvy_sms_settings_sadmin_4" data-id="4">
									  <div class="card-body text-primary text-center">
										<i class="fa fa-cog" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['textlocal_settings'])){ echo $rzvy_translangArr['textlocal_settings']; }else{ echo $rzvy_defaultlang['textlocal_settings']; } ?>
									  </div>
									</div>
								</div>
							  </div>
						</div>
					  </div>
					</div>
					<div class="tab-pane container fade" id="rzvy_seo_settings">
					  <br/>
					  <div class="row">
						<div class="col-md-12">
						  <form name="rzvy_seo_settings_form" id="rzvy_seo_settings_form" method="post" enctype="multipart/form-data">
							  <div class="form-group row">
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['google_analytics_code'])){ echo $rzvy_translangArr['google_analytics_code']; }else{ echo $rzvy_defaultlang['google_analytics_code']; } ?></label>
									<input name="rzvy_seo_ga_code" id="rzvy_seo_ga_code" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_seo_ga_code"); ?>" placeholder="e.g. XX-XXXXXXXXX-X" />
								</div>
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['page_title_meta_tag'])){ echo $rzvy_translangArr['page_title_meta_tag']; }else{ echo $rzvy_defaultlang['page_title_meta_tag']; } ?></label>
									<input name="rzvy_seo_meta_tag" id="rzvy_seo_meta_tag" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_seo_meta_tag"); ?>" />
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['og_page_title'])){ echo $rzvy_translangArr['og_page_title']; }else{ echo $rzvy_defaultlang['og_page_title']; } ?></label>
									<input name="rzvy_seo_og_meta_tag" id="rzvy_seo_og_meta_tag" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_seo_og_meta_tag"); ?>" />
								</div>
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['og_tag_type'])){ echo $rzvy_translangArr['og_tag_type']; }else{ echo $rzvy_defaultlang['og_tag_type']; } ?></label>
									<input name="rzvy_seo_og_tag_type" id="rzvy_seo_og_tag_type" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_seo_og_tag_type"); ?>" />
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['og_tag_url'])){ echo $rzvy_translangArr['og_tag_url']; }else{ echo $rzvy_defaultlang['og_tag_url']; } ?></label>
									<input name="rzvy_seo_og_tag_url" id="rzvy_seo_og_tag_url" class="form-control" type="text" value="<?php echo $obj_settings->get_option("rzvy_seo_og_tag_url"); ?>" />
								</div>
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['meta_description'])){ echo $rzvy_translangArr['meta_description']; }else{ echo $rzvy_defaultlang['meta_description']; } ?></label>
									<textarea name="rzvy_seo_meta_description" id="rzvy_seo_meta_description" class="form-control"><?php echo $obj_settings->get_option("rzvy_seo_meta_description"); ?></textarea>
								</div>
							  </div>
							  <div class="form-group row">
								<div class="col-md-6">
									<label class="control-label"><?php if(isset($rzvy_translangArr['og_tag_image'])){ echo $rzvy_translangArr['og_tag_image']; }else{ echo $rzvy_defaultlang['og_tag_image']; } ?></label>
									<div class="rzvy-image-upload">
										<div class="rzvy-image-edit-icon">
											<input type='hidden' id="rzvy_seo_og_tag_image-hidden" name="rzvy_seo_og_tag_image-hidden" />
											<input type='file' id="rzvy_seo_og_tag_image" accept=".png, .jpg, .jpeg" />
											<label for="rzvy_seo_og_tag_image"></label>
										</div>
										<div class="rzvy-image-preview">
											<div id="rzvy_seo_og_tag_image-preview" style="<?php $og_tag_image = $obj_settings->get_option("rzvy_seo_og_tag_image"); if($og_tag_image != '' && file_exists("../uploads/images/".$og_tag_image)){ echo "background-image: url(".SITE_URL."uploads/images/".$og_tag_image.");"; }else{ echo "background-image: url(".SITE_URL."includes/images/default-avatar.jpg);"; } ?>">
											</div>
										</div>
									</div>
								</div>
							  </div>
							  <a id="update_seo_settings_btn" class="btn btn-success btn-block" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
						 </form>
						</div>
					  </div>
					</div>
					<div class="tab-pane container fade" id="rzvy_welcome_settings">
					  <br/>
						  <div class="form-group row pl-12">
							<div class="col-md-6">
								<label class="control-label"><?php if(isset($rzvy_translangArr['welcome_message_status'])){ echo $rzvy_translangArr['welcome_message_status']; }else{ echo $rzvy_defaultlang['welcome_message_status']; } ?></label>
								<?php $rzvy_welcome_message_status = $obj_settings->get_option("rzvy_welcome_message_status"); ?>
								<select name="rzvy_welcome_message_status" id="rzvy_welcome_message_status" class="form-control selectpicker">
								  <option value="Y" <?php if($rzvy_welcome_message_status == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['enable'])){ echo $rzvy_translangArr['enable']; }else{ echo $rzvy_defaultlang['enable']; } ?></option>
								  <option value="N" <?php if($rzvy_welcome_message_status == "N" || $rzvy_welcome_message_status == ""){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['disable'])){ echo $rzvy_translangArr['disable']; }else{ echo $rzvy_defaultlang['disable']; } ?></option>
								</select>
							</div>
							<div class="col-md-6">
								<label class="control-label"><?php if(isset($rzvy_translangArr['welcome_as_more_info'])){ echo $rzvy_translangArr['welcome_as_more_info']; }else{ echo $rzvy_defaultlang['welcome_as_more_info']; } ?></label>
								<?php $rzvy_welcome_as_more_info_status = $obj_settings->get_option("rzvy_welcome_as_more_info_status"); ?>
								<select name="rzvy_welcome_as_more_info_status" id="rzvy_welcome_as_more_info_status" class="form-control selectpicker">
								  <option value="Y" <?php if($rzvy_welcome_as_more_info_status == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['enable'])){ echo $rzvy_translangArr['enable']; }else{ echo $rzvy_defaultlang['enable']; } ?></option>
								  <option value="N" <?php if($rzvy_welcome_as_more_info_status == "N" || $rzvy_welcome_as_more_info_status == ""){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['disable'])){ echo $rzvy_translangArr['disable']; }else{ echo $rzvy_defaultlang['disable']; } ?></option>
								</select>
							</div>
						  </div>	  
						<div class="row pl-4">
							<h5 class="col-md-12"><?php if(isset($rzvy_translangArr['welcome_message_content'])){ echo $rzvy_translangArr['welcome_message_content']; }else{ echo $rzvy_defaultlang['welcome_message_content']; } ?></h5>
						</div>
						<div class="col-md-12">
							<div class="col-md-12 mt-2">
								<div class="form-group">
									<textarea name="rzvy_welcome_message_container" class="rzvy_welcome_message_container rzvy_text_editor_container" id="rzvy_welcome_message_container" autocomplete="off"><?php echo base64_decode($obj_settings->get_option("rzvy_welcome_message_container")); ?></textarea>
								</div>
							</div>
							<a id="update_welcome_message_btn" class="btn btn-success btn-block" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
						</div>
					</div>
					<div class="tab-pane container fade" id="rzvy_bookingform_settings">
					  <br/>	
					  <form name="rzvy_bookingform_settings_form" id="rzvy_bookingform_settings_form" method="post" enctype="multipart/form-data">
						  <div class="form-group row">
							<div class="col-md-4">
								<label class="control-label"><?php if(isset($rzvy_translangArr['booking_form_theme'])){ echo $rzvy_translangArr['booking_form_theme']; }else{ echo $rzvy_defaultlang['booking_form_theme']; } ?></label>
								<?php $rzvy_frontend = $obj_settings->get_option("rzvy_frontend"); ?>
								<select name="rzvy_frontend" id="rzvy_frontend" class="form-control selectpicker">
								  <option value="onepage" <?php if($rzvy_frontend == "onepage"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['onepage_checkout'])){ echo $rzvy_translangArr['onepage_checkout']; }else{ echo $rzvy_defaultlang['onepage_checkout']; } ?></option>
								  <option value="stepview" <?php if($rzvy_frontend == "stepview"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['stepview_checkout'])){ echo $rzvy_translangArr['stepview_checkout']; }else{ echo $rzvy_defaultlang['stepview_checkout']; } ?></option>
								</select>
							</div>
							<div class="col-md-4">
								<label class="control-label"><?php if(isset($rzvy_translangArr['single_category_auto_trigger_status'])){ echo $rzvy_translangArr['single_category_auto_trigger_status']; }else{ echo $rzvy_defaultlang['single_category_auto_trigger_status']; } ?></label>
								<?php $rzvy_single_category_autotrigger_status = $obj_settings->get_option("rzvy_single_category_autotrigger_status"); ?>
								<select name="rzvy_single_category_autotrigger_status" id="rzvy_single_category_autotrigger_status" class="form-control selectpicker">
								  <option value="Y" <?php if($rzvy_single_category_autotrigger_status == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['enable'])){ echo $rzvy_translangArr['enable']; }else{ echo $rzvy_defaultlang['enable']; } ?></option>
								  <option value="N" <?php if($rzvy_single_category_autotrigger_status == "N" || $rzvy_single_category_autotrigger_status == ""){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['disable'])){ echo $rzvy_translangArr['disable']; }else{ echo $rzvy_defaultlang['disable']; } ?></option>
								</select>
							</div>
							<div class="col-md-4">
								<label class="control-label"><?php if(isset($rzvy_translangArr['single_service_auto_trigger_status'])){ echo $rzvy_translangArr['single_service_auto_trigger_status']; }else{ echo $rzvy_defaultlang['single_service_auto_trigger_status']; } ?></label>
								<?php $rzvy_single_service_autotrigger_status = $obj_settings->get_option("rzvy_single_service_autotrigger_status"); ?>
								<select name="rzvy_single_service_autotrigger_status" id="rzvy_single_service_autotrigger_status" class="form-control selectpicker">
								  <option value="Y" <?php if($rzvy_single_service_autotrigger_status == "Y"){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['enable'])){ echo $rzvy_translangArr['enable']; }else{ echo $rzvy_defaultlang['enable']; } ?></option>
								  <option value="N" <?php if($rzvy_single_service_autotrigger_status == "N" || $rzvy_single_service_autotrigger_status == ""){ echo "selected"; } ?>><?php if(isset($rzvy_translangArr['disable'])){ echo $rzvy_translangArr['disable']; }else{ echo $rzvy_defaultlang['disable']; } ?></option>
								</select>
							</div>
						  </div>
						  <a id="update_bookingform_settings_btn" class="btn btn-success btn-block" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update_settings'])){ echo $rzvy_translangArr['update_settings']; }else{ echo $rzvy_defaultlang['update_settings']; } ?></a>
						</form>
					</div>
			  </div>
			</div>
		</div>
	 </div>
	<!-- Payment Setting Form Modal-->
    <div class="modal fade" id="rzvy-payment-setting-form-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-payment-setting-form-modal-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rzvy-payment-setting-form-modal-label"><?php if(isset($rzvy_translangArr['payment_settings'])){ echo $rzvy_translangArr['payment_settings']; }else{ echo $rzvy_defaultlang['payment_settings']; } ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body rzvy-payment-setting-form-modal-content">
			
		  </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
            <a id="update_payment_settings_btn" data-payment="" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['save_settings'])){ echo $rzvy_translangArr['save_settings']; }else{ echo $rzvy_defaultlang['save_settings']; } ?></a>
          </div>
        </div>
      </div>
    </div>
	 
	<!-- SMS Setting Form Modal-->
    <div class="modal fade" id="rzvy-sms-setting-form-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-sms-setting-form-modal-label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rzvy-sms-setting-form-modal-label"><?php if(isset($rzvy_translangArr['sms_settings'])){ echo $rzvy_translangArr['sms_settings']; }else{ echo $rzvy_defaultlang['sms_settings']; } ?></h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body rzvy-sms-setting-form-modal-content">
			
		  </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
            <a id="update_sms_settings_btn" data-sms="" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['save_settings'])){ echo $rzvy_translangArr['save_settings']; }else{ echo $rzvy_defaultlang['save_settings']; } ?></a>
          </div>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>