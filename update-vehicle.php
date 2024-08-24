<?php
    include('include/header.php');
?>

<?php
    $getUserList = $objOperationAdmin->getVendorList();



 if(isset($_GET['user_id'])){
        $_SESSION['id'] = $_GET['user_id'];
        $user_id = $_GET['user_id'];
    }
    else if(isset($_SESSION['id'])){
        $user_id = $_SESSION['id'];
    }
    $getVehicle = $objOperationAdmin->getvehicleInfoById($user_id);
    $VehicleInfo=mysqli_fetch_array($getVehicle);


    $result= "";
    if(isset($_POST['submitVehicle'])){

        
        $updateVechi = $objOperationAdmin->update_vehi($_POST,$user_id);
        if($updateVechi){
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
            <h1>Update Vehicle</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Vehicle</li>
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Vehicle Information </h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form id="newsAndMediaForm" method="post">
                                <script>
                                    <?php if ($result == "yes") { ?>
                                        Swal.fire({
                                           // title: 'Success',
                                            text: ' Vehicle  Update  Successful!',
                                            icon: 'success',
                                            confirmButtonText: 'OK',
                                            customClass: {
                                                popup: 'swal2-popup'
                                            }
                                        })
                                        .then((result) => {
                                            if (result.isConfirmed) {
                                                window.location.href = 'vehicle-list.php'; // Change to your success page
                                            }
                                        });

                                        <?php } else if ($result == "no") { ?> Swal.fire({
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
                                        <div class="form-group col-6">
                                            <label for="vehicle_name">Vehicle Name/Model</label>
                                            <input id="vehicle_name" type="text" name="vehicle_name" class="form-control" placeholder="exam: Tata Ex2" value="<?php echo $VehicleInfo['vehicle_name'] ?>" required>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="vendor_name">Vendor Name</label>
                                            <select id="vendor_name" class="select8 form-control" name="vendor_id" required>
                                                
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
                                                <option value="<?php echo $VehicleInfo['vehicle_category'] ?>"><?php echo $VehicleInfo['vehicle_category'] ?></option>
                                                <option value="Truck">ট্রাক</option>
                                                <option value="Pickup">পিকআপ</option>
                                                <option value="Covered Van">কভার্ড ভ্যান</option>
                                                <option value="Trailor">ট্রেইলর</option>
                                                <option value="Freezer Van">ফ্রিজার ভ্যান</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-6">
                                            <input id="vehicle_size" value="<?php echo $VehicleInfo['vehicle_size'] ?>" hidden>
                                            <label for="size">Vehicle Size/Capacity *</label>
                                            <select id="size" class="select5 form-control" name="vehicle_size" required>
                                                <option value="<?php echo $VehicleInfo['vehicle_size'] ?>"><?php echo $VehicleInfo['vehicle_size'] ?></option>

                                                <!-- Truck Sizes -->
                                                <option value="14 Feet" data-category="Truck" <?php if ($VehicleInfo['vehicle_size'] == '14 Feet') echo 'selected'; ?>>14 Feet</option>
                                                <option value="16 Feet" data-category="Truck" <?php if ($VehicleInfo['vehicle_size'] == '16 Feet') echo 'selected'; ?>>16 Feet</option>
                                                <option value="18 Feet" data-category="Truck" <?php if ($VehicleInfo['vehicle_size'] == '18 Feet') echo 'selected'; ?>>18 Feet</option>
                                                <option value="20 Feet" data-category="Truck" <?php if ($VehicleInfo['vehicle_size'] == '20 Feet') echo 'selected'; ?>>20 Feet</option>
                                                <option value="23 Feet" data-category="Truck" <?php if ($VehicleInfo['vehicle_size'] == '23 Feet') echo 'selected'; ?>>23 Feet</option>

                                                <!-- Pickup Sizes -->
                                                <option value="7 Feet" data-category="Pickup" <?php if ($VehicleInfo['vehicle_size'] == '7 Feet') echo 'selected'; ?>>7 Feet</option>
                                                <option value="9 Feet" data-category="Pickup" <?php if ($VehicleInfo['vehicle_size'] == '9 Feet') echo 'selected'; ?>>9 Feet</option>
                                                <option value="12 Feet" data-category="Pickup" <?php if ($VehicleInfo['vehicle_size'] == '12 Feet') echo 'selected'; ?>>12 Feet</option>

                                                <!-- Covered Van Sizes -->
                                                <option value="7 Feet" data-category="Covered Van" <?php if ($VehicleInfo['vehicle_size'] == '7 Feet') echo 'selected'; ?>>7 Feet</option>
                                                <option value="9 Feet" data-category="Covered Van" <?php if ($VehicleInfo['vehicle_size'] == '9 Feet') echo 'selected'; ?>>9 Feet</option>
                                                <option value="12 Feet" data-category="Covered Van" <?php if ($VehicleInfo['vehicle_size'] == '12 Feet') echo 'selected'; ?>>12 Feet</option>
                                                <option value="14 Feet" data-category="Covered Van" <?php if ($VehicleInfo['vehicle_size'] == '14 Feet') echo 'selected'; ?>>14 Feet</option>
                                                <option value="16 Feet" data-category="Covered Van" <?php if ($VehicleInfo['vehicle_size'] == '16 Feet') echo 'selected'; ?>>16 Feet</option>
                                                <option value="18 Feet" data-category="Covered Van" <?php if ($VehicleInfo['vehicle_size'] == '18 Feet') echo 'selected'; ?>>18 Feet</option>
                                                <option value="20 Feet" data-category="Covered Van" <?php if ($VehicleInfo['vehicle_size'] == '20 Feet') echo 'selected'; ?>>20 Feet</option>
                                                <option value="23 Feet" data-category="Covered Van" <?php if ($VehicleInfo['vehicle_size'] == '23 Feet') echo 'selected'; ?>>23 Feet</option>

                                                <!-- Tailor Sizes -->
                                                <option value="20 Feet" data-category="Tailor" <?php if ($VehicleInfo['vehicle_size'] == '20 Feet') echo 'selected'; ?>>20 Feet</option>
                                                <option value="40 Feet" data-category="Tailor" <?php if ($VehicleInfo['vehicle_size'] == '40 Feet') echo 'selected'; ?>>40 Feet</option>

                                                <!-- Freezer Van Sizes -->
                                                <option value="7 Feet" data-category="Freezer Van" <?php if ($VehicleInfo['vehicle_size'] == '7 Feet') echo 'selected'; ?>>7 Feet</option>
                                                <option value="10 Feet" data-category="Freezer Van" <?php if ($VehicleInfo['vehicle_size'] == '10 Feet') echo 'selected'; ?>>10 Feet</option>
                                                <option value="12 Feet" data-category="Freezer Van" <?php if ($VehicleInfo['vehicle_size'] == '12 Feet') echo 'selected'; ?>>12 Feet</option>
                                                <option value="16 Feet" data-category="Freezer Van" <?php if ($VehicleInfo['vehicle_size'] == '16 Feet') echo 'selected'; ?>>16 Feet</option>
                                                <option value="18 Feet" data-category="Freezer Van" <?php if ($VehicleInfo['vehicle_size'] == '18 Feet') echo 'selected'; ?>>18 Feet</option>
                                                <option value="20 Feet" data-category="Freezer Van" <?php if ($VehicleInfo['vehicle_size'] == '20 Feet') echo 'selected'; ?>>20 Feet</option>

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
                                                    <option value="Dhaka Metro" <?php if ($VehicleInfo['vehicle_zone'] == 'Dhaka Metro') echo 'selected'; ?>>ঢাকা মেট্রো</option>
                                                    <option value="Chatto Metro" <?php if ($VehicleInfo['vehicle_zone'] == 'Chatto Metro') echo 'selected'; ?>>চট্ট মেট্রো</option>
                                                    <option value="Sylhet Metro" <?php if ($VehicleInfo['vehicle_zone'] == 'Sylhet Metro') echo 'selected'; ?>>সিলেট মেট্রো</option>
                                                    <option value="Rajshahi Metro" <?php if ($VehicleInfo['vehicle_zone'] == 'Rajshahi Metro') echo 'selected'; ?>>রাজশাহী মেট্রো</option>
                                                    <option value="Khulna Metro" <?php if ($VehicleInfo['vehicle_zone'] == 'Khulna Metro') echo 'selected'; ?>>খুলনা মেট্রো</option>
                                                    <option value="Rangpur Metro" <?php if ($VehicleInfo['vehicle_zone'] == 'Rangpur Metro') echo 'selected'; ?>>রংপুর মেট্রো</option>
                                                    <option value="Barisal Metro" <?php if ($VehicleInfo['vehicle_zone'] == 'Barisal Metro') echo 'selected'; ?>>বরিশাল মেট্রো</option>

                                                    <option value="Dhaka" <?php if ($VehicleInfo['vehicle_zone'] == 'Dhaka') echo 'selected'; ?>>ঢাকা</option>
                                                    <option value="Narayanganj" <?php if ($VehicleInfo['vehicle_zone'] == 'Narayanganj') echo 'selected'; ?>>নারায়ণগঞ্জ</option>
                                                    <option value="Gazipur" <?php if ($VehicleInfo['vehicle_zone'] == 'Gazipur') echo 'selected'; ?>>গাজীপুর</option>
                                                    <option value="Tangail" <?php if ($VehicleInfo['vehicle_zone'] == 'Tangail') echo 'selected'; ?>>টাঙ্গাইল</option>
                                                    <option value="Manikgonj" <?php if ($VehicleInfo['vehicle_zone'] == 'Manikgonj') echo 'selected'; ?>>মানিকগঞ্জ</option>
                                                    <option value="Munshigonj" <?php if ($VehicleInfo['vehicle_zone'] == 'Munshigonj') echo 'selected'; ?>>মুন্সিগঞ্জ</option>
                                                    <option value="Faridpur" <?php if ($VehicleInfo['vehicle_zone'] == 'Faridpur') echo 'selected'; ?>>ফরিদপুর</option>
                                                    <option value="Rajbari" <?php if ($VehicleInfo['vehicle_zone'] == 'Rajbari') echo 'selected'; ?>>রাজবাড়ী</option>
                                                    <option value="Narsingdi" <?php if ($VehicleInfo['vehicle_zone'] == 'Narsingdi') echo 'selected'; ?>>নরসিংদী</option>
                                                    <option value="Kishorgonj" <?php if ($VehicleInfo['vehicle_zone'] == 'Kishorgonj') echo 'selected'; ?>>কিশোরগঞ্জ</option>
                                                    <option value="Shariatpur" <?php if ($VehicleInfo['vehicle_zone'] == 'Shariatpur') echo 'selected'; ?>>শরীয়তপুর</option>
                                                    <option value="Gopalgonj" <?php if ($VehicleInfo['vehicle_zone'] == 'Gopalgonj') echo 'selected'; ?>>গোপালগঞ্জ</option>
                                                    <option value="Madaripur" <?php if ($VehicleInfo['vehicle_zone'] == 'Madaripur') echo 'selected'; ?>>মাদারীপুর</option>

                                                    <option value="Chattogram" <?php if ($VehicleInfo['vehicle_zone'] == 'Chattogram') echo 'selected'; ?>>চট্টগ্রাম</option>
                                                    <option value="Cumilla" <?php if ($VehicleInfo['vehicle_zone'] == 'Cumilla') echo 'selected'; ?>>কুমিল্লা</option>
                                                    <option value="Feni" <?php if ($VehicleInfo['vehicle_zone'] == 'Feni') echo 'selected'; ?>>ফেনী</option>
                                                    <option value="Brahmanbaria" <?php if ($VehicleInfo['vehicle_zone'] == 'Brahmanbaria') echo 'selected'; ?>>ব্রাহ্মণবাড়িয়া</option>
                                                    <option value="Noakhali" <?php if ($VehicleInfo['vehicle_zone'] == 'Noakhali') echo 'selected'; ?>>নোয়াখালী</option>
                                                    <option value="Chandpur" <?php if ($VehicleInfo['vehicle_zone'] == 'Chandpur') echo 'selected'; ?>>চাঁদপুর</option>
                                                    <option value="Lokkhipur" <?php if ($VehicleInfo['vehicle_zone'] == 'Lokkhipur') echo 'selected'; ?>>লক্ষ্মীপুর</option>
                                                    <option value="Bandarban" <?php if ($VehicleInfo['vehicle_zone'] == 'Bandarban') echo 'selected'; ?>>বান্দরবন</option>
                                                    <option value="Rangamati" <?php if ($VehicleInfo['vehicle_zone'] == 'Rangamati') echo 'selected'; ?>>রাঙ্গামাটি</option>
                                                    <option value="CoxsBazar" <?php if ($VehicleInfo['vehicle_zone'] == 'CoxsBazar') echo 'selected'; ?>>কক্সবাজার</option>
                                                    <option value="Khagrasori" <?php if ($VehicleInfo['vehicle_zone'] == 'Khagrasori') echo 'selected'; ?>>খাগড়াছড়ি</option>

                                                    <option value="Barisal" <?php if ($VehicleInfo['vehicle_zone'] == 'Barisal') echo 'selected'; ?>>বরিশাল</option>
                                                    <option value="Barguna" <?php if ($VehicleInfo['vehicle_zone'] == 'Barguna') echo 'selected'; ?>>বরগুনা</option>
                                                    <option value="Bhola" <?php if ($VehicleInfo['vehicle_zone'] == 'Bhola') echo 'selected'; ?>>ভোলা</option>
                                                    <option value="Patuakhali" <?php if ($VehicleInfo['vehicle_zone'] == 'Patuakhali') echo 'selected'; ?>>পটুয়াখালী</option>
                                                    <option value="Pirojpur" <?php if ($VehicleInfo['vehicle_zone'] == 'Pirojpur') echo 'selected'; ?>>পিরোজপুর</option>
                                                    <option value="Jhalokati" <?php if ($VehicleInfo['vehicle_zone'] == 'Jhalokati') echo 'selected'; ?>>ঝালোকাঠি</option>

                                                    <option value="Khulna" <?php if ($VehicleInfo['vehicle_zone'] == 'Khulna') echo 'selected'; ?>>খুলনা</option>
                                                    <option value="Kustia" <?php if ($VehicleInfo['vehicle_zone'] == 'Kustia') echo 'selected'; ?>>কুষ্টিয়া</option>
                                                    <option value="Jashore" <?php if ($VehicleInfo['vehicle_zone'] == 'Jashore') echo 'selected'; ?>>যশোর</option>
                                                    <option value="Chuadanga" <?php if ($VehicleInfo['vehicle_zone'] == 'Chuadanga') echo 'selected'; ?>>চুয়াডাঙ্গা</option>
                                                    <option value="Satkhira" <?php if ($VehicleInfo['vehicle_zone'] == 'Satkhira') echo 'selected'; ?>>সাতক্ষীরা</option>
                                                    <option value="Bagerhat" <?php if ($VehicleInfo['vehicle_zone'] == 'Bagerhat') echo 'selected'; ?>>বাগেরহাট</option>
                                                    <option value="Meherpur" <?php if ($VehicleInfo['vehicle_zone'] == 'Meherpur') echo 'selected'; ?>>মেহেরপুর</option>
                                                    <option value="Jhenaidah" <?php if ($VehicleInfo['vehicle_zone'] == 'Jhenaidah') echo 'selected'; ?>>ঝিনাইদাহ</option>
                                                    <option value="Norail" <?php if ($VehicleInfo['vehicle_zone'] == 'Norail') echo 'selected'; ?>>নড়াইল</option>
                                                    <option value="Magura" <?php if ($VehicleInfo['vehicle_zone'] == 'Magura') echo 'selected'; ?>>মাগুরা</option>

                                                    <option value="Rangpur" <?php if ($VehicleInfo['vehicle_zone'] == 'Rangpur') echo 'selected'; ?>>রংপুর</option>
                                                    <option value="Ponchogor" <?php if ($VehicleInfo['vehicle_zone'] == 'Ponchogor') echo 'selected'; ?>>পঞ্চগড়</option>
                                                    <option value="Thakurgaon" <?php if ($VehicleInfo['vehicle_zone'] == 'Thakurgaon') echo 'selected'; ?>>ঠাকুরগাও</option>
                                                    <option value="Kurigram" <?php if ($VehicleInfo['vehicle_zone'] == 'Kurigram') echo 'selected'; ?>>কুড়িগ্রাম</option>
                                                    <option value="Dinajpur" <?php if ($VehicleInfo['vehicle_zone'] == 'Dinajpur') echo 'selected'; ?>>দিনাজপুর</option>
                                                    <option value="Nilfamari" <?php if ($VehicleInfo['vehicle_zone'] == 'Nilfamari') echo 'selected'; ?>>নীলফামারী</option>
                                                    <option value="Lalmonirhat" <?php if ($VehicleInfo['vehicle_zone'] == 'Lalmonirhat') echo 'selected'; ?>>লালমনিরহাট</option>
                                                    <option value="Gaibandha" <?php if ($VehicleInfo['vehicle_zone'] == 'Gaibandha') echo 'selected'; ?>>গাইবান্দা</option>

                                                    <option value="Rajshahi" <?php if ($VehicleInfo['vehicle_zone'] == 'Rajshahi') echo 'selected'; ?>>রাজশাহী</option>
                                                    <option value="Pabna" <?php if ($VehicleInfo['vehicle_zone'] == 'Pabna') echo 'selected'; ?>>পাবনা</option>
                                                    <option value="Bagura" <?php if ($VehicleInfo['vehicle_zone'] == 'Bagura') echo 'selected'; ?>>বগুড়া</option>
                                                    <option value="Joypurhat" <?php if ($VehicleInfo['vehicle_zone'] == 'Joypurhat') echo 'selected'; ?>>জয়পুরহাট</option>
                                                    <option value="Nouga" <?php if ($VehicleInfo['vehicle_zone'] == 'Nouga') echo 'selected'; ?>>নওগাঁ</option>
                                                    <option value="Natore" <?php if ($VehicleInfo['vehicle_zone'] == 'Natore') echo 'selected'; ?>>নাটোর</option>
                                                    <option value="Sirajgonj" <?php if ($VehicleInfo['vehicle_zone'] == 'Sirajgonj') echo 'selected'; ?>>সিরাজগঞ্জ</option>
                                                    <option value="Chapainawabganj" <?php if ($VehicleInfo['vehicle_zone'] == 'Chapainawabganj') echo 'selected'; ?>>চাপাইনবাবগঞ্জ</option>

                                                    <option value="Sylhet" <?php if ($VehicleInfo['vehicle_zone'] == 'Sylhet') echo 'selected'; ?>>সিলেট</option>
                                                    <option value="Habiganj" <?php if ($VehicleInfo['vehicle_zone'] == 'Habiganj') echo 'selected'; ?>>হবিগঞ্জ</option>
                                                    <option value="Moulvibazar" <?php if ($VehicleInfo['vehicle_zone'] == 'Moulvibazar') echo 'selected'; ?>>মৌলভীবাজার</option>
                                                    <option value="Sunamgonj" <?php if ($VehicleInfo['vehicle_zone'] == 'Sunamgonj') echo 'selected'; ?>>সুনামগঞ্জ</option>

                                                    <option value="Mymensingh" <?php if ($VehicleInfo['vehicle_zone'] == 'Mymensingh') echo 'selected'; ?>>ময়মনসিংহ</option>
                                                    <option value="Netrokona" <?php if ($VehicleInfo['vehicle_zone'] == 'Netrokona') echo 'selected'; ?>>নেত্রকোনা</option>
                                                    <option value="Jamalpur" <?php if ($VehicleInfo['vehicle_zone'] == 'Jamalpur') echo 'selected'; ?>>জামালপুর</option>
                                                    <option value="Sherpur" <?php if ($VehicleInfo['vehicle_zone'] == 'Sherpur') echo 'selected'; ?>>শেরপুর</option>
                                                </select>

                                            </div>
                                            <div class="form-group col-4">
                                                <label for="vehicle_serial">Registration serial *</label>
                                                <select id="vehicle_serial" class="select7 form-control" name="vehicle_serial" required>
                                                    <option value="Ta" <?php if ($VehicleInfo['vehicle_serial'] == 'Ta') echo 'selected'; ?>>ট</option>
                                                    <option value="Tha" <?php if ($VehicleInfo['vehicle_serial'] == 'Tha') echo 'selected'; ?>>ঠ</option>
                                                    <option value="DA" <?php if ($VehicleInfo['vehicle_serial'] == 'DA') echo 'selected'; ?>>ড</option>
                                                    <option value="Da" <?php if ($VehicleInfo['vehicle_serial'] == 'Da') echo 'selected'; ?>>ঢ</option>
                                                    <option value="No" <?php if ($VehicleInfo['vehicle_serial'] == 'No') echo 'selected'; ?>>ন</option>
                                                    <option value="Mo" <?php if ($VehicleInfo['vehicle_serial'] == 'Mo') echo 'selected'; ?>>ম</option>
                                                    <option value="Sa" <?php if ($VehicleInfo['vehicle_serial'] == 'Sa') echo 'selected'; ?>>শ</option>
                                                </select>

                                            </div>
                                            <div class="form-group col-4">
                                                <label for="vehicle_number">Registration Number *</label>
                                                <input id="vehicle_number" type="text" name="vehicle_number" class="form-control" placeholder="45-5465" maxlength="7"   value="<?php echo $VehicleInfo['vehicle_number'] ?>" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group" hidden>
                                        <label for="reservationeventdatetime">Join Date *</label>
                                        <div class="input-group date" id="reservationeventdatetime" data-target-input="nearest">
                                            <input type="text" name="join_date" id="join_date" class="form-control datetimepicker-input" data-toggle="datetimepicker" data-target="#join_date" placeholder="Join Date"  value="<?php echo $VehicleInfo['join_date'] ?>" required>
                                            
                                            <div class="input-group-append" data-target="#reservationeventdatetime" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="vehicle_status">Status *</label>
                                        <select id="vehicle_status" class="select3 form-control" name="vehicle_status" required>
                                            
                                            <option value="1" <?php if (isset($VendorInfo['status']) && $VendorInfo['status'] == '1') echo 'selected'; ?>>Active</option>
                                            <option value="0" <?php if (isset($VendorInfo['status']) && $VendorInfo['status'] == '0') echo 'selected'; ?>>Inactive</option>
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