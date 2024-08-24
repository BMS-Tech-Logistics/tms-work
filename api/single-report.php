<!--header section -->
<?php
    include('include/header.php'); 
    include('include/sidebar.php');
?>

<?php
    $result = "";
    $msg = "";

    if (isset($_POST['savedata'])) {
        // Sanitize inputs
        $date = isset($_POST['date']) ? strip_tags($_POST['date']) : '';
        $requirements_type = isset($_POST['requirements_type']) ? strip_tags($_POST['requirements_type']) : '';
        $company_name = isset($_POST['company_name']) ? strip_tags($_POST['company_name']) : '';
        $home_shifting = isset($_POST['home_shifting']) ? strip_tags($_POST['home_shifting']) : '';
        $app_post = isset($_POST['app_post']) ? strip_tags($_POST['app_post']) : '';
        $confirmation_post = isset($_POST['confirmation_post']) ? strip_tags($_POST['confirmation_post']) : '';
        $sms_post = isset($_POST['sms_post']) ? strip_tags($_POST['sms_post']) : '';
        $portal_entry = isset($_POST['portal_entry']) ? strip_tags($_POST['portal_entry']) : '';
        $total_sales = isset($_POST['total_sales']) ? strip_tags($_POST['total_sales']) : '';
        $revenue = isset($_POST['revenue']) ? strip_tags($_POST['revenue']) : '';

        // Convert date to dd/mm/yyyy format
        $date_obj = DateTime::createFromFormat('Y-m-d', $date);
        $date_formatted = $date_obj ? $date_obj->format('d-m-Y') : null;

      
        if (!$date_formatted) {
            echo "Invalid date  format.";
            exit;
        }
                $sendresult = $objOperationAdmin->save_mis_report($_POST);
                if ($sendresult) {
                    $result = "yes";
                    $msg = "Data  Save successfully";
                } else {
                    $result = "no";
                    $msg = "Error: Unable to save message.";
                }
            } 
        
    
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3> Management Information system </h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_content">
                        <form class="" action="" method="post" novalidate>
                            <span class="section"> Mis Information </span>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                            <script>
                                <?php if ($result == "yes") { ?>
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Mis Report Save!',
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'swal2-popup'
                                    }
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'dashboard.php'; // Change to your success page
                                    }
                                });
                                <?php } else if ($result == "no") { ?> Swal.fire({
                                    title: 'Error',
                                    text: 'Something Went wrong.',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    customClass: {
                                        popup: 'swal2-popup'
                                    }
                                });
                                <?php } ?>
                            </script>
                            <div class="field item form-group"> <label class="col-form-label col-md-3 col-sm-3 label-align"> Date <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" class='date' type="date" name="date" required='required'>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"> Requirements Type <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control" tabindex="-1" name="requirement_type" required>
                                        <option></option>
                                        <option value="App">App</option>
                                        <option value="Web">Web</option>
                                        <option value="Social">Social</option>
                                        <option value="Manual">Manual</option>
                                    </select>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"> Client  Name <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control" name="client_name" tabindex="-1" required>
                                        <option></option>
                                        <option value="DHL">DHL</option>
                                        <option value="Haier">Haier</option>
                                        <option value="Others">Others</option>

                                    </select>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"> Client type <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control" name="client_type" tabindex="-1" required>
                                        <option></option>
                                        <option value="DHL">DHL</option>
                                        <option value="Haier">Haier</option>
                                        <option value="Others">Others</option>

                                    </select>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"> Requirement Qty<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control" name="requirment_qty" tabindex="-1" required>
                                        <option></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>

                                    </select>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"> Confirmation post <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control" name="confirmation_post" tabindex="-1" required>
                                        <option></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>

                                    </select>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"> Sms Sent <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control" name="sms_post" tabindex="-1" required>
                                        <option></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>

                                    </select>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">portal Entry <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select class="select2_single form-control" name="portal_entry" tabindex="-1" required>
                                        <option></option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>

                                    </select>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Total Sales <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="total_sales" placeholder="" type="number" required>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Revenue <span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" name="revenue" placeholder="" type="number" required>
                                </div>
                            </div>


                            <div>
                                <div class="field item form-group">
                                    <div class="col-md-4 offset-md-4">
                                        <button type='submit' name="savedata" class="btn btn-primary"> Save </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->




<?php
    include('include/footer.php');
?>