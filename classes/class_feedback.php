<?php 
class rzvy_feedback{
	public $conn;
	public $id;
	public $name;
	public $email;
	public $rating;
	public $review;
	public $review_datetime;
	public $status;
	public $rzvy_feedback = 'rzvy_feedback';
		
	/* Function to get all feedbacks within limit */
	public function get_all_feedbacks(){
		$query = "select * from `".$this->rzvy_feedback."`";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to change feedback status */
	public function change_feedback_status(){
		$query = "update `".$this->rzvy_feedback."` set `status`='".$this->status."' where `id`='".$this->id."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
}
?>