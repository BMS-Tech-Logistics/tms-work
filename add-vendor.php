<?php
    include('include/header.php');
?>

<?php
    //Create and Upload Data
    //$getNewsPartnerList = $objOperationAdmin->getAllNewsPartnerInfo();

    //Create and Upload Data
    $result= "";
    if(isset($_POST['submitVendor'])){

        $setVendor = $objOperationAdmin->save_new_vendor($_POST);
        if($setVendor){
            $result = "yes";
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
            <h1>Add Vendor</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Vendor Information</li>
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
                                <h3 class="card-title"> Vendor Information </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="newsAndMediaForm" method="post">
                                <script>
                                    <?php if ($result == "yes") { ?>
                                        Swal.fire({
                                            title: 'Success',
                                            text: 'Add New Vendor Successful!',
                                            icon: 'success',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                popup: 'swal2-popup'
                                            }
                                        });

                                        <?php } else if ($result == "no") { ?> Swal.fire({
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
                                        <label for="vendor_name">Vendor Name *</label>
                                        <input type="text" id="vendor_name" name="vendor_name" class="form-control" placeholder="Vendor Name" required>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="vendor_mobile">Mobile *</label>
                                            <input type="text" id="vendor_mobile" name="vendor_mobile" class="form-control" placeholder="Mobile" required>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="vendor_email">Email</label>
                                            <input type="email" id="vendor_email" name="vendor_email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    
                                      
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="category">Rent Category *</label>
                                            <select id="category" class="select2 form-control" name="rent_cate" required>
                                                <option value=""></option>
                                                <option value="Truck">ট্রাক</option>
                                                <option value="Pickup">পিকআপ</option>
                                                <option value="Covered Van">কভার্ড ভ্যান</option>
                                                <option value="Trailor">ট্রেইলর</option>
                                                <option value="Freezer Van">ফ্রিজার ভ্যান</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="work_area">Work Area *</label>
                                            <input type="text" id="work_area" name="work_area" class="form-control" placeholder="Work Area" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="reservationeventdatetime">Join Date *</label>
                                        <div class="input-group date" id="reservationeventdatetime" data-target-input="nearest">
                                            <input type="text" name="join_date" id="join_date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#join_date" placeholder="Join Date" required>
                                            
                                            <div class="input-group-append" data-target="#reservationeventdatetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="status">Status *</label>
                                        <select id="status" class="select3 form-control" name="status" required>
                                            <option value=""></option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group" hidden>
                                        <label for="image">Profile  Image</label>
                                        <input type="file" id="image" name="image" class="form-control"  accept="image/*" placeholder="Profile  Image" >
                                    </div>
                                  
                                   
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="submitVendor" class="btn btn-block bg-gradient-primary btn-lg">  Submit</button>
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