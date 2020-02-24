<?php 
class rzvy_frontend{
	public $conn;
	public $category_id;
	public $service_id;
	public $addon_id;
	public $frequently_discount_id;
	public $coupon_id;
	public $customer_id;
	public $feedback_name;
	public $feedback_email;
	public $feedback_rating;
	public $feedback_review;
	public $feedback_review_datetime;
	public $email;
	public $password;
	public $staff_id;
	public $order_id;
	public $booking_datetime;
	public $booking_end_datetime;
	public $order_date;
	public $addons;
	public $booking_status;
	public $lastmodified;
	public $firstname;
	public $lastname;
	public $phone;
	public $address;
	public $city;
	public $state;
	public $zip;
	public $country;
	public $payment_method;
	public $payment_date;
	public $transaction_id;
	public $sub_total;
	public $discount;
	public $tax;
	public $net_total;
	public $fd_key;
	public $fd_amount;
	public $is_expired;
	public $refer_discount;
	public $refer_discount_id;
	public $used_on;
	public $fd_id;
	public $ref_customer_id;
	public $ref_discount;
	public $ref_discount_type;
	public $ref_used;
	public $service_rate;
	public $rzvy_services = 'rzvy_services';
	public $rzvy_categories = 'rzvy_categories';
	public $rzvy_addons = 'rzvy_addons';
	public $rzvy_frequently_discount = 'rzvy_frequently_discount';
	public $rzvy_feedback = 'rzvy_feedback';
	public $rzvy_customers = 'rzvy_customers';
	public $rzvy_coupons = 'rzvy_coupons';
	public $rzvy_used_coupons_by_customer = 'rzvy_used_coupons_by_customer';
	public $rzvy_bookings = 'rzvy_bookings';
	public $rzvy_customer_orderinfo = 'rzvy_customer_orderinfo';
	public $rzvy_payments = 'rzvy_payments';
	public $rzvy_customer_referrals = 'rzvy_customer_referrals';
	public $rzvy_staff_services = 'rzvy_staff_services';
	public $rzvy_staff = 'rzvy_staff';
		
	/* Function to add feedback */
	public function add_feedback(){
		$res=mysqli_query($this->conn, "select * from `".$this->rzvy_feedback."` where `email`='".strtolower($this->feedback_email)."'");
		if(mysqli_num_rows($res)>0){
			$query = "update `".$this->rzvy_feedback."` set `name`='".$this->feedback_name."', `rating`='".$this->feedback_rating."', `review`='".$this->feedback_review."', `review_datetime`='".$this->feedback_review_datetime."', `status`='Y' where `email`='".strtolower($this->feedback_email)."'";
			$result=mysqli_query($this->conn,$query);
			return $result;
		}else{
			$query = "INSERT INTO `".$this->rzvy_feedback."` (`id`, `name`, `email`, `rating`, `review`, `review_datetime`, `status`) VALUES (NULL, '".$this->feedback_name."', '".strtolower($this->feedback_email)."', '".$this->feedback_rating."', '".$this->feedback_review."', '".$this->feedback_review_datetime."', 'Y')";
			$result=mysqli_query($this->conn,$query);
			return $result;
		}
	}
	
	/* Function to get all feedbacks */
	public function get_all_feedbacks(){
		$query = "select * from `".$this->rzvy_feedback."` where `status` = 'Y' ORDER BY `id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to Check feedback Exist or Not */
	public function check_feedback_exist(){ 
		$query = "select * from `".$this->rzvy_feedback."` where `email` = '".$this->feedback_email."'";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to apply coupon code */
	public function apply_coupon(){
		$query = "select * from `".$this->rzvy_coupons."` where `id`='".$this->coupon_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value;
	}
	
	/* Function to get all frequently discount */
	public function get_all_frequently_discount(){
		$query = "select * from `".$this->rzvy_frequently_discount."` where `fd_status` = 'Y' ORDER BY `id` ASC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to readone frequently discount */
	public function readone_frequently_discount(){
		$query = "select * from `".$this->rzvy_frequently_discount."` where `id` = '".$this->frequently_discount_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value;
	}
		
	/* Function to get all categories */
	public function get_all_categories(){
		$query = "select `c`.`id`, `c`.`cat_name` 
		from `".$this->rzvy_categories."` as `c`, 
		`".$this->rzvy_services."` as `s`, 
		`".$this->rzvy_staff_services."` as `ss`
		where 
		`c`.`status` = 'Y'
		and `s`.`status` = 'Y' 
		and `s`.`cat_id` = `c`.`id` 
		and `s`.`id` = `ss`.`service_id` 
		group by `c`.`id`, `c`.`cat_name` ORDER BY `c`.`id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
		
	/* Function to get services by category id */
	public function get_services_by_cat_id(){
		$query = "select `s`.* 
		from 
		`".$this->rzvy_services."` as `s`, 
		`".$this->rzvy_staff_services."` as `ss`
		where 
		`s`.`cat_id`='".$this->category_id."' 
		and `s`.`status` = 'Y' 
		and `s`.`id` = `ss`.`service_id` 
		GROUP BY `s`.`id`, `s`.`cat_id`, `s`.`title`, `s`.`image`, `s`.`description`, `s`.`status`, `s`.`duration`, `s`.`padding_before`, `s`.`padding_after`, `s`.`rate`
		ORDER BY `s`.`id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
		
	/* Function to get multiple qty addons by service id */
	public function get_multiple_qty_addons_by_service_id(){
		$query = "select * 
		from 
		`".$this->rzvy_addons."` 
		where 
		`service_id`='".$this->service_id."' 
		and `multiple_qty` = 'Y' 
		and `status` = 'Y' 
		ORDER BY `id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
		
	/* Function to get single qty addons by service id */
	public function get_single_qty_addons_by_service_id(){
		$query = "select * 
		from 
		`".$this->rzvy_addons."` 
		where 
		`service_id`='".$this->service_id."' 
		and `multiple_qty` = 'N' 
		and `status` = 'Y' 
		ORDER BY `id` DESC";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
		
	/* Function to get addon rate by addon id */
	public function get_addon_rate(){
		$query = "select `rate` from `".$this->rzvy_addons."` where `id`='".$this->addon_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value['rate'];
	}
	
	/* Function to get addon by addon id */
	public function readone_addon(){
		$query = "select * from `".$this->rzvy_addons."` where `id`='".$this->addon_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value;
	}

	/* Function to read one addon name */
	public function readone_addon_name(){
		$query = "select `title` from `".$this->rzvy_addons."` where `id`='".$this->addon_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value['title'];
	}

	/* Function to read one service name */
	public function readone_service_name(){
		$query = "select `title` from `".$this->rzvy_services."` where `id`='".$this->service_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value['title'];
	}

	/* Function to read one category name */
	public function readone_category_name(){
		$query = "select `cat_name` from `".$this->rzvy_categories."` where `id`='".$this->category_id."'";
		$result=mysqli_query($this->conn,$query);
		$value=mysqli_fetch_array($result);
		return $value['cat_name'];
	}
	
	/* Function to check existing cart item */
	public function rzvy_check_existing_cart_item($arr, $id){
		foreach($arr as $key => $val){
			if ( $val["id"] === $id ){
				return $key;
			}
		}
		return false;
	}
	
	/* Function to check login details */
	public function login_process(){
		/* Check email address and password are correct or not in customers table */
		$query = "select * from `".$this->rzvy_customers."` where `email`='".$this->email."' and `password`='".md5($this->password)."' and `status`='Y'";
		$result=mysqli_query($this->conn,$query);
		
		/* To check user exist or not */
		if(mysqli_num_rows($result)>0){
			$value=mysqli_fetch_assoc($result);
			
			/* Set session values for logged in customer */
			unset($_SESSION['staff_id']);
			unset($_SESSION['admin_id']);
			$_SESSION['customer_id'] = $value['id'];
			$_SESSION['login_type'] = "customer";
			
			return $value;
        }
	}
	
	/* Function to get new order id for appointment */
	public function get_order_id(){
		$query = "select order_id from `".$this->rzvy_bookings."` order by `order_id` DESC limit 1";
		$result=mysqli_query($this->conn,$query);
		if(mysqli_num_rows($result)>0){
			$value=mysqli_fetch_assoc($result);
			return ($value['order_id']+1);
		}else{
			return 100;
		}
	}
	
	/* Function to readone customer details */
	public function readone_customer(){
		$query = "select * from `".$this->rzvy_customers."` where `id`='".$this->customer_id."'";
		$result=mysqli_query($this->conn,$query);		
		$value=mysqli_fetch_assoc($result);
		return $value;
	}
	
	/* Function to get available coupons for customer */
	public function get_available_coupons(){
		$query = "select * from `".$this->rzvy_coupons."` where `status`='Y' and `coupon_expiry` >= CURDATE()";
		$result=mysqli_query($this->conn,$query);
		return $result;
	}
	
	/* Function to get available coupons for customer */
	public function check_available_coupon_of_existing_customer(){
		$query = "select `id` from `".$this->rzvy_used_coupons_by_customer."` where `customer_id`='".$this->customer_id."' and `coupon_id`='".$this->coupon_id."' and `is_expired`='Y'";
		$result=mysqli_query($this->conn,$query);
		if(mysqli_num_rows($result)>0){
			return "used";
		}else{
			return "not used";
		}
	}
	
	/** Function to add appointment detail in booking table **/
	public function add_bookings(){
		$query = "INSERT INTO `".$this->rzvy_bookings."` (`id`, `order_id`, `customer_id`, `booking_datetime`, `booking_end_datetime`, `order_date`, `cat_id`, `service_id`, `addons`, `booking_status`, `reschedule_reason`, `reject_reason`, `cancel_reason`, `reminder_status`, `read_status`, `lastmodified`, `staff_id`, `service_rate`) VALUES (NULL, '".$this->order_id."', '".$this->customer_id."', '".$this->booking_datetime."', '".$this->booking_end_datetime."', '".$this->order_date."', '".$this->category_id."', '".$this->service_id."', '".$this->addons."', '".$this->booking_status."', '', '', '', 'N', 'U', '".$this->lastmodified."', '".$this->staff_id."', '".$this->service_rate."')";
		$result = mysqli_query($this->conn,$query);
		return $result;
	}
	
	/** Function to add appointment detail in customer orderinfo table **/
	public function add_customer_orderinfo(){
		$query = "INSERT INTO `".$this->rzvy_customer_orderinfo."` (`id`, `order_id`, `c_firstname`, `c_lastname`, `c_email`, `c_phone`, `c_address`, `c_city`, `c_state`, `c_country`, `c_zip`) VALUES (NULL, '".$this->order_id."', '".$this->firstname."', '".$this->lastname."', '".$this->email."', '".$this->phone."', '".$this->address."', '".$this->city."', '".$this->state."', '".$this->country."', '".$this->zip."')";
		$result = mysqli_query($this->conn,$query);
		return $result;
	}
	
	/** Function to add new customer detail in customer table **/
	public function add_customers(){
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$refferral_code = "";
		for ($i = 0; $i < 15; $i++) {
			$refferral_code .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		$query = "INSERT INTO `".$this->rzvy_customers."` (`id`, `email`, `password`, `firstname`, `lastname`, `phone`, `address`, `city`, `state`, `zip`, `country`, `image`, `status`, `refferral_code`) VALUES (NULL, '".$this->email."', '".$this->password."', '".$this->firstname."', '".$this->lastname."', '".$this->phone."', '".$this->address."', '".$this->city."', '".$this->state."', '".$this->zip."', '".$this->country."', '', 'Y', '".$refferral_code."')";
		$result = mysqli_query($this->conn,$query);
		$value=mysqli_insert_id($this->conn);
		return $value;
	}
	
	/** Function to add appointment detail in payment table **/
	public function add_payments(){
		$query = "INSERT INTO `".$this->rzvy_payments."` (`id`, `order_id`, `payment_method`, `payment_date`, `transaction_id`, `sub_total`, `discount`, `tax`, `net_total`, `fd_key`, `fd_amount`, `lastmodified`, `refer_discount`, `refer_discount_id`) VALUES (NULL, '".$this->order_id."', '".$this->payment_method."', '".$this->payment_date."', '".$this->transaction_id."', '".$this->sub_total."', '".$this->discount."', '".$this->tax."', '".$this->net_total."', '".$this->fd_key."', '".$this->fd_amount."', '".$this->lastmodified."', '".$this->refer_discount."', '".$this->refer_discount_id."')";
		$result = mysqli_query($this->conn,$query);
		return $result;
	}
	
	/** Function to add applied coupon detail in used coupons by customer table **/
	public function add_used_coupons_by_customer(){
		$query = "INSERT INTO `".$this->rzvy_used_coupons_by_customer."` (`id`, `customer_id`, `coupon_id`, `is_expired`, `used_on`) VALUES (NULL, '".$this->customer_id."', '".$this->coupon_id."', '".$this->is_expired."', '".$this->used_on."')";
		$result = mysqli_query($this->conn,$query);
		return $result;
	}
	
	/*** Function for calculation of cart **/
	public function rzvy_cart_item_calculation($subtotal, $rzvy_tax_status, $rzvy_tax_type, $rzvy_tax_value, $rzvy_referral_discount_type, $rzvy_referral_discount_value){
		$new_subtotal = $subtotal;
		$new_nettotal = 0;
		/** calculate frequently discount **/
		if(is_numeric($_SESSION["rzvy_cart_freqdiscount_id"]) && $_SESSION["rzvy_cart_freqdiscount_id"] != ""){
			$this->frequently_discount_id = $_SESSION["rzvy_cart_freqdiscount_id"];
			$fd_discount = $this->readone_frequently_discount(); 
			if(is_array($fd_discount)){
				if($new_subtotal>0){
					if($fd_discount['fd_type'] == "percentage"){
						$cart_fd = ($new_subtotal*$fd_discount["fd_value"]/100);
					}else{
						$cart_fd = $fd_discount["fd_value"];
					}
					$cart_fd = number_format($cart_fd,2,".",',');
					$new_nettotal = ($new_subtotal-$cart_fd);
					$_SESSION['rzvy_cart_freqdiscount'] = $cart_fd;
					$_SESSION['rzvy_cart_freqdiscount_label'] = $fd_discount["fd_label"];
					$_SESSION['rzvy_cart_freqdiscount_key'] = $fd_discount["fd_key"];
					$new_subtotal = $new_subtotal-$cart_fd;
				}else{
					$_SESSION['rzvy_cart_freqdiscount_id'] = "";
					$_SESSION['rzvy_cart_freqdiscount'] = 0;
					$_SESSION['rzvy_cart_freqdiscount_label'] = "";
					$_SESSION['rzvy_cart_freqdiscount_key'] = "";
				}
			}
		}else{
			$new_nettotal = $new_subtotal;
			$_SESSION['rzvy_cart_freqdiscount_id'] = "";
			$_SESSION['rzvy_cart_freqdiscount'] = 0;
			$_SESSION['rzvy_cart_freqdiscount_label'] = "";
			$_SESSION['rzvy_cart_freqdiscount_key'] = "";
		}
		
		/** calculate coupon discount **/
		if($_SESSION['rzvy_cart_couponid'] != "" && is_numeric($_SESSION['rzvy_cart_couponid'])){
			$this->coupon_id = $_SESSION['rzvy_cart_couponid'];
			$coupon_detail = $this->apply_coupon(); 
			if($new_subtotal>0){
				if($coupon_detail['coupon_type'] == "percentage"){
					$cart_coupon = ($new_subtotal*$coupon_detail["coupon_value"]/100);
				}else{
					$cart_coupon = $coupon_detail["coupon_value"];
				}
				$cart_coupon = number_format($cart_coupon,2,".",',');
				$new_nettotal = ($new_subtotal-$cart_coupon);
				$_SESSION['rzvy_cart_coupondiscount'] = $cart_coupon;
				$new_subtotal = $new_subtotal-$cart_coupon;
			}else{
				$_SESSION['rzvy_cart_coupondiscount'] = 0;
				$_SESSION['rzvy_cart_couponid'] = "";
			}
		}else{
			$_SESSION['rzvy_cart_coupondiscount'] = 0;
			$_SESSION['rzvy_cart_couponid'] = "";
			$new_nettotal = $new_subtotal;
		}
		
		/** calculate referral coupon discount **/
		if($_SESSION['rzvy_applied_ref_customer_id'] != "" && is_numeric($_SESSION['rzvy_applied_ref_customer_id'])){
			if($new_subtotal>0){
				if($rzvy_referral_discount_type == "percentage"){
					$cart_referral_coupon = ($new_subtotal*$rzvy_referral_discount_value/100);
				}else{
					$cart_referral_coupon = $rzvy_referral_discount_value;
				}
				$cart_referral_coupon = number_format($cart_referral_coupon,2,".",',');
				$new_nettotal = ($new_subtotal-$cart_referral_coupon);
				$_SESSION['rzvy_referral_discount_amount'] = $cart_referral_coupon;
				$new_subtotal = $new_subtotal-$cart_referral_coupon;
			}else{
				$_SESSION['rzvy_referral_discount_amount'] = 0;
				$_SESSION['rzvy_applied_ref_customer_id'] = "";
			}
		}else{
			$_SESSION['rzvy_referral_discount_amount'] = 0;
			$_SESSION['rzvy_applied_ref_customer_id'] = "";
			$new_nettotal = $new_subtotal;
		}
		
		/** calculate tax **/
		if($rzvy_tax_status == "Y"){
			if($new_subtotal>0){
				if($rzvy_tax_type == "percentage"){
					$cart_tax = ($new_subtotal*$rzvy_tax_value/100);
				}else{
					$cart_tax = $rzvy_tax_value;
				}
				$cart_tax = number_format($cart_tax,2,".",',');
				$new_nettotal = ($new_subtotal+$cart_tax);
				$_SESSION['rzvy_cart_tax'] = $cart_tax;
			}else{
				$_SESSION['rzvy_cart_tax'] = 0;
			}
		}else{
			$_SESSION['rzvy_cart_tax'] = 0;
			$new_nettotal = $new_subtotal;
		}
		
		/** sub total and net total **/
		$_SESSION['rzvy_cart_subtotal'] = number_format($subtotal,2,".",',');
		if($new_nettotal>0){
			$_SESSION['rzvy_cart_nettotal'] = number_format($new_nettotal,2,".",',');
		}else{
			$_SESSION['rzvy_cart_nettotal'] = 0;
		}	
	}
	
	/** Function to check referral code */
	public function check_referral_code($code){
		$query = "select `id` from `".$this->rzvy_customers."` where `refferral_code` = '".$code."'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
	
	/** Function to check referral first booking */
	public function check_referral_firstbooking($customer_id){
		$query = "select `id` from `".$this->rzvy_bookings."` where `customer_id` = '".$customer_id."'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
		
	/** Function to add customer referrals */
	public function add_customer_referral(){
		$chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$ref_coupon = "";
		for ($i = 0; $i < 10; $i++) {
			$ref_coupon .= $chars[mt_rand(0, strlen($chars)-1)];
		}
		$query = "INSERT INTO `".$this->rzvy_customer_referrals."`(`id`, `order_id`, `customer_id`, `ref_customer_id`, `coupon`, `discount`, `discount_type`, `used`, `completed`) VALUES (NULL, '".$this->order_id."', '".$this->customer_id."', '".$this->ref_customer_id."', '".$ref_coupon."', '".$this->ref_discount."', '".$this->ref_discount_type."', 'N', 'N')";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
		
	/** Function to check_referral_coupon_code_exist **/
	public function check_referral_coupon_code_exist($ref_customer_id, $ref_coupon){
		$query = "select * from `".$this->rzvy_customer_referrals."` where `ref_customer_id`='".$ref_customer_id."' and `coupon` = '".$ref_coupon."' and `completed` = 'Y'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}
		
	/** Function to check_referral_coupon_code_exist **/
	public function update_customer_referral_used($id){
		$query = "update `".$this->rzvy_customer_referrals."` set `used` = 'Y' where `id`='".$id."'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}

	/** Get all service linked staff */
	public function getall_service_staff($service_id){
		$query = "select `ss`.* from `".$this->rzvy_staff_services."` as `ss`, `".$this->rzvy_staff."` as `s` where `s`.`status`='Y' and `s`.`id`=`ss`.`staff_id` and `ss`.`service_id`='".$service_id."'";
		$result = mysqli_query($this->conn, $query);
		return $result;
	}

	/** Get all service linked staff */
	public function get_staff($staffid){
		$query = "select * from `".$this->rzvy_staff."` where `id`='".$staffid."'";
		$result = mysqli_query($this->conn, $query);
		$val = mysqli_fetch_array($result);
		return $val;
	}
	
	/* Function to get services details by id */
	public function readone_service(){
		$query = "select * from `".$this->rzvy_services."` where `id`='".$this->service_id."'";
		$result=mysqli_query($this->conn,$query);
		$val = mysqli_fetch_array($result);
		return $val;
	}
} 
?>