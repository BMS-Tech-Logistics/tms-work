<?php 
    include('include/header.php');
?>

<?php
    $getDailyReport = $objOperationAdmin->getDailyReport();
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Single Report List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active"> Single Report List</li>
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
                            <h3 class="card-title">Single Report Information </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>

                                        <th>Date </th>
                                        <th>Client Name </th>
                                        <th>Tran Cate </th>
                                        <th>Trans Qty </th>
                                        <th>Trans Rate </th>
                                        <th>Trans Cost </th>
                                        <th>Sms Sent </th>
                                        <th>Bill Status </th>

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
                                        <th hidden></th>
                                        <th hidden></th>
                                        <th hidden></th>
                                        <th hidden></th>
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
                                    <?php while($userData=mysqli_fetch_array($getDailyReport)){ ?>
                                    <tr data-id="<?php echo $userData['id']; ?>">
                                        <td hidden><?php echo $userData['id'] ?></td>


                                        <td class="re-date"><?php echo $userData['date']; ?></td>
                                        <td class="client-name"><?php echo $userData['client_name'] ?></td>
                                        <td class="trans-cate"><?php echo $userData['trans_cate'] ?></td>
                                        <td class="trans-qty"><?php echo $userData['trans_qty'] ?></td>
                                        <td class="trans-rate"><?php echo $userData['trans_rate'] ?></td>

                                        <td class="trans-cost"><?php echo $userData['trans_cost'] ?></td>
                                        <td class="load-point" hidden><?php echo $userData['load_point'] ?></td>
                                        <td class="unload-point" hidden><?php echo $userData['unload_point'] ?></td>
                                        <td class="req-type" hidden><?php echo $userData['req_type'] ?></td>
                                        <td class="client-type" hidden><?php echo $userData['client_type'] ?></td>
                                        <td class="trans-d-rate" hidden><?php echo $userData['trans_d_rate'] ?></td>
                                        <td class="trans-d-qty" hidden><?php echo $userData['trans_d_qty'] ?></td>
                                        <td class="trans-vat" hidden><?php echo $userData['trans_vat'] ?></td>
                                        <td class="labor-qty" hidden><?php echo $userData['labor_qty'] ?></td>
                                        <td class="labor-rate" hidden><?php echo $userData['labor_rate'] ?></td>
                                        <td class="labor-over-qty" hidden><?php echo $userData['labor_over_qty'] ?></td>

                                        <td class="labor-over-rate" hidden><?php echo $userData['labor_over_rate'] ?></td>
                                        <td class="labor-cost" hidden><?php echo $userData['labor_cost'] ?></td>
                                        <td class="labor-vat" hidden><?php echo $userData['labor_vat'] ?></td>
                                        <td class="eq-name" hidden><?php echo $userData['eq_name'] ?></td>
                                        <td class="eq-qty" hidden><?php echo $userData['eq_qty'] ?></td>
                                        <td class="eq-rate" hidden><?php echo $userData['eq_rate'] ?></td>
                                        <td class="eq-d-qty" hidden><?php echo $userData['eq_d_qty'] ?></td>
                                        <td class="eq-d-rate" hidden><?php echo $userData['eq_d_rate'] ?></td>
                                        <td class="e-total" hidden><?php echo $userData['e_total'] ?></td>
                                        <td class="eq-vat" hidden><?php echo $userData['equip_vat'] ?></td>
                                        <td class="revenue" hidden><?php echo $userData['revenue'] ?></td>
                                        <td class="app-post" hidden><?php echo $userData['app_post_done'] ?></td>
                                        <td class="sms-sent" hidden><?php echo $userData['sms_sent_done'] ?></td>







                                        <td>

                                            <?php echo $userData['sms_sent_done'] == 1 ? 'Yes' : ''; ?>

                                            <div class="btn-group">
                                                <a class="ml-1" href="load-sms.php?user_id=<?php echo $userData['id'] ?>">
                                                    <button type="button" class="btn btn-info btn-sm" <?php echo $userData['sms_sent_done'] == 1 ? 'hidden' : ''; ?>>
                                                        <i class="fas fa-sms"></i>
                                                    </button>
                                                </a>
                                                <button type="button" class="btn btn-default btn-sm" hidden>
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            </div>


                                        </td>

                                        <td class="bill-status"><?php echo $userData['bill_status'] ?></td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="ml-1" href=" update-single-req.php?user_id=<?php echo $userData['id'] ?>"><button type="button" class="btn btn-success btn-sm">
                                                        <i class="fas fa-edit"></i>
                                                    </button></a>

                                                <button type="button" class="btn btn-default btn-sm" hidden>
                                                    <i class="fas fa-print"></i>
                                                </button>

                                                <a class="ml-1"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-lg" onclick="sendStrings('<?php echo $userData['id']; ?>')">
                                                        <i class="fas fa-eye"></i>
                                                    </button></a>


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

        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Single Requirment Infromation</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="row">

                            <!-- Personal Information Section -->
                            <div class="col-md-4">
                                <table class="table table-bordered">

                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center bg-orange text-white"> First Section</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th style="width: 170px">Date</th>
                                            <td id="modal-date"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Load Point </th>
                                            <td id="modal-load"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Unload point</th>
                                            <td id="modal-unload"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Requiremt type</th>
                                            <td id="modal-reqType"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Client Name</th>
                                            <td id="modal-client"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px"> Client Type</th>
                                            <td id="modal-client-type"> </td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Transport Category</th>
                                            <td id="modal-tr-cate"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px"> Transport Quantity</th>
                                            <td id="modal-tr-qty"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px"> Transport rate</th>
                                            <td id="modal-tr-rate"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Business Information Section -->
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center bg-info text-white">2nd Section</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th style="width: 170px">trans Dem Rate</th>
                                            <td id="modal-d-rate"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Trans D Qty</th>
                                            <td id="modal-trans-qty"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Trans Cost</th>
                                            <td id="modal-trans-cost"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px"> Trans vat</th>
                                            <td id="modal-trans-vat"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Labor Qty</th>
                                            <td id="modal-labor-qty"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Labor Rate</th>
                                            <td id="modal-labor-rate"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Extra Labor Qty</th>
                                            <td id="modal-over-labor-qty"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Extra Labor Rate</th>
                                            <td id="modal-over-labor-rate"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Labor vat</th>
                                            <td id="modal-labor-vat"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">labor_cost </th>
                                            <td id="modal-labor-cost"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>

                            <!-- Business Information Section -->
                            <div class="col-md-4">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-center bg-primary text-white"> 3rd Section</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th style="width: 170px"> Equipment name </th>
                                            <td id="modal-eq-name"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px"> Equipment qty</th>
                                            <td id="modal-eq-qty"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Equipment Rate</th>
                                            <td id="modal-eq-rate"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Equipment Dem Qty </th>
                                            <td id="modal-eq-d-qty"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Equipment Dem. Rate</th>
                                            <td id="modal-eq-d-rate"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px"> Equipment Cost </th>
                                            <td id="modal-eq-total"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Equipment Vat</th>
                                            <td id="modal-eq-vat"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">revenue</th>
                                            <td id="modal-revenue"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">app_post_done </th>
                                            <td id="modal-app-post"></td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">sms_sent_done </th>
                                            <td id="modal-sms-sent"></td>
                                        </tr>

                                        <tr>
                                            <th style="width: 170px">bill_status </th>
                                            <td id="modal-status"></td>
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
        <!-- /.modal -->




    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<script>
    function sendStrings(id) {
        // Fetch data from the table row
        let row = document.querySelector('tr[data-id="' + id + '"]');

        let clientname = row.querySelector('.client-name').innerText;
        let date = row.querySelector('.re-date').innerText;
        let loadp = row.querySelector('.load-point').innerText;
        let unload = row.querySelector('.unload-point').innerText;
        let reqtype = row.querySelector('.req-type').innerText;
        let clinttype = row.querySelector('.client-type').innerText;
        let transcate = row.querySelector('.trans-cate').innerText;
        let transqty = row.querySelector('.trans-qty').innerText;
        let transrate = row.querySelector('.trans-rate').innerText;

        let transdrate = row.querySelector('.trans-d-rate').innerText;
        let transdqty = row.querySelector('.trans-d-qty').innerText;
        let transcost = row.querySelector('.trans-cost').innerText;
        let transvat = row.querySelector('.trans-vat').innerText;
        let laborqty = row.querySelector('.labor-qty').innerText;
        let laborrate = row.querySelector('.labor-rate').innerText;
        let laboroverqty = row.querySelector('.labor-over-qty').innerText;
        let laboroverrate = row.querySelector('.labor-over-rate').innerText;
        let laborvat = row.querySelector('.labor-vat').innerText;
        let laborcost = row.querySelector('.labor-cost').innerText;




        let eqname = row.querySelector('.eq-name').innerText;
        let eqqty = row.querySelector('.eq-qty').innerText;
        let eqrate = row.querySelector('.eq-rate').innerText;
        let eqdqty = row.querySelector('.eq-d-qty').innerText;
        let eqdrate = row.querySelector('.eq-d-rate').innerText;
        let etotal = row.querySelector('.e-total').innerText;
        let equipvat = row.querySelector('.eq-vat').innerText;
        let revenue = row.querySelector('.revenue').innerText;
        let apppostdone = row.querySelector('.app-post').innerText;
        let smssentdone = row.querySelector('.sms-sent').innerText;
        let billstatus = row.querySelector('.bill-status').innerText;






        // Set the values in the modal
        //   document.getElementById('modal-dealername').innerText = dealername;
        document.getElementById('modal-client').innerText = clientname;
        document.getElementById('modal-date').innerText = date;
        document.getElementById('modal-load').innerText = loadp;
        document.getElementById('modal-unload').innerText = unload;
        document.getElementById('modal-reqType').innerText = reqtype;
        document.getElementById('modal-client-type').innerText = clinttype;
        document.getElementById('modal-tr-cate').innerText = transcate;
        document.getElementById('modal-tr-qty').innerText = transqty;
        document.getElementById('modal-tr-rate').innerText = transrate;


        //section two//
        document.getElementById('modal-d-rate').innerText = transdrate;
        document.getElementById('modal-trans-qty').innerText = transdqty;
        document.getElementById('modal-trans-cost').innerText = transcost;
        document.getElementById('modal-trans-vat').innerText = transvat;
        document.getElementById('modal-labor-qty').innerText = laborqty;
        document.getElementById('modal-labor-rate').innerText = laborrate;
        document.getElementById('modal-over-labor-qty').innerText = laboroverqty;
        document.getElementById('modal-over-labor-rate').innerText = laboroverrate;
        document.getElementById('modal-labor-vat').innerText = laborvat;
        document.getElementById('modal-labor-cost').innerText = laborcost;





        document.getElementById('modal-eq-name').innerText = eqname;
        document.getElementById('modal-eq-qty').innerText = eqqty;
        document.getElementById('modal-eq-rate').innerText = eqrate;
        document.getElementById('modal-eq-d-qty').innerText = eqdqty;
        document.getElementById('modal-eq-d-rate').innerText = eqdrate;
        document.getElementById('modal-eq-total').innerText = etotal;
        document.getElementById('modal-eq-vat').innerText = equipvat;
        document.getElementById('modal-revenue').innerText = revenue;
        document.getElementById('modal-app-post').innerText = apppostdone;
        document.getElementById('modal-sms-sent').innerText = smssentdone;
        document.getElementById('modal-status').innerText = billstatus;





    }
</script>

<?php 
    include('include/footer.php');
?>