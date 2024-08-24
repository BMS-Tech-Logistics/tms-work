<?php 
    include('include/header.php');
 ?>
<?php
    $user_id='';
    $message = '';
    if(isset($_GET['action']) && isset($_GET['user_id'])) {
        // Retrieve the user ID from the URL parameter
        $userId = $_GET['user_id'];
        $result= $objOperationAdmin->delete_user_account($userId);
        if($result){
            $message= "Delete Success";
            echo "<script>window.location.replace('user-list.php');</script>";
        }
    }

    if(isset($_GET['user_id'])){
        $_SESSION['id'] = $_GET['user_id'];
        $user_id = $_GET['user_id'];
    }
    else if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }
    $getUserInfo = $objOperationAdmin->getUserInfoById($user_id);
    $profileData=mysqli_fetch_array($getUserInfo);
    
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>User Profile</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active">User Profile</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">

                            <!-- Profile Image -->
                            <div class="card card-primary card-outline">
                                <div class="card-body box-profile">
                                    
                                    <div class="text-center">
                                        <?php
                                            $user_profile = $profileData['user_img'];
                                            if (empty($user_profile)) {
                                                $defaultImage = 'default-user.png';
                                                // Output the default image
                                                echo '<img class="profile-user-img img-fluid img-circle" src="dist/img/' . $defaultImage . '" style="height:100px;" alt="User profile picture">';
                                            } else {
                                                // Output the profile picture
                                                echo '<img class="profile-user-img img-fluid img-circle" src="../assets/img/user/' . $user_profile . '" style="height:100px;" alt="User profile picture">';
                                            }
                                        ?>

                                    </div>

                                    <h3 class="profile-username text-center"><?php echo $profileData['full_name']; ?></h3>

                                    <!--<p class="text-muted text-center"></p>-->

                                    <ul class="list-group list-group-unbordered mb-3">
                                        <li class="list-group-item">
                                            <b>Join Date</b> 
                                            <a class="float-right">
                                                <?php  echo $profileData['join_date']; ?>
                                            </a>
                                        </li>
                                        <li class="list-group-item" hidden>
                                            <b>Expired Date</b> <a class="float-right">01 Feb 2025</a>
                                        </li>
                                        <li class="list-group-item">
                                            <b>Status</b> <a class="float-right">
                                            <?php
                                                        $status = $profileData['status'];
                                                        if ($status === "1") {
                                                            echo '<span class="badge bg-success">Active</span>';
                                                        } elseif ($status === "0") {
                                                            echo '<span class="badge bg-warning">Pending</span>';
                                                        } elseif ($status === "2") {
                                                            echo '<span class="badge bg-danger">Deactive</span>';
                                                        }
                                                    ?></a>
                                        </li>
                                    </ul>
                                    <?php 
                                    if($profileData['status'] == "3") { ?>
                                        <a href="#" onclick="confirmDeleteByUser('<?php  echo $profileData['id']; ?>')" class="btn btn-info btn-block"><b>Confirm Delete</b></a>
                                    <?php } else{ ?>
                                        <a href="#" onclick="confirmDelete('<?php echo $profileData['id']; ?>')" class="btn btn-danger btn-block"><b>Delete</b></a>

                                    <?php } ?>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        <!-- /.col -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Profile info</a></li>
                                        <li class="nav-item"><a class="nav-link" href="edit-profile.php">Edit Profile</a></li>
                                    </ul>
                                </div><!-- /.card-header -->
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="active tab-pane" id="activity">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th style="width: 170px">User ID</th>
                                                        <td><?php echo $profileData['id']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Username</th>
                                                        <td><?php echo $profileData['username']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Full name</th>
                                                        <td><?php echo $profileData['full_name']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Email</th>
                                                        <td><?php echo $profileData['email']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Contact</th>
                                                        <td><?php echo $profileData['phone']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Address</th>
                                                        <td><?php echo $profileData['address']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Gender</th>
                                                        <td><?php echo $profileData['gender']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Profession</th>
                                                        <td><?php echo $profileData['profession']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Organization</th>
                                                        <td><?php echo $profileData['organization']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Designation</th>
                                                        <td><?php echo $profileData['designation']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Qualification</th>
                                                        <td><?php echo $profileData['qualification']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Birthday</th>
                                                        <td><?php echo $profileData['birth_day'];  ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Membership</th>
                                                        <td><?php echo $profileData['membership']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">User Type</th>
                                                        <td><?php echo $profileData['user_type']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th style="width: 170px">Refer ID</th>
                                                        <td><?php 
                                                                /*if ($profileData['ref_id'] !== null) {
                                                                    echo $profileData['ref_id'];
                                                                } else {
                                                                    echo "<i>null</i>";
                                                                }*/ 
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
            </section>
            
        </div>
        <!-- /.content-wrapper -->

<script>
    function confirmDeleteByUser(userId) {
        var confirmDelete = confirm("User already Delete this, Admin delete Database user with ID " + userId + "?");
        if (confirmDelete) {
            window.location.href = "user-profile.php?action=Del&user_id=" + userId;
        }
    }

    function confirmDelete(userId) {
        var confirmDelete = confirm("Are you sure you want to delete user with ID " + userId + "?");
        if (confirmDelete) {
            window.location.href = "user-profile.php?action=Del&user_id=" + userId;
        }
    }
</script>   

<?php 
    include('include/footer.php');
?>