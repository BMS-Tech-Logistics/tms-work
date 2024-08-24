<?php
//setting header to json
header( 'Acess-Control-Allow-Origin: *' );
header( 'Content-Type: application/json' );
header( 'Acess-Control-Allow-Method: GET' );

// Function to generate a random short code
function generateShortCode() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    $length = 6; // Length of the short code

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

// Check if request method is POST
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Connect to MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sms_portal";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    /// Check if 'code' parameter exists in the URL
    if(isset($_GET['url']) && $_GET['url'] !== "") {
        $original_url = strip_tags($_GET['url']);
        
        
        // Look up the original URL
        $sql = "SELECT short_code FROM url_shortener WHERE original_url = '$original_url'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $short_code = $row['short_code']; // Correct key is short_code
            $response = [
                    'already short_url' => "$short_code"
            ];
            echo json_encode($response);
        }
        else {
            // Generate unique short code
            $short_code = generateShortCode();
            // Look up the original URL
            $sql = "INSERT INTO url_shortener (original_url, short_code) VALUES ('$original_url', '$short_code')";
            $result = $conn->query($sql);

            if ($result) {
                // Redirect to the original URL

                //echo "Tracking found! ".$short_code;
                $response = [
                    'short_url' => "$short_code"
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
            } else {
                /*$response = [
                    'error' => "URL not found!"
                ];
                echo json_encode($response)*/;
                $jsonContent = json_encode($short_code);
                $encodedContent = urlencode($jsonContent);
                echo "Tracking URL not found! ".$short_code;
            }
        }
        
    } 
    else {
        /*$response = [
                'error' => "'gps' parameter is required"
        ];
        echo json_encode($response);*/
        echo "URL not found!";
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