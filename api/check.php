<?php

// Get the protocol (http or https)
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";

// Get the host
$host = $_SERVER['HTTP_HOST'];

// Get the current request URI
$uri = $_SERVER['REQUEST_URI'];

// Combine them to form the full URL
$currentUrl = $protocol . "://" . $host . $uri;

// Replace '/gps=' with '/?code=' to rename the parameter
$originalUrl = str_replace('/gps=', '/?code=', $currentUrl);

// Parse the query string of the modified URL
$queryString = parse_url($originalUrl, PHP_URL_QUERY);

// Initialize parameters array
$params = [];

// Check if there is a query string
if ($queryString !== null) {
    parse_str($queryString, $params);
}

// Check if 'code' parameter exists and is not empty
if (isset($params['code']) && !empty($params['code'])) {
    $codeValue = $params['code'];
    echo $codeValue;
} else {
    $response = [
        'error' => "URL not found!"
    ];
    print json_encode($response);
}

?>




