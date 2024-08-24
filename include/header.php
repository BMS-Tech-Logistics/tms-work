<?php
    ob_start(); 
    session_start();
    include('classes/operation_admin.php');

    $objOperationAdmin=new operation_admin();

    if($_SESSION['is_loged'] == null){
        header("Location:auth/login.php");
    }

    // Get the current page filename
    $current_page = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TMS Admin</title>

    <!--Favicon -->
    <link rel="icon" href="./dist/img/80x80.png" type="image/x-icon" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="plugins/fullcalendar/main.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Ekko Lightbox -->
    <link rel="stylesheet" href="plugins/ekko-lightbox/ekko-lightbox.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/dropshep_tagline_en.png" alt="droplogo" height="60" width="180">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="contacts.php" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Navbar Search -->
                <li class="nav-item" hidden>
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <?php 
                            /*$getLastMessage = $objOperationAdmin->getLastContactMessageInfo();
                            while($lastMessage=mysqli_fetch_array($getLastMessage)){*/
                        ?>
                        <a href="read-mail.php?message=<?php echo $lastMessage['id']; ?>" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title font-weight-bold">
                                        <?php echo $lastMessage['name']; ?>
                                    </h3>
                                    <p class="text-sm"><?php echo $lastMessage['message']; ?></p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                        <?php
                                                /*$created_timestamp = $lastMessage['created_at'];
                                                // Current timestamp
                                                $current_timestamp = date('Y-m-d H:i:s');
                                                $time_difference = time_difference_between($created_timestamp, $current_timestamp);
                                                echo $time_difference;*/
                                                
                                        ?>
                                    </p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <?php /*}*/ ?>
                        <a href="mailbox.php" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>

                <!-- Notifications Dropdown Menu Start-->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu End-->

                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="dist/img/avatar.png" class="user-image img-circle elevation-2" alt="User Image" height="26" width="26">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="#" class="dropdown-item" hidden>
                            <i class="fas fa-user mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider" hidden></div>
                        <a href="setting.php" class="dropdown-item">
                            <i class="fas fa-cog mr-2"></i> Setting
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="action-logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">

            <!-- Brand Logo -->
            <a href="./" class="brand-link">
                <img src="dist/img/dropshep_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"> TMS Panel <b>Dropshep</b></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="./dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a class="brand-text d-block font-weight-bold">Super Admin</a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <!----Dashboard---->
                        <li class="nav-item <?php echo ($current_page == 'index.php') ? 'menu-open' : ''; ?>">
                            <a href="./" class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fas fa-th"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-----Mis Report----->
                        <li class="nav-item <?php echo ($current_page == 'single_requirment.php' || $current_page == 'mis-list.php' || $current_page == 'report.php') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo ($current_page == 'single_requirment.php' || $current_page == 'mis-list.php' || $current_page == 'report.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fa fa-info" aria-hidden="true"></i>
                                <p>MIS  Report <i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="single_requirment.php" class="nav-link <?php echo ($current_page == 'single_requirment.php') ? 'active' : ''; ?>">
                                <i class=" nav-icon fa fa-edit"></i>
                                        <p> MIS Report Create </p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="mis-list.php" class="nav-link <?php echo ($current_page == 'mis-list.php') ? 'active' : ''; ?>">
                                      <i class="nav-icon fa fa-list-ol"></i>
                                        <p> MIS Report List </p>
                                    </a>
                                </li>

                            </ul> 
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="report.php" class="nav-link <?php echo ($current_page == 'report.php') ? 'active' : ''; ?>">
                                      <i class="nav-icon fa fa-list-ol"></i>
                                        <p> Daily Report List </p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        
                        <!--SMS Portal Menu-->
                        <li class="nav-item <?php echo ($current_page == 'loading.php' || $current_page == 'loading-list.php' || $current_page == 'trip-cancel.php') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo ($current_page == 'loading.php' || $current_page == 'loading-list.php') ? 'active' : ''; ?>">
                                <i class=" nav-icon   fa fa-envelope"></i>
                                <p>Sms Portal<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="loading.php" class="nav-link <?php echo ($current_page == 'loading.php') ? 'active' : ''; ?>">
                                        <i class=" nav-icon fa fa-ambulance"></i>
                                        <p>Loading sms</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="loading-list.php" class="nav-link <?php echo ($current_page == 'loading-list.php') ? 'active' : ''; ?>">
                                        <i class=" nav-icon fa fa-list-ol"></i>
                                        <p>All Loading List</p>
                                    </a>
                                </li>
                                <li class="nav-item" hidden>
                                    <a href="delivery.php" class="nav-link <?php echo ($current_page == 'delivery.php') ? 'active' : ''; ?>">
                                        <i class=" nav-icon fa fa-truck" aria-hidden="true"></i>
                                        <p>Delivery Sms</p>
                                    </a>
                                </li>
                                <li class="nav-item" hidden>
                                    <a href="trip-cancel.php" class="nav-link <?php echo ($current_page == 'trip-cancel.php') ? 'active' : ''; ?>">
                                        <i class=" nav-icon fa fa-times" aria-hidden="true"></i>
                                        <p>Trip Cancel Sms</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <!--Vendor List Menu-->
                        <li class="nav-item <?php echo ($current_page == 'add-vendor.php' || $current_page == 'vendor-list.php' || $current_page == 'update-vendor.php') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo ($current_page == 'add-vendor.php' || $current_page == 'vendor-list.php' || $current_page == 'update-vendor.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fa fa-users" aria-hidden="true"></i>
                                <p>Vendor<i class="fas fa-angle-left right"></i></p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-vendor.php" class="nav-link <?php echo ($current_page == 'add-vendor.php') ? 'active' : ''; ?>">
                                        <i class=" nav-icon fa fa-edit"></i>
                                        <p> Add Vendor </p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="vendor-list.php" class="nav-link <?php echo ($current_page == 'vendor-list.php' || $current_page == 'update-vendor.php') ? 'active' : ''; ?>">
                                        <i class=" nav-icon fa fa-list-ol"></i>
                                        <p>All Vendor List</p>
                                    </a>
                                </li>

                            </ul>


                        </li>
                        
                        <!--Vehicle List Menu-->
                        <li class="nav-item <?php echo ($current_page == 'add-vehicle.php' || $current_page == 'vehicle-list.php' || $current_page == 'update-vehicle.php') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo ($current_page == 'add-vehicle.php' || $current_page == 'vehicle-list.php' || $current_page == 'update-vehicle.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fa fa-truck" aria-hidden="true"></i>
                                <p>Vehicle <i class="fas fa-angle-left right"></i></p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-vehicle.php" class="nav-link <?php echo ($current_page == 'add-vehicle.php') ? 'active' : ''; ?>">
                                        <i class="nav-icon fa fa-edit" aria-hidden="true"></i>
                                        <p> Add Vehicle </p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="vehicle-list.php" class="nav-link <?php echo ($current_page == 'vehicle-list.php' || $current_page == 'update-vehicle.php') ? 'active' : ''; ?>">
                                        <i class="nav-icon fa fa-list-ol" aria-hidden="true"></i>
                                        <p>All Vehicle List</p>
                                    </a>
                                </li>

                            </ul>


                        </li>
                        
                        <!--Own Vehicle List Menu-->
                        <li class="nav-item <?php echo ($current_page == 'own-vehicle.php' || $current_page == 'vehicle-manage.php' || $current_page == 'own-vehicle-transaction.php') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo ($current_page == 'own-vehicle.php' || $current_page == 'vehicle-manage.php' || $current_page == 'own-vehicle-transaction.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fa fa-ambulance" aria-hidden="true"></i>
                                <p>Own Vehicle<i class="fas fa-angle-left right"></i></p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="vehicle-list.php" class="nav-link <?php echo ($current_page == 'own-vehicle.php') ? 'active' : ''; ?>">
                                        <i class="nav-icon fa fa-list-ol" aria-hidden="true"></i>
                                        <p>Vehicle List</p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-vehicle.php" class="nav-link <?php echo ($current_page == 'vehicle-manage.php') ? 'active' : ''; ?>">
                                        <i class="nav-icon fas fa-tree" aria-hidden="true"></i>
                                        <p>Vehicle Managment</p>
                                    </a>
                                </li>

                            </ul>


                        </li>
                        
                        
                        <!--Dealer List Menu-->
                        <li class="nav-item <?php echo ($current_page == 'add-dealer.php' || $current_page == 'dealer-list.php') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo ($current_page == 'add-dealer.php' || $current_page == 'dealer-list.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fa ion-person-stalker" aria-hidden="true"></i>
                                <p>Dealer <i class="fas fa-angle-left right"></i></p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-dealer.php" class="nav-link <?php echo ($current_page == 'add-dealer.php') ? 'active' : ''; ?>">
                                        <i class="nav-icon fa ion-person-add" aria-hidden="true"></i>
                                        <p> Add Dealer </p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="dealer-list.php" class="nav-link <?php echo ($current_page == 'dealer-list.php') ? 'active' : ''; ?>">
                                        <i class="nav-icon fa fa-list-ol" aria-hidden="true"></i>
                                        <p>All Dealer List</p>
                                    </a>
                                </li>

                            </ul>


                        </li>
                        
                        <!-----Payment Report------>
                        <li class="nav-item <?php echo ($current_page == 'bill-report.php' || $current_page == 'bill-report.php' || $current_page == 'bill-report.php') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo ($current_page == 'bill-report.php' || $current_page == 'bill-report.php' || $current_page == 'bill-report.php') ? 'active' : ''; ?>">
                               <i class="nav-icon far fa-calendar-alt"></i>
                                <p>Payment Report<i class="fas fa-angle-left right"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="bill-report.php" class="nav-link <?php echo ($current_page == 'bill-report.php') ? 'active' : ''; ?>">
                                        <i class=" nav-icon fa fa-edit"></i>
                                        <p> Bill Report </p>
                                    </a>
                                </li>

                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="bill-list.php" class="nav-link <?php echo ($current_page == 'bill-list.php') ? 'active' : ''; ?>">
                                        <i class=" nav-icon fa fa-list-ol"></i>
                                        <p> Bill  List </p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        
                        
                        <!--User List Menu-->
                        <li class="nav-item <?php echo ($current_page == 'add-user.php' || $current_page == 'users.php' || $current_page == 'update-user.php'|| $current_page == 'dealers.php') ? 'menu-open' : ''; ?>">
                            <a href="#" class="nav-link <?php echo ($current_page == 'add-user.php' || $current_page == 'users.php' || $current_page == 'update-user.php' || $current_page == 'dealers.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fa fa-user-circle" aria-hidden="true"></i>
                                <p>Users <i class="fas fa-angle-left right"></i></p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="add-user.php" class="nav-link <?php echo ($current_page == 'add-user.php' || $current_page == 'update-user.php') ? 'active' : ''; ?>">
                                        <i class="nav-icon fa ion-person-add" aria-hidden="true"></i>
                                        <p> Add User </p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="users.php" class="nav-link <?php echo ($current_page == 'users.php') ? 'active' : ''; ?>">
                                        <i class="nav-icon fa ion-android-contacts" aria-hidden="true"></i>
                                        <p>All User</p>
                                    </a>
                                </li>

                            </ul>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="dealers.php" class="nav-link <?php echo ($current_page == 'dealers.php') ? 'active' : ''; ?>">
                                        <i class="nav-icon fa ion-person-stalker" aria-hidden="true"></i>
                                        <p>All Dealer</p>
                                    </a>
                                </li>

                            </ul>


                        </li>
                        
                        <!-----Setting------>
                        <li class="nav-item <?php echo ($current_page == 'setting.php') ? 'menu-open' : ''; ?>">
                            <a href="setting.php" class="nav-link <?php echo ($current_page == 'setting.php') ? 'active' : ''; ?>">
                                <i class="nav-icon fa fa-cog fa-spin"></i>
                                <p>Setting</p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->

            <div class="sidebar-custom">
                <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
                <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
            </div>
            <!-- /.sidebar-custom -->
        </aside>