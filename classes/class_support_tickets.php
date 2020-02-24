<?php 
class rzvy_support_tickets{
	public $conn;
	public $id;
	public $generated_by_id;
	public $ticket_title;
	public $description;
	public $generated_on;
	public $generated_by;
	public $status;
	public $read_status;
	public $customer_id;
	public $rzvy_support_tickets = 'rzvy_support_tickets';
	public $rzvy_customers = 'rzvy_customers';
	public $rzvy_bookings = 'rzvy_bookings';
		
	/* Function to get all support tickets */
	public function get_all_support_tickets(){
		$query = "select * from `".$this->rzvy_support_tickets."` order by `id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to get all support tickets of customer */
	public function get_all_support_tickets_of_customer(){
		$query = "select * from `".$this->rzvy_support_tickets."` where `generated_by` = 'customer' and `generated_by_id` = '".$this->generated_by_id."' order by `id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to read one support ticket */
	public function readone_support_ticket(){
		$query = "select * from `".$this->rzvy_support_tickets."` where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_assoc($result);
		return $value;
	}
	
	/* Function to add support ticket */
	public function add_support_ticket(){
		$query = "INSERT INTO `".$this->rzvy_support_tickets."`(`id`, `generated_by_id`, `ticket_title`, `description`, `generated_on`, `generated_by`, `status`, `read_status`) VALUES (NULL, '".$this->generated_by_id."', '".$this->ticket_title."', '".$this->description."', '".$this->generated_on."', '".$this->generated_by."', '".$this->status."', '".$this->read_status."')";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to update support ticket */
	public function update_support_ticket(){
		$query = "UPDATE `".$this->rzvy_support_tickets."` SET `ticket_title` = '".$this->ticket_title."', `description` = '".$this->description."', `read_status` = '".$this->read_status."' WHERE `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to update support ticket */
	public function markascomplete_support_ticket(){
		$query = "UPDATE `".$this->rzvy_support_tickets."` SET `status` = '".$this->status."', `read_status` = '".$this->read_status."' WHERE `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to delete support ticket */
	public function delete_support_ticket(){
		$query = "delete from `".$this->rzvy_support_tickets."` WHERE `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
}
?>