<?php 
class rzvy_staff{
	public $conn;
	public $id;
	public $email;
	public $password;
	public $firstname;
	public $lastname;
	public $phone;
	public $address;
	public $city;
	public $state;
	public $zip;
	public $country;
	public $image;
	public $status;
	public $position;
	public $category_id;
	public $service_id;
	public $weekday_id;
	public $starttime;
	public $endtime;
	public $offday;
	public $break_start;
	public $break_end;
	public $off_date;
	public $no_of_booking;
	public $rzvy_staff = 'rzvy_staff';
	public $rzvy_bookings = 'rzvy_bookings';
	public $rzvy_categories = 'rzvy_categories';
	public $rzvy_services = 'rzvy_services';
	public $rzvy_addons = 'rzvy_addons';
	public $rzvy_staff_services = 'rzvy_staff_services';
	public $rzvy_staff_schedule = 'rzvy_staff_schedule';
	public $rzvy_staff_breaks = 'rzvy_staff_breaks';
	public $rzvy_staff_daysoff = 'rzvy_staff_daysoff';
	
	/* Function to read all staff */
	public function getall_staff(){
		$query = "select `id`, `firstname`, `lastname`, `image`  from `".$this->rzvy_staff."` order by `position` ASC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
		
	/* Function to read particular staff's data */
	public function readone_staff(){
		$query = "select * from `".$this->rzvy_staff."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value;
	}
	
	/* Function to update staff status */
	public function update_status(){
		$query = "update `".$this->rzvy_staff."` set `status`='".$this->status."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to update staff with image */
	public function update_staff_with_image(){
		$query = "update `".$this->rzvy_staff."` set `firstname`='".$this->firstname."', `lastname`='".$this->lastname."', `phone`='".$this->phone."', `address`='".$this->address."', `city`='".$this->city."', `state`='".$this->state."', `country`='".$this->country."', `zip`='".$this->zip."', `image`='".$this->image."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to update staff without image */
	public function update_staff_without_image(){
		$query = "update `".$this->rzvy_staff."` set `firstname`='".$this->firstname."', `lastname`='".$this->lastname."', `phone`='".$this->phone."', `address`='".$this->address."', `city`='".$this->city."', `state`='".$this->state."', `country`='".$this->country."', `zip`='".$this->zip."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to read particular staff's image name */
	public function get_image_name_of_staff(){
		$query = "select `image` from `".$this->rzvy_staff."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value['image'];
	}
	
	/* Function to read particular staff's image name */
	public function check_appointments_before_delete_staff(){
		$query = "select `id` from `".$this->rzvy_bookings."` where `staff_id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to read particular staff's image name */
	public function delete_staff(){
		mysqli_query($this->conn, "delete from `".$this->rzvy_staff_schedule."` where `staff_id`='".$this->id."'");
		mysqli_query($this->conn, "delete from `".$this->rzvy_staff_breaks."` where `staff_id`='".$this->id."'");
		mysqli_query($this->conn, "delete from `".$this->rzvy_staff_daysoff."` where `staff_id`='".$this->id."'");
		mysqli_query($this->conn, "delete from `".$this->rzvy_staff_services."` where `staff_id`='".$this->id."'");
		$query = "delete from `".$this->rzvy_staff."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}

	/* Function to add staff */
	public function add_staff(){
		$query = "INSERT INTO `".$this->rzvy_staff."`(`id`, `email`, `password`, `firstname`, `lastname`, `phone`, `address`, `city`, `state`, `zip`, `country`, `image`, `status`, `position`) VALUES (NULL, '".$this->email."', '".$this->password."', '".$this->firstname."', '".$this->lastname."', '".$this->phone."', '".$this->address."', '".$this->city."', '".$this->state."', '".$this->zip."', '".$this->country."', '".$this->image."', '".$this->status."', '".$this->position."')";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		$this->id = $value;
		$res = $this->add_default_staff_schedule();
		return $res;
	}
	
	/* Function to get all categories */
	public function get_all_categories(){
		$query = "select `c`.`id`, `c`.`cat_name` 
		from `".$this->rzvy_categories."` as `c`, 
		`".$this->rzvy_services."` as `s`
		where 
		`c`.`status` = 'Y'
		and `s`.`status` = 'Y' 
		and `s`.`cat_id` = `c`.`id` 
		group by `c`.`id`, `c`.`cat_name` ORDER BY `c`.`id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
		
	/* Function to get services by category id */
	public function get_services_by_cat_id(){
		$query = "select * from `".$this->rzvy_services."` where `cat_id`='".$this->category_id."' and `status` = 'Y' ORDER BY `id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}

	/* Function to truncate staff services */
	public function truncate_staff_services(){
		$result=mysqli_query($this->conn, "delete from `".$this->rzvy_staff_services."` where `staff_id`='".$this->id."'");
		return $result;
	}

	/* Function to add staff services */
	public function save_staff_services(){
		$query = "INSERT INTO `".$this->rzvy_staff_services."`(`id`, `staff_id`, `service_id`) VALUES (NULL, '".$this->id."', '".$this->service_id."')";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}

	/* Function to get staff services  */
	public function get_staff_service(){
		$query = "select * from `".$this->rzvy_staff_services."` where `staff_id`='".$this->id."' and `service_id`='".$this->service_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}

	/* Function to get staff schedule */
	public function get_schedule(){
		$query = "select * from `".$this->rzvy_staff_schedule."` where `staff_id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to generate slot dropdown options */
	public function generate_slot_dropdown_options($time_interval, $rzvy_time_format, $start_time, $end_time){
		$options = array();
		$slot_starttime = "";
		$slot_endtime = "";
		$break_starttime = "";
		$break_endtime = "";
		$min = 0;
		$t = 1;
		$i = 1;
		while ($min < 1440) {
			if ($min == 1440) {
				$timeValue = date('G:i', mktime(0, $min - 1, 0, 1, 1, 2015));
			} else {
				$timeValue = date('G:i', mktime(0, $min, 0, 1, 1, 2015));
			}
			$timetoprint = date('G:i', mktime(0, $min, 0, 1, 1, 2014));

			$startselected = '';
			if ($start_time == date("H:i:s", strtotime($timeValue))) {
				$t= 10;
				$startselected = "selected";
			}
			$endselected = '';
			if ($end_time == date("H:i:s", strtotime($timeValue))) {
				$t= 10;
				$endselected = "selected";
			}
			if($t==1) {
				if ("09:00:00" == date("H:i:s", strtotime($timeValue))) {
					$startselected = "selected";
				}
			}
			$slot = date($rzvy_time_format, strtotime($timetoprint));
			$slotvalue = date("H:i:s", strtotime($timeValue));
			
			$slot_starttime .= '<option '.$startselected.' data-position="'.$i.'" value="'.$slotvalue.'">'.$slot.'</option>';
			$slot_endtime .= '<option '.$endselected.' data-position="'.$i.'" value="'.$slotvalue.'">'.$slot.'</option>';
			
			if ($start_time <= date("H:i:s", strtotime($timeValue))) {
				$break_starttime .= '<option data-position="'.$i.'" value="'.$slotvalue.'">'.$slot.'</option>';
			}
			if ($end_time >= date("H:i:s", strtotime($timeValue)) && $start_time < date("H:i:s", strtotime($timeValue))) {
				$break_endtime .= '<option data-position="'.$i.'" value="'.$slotvalue.'">'.$slot.'</option>';
			}
			
			$min = $min + $time_interval;
			$i++;
		}
		$options["slot_starttime"] = $slot_starttime;
		$options["slot_endtime"] = $slot_endtime;
		$options["break_starttime"] = $break_starttime;
		$options["break_endtime"] = $break_endtime;
		return $options;
	}

	
	
	/* Function to generate slot dropdown options */
	public function generate_break_dropdown_options($time_interval, $rzvy_time_format, $start_time, $end_time){
		$options = array();
		$break_starttime = "";
		$break_endtime = "";
		$min = 0;
		$t = 1;
		$i = 1;
		while ($min < 1440) {
			if ($min == 1440) {
				$timeValue = date('G:i', mktime(0, $min - 1, 0, 1, 1, 2015));
			} else {
				$timeValue = date('G:i', mktime(0, $min, 0, 1, 1, 2015));
			}
			$timetoprint = date('G:i', mktime(0, $min, 0, 1, 1, 2014));

			$slot = date($rzvy_time_format, strtotime($timetoprint));
			$slotvalue = date("H:i:s", strtotime($timeValue));
					
			if ($start_time <= date("H:i:s", strtotime($timeValue))) {
				$break_starttime .= '<option data-position="'.$i.'" value="'.$slotvalue.'">'.$slot.'</option>';
			}
			if ($end_time >= date("H:i:s", strtotime($timeValue)) && $start_time < date("H:i:s", strtotime($timeValue))) {
				$break_endtime .= '<option data-position="'.$i.'" value="'.$slotvalue.'">'.$slot.'</option>';
			}
			
			$min = $min + $time_interval;
			$i++;
		}
		$options["break_starttime"] = $break_starttime;
		$options["break_endtime"] = $break_endtime;
		return $options;
	}

	/** Function to add staff schedule **/
	public function add_service_schedule(){
		$query = "select * from `".$this->rzvy_staff_schedule."` where `weekday_id`='".$this->weekday_id."' and `staff_id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		if(mysqli_num_rows($result)>0){
			$query = "update `".$this->rzvy_staff_schedule."` set `starttime` = '".$this->starttime."', `endtime` = '".$this->endtime."', `offday` = '".$this->offday."', `no_of_booking` = '".$this->no_of_booking."' where `weekday_id`='".$this->weekday_id."' and `staff_id`='".$this->id."';";
		}else{
			$query = "INSERT INTO `".$this->rzvy_staff_schedule."` (`id`, `week_id`, `weekday_id`, `starttime`, `endtime`, `offday`, `staff_id`, `no_of_booking`) VALUES (NULL, 1, ".$this->weekday_id.", '".$this->starttime."', '".$this->endtime."', '".$this->offday."', '".$this->id."', '1');";
		}
		
		$result=mysqli_query($this->conn,$query);
		return $result;
	}

	/** Function to add staff breaks **/
	public function add_staff_breaks(){
		/*$res = mysqli_query($this->conn, "select * from `".$this->rzvy_staff_breaks."` where `staff_id`='".$this->id."' and `weekday_id`='".$this->weekday_id."'");
		if(mysqli_num_rows($res)>0){
			$query = "UPDATE `".$this->rzvy_staff_breaks."` set `break_start`='".$this->break_start."', `break_end`='".$this->break_end."' where `staff_id`='".$this->id."' and `weekday_id`='".$this->weekday_id."'";
		}else{*/
			$query = "INSERT INTO `".$this->rzvy_staff_breaks."` (`id`, `staff_id`, `week_id`, `weekday_id`, `break_start`, `break_end`) VALUES (NULL, '".$this->id."', 1, ".$this->weekday_id.", '".$this->break_start."', '".$this->break_end."')";
		/*}*/
		$result=mysqli_query($this->conn,$query);
		return $result;
	}

	/** Function to get staff breaks **/
	public function get_staff_breaks(){
		$result = mysqli_query($this->conn, "select * from `".$this->rzvy_staff_breaks."` where `staff_id`='".$this->id."' and `weekday_id`='".$this->weekday_id."'");
		return $result;
	}

	/** Function to delete staff breaks ** */
	public function delete_staff_break(){
		$result = mysqli_query($this->conn, "delete from `".$this->rzvy_staff_breaks."` where `id`='".$this->id."'");
		return $result;
	}

	/** Function to get staff off day **/
	public function readall_staff_daysoff(){
		$result = mysqli_query($this->conn, "select * from `".$this->rzvy_staff_daysoff."` where `staff_id`='".$this->id."' order by `id` DESC");
		return $result;
	}

	/** Function to add staff off day **/
	public function add_staff_daysoff(){
		$res = mysqli_query($this->conn, "select * from `".$this->rzvy_staff_daysoff."` where `staff_id`='".$this->id."' and `off_date`='".$this->off_date."'");
		if(mysqli_num_rows($res)==0){
			$result = mysqli_query($this->conn, "INSERT INTO `".$this->rzvy_staff_daysoff."`(`id`, `staff_id`, `off_date`) VALUES (NULL, '".$this->id."','".$this->off_date."')");
			return $result;
		}else{
			return true;
		}
	}

	/** Function to delete staff breaks ** */
	public function delete_staffdaysoff(){
		$result = mysqli_query($this->conn, "delete from `".$this->rzvy_staff_daysoff."` where `id`='".$this->id."'");
		return $result;
	}

	/** Function to add default schedule while add staff **/
	public function add_default_staff_schedule(){
		$query = "INSERT INTO `".$this->rzvy_staff_schedule."` (`id`, `week_id`, `weekday_id`, `starttime`, `endtime`, `offday`, `staff_id`, `no_of_booking`) VALUES
		(NULL, 1, 1, '09:00:00', '18:00:00', 'N', '".$this->id."', '1'),
		(NULL, 1, 2, '09:00:00', '18:00:00', 'N', '".$this->id."', '1'),
		(NULL, 1, 3, '09:00:00', '18:00:00', 'N', '".$this->id."', '1'),
		(NULL, 1, 4, '09:00:00', '18:00:00', 'N', '".$this->id."', '1'),
		(NULL, 1, 5, '09:00:00', '18:00:00', 'N', '".$this->id."', '1'),
		(NULL, 1, 6, '09:00:00', '18:00:00', 'Y', '".$this->id."', '1'),
		(NULL, 1, 7, '09:00:00', '18:00:00', 'Y', '".$this->id."', '1')";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to change password */
	public function change_password(){
		$query = "update `".$this->rzvy_staff."` set `password`='".$this->password."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to check old password */
	public function check_old_password(){
		$query = "select `id` from `".$this->rzvy_staff."` where `id`='".$this->id."' and `password`='".$this->password."'";
		$result=mysqli_query($this->conn,$query);
		$count=mysqli_num_rows($result);
		return $count>0;
	}
	
	/* Function to read particular staff's email */
	public function get_staff_email(){
		$query = "select `email` from `".$this->rzvy_staff."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value['email'];
	}
	
	/* Function to update staff email */
	public function update_email(){
		$query = "update `".$this->rzvy_staff."` set `email`='".$this->email."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
		
	/* Function to read particular staff's email */
	public function check_email_availability($staff_email){
		/* Check email address correct or not in customers table */
		$query = "select `id` from `".$this->rzvy_customers."` where `email`='".$this->email."'";
		$result=mysqli_query($this->conn,$query);
		
		/* To check user exist or not */
		if(mysqli_num_rows($result)>0){
			return false;
        }else{
			/* Check email address correct or not in staff table */
            $query = "select `id` from `".$this->rzvy_staff."` where `email`='".$this->email."' and `email`<>'".$staff_email."'";
            $result=mysqli_query($this->conn,$query);
			
			/* To check staff exist or not */
			if(mysqli_num_rows($result)>0){
				return false;
            }else{
				/* Check email address correct or not in admins table */
				$query = "select `id` from `".$this->rzvy_admins."` where `email`='".$this->email."'";
				$result=mysqli_query($this->conn,$query);
				
				/* To check admin exist or not */
				if(mysqli_num_rows($result)>0){
					return false;
				}else{
					return true;
				}
			}
        }
	} 
} 
?>