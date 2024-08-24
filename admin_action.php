<?php
    ob_start(); 
    session_start();
    include('classes/operation_admin.php');

    $objOperationAdmin=new operation_admin();

    //--- Vendor  ---//
	if(isset($_GET['vendor_status'])){
			$id = $_GET['id'];
			if($_GET['vendor_status'] == 'publish'){
				//$objOperationAdmin->updateNewsStatusById($id, "1");
			}
			else if($_GET['vendor_status'] == 'unpublish'){
				//$objOperationAdmin->updateNewsStatusById($id,"0");
			}
			else if($_GET['vendor_status'] == 'delete'){
				$objOperationAdmin->deleteVendorById($id);
			}
            
	}

    //--- Vehicle  ---//
	if(isset($_GET['vehicle_status'])){
			$id = $_GET['id'];
			if($_GET['vehicle_status'] == 'publish'){
				//$objOperationAdmin->updateNewsStatusById($id, "1");
			}
			else if($_GET['vehicle_status'] == 'unpublish'){
				//$objOperationAdmin->updateNewsStatusById($id,"0");
			}
			else if($_GET['vehicle_status'] == 'delete'){
				$objOperationAdmin->deleteVehicleById($id);
			}
            
	}


    //--- Dealer  ---//
	if(isset($_GET['dealer_status'])){
			$id = $_GET['id'];
			if($_GET['dealer_status'] == 'publish'){
				//$objOperationAdmin->updateNewsStatusById($id, "1");
			}
			else if($_GET['dealer_status'] == 'unpublish'){
				//$objOperationAdmin->updateNewsStatusById($id,"0");
			}
			else if($_GET['dealer_status'] == 'delete'){
				$objOperationAdmin->deleteDealerById($id);
			}
            
	}

    //--- Dealer Account ---//
	if(isset($_GET['dealer_account'])){
			$id = $_GET['id'];
			if($_GET['dealer_account'] == 'lock'){
				//$objOperationAdmin->updateNewsStatusById($id, "1");
			}
			else if($_GET['dealer_account'] == 'unlock'){
				//$objOperationAdmin->updateNewsStatusById($id,"0");
			}
			else if($_GET['dealer_account'] == 'delete'){
				$objOperationAdmin->deleteDealerAccountById($id);
			}
            
	}


    //--- Category ---//
	if(isset($_GET['slide_status'])){
			$id = $_GET['id'];
			if($_GET['slide_status'] == 'publish'){
				$objOperationAdmin->updateSlideImageStatusById($id, "1");
			}
			else if($_GET['slide_status'] == 'unpublish'){
				$objOperationAdmin->updateSlideImageStatusById($id, "0");
			}
			else if($_GET['slide_status'] == 'delete'){
				$objOperationAdmin->deleteSlideImageById($id);
			}
			else if($_GET['slide_status'] == 'moveUp'){
				$objOperationAdmin->updateSlidePositionMoveUpById($id);
			}
            
	}



    //-----User-Activity-Delete----//
    else if(isset($_GET['activity_delete'])){
        $id = $_GET['id'];
        if($_GET['activity_delete'] == 'delete'){    
            $objSuperAdmin->deleteUserActivityById($id);
        }
    }
   





