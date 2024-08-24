<?php
include('db_connection.php');
include('../PHPMailer/PHPMailerAutoload.php');

class super_admin extends database_connection
{
	
	public function __construct(){
		parent:: __construct();
	}
    
    /*-----Admin Registration -----*/  //Only One Time
    public function admin_registration_submit($data){
        //get the value
        $full_name = strip_tags($_POST['full_name']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        
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
        $username = strtoupper($username. $currentDate . $randomNumber);

        // Function to generate random 6-digit number
        function generateRandomNumber() {
            return mt_rand(100, 999);
        }

        // Query to check if username exists
        $sql = "SELECT * FROM tms_admin WHERE user_name = '$username'";
        $result =mysqli_query($this->connect,$sql);

        // If username doesn't exist, use the generated username
        if ($result->num_rows === 0) {
            $unique_username = $username;
        } 
        else {
            // Generate a unique username
            do {
                $unique_username = $username . generateRandomNumber();
                // Query to check if new username exists
                $sql = "SELECT * FROM tms_admin WHERE user_name = '$unique_username'";
                $result =mysqli_query($this->connect,$sql);

            } while ($result->num_rows > 0);
        }
        
        $type = "admin";

        // Now $unique_username contains a unique 6-digit username
        $msg_query = "INSERT INTO tms_admin
						SET 
                        user_name = '$unique_username',
						full_name = '$full_name',
						email = '$email', 
						password = '$password', 
						type = '$type'";
        
        $result=mysqli_query($this->connect,$msg_query);
     
        if($result){
                
                $msg="Account Create succesfully";
                echo "Admin: $msg";
                
        }
        else{   
            $check=0;
            $msg = 'Message send Failed';
        }

        
    }
    
    /*-----Admin Registration By Super Admin -----*/ 
    public function admin_registration_by_superadmin($data){
        //get the value
        $full_name = strip_tags($_POST['full_name']);
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);
        
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
        $username = strtoupper($username. $currentDate . $randomNumber);

        // Function to generate random 6-digit number
        function generateRandomNumber() {
            return mt_rand(100, 999);
        }

        // Query to check if username exists
        $sql = "SELECT * FROM tms_admin WHERE username = '$username'";
        $result =mysqli_query($this->connect,$sql);

        // If username doesn't exist, use the generated username
        if ($result->num_rows === 0) {
            $unique_username = $username;
        } 
        else {
            // Generate a unique username
            do {
                $unique_username = $username . generateRandomNumber();
                // Query to check if new username exists
                $sql = "SELECT * FROM tms_admin WHERE username = '$unique_username'";
                $result =mysqli_query($this->connect,$sql);

            } while ($result->num_rows > 0);
        }
        
        $type = "admin";
        $convertpass = md5($password);

        // Now $unique_username contains a unique 6-digit username
        $msg_query = "INSERT INTO tms_admin
						SET 
                        username = '$unique_username',
						full_name = '$full_name',
						email = '$email', 
						password = '$convertpass', 
						type = '$type'";
        
        $result=mysqli_query($this->connect,$msg_query);
     
        if($result){
            return $result;  
        }
        else{   
            die('Something wrong'.mysqli_error($this->connect));
        }

        
    }
    
    /*----admin forget email Info----*/
    public function get_forgot_admin_info($condition){
		$sql="SELECT * FROM `tms_admin` WHERE `email`= '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
            if($query_result->num_rows > 0){
                while ($row = $query_result->fetch_assoc()) {
                    return $row;
                }  
            }
            else{
                return false;
            }
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Loged User Info----*/
    public function get_admin_info($condition){
		$sql = "SELECT * FROM `tms_admin` WHERE `email` = '$condition' OR `phone` = '$condition'";
		$query_result=mysqli_query($this->connect,$sql);
		if($query_result){
			return $query_result;
		}
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }

	}
    
    /*----Update Admin Password*/
    public function updateAdminPassword($id,$data){
        $newPassword = strip_tags($data['newPassword']);
        $convertpass = md5($newPassword);
        $sql="UPDATE `tms_admin` SET password ='$convertpass' WHERE `id`='$id' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            return $result;
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
    }
    
    /*----Update Admin Password By username*/
    public function updateAdminPasswordByUsername($username,$newPassword){
        
        $convertpass = md5($newPassword);
        $sql="UPDATE `tms_admin` SET password ='$newPassword' WHERE `user_name`='$username' "; 
        
        $result=mysqli_query($this->connect,$sql);
        if($result){
            //return $result;
            echo "Fail";
        }
		else{
			die('Something wrong'.mysqli_error($this->connect));
        }
    }
    
    
    public function admin_login_check($data){
        $condition = $data['email'];
        $password = $data['password'];

        $sql = "SELECT * FROM `tms_admin` WHERE `email` = '$condition' OR `phone` = '$condition' and password='$password'";

        $queryResult = mysqli_query($this->connect,$sql);
        $userInfo = mysqli_fetch_array($queryResult);

        if($userInfo){
                session_start();
                $id = $userInfo['id'];
                $user_name = $userInfo['user_name'];
                $_SESSION['id'] = $id;
                $_SESSION['user_name'] = $user_name;
                $_SESSION['full_name'] = $userInfo['full_name'];
                $_SESSION['profile_pic'] = $userInfo['profile_pic'];
                $_SESSION['is_loged'] = uniqid($user_name.$id);
                
                header("Location:../index.php");
                //echo "<script>window.location.replace('my-profile.php');</script>";
                die;
            
        }
        else{
            //echo "Invalid Information";
            $_SESSION['message'] = "Invalid password !";
            //return $message;
        }
	}
    
    
}

?>