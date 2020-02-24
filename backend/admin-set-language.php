<?php 
$langOptions = "";
$selected_lang = "";
$lang_j = 0;
$rzvy_show_dropdown = $obj_set_lang->get_option("rzvy_rzvy_show_dropdown_languages");
$default_language_on_page_load = $obj_set_lang->get_option("rzvy_default_language_on_page_load");

if($rzvy_show_dropdown != ""){ 
	$explodedLang = explode(",", $rzvy_show_dropdown); 
	for($i=0;$i<sizeof($explodedLang);$i++){
		foreach($langnames as $key => $vals){
			if('rzvy-'.$key.'.php' == 'rzvy-'.$explodedLang[$i].'.php' && file_exists(ROOT_PATH.'/uploads/languages/rzvy-'.$explodedLang[$i].'.php')){ 
				if($lang_j==0 && !isset($_COOKIE["rzvy_language"])){ 
					if($default_language_on_page_load != ""){
						setcookie("rzvy_language", $default_language_on_page_load, time() + (86400 * 30), "/");
						$selected_lang = $default_language_on_page_load;
					}else{
						setcookie("rzvy_language", $explodedLang[$i], time() + (86400 * 30), "/");
						$selected_lang = $explodedLang[$i];
					}
					include(ROOT_PATH.'/uploads/languages/rzvy-'.$selected_lang.'.php');
					foreach($rzvy_translangArr as $keys => $value){
						$rzvy_translangArr[$keys] = base64_decode($value);
					}
				}else if($lang_j==0 && isset($_COOKIE["rzvy_language"]) && file_exists(ROOT_PATH.'/uploads/languages/rzvy-'.$_COOKIE["rzvy_language"].'.php')){ 
					$selected_lang = $_COOKIE["rzvy_language"];
					include(ROOT_PATH.'/uploads/languages/rzvy-'.$selected_lang.'.php');
					foreach($rzvy_translangArr as $keys => $value){
						$rzvy_translangArr[$keys] = base64_decode($value);
					}
				}else if($lang_j==0 && isset($_COOKIE["rzvy_language"]) && !file_exists(ROOT_PATH.'/uploads/languages/rzvy-'.$_COOKIE["rzvy_language"].'.php')){ 
					if($default_language_on_page_load != ""){
						setcookie("rzvy_language", $default_language_on_page_load, time() + (86400 * 30), "/");
						$selected_lang = $default_language_on_page_load;
					}else{
						setcookie("rzvy_language", $explodedLang[$i], time() + (86400 * 30), "/");
						$selected_lang = $explodedLang[$i];
					}
					include(ROOT_PATH.'/uploads/languages/rzvy-'.$selected_lang.'.php');
					foreach($rzvy_translangArr as $keys => $value){
						$rzvy_translangArr[$keys] = base64_decode($value);
					}
				}else{} 
				
				$isSelected = "";
				if($selected_lang == $explodedLang[$i]){
					$isSelected = "selected";
				}
				$langOptions .= '<option value="'.$explodedLang[$i].'" '.$isSelected.'>'.$vals.'</option>';
				$lang_j++;
			}
		}
	} 
}