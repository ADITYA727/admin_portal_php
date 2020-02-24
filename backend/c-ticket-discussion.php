<?php 
include 'c_header.php'; 
include(dirname(dirname(__FILE__))."/classes/class_support_tickets.php");
include(dirname(dirname(__FILE__))."/classes/class_support_ticket_discussions.php");

if(!isset($_GET['tid'])){
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/c-support-tickets.php";
	</script>
	<?php 
	exit;
}
$tid = $_GET['tid'];

$obj_support_tickets = new rzvy_support_tickets();
$obj_support_tickets->conn = $conn;
$obj_support_tickets->id = $tid;

$obj_support_ticket_discussions = new rzvy_support_ticket_discussions();
$obj_support_ticket_discussions->conn = $conn;
$obj_support_ticket_discussions->ticket_id = $tid;

$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');

$rzvy_datetime_format = $rzvy_date_format." ".$rzvy_time_format; 
$support_ticket_detail = $obj_support_tickets->readone_support_ticket(); 
if(sizeof($support_ticket_detail)==0){ 
	?>
	<script>
	window.location.href = "<?php echo SITE_URL; ?>backend/c-support-tickets.php";
	</script>
	<?php  
	exit;
} 
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/my-appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/c-support-tickets.php"><?php if(isset($rzvy_translangArr['support_tickets'])){ echo $rzvy_translangArr['support_tickets']; }else{ echo $rzvy_defaultlang['support_tickets']; } ?></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['discussion'])){ echo $rzvy_translangArr['discussion']; }else{ echo $rzvy_defaultlang['discussion']; } ?></li>
      </ol>
      <!-- DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-fw fa-comments-o"></i> <?php if(isset($rzvy_translangArr['discussion_on_ticket'])){ echo $rzvy_translangArr['discussion_on_ticket']; }else{ echo $rzvy_defaultlang['discussion_on_ticket']; } ?>
		  <a class="btn btn-primary btn-sm rzvy-white pull-right" href="<?php echo SITE_URL; ?>backend/c-support-tickets.php"><i class="fa fa-angle-double-left"></i> <?php if(isset($rzvy_translangArr['back_to_support_tickets'])){ echo $rzvy_translangArr['back_to_support_tickets']; }else{ echo $rzvy_defaultlang['back_to_support_tickets']; } ?></a>
		</div>
        <div class="card-body">
			<div class="rzvy_support_ticket_window">
				<div class="rzvy_support_ticket_topmenu">
					<p class="rzvy_support_ticket_topmenu_datetime col-md-12"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date($rzvy_datetime_format, strtotime($support_ticket_detail['generated_on'])); ?></p>
					<div class="rzvy_support_ticket_topmenu_title"><?php echo ucfirst($support_ticket_detail['ticket_title']); ?></div>
					<p class="rzvy_support_ticket_topmenu_description">&nbsp; &nbsp; &nbsp; &nbsp; <?php echo ucfirst($support_ticket_detail['description']); ?></p>
				</div>
				<ul class="rzvy_support_ticket_reply_list">
					<?php 
					$get_all_replies = $obj_support_ticket_discussions->get_all_support_ticket_replies();
					if(mysqli_num_rows($get_all_replies)>0){
						while($discussion_detail = mysqli_fetch_assoc($get_all_replies)){ 
							?>
							<li class="rzvy_support_ticket_reply rzvy_show_support_ticket_reply <?php if($_SESSION['login_type'] == $discussion_detail['replied_by']){ echo "rzvy_show_support_ticket_on_right"; }else{ echo "rzvy_show_support_ticket_on_left"; } ?>">
								<div class="rzvy_support_ticket_reply_wrapper">
									<p class="pull-left col-md-12"><i class="fa fa-user" aria-hidden="true"></i> <?php 
									if($_SESSION['login_type'] == $discussion_detail['replied_by']){
										if(isset($rzvy_translangArr['you'])){ echo $rzvy_translangArr['you']; }else{ echo $rzvy_defaultlang['you']; }
									}else{
										$obj_support_ticket_discussions->replied_by_id = $discussion_detail['replied_by_id'];
										$obj_support_ticket_discussions->replied_by = $discussion_detail['replied_by'];
										echo $obj_support_ticket_discussions->get_support_ticket_replied_by_name();
									} 
									?></p>
									<div class="rzvy_support_ticket_reply_wrapper_content"><?php echo $discussion_detail['reply']; ?></div>
									<p class="pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date($rzvy_datetime_format, strtotime($discussion_detail['replied_on'])); ?></p>
								</div>
							</li>
							<?php 
						} 
					}else{
						?>
						<li class="rzvy_remove_empty_discussion_li">
							<?php if(isset($rzvy_translangArr['there_is_no_discussion_on_this_ticket_yet'])){ echo $rzvy_translangArr['there_is_no_discussion_on_this_ticket_yet']; }else{ echo $rzvy_defaultlang['there_is_no_discussion_on_this_ticket_yet']; } ?>
						</li>
						<?php 
					} 
					?>
				</ul>
				<?php 
				if($support_ticket_detail['status'] == "active"){ 
					?>
					<div class="rzvy_support_ticket_send_reply_wrapper clearfix">
						<div class="rzvy_support_ticket_send_reply_input_wrapper">
							<input class="rzvy_support_ticket_reply_input" data-id="<?php echo $tid; ?>" placeholder="Type here..." />
						</div>
						<div class="rzvy_support_ticket_send_reply_btndiv" data-id="<?php echo $tid; ?>">
							<div class="rzvy_support_ticket_send_reply_btnicon"></div>
							<div class="rzvy_support_ticket_reply_wrapper_content"><?php if(isset($rzvy_translangArr['send'])){ echo $rzvy_translangArr['send']; }else{ echo $rzvy_defaultlang['send']; } ?></div>
						</div>
					</div>
					<?php 
				} 
				?>
			</div>
			<div class="rzvy_support_ticket_reply_template">
				<li class="rzvy_support_ticket_reply">
					<div class="rzvy_support_ticket_reply_wrapper">
						<p class="pull-left col-md-12"><i class="fa fa-user" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['you'])){ echo $rzvy_translangArr['you']; }else{ echo $rzvy_defaultlang['you']; } ?></p>
						<div class="rzvy_support_ticket_reply_wrapper_content"></div>
						<p class="pull-right"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php if(isset($rzvy_translangArr['just_now'])){ echo $rzvy_translangArr['just_now']; }else{ echo $rzvy_defaultlang['just_now']; } ?></p>
					</div>
				</li>
			</div>
        </div>
      </div>
<?php include 'c_footer.php'; ?>