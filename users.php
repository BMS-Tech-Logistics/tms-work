<?php 
    include('include/header.php');
?>

<?php
    $getUserList = $objOperationAdmin->getAllUserInfo();
?>
   
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active">Users List</li>
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
                                    <h3 class="card-title">Users Information </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Full Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($userData=mysqli_fetch_array($getUserList)){ 
                                                    if($userData['type']!="admin"){
                                            ?>
                                            <tr data-id="<?php echo $userData['id']; ?>">
                                                <td><?php echo $userData['id'] ?></td>
                                                <td class="vendor-mobile"><?php echo $userData['user_name'] ?></td>
                                                <td class="vendor-email"><?php echo $userData['full_name'] ?></td>
                                                <td class="vendor-rent-cate"><?php echo $userData['phone'] ?></td>
                                                <td class="vendor-work-area"><?php echo $userData['email'] ?></td>
                                                <td class="vendor-vehicle"><?php echo $userData['type']; ?></td>
                                                <td class="vendor-status"><?php echo $userData['status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                                             
                                                
                                                <td>
                                                    <div class="btn-group">
                                                        <a class="ml-0" href="update-user.php?user_id=<?php echo $userData['id'] ?>"><button type="button" class="btn btn-success btn-sm">
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
                                            <?php } } ?>
                                            
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
                
                
                <!-----Popup Model------>
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Vendor Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 170px">Name</th>
                                            <td id="modal-username"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Mobile</th>
                                            <td id="modal-mobile"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Email</th>
                                            <td id="modal-email"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Rent Category</th>
                                            <td id="modal-rent-category"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Work Area</th>
                                            <td id="modal-work-area"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Total Vehicle</th>
                                            <td id="modal-total-vehicle">0</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Total Trip</th>
                                            <td id="modal-total-trip">0</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Join</th>
                                            <td id="modal-join">0</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Status</th>
                                            <td id="modal-status"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer" style="margin-top:-15px;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                
                
            </section>
            <!-- /.content -->
        </div>


        <script>
            function sendStrings(id) {
                // Fetch data from the table row
                let row = document.querySelector('tr[data-id="' + id + '"]');
                let name = row.querySelector('.vendor-name').innerText;
                let mobile = row.querySelector('.vendor-mobile').innerText;
                let email = row.querySelector('.vendor-email').innerText;
                let rentCategory = row.querySelector('.vendor-rent-cate').innerText;
                let workArea = row.querySelector('.vendor-work-area').innerText;
                let totalVehicle = row.querySelector('.vendor-vehicle').innerText;
                let totalTrip = row.querySelector('.vendor-trip').innerText;
                let vendorJoin = row.querySelector('.vendor-join').innerText;
                let status = row.querySelector('.vendor-status').innerText;

                // Set the values in the modal
                document.getElementById('modal-username').innerText = name;
                document.getElementById('modal-mobile').innerText = mobile;
                document.getElementById('modal-email').innerText = email;
                document.getElementById('modal-rent-category').innerText = rentCategory;
                document.getElementById('modal-work-area').innerText = workArea;
                document.getElementById('modal-total-vehicle').innerText = totalVehicle;
                document.getElementById('modal-total-trip').innerText = totalTrip;
                document.getElementById('modal-join').innerText = vendorJoin;
                document.getElementById('modal-status').innerText = status;
            }
        </script>


<?php 
    include('include/footer.php');
?>