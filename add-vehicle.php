<?php
    include('include/header.php');
?>

<?php
    $getUserList = $objOperationAdmin->getVendorList();

    $result= "";
    if(isset($_POST['submitVehicle'])){

        
        $setVehicle = $objOperationAdmin->save_new_vehicle($_POST);
        if($setVehicle){
            $result = "yes";
        }
        else{
            $result = "no";
        }

    }

?>

<style>
    .border-sty {
        border: 1px solid green;
        padding: 15px;
        border-radius: 5px;
        margin-bottom: 10px
    }

    .center-label {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        margin-bottom: 15px;
    }
</style>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Vehicle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add Vehicle</li>
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
                                <h3 class="card-title">Vehicle Information </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="newsAndMediaForm" method="post">
                                <script>
                                    <?php if ($result == "yes") { ?>
                                        Swal.fire({
                                            title: 'Success',
                                            text: 'Add New Vehicle Successful!',
                                            icon: 'success',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                popup: 'swal2-popup'
                                            }
                                        });

                                        <?php } else if ($result == "no") { ?> Swal.fire({
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
                                        <div class="form-group col-6">
                                            <label for="vehicle_name">Vehicle Name/Model</label>
                                            <input id="vehicle_name" type="text" name="vehicle_name" class="form-control" placeholder="exam: Tata Ex2" required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="vendor_name">Vendor Name</label>
                                            <select id="vendor_name" class="select8 form-control" name="vendor_id" required>
                                                <option value=""></option>
                                                <option value="0">Own</option>
                                                <optgroup label="Thirt Party Vendor">
                                                <?php while($userData=mysqli_fetch_array($getUserList)){ ?>
                                                <option value="<?php echo $userData['id'] ?>"><?php echo $userData['vendor_name']; ?>- 
                                                <?php echo $userData['work_area'] ?></option>
                                                <?php } ?>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="form-group  col-6">
                                            <label for="category">Vehicle Category *</label>
                                            <select id="category" class="select4 form-control" name="vehicle_category" required>
                                                <option value=""></option>
                                                <option value="Truck">ট্রাক</option>
                                                <option value="Pickup">পিকআপ</option>
                                                <option value="Covered Van">কভার্ড ভ্যান</option>
                                                <option value="Trailor">ট্রেইলর</option>
                                                <option value="Freezer Van">ফ্রিজার ভ্যান</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="size">Vehicle Size/Capacity *</label>
                                            <select id="size" class="select5 form-control" name="vehicle_size" required disabled>
                                                <option value=""></option>
                                                <!-- Truck Sizes -->
                                                <option value="14 Feet" data-category="Truck">14 Feet</option>
                                                <option value="16 Feet" data-category="Truck">16 Feet</option>
                                                <option value="18 Feet" data-category="Truck">18 Feet</option>
                                                <option value="20 Feet" data-category="Truck">20 Feet</option>
                                                <option value="23 Feet" data-category="Truck">23 Feet</option>

                                                <!-- Pickup Sizes -->
                                                <option value="7 Feet" data-category="Pickup">7 Feet</option>
                                                <option value="9 Feet" data-category="Pickup">9 Feet</option>
                                                <option value="12 Feet" data-category="Pickup">12 Feet</option>

                                                <!-- Covered Van Sizes -->
                                                <option value="7 Feet" data-category="Covered Van">7 Feet</option>
                                                <option value="9 Feet" data-category="Covered Van">9 Feet</option>
                                                <option value="12 Feet" data-category="Covered Van">12 Feet</option>
                                                <option value="14 Feet" data-category="Covered Van">14 Feet</option>
                                                <option value="16 Feet" data-category="Covered Van">16 Feet</option>
                                                <option value="18 Feet" data-category="Covered Van">18 Feet</option>
                                                <option value="20 Feet" data-category="Covered Van">20 Feet</option>
                                                <option value="23 Feet" data-category="Covered Van">23 Feet</option>

                                                <!-- Tailor Sizes -->
                                                <option value="20 Feet" data-category="Tailor">20 Feet</option>
                                                <option value="40 Feet" data-category="Tailor">40 Feet</option>

                                                <!-- Freezer Van Sizes -->
                                                <option value="7 Feet" data-category="Freezer Van">7 Feet</option>
                                                <option value="10 Feet" data-category="Freezer Van">10 Feet</option>
                                                <option value="12 Feet" data-category="Freezer Van">12 Feet</option>
                                                <option value="16 Feet" data-category="Freezer Van">16 Feet</option>
                                                <option value="18 Feet" data-category="Freezer Van">18 Feet</option>
                                                <option value="20 Feet" data-category="Freezer Van">20 Feet</option>

                                                <!-- Other categories sizes can be added similarly -->
                                            </select>
                                        </div>
                                    </div>

                                    <div class=" border-sty">

                                        <label class="center-label"> Transport Registration Number</label>
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="vehicle_zone">Registration Zone *</label>
                                                <select id="vehicle_zone" class="select6 form-control" name="vehicle_zone" required>
                                                    <option value=""></option>
                                                    <option value="Dhaka Metro">ঢাকা মেট্রো</option>
                                                    <option value="Chatto Metro">চট্ট মেট্রো</option>
                                                    <option value="Sylhet Metro">সিলেট মেট্রো</option>
                                                    <option value="Rajshahi Metro">রাজশাহী মেট্রো</option>
                                                    <option value="Khulna Metro">খুলনা মেট্রো</option>
                                                    <option value="Rangpur Metro">রংপুর মেট্রো</option>
                                                    <option value="Barisal Metro">বরিশাল মেট্রো</option>

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

                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="vehicle_serial">Registration serial *</label>
                                                <select id="vehicle_serial" class="select7 form-control" name="vehicle_serial" required>
                                                    <option value=""></option>
                                                    <option value="Ta">ট</option>
                                                    <option value="Tha">ঠ</option>
                                                    <option value="DA">ড</option>
                                                    <option value="Da">ঢ</option>
                                                    <option value="No">ন</option>
                                                    <option value="Mo">ম</option>
                                                    <option value="Sa">শ</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="vehicle_number">Registration Number *</label>
                                                <input id="vehicle_number" type="text" name="vehicle_number" class="form-control" placeholder="45-5465" maxlength="7" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" hidden>
                                        <label for="reservationeventdatetime">Join Date *</label>
                                        <div class="input-group date" id="reservationeventdatetime" data-target-input="nearest">
                                            <input type="text" name="join_date" id="join_date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#join_date" placeholder="Join Date" required>
                                            
                                            <div class="input-group-append" data-target="#reservationeventdatetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="vehicle_status">Status *</label>
                                        <select id="vehicle_status" class="select3 form-control" name="vehicle_status" required>
                                            <option value=""></option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" name="submitVehicle" class="btn btn-block bg-gradient-primary btn-lg">Submit</button>
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

<script>
    document.getElementById('vehicle_number').addEventListener('input', function (e) {
        let value = e.target.value;

        // Allow only digits and hyphen
        value = value.replace(/[^\d-]/g, '');

        // Enforce the pattern "45-5465"
        if (value.length > 0 && value.length <= 2) {
            // First part (2 digits)
            value = value.replace(/(\d{2})/, '$1');
        } else if (value.length > 2) {
            // Second part (hyphen + 4 digits)
            value = value.replace(/(\d{2})(-?)(\d{0,4})/, '$1-$3');
        }

        // Limit the length to 7 characters
        if (value.length > 7) {
            value = value.substring(0, 7);
        }

        // Update the input value
        e.target.value = value;
    });
</script>
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