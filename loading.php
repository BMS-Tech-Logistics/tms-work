<?php
    include('include/header.php');
?>

   
<?php
    $result = "";
    $msg = "";

    // Function to generate a random short code
    function generateShortCode() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        $length = 6; // Length of the short code

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    if (isset($_POST['submit'])) {
        // Sanitize inputs
        $loading_point = isset($_POST['loading_point']) ? strip_tags($_POST['loading_point']) : '';
        $unloading_point = isset($_POST['unloading_point']) ? strip_tags($_POST['unloading_point']) : '';
        $name = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
        $date = isset($_POST['date']) ? strip_tags($_POST['date']) : '';
        $time = isset($_POST['time']) ? strip_tags($_POST['time']) : '';
        $phone = isset($_POST['phone']) ? strip_tags($_POST['phone']) : '';
        $vehi_name = isset($_POST['vehi_name']) ? strip_tags($_POST['vehi_name']) : '';
        $link = isset($_POST['link']) ? strip_tags($_POST['link']) : '';
        $driver_name = isset($_POST['driver_name']) ? strip_tags($_POST['driver_name']) : '';
        $driver_mobile = isset($_POST['driver_mobile']) ? strip_tags($_POST['driver_mobile']) : '';

        // Convert date to dd/mm/yyyy format
        $date_obj = DateTime::createFromFormat('Y-m-d', $date);
        $date_formatted = $date_obj ? $date_obj->format('d-m-Y') : null;

        // Convert time to 12-hour format with AM/PM
        $time_obj = DateTime::createFromFormat('H:i', $time);
        $time_formatted = $time_obj ? $time_obj->format('h:i A') : null;

        if (!$date_formatted || !$time_formatted) {
            echo "Invalid date or time format.";
            exit;
        }
        
        $original_url = $link;
        // Generate unique short code
        $short_code = "";
        $tracking_link = "";
        // Look up the original URL
        if($link==""){
            // Format the message content
            $msg = "Dear sir, Your Product has been Loaded.\n" .
                    "Load Point: $loading_point\n" .
                    "Loading Date: $date_formatted, $time_formatted\n" .
                    "Unload Point: $unloading_point\n" .
                    "Vehicle: $vehi_name\n" .
                    "Driver: $driver_name\n" .
                    "Driver Mobile: $driver_mobile";
        }
        else{
            $result = $objOperationAdmin->check_url_link($original_url);

            if ($result) {
                $short_code = $result; // Correct key is short_code
            }
            else {
                // Generate unique short code
                $short_code_gen = generateShortCode();
                // Look up the original URL
                $set_result = $objOperationAdmin->set_url_link($original_url, $short_code_gen);

                if ($set_result) {
                    // Redirect to the original URL
                    $short_code = $short_code_gen;
                } 
                else {
                    echo "Tracking URL not found! ".$short_code;
                }
            }
            $tracking_link = "https://tracking.dropshep.com/?gps=".$short_code;

            // Format the message content
            $msg = "Dear sir, Your Product has been Loaded.\n" .
                    "Load Point: $loading_point\n" .
                    "Loading Date: $date_formatted, $time_formatted\n" .
                    "Unload Point: $unloading_point\n" .
                    "Vehicle: $vehi_name\n" .
                    "Driver: $driver_name\n" .
                    "Driver Mobile: $driver_mobile\n" .
                    "Tracking link: $tracking_link";
        }

        // Define API credentials
        $apikey = '3b82495582b99be5';
        $secretkey = 'ae771458';
        $callerID = 'DROPSHEP';
        $toUser = $phone;

        $content = [[
            'callerID' => $callerID,
            'toUser' => $toUser,
            'messageContent' => $msg
        ]];

        $jsonContent = json_encode($content);
        $encodedContent = urlencode($jsonContent);

        $url = "http://apismpp.revesms.com/send?apikey=$apikey&secretkey=$secretkey&content=$encodedContent";

        $response = file_get_contents($url);

        if ($response === FALSE) {
            die('Error occurred while sending the request.');
        } 
        else {
            $response_data = json_decode($response, true);
            if ($response_data['Status'] == '0') {
                //  echo "SMS accepted with Message ID: " . $response_data['Message_ID'];
                // Split the string by commas and join with newlines
                $message_ids = explode(',', $response_data['Message_ID']);
                $message_id = implode(",\n", $message_ids);
                // Assign the request_id to $msg
                $sendresult = $objOperationAdmin->save_send_message($message_id, "Booking", "Success", $tracking_link, $_POST);
                if ($sendresult) {
                    $result = "yes";
                    $msg = "Message sent successfully";
                } else {
                    $result = "no";
                    $msg = "Error: Unable to save message.";
                }
            } else {
                echo "Error in sending SMS: " . $response_data['Text'];
            }
        }
        
        
    }
?>






<style>
   
     .row{
         
         margin-top: 10px;
         
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
                    <h1>Loading Sms Sent</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Loading Sms</li>
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
                                <h3 class="card-title">Loadin Sms Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="newEventForm" enctype="multipart/form-data" method="post">
                                
                                  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                                 <script>
                                     <?php if ($result == "yes") { ?>
                                     Swal.fire({
                                         title: 'Success',
                                         text: 'Sms Sent Success!',
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
                                    
                                    <div class="row">
                                        
                                     <div class="col-md-6 col-sm-6">
                                        <label> name *</label>
                                        <input type="text" name="name" class="form-control" required="required" placeholder="name">
                                    </div>

                                    <div class="col-md-6 col-sm-6">
                                        <label>Mobile*</label>
                                        <input class="form-control" name="phone" required="required" placeholder="phone">
                                    </div>
                                        
                                    </div>
                                    
                                   
                                <div class="row">
                                        
                                      <div class="col-md-6 col-sm-6">
                                        <label>Load point*</label>
                                        <input class="form-control" name="loading_point" required="required" placeholder="loading_point">
                                    </div>

                                       <div class="col-md-6 col-sm-6">
                                        <label>UnLoading Point*</label>
                                        <input class="form-control" name="unloading_point" required="required" placeholder="unloading_point" >
                                    </div>
                                    </div>

                                      <div class="row">
                                        
                                       <div class="col-md-6 col-sm-6">
                                        <label>Driver name *</label>
                                        <input type="text" name="driver_name" class="form-control" required="required" placeholder="driver_name">
                                    </div>

                                      <div class="col-md-6 col-sm-6">
                                        <label for="reservationeventdatetime">Driver Mobile Number*</label>
                                        <input type="text" name="driver_mobile" class="form-control" required="required" placeholder="driver_mobile">

                                    </div>
                                          
                                    </div>
                                    
                                      <div class="row">
                                        
                                        <div class="col-md-6 col-sm-6">
                                        <label for="reservationeventdatetime">Vechicle No*</label>
                                        <input type="text" name="vehi_name" class="form-control" required="required" placeholder="Vechicle No">

                                    </div>

                                        <div class="col-md-6 col-sm-6">
                                        <label for="reservationeventdatetime">Tracking Link</label>
                                        <input type="text" name="link" class="form-control" placeholder="link" >

                                    </div>
                                          
                                    </div>

                                    
                                      <div class="row">
                                        
                                    <div class=" col-md-6 col-sm-6">
                                        <label> Date <span class="required">*</span></label>
                                        <input class="form-control" class='date' type="date" name="date" required='required' placeholder="date">

                                    </div>


                                    <!-- time Picker -->
                                    <div class="col-md-6 col-sm-6 bootstrap-timepicker">
                                        <label>Time*</label>
                                        <div class="input-group date" id="timeRangePicker">
                                            <input class="form-control" class='time' type="time" name="time" required='required' placeholder="time">


                                        </div>
                                    </div>
                                          
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-block bg-gradient-primary btn-lg"> Submit</button>
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
</script>

<?php 
    include('include/footer.php');
?>