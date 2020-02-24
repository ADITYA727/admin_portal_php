<?php 
class rzvy_services{
	public $conn;
	public $id;
	public $cat_id;
	public $title;
	public $image;
	public $description;
	public $status;
	public $duration;
	public $padding_before;
	public $padding_after;
	public $rate;
	public $rzvy_services = 'rzvy_services';
	public $rzvy_categories = 'rzvy_categories';
	public $rzvy_bookings = 'rzvy_bookings';
	public $rzvy_staff = 'rzvy_staff';
	public $rzvy_staff_services = 'rzvy_staff_services';
	
	/* Function to add service */
	public function add_service(){
		$query = "INSERT INTO `".$this->rzvy_services."` (`id`, `cat_id`, `title`, `image`, `description`, `status`, `duration`, `padding_before`, `padding_after`, `rate`) VALUES (NULL, '".$this->cat_id."', '".$this->title."', '".$this->image."', '".$this->description."', '".$this->status."', '".$this->duration."', '".$this->padding_before."', '".$this->padding_after."', '".$this->rate."')";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to update service */
	public function update_service(){
		$query = "update `".$this->rzvy_services."` set `duration` = '".$this->duration."', `padding_before` = '".$this->padding_before."', `padding_after` = '".$this->padding_after."', `title` = '".$this->title."', `image` = '".$this->image."', `description` = '".$this->description."', `rate` = '".$this->rate."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to change service status */
	public function change_service_status(){
		$query = "update `".$this->rzvy_services."` set `status` = '".$this->status."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to get all services title */
	public function get_all_services(){
		$query = "select * from `".$this->rzvy_services."` where `cat_id`='".$this->cat_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to get all services title */
	public function get_all_services_title(){
		$query = "select `id`, `title` from `".$this->rzvy_services."`";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to get all services title */
	public function get_cat_title($id){
		$query = "select `cat_name` from `".$this->rzvy_categories."` where `id`='".$id."'";
		$result=mysqli_query($this->conn,$query);
		$val=mysqli_fetch_array($result);
		return ucwords($val['cat_name']);
	}
	
	/* Function to read one category */
	public function readone_service(){
		$query = "select * from `".$this->rzvy_services."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_assoc($result);
		return $value;
	}
	
	/* Function to get all services according category id */
	public function get_all_services_according_cat_id(){
		$query = "select `id`, `title` from `".$this->rzvy_services."` where `cat_id`='".$this->cat_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to count all services according category id */
	public function count_all_services_by_cat_id(){
		$query = "select count(`id`) from `".$this->rzvy_services."` where `cat_id`='".$this->cat_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value[0];
	}
	
	/* Function to delete services */
	public function delete_service(){
		mysqli_query($this->conn, "delete from `".$this->rzvy_staff_services."` where `service_id`='".$this->id."'");
		$query = "delete from `".$this->rzvy_services."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to check appointments before delete services */
	public function check_appointments_before_delete_service(){
		$query = "select `id` from `".$this->rzvy_bookings."` where `service_id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		$count=mysqli_num_rows($result);
		return $count;
	}
	
	/* Function to get all active staff */
	public function get_all_active_staff(){
		$query = "select * from `".$this->rzvy_staff."` where `status`='Y' group by `id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to get all linked staff */
	public function get_linked_staff($staff_id, $service_id){
		$query = "select * from `".$this->rzvy_staff_services."` where `staff_id` = '".$staff_id."' and `service_id` = '".$service_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}

	/** function to unlink all staff for selected service */
	public function unlink_all_staff_for_selected_service(){
		$query = "delete from `".$this->rzvy_staff_services."` where `service_id` = '".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}

	/** function to link staff to selected service */
	public function link_staff_to_selected_service($staff_id){
		$query = "INSERT INTO `".$this->rzvy_staff_services."`(`id`, `staff_id`, `service_id`) VALUES (NULL, '".$staff_id."', '".$this->id."')";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
}
?>