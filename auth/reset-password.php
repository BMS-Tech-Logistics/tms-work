<?php 
    include('header.php');
?>
<?php
    $result = "";
    $adminUsername = "";
    if(isset($_GET['username'])) {
        $adminUsername = $_GET['username'];
    }
    else{
        echo "Invalid Reset link!";
    }

    //echo $adminUsername;

    if(isset($_POST['submit'])) {
        if(isset($_POST['newPassword']) && isset($_POST['confirmPassword'])) {
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];
            if($newPassword === $confirmPassword) {
                $file = 'common_passwords.txt';
                $handle = fopen($file, 'a'); // Open the file in append mode
                if ($handle) {
                    fwrite($handle, $newPassword . PHP_EOL); // Write the password followed by a newline
                    fclose($handle);
                    //echo "Password changed successfully.";
                } else {
                    echo "Unable to open file for writing.\n";
                }
                
                $resultUpdate = $objSuperAdmin->updateAdminPasswordByUsername($adminUsername,$newPassword);
                if($resultUpdate){
                    //echo "<script>window.location.replace('login.php');</script>";
                    $msg = "Password changed successfully.";
                    $result = 1;
                }
                
            } else {
                $msg =  "Passwords do not match.";
                $result = 0;
            }
        } else {
            echo "Password fields are required.";
            $result = 0;
        }
    }
?>

<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1><b>Admin</b>TSCS</h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">You are only one step a way from your new password, reset your password now.</p>
            <?php if($result ==1){?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i>Success</h5>
                <?php echo $msg; ?>
            </div>
            <?php } else if($result ==0) { ?>
            <div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-exclamation-triangle"></i> Fail!</h5>
                <?php echo $msg; ?>
            </div>
            <?php } if($result=="" || $result==0 ){ ?>
            <form method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="input-group mb-3">
                    <input type="password" id="newPasswordField" name="newPassword" class="form-control" placeholder="Password" oninput="validateForm()">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock" id="togglePassword" onclick="togglePasswordVisibility('newPasswordField', 'togglePassword')"></span>
                        </div>
                    </div>
                    <div id="passwordErrorn" class="invalid-feedback"></div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" id="confirmPasswordField" name="confirmPassword" class="form-control" placeholder="Confirm Password" oninput="validateForm()">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock" id="togglePasswordConfirm" onclick="togglePasswordVisibility('confirmPasswordField', 'togglePasswordConfirm')"></span>
                        </div>
                    </div>
                    <div id="passwordErrorc" class="invalid-feedback"></div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" id="submitBtn" name="submit" class="btn btn-primary btn-block">Change password</button>
                    </div>
                </div>
            </form>
            <?php } ?>
            <?php if($result ==1) {?>
            <div class="row mt-2">
                <div class="col-12">
                    <a href="login.php"><button type="submit" class="btn btn-success btn-block">Go to Login</button></a>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- Password Hide/Show -->
<script>
    function togglePasswordVisibility(fieldId, toggleId) {
        const field = document.getElementById(fieldId);
        const toggle = document.getElementById(toggleId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
        toggle.classList.toggle('fa-lock');
        toggle.classList.toggle('fa-lock-open');
    }

    function validateForm() {
        const newPasswordField = document.getElementById('newPasswordField');
        const confirmPasswordField = document.getElementById('confirmPasswordField');
        const errorDivn = document.getElementById('passwordErrorn');
        const errorDivc = document.getElementById('passwordErrorc');
        const submitBtn = document.getElementById('submitBtn');

        const password = newPasswordField.value.trim();
        const confirmPassword = confirmPasswordField.value.trim();

        let isValid = true;

        if (password === '') {
            newPasswordField.classList.add('is-invalid');
            errorDivn.textContent = 'Please enter new password.';
            isValid = false;
        } else {
            newPasswordField.classList.remove('is-invalid');
            errorDivn.textContent = '';
        }

        if (confirmPassword === '') {
            confirmPasswordField.classList.add('is-invalid');
            errorDivc.textContent = 'Please enter confirm password.';
            isValid = false;
        } else {
            confirmPasswordField.classList.remove('is-invalid');
            errorDivc.textContent = '';
        }

        if (password !== '' && confirmPassword !== '' && password !== confirmPassword) {
            confirmPasswordField.classList.add('is-invalid');
            errorDivc.textContent = 'Passwords do not match!';
            isValid = false;
        } else if (password === confirmPassword && password !== '' && confirmPassword !== '') {
            confirmPasswordField.classList.remove('is-invalid');
            confirmPasswordField.classList.add('is-valid');
        }

        submitBtn.disabled = !isValid;
        return isValid;
    }
    
    // Attach the validateForm function to the oninput event of both fields
    document.getElementById('newPasswordField').addEventListener('input', validateForm);
    document.getElementById('confirmPasswordField').addEventListener('input', validateForm);
</script>

<?php
    include('footer.php');
?>