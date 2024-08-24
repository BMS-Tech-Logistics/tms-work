<?php 
    include('include/header.php');
?>

<?php
    $getUserList = $objOperationAdmin->getAllBillInfo();
?>
   
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Bill List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active">Bill List</li>
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
                                    <h3 class="card-title">All Bill Information </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>client name</th>
                                                <th>destination</th>
                                                <th>trans cate</th>
                                                <th>transport qty</th>
                                                <th>labour qty</th>
                                                <th>transport rate</th>
                                                <th>labour rate</th>
                                                <th>demarage rate</th>
                                                <th>transport amount</th>
                                                <th>labourvout</th>
                                                <th>equipment</th>
                                                <th>trans vat</th>
                                                <th>labour vat</th>
                                                <th>trans with vat</th>
                                                <th>labour with vat</th>
                                                <th>labour with vat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($userData=mysqli_fetch_array($getUserList)){ ?>
                                            <tr>
                                             
                                                <td><?php echo $userData['date'] ?></td>
                                                <td><?php echo $userData['client_name'] ?></td>
                                                <td><?php echo $userData['destination'] ?></td>
                                                <td><?php echo $userData['trans_cate']; ?></td>
                                                <td><?php echo $userData['transport_qty']; ?></td>
                                                <td><?php echo $userData['labour_qty']; ?></td>
                                             
                                                <td><?php echo $userData['transport_rate']; ?></td>
                                                <td><?php echo $userData['labour_rate']; ?></td>
                                                <td><?php echo $userData['demarage_rate']; ?></td>
                                                <td><?php echo $userData['transport_amount_vout']; ?></td>
                                                <td><?php echo $userData['labour_v_out']; ?></td>
                                                <td><?php echo $userData['equipment']; ?></td>
                                                <td><?php echo $userData['trans_vat']; ?></td>
                                                <td><?php echo $userData['labour_vat']; ?></td>
                                                <td><?php echo $userData['trans_with_vat']; ?></td>
                                                <td><?php echo $userData['labour_with_vat']; ?></td>
                                             
                                            
                                                <td>
                                                    <div class="btn-group">
                                                            <a href="edit-profile.php?user_id=<?php echo $userData['id'] ?>"><button type="button" class="btn btn-success btn-sm">
                                                                <i class="fas fa-edit"></i>
                                                            </button></a>
                                                            <button type="button" class="btn btn-default btn-sm" hidden>
                                                                <i class="fas fa-print"></i>
                                                            </button>
                                                            <a href="user-profile.php?user_id=<?php echo $userData['id'] ?>"><button type="button" class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye"></i>
                                                            </button></a>
                                                        </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                            <th>Date</th>
                                                <th>client_name</th>
                                                <th>destination</th>
                                                <th>trans_cate</th>
                                                <th>transport_qty</th>
                                                <th>labour_qty</th>
                                                <th>transport_rate</th>
                                                <th>labour_rate</th>
                                                <th>demarage_rate</th>
                                                <th>transport_amount_vout</th>
                                                <th>labour_v_out</th>
                                                <th>equipment</th>
                                                <th>trans_vat</th>
                                                <th>labour_vat</th>
                                                <th>trans_with_vat</th>
                                                <th>labour_with_vat</th>
                                                <th>labour_with_vat</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
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