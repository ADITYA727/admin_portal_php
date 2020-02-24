<?php 
include 'header.php'; 
include(dirname(dirname(__FILE__))."/classes/class_feedback.php");
/* Create object of classes */
$obj_feedback = new rzvy_feedback();
$obj_feedback->conn = $conn; 
?>
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo SITE_URL; ?>backend/appointments.php"><i class="fa fa-home"></i></a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['feedbacks'])){ echo $rzvy_translangArr['feedbacks']; }else{ echo $rzvy_defaultlang['feedbacks']; } ?></li>
      </ol>
      <!-- Feedback DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-fw fa-book"></i> <?php if(isset($rzvy_translangArr['feedback_list'])){ echo $rzvy_translangArr['feedback_list']; }else{ echo $rzvy_defaultlang['feedback_list']; } ?>
		  </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" width="100%" cellspacing="0" id="rzvy_feedback_list_table">
              <thead>
				<tr>
				  <th><?php if(isset($rzvy_translangArr['name'])){ echo $rzvy_translangArr['name']; }else{ echo $rzvy_defaultlang['name']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['email'])){ echo $rzvy_translangArr['email']; }else{ echo $rzvy_defaultlang['email']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['rating'])){ echo $rzvy_translangArr['rating']; }else{ echo $rzvy_defaultlang['rating']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['review'])){ echo $rzvy_translangArr['review']; }else{ echo $rzvy_defaultlang['review']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['review_on'])){ echo $rzvy_translangArr['review_on']; }else{ echo $rzvy_defaultlang['review_on']; } ?></th>
				  <th><?php if(isset($rzvy_translangArr['status'])){ echo $rzvy_translangArr['status']; }else{ echo $rzvy_defaultlang['status']; } ?></th>
				</tr>
			  </thead>
			  <tbody>
				<?php 
				$all_feedbacks = $obj_feedback->get_all_feedbacks();
				$rating_star_array = array(
					"0" => '-',
					"1" => '<i class="fa fa-star" aria-hidden="true"></i>',
					"2" => '<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>',
					"3" => '<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>',
					"4" => '<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>',
					"5" => '<i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i>',
				);
				if(mysqli_num_rows($all_feedbacks)>0){
					$rzvy_date_format = $obj_settings->get_option('rzvy_date_format');
					$rzvy_time_format = $obj_settings->get_option('rzvy_time_format');
					
					while($feedback = mysqli_fetch_assoc($all_feedbacks)){
						?>
						<tr>
							<td><?php echo ucwords($feedback['name']); ?></td>
							<td><?php echo $feedback['email']; ?></td>
							<td><?php echo $rating_star_array[$feedback['rating']]; ?></td>
							<td><?php echo $feedback['review']; ?></td>
							<td><?php echo date($rzvy_date_format." ".$rzvy_time_format, strtotime($feedback['review_datetime'])); ?></td>
							<td>
								<?php $checked = ''; if($feedback['status'] == "Y"){ $checked = "checked"; } ?>
								<label class="rzvy-toggle-switch">
								  <input type="checkbox" data-id="<?php echo $feedback['id']; ?>" class="rzvy-toggle-switch-input rzvy_change_feedback_status" <?php echo $checked; ?> />
								  <span class="rzvy-toggle-switch-slider"></span>
								</label>
							</td>
						</tr>
						<?php 
					}
				}
				?>
			  </tbody>
           </table>
          </div>
        </div>
      </div>
<?php include 'footer.php'; ?>