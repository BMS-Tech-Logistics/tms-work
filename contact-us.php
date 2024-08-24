<?php 
    include('include/header.php');
?>

<?php
   
   $message2='';
    if(isset($_POST['submitContact'])) {
        if(isset($_POST['email1']) && $_POST['email2'] !== ""  && $_POST['phone']) {
            $results = $objOperationAdmin->updateContactEmail(1, $_POST['email1'], $_POST['email2'], $_POST['phone']);
          
        }
       
        else{
            $results = false;
        }

        // Check results and set message
        if($results) {
            unset($_POST['email1'],$_POST['email2'],$_POST['phone']);
          
            $message2 = '<div class="alert alert-success alert-dismissible">
                            <button id="closeButton" type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-check"></i> Alert!</h5>
                           Email Updated Successfully.
                        </div>';
        }
    }

    $getLinkSql= $objOperationAdmin-> getContactUs();
    while($linkData=mysqli_fetch_array($getLinkSql)){
        if($linkData['id']=="1"){
            $email1 = $linkData['primary_email'];
            $email2 = $linkData['sec_email'];
            $phone = $linkData['phone'];
        }
        
    }

 

?>

<div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Contact us</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="./">Home</a></li>
                          <li class="breadcrumb-item active">contact</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

          <!-- Default box -->

          <div class="row">
          
          <div class="col-lg-8">
                  <?php echo $message2; ?>
                  <!-- Form Element sizes -->
                  <div class="card card-success">
                      <div class="card-header">
                          <h3 class="card-title">Contact Us Page</h3>
                      </div>
                      <form method="post" class="form-horizontal">
                          <div class="card-body">
                              <div class="form-group row">
                                  <label for="facebookInput" class="col-sm-3 col-form-label">Primary Email</label>
                                  <div class="col-sm-9 input-group">
                                      <input id="facebookInput" class="form-control" name="email1" type="text" placeholder="example@gmail.com"  value="<?php echo $email1 ; ?>" require>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <label for="instagramInput" class="col-sm-3 col-form-label">Secondary Email</label>
                                  <div class="col-sm-9 input-group mb-3">
                                      <input id="instagramInput" class="form-control" name="email2" type="text" placeholder="example@gmail.com"  value="<?php echo $email2  ?>" require>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <label for="instagramInput" class="col-sm-3 col-form-label">phone</label>
                                  <div class="col-sm-9 input-group mb-3">
                                      <input id="instagramInput" class="form-control" name="phone" type="text" placeholder="0175841415"  value="<?php echo $phone  ?>" require>
                                  </div>
                              </div>
                          </div>
                          <div id="errorMessage" class="col-sm-8 offset-sm-4 invalid-feedback" style="display: none;"></div>
                          <!-- /.card-body -->
                          <div class="card-footer">
                              <button type="submit" name="submitContact" class="btn btn-info float-right">Update</button>
                          </div>
                      </form>
                      <!-- /.card-body -->
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
