<?php 
    include('header.php');
?>
<?php
    
    if(isset($_SESSION['is_loged'])){
        header("location:../index.php");
    }
    
    if(isset($_POST['submitLogin'])){
        
        $adminInfo = $objSuperAdmin->get_admin_info($_POST['email']);
        $adminData=mysqli_fetch_array($adminInfo);
        if($adminData){
            $message = $objSuperAdmin->admin_login_check($_POST);

            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        else{
            echo "Invalid Email !";
        }
        
    }
?>
<!--login-box -->
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <a href="../index.php" class="h1"><b>Admin </b>TMS</a>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <form method="post" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <input type="text" name="email" class="form-control" placeholder="Email / Mobile" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="passwordField" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock" id="togglePassword"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8" >
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" name="submitLogin" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>


            <p class="mb-1">
                <a href="forgot-password.php">I forgot my password</a>
            </p>
            <p class="mb-0" hidden>
                <a href="register.php" class="text-center">Register a new membership</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!--login-box -->

<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('passwordField');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-lock');
        this.classList.toggle('fa-lock-open');
    });
</script>

<?php
    include('footer.php');
?>
