<?php 
    include('header.php');
?>
<?php
    $originalPass = "";
    $hash = ""; // MD5 hash for "password"
    $adminId = "";
    if(isset($_GET['pass'])) {
        $hash = $_GET['pass'];
        $adminId = $_GET['id'];
    }

    // The file containing common passwords
    $passwordFile = "./common_passwords.txt";
    // Open the file
    $handle = fopen($passwordFile, "r");
    if ($handle) {
        while (($password = fgets($handle)) !== false) {
            // Remove any newline characters from the password
            $password = trim($password);

            // Calculate the MD5 hash of the password
            if (md5($password) === $hash) {
                $originalPass = $password;
                fclose($handle);
                break;
            }
        }
        //fclose($handle);
    } 
    else {
        echo "Error opening the password file.\n";
    }

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
                
                $result = $objSuperAdmin->updateAdminPassword($adminId,$_POST);
                if($result){
                    echo "<script>window.location.replace('../admin-panel.php');</script>";
                }
                
            } else {
                echo "Passwords do not match.";
            }
        } else {
            echo "Password fields are required.";
        }
    }
?>

<div class="login-box">
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <h1><b>Admin</b>TSCS</h1>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Admin previous password show or<br> New password set.</p>
                <div class="form-group">
                    <label>Current Password</label>
                    <div class="input-group">
                        <input type="text" class="form-control" value="<?php echo $originalPass; ?>" disabled>
                    </div>
                </div>
            <form id="recoverpassFormo" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label>New Password</label>
                    <div class="input-group">
                        <input type="password" id="newPasswordField" class="form-control" name="newPassword" placeholder="Enter new password" oninput="validateForm()">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock" id="togglePassword" onclick="togglePasswordVisibility('newPasswordField')"></span>
                            </div>
                        </div>
                        <div id="passwordErrorn" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <div class="input-group">
                        <input type="password" id="confirmPasswordField" class="form-control" name="confirmPassword" placeholder="Confirm new password" oninput="validateForm()">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock" id="togglePasswordConfirm" onclick="togglePasswordVisibility('confirmPasswordField')"></span>
                            </div>
                        </div>
                        <div id="passwordErrorc" class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <a href="#" onclick="goBack()" class="text-center"><button type="submit" name="submitRegi" class="btn btn-secondary btn-block">Back</button></a>
                    </div>
                    <div class="col-2"></div>
                    <!-- /.col -->
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary btn-block" name="submit" id="submitBtn">Change password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
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

<!--Password Hide/Show -->
<script>
    const togglePassword = document.getElementById('togglePassword');
    const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
    const passwordField = document.getElementById('newPasswordField');
    const confirmPasswordField = document.getElementById('confirmPasswordField');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        this.classList.toggle('fa-lock');
        this.classList.toggle('fa-lock-open');
    });

    togglePasswordConfirm.addEventListener('click', function () {
        const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordField.setAttribute('type', type);
        this.classList.toggle('fa-lock');
        this.classList.toggle('fa-lock-open');
    });
</script>

<!--Password not match warning-->
<script>
    function validateForm() {
        const password = document.getElementById('newPasswordField').value;
        const newPasswordField = document.getElementById('newPasswordField');
        const confirmPassword = document.getElementById('confirmPasswordField').value;
        const confirmPasswordField = document.getElementById('confirmPasswordField');
        const errorDivn = document.getElementById('passwordErrorn');
        const errorDivc = document.getElementById('passwordErrorc');
        const submitBtn = document.getElementById('submitBtn');

        if (password.trim() === '' || confirmPassword.trim() === '') {
            if (password.trim() === '') {
                newPasswordField.classList.remove('is-valid');
                newPasswordField.classList.add('is-invalid');
                errorDivn.textContent = 'Please enter new password.';
                //submitBtn.disabled = false; // Disable the submit button
                //return false; // Prevent form submission
            }
            else{
                newPasswordField.classList.remove('is-invalid');
            }
            if (confirmPassword.trim() === '') {
                confirmPasswordField.classList.remove('is-valid');
                confirmPasswordField.classList.add('is-invalid');
                errorDivc.textContent = 'Please enter confirm password.';
            }
            submitBtn.disabled = false; // Disable the submit button
            return false; // Prevent form submission
        }
        
        else if (password !== confirmPassword) {
            confirmPasswordField.classList.remove('is-valid');
            confirmPasswordField.classList.add('is-invalid');
            errorDivc.textContent = 'Passwords do not match!';
            submitBtn.disabled = true; // Disable the submit button
            return false; // Prevent form submission
        } 
        else {
            confirmPasswordField.classList.remove('is-invalid');
            confirmPasswordField.classList.add('is-valid');
            errorDivn.textContent = '';
            errorDivc.textContent = '';
            submitBtn.disabled = false; // Enable the submit button
            return true; // Allow form submission
        }
    }
</script>


<?php
    include('footer.php');
?>