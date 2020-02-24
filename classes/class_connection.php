<?php 
class rzvy_database{
	/* Function to connect mysqli database */
	public function connect(){
		/* Create connection */
		if(rzvy_HOSTNAME != "" && rzvy_USERNAME != "" && rzvy_DATABASE != ""){
			/** check server default requirements **/
			if(((phpversion() >= '5.3') == false) || ((!ini_get('session_auto_start')) == false) || (extension_loaded('mysqli') == false) || (extension_loaded('gd') == false) || ((extension_loaded('curl')) == false)){
				echo "<h2>Please check our minimum required server configurations to proceed further.</h2>";
				echo "<br /><br /><br />";
				echo "<b>Check <a href='".SITE_URL."installation-instruction.php'>installation instructions</a> to resolve this problem.</b>";
				exit;
			}else{
				$conn = new mysqli(rzvy_HOSTNAME, rzvy_USERNAME, rzvy_PASSWORD, rzvy_DATABASE);
				/* Check connection */
				if ($conn->connect_error) {
					@ob_clean();
					ob_start();
					/** redirect to installation page **/
					echo $conn->connect_error;
					echo "<br /><br /><br />";
					echo "<b>Check <a href='".SITE_URL."installation-instruction.php'>installation instructions</a> to resolve this problem.</b>";
					exit;
				}else{
					/* Select 1 from tables will return false if the table does not exist. */
					mysqli_query($conn, "SET SQL_BIG_SELECTS=1");
					$val = mysqli_query($conn, 'SELECT 1 FROM `rzvy_used_coupons_by_customer`, `rzvy_support_tickets`, `rzvy_support_ticket_discussions`, `rzvy_settings`, `rzvy_services`, `rzvy_schedule`, `rzvy_payments`, `rzvy_frequently_discount`, `rzvy_feedback`, `rzvy_customers`, `rzvy_customer_orderinfo`, `rzvy_coupons`, `rzvy_categories`, `rzvy_bookings`, `rzvy_admins`, `rzvy_addons` limit 1');
					if($val === FALSE){
						echo "<b>Some MYSQL tables are missing please import provided SQL file properly. (SQL file located at database folder)</b>";
						exit;
					}else{
						return $conn;
					}
				}
			}
		}else{
			if (strpos($_SERVER['SCRIPT_NAME'], 'installation-instruction.php') == false) { header("location:".SITE_URL."installation-instruction.php");exit; }
		}
    }
	
	/* Function to check admin setup done or not */
	public function check_admin_setup_detail($conn){
		$query = "select `id` from `rzvy_admins` where `status` = 'Y'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)==0){
			header("location:".SITE_URL."admin-setup.php");exit;
		}
    }
	
	/* Function to check admin setup done or not for setup page */
	public function check_admin_setup_detail_setup_page($conn){
		$query = "select `id` from `rzvy_admins` where `status` = 'Y'";
		$result=mysqli_query($conn,$query);
		if(mysqli_num_rows($result)>0){
			header("location:".SITE_URL."backend/");exit;
		}
    }
}
?>