<?php
    include('include/header.php');
?>

<?php

  if(isset($_GET['user_id'])){
        $_SESSION['id'] = $_GET['user_id'];
        $user_id = $_GET['user_id'];
    }
    else if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }
    $getsmsInfo = $objOperationAdmin->getInfSingleById($user_id);
    $smsinfo=mysqli_fetch_array($getsmsInfo);




 
    $result = "";
    $msg = "";
    if(isset($_POST['saveData'])){

     


        // Convert date to dd/month/yyyy format
        //$date_obj = DateTime::createFromFormat('Y-m-d', $date);
        //$date_formatted = $date_obj->format('d-m-Y');
        
        //echo $date_formatted;

            $sendresult = $objOperationAdmin->updateSingleReport($_POST,$user_id);
            if ($sendresult) {
              $result = "yes";
            } 
            else {
              $result = "no";
            }
        
        
      }
?>
<style>
    .custom-file-preview {
        display: none;
        max-width: 100%;
        height: auto;
    }

    .thumbnail-container {
        display: flex;
        align-items: center;
    }

    .thumbnail {
        width: 160px;
        height: auto;
        margin-right: 10px;
    }

    .thumbnail-details {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .thumbnail-name,
    .thumbnail-size {
        margin: 0;
    }

    .thumbnail-name {
        font-weight: bold;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .thumbnail-size {
        color: #666;
    }

    .clear-button {
        display: none;
        /* Hide the clear button initially */
        margin-top: 10px;
    }

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

</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Update Mis Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"> Update Mis Report</li>
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
                    <div class="card card-warning">
                        <div class="card-header">
                            <h3 class="card-title"> Update Mis Report Form</h3>


                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form id="newEventForm" enctype="multipart/form-data" method="post">

                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                <?php if ($result == "yes") { ?>
                                Swal.fire({
                                   // title: 'Success',
                                    text: 'Mis Report Update!',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'swal2-popup'
                                    }
                                }) .then((result) => {
                                                 if (result.isConfirmed) {
                                                     window.location.href = 'report.php'; // Change to your success page
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
                                    <label class="center-label"> Location & Date section!</label>
                                    <div class="row">
                                        <div class="col-md-4 col-sm-4">
                                            <label for="reservationeventdatetime">Date *</label>
                                            <div class="input-group date" id="reservationeventdatetime" data-target-input="nearest">
                                                <input type="text" name="date" id="event_date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#event_date" placeholder="example: 15/07/2024" value="<?php echo $smsinfo['date']; ?>">
                                                <div class="input-group-append" data-target="#reservationeventdatetime" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label for="price"> Load point</label>
                                            <input id="price" type="text" name="load_point" class="form-control" required placeholder=" Load point" value="<?php echo $smsinfo['load_point']; ?>">
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label for="price"> Unload</label>
                                            <input id="price" type="text" name="unload_point" class="form-control" required placeholder="Unload" value="<?php echo $smsinfo['unload_point']; ?>">
                                        </div>

                                    </div>
                                </div>

                                <div class=" border-sty">
                                    <label class="center-label"> Requirement section!</label>
                                    <div class="row">

                                        <div class="col-md-4 col-sm-4">
                                            <label for="requirement_type">Requirement Type</label>
                                            <select id="requirement_type" class="select2 form-control" name="req_type" required >
                                                     <option value="<?php echo $smsinfo['req_type'];?>"> <?php echo $smsinfo['req_type'];?> </option>
                                                <option value="App">App</option>
                                                <option value="Web">Web</option>
                                                <option value="Social">Social</option>
                                                <option value="manual">Manual</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label for="client_name">Client Name</label>
                                            <select id="client_name" class="select2 form-control" name="client_name" required>
                                                <option value="<?php echo $smsinfo['client_name'];?>"> <?php echo $smsinfo['client_name'];?></option>
                                                <option value="DHL">DHL</option>
                                                <option value="Haier">Haier</option>
                                                <option value="GE">GE</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label for="client_type">Client Type</label>
                                            <select id="client_type" class="select2 form-control" name="client_type" required>
                                                 <option value="<?php echo $smsinfo['client_type'];?>"> <?php echo $smsinfo['client_type'];?>
                                                <option value="B2B">B2B</option>
                                                <option value="B2C">B2C</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class=" border-sty">
                                    <label class="center-label"> Transport section!</label>
                                    <div class="row">

                                        <div class="col-md-4 col-sm-4">
                                            <label for="category">Transport Category</label>
                                            <select id="category" class="select2 form-control" name="trans_cate" required>
                                                <option value="<?php echo $smsinfo['trans_cate'];?>"> <?php echo $smsinfo['trans_cate'];?>
                                                    
                                                <optgroup label="Trucks">
                                                    <option value="Truck 16ft 7.5 ton">Truck 16ft 7.5 ton</option>
                                                    <option value="Truck 18ft 15 ton">Truck 18ft 15 ton </option>
                                                    <option value="Truck 20ft 15 ton">Truck 20ft 15 ton </option>
                                                    <option value="Truck 23ft 25 ton">Truck 23ft 25 ton</option>

                                                </optgroup>

                                                <optgroup label="Pickup">
                                                    <option value="Pickup 7ft 1 ton">Pickup 7ft 1 ton</option>
                                                    <option value="Pickup 9ft 1.5 ton">Pickup 9ft 1.5 ton </option>
                                                    <option value="Pickup 12ft 2 ton">Pickup 12ft 2 ton </option>
                                                    <option value="Pickup 14ft 3.5 ton ">Pickup 14ft 3.5 ton </option>

                                                </optgroup>

                                                <optgroup label="Covered">
                                                    <option value="Covered Van 7ft 1 ton">Covered Van 7ft 1 ton</option>
                                                    <option value="Covered Van 9ft 1.5 ton">Covered Van 9ft 1.5 ton</option>
                                                    <option value="Covered Van 12ft 2 ton">Covered Van 12ft 2 ton</option>
                                                    <option value="Covered Van 14ft 3.5 ton">Covered Van 14ft 3.5 ton</option>
                                                    <option value="Covered Van 16ft  7.5 ton">Covered Van 16ft 7.5 ton</option>
                                                    <option value="Covered Van 18ft 15 ton">Covered Van 18ft 15 ton</option>
                                                    <option value="Covered Van 18ft  15 ton">Covered Van 18ft 15 ton</option>
                                                    <option value="Covered Van 20 ft 15 ton">Covered Van 20ft 15 ton</option>
                                                    <option value="Covered Van 23 ft 15 ton">Covered Van 23ft 15 ton</option>

                                                </optgroup>

                                                <option value="Tailor 20ft">Tailor 20ft </option>
                                                <option value="Tailor 40ft">Tailor 40ft</option>

                                                <option value="Freezer Van 12ft">Freezer Van 12ft </option>
                                                <option value="Freezer Van 14ft">Freezer Van 14ft </option>
                                                <option value="Freezer Van 16ft">Freezer Van 16ft </option>
                                                <option value="Freezer Van 18ft">Freezer Van 18ft </option>

                                            </select>

                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label for="requirement_qty">Transport Quantity</label>
                                            <select class="select2  form-control" name="trans_qty" id="transport_qty" required>
                                                <option value="<?php echo $smsinfo['trans_qty']; ?>"><?php echo $smsinfo['trans_qty']; ?></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label for="requirement_qty">Transport Rate</label>
                                            <input type="number" name="trans_rate" class="form-control" id="transport_rate" required placeholder="00" value="<?php echo $smsinfo['trans_rate']; ?>">

                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="col-md-4 col-sm-4">
                                            <label for="price"> Demurage Rate</label>
                                            <input id="d_rate" type="number" name="trans_d_rate" class="form-control" placeholder="00" value="<?php echo $smsinfo['trans_d_rate']; ?>">
                                        </div>


                                        <div class="col-md-4 col-sm-4">
                                            <label for="labour_qty">Demurage Quantity</label>
                                            <select id="demu_qty" class="select2 form-control" name="trans_d_qty">
                                                <option value="<?php echo $smsinfo['trans_d_qty']; ?>"><?php echo $smsinfo['trans_d_qty']; ?></option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label>Transport Amount</label>
                                            <input class="form-control" id="total_cost" type="text" name="trans_cost" readonly value="<?php echo $smsinfo['trans_cost']; ?>">

                                        </div>

                                        </div>

                                </div>


                                <div class="border-st">

                                    <label class="center-label"> Labor section!</label>
                                    <div class="row">

                                        <div class="col-md-6 col-sm-6">
                                            <label for="labour_qty">Labour Quantity</label>
                                            <select id="labor_qty" class="select2 form-control" name="labor_qty">
                                                
                                                <option value="<?php echo $smsinfo['labor_qty']; ?>"><?php echo $smsinfo['labor_qty']; ?></option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-sm-6">
                                            <label for="price"> Labor Rate</label>
                                            <input id="labor_rate" type="number" name="labor_rate" class="form-control"  placeholder="00" value="<?php echo $smsinfo['labor_rate']; ?>" >
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-4 col-sm-4">
                                            <label for="over_qty"> Quantity</label>
                                            <select id="over_qty" class="select2 form-control" name="labor_over_qty">
                                                <option value="<?php echo $smsinfo['labor_over_qty']; ?>"><?php echo $smsinfo['labor_over_qty']; ?></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label for="price"> Over Time Rate</label>
                                            <input id="over_rate" type="text" name="labor_over_rate" class="form-control"  placeholder="00" value="<?php echo $smsinfo['labor_over_rate']; ?>">
                                        </div>
                                           <div class="col-md-4 col-sm-4">
                                            <label for="reservationeventdatetime"> Toatl  Labour Cost</label>
                                            <input type="text" name="labor_cost" class="form-control" id="labor_cost" readonly value="<?php echo $smsinfo['labor_cost']; ?>">

                                        </div>

                                    </div>

                                </div>

                                <div class=" border-sty">

                                    <label class="center-label"> Equipment section!</label>

                                    <div class="row">

                                        <div class="col-md-4 col-sm-4">
                                            <label for="price"> Equipment Name</label>
                                            <input type="text" name="eq_name" class="form-control"  placeholder="Equipment Name" value="<?php echo $smsinfo['eq_name']; ?>">
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label for="price"> Equipment Rate</label>
                                            <input id="eq_rate" type="number" name="eq_rate" class="form-control"  placeholder="00" value="<?php echo $smsinfo['eq_rate']; ?> " >
                                        </div>


                                        <div class="col-md-4 col-sm-4">
                                            <label for="">Equipment Quantity</label>
                                            <select id="eq_qty" class="select2 form-control" name="eq_qty">
                                                
                                                <option value="<?php echo $smsinfo['eq_qty']; ?> "><?php echo $smsinfo['eq_qty']; ?> </option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>


                                    </div>


                                    <div class="row">

                                        <div class="col-md-4 col-sm-4">
                                            <label for="price"> Demurage Rate</label>
                                            <input id="eqd_rate" type="number" name="eq_d_rate" class="form-control"  placeholder="00" value="<?php echo $smsinfo['eq_d_rate']; ?>">
                                        </div>

                                        <div class="col-md-4 col-sm-4">
                                            <label for="">Demurage Quantity</label>
                                            <select id="eqd_qty" class="select2 form-control" name="eq_d_qty">
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-4">
                                            <label for="reservationeventdatetime">Total Cost</label>
                                            <input type="text" name="e_total" class="form-control" required="required" id="eq_total" readonly value="<?php echo $smsinfo['e_total']; ?>">

                                        </div>

                                    </div>
                                </div>


                                <!--       Vat Amount Start-->

                                <div class=" border-sty">

                                    <label class="center-label"> VAT Amount Vechicle: 10% & Labour: 15% </label>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <label>transport vat rate </label>
                                            <input type="number"  class="form-control" id="trans_vat" required="required" placeholder="15%">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label>Transport Vat Amount</label>
                                            <input type="number" name="trans_vat" class="form-control" id="vat_amount" required="required" readonly value="<?php echo $smsinfo['trans_vat'];?>">
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <label> Labor Vat rate </label>
                                            <input type="number"  class="form-control" id="labor_vat"  placeholder=" example 15%">
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label for="reservationeventdatetime">Labour vat Amount</label>
                                            <input id="labor_v_amount" type="number" name="labor_vat" class="form-control"  readonly value="<?php echo $smsinfo['labor_vat'];?>">

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6">
                                            <label> Equipment Vat  rate </label>
                                            <input type="number"  class="form-control" id="eq_vat"  placeholder=" example 15%" >
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <label for="reservationeventdatetime">Equipment vat Amount</label>
                                            <input id="eq_v_amount" type="number" name="equip_vat" class="form-control"readonly value="<?php echo $smsinfo['equip_vat'];?>">

                                        </div>

                                    </div>
                                </div>


                                <!--       Vat Amount End   -->




                                <!--   Total amount with vat start -->

                                <div class="border-st">

                                    <label class="center-label"> Amount With Vat </label>
                                    <div class="row">

                                        <div class="col-md-3 col-sm-3">
                                            <label>Transport</label>
                                            <input type="number" name="trans_with_vat" id="tranport_cost" class="form-control" readonly >

                                        </div>
                                        <div class="col-md-0">
                                            <label></label>

                                            <h1> + </h1>
                                        </div>

                                        <div class="col-md-3 col-sm-3">
                                            <label for="reservationeventdatetime">Labour</label>
                                            <input type="number" name="labour_with_vat" id="labour_with_vat" class="form-control" readonly>

                                        </div>
                                        <div class="col-md-0">
                                            <label></label>

                                            <h1> + </h1>
                                        </div>

                                        <div class="col-md-3 col-sm-3">
                                            <label for="reservationeventdatetime">Equipment</label>
                                            <input type="number"  id="eq_with_v" class="form-control" readonly>



                                        </div>
                                        <div class="col-md-0">
                                            <label></label>

                                            <h1> = </h1>
                                        </div>

                                        <div class="col-md-2 col-sm-2">
                                            <label for="price">Total Sales</label>
                                            <input id="total_price" type="number" name="price" class="form-control" required min="0" readonly>
                                        </div>
                                    </div>

                                </div>
                                <!--   Total amount with vat end -->
                                <div class="border-sty">

                                    <label class="center-label"> Sms And portal Section </label>

                                    <div class="row">

                                        <div class="col-md-6 col-sm-4">

                                            <label for="client_type">App Post Done *</label>
                                            <select id="client_type" class="select2 form-control" name="app_post_done" required readonly>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-sm-4">
                                            <label for="client_type">SMS Sent Done *</label>
                                            <select class="select2 form-control" name="sms_sent_done" required readonly>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="revenue">Revenue</label>
                                    <input id="revenue" type="number" name="revenue" class="form-control" placeholder="00" value="<?php echo $smsinfo['revenue']; ?>" >
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


    $(document).ready(function() {
        // Initialize Select2 on the relevant select elements
        $('.select2_single').select2();
        $('.select2').select2();

      
                function calculateTotal() {

                    var rate = parseFloat($('#transport_rate').val());
                    var qty = parseFloat($('#transport_qty').val());
                    var drate = parseFloat($('#d_rate').val());
                    var dqty = parseFloat($('#demu_qty').val());


                    if (!isNaN(rate) && !isNaN(qty) && !isNaN(drate) && !isNaN(dqty)) {

                        var total = rate * qty + drate * dqty;

                        $('#total_cost').val(total.toFixed(2));
                    }
                }

            function calculateLabor() {
               
                var rate = parseFloat($('#labor_rate').val());
                var qty = parseFloat($('#labor_qty').val());
                var over_rate = parseFloat($('#over_rate').val());
                var over_qty = parseFloat($('#over_qty').val());

                
                if (!isNaN(rate) && !isNaN(qty) && !isNaN(over_rate) && !isNaN(over_qty)) {
                 
                    var total = rate * qty + over_qty * over_rate;
                  
                    $('#labor_cost').val(total.toFixed(2));
                }
            }

              function calculateEquipment() {
                var eq_rate = parseFloat($('#eq_rate').val());
                var eq_qty = parseFloat($('#eq_qty').val());
                var eqd_qty = parseFloat($('#eqd_qty').val());
                var eqd_rate = parseFloat($('#eqd_rate').val());

               
                if (!isNaN(eq_rate) && !isNaN(eq_qty) && !isNaN(eqd_qty) && !isNaN(eqd_rate)) {
                  
                    var total = eq_rate * eq_qty + eqd_qty * eqd_rate;
               
                   
                    $('#eq_total').val(total.toFixed(2));
                }
             }
        
        
        
        
        

        function vatcalTran() {
            var rate = parseFloat($('#trans_vat').val());
            var total = parseFloat($('#total_cost').val());
            if (!isNaN(rate) && !isNaN(total)) {
                var totalVat = total * (rate/100);
                var sub_total = total+totalVat;
                
                $('#vat_amount').val(totalVat.toFixed(2));
                
                $('#tranport_cost').val(sub_total.toFixed(2));
            }
        }

        function vatcalL() {
            var rate = parseFloat($('#labor_vat').val());
            var total = parseFloat($('#labor_cost').val());
            
            //var sub_total_transport = parseFloat($('#tranport_cost').val());
          //  var sub_total_e = parseFloat($('#eq_with_v').val());
            
            if (!isNaN(rate) && !isNaN(total)) {
                var totalVat = total * (rate/100);
                var sub_total = total+totalVat;
                
                $('#labor_v_amount').val(totalVat.toFixed(2));
                $('#labour_with_vat').val(sub_total.toFixed(2));
                
                
                //When Labour end Part
                
               // var total_amount = sub_total_transport +sub_total+sub_total_e;
               // $('#total_price').val(total_amount.toFixed(2));
                
                
                
            }
        }
        
     

        function vatcalE() {
            var rate = parseFloat($('#eq_vat').val());
            var total = parseFloat($('#eq_total').val());
            
             var sub_total_transport = parseFloat($('#tranport_cost').val());
            var sub_total_l = parseFloat($('#labour_with_vat').val());
            
            
            if (!isNaN(rate) && !isNaN(total)) {
                var totalVat = total * (rate/100);
                var sub_total = total+totalVat;
                var amount=totalVat+total;
                
                $('#eq_v_amount').val(totalVat.toFixed(2));
                
                $('#eq_with_v').val(amount.toFixed(2));
                
                   var total_amount = sub_total_transport +amount+sub_total_l;
                $('#total_price').val(total_amount.toFixed(2));
                
                
                
                
            }
        }


       $('#transport_rate, #transport_qty, #d_rate, #demu_qty').on('input change', calculateTotal);

        $('#labor_rate, #labor_qty, #over_rate, #over_qty').on('input change', calculateLabor);
    
      $('#eq_rate, #eq_qty, #eqd_qty, #eqd_rate').on('input change', calculateEquipment);
    
        $('#eq_vat, #eq_total').on('input change', vatcalE);
        
        $('#labor_vat, #labor_cost').on('input change', vatcalL);
        $('#trans_vat, #total_cost').on('input change', vatcalTran);
        
       $('#total_cost, #vat_amount').on('input change', vWithTrans);
   
      
       




    });

</script>

<?php 
    include('include/footer.php');
?>
