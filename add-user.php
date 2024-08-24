<?php
    include('include/header.php');
?>

<?php
    $result= "";

    if(isset($_POST['submitRegi'])){
        
        if($_POST['password']==$_POST['confirmPassword']){
            $password = $_POST['password'];
            $file = 'auth/common_passwords.txt';
            $handle = fopen($file, 'a'); // Open the file in append mode
            if ($handle) {
                fwrite($handle, $password . PHP_EOL); // Write the password followed by a newline
                fclose($handle);
            } else {
                echo "Unable to open file for writing.\n";
            }
            $setDealer = $objOperationAdmin->admin_registration_submit($_POST);
            if($setDealer){
                $result = "yes";
            }
            else{
                $result = "no";
            }
        }
        else{
            $result = "no";
        }
    }
?>


<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1>Add User</h1>
                  </div>
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="#">Home</a></li>
                          <li class="breadcrumb-item active">Add User</li>
                      </ol>
                  </div>
              </div>
          </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">

          <!-- Default box -->
          <div class="card card-solid">
              <div>

                  <div class="row">
                      <!-- left column -->

                      <div class="col-md-12">
                          <!-- jquery validation -->
                          <div class="card card-success">
                              <div class="card-header">
                                  <h3 class="card-title">New User Form</h3>
                              </div>
                              <!-- /.card-header -->
                              <!-- form start -->
                              <form id="userForm" method="post">
                                  
                                <script>
                                    <?php if ($result == "yes") { ?>
                                        Swal.fire({
                                            title: 'Success',
                                            text: 'Add Dealer Successful!',
                                            icon: 'success',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                popup: 'swal2-popup'
                                            }
                                        });

                                        <?php } else if ($result == "no") { ?> 
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Something Went wrong!',
                                            icon: 'error',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                popup: 'swal2-popup'
                                            }
                                        });
                                    <?php } ?>
                                </script>
                                  <div class="card-body">

                                      <div class="form-group">
                                          <label for="full_name">Full Name *</label>
                                          <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name" required>
                                      </div>

                                      <div class="row">
                                          <div class="form-group col-6">
                                              <label for="phone">Mobile *</label>
                                              <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter mobile" required>
                                          </div>

                                          <div class="form-group col-6">
                                              <label for="email">Email </label>
                                              <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-6">
                                              <label for="password">Password *</label>
                                              <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                          </div>

                                          <div class="form-group col-6">
                                              <label for="confirmPassword">Confirm Password *</label>
                                              <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Conform Password">
                                          </div>
                                      </div>
                                      
                                      <div class="row">
                                          <div class="form-group col-6">
                                              <label for="type">User Type *</label>
                                              <select id="type" class="select10 form-control" name="type" required>
                                                  <option value="" selected></option>
                                                  <option value="manager">TMS Manager</option>
                                                  <option value="superviser">Superviser</option>
                                                  <option value="moderator">Moderator</option>
                                              </select>
                                          </div>

                                          <div class="form-group col-6">
                                              <label for="status">Status *</label>
                                              <select id="status" class="select3 form-control" name="status" required>
                                                  <option value="1">Active</option>
                                                  <option value="0">Disable</option>
                                              </select>
                                          </div>
                                      </div>

                                  </div>
                                  <!-- /.card-body -->
                                  <div class="card-footer">
                                      <button type="submit" name="submitRegi" class="btn btn-primary">Submit</button>
                                  </div>
                              </form>
                          </div>
                          <!-- /.card -->
                      </div>
                  </div>
              </div>

          </div>
          <!-- /.card -->

      </section>
      <!-- /.content -->
  </div>

<!-------NID Number Filter-------->
<script>
    document.getElementById('dealer_nid').addEventListener('input', function (e) {
        let value = e.target.value;

        // Allow only digits and hyphen
        value = value.replace(/[^\d-]/g, '');


        // Limit the length to 17 characters
        if (value.length > 17) {
            value = value.substring(0, 17);
        }

        // Update the input value
        e.target.value = value;
    });
</script>

<!------Contact Filter------->
<script>
    function formatMobileInput(e) {
        let value = e.target.value;

        // Allow only digits and hyphen
        value = value.replace(/[^\d-]/g, '');

        // Enforce the pattern "xxxxx-xxxxxxx"
        if (value.length > 5) {
            // Add hyphen after the first 5 digits if not present
            value = value.replace(/(\d{5})(-?)(\d{0,7})/, '$1-$3');
        } else {
            // Only allow up to 5 digits before the hyphen
            value = value.replace(/(\d{0,5})/, '$1');
        }

        // Limit the length to 12 characters
        if (value.length > 12) {
            value = value.substring(0, 12);
        }

        // Update the input value
        e.target.value = value;
    }

    // Apply to both fields
    document.getElementById('emergency_contact').addEventListener('input', formatMobileInput);
    document.getElementById('dealer_mobile').addEventListener('input', formatMobileInput);
</script>

<!-----Current date get----->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        var year = today.getFullYear();
        var formattedDate = day + '-' + month + '-' + year;
        document.getElementById('join_date').value = formattedDate;
    });
</script>

<?php 
    include('include/footer.php');
?>