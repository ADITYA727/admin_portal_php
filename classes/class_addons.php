<?php 
class rzvy_addons{
	public $conn;
	public $id;
	public $service_id;
	public $title;
	public $rate;
	public $image;
	public $multiple_qty;
	public $status;
	public $description;
	public $rzvy_addons = 'rzvy_addons';
	public $rzvy_categories = 'rzvy_categories';
	public $rzvy_services = 'rzvy_services';
	public $rzvy_bookings = 'rzvy_bookings';
	
	/* Function to get addon name */
	public function get_addon_name(){
		$query = "select `title` from `".$this->rzvy_addons."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value['title'];
	}
	
	/* Function to get addon detail */
	public function readone_addon(){
		$query = "select * from `".$this->rzvy_addons."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_assoc($result);
		return $value;
	}
	
	/* Function to get all addons for export */
	public function export_all_addons(){
		$query = "SELECT `a`.`id`, `c`.`cat_name`, `s`.`title` as `service_title`, `a`.`title`, `a`.`rate`, `a`.`multiple_qty`, `a`.`description`, `a`.`status` FROM `".$this->rzvy_addons."` as `a`, `".$this->rzvy_categories."` as `c`, `".$this->rzvy_services."` as `s` WHERE `a`.`service_id` = `s`.`id` AND `s`.`cat_id` = `c`.`id` AND `a`.`id`='".$this->id."' GROUP BY `a`.`id`, `c`.`cat_name`, `s`.`title`, `a`.`title`, `a`.`rate`, `a`.`multiple_qty`, `a`.`status`";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_assoc($result);
		return $value;
	}
	
	/* Function to get all addons title */
	public function get_all_addons_title(){
		$query = "SELECT `id`, `title` FROM `".$this->rzvy_addons."`";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to get all addons according service id selection */
	public function get_all_addons(){
		$query = "SELECT * FROM `".$this->rzvy_addons."` WHERE `service_id`='".$this->service_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to get all addons according service id selection */
	public function get_all_addons_according_service_id(){
		$query = "SELECT `id`, `title` FROM `".$this->rzvy_addons."` WHERE `service_id`='".$this->service_id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to count all addons according service id */
	public function count_all_addons_by_service_id(){
		$query = "select count(`id`) from `".$this->rzvy_addons."` where `service_id`='".$this->service_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value[0];
	}
	
	/* Function to change addons status */
	public function change_addon_status(){
		$query = "update `".$this->rzvy_addons."` set `status` = '".$this->status."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to change addons multiple qty status */
	public function change_addon_multiple_qty_status(){
		$query = "update `".$this->rzvy_addons."` set `multiple_qty` = '".$this->multiple_qty."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to update addons */
	public function update_addon(){
		$query = "UPDATE `".$this->rzvy_addons."` SET `title` = '".$this->title."', `rate` = '".$this->rate."', `description` = '".$this->description."', `image` = '".$this->image."' WHERE `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to add addons */
	public function add_addon(){
		$query = "INSERT INTO `".$this->rzvy_addons."`(`id`, `service_id`, `title`, `rate`, `image`, `multiple_qty`, `status`, `description`) VALUES (NULL, '".$this->service_id."', '".$this->title."', '".$this->rate."', '".$this->image."', '".$this->multiple_qty."', '".$this->status."', '".$this->description."')";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to delete addons */
	public function delete_addon(){
		$query = "delete from `".$this->rzvy_addons."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to check appointments before delete addons */
	public function check_appointments_before_delete_addon(){
		$query = "select `addons` from `".$this->rzvy_bookings."` where `service_id`='".$this->service_id."'";
		$result=mysqli_query($this->conn,$query);
		if(mysqli_num_rows($result)>0){
			while($value=mysqli_fetch_assoc($result)){
				$unserialized_addons = unserialize($value['addons']);
				foreach($unserialized_addons as $addon){
					if($this->id == $addon['id']){
						return "appointmentexist";
					}
				}
			}
		}else{
			return "noappointmentexist";
		}
	}
	
	/* Function to get all services title */
	public function get_ser_title($id){
		$query = "select `title` from `".$this->rzvy_services."` where `id`='".$id."'";
		$result=mysqli_query($this->conn,$query);
		$val=mysqli_fetch_array($result);
		return ucwords($val['title']);
	}
}
?>