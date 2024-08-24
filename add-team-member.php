<?php
    include('include/header.php');
?>

<?php

    $result= "";
    if(isset($_POST['submit'])){
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['member_photo'])) {
            $target_dir = "../assets/img/team";
            
            // Extracting the gallery_id and img_title
            list($date, $month, $year,$day) = explode(',', $_POST['event_date']);
            $event_name = $_POST['event_name'];
            
            $filename = basename($_FILES['event_image']["name"] );

            // Get the file extension
            $file_extension = pathinfo( $filename, PATHINFO_EXTENSION );
            //new filename
            $new_filename = $event_name.'-'.$date.'-'.$day.'.'. $file_extension;
            // Set the target path
            $target_path = $target_dir . $new_filename;
            // Check if file is an image
            $check = getimagesize($_FILES['event_image']["tmp_name"] );
            
            if ($check !== false ) {
                if (move_uploaded_file($_FILES['event_image']["tmp_name"], $target_path)) {
                    // Load original image
                    $image = imagecreatefromstring(file_get_contents($target_path));

                    // Create a big image (max width: 1200px, max height: 960px)
                    $event_image = imagescale($image, 1200, 960);
                    // Save the big image
                    imagejpeg($event_image, $target_path);
                    imagedestroy($event_image);
                    // Free up memory
                    imagedestroy($image);

                    // Check if both images saved successfully
                    if (file_exists($target_path)) {
                        $setEvent = $objOperationAdmin->save_new_event($date, $month, $year,$day,$new_filename,$_POST);
                        if($setEvent){
                            $result = "yes";
                        }
                    
                    }
                 }
            }
            
        }
        else{
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
        display: none; /* Hide the clear button initially */
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
            <h1>Add New Member</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">New Member</li>
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
                
                <?php if($result=="yes"){ ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success</h5>
                    <?php echo $new_filename; ?> upload successful.
                </div>
                <?php } else if($result == "no"){ ?>
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                    <?php echo $new_filename; ?> upload failed!
                </div>
                <?php } ?>
                
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">New Member Form</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="newEventForm" enctype="multipart/form-data" method="post">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>full_name</label>
                                        <input type="text" name="full_name" class="form-control" placeholder="Full Name">
                                    </div>

                                    <div class="form-group">
                                        <label>credentials</label>
                                        <input type="text" name="credentials" class="form-control" placeholder="credentials">
                                    </div>

                                    <div class="form-group">
                                        <label>designation</label>
                                        <input type="text" name="designation" class="form-control" placeholder="designation">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>designation2</label>
                                        <input type="text" name="designation2" class="form-control" placeholder="designation2">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>fb link</label>
                                        <input type="text" name="fb_link" class="form-control" placeholder="https://www.facebook.com/">
                                    </div>
                                    
                                    <div class="form-group bootstrap-timepicker">
                                        <label>twitter link</label>
                                        <input type="text" name="twitter_link" class="form-control" placeholder="twitter_link">
                                    </div>


                                    <div class="form-group">
                                        <label>linkedin link</label>
                                        <input type="text" name="linkedin_link" class="form-control" placeholder="linkedin_link">
                                    </div>




                                    <div class="form-group">
                                        <label>Member photo</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" accept="image/*"  name="member_photo" id="customImage" onchange="displayThumbnail()">
                                            <label class="custom-file-label" for="customImage">Choose file</label>
                                        </div>
                                    </div>
                                    <div id="thumbnailContainer"></div>
                                    <button class="clear-button btn btn-danger" onclick="clearFileInput()">
                                        <i class="fas fa-times"></i> Clear
                                    </button>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-block bg-gradient-primary btn-lg">  Submit</button>
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


