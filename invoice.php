<?php 
    include('include/header.php');
?>

<?php
 
   
    if(isset($_GET['user_id'])){
        $_SESSION['daily_report_id'] = $_GET['user_id'];
        $user_id = $_GET['user_id'];
    }

    else if(isset($_SESSION['daily_report_id'])){
        $user_id = $_SESSION['daily_report_id'];
    }

    if(isset($user_id)){
        $getsmsInfo = $objOperationAdmin->getMisReport($user_id);
        $smsinfo = mysqli_fetch_array($getsmsInfo);
        
    } else {
      
        echo "User ID not provided.";
    }
?>


<style>
    .header {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .table {
        height: 135mm;
        table-layout: fixed;
        word-wrap: break-word;
        border: 1px solid black;
        /* Add 3px border to the table */
    }

    .table th,
    .table td {
        height: 15px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: 0;
        /* Remove padding to ensure the height is strictly 15px */
        border: 1px solid black;
        vertical-align: middle;
    }

    .table tr {
        height: 15px;
    }

    .table thead th {
        border: 1px solid black;
    }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Mis Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Mis Report</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="header text-center">
                                    <p>Management Information System</p>
                                </div>
                                <p class="ml-1"><b>Date: <?php echo $smsinfo['date']; ?></b></p>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th colspan="6">Particulars</th>
                                            <th>No. of</th>
                                            <th>Total Sales</th>
                                            <th>Revenue</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td rowspan="7" style="height:20px;"> <b>1</b></td>
                                            <td colspan="2" rowspan="2">Requirements Types</td>
                                            <td>
                                                <p style="margin:-15px;">App</p>
                                            </td>
                                            <td>
                                                <p style="margin:-15px;">Web</p>
                                            </td>
                                            <td>
                                                <p style="margin:-15px;">Social</p>
                                            </td>
                                            <td>
                                                <p style="margin:-15px;">Manual</p>
                                            </td>
                                            <td rowspan="7"> <?php echo $smsinfo['total_req']; ?> </td>
                                            <td rowspan="13">

                                                <?php $id= $smsinfo['daily_report_id']; 
                                             $getAllSale = $objOperationAdmin->getAllSaleAndRevenueAmount($id,"price");
                                             echo $getAllSale;
                                        
                                     ?>

                                            </td>
                                            <td rowspan="13">

                                                <?php $id= $smsinfo['daily_report_id']; 
                                                          $getAllRevenue = $objOperationAdmin->getAllSaleAndRevenueAmount($id,"revenue");
                                                          echo $getAllRevenue ;
                                                    ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:15px;"></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <!----Company name----->
                                        <tr>
                                            <td colspan="2" rowspan="2">Company Name</td>
                                            <td>
                                                <p style="margin:-15px;">DHL</p>
                                            </td>
                                            <td>
                                                <p style="margin:-15px;">Haier</p>
                                            </td>
                                            <td>
                                                <p style="margin:-15px;">GE</p>
                                            </td>
                                            <td>
                                                <p style="margin:-15px;">Others</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="height:15px;"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p style="margin:-15px;">Equipment</p>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p style="margin:-15px;">Labor</p>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p style="margin:-15px;">Home shifting</p>
                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2"></td>
                                        </tr>
                                        <!----Point 2---->
                                        <tr>
                                            <td>
                                                <p style="margin:-15px;"><b>2</b></p>
                                            </td>
                                            <td colspan="6">
                                                <p style="margin:-15px;">Apps post</p>
                                            </td>
                                            <td> <?php echo $smsinfo['app_post']; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="margin:-15px;"><b>3</b></p>
                                            </td>
                                            <td colspan="6">
                                                <p style="margin:-15px;">Confirmation Req.</p>
                                            </td>
                                            <td> <?php echo $smsinfo['confirm_req']; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="margin:-15px;"><b>4</b></p>
                                            </td>
                                            <td colspan="6">
                                                <p style="margin:-15px;">Sms Sent</p>
                                            </td>
                                            <td> <?php echo $smsinfo['sms_sent']; ?> </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p style="margin:-15px;"><b>5</b></p>
                                            </td>
                                            <td colspan="6">
                                                <p style="margin:-15px;">Portal Entry</p>
                                            </td>
                                            <td> <?php echo $smsinfo['portal_entry']; ?> </td>
                                        </tr>


                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="8" style="text-align:right; padding-right:10px;"><b>Grand Total</b></td>
                                            <td>

                                                <?php $id= $smsinfo['daily_report_id']; 
                                                          $getAlltotal = $objOperationAdmin->getAllSaleAndRevenueAmount($id,"total");
                                                          echo $getAlltotal ;
                                     ?>
                                            </td>
                                            <td>

                                                <?php 
                                      
                                      echo $getAllRevenue ;
                                      ?>

                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-12 mt-3">
                                <div class=" text-center">
                                    <div class="row">
                                        <div class="col-3"><b>__________________</b></div>
                                        <div class="col-3"><b>__________________</b></div>
                                        <div class="col-3"><b>__________________</b></div>
                                        <div class="col-3"><b>__________________</b></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-3"><b>Prepared By</b></div>
                                        <div class="col-3"><b>Checked By</b></div>
                                        <div class="col-3"><b>Recommended By</b></div>
                                        <div class="col-3"><b>Received By</b></div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <!-- this row will not appear when printing -->
                        <div class="row no-print mt-3">
                            <div class="col-12">
                                <a href="invoice-print.php?order_id=<?php echo $smsinfo['daily_report_id']; ?>" rel="noopener" target="_blank" class="btn btn-success float-right"><i class="fas fa-print"></i> Print</a>

                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" hidden>
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php 
    include('include/footer.php');
?>