<?php 
class rzvy_update{
	/* Function for update version option value */
	public function rzvy_update_version_option($version,$conn){
		$res = mysqli_query($conn, "select `option_value` from `rzvy_settings` where `option_name` = 'rzvy_version'");
		if($res){
			if(mysqli_num_rows($res)>0){
				$result = mysqli_query($conn, "update `rzvy_settings` set `option_value`='".$version."' where `option_name` = 'rzvy_version'");
			}else{
				$result = mysqli_query($conn, "insert into `rzvy_settings` (`id`, `option_name`, `option_value`) VALUES (NULL, 'rzvy_version', '".$version."')");
			}
		}else{
			$result=mysqli_query($conn, "insert into `rzvy_settings` (`id`, `option_name`, `option_value`) VALUES (NULL, 'rzvy_version', '".$version."')");
		}
		return $result;
    }
	
	/* Function for get version option value */
	public function rzvy_get_version_option($conn){
		$query = "select `option_value` from `rzvy_settings` where `option_name` = 'rzvy_version'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0){
			$settings_data = mysqli_fetch_array($result);
			return $settings_data["option_value"];
		}else{
			return "1.0";
		}
    }
	
	/* Function for version update */
	public function rzvy_version_update($conn){
		$current_version = $this->rzvy_get_version_option($conn);
		
		/** Version 1.1 */
		if($current_version<1.1){
			
			/** Update into table queries below **/
			$settings_array = array(
								"rzvy_cs_bfls"=>"default",
								"rzvy_bookingform_bg"=>"default",
								"rzvy_cs_admin_dash"=>"default",
							  );
			$this->update_admin_setting_options($conn, $settings_array);
			
			/* Execute version update query */
			$this->rzvy_update_version_option("1.1",$conn);
		}
		
		/** Version 1.2 */
		if($current_version<1.2){
			
			/** Update into table queries below **/
			$settings_array = array(
								"rzvy_default_language_on_page_load"=>"",
								"rzvy_default_country_code"=>"",
							  );
			$this->insert_admin_setting_options($conn, $settings_array);
			
			/* Execute version update query */
			$this->rzvy_update_version_option("1.2",$conn);
		}
    }
	
	public function insert_admin_setting_options($conn, $settings_array){
		foreach($settings_array as $key => $value){
			/** Insert into table queries below **/
			$result=mysqli_query($conn, "select `option_value` from `rzvy_settings` where `option_name` = '".$key."'");
			if(mysqli_num_rows($result)==0){
				mysqli_query($conn, "insert into `rzvy_settings` (`id`, `option_name`, `option_value`) VALUES (NULL, '".$key."', '".$value."')");
			}
		}
	}
	
	public function update_admin_setting_options($conn, $settings_array){
		foreach($settings_array as $key => $value){
			mysqli_query($conn, "update `rzvy_settings` set `option_value` = '".$value."'  where `option_name` = '".$key."'");
		}
	}
}
?>