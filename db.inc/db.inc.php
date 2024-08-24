<?php
    
    $server_host = "localhost";
    $server_user = "root";
    $server_db = "tscs_web";
    $server_password = "";

    //Create connection
    $mysqli = new mysqli($server_host, $server_user, $server_password, $server_db);

    //Ceck connection
    if($mysqli -> connect_error){
        die ("Connection failed: " . $mysqli->connect_error);
    }
    
    //echo "Connection Successfully";
    
    //Set Carecter Set
    $mysqli->query('SET CHARACTER SET utf8');
    $mysqli->query("SET SESSION collation_connection ='utf8_general_ci'");
    
    date_default_timezone_set("Asia/Dhaka");

?>