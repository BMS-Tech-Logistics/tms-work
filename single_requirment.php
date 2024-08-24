<?php
    include('include/header.php');
?>

<?php

       $getUserList = $objOperationAdmin->getDealerList(); 
      $getVehicle = $objOperationAdmin->getVehicleList();

    
 
    $result = "";
    $msg = "";
    if(isset($_POST['saveData'])){

       
        $saveTrip=$objOperationAdmin->save_trip($_POST);
        
         if($saveTrip){
            $result = "yes";
        }
        else{
            $result = "no";
        }
        
        
        
        

    }
?>

<style>
  

    .border-sty {
        border: 1px solid green;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 10px
    }

    .border-st {
        border: 1px solid blue;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 10px
    }

    .center-label {
        display: flex;
        justify-content: center;
        align-items: center;
        color: darkorange;
        margin-bottom: 20px;

    }


    .row {
        display: flex;
        margin-bottom: 15px;
    }
    
    
    
     .swal2-popup {
        width: 330px; /* Adjust the width as needed */
        height: 330px; /* This will adjust the height based on the content */
       // max-width: 80%; /* Optional: To make it responsive */
        padding: 20px; /* Optional: Adjust padding if needed */
    }

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trip Create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Trip Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">


            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Trip  Create Form</h3>


                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="newEventForm" enctype="multipart/form-data" method="post">

                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                <?php if ($result == "yes") { ?>
                                Swal.fire({
                                   // title: 'Success',
                                    text: 'Trip  Report Save !',
                                   icon: 'success',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'swal2-popup'
                                    }
                                });
                                
                                <?php } else if ($result == "no") { ?> Swal.fire({
                                    title: 'Error',
                                    text: 'Something Went wrong.',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'swal2-popup'
                                    }
                                });
                                <?php } ?>

                            </script>
                            <div class="card-body">


                                <div class=" border-sty">

                                    <div class="row">
                                        <div class="col-md-6 col-sm-4">
                                            <label for="reservationeventdatetime">Date *</label>
                                            <div class="input-group date" id="reservationeventdatetime" data-target-input="nearest">
                                                <input type="text" name="date" id="event_date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#event_date" placeholder="example: 15/07/2024">
                                                <div class="input-group-append" data-target="#reservationeventdatetime" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="vendor_name">Dealer Name</label>
                                            <select id="dealer_id" class="select2 form-control" name="dealer_name" required>

                                                <optgroup>
                                                    <?php while($userData=mysqli_fetch_array($getUserList)){ ?>
                                                    <option value="<?php echo $userData['dealer_name'] ?>"><?php echo $userData['dealer_name']; ?>
                                                        <?php echo $userData['district'] ?></option>
                                                    <?php } ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        

                                        <div class="col-md-6 col-sm-4">
                                            <label for="price"> Load point</label>
                                            <input id="price" type="text" name="load_point" class="form-control" required placeholder=" Load point">
                                        </div>

                                        <div class="col-md-6 col-sm-4">
                                            <label for="price"> Unload</label>
                                            <input id="price" type="text" name="unload_point" class="form-control" required placeholder="Unload">
                                        </div>

                                    </div>
                         

                                  <div class="row">

                                            <div class="col-md-6 col-sm-4">
                                                <label for="category">Rent Amount</label>
                                                <input type="text" name="rent_amount" class="form-control" required placeholder="Rent Amount">

                                            </div>
                                             <div class="col-md-6 col-sm-4">
                                            <label for="client_name">Vehicle Number</label>
                                            <select id="client_name" class="select2 form-control" name="vehicle_no" required>
                                                <optgroup>
                                                    <?php while($userData=mysqli_fetch_array($getVehicle)){ ?>
                                                    <option value="<?php echo $userData['vehicle_zone']; ?>-
                                                        <?php echo $userData['vehicle_serial'] ?> <?php echo $userData['vehicle_number'] ?>  "><?php echo $userData['vehicle_zone']; ?>-
                                                        <?php echo $userData['vehicle_serial'] ?> <?php echo $userData['vehicle_number'] ?></option>
                                                    
                                                   
                                                    <?php } ?>
                                                   
                                                </optgroup>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-6 col-sm-4">
                                            <label for="category">Driver Name</label>
                                            <input type="text" name="driver_name" class="form-control" required placeholder="Driver Name">

                                        </div>
                                        <div class="col-md-6 col-sm-4">
                                            <label for="category">Driver Mobile</label>
                                            <input type="text" name="driver_mobile" class="form-control" required placeholder="Driver Mobile">

                                        </div>

                                    </div>
                                    
                                </div>

                                

                                <div class="border-st">

                                    <label class="center-label"> Product section!</label>
                                    <div class="row">

                                        <div class="col-md-6 col-sm-6">
                                            <label for="labour_qty">Product Type</label>
                                            <select id="labor_qty" class="select2 form-control" name="product_type">
                                                <option value="Box">Box</option>
                                                <option value="Ton">Ton</option>
                                                <option value="Unit">Unit</option>
                                              
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <label for="price"> Product Quantity</label>
                                            <input id="labor_rate" type="text" name="product_qty" class="form-control" placeholder="Product Quantity">
                                        </div>

                                    </div>


                                    <label class="center-label"> Sms And chalan Section </label>

                                    <div class="row">

                                        <div class="col-md-6 col-sm-4">
  
                                    <label for="revenue">Chalan No</label>
                                    <input id="revenue" type="number" name="chalan_no" class="form-control" required min="0" placeholder="Chalan No">
                                
                                        </div>

                                        <div class="col-md-6 col-sm-4">
                                            <label for="send_sms">SMS Sent Done *</label>
                                            <select id="send_sms" class="select2 form-control" name="sms_sent" required readonly>
                                            
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                    </div>
                              
                                </div>
                              

                            </div>
                            <div class="card-footer">
                                <button type="submit" name="saveData" class="btn btn-block bg-gradient-primary btn-lg">Submit</button>
                            </div>
                        </form>



                    </div>
                    <!-- /.card -->
                </div>

            </div>

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>


<!--Custom image select and view-->
<script>
    function displayThumbnail() {
        const fileInput = document.getElementById('customImage');
        const files = fileInput.files;
        const thumbnailContainer = document.getElementById('thumbnailContainer');
        thumbnailContainer.innerHTML = '';

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const thumbnailDiv = document.createElement('div');
            thumbnailDiv.classList.add('thumbnail-container');
            const thumbnail = document.createElement('img');
            const fileDetails = document.createElement('div');
            fileDetails.classList.add('thumbnail-details');
            thumbnail.classList.add('thumbnail');
            thumbnail.src = URL.createObjectURL(file);
            fileDetails.innerHTML = `<div class="thumbnail-name">${file.name}<button class="clear-button btn btn-danger" onclick="clearFileInput()"><i class="fas fa-times"></i> Clear</button></div>
            <p class="thumbnail-size">${formatBytes(file.size)}</p>`;
            thumbnailDiv.appendChild(thumbnail);
            thumbnailDiv.appendChild(fileDetails);
            thumbnailContainer.appendChild(thumbnailDiv);
        }

        // Show the clear button when a file is selected
        const clearButton = document.querySelector('.clear-button');
        clearButton.style.display = 'block';
    }

    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    function clearFileInput() {
        const fileInput = document.getElementById('customImage');
        fileInput.value = ''; // Clear the file input
        const thumbnailContainer = document.getElementById('thumbnailContainer');
        thumbnailContainer.innerHTML = ''; // Clear the thumbnail container

        // Clear the label title
        const label = document.querySelector('.custom-file-label');
        label.innerText = 'Choose file';

        // Hide the clear button after clearing the file input
        const clearButton = document.querySelector('.clear-button');
        clearButton.style.display = 'none';
    }


   
        
        
        

      
      
       




    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        var year = today.getFullYear();
        var formattedDate = day + '-' + month + '-' + year;
        document.getElementById('event_date').value = formattedDate;
    });
</script>

<?php 
    include('include/footer.php');
?>
