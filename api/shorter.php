<?php
//setting header to json
header( 'Acess-Control-Allow-Origin: *' );
header( 'Content-Type: application/json' );
header( 'Acess-Control-Allow-Method: GET' );

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Connect to MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sms_portal";
    /*
    $servername = "localhost";
        $username = "dropshep_user";
        $password = "rx+Qq9V~kHRR";
        $dbname = "dropshep_sms";*/

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    /// Check if 'code' parameter exists in the URL
    if(isset($_GET['gps'])) {
        $short_code = $_GET['gps'];

        // Look up the original URL
        $sql = "SELECT original_url FROM url_shortener WHERE short_code = '$short_code'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Redirect to the original URL
            $row = $result->fetch_assoc();
            $original_url = $row["original_url"];
            header("Location: $original_url");
            exit();
        } else {
            $response = [
                'error' => "URL not found!"
            ];
            echo json_encode($response);
        }
    } 
    else {
        $response = [
                'error' => "'gps' parameter is required"
        ];
        echo json_encode($response);
    }
    // Close MySQL connection
    $conn->close();
}
 
else {
    // Handle invalid request method (should only be POST)
    http_response_code(405); // Method Not Allowed
    $response = [
        'error' => "Only GET method is supported"
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}

?>