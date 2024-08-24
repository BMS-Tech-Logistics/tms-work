<?php 
    include('header.php');
?>
<?php
    $state = 0;
    $result= "";
    if(isset($_POST['submit'])){
        
        $userEmail = $_POST['email'];
        $adminInfo = $objSuperAdmin->get_forgot_admin_info($_POST['email']);
        
        if($adminInfo){
            $username = $adminInfo['user_name'];
            
            $state = 1; 
            //echo $username;
        }
        else{
            $msg = "This email address is not registered!";
            $result = 0;
        }
        
        if($state ==1){
                //Mail Part
                $mail = new PHPMailer(); 
                $mail->IsSMTP(); 
                $mail->SMTPAuth = true; 
                $mail->SMTPSecure = 'tls'; 
                /*$mail->Host = "smtp.gmail.com";*/
                $mail->Host = "mail.thesupplychainstreet.com";
                $mail->Port = 587; 
                $mail->IsHTML(true);
                $mail->CharSet = 'UTF-8';
                //$mail->SMTPDebug = 2; 
                /*$mail->Username = "ashadujjaman.bms@gmail.com";
                $mail->Password = "cyaqppwnziaznjkd";*/
                $mail->Username = "support@thesupplychainstreet.com";
                $mail->Password = "Tscs@2024";
                $mail->SetFrom('support@thesupplychainstreet.com', 'TMS Password Reset');

                $body = "Your TMS Admin Password Reset link.<br><br>";
                $body .= "<b>link: </b>http://localhost/tms-demo/auth/reset-password.php?username=$username<br>";
                $body .= "Thanks you.<br>";
            
                  
                

                // For the first recipient "Customer"
                $mail->Subject = 'TMS Admin password reset';
                $mail->Body = $body;
                $mail->AddAddress($userEmail, 'TSCS Admin');

                $mail->SMTPOptions=array('ssl'=>array(
                            'verify_peer'=>false,
                            'verify_peer_name'=>false,
                            'allow_self_signed'=>false
                ));

                if(!$mail->Send()){
                    echo $mail->ErrorInfo;
                }
                else{
                    $msg =  'Password reset link has been sent to your email !';
                    $result =1;
                    //echo "<script>location='contact.php'</script>";
                }
            }
    }
        
    
?>


<div class="login-box">
    <div class="card-body" hidden>
    
    <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-info"></i> Alert!</h5>
        Info alert preview. This alert is dismissable.
    </div>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
        Danger alert preview. This alert is dismissable. 
    </div>
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
        Warning alert preview. This alert is dismissable.
    </div>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Success alert preview. This alert is dismissable.
    </div>
</div>
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1><b>Admin </b>TMS</h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">You forgot your password? Here you can easily reset your password.</p>
            <?php if($result ==0){?>
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                <?php echo $msg; ?>
            </div>
            <?php } else if($result ==1) {?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i>Reset</h5>
                <?php echo $msg; ?>
            </div>
            <?php } ?>
            <form id="formForget" method="post"  enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Request reset password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="javascript:void(0)" onclick="goBack()">Login</a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>

<!-- /.login-box -->
<script>
    function goBack() {
        window.history.back();
    }
</script>



<?php
    include('footer.php');
?>
