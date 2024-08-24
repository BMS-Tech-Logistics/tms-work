<?php
    include('include/header.php');
?>

<?php
    $result= "";
    if(isset($_POST['submitDealer'])){

        
        $setDealer = $objOperationAdmin->save_new_dealer($_POST);
        if($setDealer){
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
                                            title: 'Success',
                                            text: 'Add Dealer Successful!',
                                            icon: 'success',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                popup: 'swal2-popup'
                                            }
                                        });

                                        <?php } else if ($result == "no") { ?> 
                                        Swal.fire({
                                            title: 'Error',
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
                                            <input id="dealer_name" type="text" name="dealer_name" class="form-control" placeholder="Dealer Name" required>
                                        </div>
                                        
                                        <div class="form-group col-4">
                                            <label for="dealer_mobile">Dealer Mobile *</label>
                                            <input id="dealer_mobile" type="text" name="dealer_mobile" class="form-control" placeholder="Dealer Mobile" required>
                                        </div>

                                        <div class="form-group col-4">
                                            <label for="dealer_email">Email</label>
                                            <input id="dealer_email" type="email" name="dealer_email" class="form-control" placeholder="Email">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="dealer_nid">NID Number</label>
                                            <input id="dealer_nid" type="text" name="dealer_nid" class="form-control" placeholder="NID Number" required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="emergency_contact">Emergency Contact</label>
                                            <input id="emergency_contact" type="text" name="emergency_contact" class="form-control" placeholder="Emergency Contact" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="business_name">Business Name</label>
                                            <input id="business_name" type="text" name="business_name" class="form-control" placeholder="Business Name" required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="business_type">Business Type</label>
                                            <input id="business_type" type="text" name="business_type" class="form-control" placeholder="Business Type" required>
                                        </div>
                                    </div>
                                        
                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="address">Address *</label>
                                            <input id="address" type="text" name="address" class="form-control" placeholder="Address" required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="district">District *</label>
                                            <select id="district" class="select9 form-control" name="district" required>
                                                <option value=""></option>
                                                <optgroup label="City">
                                                <option value="Dhaka City">ঢাকা সিটি</option>
                                                <option value="Chattogram City">চট্টগ্রাম সিটি</option>
                                                <option value="Sylhet City">সিলেট সিটি</option>
                                                <option value="Rajshahi City">রাজশাহী সিটি</option>
                                                <option value="Khulna City">খুলনা সিটি</option>
                                                <option value="Rangpur City">রংপুর সিটি</option>
                                                <option value="Barisal City">বরিশাল সিটি</option>
                                                </optgroup>
                                                
                                                
                                                <optgroup label="District">
                                                <option value="Dhaka">ঢাকা</option>
                                                <option value="Narayanganj">নারায়ণগঞ্জ</option>
                                                <option value="Gazipur">গাজীপুর</option>
                                                <option value="Tangail">টাঙ্গাইল</option>
                                                <option value="Manikgonj">মানিকগঞ্জ</option>
                                                <option value="Munshigonj">মুন্সিগঞ্জ</option>
                                                <option value="Faridpur">ফরিদপুর</option>
                                                <option value="Rajbari">রাজবাড়ী</option>
                                                <option value="Narsingdi">নরসিংদী</option>
                                                <option value="Kishorgonj">কিশোরগঞ্জ</option>
                                                <option value="Shariatpur">শরীয়তপুর</option>
                                                <option value="Gopalgonj">গোপালগঞ্জ</option>
                                                <option value="Madaripur">মাদারীপুর</option>

                                                <option value="Chattogram">চট্টগ্রাম</option>
                                                <option value="Cumilla">কুমিল্লা</option>
                                                <option value="Feni">ফেনী</option>
                                                <option value="Brahmanbaria">ব্রাহ্মণবাড়িয়া</option>
                                                <option value="Noakhali">নোয়াখালী</option>
                                                <option value="Chandpur">চাঁদপুর</option>
                                                <option value="Lokkhipur">লক্ষ্মীপুর</option>
                                                <option value="Bandarban">বান্দরবন</option>
                                                <option value="Rangamati">রাঙ্গামাটি</option>
                                                <option value="CoxsBazar">কক্সবাজার</option>
                                                <option value="Khagrasori">খাগড়াছড়ি</option>

                                                <option value="Barisal">বরিশাল</option>
                                                <option value="Barguna">বরগুনা</option>
                                                <option value="Bhola">ভোলা</option>
                                                <option value="Patuakhali">পটুয়াখালী</option>
                                                <option value="Pirojpur">পিরোজপুর</option>
                                                <option value="Jhalokati">ঝালোকাঠি</option>

                                                <option value="Khulna">খুলনা</option>
                                                <option value="Kustia">কুষ্টিয়া</option>
                                                <option value="Jashore">যশোর</option>
                                                <option value="Chuadanga">চুয়াডাঙ্গা</option>
                                                <option value="Satkhira">সাতক্ষীরা</option>
                                                <option value="Bagerhat">বাগেরহাট</option>
                                                <option value="Meherpur">মেহেরপুর</option>
                                                <option value="Jhenaidah">ঝিনাইদাহ</option>
                                                <option value="Norail">নড়াইল</option>
                                                <option value="Magura">মাগুরা</option>

                                                <option value="Rangpur">রংপুর</option>
                                                <option value="Ponchogor">পঞ্চগড়</option>
                                                <option value="Thakurgaon">ঠাকুরগাও</option>
                                                <option value="Kurigram">কুড়িগ্রাম</option>
                                                <option value="Dinajpur">দিনাজপুর</option>
                                                <option value="Nilfamari">নীলফামারী</option>
                                                <option value="Lalmonirhat">লালমনিরহাট</option>
                                                <option value="Gaibandha">গাইবান্দা</option>

                                                <option value="Rajshahi">রাজশাহী</option>
                                                <option value="Pabna">পাবনা</option>
                                                <option value="Bagura">বগুড়া</option>
                                                <option value="Joypurhat">জয়পুরহাট</option>
                                                <option value="Nouga">নওগাঁ</option>
                                                <option value="Natore">নাটোর</option>
                                                <option value="Sirajgonj">সিরাজগঞ্জ</option>
                                                <option value="Chapainawabganj">চাপাইনবাবগঞ্জ</option>

                                                <option value="Sylhet">সিলেট</option>
                                                <option value="Habiganj">হবিগঞ্জ</option>
                                                <option value="Moulvibazar">মৌলভীবাজার</option>
                                                <option value="Sunamgonj">সুনামগঞ্জ</option>

                                                <option value="Mymensingh">ময়মনসিংহ</option>
                                                <option value="Netrokona">নেত্রকোনা</option>
                                                <option value="Jamalpur">জামালপুর</option>
                                                <option value="Sherpur">শেরপুর</option>
                                                </optgroup>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="reservationeventdatetime">Join Date *</label>
                                            <div class="input-group date" id="reservationeventdatetime" data-target-input="nearest">
                                                <input type="text" name="join_date" id="join_date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#join_date" placeholder="Join Date" required>

                                                <div class="input-group-append" data-target="#reservationeventdatetime" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="status">Status *</label>
                                            <select id="status" class="select3 form-control" name="status" required>
                                                <option value=""></option>
                                                <option value="1" selected>Active</option>
                                                <option value="0">Disable</option>
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