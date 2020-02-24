<?php 
class rzvy_slots{
	public $conn;
	public $staff_id;
	public $rzvy_schedule = 'rzvy_schedule';
	public $rzvy_bookings = 'rzvy_bookings';
	public $rzvy_block_off = 'rzvy_block_off';
	public $rzvy_services = 'rzvy_services';
	public $rzvy_staff_daysoff = 'rzvy_staff_daysoff';
	public $rzvy_staff_schedule = 'rzvy_staff_schedule';
	public $rzvy_staff_breaks = 'rzvy_staff_breaks';
	
	/* Function to get already booked slots */
	public function get_already_booked_slots($selected_date,$cur_time_interval,$service_id=0, $service_padding_before, $service_padding_after){
		$return_arr = array();
		/* if($service_id!='0' && is_numeric($service_id)){
			$query="select `order_id`, `booking_datetime`, `booking_end_datetime` from `".$this->rzvy_bookings."` where CAST(`booking_datetime` as date)='".$selected_date."' and (`booking_status`='pending' OR `booking_status`='confirmed' OR `booking_status`='confirmed_by_staff' OR `booking_status`='rescheduled_by_you' OR `booking_status`='rescheduled_by_customer' OR `booking_status`='rescheduled_by_staff') and service_id='".$service_id."' group by `order_id`,`booking_datetime`, `booking_end_datetime`";
		}else{ */
		if($this->staff_id!='0' && is_numeric($this->staff_id)){
			$query="select `order_id`, `booking_datetime`, `booking_end_datetime` from `".$this->rzvy_bookings."` where CAST(`booking_datetime` as date)='".$selected_date."' and (`booking_status`='pending' OR `booking_status`='confirmed' OR `booking_status`='confirmed_by_staff' OR `booking_status`='rescheduled_by_you' OR `booking_status`='rescheduled_by_customer' OR `booking_status`='rescheduled_by_staff') and `staff_id`='".$this->staff_id."' group by `order_id`,`booking_datetime`, `booking_end_datetime`";
		}else{
			$query="select `order_id`, `booking_datetime`, `booking_end_datetime` from `".$this->rzvy_bookings."` where CAST(`booking_datetime` as date)='".$selected_date."' and (`booking_status`='pending' OR `booking_status`='confirmed' OR `booking_status`='confirmed_by_staff' OR `booking_status`='rescheduled_by_you' OR `booking_status`='rescheduled_by_customer' OR `booking_status`='rescheduled_by_staff') group by `order_id`, `booking_datetime`, `booking_end_datetime`";
		}
		/* } */
		$value=mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_array($value)){
			$newarr = array();
			if ($service_padding_before>0) {
				$newarr["start_time"] = strtotime("-$service_padding_before minutes", strtotime($row['booking_datetime']));	
			}else{
				$newarr["start_time"] = strtotime($row['booking_datetime']);
			}
			
			if ($service_padding_after>0) {
				$newarr["end_time"] = strtotime("+$service_padding_after minutes", strtotime($row['booking_end_datetime']));
			}else{
				$newarr["end_time"] = strtotime($row['booking_end_datetime']);
			}
			array_push($return_arr, $newarr);
		}
		return $return_arr;
	}
	
	/* Function to get block off */
	public function get_block_off($selected_date){
		$return_arr = array();
		if($this->staff_id!='0' && is_numeric($this->staff_id)){
			/** staff days off process */
			$query="select * from `".$this->rzvy_staff_daysoff."` where `off_date` = '".$selected_date."' and `staff_id`='".$this->staff_id."'";
			$value=mysqli_query($this->conn,$query);
			if(mysqli_num_rows($value)>0){
				$arr = array();
				$arr["start_time"] = "00:00:00";
				$arr["end_time"] = "23:59:59";
				array_push($return_arr, $arr);
			}

			/** staff breaks process */
			$day_of_the_week = date("N", strtotime($selected_date));
			$query="select * from `".$this->rzvy_staff_breaks."` where `weekday_id` = '".$day_of_the_week."' and `staff_id`='".$this->staff_id."'";
			$value=mysqli_query($this->conn,$query);
			if(mysqli_num_rows($value)>0){
				while($row=mysqli_fetch_array($value)){
					$arr = array();
					$arr["start_time"] = $row['break_start'];
					$arr["end_time"] = $row['break_end'];
					array_push($return_arr, $arr);
				}
			}
		}
		
		$query="select * from `".$this->rzvy_block_off."` where '".$selected_date."' between `from_date` and `to_date` and `status`='Y'";
		$value=mysqli_query($this->conn,$query);
		if(mysqli_num_rows($value)>0){
			while($row=mysqli_fetch_array($value)){
			    if ($row['blockoff_type'] == "fullday") {
					$arr = array();
					$arr["start_time"] = "00:00:00";
					$arr["end_time"] = "23:59:59";
				}else{
					$arr = array();
					$arr["start_time"] = $row['from_time'];
					$arr["end_time"] = $row['to_time'];
				}
				array_push($return_arr, $arr);
			}
		}
		return $return_arr;
	}
	
	/* Function to get day start time and day end time */
	public function get_time_slots($day_id, $week_id ,$service_id){
		$dayid=$day_id;
		$weekid=$week_id;
        $results = array();
		/** staff schedule */
		if($this->staff_id!='0' && is_numeric($this->staff_id)){
			$query="SELECT `starttime`,`endtime`,`no_of_booking` FROM `".$this->rzvy_staff_schedule."` WHERE `weekday_id`='" .$dayid . "' AND `offday`='N' AND `week_id`='".$weekid."' AND  `staff_id`='".$this->staff_id."'";
			$result=mysqli_query($this->conn,$query);
		}
		/*** default schedule */
		else{
			if($service_id!='0' && is_numeric($service_id)){
				$qry="SELECT `starttime`,`endtime`,`no_of_booking` FROM `".$this->rzvy_schedule."` WHERE `weekday_id`='" .$dayid . "' AND `offday`='N' AND `week_id`='".$weekid."' AND  `service_id`='".$service_id."'";
				$res=mysqli_query($this->conn,$qry);
				if(mysqli_num_rows($res)>0){
					$result=$res;
				}else{
					$query="SELECT `starttime`,`endtime`,`no_of_booking` FROM `".$this->rzvy_schedule."` WHERE `weekday_id`='" .$dayid . "' AND `offday`='N' AND `week_id`='".$weekid."' AND `service_id`='default'";
					$result=mysqli_query($this->conn,$query);
				}
			}else{
				$query="SELECT `starttime`,`endtime`,`no_of_booking` FROM `".$this->rzvy_schedule."` WHERE `weekday_id`='" .$dayid . "' AND `offday`='N' AND `week_id`='".$weekid."' AND `service_id`='default'";
				$result=mysqli_query($this->conn,$query);
			}
		}
		
		$value=mysqli_fetch_row($result);
		$results['daystart_time'] = $value[0];
		$results['dayend_time']   = $value[1];
		$results['no_booking']   = $value[2];
        return $results;	
    }
	
	/* Function to get service time interval */
    public function get_service_time_interval($service_id, $time_interval){
		$ser_value=mysqli_query($this->conn, "select * from `".$this->rzvy_services."` where `id`='".$service_id."'");
		if(mysqli_num_rows($ser_value)>0){
			$ser_row=mysqli_fetch_array($ser_value);
			$time_interval=$ser_row['duration'];
		}
		return $time_interval;
    }
	
	/* Function to Slot Bookings */
	public function get_slot_bookings($slot,$service_id){
		if($this->staff_id!='0' && is_numeric($this->staff_id)){
			$staff_qry = " AND `staff_id`='".$this->staff_id."'";
		}else{
			$staff_qry = "";
		}
		if($service_id!='0' && is_numeric($service_id)){
			$query="SELECT `id` FROM `".$this->rzvy_bookings."` WHERE `booking_datetime` <= '" .$slot . "' AND `booking_end_datetime` > '".$slot."' AND `service_id`='".$service_id."'".$staff_qry;
		}else{
			$query="SELECT `id` FROM `".$this->rzvy_bookings."` WHERE `booking_datetime` <= '" .$slot . "' AND `booking_end_datetime` > '".$slot."'".$staff_qry;
		}
		
		$result=mysqli_query($this->conn,$query);
		$count=mysqli_num_rows($result);
		return $count;
    }
	
	/* Function to generate slot dropdown options */
    public function generate_available_slots_dropdown($time_interval, $rzvy_time_format, $start_date, $advance_bookingtime, $currDateTime_withTZ, $isEndTime = false, $service_id = 0){
		if(is_numeric($service_id) && $service_id != "0"){
			$ser_value=mysqli_query($this->conn, "select * from `".$this->rzvy_services."` where `id`='".$service_id."'");
			if(mysqli_num_rows($ser_value)>0){
				$ser_row=mysqli_fetch_array($ser_value);
				$time_interval=$ser_row['duration'];
				$service_padding_before=$ser_row['padding_before'];
				$service_padding_after=$ser_row['padding_after'];
			}else{
				$service_padding_before=0;
				$service_padding_after=0;
			}
		}else{ 
			$service_padding_before=0;
			$service_padding_after=0;
        }
		$day_slots = array();
        $week_id = 1;
    
		/* if calendar starting date is missing then it will take starting date to current date */
        if ($start_date == '') {
            $day_id = date('N', $currDateTime_withTZ);
			/*  add Date as heading of the day column */
            $day_slots['date'] = date('Y-m-d', $currDateTime_withTZ);
        } else {
            $day_id = date('N', strtotime($start_date));
			/* add Date as heading of the day column */
            $day_slots['date'] =date('Y-m-d', strtotime($start_date));
        }
        
        $available_slots = $this->get_time_slots($day_id, $week_id, $service_id);
		$day_slots['no_booking'] = $available_slots['no_booking'];
		
		/* calculating starting and end time of day into mintues */				
		if(isset($available_slots['daystart_time'],$available_slots['dayend_time'])){		
			$min_day_start_time        = (date('G', strtotime($available_slots['daystart_time'])) * 60) + date('i',strtotime($available_slots['daystart_time']));
			$min_day_end_time          = (date('G', strtotime($available_slots['dayend_time'])) * 60) + date('i',strtotime($available_slots['dayend_time']));
			
			$min_allow_advance='Y';
			$advance_minutes='N';
			if($advance_bookingtime>=1440){
				$advance_minutes='Y';
				$currdatestr = strtotime(date('Y-m-d H:i:s', $currDateTime_withTZ));					
				$withadncebooktime = strtotime("+$advance_bookingtime minutes", $currdatestr);
				$withadncebookdate = date('Y-m-d',strtotime("+$advance_bookingtime minutes", $currdatestr));
				$daystarttimeofdate = strtotime(date($withadncebookdate.' '.$available_slots['daystart_time']));
				$with_advance_time = date('H:i:s',$withadncebooktime);
				
				if(strtotime($start_date)>strtotime($withadncebookdate)){
					$with_advance_time = $available_slots['daystart_time'];
				}
				
				if(strtotime($start_date)>=strtotime($withadncebookdate)){
					if($withadncebooktime<$daystarttimeofdate){
						$min_day_start_time = (date('G', strtotime($available_slots['daystart_time'])) * 60) + date('i',strtotime($available_slots['daystart_time']));								
							$min_allow_advance='Y';					
					}else{
					
						$min_day_start_time = (date('G', strtotime($with_advance_time)) * 60) + date('i',strtotime($with_advance_time));						
						if($min_day_start_time%$time_interval!=0){
							$extraminsadd =  $time_interval-($min_day_start_time%$time_interval);
							$min_day_start_time = $min_day_start_time+$extraminsadd;
						}
					
						$min_allow_advance='Y';
					}
				}else{
					$min_allow_advance='N';
				}
			}
			
			$starting_min = $min_day_start_time;
			
			/* Adding Service Before Padding Time For First Slot */
			if ($service_padding_before>0) {
				  $starting_min =  $starting_min+$service_padding_before;
			} 
			
			/* check if selected date is today  if yes calculate current time's min to avoid past booking */
			$today                     = false;
			$conditional_min_mins      = 0;
			
			if (strtotime($day_slots['date']) == strtotime(date('Y-m-d', $currDateTime_withTZ)) && $advance_minutes=='N') {
				$today                = true;
				/* total mins of current time */
			   $conditional_min_mins = date('G',strtotime(date('Y-m-d H:i:s', $currDateTime_withTZ))) * 60 + date('i',strtotime(date('Y-m-d H:i:s', $currDateTime_withTZ))) ;
			} else {
				$today = false;
			}
		   
		   /* add minimum advance booking mins with starting mins for slots */
			 if($advance_bookingtime<1440){
					$conditional_min_mins += $advance_bookingtime;
			}
			
					
			/* check already booked timeslots */
			$day_slots['booked'] = $this->get_already_booked_slots($start_date,$time_interval,$service_id,$service_padding_before,$service_padding_after);
			$day_slots['block_off'] = $this->get_block_off($start_date);
			
			/* Converting time into slots based on given daystart time and dayend time */
			if ($available_slots['daystart_time'] != '' && $available_slots['dayend_time'] != '' && $min_allow_advance=='Y') {
				if($isEndTime){
					while ($starting_min <= $min_day_end_time) {
						if ($today) {
							if ($starting_min > $conditional_min_mins) {						
								$day_slots['slots'][] = date('G:i:s', mktime(0, $starting_min, 0, 1, 1, date('Y')));
							}
						} else {
							$day_slots['slots'][] = date('G:i:s', mktime(0, $starting_min, 0, 1, 1, date('Y')));
						}
						$starting_min = $starting_min + $time_interval;
					}
				}else{
					while ($starting_min < $min_day_end_time) {
						if ($today) {
							if ($starting_min > $conditional_min_mins) {						
								$day_slots['slots'][] = date('G:i:s', mktime(0, $starting_min, 0, 1, 1, date('Y')));
							}
						} else {
							$day_slots['slots'][] = date('G:i:s', mktime(0, $starting_min, 0, 1, 1, date('Y')));
						}
						$starting_min = $starting_min + $time_interval;
					}
				}
			} else {
				$day_slots['slots'] = array();
			}
		}
        return $day_slots;		
		
    }
}
?>