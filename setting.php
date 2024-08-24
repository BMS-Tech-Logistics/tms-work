<?php 
    include('include/header.php');
?>

<?php
    $message='';
    $message2='';
    if(isset($_POST['passwordChange'])){
        $adminId =$_SESSION['id'];
        $result = $objOperationAdmin->updateAdminPassword($adminId, $_POST);
        if($result){
            unset($_POST['newPassword']);
            unset($_POST['confirmPassword']);
            $message = '<div class="alert alert-success alert-dismissible">
                                          <button id="closeButton"  type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <h5><i class="icon fas fa-check"></i> Alert!</h5>
                                          Password Change Successful.
                                    </div>';
        }
        
    }
    
    if(isset($_POST['submitSocialLink'])) {
        if(isset($_POST['facebook']) && $_POST['facebook'] !== "" && isset($_POST['youtube']) && $_POST['youtube'] !== "") {
            $results = $objOperationAdmin->updateSocialmediaLink('1', $_POST['facebook']);
            $results = $objOperationAdmin->updateSocialmediaLink('2', $_POST['youtube']);
        }
        else if(isset($_POST['facebook']) && $_POST['facebook'] !== "") {
            $results = $objOperationAdmin->updateSocialmediaLink('1', $_POST['facebook']);
        }
        else if(isset($_POST['youtube']) && $_POST['youtube'] !== "") {
            $results = $objOperationAdmin->updateSocialmediaLink('2', $_POST['youtube']);
        }
        else{
            $results = false;
        }

        // Check results and set message
        if($results) {
            unset($_POST['facebook']);
            unset($_POST['youtube']);
            $message2 = '<div class="alert alert-success alert-dismissible">
                            <button id="closeButton" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                            Social Media Links Updated Successfully.
                        </div>';
        }
    }

    $getLinkSql= $objOperationAdmin-> getSocialMediaLink();
    while($linkData=mysqli_fetch_array($getLinkSql)){
        if($linkData['id']=="1"){
            $facebookLink = $linkData['link'];
        }
        if($linkData['id']=="2"){
            $youtubelink = $linkData['link'];
        }
    }

    if(isset($_POST['updateFooter'])){
        $result= $objOperationAdmin->updateFooterTitle($_POST['text']);
        if($result){
            unset($_POST['text']);
            $message2 = '<div class="alert alert-success alert-dismissible">
                    <button id="closeButton" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Alert!</h5>
                    Update footer Info.
                </div>';
        }
    }
    
    $getFooterSql = $objOperationAdmin-> getFooterText();
    $footerData=mysqli_fetch_array($getFooterSql);

?>


<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Setting</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="./">Home</a></li>
                          <li class="breadcrumb-item active">Setting</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

          <!-- Default box -->

          <div class="row">

              <div class="col-lg-6">
                  <!-- /.card-header -->
                  <?php echo $message; ?>
                  <div class="card card-primary">
                      <div class="card-header">
                          <h3 class="card-title">Admin Password Change</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form method="post" class="form-horizontal">
                          <div class="card-body">
                              <div class="form-group row">
                                  <label for="passwordField" class="col-sm-4 col-form-label">New Password</label>
                                  <div class="col-sm-8 input-group mb-3">
                                      <input id="newPasswordField" type="password" name="newPassword" class="form-control" placeholder="New Password" required>
                                      <div class="input-group-append">
                                          <div class="input-group-text">
                                              <span class="fas fa-lock" id="togglePassword" onclick="togglePasswordVisibility('newPasswordField')"></span>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="confirmPasswordField" class="col-sm-4 col-form-label">Confirm Password</label>
                                  <div class="col-sm-8 input-group mb-3">
                                      <input id="confirmPasswordField" type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" oninput="validateForm()" required>
                                      <div class="input-group-append">
                                          <div class="input-group-text">
                                              <span class="fas fa-lock" id="togglePasswordConfirm" onclick="togglePasswordVisibility('confirmPasswordField')"></span>
                                          </div>
                                      </div>
                                      <div id="passwordError" class="invalid-feedback"></div>
                                  </div>
                              </div>
                          </div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <button type="submit" name="passwordChange" id="submitBtn" class="btn btn-info float-right">Update</button>
                          </div>
                          <!-- /.card-footer -->
                      </form>
                  </div>
              </div>

              <div class="col-lg-6">
                  <?php echo $message2; ?>
                  <!-- Form Element sizes -->
                  <div class="card card-success" hidden>
                      <div class="card-header">
                          <h3 class="card-title">Social Media Link</h3>
                      </div>
                      <form method="post" class="form-horizontal">
                          <div class="card-body">
                              <div class="form-group row">
                                  <label for="facebookInput" class="col-sm-3 col-form-label">Facebook Page</label>
                                  <div class="col-sm-9 input-group">
                                      <input id="facebookInput" class="form-control" name="facebook" type="text" placeholder="https://*" oninput="validateInputsface()" value="<?php echo $facebookLink; ?>">
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="instagramInput" class="col-sm-3 col-form-label">YouTube</label>
                                  <div class="col-sm-9 input-group mb-3">
                                      <input id="instagramInput" class="form-control" name="YouTube" type="text" placeholder="https://*" oninput="validateInputsInst()" value="<?php echo $youtubelink; ?>">
                                  </div>
                              </div>
                          </div>
                          <div id="errorMessage" class="col-sm-8 offset-sm-4 invalid-feedback" style="display: none;"></div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <button type="submit" name="submitSocialLink" class="btn btn-info float-right">Update</button>
                          </div>
                      </form>
                      <!-- /.card-body -->
                  </div>
                  <!-- /.card -->
                  <!-- Form Element sizes -->
                  <div class="card card-success">
                      <div class="card-header">
                          <h3 class="card-title">Footer title</h3>
                      </div>
                      <form  method="post"  class="form-horizontal">
                      <div class="card-body">
                          <input class="form-control" type="text"  name="text" placeholder="Copyright©2024 Ideal Bangali. All Right Reserved." value="<?php echo $footerData['text']; ?>" required>
                      </div>
                      <!-- /.card-body -->
                          <div class="card-footer">
                              <button type="submit"  name="updateFooter" class="btn btn-info float-right">Update</button>
                          </div>
                      <!-- /.card-body -->
                      </form>
                  </div>
                  <!-- /.card -->

              </div>


          </div>

          
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
        const confirmPassword = document.getElementById('confirmPasswordField').value;
        const confirmPasswordField = document.getElementById('confirmPasswordField');
        const errorDiv = document.getElementById('passwordError');
        const submitBtn = document.getElementById('submitBtn');

        if (password !== confirmPassword) {
            confirmPasswordField.classList.remove('is-valid');
            confirmPasswordField.classList.add('is-invalid');
            errorDiv.textContent = 'Passwords do not match!';
            submitBtn.disabled = true; // Disable the submit button
            return false;
        } else {
            confirmPasswordField.classList.remove('is-invalid');
            confirmPasswordField.classList.add('is-valid');
            errorDiv.textContent = '';
            submitBtn.disabled = false; // Enable the submit button
            return true;
        }
    }
</script>
<!--Social Link 'https://*' check-->
<script>
    function validateInputsface() {
        const facebookValue = document.getElementById('facebookInput').value;
        const facebookValueField = document.getElementById('facebookInput');
        const errorMessage = document.getElementById('errorMessage');

        if(facebookValue===""){
            facebookValueField.classList.remove('is-valid');
            facebookValueField.classList.remove('is-invalid');
            errorMessage.textContent = "";
            errorMessage.style.display = "none";
        }
        else if (!isValidURL(facebookValue)) {
            facebookValueField.classList.remove('is-valid');
            facebookValueField.classList.add('is-invalid');
            errorMessage.textContent = "Input should start with 'https://'";
            errorMessage.style.display = "block";
        } 
        else {
            facebookValueField.classList.add('is-valid');
            facebookValueField.classList.remove('is-invalid');
            errorMessage.textContent = "";
            errorMessage.style.display = "none";
        }
    }
    
    function validateInputsInst() {
        const instagramValue = document.getElementById('instagramInput').value;
        const instagramValueField = document.getElementById('instagramInput');
        const errorMessage = document.getElementById('errorMessage');

        if(instagramValue===""){
            instagramValueField.classList.remove('is-valid');
            instagramValueField.classList.remove('is-invalid');
            errorMessage.textContent = "";
            errorMessage.style.display = "none";
        }
        else if ( !isValidURL(instagramValue)) {
            instagramValueField.classList.remove('is-valid');
            instagramValueField.classList.add('is-invalid');
            errorMessage.textContent = "Input should start with 'https://'";
            errorMessage.style.display = "block";
        } 
        else {
            instagramValueField.classList.add('is-valid');
            instagramValueField.classList.remove('is-invalid');
            errorMessage.textContent = "";
            errorMessage.style.display = "none";
        }
    }

    function isValidURL(url) {
        return url.startsWith("https://");
    }
</script>

<!--Alert Message dismiss-->
<script>
    // Function to dismiss the alert after 3 seconds
    setTimeout(function() {
        var closeButton = document.getElementById('closeButton');
        closeButton.click();
    }, 3500); // 3000 milliseconds = 3 seconds
</script>

<?php 
    include('include/footer.php');
?>
