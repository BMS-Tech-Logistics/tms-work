<?php
    ob_start(); 
    session_start();
    include('classes/operation_admin.php');

    $objOperationAdmin=new operation_admin();

    if(isset($_GET['submitRegi'])){
        $dealer_id = $_GET['dealer_id'];
        if($_GET['password']==$_GET['confirmPassword']){
            $password = $_GET['password'];
            $file = 'auth/common_passwords.txt';
            $handle = fopen($file, 'a'); // Open the file in append mode
            if ($handle) {
                fwrite($handle, $password . PHP_EOL); // Write the password followed by a newline
                fclose($handle);
            } else {
                echo "Unable to open file for writing.\n";
            }
            $setUser = $objOperationAdmin->admin_registration_submit($_GET);
            if($setUser){
                $user_id = $setUser;
                $objOperationAdmin->updateDealerAccountById($dealer_id, $user_id);
                //echo "<script type='text/javascript'>window.location.replace('dealers.php');</script>";
            }
            else{
                echo "fail";
            }
        }
        else{
            echo "fail";
        }
    }

    if(isset($_GET['submit'])){
        $order_id = $_GET['order_id'];
        $order_status = $_GET['order_status'];
        $objOperationAdmin->updateOrderStatusById($order_id, $order_status);
        
    }

    if(isset($_GET['updateAdmin'])){
        $admin_id = $_GET['admin_id'];
        $get_type = $_GET['type'];
        $current_sp_id = $_SESSION['admin_id'];
        $type_admin= "";
        if($current_sp_id==1){
            $type_admin= "superadmin";
        }
        else{
            $type_admin= "admin";
        }
        $objOperationAdmin->update_admin_access_info($current_sp_id, $admin_id,$get_type,$type_admin);
        
    }

    


?>