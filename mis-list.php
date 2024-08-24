<?php 
    include('include/header.php');
?>

<?php
    $getAllReport = $objOperationAdmin->getAllMisReport();
?>


<?php
 
    $result = "";
    $msg = "";
    if(isset($_POST['updateAdmin'])){
           
          $daily_report_id =  $getAllReport['daily_report_id'];
          $statement = $_POST['statement'];

            $sendresult = $objOperationAdmin->updateDailyReport($daily_report_id);
        
        
            if ($sendresult) {
              $result = "yes";
            } 
            else {
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
                            <h1>Trip List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active">MIS List</li>
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
                                    <h3 class="card-title">All Trip Information </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                   
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th style="width:70px;">Date </th>
                                                <th>LoadPoint</th>
                                                <th>UnLoadPoint</th>
                                                <th>DealerName </th>
                                                <th>Vehicle Number </th>
                                                <th>RentCost</th>
                                             
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($userData=mysqli_fetch_array($getAllReport)){ ?>
                                            <tr>
                                                <td><?php echo $userData['id'] ?></td>
                                                <td><?php echo $userData['date']; ?></td>
                                                <td><?php echo $userData['load_point'] ?></td>
                                                <td><?php echo $userData['unload_point'] ?></td>
                                                <td><?php echo $userData['dealer_name'] ?></td>
                                                <td><?php echo $userData['vehicle_no']; ?></td>
                                                <td><?php echo $userData['rent_amount']; ?></td>

                                             
                                                
                                                <td><?php echo $userData['status']; ?></td>
                                                <td>
                                                
                                                
                                                <div class="btn-group">
                                                        <a class="ml-0" href=""><button type="button" class="btn btn-success btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </button></a>
                                                        <a class="ml-1"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default" onclick="sendStrings('<?php echo $userData['id']; ?>')">
                                                                <i class="fas fa-eye"></i>
                                                            </button></a>
                                                        <a class="ml-1"><button type="button" class="btn btn-danger  btn-sm" onclick="confirmDelete('<?php echo $userData['id']; ?>')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </a>
                                                        <script>
                                                            function confirmDelete(Id) {
                                                                var confirmDelete = confirm("Are you sure you want to delete This Vendor " + Id + "?");
                                                                if (confirmDelete) {
                                                                    // Proceed with deletion action
                                                                    window.location.href = "admin_action.php?vendor_status=delete&&id=" + Id;
                                                                    // You can place your deletion logic here
                                                                }
                                                            }
                                                        </script>
                                                    </div>
                                                
                                                </td>

                                            </tr>
                                            <?php } ?>

                                        </tbody>
                                      
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


                <!-- /.modal -->
                <div class="modal fade" id="modal-sm">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                            
                            <form id="modal-form" method="post" action="mis-list.php">
                                
                                
                                <div class="modal-header">
                                    <h4 class="modal-title">Daily Report Statement</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <input type="text" name="daily_report_id" class="form-control" id="daily_report_id" hidden>
                                    <div class="form-group">
                                        <label>Statement update</label>
                                        <select class="form-control select2" name="statement" id="statement" style="width: 100%;">
                                            <option value="Pending">Pending</option>
                                            <option value="Process">Process</option>
                                            <option value="Done">Done</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" name="updateAdmin"  class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
            </section>
            <!-- /.content -->
            </div>
        <!-- /.content-wrapper -->

<script>
    function sendStrings(id, status) {
        document.getElementById("daily_report_id").value = id;
        document.getElementById("statement").value = status;

        // Update the select2 plugin to display the correct value
        let selectElement = document.getElementById("type");
        for (let i = 0; i < selectElement.options.length; i++) {
            if (selectElement.options[i].value === status) {
                selectElement.selectedIndex = i;
                break;
            }
        }

        // If using Select2 plugin, trigger change event to update display
        $('.select2').val(status).trigger('change');
    }
</script>

<?php 
    include('include/footer.php');
?>