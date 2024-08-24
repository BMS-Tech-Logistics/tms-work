<?php
    include('include/header.php');
?>

<?php
$result="";
    $user_id='';
    if(isset($_GET['user_id'])){
        $_SESSION['id'] = $_GET['user_id'];
        $user_id = $_GET['user_id'];
    }
    else if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }
    $getsmsInfo = $objOperationAdmin->getSmsInfoById($user_id);
    $smsinfo=mysqli_fetch_array($getsmsInfo);

    if(isset($_POST['updateUserInfo'])){
        //User ID Load In SESSION
        
        $result="";
      $loading_point = isset($_POST['loading_point']) ? strip_tags($_POST['loading_point']) : '';
            $unloading_point = isset($_POST['unloading_point']) ? strip_tags($_POST['unloading_point']) : '';
            $name = isset($_POST['name']) ? strip_tags($_POST['name']) : '';
            $date = isset($_POST['date']) ? strip_tags($_POST['date']) : '';
            $time = isset($_POST['time']) ? strip_tags($_POST['time']) : '';
            $phone = isset($_POST['phone']) ? strip_tags($_POST['phone']) : '';
            $vehi_name = isset($_POST['vehi_name']) ? strip_tags($_POST['vehi_name']) : '';
            $driver_name = isset($_POST['driver_name']) ? strip_tags($_POST['driver_name']) : '';
            $driver_mobile = isset($_POST['driver_mobile']) ? strip_tags($_POST['driver_mobile']) : '';
        
        // Convert date to dd/month/yyyy format
        $date_obj = DateTime::createFromFormat('Y-m-d', $date);
        $date_formatted = $date_obj->format('d-m-Y');

        // Convert time to 12-hour format with AM/PM
        $time_obj = DateTime::createFromFormat('H:i', $time);
        $time_formatted = $time_obj->format('h:i A');
        

        $apikey = "3b82495582b99be5";
        $secretkey = "ae771458";
        $callerID = "DROPSHEP";
        $toUser=$phone;

      $msg = "Dear sir, Your Required Trip Cancel .\n" .
          
                "Load Point: $loading_point\n" .
                "Load Date: $date_formatted ,$time_formatted\n" .
                "Delivery Point: $unloading_point\n" .
                "Vehicle: $vehi_name\n" .
                "Driver: $driver_name\n" .
                "Driver Mobile: $driver_mobile\n";

       $content = [
                [
                    'callerID' => $callerID,
                    'toUser' => $toUser,
                    'messageContent' => $msg
                ]
            ];

            $jsonContent = json_encode($content);
            $encodedContent = urlencode($jsonContent);

            $url = "http://apismpp.revesms.com/send?apikey=$apikey&secretkey=$secretkey&content=$encodedContent";

            $response = file_get_contents($url);
        
        
        if ($response === false) {
            echo 'Curl error: ' . curl_error($curl);
        } 
        
        else {
            $response_data = json_decode($response, true);
            if ($response_data['Status'] == '0') {
                //echo "SMS accepted with Message ID: " . $response_data['Message_ID'];
                // Assign the request_id to $msg
                $sendresult =$objOperationAdmin->updatedSmsHistory($user_id, $_POST);
                if ($sendresult) {
                    $result = "yes";
                    $msg = "Message sent successfully";
                } else {
                    $result = "no";
                    $msg = "Error: ";
                }
            } else {
                echo "Error in sending SMS: " . $response_data['Text'];
            }
        }

       // curl_close($curl);
    
        
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
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Trip cancel Sms</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Trip cancel Sms</li>
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
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Trip cancel Sms</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="newEventForm" enctype="multipart/form-data" method="post">
                                
                                <?php 
                                if ($result == "yes") {
                                    echo '<div class="field item form-group"><div class="success">'.$msg.'</div></div>';
                                } else if ($result == "no") {
                                    echo '<div class="field item form-group"><div class="error">'.$msg.'</div></div>';
                                }
                            ?>
                                
                                
                                <div class="card-body">
                                    <div class="form-group">
                                        <label> name</label>
                                      <input class="form-control" name="name" placeholder="" required="required" value="<?php echo $smsinfo['name']; ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Mobile</label>
                                      <input class="form-control" type="text"  name="phone" required='required' data-validate-length-range="" value="<?php echo $smsinfo['phone']; ?>" >
                                    </div>

                                    <div class="form-group">
                                        <label>Load point</label>
                                        <input class="form-control" class='optional' name="loading_point" placeholder="" type="text"   value="<?php echo $smsinfo['loading_point']; ?>" required  readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>UnLoading Point</label>
                                        <input class="form-control" class='optional' name="unloading_point" placeholder="" type="text"  value="<?php echo $smsinfo['unloading_point']; ?>" required readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>Driver name </label>
                                        <input class="form-control" class='optional' name="driver_name" placeholder=""  value="<?php echo $smsinfo['driver_name']; ?>"type="text"  required   readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="reservationeventdatetime">Driver Mobile Number</label>
                                         <input class="form-control" class='optional' name="driver_mobile" placeholder="" value="<?php echo $smsinfo['driver_mobile']; ?>"type="text" required  readonly>


                                    </div>
                                    <div class="form-group">
                                        <label for="reservationeventdatetime">Vechicle No</label>
                                          <input class="form-control" class='optional' name="vehi_name" placeholder="" value="<?php echo $smsinfo['vehi_name']; ?>" type="text" required  readonly>

                                    </div>

                               

                                    <div class=" form-group">
                                        <label> Date <span class="required">*</span></label>
                                     
                                       <input class="form-control" class='date' type="date" name="date" required='required' >
                                    </div>


                                    <!-- time Picker -->
                                    <div class="form-group bootstrap-timepicker">
                                        <label>Time</label>
                                        <div class="input-group date" id="timeRangePicker">
                                           <input class="form-control" class='time' type="time" name="time" required='required'  >


                                        </div>
                                    </div>


                                    <div id="thumbnailContainer"></div>
                                    <button class="clear-button btn btn-danger" onclick="clearFileInput()">
                                        <i class="fas fa-times"></i> Clear
                                    </button>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="updateUserInfo" class="btn btn-block bg-gradient-primary btn-lg"> Submit</button>
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