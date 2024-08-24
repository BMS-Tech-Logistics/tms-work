<?php
    include('include/header.php');
?>

<?php

    $result= "";
    if(isset($_POST['saveData'])){
        
        
         $date = isset($_POST['date']) ? strip_tags($_POST['date']) : '';


        // Convert date to dd/month/yyyy format
        $date_obj = DateTime::createFromFormat('Y-m-d', $date);
        $date_formatted = $date_obj->format('d-m-Y');
        
        //echo $date_formatted;

        
        $sendresult = $objOperationAdmin->save_bil_report($_POST,$date_formatted);

      if ($sendresult) {
          $result = "yes";
          $msg = "Message sent successfully";
      } else {
          $result = "no";
          $msg = "Error: Unable to save message.";
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
           color:darkorange
        }
    
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> Bill Report </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bill Report</li>
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

             <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                          <script>
                                              <?php if ($result == "yes") { ?>
                                              Swal.fire({
                                                  title: 'Success',
                                                  text: 'Bill Report Save!',
                                                  icon: 'success',
                                                  confirmButtonText: 'OK',
                                                  customClass: {
                                                      popup: 'swal2-popup'
                                                  }
                                              }).then((result) => {
                                                  if (result.isConfirmed) {
                                                      window.location.href = 'index.php'; // Change to your success page
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

                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Bill Entry Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="newEventForm" enctype="multipart/form-data" method="post">
                                
                                
                                
                                
                                
                                <div class="card-body">
                                    
                                      <div class=" form-group">
                                        <label> Date <span class="required">*</span></label>
                                        <input class="form-control" class='date' type="date" name="date" required='required'>

                                    </div>
                                    
                                    <div class="form-group">
                                          <label> Client Name</label>
                                          <input type="text" name="client_name" class="form-control" required="required">
                                      </div>
                                    <div class="form-group">
                                        <label> Destination/Routing</label>
                                        <input type="text" name="destination" class="form-control" required="required">
                                    </div>
                                      <div class="form-group">
                                          <label> Transport Category</label>
                                          <input type="text" name="trans_cate" class="form-control" required="required">
                                      </div> 

                                        <div class="form-group">
                                            <label>Transport Qty</label>
                                            <div>
                                                <select class="select2 form-control" name="transport_qty" id="transport_qty" required>
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
                                    

                                       <div class="form-group">
                                        <label>Transport Rate</label>
                                        <input class="form-control" name="transport_rate" id="transport_rate" type="number" step="0.01" required>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <label> Labour Qty </label>
                                       <div>
                                            <select class="select2 form-control" name="labour_qty" tabindex="-1" required>

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
                                 
                                    <div class="form-group">
                                        <label>Labour Rate  </label>
                                        <input type="text" name="labour_rate" class="form-control" required="required" value="890">
                                    </div>

                                    <div class="form-group">
                                        <label>Demaurrage Rate</label>
                                        <input type="number" name="demarage_rate" class="form-control" required="required">

                                    </div>
                                    
                                    
                                    <div class="border-sty">

                                        <label class="center-label"> Amount Without Vat!</label>
                                        <div class="form-group">
                                            <label>Transport Amount</label>
                                            <input class="form-control" id="total_cost" type="text" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="reservationeventdatetime">Labour</label>
                                            <input type="text" name="labour_v_out" class="form-control" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label for="reservationeventdatetime">Equipment</label>
                                            <input type="text" name="equipment" class="form-control" required="required">
                                        </div>
                                        
                                    </div>

                                    <div class="border-sty">

                                        <label class="center-label"> VAT Amount Vechicle: 10% & Labour: 15% </label>
                                        <div class="form-group">
                                            <label>Transport</label>
                                            <input type="number" name="trans_vat" class="form-control" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label for="reservationeventdatetime">Labour</label>
                                            <input type="number" name="labour_vat" class="form-control" required="required">
                                        </div>
                                     </div>

                                    
                                    <div class="border-st">

                                        <label class="center-label"> Amount With Vat </label>

                                        <div class="form-group">
                                            <label>Transport</label>
                                            <input type="number" name="trans_with_vat" class="form-control" required="required">

                                        </div>

                                        <div class="form-group">
                                            <label for="reservationeventdatetime">Labour</label>
                                            <input type="number" name="labour_with_vat" class="form-control" required="required">

                                        </div>
                                    </div>
                                    
                                    

                                    <div id="thumbnailContainer"></div>
                                    <button class="clear-button btn btn-danger" onclick="clearFileInput()">
                                        <i class="fas fa-times"></i> Clear
                                    </button>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="saveData" class="btn btn-block bg-gradient-primary btn-lg"> Submit</button>
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
            $('.select2_single').select2();

            function calculateTotal() {
                var rate = parseFloat($('#transport_rate').val());
                var qty = parseFloat($('#transport_qty').val());
                if (!isNaN(rate) && !isNaN(qty)) {
                    var total = rate * qty;
                    $('#total_cost').val(total.toFixed(2));
                }
            }

            $('#transport_rate, #transport_qty').on('input change', calculateTotal);
        });

</script>

<?php 
    include('include/footer.php');
?>