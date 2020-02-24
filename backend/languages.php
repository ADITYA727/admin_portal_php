<?php include 'header.php'; ?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><i class="fa fa-fw fa-language"></i> <?php if(isset($rzvy_translangArr['language_translator'])){ echo $rzvy_translangArr['language_translator']; }else{ echo $rzvy_defaultlang['language_translator']; } ?></li>
      </ol>
      <!-- Languages card-->
        <div class="my-4 mx-2">
			<?php 
			/** Translated languages by you **/
			$translated_languages = "";
			$langfiles = array();
			$langfiles_list = scandir(dirname(dirname(__FILE__))."/uploads/languages/");
			foreach($langfiles_list as $value){
				$exp_key = explode('-', $value);
				if($exp_key[0] == 'rzvy'){
					array_push($langfiles, $value);
				}
			}
			
			$sizeof_langfiles = sizeof($langfiles);
			if($sizeof_langfiles>0){ 
				?>
				<div class="col-md-12">
					<p><?php if(isset($rzvy_translangArr['translated_languages_are'])){ echo $rzvy_translangArr['translated_languages_are']; }else{ echo $rzvy_defaultlang['translated_languages_are']; } ?></p> 
				</div>
				<div class="col-md-12 my-2">
					<?php 
					for($i=0;$i<$sizeof_langfiles;$i++){
						foreach($langnames as $key => $value){
							if('rzvy-'.$key.'.php' == $langfiles[$i]){ 
								$translated_languages .= '<label style="border-radius:3px" class="border px-3 py-1 m-1 rzvy_remove_language_'.$key.'">'.$value." <a href='javascript:void(0)' class='rzvy_rzvy_edit_language pl-2' data-lang='".$key."' data-type='C'><i class='fa fa-pencil text-primary'></i></a> &nbsp;<a href='javascript:void(0)' class='rzvy_rzvy_remove_language pl-1' data-lang='".$key."'><i class='fa fa-close text-danger'></i></a></label>"; 
							}
						}
					}
					?>
					<b><?php echo $translated_languages; ?></b>
				</div><hr />
				<?php 
			}  
			?>
			
			<!-- Default Languages run on load -->
		  <div class="col-md-12 my-4">
			<label class="control-label"><?php if(isset($rzvy_translangArr['show_default_language_in_dropdown_on_page_load'])){ echo $rzvy_translangArr['show_default_language_in_dropdown_on_page_load']; }else{ echo $rzvy_defaultlang['show_default_language_in_dropdown_on_page_load']; } ?></label>
			<select name="rzvy_default_language_on_page_load" id="rzvy_default_language_on_page_load" class="selectpicker" data-size="10" data-live-search="true" data-live-search-placeholder="Search">
				<?php 
				$rzvy_default_language_on_page_load = $obj_settings->get_option("rzvy_default_language_on_page_load");
				$show_dropdown = $obj_settings->get_option("rzvy_rzvy_show_dropdown_languages");
				if($show_dropdown != ""){
					$lang_exploded = explode(",", $show_dropdown);
					$i=1;
					foreach($lang_exploded as $lng){
						?><option value="<?php echo $lng; ?>" <?php if($rzvy_default_language_on_page_load == $lng){ echo "selected"; } ?>><?php echo $langnames[$lng]; ?></option><?php 
					}
				}
				?>
			</select>
		  </div>
			<hr />
			
			<div class="col-md-12 my-4">
				<label for="rzvy_rzvy_show_dropdown_languages"><?php if(isset($rzvy_translangArr['select_languages_to_show_in_language_selection_dropdown'])){ echo $rzvy_translangArr['select_languages_to_show_in_language_selection_dropdown']; }else{ echo $rzvy_defaultlang['select_languages_to_show_in_language_selection_dropdown']; } ?></label>
				<select name="rzvy_rzvy_show_dropdown_languages" id="rzvy_rzvy_show_dropdown_languages" class="selectpicker" data-size="10" data-live-search="true" data-live-search-placeholder="Search" multiple>
					<option value="en">English (United States)</option>
					<option value="ary" lang="ar">العربية المغربية</option>
					<option value="ar" lang="ar">العربية</option>
					<option value="az">Azərbaycan dili</option>
					<option value="azb" lang="az">گؤنئی آذربایجان</option>
					<option value="bg_BG">Български</option>
					<option value="bn_BD">বাংলা</option>
					<option value="bs_BA">Bosanski</option>
					<option value="ca">Català</option>
					<option value="ceb">Cebuano</option>
					<option value="cs_CZ">Čeština‎</option>
					<option value="cy">Cymraeg</option>
					<option value="da_DK">Dansk</option>
					<option value="de_CH_informal">Deutsch (Schweiz, Du)</option>
					<option value="de_DE_formal">Deutsch (Sie)</option>
					<option value="de_DE">Deutsch</option>
					<option value="de_CH">Deutsch (Schweiz)</option>
					<option value="el">Ελληνικά</option>
					<option value="en_CA">English (Canada)</option>
					<option value="en_GB">English (UK)</option>
					<option value="en_NZ">English (New Zealand)</option>
					<option value="en_ZA">English (South Africa)</option>
					<option value="en_AU">English (Australia)</option>
					<option value="eo">Esperanto</option>
					<option value="es_ES">Español</option>
					<option value="et">Eesti</option>
					<option value="eu">Euskara</option>
					<option value="fa_IR" lang="fa">فارسی</option>
					<option value="fi">Suomi</option>
					<option value="fr_FR">Français</option>
					<option value="gd">Gàidhlig</option>
					<option value="gl_ES">Galego</option>
					<option value="gu">ગુજરાતી</option>
					<option value="haz" lang="haz">هزاره گی</option>
					<option value="hi_IN">हिन्दी</option>
					<option value="hr">Hrvatski</option>
					<option value="hu_HU">Magyar</option>
					<option value="hy">Հայերեն</option>
					<option value="id_ID">Bahasa Indonesia</option>
					<option value="is_IS">Íslenska</option>
					<option value="it_IT">Italiano</option>
					<option value="ja">日本語</option>
					<option value="ka_GE">ქართული</option>
					<option value="ko_KR">한국어</option>
					<option value="lt_LT">Lietuvių kalba</option>
					<option value="lv">Latviešu valoda</option>
					<option value="mk_MK">Македонски јазик</option>
					<option value="mr">मराठी</option>
					<option value="ms_MY">Bahasa Melayu</option>
					<option value="my_MM">Burmese</option>
					<option value="nb_NO">Norsk bokmål</option>
					<option value="nl_NL">Nederlands</option>
					<option value="nl_NL_formal">Nederlands (Formeel)</option>
					<option value="nn_NO">Norsk nynorsk</option>
					<option value="oci">Occitan</option>
					<option value="pl_PL">Polski</option>
					<option value="pt_PT">Português</option>
					<option value="pt_BR">Português do Brasil</option>
					<option value="ro_RO">Română</option>
					<option value="ru_RU">Русский</option>
					<option value="sk_SK">Slovenčina</option>
					<option value="sl_SI">Slovenščina</option>
					<option value="sq">Shqip</option>
					<option value="sr_RS" >Српски језик</option>
					<option value="sv_SE">Svenska</option>
					<option value="szl">Ślōnskŏ gŏdka</option>
					<option value="th">ไทย</option>
					<option value="tl">Tagalog</option>
					<option value="tr_TR">Türkçe</option>
					<option value="ug_CN">Uyƣurqə</option>
					<option value="uk">Українська</option>
					<option value="vi">Tiếng Việt</option>
					<option value="zh_TW">繁體中文</option>
					<option value="zh_HK">香港中文版</option>
					<option value="zh_CN">简体中文</option>
				</select>
			</div>
			<hr />
			<div class="col-md-12 my-4">
				<label for="rzvy_rzvy_langauges"><?php if(isset($rzvy_translangArr['select_language_to_translate'])){ echo $rzvy_translangArr['select_language_to_translate']; }else{ echo $rzvy_defaultlang['select_language_to_translate']; } ?></label>
				<select name="rzvy_rzvy_langauges" id="rzvy_rzvy_langauges" class="selectpicker" data-size="10" data-live-search="true" data-live-search-placeholder="Search">
					<option value="none">Select Language</option>
					<option value="en">English (United States)</option>
					<option value="ary" lang="ar">العربية المغربية</option>
					<option value="ar" lang="ar">العربية</option>
					<option value="az">Azərbaycan dili</option>
					<option value="azb" lang="az">گؤنئی آذربایجان</option>
					<option value="bg_BG">Български</option>
					<option value="bn_BD">বাংলা</option>
					<option value="bs_BA">Bosanski</option>
					<option value="ca">Català</option>
					<option value="ceb">Cebuano</option>
					<option value="cs_CZ">Čeština‎</option>
					<option value="cy">Cymraeg</option>
					<option value="da_DK">Dansk</option>
					<option value="de_CH_informal">Deutsch (Schweiz, Du)</option>
					<option value="de_DE_formal">Deutsch (Sie)</option>
					<option value="de_DE">Deutsch</option>
					<option value="de_CH">Deutsch (Schweiz)</option>
					<option value="el">Ελληνικά</option>
					<option value="en_CA">English (Canada)</option>
					<option value="en_GB">English (UK)</option>
					<option value="en_NZ">English (New Zealand)</option>
					<option value="en_ZA">English (South Africa)</option>
					<option value="en_AU">English (Australia)</option>
					<option value="eo">Esperanto</option>
					<option value="es_ES">Español</option>
					<option value="et">Eesti</option>
					<option value="eu">Euskara</option>
					<option value="fa_IR" lang="fa">فارسی</option>
					<option value="fi">Suomi</option>
					<option value="fr_FR">Français</option>
					<option value="gd">Gàidhlig</option>
					<option value="gl_ES">Galego</option>
					<option value="gu">ગુજરાતી</option>
					<option value="haz" lang="haz">هزاره گی</option>
					<option value="hi_IN">हिन्दी</option>
					<option value="hr">Hrvatski</option>
					<option value="hu_HU">Magyar</option>
					<option value="hy">Հայերեն</option>
					<option value="id_ID">Bahasa Indonesia</option>
					<option value="is_IS">Íslenska</option>
					<option value="it_IT">Italiano</option>
					<option value="ja">日本語</option>
					<option value="ka_GE">ქართული</option>
					<option value="ko_KR">한국어</option>
					<option value="lt_LT">Lietuvių kalba</option>
					<option value="lv">Latviešu valoda</option>
					<option value="mk_MK">Македонски јазик</option>
					<option value="mr">मराठी</option>
					<option value="ms_MY">Bahasa Melayu</option>
					<option value="my_MM">Burmese</option>
					<option value="nb_NO">Norsk bokmål</option>
					<option value="nl_NL">Nederlands</option>
					<option value="nl_NL_formal">Nederlands (Formeel)</option>
					<option value="nn_NO">Norsk nynorsk</option>
					<option value="oci">Occitan</option>
					<option value="pl_PL">Polski</option>
					<option value="pt_PT">Português</option>
					<option value="pt_BR">Português do Brasil</option>
					<option value="ro_RO">Română</option>
					<option value="ru_RU">Русский</option>
					<option value="sk_SK">Slovenčina</option>
					<option value="sl_SI">Slovenščina</option>
					<option value="sq">Shqip</option>
					<option value="sr_RS" >Српски језик</option>
					<option value="sv_SE">Svenska</option>
					<option value="szl">Ślōnskŏ gŏdka</option>
					<option value="th">ไทย</option>
					<option value="tl">Tagalog</option>
					<option value="tr_TR">Türkçe</option>
					<option value="ug_CN">Uyƣurqə</option>
					<option value="uk">Українська</option>
					<option value="vi">Tiếng Việt</option>
					<option value="zh_TW">繁體中文</option>
					<option value="zh_HK">香港中文版</option>
					<option value="zh_CN">简体中文</option>
				</select>
			</div>
			<div class="rzvy_manage_languages_container">
				
			</div>
        </div> 
<?php include 'footer.php'; ?>