<?php 
    include('header.php');
?>

<?php
    if(isset($_POST['submitRegi'])) {
        if(isset($_POST['password']) && isset($_POST['confirmPassword'])) {
            $newPassword = $_POST['password'];
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
                
                $result = $objSuperAdmin->admin_registration_by_superadmin($adminId,$_POST);
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
      <h1><b>Admin</b> TSCS</h1>
    </div>
    <div class="card-body">
        <p class="login-box-msg">Register a new membership</p>
        <form id="registrationForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="full_name" placeholder="Full name">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="email" class="form-control" name="email" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password" placeholder="Password" id="passwordField">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock" id="togglePassword"></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="confirmPassword" placeholder="Retype password" id="confirmPasswordField"  oninput="validateForm()">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock" id="toggleConfirmPassword"></span>
                    </div>
                </div>
                <div id="passwordErrorc" class="invalid-feedback"></div>
            </div>
                </div>
            <div class="row">
                <div class="col-4">
                    <a href="#" onclick="goBack()" class="text-center"><button type="submit" name="submitRegi" class="btn btn-secondary btn-block">Back</button></a>
                </div>
                <div class="col-4">
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" name="submitRegi" class="btn btn-primary btn-block" id="submitBtn">Register</button>
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
  const passwordField = document.getElementById('passwordField');
  const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
  const confirmPasswordField = document.getElementById('confirmPasswordField');

  togglePassword.addEventListener('click', function () {
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-lock');
    this.classList.toggle('fa-lock-open');
  });

  toggleConfirmPassword.addEventListener('click', function () {
    const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPasswordField.setAttribute('type', type);
    this.classList.toggle('fa-lock');
    this.classList.toggle('fa-lock-open');
  });
</script>

<!--Password not match warning-->
<script>
    function validateForm() {
        const password = document.getElementById('passwordField').value;
        const confirmPassword = document.getElementById('confirmPasswordField').value;
        const confirmPasswordField = document.getElementById('confirmPasswordField');
        const errorDivc = document.getElementById('passwordErrorc');
        const submitBtn = document.getElementById('submitBtn');

        if (confirmPassword === '') {
            confirmPasswordField.classList.remove('is-valid');
            confirmPasswordField.classList.add('is-invalid');
            errorDivc.textContent = 'Passwords enter confirm password!';
            submitBtn.disabled = true; // Disable the submit button
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
            errorDivc.textContent = '';
            submitBtn.disabled = false; // Enable the submit button
            return true; // Allow form submission
        }
    }
</script>


<?php
    include('footer.php');
?>