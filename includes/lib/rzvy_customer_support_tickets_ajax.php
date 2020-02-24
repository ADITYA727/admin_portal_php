<?php 
session_start();

/* Include class files */
include(dirname(dirname(dirname(__FILE__)))."/constants.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_support_tickets.php");
include(dirname(dirname(dirname(__FILE__)))."/classes/class_support_ticket_discussions.php");

/* Create object of classes */

$obj_support_tickets = new rzvy_support_tickets();
$obj_support_tickets->conn = $conn;

$obj_support_ticket_discussions = new rzvy_support_ticket_discussions();
$obj_support_ticket_discussions->conn = $conn;

include(dirname(dirname(dirname(__FILE__)))."/classes/class_settings.php");
$obj_settings = new rzvy_settings();
$obj_settings->conn = $conn;

/** Generate support ticket ajax **/
if(isset($_POST['generate_support_ticket'])){
	$obj_support_tickets->generated_by_id = $_SESSION['customer_id'];
	$obj_support_tickets->ticket_title = htmlentities($_POST['ticket_title']);
	$obj_support_tickets->description = htmlentities($_POST['description']);
	$obj_support_tickets->generated_on = date("Y-m-d H:i:s");
	$obj_support_tickets->generated_by = $_SESSION['login_type'];
	$obj_support_tickets->status = "active";
	$obj_support_tickets->read_status = "U";
	$added = $obj_support_tickets->add_support_ticket();
	if($added){
		echo "added";
	}else{
		echo "failed";
	}
}

/** Update support ticket ajax **/
else if(isset($_POST['update_support_ticket'])){
	$obj_support_tickets->id = $_POST['id'];
	$obj_support_tickets->ticket_title = htmlentities($_POST['ticket_title']);
	$obj_support_tickets->description = htmlentities($_POST['description']);
	$obj_support_tickets->read_status = "U";
	$updated = $obj_support_tickets->update_support_ticket();
	if($updated){
		echo "updated";
	}else{
		echo "failed";
	}
}

/** Mark support ticket as completed ajax **/
else if(isset($_POST['markascomplete_support_ticket'])){
	$obj_support_tickets->id = $_POST['id'];
	$obj_support_tickets->status = "completed";
	$obj_support_tickets->read_status = "U";
	$updated = $obj_support_tickets->markascomplete_support_ticket();
	if($updated){
		echo "updated";
	}else{
		echo "failed";
	}
}

/** Mark support ticket replies as read ajax **/
else if(isset($_POST['markasread_all_support_ticket_reply'])){
	$obj_support_ticket_discussions->replied_by = $_SESSION['login_type'];
	$obj_support_ticket_discussions->ticket_id = $_POST['id'];
	$obj_support_ticket_discussions->markasread_all_support_ticket_reply(); 
}

/** Delete support ticket ajax **/
else if(isset($_POST['delete_support_ticket'])){
	$obj_support_ticket_discussions->ticket_id = $_POST['id'];
	$count_reply = $obj_support_ticket_discussions->count_all_ticket_discussion_reply();
	if($count_reply>0){
		echo "replyexist";
	}else{
		$obj_support_tickets->id = $_POST['id'];
		$deleted = $obj_support_tickets->delete_support_ticket();
		if($deleted){
			echo "deleted";
		}else{
			echo "failed";
		}
	}
}

/** Update support ticket modal detail ajax **/
else if(isset($_POST['update_supportticket_modal_detail'])){
	$obj_support_tickets->id = $_POST['id'];
	$support_ticket_detail = $obj_support_tickets->readone_support_ticket(); 
	?>
	<form name="rzvy_update_support_ticket_form" id="rzvy_update_support_ticket_form" method="post">
	  <div class="form-group">
		<label for="rzvy_update_tickettitle"><?php if(isset($rzvy_translangArr['ticket_title'])){ echo $rzvy_translangArr['ticket_title']; }else{ echo $rzvy_defaultlang['ticket_title']; } ?></label>
		<input class="form-control" id="rzvy_update_tickettitle" name="rzvy_update_tickettitle" type="text" value="<?php echo $support_ticket_detail['ticket_title']; ?>" />
	  </div>
	  <div class="form-group">
		<label for="rzvy_update_ticketdescription"><?php if(isset($rzvy_translangArr['ticket_description'])){ echo $rzvy_translangArr['ticket_description']; }else{ echo $rzvy_defaultlang['ticket_description']; } ?></label>
		<textarea class="form-control" id="rzvy_update_ticketdescription" name="rzvy_update_ticketdescription" rows="7"><?php echo $support_ticket_detail['description']; ?></textarea>
	  </div>
	</form>
	<?php 
}