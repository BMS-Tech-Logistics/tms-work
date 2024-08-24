<?php
    include('include/header.php');
?>



<?php

  if(isset($_GET['user_id'])){
        $_SESSION['id'] = $_GET['user_id'];
        $user_id = $_GET['user_id'];
    }
    else if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }
   $getall = $objOperationAdmin->getDealerById($user_id);
    $getDealerInfo=mysqli_fetch_array($getall);




    $result= "";
    if(isset($_POST['submitDealer'])){

        
        $update = $objOperationAdmin->updateDealerById($_POST,$user_id);
        if($update){
            $result = "yes";
        }
        else{
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
            <h1>Add Dealer</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Dealer</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card card-solid">
            <div>
                
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title"> Dealer Information </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="newsAndMediaForm" method="post">
                                <script>
                                    <?php if ($result == "yes") { ?>
                                        Swal.fire({
                                         //   title: 'Success',
                                            text: ' Dealer Update Successful!',
                                            icon: 'success',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                popup: 'swal2-popup'
                                            }
                                        })
                                        .then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'dealer-list.php'; // Change to your success page
                                            }
                                        });

                                        <?php } else if ($result == "no") { ?> 
                                        Swal.fire({
                                           // title: 'Error',
                                            text: 'Something Went wrong!',
                                            icon: 'error',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                popup: 'swal2-popup'
                                            }
                                        });
                                    <?php } ?>
                                </script>
                                <div class="card-body">
                                    
                                    <div class="row">
                                        <div class="form-group col-4">
                                            <label for="dealer_name">Dealer Name *</label>
                                            <input id="dealer_name" type="text" name="dealer_name" class="form-control" placeholder="Dealer Name" value="<?php echo $getDealerInfo['dealer_name'] ?>"   required >
                                        </div>
                                        
                                        <div class="form-group col-4">
                                            <label for="dealer_mobile">Dealer Mobile *</label>
                                            <input id="dealer_mobile" type="text" name="dealer_mobile" class="form-control" placeholder="Dealer Mobile" value="<?php echo $getDealerInfo['dealer_mobile'] ?>"  required>
                                        </div>

                                        <div class="form-group col-4">
                                            <label for="dealer_email">Email</label>
                                            <input id="dealer_email" type="email" name="dealer_email" class="form-control" value="<?php echo $getDealerInfo['dealer_email'] ?>"  placeholder="Email">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="dealer_nid">NID Number</label>
                                            <input id="dealer_nid" type="text" name="dealer_nid" class="form-control" value="<?php echo $getDealerInfo['dealer_nid'] ?>"  placeholder="NID Number" required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="emergency_contact">Emergency Contact</label>
                                            <input id="emergency_contact" type="text" name="emergency_contact" class="form-control" placeholder="Emergency Contact"  value="<?php echo $getDealerInfo['emergency_contact'] ?>"  required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="business_name">Business Name</label>
                                            <input id="business_name" type="text" name="business_name" class="form-control" placeholder="Business Name" value="<?php echo $getDealerInfo['business_name'] ?>"  required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="business_type">Business Type</label>
                                            <input id="business_type" type="text" name="business_type" class="form-control" placeholder="Business Type" value="<?php echo $getDealerInfo['business_type'] ?>"  required>
                                        </div>
                                    </div>
                                        
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="address">Address *</label>
                                            <input type="text" name="address"   class="form-control" value="<?php echo $getDealerInfo['address'] ?>" required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="district">District *</label>
                                            <select id="district" class="select9 form-control" name="district" required>
                                                
                                                <optgroup label="City">
                                                    <option value="Dhaka City" <?php if ($getDealerInfo['district'] == 'Dhaka City') echo 'selected'; ?>>ঢাকা সিটি</option>
                                                    <option value="Chattogram City" <?php if ($getDealerInfo['district'] == 'Chattogram City') echo 'selected'; ?>>চট্টগ্রাম সিটি</option>
                                                    <option value="Sylhet City" <?php if ($getDealerInfo['district'] == 'Sylhet City') echo 'selected'; ?>>সিলেট সিটি</option>
                                                    <option value="Rajshahi City" <?php if ($getDealerInfo['district'] == 'Rajshahi City') echo 'selected'; ?>>রাজশাহী সিটি</option>
                                                    <option value="Khulna City" <?php if ($getDealerInfo['district'] == 'Khulna City') echo 'selected'; ?>>খুলনা সিটি</option>
                                                    <option value="Rangpur City" <?php if ($getDealerInfo['district'] == 'Rangpur City') echo 'selected'; ?>>রংপুর সিটি</option>
                                                    <option value="Barisal City" <?php if ($getDealerInfo['district'] == 'Barisal City') echo 'selected'; ?>>বরিশাল সিটি</option>
                                                </optgroup>

                                                
                                                
                                                <optgroup label="District">
                                                    <option value="Dhaka" <?php if ($getDealerInfo['district'] == 'Dhaka') echo 'selected'; ?>>ঢাকা</option>
                                                    <option value="Narayanganj" <?php if ($getDealerInfo['district'] == 'Narayanganj') echo 'selected'; ?>>নারায়ণগঞ্জ</option>
                                                    <option value="Gazipur" <?php if ($getDealerInfo['district'] == 'Gazipur') echo 'selected'; ?>>গাজীপুর</option>
                                                    <option value="Tangail" <?php if ($getDealerInfo['district'] == 'Tangail') echo 'selected'; ?>>টাঙ্গাইল</option>
                                                    <option value="Manikgonj" <?php if ($getDealerInfo['district'] == 'Manikgonj') echo 'selected'; ?>>মানিকগঞ্জ</option>
                                                    <option value="Munshigonj" <?php if ($getDealerInfo['district'] == 'Munshigonj') echo 'selected'; ?>>মুন্সিগঞ্জ</option>
                                                    <option value="Faridpur" <?php if ($getDealerInfo['district'] == 'Faridpur') echo 'selected'; ?>>ফরিদপুর</option>
                                                    <option value="Rajbari" <?php if ($getDealerInfo['district'] == 'Rajbari') echo 'selected'; ?>>রাজবাড়ী</option>
                                                    <option value="Narsingdi" <?php if ($getDealerInfo['district'] == 'Narsingdi') echo 'selected'; ?>>নরসিংদী</option>
                                                    <option value="Kishorgonj" <?php if ($getDealerInfo['district'] == 'Kishorgonj') echo 'selected'; ?>>কিশোরগঞ্জ</option>
                                                    <option value="Shariatpur" <?php if ($getDealerInfo['district'] == 'Shariatpur') echo 'selected'; ?>>শরীয়তপুর</option>
                                                    <option value="Gopalgonj" <?php if ($getDealerInfo['district'] == 'Gopalgonj') echo 'selected'; ?>>গোপালগঞ্জ</option>
                                                    <option value="Madaripur" <?php if ($getDealerInfo['district'] == 'Madaripur') echo 'selected'; ?>>মাদারীপুর</option>

                                                    <option value="Chattogram" <?php if ($getDealerInfo['district'] == 'Chattogram') echo 'selected'; ?>>চট্টগ্রাম</option>
                                                    <option value="Cumilla" <?php if ($getDealerInfo['district'] == 'Cumilla') echo 'selected'; ?>>কুমিল্লা</option>
                                                    <option value="Feni" <?php if ($getDealerInfo['district'] == 'Feni') echo 'selected'; ?>>ফেনী</option>
                                                    <option value="Brahmanbaria" <?php if ($getDealerInfo['district'] == 'Brahmanbaria') echo 'selected'; ?>>ব্রাহ্মণবাড়িয়া</option>
                                                    <option value="Noakhali" <?php if ($getDealerInfo['district'] == 'Noakhali') echo 'selected'; ?>>নোয়াখালী</option>
                                                    <option value="Chandpur" <?php if ($getDealerInfo['district'] == 'Chandpur') echo 'selected'; ?>>চাঁদপুর</option>
                                                    <option value="Lokkhipur" <?php if ($getDealerInfo['district'] == 'Lokkhipur') echo 'selected'; ?>>লক্ষ্মীপুর</option>
                                                    <option value="Bandarban" <?php if ($getDealerInfo['district'] == 'Bandarban') echo 'selected'; ?>>বান্দরবন</option>
                                                    <option value="Rangamati" <?php if ($getDealerInfo['district'] == 'Rangamati') echo 'selected'; ?>>রাঙ্গামাটি</option>
                                                    <option value="CoxsBazar" <?php if ($getDealerInfo['district'] == 'CoxsBazar') echo 'selected'; ?>>কক্সবাজার</option>
                                                    <option value="Khagrasori" <?php if ($getDealerInfo['district'] == 'Khagrasori') echo 'selected'; ?>>খাগড়াছড়ি</option>

                                                    <option value="Barisal" <?php if ($getDealerInfo['district'] == 'Barisal') echo 'selected'; ?>>বরিশাল</option>
                                                    <option value="Barguna" <?php if ($getDealerInfo['district'] == 'Barguna') echo 'selected'; ?>>বরগুনা</option>
                                                    <option value="Bhola" <?php if ($getDealerInfo['district'] == 'Bhola') echo 'selected'; ?>>ভোলা</option>
                                                    <option value="Patuakhali" <?php if ($getDealerInfo['district'] == 'Patuakhali') echo 'selected'; ?>>পটুয়াখালী</option>
                                                    <option value="Pirojpur" <?php if ($getDealerInfo['district'] == 'Pirojpur') echo 'selected'; ?>>পিরোজপুর</option>
                                                    <option value="Jhalokati" <?php if ($getDealerInfo['district'] == 'Jhalokati') echo 'selected'; ?>>ঝালোকাঠি</option>

                                                    <option value="Khulna" <?php if ($getDealerInfo['district'] == 'Khulna') echo 'selected'; ?>>খুলনা</option>
                                                    <option value="Kustia" <?php if ($getDealerInfo['district'] == 'Kustia') echo 'selected'; ?>>কুষ্টিয়া</option>
                                                    <option value="Jashore" <?php if ($getDealerInfo['district'] == 'Jashore') echo 'selected'; ?>>যশোর</option>
                                                    <option value="Chuadanga" <?php if ($getDealerInfo['district'] == 'Chuadanga') echo 'selected'; ?>>চুয়াডাঙ্গা</option>
                                                    <option value="Satkhira" <?php if ($getDealerInfo['district'] == 'Satkhira') echo 'selected'; ?>>সাতক্ষীরা</option>
                                                    <option value="Bagerhat" <?php if ($getDealerInfo['district'] == 'Bagerhat') echo 'selected'; ?>>বাগেরহাট</option>
                                                    <option value="Meherpur" <?php if ($getDealerInfo['district'] == 'Meherpur') echo 'selected'; ?>>মেহেরপুর</option>
                                                    <option value="Jhenaidah" <?php if ($getDealerInfo['district'] == 'Jhenaidah') echo 'selected'; ?>>ঝিনাইদাহ</option>
                                                    <option value="Norail" <?php if ($getDealerInfo['district'] == 'Norail') echo 'selected'; ?>>নড়াইল</option>
                                                    <option value="Magura" <?php if ($getDealerInfo['district'] == 'Magura') echo 'selected'; ?>>মাগুরা</option>

                                                    <option value="Rangpur" <?php if ($getDealerInfo['district'] == 'Rangpur') echo 'selected'; ?>>রংপুর</option>
                                                    <option value="Ponchogor" <?php if ($getDealerInfo['district'] == 'Ponchogor') echo 'selected'; ?>>পঞ্চগড়</option>
                                                    <option value="Thakurgaon" <?php if ($getDealerInfo['district'] == 'Thakurgaon') echo 'selected'; ?>>ঠাকুরগাও</option>
                                                    <option value="Kurigram" <?php if ($getDealerInfo['district'] == 'Kurigram') echo 'selected'; ?>>কুড়িগ্রাম</option>
                                                    <option value="Dinajpur" <?php if ($getDealerInfo['district'] == 'Dinajpur') echo 'selected'; ?>>দিনাজপুর</option>
                                                    <option value="Nilfamari" <?php if ($getDealerInfo['district'] == 'Nilfamari') echo 'selected'; ?>>নীলফামারী</option>
                                                    <option value="Lalmonirhat" <?php if ($getDealerInfo['district'] == 'Lalmonirhat') echo 'selected'; ?>>লালমনিরহাট</option>
                                                    <option value="Gaibandha" <?php if ($getDealerInfo['district'] == 'Gaibandha') echo 'selected'; ?>>গাইবান্দা</option>

                                                    <option value="Rajshahi" <?php if ($getDealerInfo['district'] == 'Rajshahi') echo 'selected'; ?>>রাজশাহী</option>
                                                    <option value="Pabna" <?php if ($getDealerInfo['district'] == 'Pabna') echo 'selected'; ?>>পাবনা</option>
                                                    <option value="Bagura" <?php if ($getDealerInfo['district'] == 'Bagura') echo 'selected'; ?>>বগুড়া</option>
                                                    <option value="Joypurhat" <?php if ($getDealerInfo['district'] == 'Joypurhat') echo 'selected'; ?>>জয়পুরহাট</option>
                                                    <option value="Nouga" <?php if ($getDealerInfo['district'] == 'Nouga') echo 'selected'; ?>>নওগাঁ</option>
                                                    <option value="Natore" <?php if ($getDealerInfo['district'] == 'Natore') echo 'selected'; ?>>নাটোর</option>
                                                    <option value="Sirajgonj" <?php if ($getDealerInfo['district'] == 'Sirajgonj') echo 'selected'; ?>>সিরাজগঞ্জ</option>
                                                    <option value="Chapainawabganj" <?php if ($getDealerInfo['district'] == 'Chapainawabganj') echo 'selected'; ?>>চাপাইনবাবগঞ্জ</option>

                                                    <option value="Sylhet" <?php if ($getDealerInfo['district'] == 'Sylhet') echo 'selected'; ?>>সিলেট</option>
                                                    <option value="Habiganj" <?php if ($getDealerInfo['district'] == 'Habiganj') echo 'selected'; ?>>হবিগঞ্জ</option>
                                                    <option value="Moulvibazar" <?php if ($getDealerInfo['district'] == 'Moulvibazar') echo 'selected'; ?>>মৌলভীবাজার</option>
                                                    <option value="Sunamgonj" <?php if ($getDealerInfo['district'] == 'Sunamgonj') echo 'selected'; ?>>সুনামগঞ্জ</option>

                                                    <option value="Mymensingh" <?php if ($getDealerInfo['district'] == 'Mymensingh') echo 'selected'; ?>>ময়মনসিংহ</option>
                                                    <option value="Netrokona" <?php if ($getDealerInfo['district'] == 'Netrokona') echo 'selected'; ?>>নেত্রকোনা</option>
                                                    <option value="Jamalpur" <?php if ($getDealerInfo['district'] == 'Jamalpur') echo 'selected'; ?>>জামালপুর</option>
                                                    <option value="Sherpur" <?php if ($getDealerInfo['district'] == 'Sherpur') echo 'selected'; ?>>শেরপুর</option>
                                                </optgroup>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="reservationeventdatetime">Join Date *</label>
                                            <div class="input-group date" id="reservationeventdatetime" data-target-input="nearest">
                                                <input type="text" name="join_date" id="join_date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#join_date" placeholder="Join Date"  value="<?php echo $getDealerInfo['join_date'] ?>" required>

                                                <div class="input-group-append" data-target="#reservationeventdatetime" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="status">Status *</label>
                                            <select id="status" class="select3 form-control" name="status" required>
                                                <option value="1" <?php if (isset($getDealerInfo['status']) && $getDealerInfo['status'] == '1') echo 'selected'; ?>>Active</option>
                                                <option value="0" <?php if (isset($getDealerInfo['status']) && $getDealerInfo['status'] == '0') echo 'selected'; ?>>Disable</option>
                                            </select>
                                        </div>
                                    </div>
                                   
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="submitDealer" class="btn btn-block bg-gradient-primary btn-lg">  Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>

                </div>
            </div>

        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>

<!-------NID Number Filter-------->
<script>
    document.getElementById('dealer_nid').addEventListener('input', function (e) {
        let value = e.target.value;

        // Allow only digits and hyphen
        value = value.replace(/[^\d-]/g, '');


        // Limit the length to 17 characters
        if (value.length > 17) {
            value = value.substring(0, 17);
        }

        // Update the input value
        e.target.value = value;
    });
</script>

<!------Contact Filter------->
<script>
    function formatMobileInput(e) {
        let value = e.target.value;

        // Allow only digits and hyphen
        value = value.replace(/[^\d-]/g, '');

        // Enforce the pattern "xxxxx-xxxxxxx"
        if (value.length > 5) {
            // Add hyphen after the first 5 digits if not present
            value = value.replace(/(\d{5})(-?)(\d{0,7})/, '$1-$3');
        } else {
            // Only allow up to 5 digits before the hyphen
            value = value.replace(/(\d{0,5})/, '$1');
        }

        // Limit the length to 12 characters
        if (value.length > 12) {
            value = value.substring(0, 12);
        }

        // Update the input value
        e.target.value = value;
    }

    // Apply to both fields
    document.getElementById('emergency_contact').addEventListener('input', formatMobileInput);
    document.getElementById('dealer_mobile').addEventListener('input', formatMobileInput);
</script>

<!-----Current date get----->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = String(today.getDate()).padStart(2, '0');
        var month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        var year = today.getFullYear();
        var formattedDate = day + '-' + month + '-' + year;
        document.getElementById('join_date').value = formattedDate;
    });
</script>

<?php 
    include('include/footer.php');
?>