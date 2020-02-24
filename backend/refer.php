<?php 
include 'c_header.php';
include(dirname(dirname(__FILE__))."/classes/class_customers.php");
$obj_customers = new rzvy_customers();
$obj_customers->conn = $conn;
$obj_customers->id = $_SESSION['customer_id'];
$profile_data = $obj_customers->readone_customer();
?>
<!-- Breadcrumbs-->
<ol class="breadcrumb">
	<li class="breadcrumb-item">
		<a href="<?php echo SITE_URL; ?>backend/my-appointments.php"><i class="fa fa-home"></i></a>
	</li>
	<li class="breadcrumb-item active"><?php if(isset($rzvy_translangArr['refer_a_friend'])){ echo $rzvy_translangArr['refer_a_friend']; }else{ echo $rzvy_defaultlang['refer_a_friend']; } ?></li>
</ol>
<div class="card mb-3">
	<div class="card-body">
		<div class="row">
			<div class="col-md-12">
				<?php 
				if($profile_data["refferral_code"] != ""){ 
					?>
					<div class="p-3">
						<div class="mb-3 p-3 border_double rzvy_refer_box">
							<div class="text-center pb-3"><i class="fa fa-gift fa-5x text-danger"></i></div>
							<h3 class="text-center text-dark"><?php if(isset($rzvy_translangArr['refer_to_your_friends'])){ echo $rzvy_translangArr['refer_to_your_friends']; }else{ echo $rzvy_defaultlang['refer_to_your_friends']; } ?></h3>
							<p class="text-center text-muted"><?php if(isset($rzvy_translangArr['ask_your_friends'])){ echo $rzvy_translangArr['ask_your_friends']; }else{ echo $rzvy_defaultlang['ask_your_friends']; } ?></p>
							<div class="rzvy_refer_input">
								<input class="text-secondary" type="text" readonly="readonly" value="<?php echo $profile_data["refferral_code"]; ?>"/>
							</div>
							<div class="p-3 text-muted">
								<h3><?php if(isset($rzvy_translangArr['step_to_refer'])){ echo $rzvy_translangArr['step_to_refer']; }else{ echo $rzvy_defaultlang['step_to_refer']; } ?> </h3>
								<p><?php if(isset($rzvy_translangArr['refer_step_1'])){ echo $rzvy_translangArr['refer_step_1']; }else{ echo $rzvy_defaultlang['refer_step_1']; } ?></p>
								<p><?php if(isset($rzvy_translangArr['refer_step_2'])){ echo $rzvy_translangArr['refer_step_2']; }else{ echo $rzvy_defaultlang['refer_step_2']; } ?></p>
								<p><?php if(isset($rzvy_translangArr['refer_step_3'])){ echo $rzvy_translangArr['refer_step_3']; }else{ echo $rzvy_defaultlang['refer_step_3']; } ?></p>
							</div>
						</div>
					</div>
					<?php 
				}else{ 
					?>
					<div class="p-3">
						<div class="mb-3 p-3 border_double rzvy_refer_box">
							<div class="text-center pb-3"><i class="fa fa-gift fa-5x text-danger"></i></div>
							<h3 class="text-center text-dark pb-3"><?php if(isset($rzvy_translangArr['opps_not_eligible_to_refer'])){ echo $rzvy_translangArr['opps_not_eligible_to_refer']; }else{ echo $rzvy_defaultlang['opps_not_eligible_to_refer']; } ?></h3>
						</div>
					</div>
					<?php 
				} 
				?>
			</div>
		</div>
	</div>
</div>	 
<?php include 'c_footer.php'; ?>