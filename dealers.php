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
                            <h1>Dealer Account</h1>
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
                                    <h3 class="card-title">Dealer Account Information </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th style="width:75px;">Name</th>
                                                <th style="width:75px;">Mobile</th>
                                                <th style="width:90px;">Email</th>
                                                <th style="width:65px;">Username</th>
                                                <th>Account</th>
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
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($dealerData=mysqli_fetch_array($getDealerList)){ 
                                                        if($dealerData['status']==1){
                                            ?>
                                            
                                            <tr data-id="<?php echo $dealerData['id']; ?>">
                                                <td><?php echo $dealerData['id'] ?></td>
                                                <td class="dealer-name"><?php echo $dealerData['dealer_name']; ?></td>
                                                <td class="dealer-mobile"><?php echo $dealerData['dealer_mobile'] ?></td>
                                                
                                                <td><?php echo $dealerData['dealer_email'] ?></td>
                                                
                                                <td class="dealer-useraccount" >
                                                    <?php
                                                        if (!empty($dealerData['user_account'])) {
                                                            $userId = $dealerData['user_account'];
                                                            $getUserInfo = $objOperationAdmin->getGetUsernameById($userId);
                                                            echo $getUserInfo['user_name'];
                                                        } else {
                                                            echo "";
                                                        }?>
                                                    <?php  
                                                    ?>
                                                </td>
                                                <td class="dealer-total">
                                                    <?php
                                                        if ($dealerData['user_account']!=null ) {
                                                            echo "Available";
                                                        } else {
                                                            echo "Not Found";
                                                        }?>
                                                </td>
                                                <td class="dealer-status"><?php 
                                                            if (!empty($dealerData['user_account'])) {
                                                                $userId = $dealerData['user_account'];
                                                                $getUserInfo = $objOperationAdmin->getGetUsernameById($userId);
                                                                echo isset($getUserInfo['status']) && $getUserInfo['status'] == 1 ? 'Active' : 'Disable';
                                                            }
                                                            else{
                                                                echo "Disable";
                                                            }
                                                    ?>
                                                </td>
                                                
                                                <td class="dealer-email" hidden><?php echo $dealerData['dealer_email'] ?></td>
                                                <td class="dealer-nid" hidden><?php echo $dealerData['dealer_nid'] ?></td>
                                                <td class="dealer-emergency" hidden><?php echo $dealerData['emergency_contact'] ?></td>
                                                <td class="dealer-address" hidden><?php echo $dealerData['address'] ?></td>
                                                <td class="dealer-district" hidden><?php echo $dealerData['district'] ?></td>
                                                <td class="dealer-business" hidden><?php echo $dealerData['business_name'] ?></td>
                                                <td class="dealer-businesstype" hidden><?php echo $dealerData['business_type'] ?></td>
                                                <td class="dealer-join" hidden><?php echo $dealerData['join_date'] ?></td>
                                                <td class="dealer-last" hidden><?php echo $dealerData['last_deliver'] ?></td>
                                                
                                                
                                                <td>
                                                    <div class="btn-group">
                                                        <?php
                                                        if ($dealerData['user_account']!=null ) { ?>
                                                        <a><button type="button" class="btn btn-success btn-sm" disabled><i class="fas ion-person-add"></i></button></a>
                                                        <?php } else { ?>
                                                        <a><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-lg" onclick="sendStringsUpdate('<?php echo $dealerData['id']; ?>')"><i class="fas ion-person-add"></i>
                                                        </button></a>
                                                        <?php } ?>

                                                        <a class="ml-1"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-xl" onclick="sendStrings('<?php echo $dealerData['id']; ?>')">
                                                            <i class="fas fa-eye"></i>
                                                        </button></a>
                                                        
                                                        <?php if(!empty($dealerData['user_account']) && $getUserInfo['status']==1){ ?>
                                                        
                                                        <a href="admin_action.php?dealer_account=lock&&id=" class="ml-1"><button type="button" class="btn btn-success  btn-sm">
                                                            <i class="fas ion-unlocked"></i>
                                                        </button></a>
                                                        <?php } else { ?>
                                                        
                                                        <a href="admin_action.php?dealer_account=unlock&&id=" class="ml-1"><button type="button" class="btn btn-secondary  btn-sm">
                                                            <i class="fas ion-locked"></i>
                                                        </button></a>

                                                        <?php }
                                                        if ($dealerData['user_account']!=null ) { ?>
                                                        <a class="ml-1"><button type="button" class="btn btn-danger  btn-sm" onclick="confirmDelete('<?php echo $dealerData['id']; ?>')">
                                                            <i class="fas fa-trash"></i>
                                                        </button></a>
                                                        <?php } else { ?>
                                                        <a class="ml-1"><button type="button" class="btn btn-danger  btn-sm" disabled>
                                                            <i class="fas fa-trash"></i>
                                                        </button></a>
                                                        <?php } ?>
                                                        
                                                        <script>
                                                            function confirmDelete(Id) {
                                                                var confirmDelete = confirm("Are you sure you want to delete This Dealer " + Id + "?");
                                                                if (confirmDelete) {
                                                                    // Proceed with deletion action
                                                                    window.location.href = "admin_action.php?dealer_account=delete&&id=" + Id;
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
                                                    <th style="width: 140px;">Username</th>
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
                
                
               <div class="modal fade" id="modal-lg">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form id="dealerForm" method="get" action="action-update.php">
                                <div class="modal-header">
                                    <h4 class="modal-title">Create Dealer Account</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                
                                <div class="modal-body">
                                    <input type="text" name="dealer_id" class="form-control" id="dealer-id" hidden>

                                    <div class="form-group">
                                        <label for="full_name">Full Name *</label>
                                        <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Full Name" required>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="phone">Mobile *</label>
                                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter mobile" required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="email">Email </label>
                                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="password">Password *</label>
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="confirmPassword">Confirm Password *</label>
                                            <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" placeholder="Conform Password" required>
                                        </div>
                                    </div>

                                    <div class="row" hidden>

                                        <div class="form-group col-6">
                                            <label for="type">User Type *</label>
                                            <select class="select10 form-control" id="type" name="type" style="width: 100%;" required>
                                                <option value="dealer">Dealer</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="status">Status *</label>
                                            <select id="status" class="select10 form-control" name="status" style="width: 100%;" required>
                                                <option value="1">Active</option>
                                                <option value="0">Disable</option>
                                            </select>
                                        </div>
                                    </div>

                                    
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" name="submitRegi" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
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

    <script>
        function sendStringsUpdate(id) {
            // Fetch data from the table row
            let row = document.querySelector('tr[data-id="' + id + '"]');

            let dealername = row.querySelector('.dealer-name').innerText;
            let mobile = row.querySelector('.dealer-mobile').innerText;
            let email = row.querySelector('.dealer-email').innerText;
            
            document.getElementById("dealer-id").value = id;
            document.getElementById("full_name").value = dealername;
            document.getElementById("phone").value = mobile;
            document.getElementById("email").value = email;
        }
    </script>


<?php 
    include('include/footer.php');
?>