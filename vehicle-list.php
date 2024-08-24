<?php 
    include('include/header.php');
?>

<?php

    
    $zoneBengali = "";
    $serialBengali = ""; 
    $numberBengali = "";

    // Function to convert English text to Bengali
    function convertToBengali($text) {
        $englishToBengali = [
            '0' => '০',
            '1' => '১',
            '2' => '২',
            '3' => '৩',
            '4' => '৪',
            '5' => '৫',
            '6' => '৬',
            '7' => '৭',
            '8' => '৮',
            '9' => '৯',
            'Metro' => 'মেট্রো',
            'Dhaka' => 'ঢাকা',
            'Chatto' => 'চট্টো',
            'Chattogram' => 'চট্টগ্রাম',
            'Sylhet' => 'সিলেট',
            'Rajshahi' => 'রাজশাহী',
            'Khulna' => 'খুলনা',
            'Rangpur' => 'রংপুর',
            'Barisal' => 'বরিশাল',
            'Ta' => 'ট',
            'Tha' => 'ঠ',
            'DA' => 'ড',
            'Da' => 'ঢ',
            'No' => 'ন',
            'Mo' => 'ম',
            'Sa' => 'শ',
            // Add more mappings as needed
        ];

        // Replace each English character with Bengali equivalent
        return strtr($text, $englishToBengali);
    }

    function convertNumber($number){
        // Convert English numbers to Bengali numbers
        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bengaliNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

        $bengaliConvert = str_replace($englishNumbers, $bengaliNumbers, $number);
        return $bengaliConvert;
    }

    $getVeicleList = $objOperationAdmin->getVehicleList();

?>
   
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Vehicle List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="./">Home</a></li>
                                <li class="breadcrumb-item active">Vehicle List</li>
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
                                    <h3 class="card-title">All Vehicle Information </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped text-center">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Vendor</th>
                                                <th>Vehicle</th>
                                                <th>Category</th>
                                                <th>Size</th>
                                                <th style="width:110px;">Regi. No</th>
                                                <th hidden>Start Service</th>
                                                <th>Last Trip</th>
                                                <th>Trip</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while($vehicleData=mysqli_fetch_array($getVeicleList)){ ?>

                                            <tr data-id="<?php echo $vehicleData['id']; ?>">
                                                <td><?php echo $vehicleData['id'] ?></td>
                                                <td class="vendor-name"><?php $id= $vehicleData['vendor_id']; 
                                                          $getVendorInfo = $objOperationAdmin->getVendorNameById($id);
                                                          echo $getVendorInfo; ?>
                                                </td>
                                                <td class="vehicle-name"><?php echo $vehicleData['vehicle_name'] ?></td>
                                                <td class="vehicle-category"><?php echo $vehicleData['vehicle_category'] ?></td>
                                                <td class="vehicle-size"><?php echo $vehicleData['vehicle_size'] ?></td>
                                                <td class="vehicle-reg"><?php 
                                                        $combinedText = $vehicleData['vehicle_zone'] . "-" . $vehicleData['vehicle_serial'] . "  " . $vehicleData['vehicle_number'];
                                                        // Convert the combined text to Bengali
                                                        $bengaliText = convertToBengali($combinedText);
                                                        echo $bengaliText;                                   
                                                    ?>
                                                </td>
                                                <td class="vehicle-service" hidden><?php echo convertNumber($vehicleData['start_service']); ?></td>
                                                <td class="vehicle-last-trip"><?php 
                                                        $originalDate = $vehicleData['last_trip'];
                                                        $formattedDate = date("d/m/Y", strtotime($originalDate));
                                                        echo convertNumber($formattedDate); ?> 
                                                </td>
                                                <td class="vehicle-trip"><?php echo convertNumber($vehicleData['no_trip']); ?> </td>
                                                <td class="vehicle-status"><?php echo $vehicleData['vehicle_status'] == 1 ? 'Active' : 'Inactive'; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        
                                                        <a href="update-vehicle.php?user_id=<?php echo $vehicleData['id'] ?>"><button type="button" class="btn btn-success btn-sm">
                                                            <i class="fas fa-edit"></i>
                                                        </button></a>
                                                        
                                                        <a class="ml-1"><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-default" onclick="sendStrings('<?php echo $vehicleData['id']; ?>')">
                                                            <i class="fas fa-eye"></i>
                                                        </button></a>
                                                        
                                                        <a class="ml-1"><button type="button" class="btn btn-danger  btn-sm" onclick="confirmDelete('<?php echo $vehicleData['id']; ?>')">
                                                                <i class="fas fa-trash"></i>
                                                        </button></a>
                                                        <script>
                                                            function confirmDelete(Id) {
                                                                var confirmDelete = confirm("Are you sure you want to delete This Vehicle " + Id + "?");
                                                                if (confirmDelete) {
                                                                    // Proceed with deletion action
                                                                    window.location.href = "admin_action.php?vehicle_status=delete&&id=" + Id;
                                                                    // You can place your deletion logic here
                                                                }
                                                            }
                                                        </script>
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
                
                
                <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Vehicle Information</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th style="width: 170px">Vendor Name</th>
                                            <td id="modal-vendorname">username</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Vehicle name</th>
                                            <td id="modal-vehicle">mobile</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Category</th>
                                            <td id="modal-category">Category</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Size</th>
                                            <td id="modal-size">Size</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Regi. No</th>
                                            <td id="modal-regi-no">Work Area</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Last Trip</th>
                                            <td id="modal-last-trip">0</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Total Trip</th>
                                            <td id="modal-total-trip">0</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Start Service</th>
                                            <td id="modal-start-service">0</td>
                                        </tr>
                                        <tr>
                                            <th style="width: 170px">Status</th>
                                            <td id="modal-status">Active</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer" style="margin-top:-15px;">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                
                
                
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <script>
            function sendStrings(id) {
                // Fetch data from the table row
                let row = document.querySelector('tr[data-id="' + id + '"]');
                let name = row.querySelector('.vendor-name').innerText;
                let vehicle = row.querySelector('.vehicle-name').innerText;
                let email = row.querySelector('.vehicle-category').innerText;
                let rentCategory = row.querySelector('.vehicle-size').innerText;
                let workArea = row.querySelector('.vehicle-reg').innerText;
                let startService = row.querySelector('.vehicle-service').innerText;
                let vehicleLastTrip = row.querySelector('.vehicle-last-trip').innerText;
                let totalTrip = row.querySelector('.vehicle-trip').innerText;
                let status = row.querySelector('.vehicle-status').innerText;

                // Set the values in the modal
                document.getElementById('modal-vendorname').innerText = name;
                document.getElementById('modal-vehicle').innerText = vehicle;
                document.getElementById('modal-category').innerText = email;
                document.getElementById('modal-size').innerText = rentCategory;
                document.getElementById('modal-regi-no').innerText = workArea;
                document.getElementById('modal-last-trip').innerText = vehicleLastTrip;
                document.getElementById('modal-total-trip').innerText = totalTrip;
                document.getElementById('modal-start-service').innerText = startService;
                document.getElementById('modal-status').innerText = status;
            }
        </script>

<?php 
    include('include/footer.php');
?>