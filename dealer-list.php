<?php 
    include('include/header.php');
?>

<?php
    $getDealerList = $objOperationAdmin->getDealerList();
?>
   
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dealer List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active">Dealer List</li>
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
                                    <h3 class="card-title">All Dealer Information </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th style="width:75px;">Name</th>
                                                <th style="width:75px;">Mobile</th>
                                                <th style="width:90px;">Shop Name</th>
                                                <th>Location</th>
                                                <th>Last Deliver</th>
                                                <th>Total Deliver</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                                
                                                <th hidden></th>
                                                <th hidden></th>
                                                <th hidden></th>
                                                <th hidden></th>
                                                <th hidden></th>
                                                <th hidden></th>
                                                <th hidden></th>
                                                <th hidden></th>
                                                <th hidden></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($dealerData=mysqli_fetch_array($getDealerList)){ ?>
                                            <tr data-id="<?php echo $dealerData['id']; ?>">
                                                <td><?php echo $dealerData['id'] ?></td>
                                                <td class="dealer-name"><?php echo $dealerData['dealer_name']; ?></td>
                                                <td class="dealer-mobile"><?php echo $dealerData['dealer_mobile'] ?></td>
                                                
                                                <td><?php echo $dealerData['business_name']."<br>".$dealerData['business_type'] ?></td>
                                                <td><?php echo $dealerData['address'].", ".$dealerData['district']; ?></td>
                                                
                                                <td class="dealer-last"><?php echo $dealerData['last_deliver']; ?></td>
                                                <td class="dealer-total"><?php echo $dealerData['total_deliver']; ?></td>
                                                <td class="dealer-status"><?php echo $dealerData['status'] == 1 ? 'Active' : 'Disable'; ?></td>
                                                
                                                <td class="dealer-email" hidden><?php echo $dealerData['dealer_email'] ?></td>
                                                <td class="dealer-nid" hidden><?php echo $dealerData['dealer_nid'] ?></td>
                                                <td class="dealer-emergency" hidden><?php echo $dealerData['emergency_contact'] ?></td>
                                                <td class="dealer-address" hidden><?php echo $dealerData['address'] ?></td>
                                                <td class="dealer-district" hidden><?php echo $dealerData['district'] ?></td>
                                                <td class="dealer-business" hidden><?php echo $dealerData['business_name'] ?></td>
                                                <td class="dealer-businesstype" hidden><?php echo $dealerData['business_type'] ?></td>
                                                <td class="dealer-join" hidden><?php echo $dealerData['join_date'] ?></td>
                                                <td class="dealer-useraccount" hidden><?php echo $dealerData['user_account'] == 1 ? 'Available' : 'Not Found'; ?></td>
                                                
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="update-dealer.php?user_id=<?php echo $dealerData['id'] ?>"><button type="button" class="btn btn-success btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </button></a>

                                                        <a class="ml-1"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-xl" onclick="sendStrings('<?php echo $dealerData['id']; ?>')">
                                                            <i class="fas fa-eye"></i>
                                                        </button></a>

                                                        <a class="ml-1"><button type="button" class="btn btn-danger  btn-sm" onclick="confirmDelete('<?php echo $dealerData['id']; ?>')">
                                                            <i class="fas fa-trash"></i>
                                                        </button></a>
                                                        <script>
                                                            function confirmDelete(Id) {
                                                                var confirmDelete = confirm("Are you sure you want to delete This Dealer " + Id + "?");
                                                                if (confirmDelete) {
                                                                    // Proceed with deletion action
                                                                    window.location.href = "admin_action.php?dealer_status=delete&&id=" + Id;
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
                            
                        </div>
                    </div>
                </div>
                
                
                <!-----Dealer popup Model-Xl----->
                
                <div class="modal fade" id="modal-xl">
                    <div class="modal-dialog modal-dialog-centered modal-lg" style="max-width: auto;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Dealer Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <!-- Personal Information Section -->
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" class="text-center bg-info text-white">Personal Information</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="width: 140px;">Name</th>
                                                    <td id="modal-dealername">name</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">Mobile</th>
                                                    <td id="modal-mobile">mobile</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">Email</th>
                                                    <td id="modal-email">Category</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">NID</th>
                                                    <td id="modal-nid">Size</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">Emergency</th>
                                                    <td id="modal-emergency-contact">emergency</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">Address</th>
                                                    <td id="modal-address">0</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">District</th>
                                                    <td id="modal-district">Active</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Business Information Section -->
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th colspan="2" class="text-center bg-info text-white">Business Information</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th style="width: 140px;">Business name</th>
                                                    <td id="modal-business-name">0</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">Business type</th>
                                                    <td id="modal-business-type">0</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">Last Deliver</th>
                                                    <td id="modal-last-deliver">0</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">Total Deliver</th>
                                                    <td id="modal-total-deliver">0</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">Join Date</th>
                                                    <td id="modal-join-date">0</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">Status</th>
                                                    <td id="modal-status">0</td>
                                                </tr>
                                                <tr>
                                                    <th style="width: 140px;">User Account</th>
                                                    <td id="modal-user-account">0</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>


                            </div>
                            <div class="modal-footer">
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
        <!-- /.content-wrapper -->


    <!-- Bootstrap Switch -->
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script>
            function sendStrings(id) {
                // Fetch data from the table row
                let row = document.querySelector('tr[data-id="' + id + '"]');
                
                let dealername = row.querySelector('.dealer-name').innerText;
                let mobile = row.querySelector('.dealer-mobile').innerText;
                let email = row.querySelector('.dealer-email').innerText;
                let nid = row.querySelector('.dealer-nid').innerText;
                let emergency = row.querySelector('.dealer-emergency').innerText;
                let address = row.querySelector('.dealer-address').innerText;
                let district = row.querySelector('.dealer-district').innerText;
                let business = row.querySelector('.dealer-business').innerText;
                let businesstype = row.querySelector('.dealer-businesstype').innerText;
                let last = row.querySelector('.dealer-last').innerText;
                let total = row.querySelector('.dealer-total').innerText;
                let join = row.querySelector('.dealer-join').innerText;
                let status = row.querySelector('.dealer-status').innerText;
                let useraccount = row.querySelector('.dealer-useraccount').innerText;

                // Set the values in the modal
                document.getElementById('modal-dealername').innerText = dealername;
                document.getElementById('modal-mobile').innerText = mobile;
                document.getElementById('modal-email').innerText = email;
                document.getElementById('modal-nid').innerText = nid;
                document.getElementById('modal-emergency-contact').innerText = emergency;
                document.getElementById('modal-address').innerText = address;
                document.getElementById('modal-district').innerText = district;
                
                document.getElementById('modal-business-name').innerText = business;
                document.getElementById('modal-business-type').innerText = businesstype;
                document.getElementById('modal-last-deliver').innerText = last;
                document.getElementById('modal-total-deliver').innerText = total;
                document.getElementById('modal-join-date').innerText = join;
                document.getElementById('modal-status').innerText = status;
                document.getElementById('modal-user-account').innerText = useraccount;
            }
        </script>


<?php 
    include('include/footer.php');
?>