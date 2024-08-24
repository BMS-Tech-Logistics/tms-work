<?php 
    include('include/header.php');
?>

<?php
    $category="Booking";
    $getSms = $objOperationAdmin->getHistoryByCategory("Booking");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All Loading List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active">Loading List</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Loading List Information </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width:13%;">Date& Time</th>
                                        <th> Customer Info</th>
                                        <th> Load/Delivery Point</th>
                                        <th> Driver/Vechicle Info</th>
                                        <th> Status </th>
                                        <th> Ref. Number </th>
                                        <th style="width:11%;"> Tracking </th>
                                        <th style="width:12%;"> Delivery/Cancel </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($getSmsInfo=mysqli_fetch_array($getSms)){ ?>
                                    <tr>
                                        <td> Date <?php echo $getSmsInfo['date']; ?><br>
                                            Time <?php $time = $getSmsInfo['time'];
                                                             $time_in_am_pm = date("h:i:s A", strtotime($time));
                                                             echo $time_in_am_pm; // Outputs "05:03:00 PM"
                                                    ?>
                                        </td>

                                        <td> Name : <?php echo $getSmsInfo['name']; ?><br><br>
                                            Mobile : <?php echo $getSmsInfo['phone']; ?>
                                        </td>

                                        <td> Load : <?php echo $getSmsInfo['loading_point']; ?><br><br>
                                            Delivery : <?php echo $getSmsInfo['unloading_point']; ?>
                                        </td>

                                        <td><?php echo $getSmsInfo['driver_name']; ?><br>
                                            <?php echo $getSmsInfo['driver_mobile']; ?><br>
                                            <?php echo $getSmsInfo['vehi_name'] ;?>
                                        </td>

                                        <td><?php echo $getSmsInfo['status'] ?></td>
                                        <td><?php echo $getSmsInfo['request_id']; ?></td>
                                        <td>
                                            <?php $link = $getSmsInfo['tracking_link']; ?>
                                            <?php if (!empty($link)) : ?>
                                            <input type="text" value="<?php echo $link; ?>" hidden>
                                            <button class="btn btn-success btn-sm" onclick="myFunction(this)">Copy link</button>
                                            <?php else : ?>
                                            <button class="btn btn-secondary btn-sm" disabled>Copy link</button>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <span>
                                                <a href="delivery.php?user_id=<?php echo $getSmsInfo['id']?>"> <button type="button" class="btn btn-info"><i class="fa fa-truck" aria-hidden="true"></i> </button></a>
                                                <a href="trip-cancel.php?user_id=<?php echo $getSmsInfo['id']?>"> <button type="button" class="btn btn-danger"><i class="fa fa-circle" aria-hidden="true"></i></button></a>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="width:13%;">Date& Time</th>
                                        <th> Customer Info</th>
                                        <th> Load/Delivery Point</th>
                                        <th> Driver/Vechicle Info</th>
                                        <th> Status </th>
                                        <th> Ref. Number </th>
                                        <th style="width:11%;"> Tracking </th>
                                        <th style="width:12%;"> Delivery/Cancel </th>

                                    </tr>
                                </tfoot>
                                
                                  <script>
                                            function myFunction(button) {
                                                // Find the input field related to this button
                                                var copyText = button.previousElementSibling;

                                                // Select the text field
                                                copyText.select();
                                                copyText.setSelectionRange(0, 99999); // For mobile devices

                                                // Copy the text inside the text field
                                                navigator.clipboard.writeText(copyText.value).then(function() {
                                                    // Change the button text to "Copied"
                                                    button.textContent = "Copied";
                                                    // Change button class to btn-info
                                                    button.classList.remove("btn-success");
                                                    button.classList.add("btn-info")
                                                }).catch(function(err) {
                                                    console.error('Failed to copy: ', err);
                                                });
                                            }
                                        </script>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php 
    include('include/footer.php');
?>