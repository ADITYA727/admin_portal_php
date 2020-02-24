<?php 
session_start();
/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");

include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

/* Save selected language ajax */
if(isset($_POST['rzvy_save_selected_lang_labels'])){ 
	$lang_array = $_POST['lang_array'];
	$filename = dirname(dirname(dirname(__FILE__)))."/uploads/languages/rzvy-".$_POST["lang"].".php";
	if(file_exists($filename)){
		include($filename);
		foreach($rzvy_translangArr as $key => $value){
			$rzvy_translangArr[$key] = base64_decode($value);
		}
	}else{
		$rzvy_translangArr = array();
	}
	$rzvy_translangArr_submit = $rzvy_translangArr;
	foreach($lang_array as $key => $value){
		$rzvy_translangArr_submit[$key] = $value;
	}
	$myfile = fopen($filename, "w");
	$txt = '<?php '."\n";
	$txt .= '$rzvy_translangArr = array( '."\n";
	foreach($rzvy_translangArr_submit as $key => $value){
		$txt .= '"'.$key.'" => "'.base64_encode($value).'", '."\n";
	}
	$txt .= ");";
	fwrite($myfile, $txt);
	fclose($myfile);
} 
/* Get selected language ajax */
else if(isset($_POST['rzvy_get_selected_lang_labels'])){ 
	$new_rzvy_defaultlang = $rzvy_defaultlang;
	$sizeof_arr = sizeof($new_rzvy_defaultlang);
	$divisionof_arr = $sizeof_arr/50;
	$total_parts = ceil($divisionof_arr);
	$new_keys = array_keys($new_rzvy_defaultlang); 
	$new_rzvy_translangArr = array();
	
	if($_POST["type"] == "C"){
		if(file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/languages/rzvy-".$_POST["lang"].".php")){
			include(dirname(dirname(dirname(__FILE__)))."/uploads/languages/rzvy-".$_POST["lang"].".php");
			if(isset($rzvy_translangArr)){
				foreach($rzvy_translangArr as $key => $value){
					$new_rzvy_translangArr[$key] = base64_decode($value);
				}
			}
		}
	}else if($_POST["type"] == "D"){
		if(file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/languages/rzvy-".$_POST["lang"].".php")){
			include(dirname(dirname(dirname(__FILE__)))."/uploads/languages/rzvy-".$_POST["lang"].".php");
			if(isset($rzvy_translangArr)){
				foreach($rzvy_translangArr as $key => $value){
					$new_rzvy_translangArr[$key] = base64_decode($value);
				}
			}
		}
	} 
	?>
	<div id="rzvy_rzvy_accordion">
		<?php 
		for($j=1; $j<=$total_parts; $j++){ 
			if($j > 1){
				$multiply = (50*$j);
				$start_point = $multiply-50;
				$end_point = $multiply;
				if($end_point>$sizeof_arr){
					$end_point = $sizeof_arr;
				}
			}else{
				$start_point = 0;
				$end_point = 50;
			}	
			
			$temp_Arr = array();
			for($i=$start_point; $i < $end_point; $i++) {
				$temp_Arr[$new_keys[$i]] = $new_rzvy_defaultlang[$new_keys[$i]];
			} 
			?>
			<div class="card my-2">
				<div class="card-header" href="#rzvy_rzvy_languages_section_<?php echo $j; ?>" data-toggle="collapse" class="collapsed btn btn-link">
					<h5><i class="fa fa-fw fa-puzzle-piece"></i> <?php if(isset($new_rzvy_translangArr['section'])){ echo $new_rzvy_translangArr['section']; }else{ echo $rzvy_defaultlang['section']; } ?> <?php echo $j; ?></h5>
				</div>
				<div id="rzvy_rzvy_languages_section_<?php echo $j; ?>" class="border px-4 py-1 collapse" data-parent="#rzvy_rzvy_accordion">
					<?php 
					foreach($temp_Arr as $key => $value){
						if(isset($new_rzvy_translangArr[$key])){ 
							$print_value = $new_rzvy_translangArr[$key];
						}else{
							$print_value = $value;
						}
						?>
						<div class="row py-1 border-bottom">
							<div class="col-md-5"><label for="<?php echo $key; ?>"><?php echo $print_value; ?></label></div>
							<div class="col-md-7"><input class="form-control rzvy_rzvy_lang_input_<?php echo $j; ?>" id="<?php echo $key; ?>" name="<?php echo $key; ?>" value="<?php echo $print_value; ?>" type="text" /></div>
						</div>
						<?php 
					} 
					?>
					<a href="javascript:void(0)" class="btn btn-success mb-5 mt-1 btn-block rzvy_rzvy_save_btn" data-j="<?php echo $j; ?>"><?php if(isset($new_rzvy_translangArr['save_translation'])){ echo $new_rzvy_translangArr['save_translation']; }else{ echo $rzvy_defaultlang['save_translation']; } ?></a>
				</div>
			</div>
			<?php 
		} 
		?>
	</div>
	<?php 
}  

/* Delete selected language ajax */
else if(isset($_POST['rzvy_delete_lang'])){ 
	$file = dirname(dirname(dirname(__FILE__)))."/uploads/languages/rzvy-".$_POST["lang"].".php";
	unlink($file);
}

/* Import selected language ajax */
if(isset($_POST['rzvy_import_selected_lang_labels'])){ 
	if(file_exists(dirname(dirname(dirname(__FILE__)))."/uploads/languages/rzvy-".$_POST["lang"].".php")){
		include(dirname(dirname(dirname(__FILE__)))."/uploads/languages/rzvy-".$_POST["lang"].".php");
		$filename = dirname(dirname(dirname(__FILE__)))."/uploads/languages/rzvy-".$_POST["lang"].".php";
    	if(file_exists($filename)){
    		unlink($filename);
    	}
    	$myfile = fopen($filename, "w");
    	$txt = '<?php '."\n";
    	$txt .= '$rzvy_translangArr = array( '."\n";
    	foreach($rzvy_translangArr as $key => $value){
    		$txt .= '"'.$key.'" => "'.$value.'", '."\n";
    	}
    	$txt .= ");";
    	fwrite($myfile, $txt);
    	fclose($myfile);
	}
} 