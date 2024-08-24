<?php 
    include('header.php');
?>

<?php
    if(isset($_SESSION['is_loged'])){
        header("location:../index.php");
    }

    if(isset($_POST['submitRegi'])){
        
        if($_POST['password']==$_POST['confirmPassword']){
            $password = $_POST['password'];
            $file = 'common_passwords.txt';
            $handle = fopen($file, 'a'); // Open the file in append mode
            if ($handle) {
                fwrite($handle, $password . PHP_EOL); // Write the password followed by a newline
                fclose($handle);
            } else {
                echo "Unable to open file for writing.\n";
            }
            $objSuperAdmin->admin_registration_submit($_POST);
        }
        else{
            echo "Retype password not match!";
        }
    }
?>

<!-- register-box -->
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../index.php" class="h1"><b>Admin </b>TSCS</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form  method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="full_name" placeholder="Full name" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password" id="passwordField" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock" id="togglePassword"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" name="confirmPassword" placeholder="Retype password" id="confirmPasswordField" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock" id="toggleConfirmPassword"></span>
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree"  required>
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submitRegi" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="#" onclick="goBack()" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- register-box -->
<script>
    function goBack() {
      window.history.back();
    }
  </script>


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

<?php
    include('footer.php');
?>
