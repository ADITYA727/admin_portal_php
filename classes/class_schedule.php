<?php 
class rzvy_schedule{
	public $conn;
	public $id;
	public $week_id;
	public $weekday_id;
	public $starttime;
	public $endtime;
	public $offday;
	public $service_id;
	public $no_of_booking;
	public $rzvy_schedule = 'rzvy_schedule';
	
	/* Function to get schedule */
	public function get_schedule(){
		$query = "select * from `".$this->rzvy_schedule."` where `service_id`='default'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to get service schedule */
	public function get_service_schedule(){
		$query = "select * from `".$this->rzvy_schedule."` where `service_id`='".$this->service_id."'";
		$result=mysqli_query($this->conn,$query);
		if(mysqli_num_rows($result)>0){
			return $result;
		}else{
			$result=$this->get_schedule();
			return $result;
		}
	}
	
	/* Function to change offday status */
	public function change_offday_status(){
		$query = "update `".$this->rzvy_schedule."` set `offday`='".$this->offday."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to change schedule start time */
	public function update_schedule_starttime(){
		$query = "update `".$this->rzvy_schedule."` set `starttime`='".$this->starttime."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to change schedule end time */
	public function update_schedule_endtime(){
		$query = "update `".$this->rzvy_schedule."` set `endtime`='".$this->endtime."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to generate slot dropdown options */
	public function generate_slot_dropdown_options($time_interval, $rzvy_time_format, $schedule_time){
		$options = '';
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

			$selected = '';
			if ($schedule_time == date("H:i:s", strtotime($timeValue))) {
				$t= 10;
				$selected = "selected";
			}
			if($t==1) {
				if ("10:00:00" == date("H:i:s", strtotime($timeValue))) {
					$selected = "selected";
				}
			}
			$slot = date($rzvy_time_format, strtotime($timetoprint));
			$slotvalue = date("H:i:s", strtotime($timeValue));
			$options .= '<option '.$selected.' data-position="'.$i.'" value="'.$slotvalue.'">'.$slot.'</option>';
			$min = $min + $time_interval;
			$i++;
		}
		return $options;
	}
	
	/** Function to add default schedule while registering as administrator **/
	public function add_default_schedule(){
		$query = "INSERT INTO `".$this->rzvy_schedule."` (`id`, `week_id`, `weekday_id`, `starttime`, `endtime`, `offday`, `service_id`, `no_of_booking`) VALUES
		(NULL, 1, 1, '10:00:00', '20:00:00', 'N', 'default', '0'),
		(NULL, 1, 2, '10:00:00', '20:00:00', 'N', 'default', '0'),
		(NULL, 1, 3, '10:00:00', '20:00:00', 'N', 'default', '0'),
		(NULL, 1, 4, '10:00:00', '20:00:00', 'N', 'default', '0'),
		(NULL, 1, 5, '10:00:00', '20:00:00', 'N', 'default', '0'),
		(NULL, 1, 6, '10:00:00', '20:00:00', 'Y', 'default', '0'),
		(NULL, 1, 7, '10:00:00', '20:00:00', 'Y', 'default', '0')";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	/** Function to add default schedule while registering as administrator **/
	public function add_service_schedule(){
		$query = "INSERT INTO `".$this->rzvy_schedule."` (`id`, `week_id`, `weekday_id`, `starttime`, `endtime`, `offday`, `service_id`, `no_of_booking`) VALUES (NULL, 1, ".$this->weekday_id.", '".$this->starttime."', '".$this->endtime."', '".$this->offday."', '".$this->service_id."', '".$this->no_of_booking."')";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/** Function to add default schedule while registering as administrator **/
	public function truncate_service_schedule(){
		$qry = "select * from `".$this->rzvy_schedule."` where `service_id`='".$this->service_id."'";
		$res=mysqli_query($this->conn,$qry);
		if(mysqli_num_rows($res)>0){
			$query = "DELETE FROM `".$this->rzvy_schedule."` where `service_id` = '".$this->service_id."'";
			$result=mysqli_query($this->conn,$query);
			return $result;
		}else{
			return true;
		}
		
	}
}
?>