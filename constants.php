<?php 
error_reporting(E_ALL);
if(!session_id()) { @session_start(); }
include("config.php");
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") { 
    $protocol = 'https';
} else { 
    $protocol = 'http';
}
$cur_dirname = basename(__DIR__);
if($cur_dirname=='public_html' || $cur_dirname=='httpdocs'){
	$cur_dirname='';
}

$cur_dir = substr($_SERVER['REQUEST_URI'], 0, @strpos($_SERVER['REQUEST_URI'], $cur_dirname)).$cur_dirname."/";
$dots = explode(".",$_SERVER['HTTP_HOST']);

if(sizeof($dots)>2 && $dots[0]!='www' && strlen($dots[1])>3){
	if($_SERVER['HTTP_HOST'].'/' == $cur_dir){
		define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"].'/');
	    define("BASE_URL", '/');
	    define("SITE_URL",$protocol.'://'.$_SERVER['HTTP_HOST'].'/');
    	define("AJAX_URL",$protocol.'://'.$_SERVER['HTTP_HOST'].'/includes/lib/');
	}elseif('/'.$dots[0].'/'!=$cur_dir){
	    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"].'/');
	    define("BASE_URL", '');
	    define("SITE_URL",$protocol.'://'.$_SERVER['HTTP_HOST'].'/');
    	define("AJAX_URL",$protocol.'://'.$_SERVER['HTTP_HOST'].'/includes/lib/');
	}else{
	    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] .$cur_dir);
	    define("BASE_URL", substr($cur_dir,0,-1));
    	define("SITE_URL",$protocol.'://'.$_SERVER['HTTP_HOST'].$cur_dir);
	    define("AJAX_URL",$protocol.'://'.$_SERVER['HTTP_HOST'].$cur_dir.'includes/lib/');
	}
}else{
	define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"] .$cur_dir);
	define("BASE_URL", substr($cur_dir,0,-1));
	define("SITE_URL",$protocol.'://'.$_SERVER['HTTP_HOST'].$cur_dir);
	define("AJAX_URL",$protocol.'://'.$_SERVER['HTTP_HOST'].$cur_dir.'includes/lib/');
}

$langnames = array( "en"=> "English (United States)", "ary"=> "العربية المغربية", "ar"=> "العربية", "az"=> "Azərbaycan dili", "azb"=> "گؤنئی آذربایجان", "bg_BG"=> "Български", "bn_BD"=> "বাংলা", "bs_BA"=> "Bosanski", "ca"=> "Català", "ceb"=> "Cebuano", "cs_CZ"=> "Čeština‎", "cy"=> "Cymraeg", "da_DK"=> "Dansk", "de_CH_informal"=> "Deutsch (Schweiz, Du)", "de_DE_formal"=> "Deutsch (Sie)", "de_DE"=> "Deutsch", "de_CH"=> "Deutsch (Schweiz)", "el"=> "Ελληνικά", "en_CA"=> "English (Canada)", "en_GB"=> "English (UK)", "en_NZ"=> "English (New Zealand)", "en_ZA"=> "English (South Africa)", "en_AU"=> "English (Australia)", "eo"=> "Esperanto", "es_ES"=> "Español", "et"=> "Eesti", "eu"=> "Euskara", "fa_IR"=> "فارسی", "fi"=> "Suomi", "fr_FR"=> "Français", "gd"=> "Gàidhlig", "gl_ES"=> "Galego", "gu"=> "ગુજરાતી", "haz"=> "هزاره گی", "hi_IN"=> "हिन्दी", "hr"=> "Hrvatski", "hu_HU"=> "Magyar", "hy"=> "Հայերեն", "id_ID"=> "Bahasa Indonesia", "is_IS"=> "Íslenska", "it_IT"=> "Italiano", "ja"=> "日本語", "ka_GE"=> "ქართული", "ko_KR"=> "한국어", "lt_LT"=> "Lietuvių kalba", "lv"=> "Latviešu valoda", "mk_MK"=> "Македонски јазик", "mr"=> "मराठी", "ms_MY"=> "Bahasa Melayu", "my_MM"=> "Burmese", "nb_NO"=> "Norsk bokmål", "nl_NL"=> "Nederlands", "nl_NL_formal"=> "Nederlands (Formeel)", "nn_NO"=> "Norsk nynorsk", "oci"=> "Occitan", "pl_PL"=> "Polski", "pt_PT"=> "Português", "pt_BR"=> "Português do Brasil", "ro_RO"=> "Română", "ru_RU"=> "Русский", "sk_SK"=> "Slovenčina", "sl_SI"=> "Slovenščina", "sq"=> "Shqip", "sr_RS"=> "Српски језик", "sv_SE"=> "Svenska", "szl"=> "Ślōnskŏ gŏdka", "th"=> "ไทย", "tl"=> "Tagalog", "tr_TR"=> "Türkçe", "ug_CN"=> "Uyƣurqə", "uk"=> "Українська", "vi"=> "Tiếng Việt", "zh_TW"=> "繁體中文", "zh_HK"=> "香港中文版", "zh_CN"=> "简体中文" );

include_once(ROOT_PATH.'/includes/default-language/rzvy-default.php');
include_once(ROOT_PATH.'/classes/class_connection.php');
include_once(ROOT_PATH.'/classes/class_set_lang.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
include(ROOT_PATH."/classes/Exception.php");
include(ROOT_PATH."/classes/PHPMailer.php");
include(ROOT_PATH."/classes/SMTP.php");

$obj_database = new rzvy_database();
$conn = $obj_database->connect();

if(isset($conn)){
	$obj_mail = new PHPMailer(true, $conn);
	$obj_set_lang = new rzvy_set_lang();
	$obj_set_lang->conn = $conn;
	include_once(ROOT_PATH.'/backend/admin-set-language.php'); 
	
	/** Version Update */
	include_once(ROOT_PATH.'/classes/class_update.php'); 
	$obj_update = new rzvy_update();
	$obj_update->rzvy_version_update($conn);
}