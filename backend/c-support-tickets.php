<?php 
include 'c_header.php'; 
include(dirname(dirname(__FILE__))."/classes/class_support_tickets.php");
include(dirname(dirname(__FILE__))."/classes/class_support_ticket_discussions.php");

$obj_support_tickets = new rzvy_support_tickets();
$obj_support_tickets->conn = $conn;

$obj_support_ticket_discussions = new rzvy_support_ticket_discussions();
$obj_support_ticket_discussions->conn = $conn;

$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');

$rzvy_datetime_format = $rzvy_date_format." ".$rzvy_time_format; 
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/my-appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['support_tickets'])){ echo $rzvy_translangArr['support_tickets']; }else{ echo $rzvy_defaultlang['support_tickets']; } ?></li>
      </ol>
      <!-- DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-fw fa-comments"></i> <?php if(isset($rzvy_translangArr['support_ticket_list'])){ echo $rzvy_translangArr['support_ticket_list']; }else{ echo $rzvy_defaultlang['support_ticket_list']; } ?>
		  <a class="btn btn-success btn-sm rzvy-white pull-right" data-toggle="modal" data-target="#rzvy-generate-ticket-modal"><i class="fa fa-plus"></i> <?php if(isset($rzvy_translangArr['generate_ticket'])){ echo $rzvy_translangArr['generate_ticket']; }else{ echo $rzvy_defaultlang['generate_ticket']; } ?></a>
		</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="rzvy_support_ticket_list_table" width="100%" cellspacing="0">
              <thead>
				<tr>
				  <th><?php if(isset($rzvy_translangArr['hash_rzy_translation'])){ echo $rzvy_translangArr['hash_rzy_translation']; }else{ echo $rzvy_defaultlang['hash_rzy_translation']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['ticket_title'])){ echo $rzvy_translangArr['ticket_title']; }else{ echo $rzvy_defaultlang['ticket_title']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['generated_on'])){ echo $rzvy_translangArr['generated_on']; }else{ echo $rzvy_defaultlang['generated_on']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['generated_for'])){ echo $rzvy_translangArr['generated_for']; }else{ echo $rzvy_defaultlang['generated_for']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['status'])){ echo $rzvy_translangArr['status']; }else{ echo $rzvy_defaultlang['status']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['action'])){ echo $rzvy_translangArr['action']; }else{ echo $rzvy_defaultlang['action']; } ?></th>
				</tr>
			  </thead>
			  <tbody>
				<?php 
				$obj_support_tickets->generated_by_id = $_SESSION['customer_id'];
				$all_support_tickets = $obj_support_tickets->get_all_support_tickets_of_customer();
				$i = 1;
				while($support_ticket = mysqli_fetch_array($all_support_tickets)){ 
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?php if(strlen($support_ticket['ticket_title']) < 30){ echo ucfirst($support_ticket['ticket_title']); }else{ echo substr(ucfirst($support_ticket['ticket_title']), 0, 30)."..."; } ?></td>
						<td><?php echo date($rzvy_datetime_format, strtotime($support_ticket['generated_on'])); ?></td>
						<td>
							<?php 
							echo ucwords($obj_settings->get_option("rzvy_company_name")); 
							?>
						</td>
						<td><?php if($support_ticket['status'] == "active"){ ?><label class="text-primary"><?php echo ucwords($support_ticket['status']); ?></label><?php }else{ ?><label class="text-success"><?php echo ucwords($support_ticket['status']); ?></label><?php } ?></td>
						<td>
							<?php 
							$obj_support_ticket_discussions->ticket_id = $support_ticket['id'];
							$reply_count = $obj_support_ticket_discussions->count_all_ticket_discussion_reply();
							$obj_support_ticket_discussions->replied_by = $_SESSION['login_type'];
							$unread_reply_count = $obj_support_ticket_discussions->count_all_unread_ticket_discussion_reply();
							if($support_ticket['status'] != "completed" && $reply_count==0){ 
								?>
								<a href="javascript:void(0);" class="btn btn-primary rzvy-white btn-sm rzvy-update-supportticketmodal" data-id="<?php echo $support_ticket['id']; ?>"><i class="fa fa-fw fa-pencil"></i></a> &nbsp; 
								<a href="javascript:void(0);" class="btn btn-danger rzvy-white btn-sm rzvy_delete_support_ticket_btn" data-id="<?php echo $support_ticket['id']; ?>"><i class="fa fa-fw fa-trash"></i></a> &nbsp; 
								<?php 
							} 
							?>
							<a class="btn btn-warning btn-sm markasread_all_support_ticket_reply" href="javascript:void(0)" data-id="<?php echo $support_ticket['id']; ?>"><i class="fa fa-fw fa-eye"></i> <?php if($unread_reply_count>0){ ?><span class="badge badge-success"><?php echo $unread_reply_count; ?></span><?php } ?></a> &nbsp; 
							<?php 
							if($support_ticket['status'] == "active"){ 
							?>
							<a class="btn btn-success btn-sm rzvy_markascomplete_support_ticket_btn" href="javascript:void(0);" data-id="<?php echo $support_ticket['id']; ?>"><i class="fa fa-fw fa-check-square-o" aria-hidden="true"></i></a>
							<?php 
							} 
							?>
						</td>
					</tr>
					<?php 
					$i++;
				} 
				?>
			  </tbody>
           </table>
          </div>
        </div>
      </div>
	 <!-- Add Modal-->
	<div class="modal fade" id="rzvy-generate-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-generate-ticket-modal-label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy-generate-ticket-modal-label"><?php if(isset($rzvy_translangArr['generate_support_ticket'])){ echo $rzvy_translangArr['generate_support_ticket']; }else{ echo $rzvy_defaultlang['generate_support_ticket']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body">
			<form name="rzvy_generate_support_ticket_form" id="rzvy_generate_support_ticket_form" method="post">
			  <div class="form-group">
				<label for="rzvy_ticket_business"><?php if(isset($rzvy_translangArr['generated_for'])){ echo $rzvy_translangArr['generated_for']; }else{ echo $rzvy_defaultlang['generated_for']; } ?></label>
				<span> <?php echo ucwords($obj_settings->get_option("rzvy_company_name")); ?> </span>
			  </div>
			  <div class="form-group">
				<label for="rzvy_tickettitle"><?php if(isset($rzvy_translangArr['ticket_title'])){ echo $rzvy_translangArr['ticket_title']; }else{ echo $rzvy_defaultlang['ticket_title']; } ?></label>
				<input class="form-control" id="rzvy_tickettitle" name="rzvy_tickettitle" type="text" placeholder="<?php if(isset($rzvy_translangArr['enter_ticket_title'])){ echo $rzvy_translangArr['enter_ticket_title']; }else{ echo $rzvy_defaultlang['enter_ticket_title']; } ?>" />
			  </div>
			  <div class="form-group">
				<label for="rzvy_ticketdescription"><?php if(isset($rzvy_translangArr['ticket_description'])){ echo $rzvy_translangArr['ticket_description']; }else{ echo $rzvy_defaultlang['ticket_description']; } ?></label>
				<textarea class="form-control" id="rzvy_ticketdescription" name="rzvy_ticketdescription" placeholder="<?php if(isset($rzvy_translangArr['enter_ticket_description'])){ echo $rzvy_translangArr['enter_ticket_description']; }else{ echo $rzvy_defaultlang['enter_ticket_description']; } ?>" rows="7"></textarea>
			  </div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
			<a id="rzvy_generate_support_ticket_btn" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['generate'])){ echo $rzvy_translangArr['generate']; }else{ echo $rzvy_defaultlang['generate']; } ?></a>
		  </div>
		</div>
	  </div>
	</div>
	 <!-- Update Modal-->
	<div class="modal fade" id="rzvy-update-ticket-modal" tabindex="-1" role="dialog" aria-labelledby="rzvy-update-ticket-modal-label" aria-hidden="true">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title" id="rzvy-update-ticket-modal-label"><?php if(isset($rzvy_translangArr['update_support_ticket'])){ echo $rzvy_translangArr['update_support_ticket']; }else{ echo $rzvy_defaultlang['update_support_ticket']; } ?></h5>
			<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			  <span aria-hidden="true">×</span>
			</button>
		  </div>
		  <div class="modal-body rzvy-update-ticket-modal-body">
			
		  </div>
		  <div class="modal-footer">
			<button class="btn btn-secondary" type="button" data-dismiss="modal"><?php if(isset($rzvy_translangArr['cancel'])){ echo $rzvy_translangArr['cancel']; }else{ echo $rzvy_defaultlang['cancel']; } ?></button>
			<a id="rzvy_update_support_ticket_btn" data-id="" class="btn btn-primary" href="javascript:void(0);"><?php if(isset($rzvy_translangArr['update'])){ echo $rzvy_translangArr['update']; }else{ echo $rzvy_defaultlang['update']; } ?></a>
		  </div>
		</div>
	  </div>
	</div>
<?php include 'c_footer.php'; ?>