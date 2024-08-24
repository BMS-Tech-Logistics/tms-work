<?php
include('db_connection.php');
include('./PHPMailer/PHPMailerAutoload.php');

class operation_admin extends database_connection
{
	
	public function __construct(){
		parent:: __construct();
	}  
    
    
    //User Registration Only One Time
    public function admin_registration_submit($data){
        //get the value
        $full_name = strip_tags($data['full_name']);
        $email = strip_tags($data['email']);
        $phone = strip_tags($data['phone']);
        $password = strip_tags($data['password']);
        $type = strip_tags($data['type']);
        
        // Remove leading/trailing whitespace and convert to lowercase
        $full_name_lower = strtolower(trim($full_name));

        // Split the full name into parts
        $name_parts = explode(' ', $full_name_lower);

        // Initialize username with the first letter of the first part
        $username = substr($name_parts[0], 0, 1);

        // Append the first letter of subsequent parts to the username
        for ($i = 1; $i < count($name_parts); $i++) {
            $username .= substr($name_parts[$i], 0, 1);
        }
        
        $randomNumber = sprintf("%02d", mt_rand(0, 99));
        // Get the current date with month
        $currentDate = date("my");
        // Combine the short names, current date, and random number to create a unique ID
        $new_username = strtoupper($username. $currentDate . $randomNumber);

        // Function to generate random 6-digit number
        function generateRandomNumber() {
            return sprintf("%02d", mt_rand(0, 99));
        }

        // Query to check if username exists
        $sql = "SELECT * FROM tms_admin WHERE user_name = '$new_username'";
        $result =mysqli_query($this->connect,$sql);

        // If username doesn't exist, use the generated username
        if ($result->num_rows === 0) {
            $unique_username = $new_username;
        } 
        else {
            // Generate a unique username
            do {
                $unique_username = $username. $currentDate . generateRandomNumber();
                // Query to check if new username exists
                $sql = "SELECT * FROM tms_admin WHERE user_name = '$unique_username'";
                $result =mysqli_query($this->connect,$sql);

            } while ($result->num_rows > 0);
        }

        // Now $unique_username contains a unique 6-digit username
        $msg_query = "INSERT INTO tms_admin
						SET 
                        user_name = '$unique_username',
						full_name = '$full_name',
						email = '$email', 
						phone = '$phone', 
						password = '$password', 
						type = '$type'";
        
        $result=mysqli_query($this->connect,$msg_query);
     
        if($result){
            //$msg="Account Create succesfully";
            $last_id = mysqli_insert_id($this->connect);
            return $last_id;    
        }
        else{   
            $check=0;
            $msg = 'Message send Failed';
        }

        
    }
    
    /*----Update Admin Password*/
    public function updateAdminPassword($id,$data){
        $newPassword = strip_tags($data['newPassword']);
        
        $sql="UPDATE `tscs_admin` SET password ='$newPassword' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            return $result;
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
    }
    
    /*----Get All User Info----*/
    public function getAllUserInfo(){
		$sql="SELECT * FROM `tms_admin`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get User Info By ID----*/
    public function getUserInfoById($condition){
		$sql="SELECT * FROM `tms_admin` WHERE `id`= '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
    /*----Get Vendor Info By ID----*/
    public function getGetUsernameById($condition){
		$sql="SELECT * FROM `tms_admin` WHERE `id`= '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
            $row = mysqli_fetch_assoc($query_result);
            if($row>0){
                return $row;
            }
            else{
                return "";
            }
			
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
    /*----Get Active User Info By ID----*/
    public function getActiveUserInfo(){
		$sql="SELECT * FROM `tscs_user` WHERE `status`= '1'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Pending User Info By ID----*/
    public function getInactiveUserInfo(){
		$sql="SELECT * FROM `tscs_user` WHERE `status`= '0'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}

    /*------Update User Info------*/
    public function updateUserInfoById($user_id,$data){
        $full_name = strip_tags($data['full_name']);
        $email = strip_tags($data['email']);
        $phone = strip_tags($data['phone']);
        $address = strip_tags($data['address']);
        $gender =strip_tags($data['gender']);
        $profession = strip_tags($data['profession']);
        $organization = strip_tags($data['organization']);
        $designation = strip_tags($data['designation']);
        $qualification = strip_tags($data['qualification']);
        $birth_day = strip_tags($data['birth_day']);
        $membership = strip_tags($data['membership']);
        $status = strip_tags($data['status']);
        
        $sql="UPDATE `tscs_user` SET `full_name`='$full_name',`email`='$email',`phone`='$phone',`address`='$address',`gender`='$gender',`profession`='$profession',`organization`='$organization',`designation`='$designation',`qualification`='$qualification',`birth_day`='$birth_day',`membership`='$membership',`status`='$status' WHERE `id`='$user_id'";
        
		$result=mysqli_query($this->connect,$sql);
        if($result){
            echo "Update successfull";
            header("location:user-profile.php");
        }
    }
    
    /*------User Account Delete------*/
    public function delete_user_account($user_id){
        $sql = "DELETE FROM `tscs_user` WHERE id = '$user_id'";

        $result = mysqli_query($this->connect, $sql);
        if($result){
            return $result;
        }
        else{
            die("Something Went Wrong: " . mysqli_error($this->connect));
        }
    }

    
    /*----Get All Daily report----*/
    public function getAllReport(){
		$sql="SELECT * FROM `daily_report`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}

     /*----Mis Daily Report Found Or Create----*/
    public function checkMisReportFoundOrCreate($data,$date){
        $total_req = "";
        $confirm_req = "";
        $portal_entry = "";
        
        $requirment_qty = strip_tags($data['trans_qty']);
        $app_post = strip_tags($data['app_post_done']);
        $sms_sent = strip_tags($data['sms_sent_done']);
        
        if($app_post==="1"){
            $app_post = $requirment_qty;
        }
        
        if($sms_sent==="1"){
            $sms_sent = $requirment_qty;
        }
        
        $sql="SELECT * FROM `daily_report` WHERE `date`= '$date'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
             // Fetch the row from the result set
            $row = mysqli_fetch_assoc($query_result);

            // Check if a row was found
            if ($row) {
                $daily_report_id = $row['daily_report_id'];

                $total_req = $row['total_req'] + $requirment_qty;
                $confirm_req = $row['confirm_req'] + $requirment_qty;
                $portal_entry = $row['portal_entry'] + $requirment_qty;
                
                $app_post_total = $row['app_post'] + $app_post;
                $sms_sent_total = $row['sms_sent'] + $sms_sent;

                $sql_update = "UPDATE `daily_report` SET 
                                   total_req = '$total_req', 
                                   app_post = '$app_post_total', 
                                   confirm_req = '$confirm_req', 
                                   sms_sent = '$sms_sent_total', 
                                   portal_entry = '$portal_entry' 
                               WHERE `daily_report_id` = '$daily_report_id'";

                $resultSi = mysqli_query($this->connect, $sql_update);

                if ($resultSi) {
                    // Echo the ID
                    return $daily_report_id;
                }
            }
            else {
                $total_req = $requirment_qty;
                $confirm_req = $requirment_qty;
                $portal_entry = $requirment_qty;
                $statement = "Pending";
                
                $sql = "INSERT INTO `daily_report` (`date`, `total_req`, `app_post`, `confirm_req`, `sms_sent`, `portal_entry`, `statement`)
                VALUES ('$date', '$total_req', '$app_post', '$confirm_req', '$sms_sent', '$portal_entry', '$statement')";


                $result = mysqli_query($this->connect, $sql);
                if ($result) {
                    $last_id = mysqli_insert_id($this->connect);
                    return $last_id;
                } 
            }
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
    }
    
   
    /*----mis report save ----*/
    public function save_mis_report($data,$daily_report_id) {
     
        $date = strip_tags($data['date']);
        $load_point = strip_tags($data['load_point']);
        $unload_point = strip_tags($data['unload_point']);
    
        $client_name = strip_tags($data['client_name']);
        $client_type = strip_tags($data['client_type']);
        $req_type = strip_tags($data['req_type']);
        
        $trans_cate = strip_tags($data['trans_cate']);
        $trans_qty = strip_tags($data['trans_qty']);

        $trans_rate = strip_tags($data['trans_rate']);
        $trans_d_rate = strip_tags($data['trans_d_rate']);
        $trans_d_qty = strip_tags($data['trans_d_qty']);
        $trans_cost = strip_tags($data['trans_cost']);

        $labor_qty = strip_tags($data['labor_qty']);
        $labor_rate = strip_tags($data['labor_rate']);
        $labor_over_qty = strip_tags($data['labor_over_qty']);
        $labor_over_rate = strip_tags($data['labor_over_rate']);
        $labor_cost = strip_tags($data['labor_cost']);

        $eq_qty = strip_tags($data['eq_qty']);
        $eq_name = strip_tags($data['eq_name']);
        $eq_rate = strip_tags($data['eq_rate']);
        $eq_d_qty = strip_tags($data['eq_d_qty']);
        $eq_d_rate = strip_tags($data['eq_d_rate']);
        $e_total = strip_tags($data['e_total']);

        $trans_vat = strip_tags($data['trans_vat']);
        $equip_vat = strip_tags($data['equip_vat']);
        $labor_vat = strip_tags($data['labor_vat']);
        $revenue = strip_tags($data['revenue']);

        $app_post_done = strip_tags($data['app_post_done']);
        $sms_sent_done = strip_tags($data['sms_sent_done']);
        
        $bill_status="Not Submited";
        
                 

        $sql = "INSERT INTO `single_requirment`(`daily_report_id`,`date`, `load_point`, `unload_point`, `req_type`, `client_name`, `client_type`, `trans_cate`, `trans_qty`, `trans_rate`, `trans_d_rate`, `trans_d_qty`, `trans_cost`, `labor_qty`, `labor_rate`, `labor_over_qty`, `labor_over_rate`, `labor_cost`,`eq_name`, `eq_qty`, `eq_rate`, `eq_d_qty`, `eq_d_rate`, `e_total`, `trans_vat`, `equip_vat`, `labor_vat`, `revenue`, `app_post_done`, `sms_sent_done`,`bill_status`) VALUES ('$daily_report_id','$date', '$load_point', '$unload_point', '$req_type', '$client_name', '$client_type', '$trans_cate', '$trans_qty', '$trans_rate', '$trans_d_rate', '$trans_d_qty', '$trans_cost', '$labor_qty', '$labor_rate', '$labor_over_qty', '$labor_over_rate', '$labor_cost','$eq_name', '$eq_qty', '$eq_rate', '$eq_d_qty', '$eq_d_rate', '$e_total', '$trans_vat', '$equip_vat', '$labor_vat', '$revenue', '$app_post_done', '$sms_sent_done','$bill_status')";


        $result = mysqli_query($this->connect, $sql);
        if ($result) {
            return $result;
        } else {
            // Log error or handle it as needed
            return false;
        }

    }
    
    
    /*----Get single req Info By ID----*/
    public function getMisReport($condition){

        $condition = mysqli_real_escape_string($this->connect, $condition);
        $sql = "SELECT * FROM `daily_report` WHERE `daily_report_id` = '$condition'";

        $query_result = mysqli_query($this->connect, $sql);

        if($query_result){
            return $query_result;
        } else {
            // Handle error, including the query in the error message for debugging
            die('Something went wrong: ' . mysqli_error($this->connect) . '. SQL: ' . $sql);
        }
    }


    public function updateSingleReport($data, $user_id) {
        // Sanitize the input data
        $date = mysqli_real_escape_string($this->connect, $data['date']);
        $load_point = mysqli_real_escape_string($this->connect, $data['load_point']);
        $unload_point = mysqli_real_escape_string($this->connect, $data['unload_point']);
        $client_name = mysqli_real_escape_string($this->connect, $data['client_name']);
        $client_type = mysqli_real_escape_string($this->connect, $data['client_type']);
        $req_type = mysqli_real_escape_string($this->connect, $data['req_type']);
        $trans_cate = mysqli_real_escape_string($this->connect, $data['trans_cate']);
        $trans_qty = mysqli_real_escape_string($this->connect, $data['trans_qty']);
        $trans_rate = mysqli_real_escape_string($this->connect, $data['trans_rate']);
        $trans_d_rate = mysqli_real_escape_string($this->connect, $data['trans_d_rate']);
        $trans_d_qty = mysqli_real_escape_string($this->connect, $data['trans_d_qty']);
        $trans_cost = mysqli_real_escape_string($this->connect, $data['trans_cost']);
        $labor_qty = mysqli_real_escape_string($this->connect, $data['labor_qty']);
        $labor_rate = mysqli_real_escape_string($this->connect, $data['labor_rate']);
        $labor_over_qty = mysqli_real_escape_string($this->connect, $data['labor_over_qty']);
        $labor_over_rate = mysqli_real_escape_string($this->connect, $data['labor_over_rate']);
        $labor_cost = mysqli_real_escape_string($this->connect, $data['labor_cost']);
        $labor_vat = mysqli_real_escape_string($this->connect, $data['labor_vat']);
        $eq_qty = mysqli_real_escape_string($this->connect, $data['eq_qty']);
        $eq_name = mysqli_real_escape_string($this->connect, $data['eq_name']);
        $eq_rate = mysqli_real_escape_string($this->connect, $data['eq_rate']);
        $eq_d_qty = mysqli_real_escape_string($this->connect, $data['eq_d_qty']);
        $eq_d_rate = mysqli_real_escape_string($this->connect, $data['eq_d_rate']);
        $e_total = mysqli_real_escape_string($this->connect, $data['e_total']);
        $trans_vat = mysqli_real_escape_string($this->connect, $data['trans_vat']);
        $equip_vat = mysqli_real_escape_string($this->connect, $data['equip_vat']);
        $revenue = mysqli_real_escape_string($this->connect, $data['revenue']);
        $app_post_done = mysqli_real_escape_string($this->connect, $data['app_post_done']);
        $sms_sent_done = mysqli_real_escape_string($this->connect, $data['sms_sent_done']);

        // SQL query
        $sql = "UPDATE `single_requirment` 
                SET 
                    `date` = '$date',
                    `load_point` = '$load_point',
                    `unload_point` = '$unload_point',
                    `req_type` = '$req_type',
                    `client_name` = '$client_name',
                    `client_type` = '$client_type',
                    `trans_cate` = '$trans_cate',
                    `trans_qty` = '$trans_qty', 
                    `trans_rate` = '$trans_rate',
                    `trans_d_rate` = '$trans_d_rate',
                    `trans_d_qty` = '$trans_d_qty',
                    `trans_cost` = '$trans_cost',
                    `labor_qty` = '$labor_qty',
                    `labor_rate` = '$labor_rate',
                    `labor_over_qty` = '$labor_over_qty',
                    `labor_over_rate` = '$labor_over_rate',
                    `labor_cost` = '$labor_cost',
                    `labor_vat` = '$labor_vat',
                    `eq_name` = '$eq_name',
                    `eq_qty` = '$eq_qty',
                    `eq_rate` = '$eq_rate',
                    `eq_d_qty` = '$eq_d_qty',
                    `eq_d_rate` = '$eq_d_rate',
                    `e_total` = '$e_total',
                    `equip_vat` = '$equip_vat',
                    `revenue` = '$revenue',
                    `app_post_done` = '$app_post_done',
                    `sms_sent_done` = '$sms_sent_done'
                WHERE `id` = '$user_id'";

        // Execute query
        $result = mysqli_query($this->connect, $sql);

        if ($result) {
            return true;
        } else {
            // Log error or handle it as needed
            error_log("Failed to update single requirement: " . mysqli_error($this->connect));
            return false;
        }
    }

    
     /*------Update single Report------*/
    public function update_single_report($user_id){
      
        $sms_sent_done = "1";

        $sql = "UPDATE `single_requirment` SET  `sms_sent_done`='$sms_sent_done' WHERE `id`='$user_id'";

        $result = mysqli_query($this->connect, $sql);
        if ($result) {
            return $result;
            /*echo "Update successful";
            header("Location: index.php");
            exit;*/ // Make sure to exit after header redirection
        } else {
            echo "Error updating record: " . mysqli_error($this->connect);
        }
    }  

    
    /*----getAllSaleAmount-----*/
    public function getAllSaleAndRevenueAmount($id, $data){
        $sql = "SELECT * FROM `single_requirment` WHERE `daily_report_id`= '$id'";
        $query_result = mysqli_query($this->connect, $sql);
        if ($query_result) {
            $total_amount = 0; // Initialize the total sale to zero
            // Fetch the rows from the result set
            while ($userData = mysqli_fetch_array($query_result)) {
                $amount = $userData[$data];
                $total_amount += $amount; // Sum up the prices
            }
        } else {
            die('Something wrong: ' . mysqli_error($this->connect));
        }
        return $total_amount; // Return the total sale amount
    }

    /*----getDailyReport-----*/
    public function getDailyReport(){
        $sql = "SELECT * FROM `single_requirment`";
        $query_result = mysqli_query($this->connect, $sql);
        if ($query_result) {
            return $query_result;
        } else {
            die('Something wrong: ' . mysqli_error($this->connect));
        }
        return $total_amount; // Return the total sale amount
    }
    
    /*----Get single req Info By ID----*/
    public function getInfSingleById($condition){
        $sql="SELECT * FROM `single_requirment` WHERE `id`= '$condition'";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }

    }
    
    /*----Bil report save ----*/
    public function save_bil_report($data,$date_formatted) {
        $date = $date_formatted;

        $client_name = strip_tags($data['client_name']);
        $destination = strip_tags($data['destination']);
        $trans_cate = strip_tags($data['trans_cate']);
        $transport_qty = strip_tags($data['transport_qty']);
        $labour_qty = strip_tags($data['labour_qty']);
        $transport_rate = strip_tags($data['transport_rate']);
        $labour_rate = strip_tags($data['labour_rate']);
        $demarage_rate = strip_tags($data['demarage_rate']);
        $transport_amount_vout = strip_tags($data['transport_amount_vout']);
        $labour_v_out = strip_tags($data['labour_v_out']);
        $equipment = strip_tags($data['equipment']);
        $trans_vat = strip_tags($data['trans_vat']);
        $labour_vat = strip_tags($data['labour_vat']);
        $trans_with_vat = strip_tags($data['trans_with_vat']);
        $labour_with_vat = strip_tags($data['labour_with_vat']);


        $sql = "INSERT INTO `bill_report` (`date`, `client_name`, `destination`, `trans_cate`, `transport_qty`, `labour_qty`, `transport_rate`, `labour_rate`, `demarage_rate`, `transport_amount_vout`, `labour_v_out`, `equipment`, `trans_vat`, `labour_vat`, `trans_with_vat`, `labour_with_vat`) VALUES ('$date', '$client_name', '$destination', '$trans_cate', '$transport_qty', '$labour_qty', '$transport_rate', '$labour_rate', '$demarage_rate', '$transport_amount_vout', '$labour_v_out', '$equipment', '$trans_vat', '$labour_vat', '$trans_with_vat', '$labour_with_vat')";

        $result = mysqli_query($this->connect, $sql);
        if ($result) {    
            return $result;
                
        } 
        else {
            // Log error or handle it as needed
            return false;
        }
   }
    
    
      
    /*------Save Single Trip--------*/
    public function save_trip($data){

        $date = strip_tags($data['date']);
        $dealer_name = strip_tags($data['dealer_name']);
        $load_point = strip_tags($data['load_point']);
        $unload_point = strip_tags($data['unload_point']);
        $rent_amount = strip_tags($data['rent_amount']);
        $vehicle_no = strip_tags($data['vehicle_no']);
        $driver_name = strip_tags($data['driver_name']);
        $driver_mobile = strip_tags($data['driver_mobile']);
        $product_type = strip_tags($data['product_type']);
        $product_qty = strip_tags($data['product_qty']);
        $chalan_no = strip_tags($data['chalan_no']);
        $sms_sent = strip_tags($data['sms_sent']);

        $status="pending";


        $sql = "INSERT INTO `single_trip`
        (`date`, `dealer_name`, `load_point`, `unload_point`, `rent_amount`, `vehicle_no`, `driver_name`, `driver_mobile`, `product_type`, `product_qty`, `chalan_no`, `sms_sent`, `status`)
        VALUES
        ('$date', '$dealer_name', '$load_point', '$unload_point', '$rent_amount', '$vehicle_no', '$driver_name', '$driver_mobile', '$product_type', '$product_qty', '$chalan_no', '$sms_sent', '$status')";


        $query_result = mysqli_query($this->connect, $sql);

        if($query_result){
            return $query_result;
        } else {
            // Handle error, including the query in the error message for debugging
            die('Something went wrong: ' . mysqli_error($this->connect) . '. SQL: ' . $sql);
        }

    }
    
    
    /*----Get All Daily report----*/
    public function getAllMisReport(){
		$sql="SELECT * FROM `single_trip`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
      
    
    /*----Save New vendor----*/
    public function save_new_vendor($data) {
    
        $vendor_name = strip_tags($data['vendor_name']);
        $vendor_mobile = strip_tags($data['vendor_mobile']);
        $vendor_email = strip_tags($data['vendor_email']);
        $join_date = strip_tags($data['join_date']);
        $rent_cate = strip_tags($data['rent_cate']);
        $work_area = strip_tags($data['work_area']);
        $status = strip_tags($data['status']);


        $sql = "INSERT INTO `vendor` (`vendor_name`, `vendor_mobile`, `vendor_email`, `rent_cate`, `work_area`, `status`, `join_date`) VALUES ('$vendor_name', '$vendor_mobile', '$vendor_email', '$rent_cate', '$work_area', '$status', '$join_date')";

        $result = mysqli_query($this->connect, $sql);
        if ($result) {    
            return $result;  
        } 
        else {
            // Log error or handle it as needed
            die('Something wrong'.mysqli_error($this->connect));
        }
   }
    
    
    /*----Get All Vendor List----*/
    public function getVendorList(){
		$sql="SELECT * FROM `vendor`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
    /*----Get Vendor Info By ID----*/
    public function getVendorInfoById($condition){
		$sql="SELECT * FROM `vendor` WHERE `id`= '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Update Vendor Info By ID----*/
    public function UpdateVendorInfo($data,$user_id){
        $vendor_name = mysqli_real_escape_string($this->connect, $data['vendor_name']);
        $vendor_mobile = mysqli_real_escape_string($this->connect, $data['vendor_mobile']);
        $vendor_email = mysqli_real_escape_string($this->connect, $data['vendor_email']);
        $rent_cate = mysqli_real_escape_string($this->connect, $data['rent_cate']);
        $work_area = mysqli_real_escape_string($this->connect, $data['work_area']);

        $join_date=mysqli_real_escape_string($this->connect,$data['join_date']);
        $status = mysqli_real_escape_string($this->connect, $data['status']);

            
        $sql = "UPDATE `vendor` SET 
        `vendor_name` = '$vendor_name',
        `vendor_mobile` = '$vendor_mobile',
        `vendor_email` = '$vendor_email',
        `rent_cate` = '$rent_cate',
        `work_area` = '$work_area',
        `status` = '$status',
        `join_date` = '$join_date'
        WHERE `id` = '$user_id'";
    


	
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return true;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Vendor Info By ID----*/
    public function getVendorNameById($condition){
		$sql="SELECT * FROM `vendor` WHERE `id`= '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
            $row = mysqli_fetch_assoc($query_result);
            if($row>0){
                return $row['vendor_name'];
            }
            else{
                return "Own Transport";
            }
			
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
    /*----Delete Vendor Info By ID-----*/
    public function deleteVendorById($id){
        
		$sql="DELETE FROM vendor WHERE id='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			$_SESSION['message']="Sucessfully Deleted";
			header('Location:vendor-list.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
    /*-----Save New Vehicle-----*/
    public function save_new_vehicle($data) {
    
        $vendor_id = strip_tags($data['vendor_id']);
        $vehicle_name = strip_tags($data['vehicle_name']);
        $vehicle_category = strip_tags($data['vehicle_category']);
        $vehicle_size = strip_tags($data['vehicle_size']);
        $vehicle_zone = strip_tags($data['vehicle_zone']);
        $vehicle_serial = strip_tags($data['vehicle_serial']);
        $vehicle_number = strip_tags($data['vehicle_number']);
        $vehicle_status = strip_tags($data['vehicle_status']);
        $join_date = strip_tags($data['join_date']);
        
        
        $sql = "INSERT INTO `vehicle` (`vendor_id`, `vehicle_name`, `vehicle_category`, `vehicle_size`, `vehicle_zone`, `vehicle_serial`,  `vehicle_number`,`start_service`, `vehicle_status`) VALUES ('$vendor_id', '$vehicle_name', '$vehicle_category', '$vehicle_size', '$vehicle_zone', '$vehicle_serial', '$vehicle_number', '$join_date', '$vehicle_status')";

        $result = mysqli_query($this->connect, $sql);
        if ($result) { 
            
            if($vendor_id>0){
                $sql="SELECT * FROM `vendor` WHERE `id`='$vendor_id'";
                $query_result=mysqli_query($this->connect,$sql);
                if($query_result){
                    // Fetch the row from the result set
                    $row = mysqli_fetch_assoc($query_result);

                    // Check if a row was found
                    if ($row) {
                        // Echo the ID
                        $vehicle = $row['no_vehicle']+1;
                        
                        // Corrected SQL query
                        $sql = "UPDATE vendor SET no_vehicle = '$vehicle' WHERE id = '$vendor_id'";

                        // Execute the query
                        $result = mysqli_query($this->connect, $sql);

                        // Check if the update was successful
                        if ($result) {
                            return $result;
                        }else {
                            return false;
                        }
                    } 

                }
            }
            
            return $result;  
        } 
        else {
            // Log error or handle it as needed
            die('Something wrong'.mysqli_error($this->connect));
        }
        
        
        
    }
    
    
    /*-----Update Vehicle-----*/
    public function update_vehi($data, $user_id) {
        // Sanitize input
        $vendor_id = mysqli_real_escape_string($this->connect, strip_tags($data['vendor_id']));
        $vehicle_name = mysqli_real_escape_string($this->connect, strip_tags($data['vehicle_name']));
        $vehicle_category = mysqli_real_escape_string($this->connect, strip_tags($data['vehicle_category']));
        $vehicle_size = mysqli_real_escape_string($this->connect, strip_tags($data['vehicle_size']));
        $vehicle_zone = mysqli_real_escape_string($this->connect, strip_tags($data['vehicle_zone']));
        $vehicle_serial = mysqli_real_escape_string($this->connect, strip_tags($data['vehicle_serial']));
        $vehicle_number = mysqli_real_escape_string($this->connect, strip_tags($data['vehicle_number']));
        $vehicle_status = mysqli_real_escape_string($this->connect, strip_tags($data['vehicle_status']));

        // Corrected SQL query
        $sql = "UPDATE `vehicle` SET
            `vendor_id` = '$vendor_id',
            `vehicle_name` = '$vehicle_name',
            `vehicle_category` = '$vehicle_category',
            `vehicle_size` = '$vehicle_size',
            `vehicle_zone` = '$vehicle_zone',
            `vehicle_serial` = '$vehicle_serial',
            `vehicle_number` = '$vehicle_number',
            `vehicle_status` = '$vehicle_status'
            WHERE `id` = '$user_id'"; // Removed the extra comma

        // Execute the query
        $result = mysqli_query($this->connect, $sql);

        // Check if the update was successful
        if ($result) {
            return $result;
        } else {
            die('Something went wrong: ' . mysqli_error($this->connect));
        }
    }
    
    
    /*----Get All Vehicle List----*/
    public function getVehicleList(){
		$sql="SELECT * FROM `vehicle`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Vehicle Info By ID----*/
    public function getvehicleInfoById($use_id){
		$sql="SELECT * FROM `vehicle` WHERE `id`= '$use_id'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
    /*----Delete Vehicle Info By ID-----*/
    public function deleteVehicleById($id){
        
		$sql="DELETE FROM vehicle WHERE id='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			$_SESSION['message']="Sucessfully Deleted";
			header('Location:vehicle-list.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
    
    
    /*-----Save New Dealer-----*/
    public function save_new_dealer($data) {
    
        $dealer_name = strip_tags($data['dealer_name']);
        $dealer_mobile = strip_tags($data['dealer_mobile']);
        $dealer_email = strip_tags($data['dealer_email']);
        $dealer_nid = strip_tags($data['dealer_nid']);
        $emergency_contact = strip_tags($data['emergency_contact']);
        $business_name = strip_tags($data['business_name']);
        $business_type = strip_tags($data['business_type']);
        $address = strip_tags($data['address']);
        $district = strip_tags($data['district']);
        $join_date = strip_tags($data['join_date']);
        $status = strip_tags($data['status']);
        
        
        $sql = "INSERT INTO `dealer` (`dealer_name`, `dealer_mobile`, `dealer_email`, `dealer_nid`, `emergency_contact`, `business_name`,  `business_type`,`district`, `address`, `join_date`, `status`) VALUES ('$dealer_name', '$dealer_mobile', '$dealer_email', '$dealer_nid', '$emergency_contact', '$business_name', '$business_type', '$district','$address','$join_date', '$status')";

        $result = mysqli_query($this->connect, $sql);
        if ($result) {    
            return $result;  
        } 
        else {
            // Log error or handle it as needed
            die('Something wrong'.mysqli_error($this->connect));
        }
   }
    
   
    /*----Get All Dealer List----*/
    public function getDealerList(){
		$sql="SELECT * FROM `dealer`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
    /*----Delete Dealer Info By ID-----*/
    public function deleteDealerById($id){
        
		$sql="DELETE FROM dealer WHERE id='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			$_SESSION['message']="Sucessfully Deleted";
			header('Location:dealer-list.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
    /*---- Dealer Info By ID-----*/
    public function getDealerById($user_id){
        
		$sql="SELECT * FROM `dealer` WHERE id='$user_id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
		
            
            return $result;
			//header('Location:dealer-list.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
    
    /*---- Update Dealer Info By ID -----*/
    public function updateDealerById($data, $user_id) {
        // Sanitize the input data
        $dealer_name = mysqli_real_escape_string($this->connect, $data['dealer_name']);
        $dealer_mobile = mysqli_real_escape_string($this->connect, $data['dealer_mobile']);
        $dealer_email = mysqli_real_escape_string($this->connect, $data['dealer_email']);
        $dealer_nid = mysqli_real_escape_string($this->connect, $data['dealer_nid']);
        $emergency_contact = mysqli_real_escape_string($this->connect, $data['emergency_contact']);
        $business_name = mysqli_real_escape_string($this->connect, $data['business_name']);
        $business_type = mysqli_real_escape_string($this->connect, $data['business_type']);
        $address = mysqli_real_escape_string($this->connect, $data['address']);
        $district = mysqli_real_escape_string($this->connect, $data['district']);
        $join_date = mysqli_real_escape_string($this->connect, $data['join_date']);
        $status = mysqli_real_escape_string($this->connect, $data['status']);

        // Prepare the SQL update query
        $sql = "UPDATE `dealer` SET 
                    `dealer_name` = '$dealer_name',
                    `dealer_mobile` = '$dealer_mobile',
                    `dealer_email` = '$dealer_email',
                    `dealer_nid` = '$dealer_nid',
                    `emergency_contact` = '$emergency_contact',
                    `business_name` = '$business_name',
                    `business_type` = '$business_type',
                    `address` = '$address',
                    `district` = '$district',
                    `join_date` = '$join_date',
                    `status` = '$status'
                WHERE `id` = '$user_id'";

        // Execute the query
        $result = mysqli_query($this->connect, $sql);

        if ($result) {
            return true; // Return true if the update was successful
        } else {
            // Improved error handling
            throw new Exception("Something Went Wrong: " . mysqli_error($this->connect));
        }
    }


    /*----Update Dealer Account Info By ID-----*/
    public function updateDealerAccountById($id, $user_id){
        $sql="UPDATE `dealer` SET user_account ='$user_id' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            header('location:dealers.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}

    
    
    
    
    
    
    /*----Get All Bill Info----*/
    public function getAllBillInfo(){
		$sql="SELECT * FROM `bill_report`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get All team member Info----*/
    public function getAllTeamInfo(){
        $sql="SELECT * FROM `tscs_meet_the_team`";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }

    }

    /*----Get team Info By ID----*/
    public function getteamInfoById($condition){
		$sql="SELECT * FROM `tscs_meet_the_team` WHERE `id`= '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}

    /*------Update Team Info------*/
    public function updateTeamInfoById($user_id,$data){
        // $news_title = mysqli_real_escape_string($this->connect, $data['news_title']);

        $full_name = mysqli_real_escape_string($this->connect, $data['full_name']);
        $credentials = mysqli_real_escape_string($this->connect, $data['credentials']);
        $designation = mysqli_real_escape_string($this->connect, $data['designation']);
        $designation2 = mysqli_real_escape_string($this->connect, $data['designation2']);
        $fb_link = mysqli_real_escape_string($this->connect, $data['fb_link']);
        $twitter_link = mysqli_real_escape_string($this->connect, $data['twitter_link']);
        $linkedin_link = mysqli_real_escape_string($this->connect, $data['linkedin_link']);
        $status = mysqli_real_escape_string($this->connect, $data['status']);


        $sql="UPDATE `tscs_meet_the_team` SET `full_name`='$full_name',`credentials`='$credentials',`designation`='$designation',`designation2`='$designation2',`fb_link`='$fb_link',`twitter_link`='$twitter_link',`linkedin_link`='$linkedin_link',`status`='$status', WHERE `id`='$user_id'";

        $result=mysqli_query($this->connect,$sql);
        if($result){
            // echo "Update successfull";
            header("location:team-edit.php");
        }

    }

    /*----Get All Order Info----*/
    public function getAllOrderInfo(){
		$sql="SELECT * FROM `tscs_order_info`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Total Event Registration Info----*/
    public function getEventRegisteredInfo(){
		$sql = "SELECT * FROM `tscs_event_regi_form`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Event List Info----*/
    public function getEventListInfo(){
		$sql="SELECT * FROM `tscs_event_list` WHERE publish= '1'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Magazine List Info----*/
    public function getMagazineListInfo(){
		$sql="SELECT * FROM `tscs_shop_item_list` WHERE item_status= '1'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Online Magazine List Info----*/
    public function getOnlineMagazineListInfo(){
		$sql="SELECT * FROM `tscs_shop_item_list` WHERE item_status= '1' AND item_online='1'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Blog List Info----*/
    public function getBlogListInfo(){
		$sql="SELECT * FROM `tscs_blog` WHERE publish= '1'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Blog List Info----*/
    public function getContactMessageListInfo(){
		$sql="SELECT * FROM `tscs_msg_contact`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get News & Media Partner Info----*/
    public function getAllNewsPartnerInfo(){
		$sql="SELECT * FROM `tscs_news_partner` ORDER BY partner_id ASC";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Create and added News & Media Partner----*/
    public function setNewNewsPartner($condition){
        $sql = "INSERT INTO tscs_news_partner SET partner_name = '$condition'";

        
        $result=mysqli_query($this->connect,$sql);
     
        if($result){
            return $result;
        }
    }

    /*----Get All News Info----*/
    public function getActiveNewsInfo(){
		$sql="SELECT * FROM `tscs_news_and_media` ORDER BY id DESC";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}

    /*----Get Last News ID----*/
    public function getLastNewsIdInfo(){
		$sql="SELECT id FROM tscs_news_and_media ORDER BY id DESC LIMIT 1";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
            // Fetch the row from the result set
            $row = mysqli_fetch_assoc($query_result);

            // Check if a row was found
            if ($row) {
                // Echo the ID
                return $row['id'];
            } else {
                return "0";
            }
			
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
    /*----Save News & Media ----*/
    public function save_news_and_media($news_image, $data){
        $news_title = mysqli_real_escape_string($this->connect, $data['news_title']);
        $news_link = mysqli_real_escape_string($this->connect, $data['news_link']);
        $news_partner = strip_tags($data['news_partner']);
        $news_date = strip_tags($data['news_date']);
        $status = 1;

        $sql = "INSERT INTO `tscs_news_and_media`(news_title, news_image, news_link, news_partner, news_date, status) VALUES ('$news_title', '$news_image', '$news_link', '$news_partner', '$news_date', '$status')";

        $result = mysqli_query($this->connect, $sql);
        if($result){
            return $result;
        }
    }
    
    /*----Update News & Media By Id----*/
    public function updateNewsById($id,$data){
        $news_title = mysqli_real_escape_string($this->connect, $data['news_title']);
        $news_link = mysqli_real_escape_string($this->connect, $data['news_link']);
        $news_partner = strip_tags($data['news_partner']);
        $news_date = strip_tags($data['news_date']);
        
		$sql="UPDATE `tscs_news_and_media` SET `news_title`='$news_title',`news_link`='$news_link',`news_partner`='$news_partner',`news_date`='$news_date' WHERE `id`='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			return $result;
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
      
    /*----Update News & Media With Image By Id----*/
    public function updateNewsWithImageById($id,$news_image,$data){
        $news_title = mysqli_real_escape_string($this->connect, $data['news_title']);
        $news_link = mysqli_real_escape_string($this->connect, $data['news_link']);
        $news_partner = strip_tags($data['news_partner']);
        $news_date = strip_tags($data['news_date']);
        
		$sql="UPDATE `tscs_news_and_media` SET `news_title`='$news_title',`news_image`='$news_image',`news_link`='$news_link',`news_partner`='$news_partner',`news_date`='$news_date' WHERE `id`='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			return $result;
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}

    /*----Get News & Media Info By ID----*/
    public function getNewsInfoById($condition){
		$sql="SELECT * FROM `tscs_news_and_media` WHERE `id`= '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Update News & Media Status By ID-----*/
    public function updateNewsStatusById($id, $status){
        $sql="UPDATE `tscs_news_and_media` SET status ='$status' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            header('location:news-and-media.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    /*----Delete News & Media By ID-----*/
    public function deleteNewsById($id){
        $sqlDelete="SELECT * FROM `tscs_news_and_media` WHERE id= '$id'";
		$query_delete=mysqli_query($this->connect,$sqlDelete);
        $row = mysqli_fetch_assoc($query_delete);
        unlink("../assets/img/news/".$row['news_image']);
        
		$sql="DELETE FROM tscs_news_and_media WHERE id='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			$_SESSION['message']="Sucessfully Deleted";
			header('Location:news-and-media.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
     
    /*----Save Slide Image Upload ----*/
    public function save_slide_image_upload($slide_image, $data){
        $slide_title = mysqli_real_escape_string($this->connect, $data['slide_title']);
        $slide_link = mysqli_real_escape_string($this->connect, $data['slide_link']);
        $status = 1;
        
        $sql = "SELECT * FROM `tscs_slide_image` ORDER BY CAST(slide_priority AS UNSIGNED) DESC LIMIT 1";
        $query_result = mysqli_query($this->connect, $sql);

        if ($query_result) {
            $row = mysqli_fetch_assoc($query_result);
            $max_id = $row['slide_priority'];
            $row_count = $max_id+1;
            
            $sql = "INSERT INTO `tscs_slide_image`(slide_priority, slide_title, slide_link, slide_image, status) VALUES ('$row_count','$slide_title', '$slide_link', '$slide_image', '$status')";

            $result = mysqli_query($this->connect, $sql);
            if($result){
                return $result;
            }
        }

        
    }
    
    
     /*-----Get All Slide Image -----*/
    public function getAllSlideImage(){
        $sql = "SELECT * FROM `tscs_slide_image` ORDER BY CAST(priority_id AS UNSIGNED) ASC";

		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
    }
    
    
    /*----Update Slide Image Status By ID-----*/
    public function updateSlideImageStatusById($id, $status){
        $sql="UPDATE `tscs_slide_image` SET status ='$status' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            header('location:web-control.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    /*----Delete Slide Image By ID-----*/
    public function deleteSlideImageById($id){
        $sqlDelete="SELECT * FROM `tscs_slide_image` WHERE id= '$id'";
		$query_delete=mysqli_query($this->connect,$sqlDelete);
        $row = mysqli_fetch_assoc($query_delete);
        unlink("../assets/img/dashboard/slide/".$row['slide_image']);
        
		$sql="DELETE FROM tscs_slide_image WHERE id='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			$_SESSION['message']="Sucessfully Deleted";
			header('Location:web-control.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
    /*----Update Position Move Up Slide Image -----*/
    public function updateSlidePositionMoveUpById($id, $priority){
        $priorityMin = $priority-1;
        while ($priorityMin > 0) {
            // Query to check if records exist with the current priority_id
            $sql = "SELECT `id`, `priority_id`
                    FROM `tscs_slide_image`
                    WHERE `priority_id` = $priorityMin";

            $result=mysqli_query($this->connect,$sql);
            if ($result->num_rows > 0) {
                // Records found, display them
                while ($row = $result->fetch_assoc()) {
                    
                    //set Priority id
                    $lessId = $row["id"];
                    $lessPriority = $row["priority_id"];
                    // Display other fields as needed
                    
                    $sql_first="UPDATE `tscs_slide_image` SET priority_id ='$lessPriority' WHERE `id`='$id' "; 
                    $sql_sec="UPDATE `tscs_slide_image` SET priority_id ='$priority' WHERE `id`='$lessId' "; 
        
                    $result=mysqli_query($this->connect,$sql_first);
                    if($result){
                        $result_sec = mysqli_query($this->connect,$sql_sec);
                        if($result_sec){
                            return "Position: " . $priority . " Move- up: " . $lessPriority ;
                        }
                        
                    }
                }
                break; // Exit the loop since records are found
            } else {
                // Records not found, decrement priority_id and continue the loop
                $priorityMin--;
            }
        }
        

	}
    
    /*----Update Position Move Down Slide Image -----*/
    public function updateSlidePositionMoveDownById($id, $priority){
        $sql = "SELECT * FROM `tscs_slide_image` ORDER BY CAST(priority_id AS UNSIGNED) DESC LIMIT 1";
        $query_result = mysqli_query($this->connect, $sql);

        if ($query_result) {
            $row = mysqli_fetch_assoc($query_result);
            $max_id = $row['priority_id'];
            
            $priorityPlus = $priority+1;
            while ($priorityPlus <= $max_id) {
                // Query to check if records exist with the current priority_id
                $sql = "SELECT `id`, `priority_id`
                        FROM `tscs_slide_image`
                        WHERE `priority_id` = $priorityPlus";

                $result=mysqli_query($this->connect,$sql);
                if ($result->num_rows > 0) {
                    // Records found, display them
                    while ($row = $result->fetch_assoc()) {
                        
                        //set Priority id
                        $upId = $row["id"];
                        $upPriority = $row["priority_id"];
                        // Display other fields as needed

                        $sql_first="UPDATE `tscs_slide_image` SET priority_id ='$upPriority' WHERE `id`='$id' "; 
                        $sql_sec="UPDATE `tscs_slide_image` SET priority_id ='$priority' WHERE `id`='$upId' "; 

                        $result=mysqli_query($this->connect,$sql_first);
                        if($result){
                            $result_sec = mysqli_query($this->connect,$sql_sec);
                            if($result_sec){
                                return "Position: " . $priority . " Move- Down: " . $upPriority ;
                            }

                        }
                    }
                    break; // Exit the loop since records are found
                } else {
                    // Records not found, decrement priority_id and continue the loop
                    $priorityPlus++;
                }
            }
        }
        
        
       /* $sql="UPDATE `tscs_slide_image` SET status ='$status' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            header('location:web-control.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }*/
	}
    
    
   /*----Save Create Gallery ----*/
    public function save_create_gallery($data){
        $img_category = mysqli_real_escape_string($this->connect, $data['img_category']);
        $img_title = mysqli_real_escape_string($this->connect, $data['img_title']);
        $img_event_date = strip_tags($data['img_event_date']);
        $status = 1;

        $sql = "INSERT INTO `tscs_photo_gallery`(img_category, img_title, img_event_date, status) VALUES ('$img_category', '$img_title', '$img_event_date', '$status')";

        $result = mysqli_query($this->connect, $sql);
        if($result){
            return $result;
        }
    }
     
    /*----Get Gallery Info----*/
    public function getAllGalleryInfo(){
		$sql="SELECT * FROM `tscs_photo_gallery` ORDER BY id ASC";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Gallery Info By ID----*/
    public function getGalleryInfoById($condition){
		$sql="SELECT * FROM `tscs_photo_gallery` WHERE `id`= '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Update Gallery Info By Id----*/
    public function updateGalleryInfoById($id,$data){
        $img_category = mysqli_real_escape_string($this->connect, $data['img_category']);
        $img_title = mysqli_real_escape_string($this->connect, $data['img_title']);
        $img_event_date = strip_tags($data['img_event_date']);
       
        
		$sql="UPDATE `tscs_photo_gallery` SET `img_category`='$img_category',`img_title`='$img_title',`img_event_date`='$img_event_date' WHERE `id`='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			header('location:gallery-event-list.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
    /*----Update Gallery Info Status By ID-----*/
    public function updateGalleryStatusById($id, $status){
        $sql="UPDATE `tscs_photo_gallery` SET status ='$status' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            header('location:gallery-event-list.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    /*----Delete Gallery Info By ID-----*/
    public function deleteGalleryById($id){
        
		$sql="DELETE FROM tscs_photo_gallery WHERE id='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			$_SESSION['message']="Sucessfully Deleted";
			header('Location:gallery-event-list.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
   /*----Save Gallery ----*/
    public function save_gallery_photo($gallery_id,$new_filename,$file_extension){
        $status = 1;
        
        
        $sql = "INSERT INTO `tscs_upload_file`(gallery_id, file_link, file_type, file_status) VALUES ('$gallery_id', '$new_filename', '$file_extension', '$status')";

        $result = mysqli_query($this->connect, $sql);
        if($result){
            return $result;
        }
    }
    
    /*----Get Gallery Photo Info----*/
    public function getAllGalleryPhotoInfo(){
		$sql="SELECT * FROM `tscs_upload_file` ORDER BY id DESC";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Update Slide Image Status By ID-----*/
    public function updateGalleryPhotoStatusById($id, $status){
        $sql="UPDATE `tscs_upload_file` SET file_status ='$status' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            header('location:gallery-photo.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
      
    /*----Delete Slide Image By ID-----*/
    public function deleteGalleryPhotoById($id){
        $sqlDelete="SELECT * FROM `tscs_upload_file` WHERE id= '$id'";
		$query_delete=mysqli_query($this->connect,$sqlDelete);
        $row = mysqli_fetch_assoc($query_delete);
        unlink("../assets/img/gallery/big/".$row['file_link']);
        unlink("../assets/img/gallery/small/".$row['file_link']);
        
		$sql="DELETE FROM tscs_upload_file WHERE id='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			$_SESSION['message']="Sucessfully Deleted";
			header('Location:gallery-photo.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
   /*----Save Gallery Video----*/
    public function save_gallery_video($new_filename,$data){
        $video_link = mysqli_real_escape_string($this->connect, $data['video_link']);
        $video_type = mysqli_real_escape_string($this->connect, $data['video_type']);
        $status = 1;
        
        
        $sql = "INSERT INTO `tscs_video_gallery`(video_thum, video_link, video_type, status) VALUES ('$new_filename', '$video_link', '$video_type', '$status')";

        $result = mysqli_query($this->connect, $sql);
        if($result){
            header('location:gallery-video.php');
        }
    }
    
    /*----Get Gallery Video Info----*/
    public function getAllGalleryVideoInfo(){
		$sql="SELECT * FROM `tscs_video_gallery` ORDER BY id DESC";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Get Gallery Video Info By ID----*/
    public function getGalleryVideoInfoById($condition){
		$sql="SELECT * FROM `tscs_video_gallery` WHERE `id`= '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Update Gallery Video Info With out Thum By Id----*/
    public function updateGalleryVideoInfoById($id,$data){
        $video_link = mysqli_real_escape_string($this->connect, $data['video_link']);
        $video_type = mysqli_real_escape_string($this->connect, $data['video_type']);
       
        
		$sql="UPDATE `tscs_video_gallery` SET `video_link`='$video_link',`video_type`='$video_type' WHERE `id`='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			header('location:gallery-video.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
    /*----Update Gallery Video Info With thum By Id----*/
    public function updateGalleryVideoInfoWithImageById($id,$new_filename,$data){
        $video_link = mysqli_real_escape_string($this->connect, $data['video_link']);
        $video_type = mysqli_real_escape_string($this->connect, $data['video_type']);
        
        $sqlDelete="SELECT * FROM `tscs_video_gallery` WHERE id= '$id'";
		$query_delete=mysqli_query($this->connect,$sqlDelete);
        $row = mysqli_fetch_assoc($query_delete);
        unlink("../assets/img/gallery/thum/".$row['video_thum']);
       
        
		$sql="UPDATE `tscs_video_gallery` SET `video_thum`='$new_filename',`video_link`='$video_link',`video_type`='$video_type' WHERE `id`='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			header('location:gallery-video.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
    
    /*----Update Gallery Video Status By ID-----*/
    public function updateGalleryVideoStatusById($id, $status){
        $sql="UPDATE `tscs_video_gallery` SET status ='$status' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            header('location:gallery-video.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    /*----Delete Gallery Video By ID-----*/
    public function deleteGalleryVideoById($id){
        $sqlDelete="SELECT * FROM `tscs_video_gallery` WHERE id= '$id'";
		$query_delete=mysqli_query($this->connect,$sqlDelete);
        $row = mysqli_fetch_assoc($query_delete);
        unlink("../assets/img/gallery/thum/".$row['video_thum']);
        
		$sql="DELETE FROM tscs_video_gallery WHERE id='$id'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			$_SESSION['message']="Sucessfully Deleted";
			header('Location:gallery-video.php');
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    
   /*----Save New Event----*/
    public function save_new_event($date, $month, $year,$day,$new_filename,$data){
       
        
        $event_name = mysqli_real_escape_string($this->connect, $data['event_name']);
        $event_type = mysqli_real_escape_string($this->connect, $data['event_type']);
        $event_category = mysqli_real_escape_string($this->connect, $data['event_category']);
        $event_status = mysqli_real_escape_string($this->connect, $data['event_status']);
        $event_link = mysqli_real_escape_string($this->connect, $data['event_link']);
        $event_location = mysqli_real_escape_string($this->connect, $data['event_location']);
        
        $startTime = mysqli_real_escape_string($this->connect, $data['startTime']);
        $endTime = mysqli_real_escape_string($this->connect, $data['endTime']);
        $event_reqiure_time= $startTime." - ".$endTime;
        $publish = 1;
        
        
        $sql = "INSERT INTO `tscs_event_list`(event_name, event_type, event_category, event_status, event_image, event_link, event_location, event_date, event_month, event_year, event_require_day, event_reqiure_time, publish) VALUES ('$event_name', '$event_type', '$event_category', '$event_status', '$new_filename', '$event_link', '$event_location', '$date', '$month', '$year', '$day', '$event_reqiure_time', '$publish')";

        $result = mysqli_query($this->connect, $sql);
        if($result){
            return $result;
            //header('location:gallery-video.php');
        }
    }
    

    /*----Get All Event Info----*/
    public function getAllEventInfo(){
		$sql="SELECT * FROM `tscs_event_list`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Update Event Status By ID-----*/
    public function updateEventStatusById($id, $status){
        $sql="UPDATE `tscs_event_list` SET publish ='$status' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            header('location:event-list.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    /*-----Update with category Image By ID-----*/
    public function update_catagory_with_image($data,$id){
        //$directroy = 'preview/rent-category/';
		$directroy_move = '../assets/images/service/rent-category/';
		//$target_file = $directroy.$_FILES['category_image']['name'];
		$imgname = $_FILES['category_image']['name'];
		$imgext = pathinfo($imgname,PATHINFO_EXTENSION);
        
        $rename = 'DS-'.'RCP-'.$data['category_name_en'];
        $newname = $rename.'.'.$imgext;
		
        $target_file = $newname;
		$move_file = $directroy_move.$newname;
		
		$file_type = pathinfo($target_file,PATHINFO_EXTENSION);
		$file_size = $_FILES['category_image']['size'];
		$image = getimagesize($_FILES['category_image']['tmp_name']);
        
		if($image){
		    if(file_exists($target_file)){
		        echo 'This image is already exist';
		        exit();
		    }else{
		        if($file_size>=5242880){
		            echo 'File size is too large. Please Select a file within 5MB';
		            exit();
		        }else{
		            if($file_type != 'webp' && $file_type != 'jpg' && $file_type != 'jpeg' && $file_type != 'png'){
		                die('File type is not valid');
		            }else{
		                move_uploaded_file($_FILES['category_image']['tmp_name'], $move_file);
                        
                        $category_name_bn = htmlentities($data['category_name']);
                        $category_name_en = htmlentities($data['category_name_en']);
                        $category_detail_bn = htmlentities($data['category_detail']);
                        $category_detail_en = htmlentities($data['category_detail_en']);

                        $sql="UPDATE `ds_category` SET `category_image`='$target_file',`category_name`='$category_name_bn',`category_name_en`='$category_name_en',`category_detail`='$category_detail_bn',`category_detail_en`='$category_detail_en',`category_type`='$data[category_type]',`category_link`='$data[category_link]',`publish`='$data[publish]' WHERE `id`='$id'";
                        $result=mysqli_query($this->connect,$sql);
                        if($result){
                            $_SESSION['message']="Catagory Sucessfully Upadated";
                            header('Location:category.php');
                        }
                        else{
                            die("Something Went Wrong".mysqli_error($this->connect));
                        }
		                
		               
		            }
		        }
		    }
		}
        else{
		    echo 'This is not an Image';
		    exit();
		}
        
	}

    
     /*----Get All User payment  Info----*/
    public function getAllUserPayInfo(){
		$sql="SELECT * FROM `ib_payment_info`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    

    /*----Get All Blog  Info----*/
    public function getAllBlogInfo(){
        $sql="SELECT * FROM ` tscs_blog`";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }

    }

 
    /*----Save Send SMS In Database ----*/
    public function save_send_message($request_id,$category,$status,$tracking_link ,$data){
        $loading_point = mysqli_real_escape_string($this->connect, $data['loading_point']);
        $unloading_point = mysqli_real_escape_string($this->connect, $data['unloading_point']);
        $name = strip_tags($data['name']);
        $phone = strip_tags($data['phone']);
        $date = strip_tags($data['date']);
        $time = strip_tags($data['time']);
        $vehi_name = strip_tags($data['vehi_name']);
        $driver_name = strip_tags($data['driver_name']);
        $driver_mobile = strip_tags($data['driver_mobile']);
        //$status = strip_tags($data['status']);
        
        $phoneNumbers = explode(',', $phone);
        $phoneNumber = implode(",\n", $phoneNumbers);

        $sql = "INSERT INTO `sms_history`(`request_id`,`name`, `phone`, `loading_point`, `unloading_point`, `date`, `time`, `category`, `status`, `vehi_name`, `driver_name`, `driver_mobile`, `tracking_link`, `created_at`, `updated_at`) 
            VALUES ('$request_id','$name', '$phoneNumber', '$loading_point', '$unloading_point', '$date', '$time', '$category', '$status',  '$vehi_name','$driver_name','$driver_mobile','$tracking_link',  NOW(), NOW())";

        $result = mysqli_query($this->connect, $sql);
        if($result){
            return $result;
            header('location:loading.php');
        }
    }
   

    /*----get sms history by id-----*/
    public function getHistoryByCategory($condition) {

         $sql="SELECT * FROM `sms_history` WHERE `category`='$condition'";
        $result = mysqli_query($this->connect, $sql);

        if ($result) {
            return $result;
        } else {

            die('Something wrong: ' . mysqli_error($this->connect));
        }
    }


    /*----Get sms Info By ID----*/
    public function getSmsInfoById($condition){
        $sql="SELECT * FROM `sms_history` WHERE `id`= '$condition'";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }

    }


    /*------Update Uploading Info------*/
    public function updateUnloadingInfoById($user_id, $data){
        $date = strip_tags($data['date']);
        $time = strip_tags($data['time']);
        $category = "Delivery";

        $sql = "UPDATE `sms_history` SET `date`='$date', `time`='$time', `category`='$category' WHERE `id`='$user_id'";

        $result = mysqli_query($this->connect, $sql);
        if ($result) {
            return $result;
            /*echo "Update successful";
            header("Location: load-list.php");
            exit;*/ // Make sure to exit after header redirection
        } else {
            echo "Error updating record: " . mysqli_error($this->connect);
        }
    }

    /*------Update sms Info------*/
    public function updatedSmsHistory($user_id, $data){
        $date = strip_tags($data['date']);
        $time = strip_tags($data['time']);
        $category = "Cancel";

        $sql = "UPDATE `sms_history` SET `date`='$date', `time`='$time', `category`='$category' WHERE `id`='$user_id'";

        $result = mysqli_query($this->connect, $sql);
        if ($result) {
            return $result;
            /*echo "Update successful";
            header("Location: index.php");
            exit;*/ // Make sure to exit after header redirection
        } else {
            echo "Error updating record: " . mysqli_error($this->connect);
        }
    }
    

    /*-----Upload Image in Admin------*/
    public function getuploadImageinDb($file_name, $file_link, $file_type){
        $file_status = "1";
        
		$sql="INSERT INTO ib_upload_file
						SET  
                        file_name='$file_name',
                        file_link='$file_link',
                        file_type='$file_type',
                        file_status='$file_status'";
        
		$result=mysqli_query($this->connect,$sql);
		if($result){
            //return $result;
            $last_inserted_id = mysqli_insert_id($this->connect);
            
            $sql_si="INSERT INTO ib_slide_image SET image_link ='$last_inserted_id',status='0' "; 
            $resultSi=mysqli_query($this->connect,$sql_si);
            if($resultSi){
                return $result; 
            }
        }
        else{
            die("Something Went Wrong".mysqli_error($this->connect));
        }
    } 
    
    
    /*-----Get Active Slide Image -----*/
    public function getSlideImage(){
        $sql="SELECT * FROM `ib_slide_image` WHERE status='1'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
    }
    
    /*----Get Image By ID-----*/
    public function getImageById($data){
        $sql="SELECT * FROM `ib_upload_file` WHERE `id`= '$data'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    /*----Update Image Status By ID-----*/
    public function updateImageStatusById($id, $status){
       
        $sql_si="UPDATE `ib_slide_image` SET status ='$status' WHERE `id`='$id' "; 
        
        $resultSi=mysqli_query($this->connect,$sql_si);
        if($resultSi){
            header('location:web-control.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    /*----Update Image Title By ID-----*/
    public function updateImageTitleById($id, $title){ 
        $sql_si="UPDATE `ib_slide_image` SET image_title ='$title' WHERE `id`='$id' "; 
        $resultSi=mysqli_query($this->connect,$sql_si);
        if($resultSi){
            header('location:web-control.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    /*----Delete Slide Image By ID-----*/
    public function deleteSlide2ImageById($id){
        $sql="SELECT * FROM `ib_slide_image` WHERE id='$id'";
        $query_result=mysqli_query($this->connect,$sql);
        $row = mysqli_fetch_assoc($query_result);
        
        $data= $row['image_link'];
        $sql_data="SELECT * FROM `ib_upload_file` WHERE `id`= '$data'";
		$query_data=mysqli_query($this->connect,$sql_data);
        $row_data = mysqli_fetch_assoc($query_data);
        
        $target_dir = "../";
        
        unlink($target_dir.$row_data['file_link']);
        
        $sql="DELETE FROM ib_upload_file WHERE `id`= '$data'";
		$result=mysqli_query($this->connect,$sql);
		if($result){
			$sql="DELETE FROM ib_slide_image WHERE id='$id'";
            $result=mysqli_query($this->connect,$sql);
            if($result){
                header('Location:web-control.php');
            }
		}
		else{
			die("Something Went Wrong".mysqli_error($this->connect));
		}
	}
    

    /*-----Get Social Media Link -----*/
    public function getSocialMediaLink(){
        $sql="SELECT * FROM `tscs_social_link`";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
    }
    
    /*----Update Social Media Link By ID-----*/
    public function updateSocialmediaLink($id, $link){ 
        $sql="UPDATE `tscs_social_link` SET link ='$link', update_at= CURRENT_TIMESTAMP WHERE `id`='$id' "; 
        $result=mysqli_query($this->connect,$sql);
        if($result){
            return $result;
            //header('location:web-control.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    
    /*----Update footer title Text-----*/
    public function updateFooterTitle($text){ 
          $sql="UPDATE `tscs_footer` SET text ='$text', update_at= CURRENT_TIMESTAMP WHERE `id`='1' "; 
          $result=mysqli_query($this->connect,$sql);
          if($result){
              return $result;
              //header('location:web-control.php');
          }
          else{
              die('Something wrong'.mysqli_error($this->connect));
          }
      }
    
    
    /*----Get footer title Text-----*/
    public function getFooterText(){
        $sql="SELECT * FROM `tms_footer` WHERE `id`= '1'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    
    /*----Get All Contact US Message Info----*/
    public function getAllContactMessageInfo(){
		$sql="SELECT * FROM `ib_contact_information` ORDER BY id DESC";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
    /*----Get Contact Message By ID-----*/
    public function getContactMessageById($data){
        $sql="SELECT * FROM `ib_contact_information` WHERE `id`= '$data'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    
    /*----Update Contact Message By ID-----*/
    public function updateContactMessageById($id, $title){ 
        $sql="UPDATE `ib_contact_information` SET action ='$title' WHERE `id`='$id' "; 
        $result=mysqli_query($this->connect,$sql);
        if($result){
            return $result;
            //header('location:web-control.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}
    
    
    /*------Contact Message Delete------*/
    public function deleteContactMessageById($id){
        $sql = "DELETE FROM `ib_contact_information` WHERE id = '$id'";

        $result = mysqli_query($this->connect, $sql);
        if($result){
            //return $result;
            header('Location:mailbox.php');
        }
        else{
            die("Something Went Wrong: " . mysqli_error($this->connect));
        }
    }
    
    /*----Save News & Media ----*/
    /*----Get Last 3 Contact US Message Info----*/
    public function getLastContactMessageInfo(){
		$sql="SELECT * FROM `ib_contact_information` ORDER BY id DESC LIMIT 3";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    
    /*-----Send Contact Mail-----*/
    public function sendMailWithContactMessage($data){
        //get the value
        $email = strip_tags($_POST['email']);
        $subject = strip_tags($_POST['subject']);
        $message = strip_tags($_POST['message']);
        
        $name = strip_tags($_POST['user_name']);
        
        
        //Mail Part
                $mail = new PHPMailer(); 
                $mail->IsSMTP(); 
                $mail->SMTPAuth = true; 
                $mail->SMTPSecure = 'tls'; 
                /*/$mail->Host = "smtp.gmail.com";/*/
                $mail->Host = "mail.dropshep.com";
                $mail->Port = 587; 
                $mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
                //$mail->SMTPDebug = 2; 
                /*$mail->Username = "ashadujjaman.bms@gmail.com";
                $mail->Password = "cyaqppwnziaznjkd";*/
                $mail->Username = "it.support@dropshep.com";
                $mail->Password = "dropshep@B1m4s7";
                $mail->SetFrom('it.support@dropshep.com', 'IdealBengali Contact Message');

                $body = "$message<br>";

                // For the first recipient "Customer"
                $mail->Subject = "$subject";
                $mail->Body = $body;
                $mail->AddAddress($email, $name);

                $mail->SMTPOptions=array('ssl'=>array(
                            'verify_peer'=>false,
                            'verify_peer_name'=>false,
                            'allow_self_signed'=>false
                ));

                if(!$mail->Send()){
                    $check =0;
                    $msg= $mail->ErrorInfo;
                    $_SESSION['msg'] = $msg;
                }
                else{
                    $check=1;
                    $msg = 'Message sent successfully';
                    $_SESSION['msg'] = $msg;
                    unset($name, $email, $message);
                    //echo "<script>location='contact.php'</script>";
                }
    }


    /*-----update Email contact us -----*/
    public function updateContactEmail($id, $primary_email,$sec_email,$phone){ 
        $sql="UPDATE `tscs_contact_us` SET `primary_email`='$primary_email',`sec_email`='$sec_email',`phone`='$phone',`update_at`=CURRENT_TIMESTAMP WHERE `id`='$id' "; 
        $result=mysqli_query($this->connect,$sql);
        if($result){
            return $result;
            //header('location:web-control.php');
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
	}

    /*-----Get contact us email -----*/
    public function getContactUs(){
        $sql="SELECT * FROM `tscs_contact_us`";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }
    }


    /*----Get All Partner Info----*/
    public function getAllPartnerInfo(){
        $sql="SELECT * FROM `tscs_partners_logo`";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }

    }


    /*----Get Partner Info By ID----*/
    public function getPartnerInfoById($condition){
        $sql="SELECT * FROM `tscs_partners_logo` WHERE `id`= '$condition'";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }

    }


    /*------Update Partner Info------*/
    public function updatePartnerInfoById($user_id,$data){
        $full_name = strip_tags($data['full_name']);
        $email = strip_tags($data['email']);
        $phone = strip_tags($data['phone']);
        $address = strip_tags($data['address']);
        $gender =strip_tags($data['gender']);
        $profession = strip_tags($data['profession']);
        $organization = strip_tags($data['organization']);
        $designation = strip_tags($data['designation']);
        $qualification = strip_tags($data['qualification']);
        $birth_day = strip_tags($data['birth_day']);
        $membership = strip_tags($data['membership']);
        $status = strip_tags($data['status']);

        $sql="UPDATE `tscs_user` SET `full_name`='$full_name',`email`='$email',`phone`='$phone',`address`='$address',`gender`='$gender',`profession`='$profession',`organization`='$organization',`designation`='$designation',`qualification`='$qualification',`birth_day`='$birth_day',`membership`='$membership',`status`='$status' WHERE `id`='$user_id'";

        $result=mysqli_query($this->connect,$sql);
        if($result){
            echo "Update successfull";
            header("location:user-profile.php");
        }
    }


    /*----Get All Product Info----*/
    public function getShopItem(){
        $sql="SELECT * FROM `tscs_shop_item_list`";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }

    }


    /*----Get Product Info By ID----*/
    public function getProductInfo($condition){
        $sql="SELECT * FROM `tscs_shop_item_list` WHERE `id`= '$condition'";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }

    }

    /*----Get All membership Info----*/
    public function getMemberShipInfo(){
        $sql="SELECT * FROM `tscs_subcription_plan`";
        $query_result=mysqli_query($this->connect,$sql);
        if($query_result){
            return $query_result;
        }
        else{
            die('Something wrong'.mysqli_error($this->connect));
        }

    }

    
    
    
}


?>