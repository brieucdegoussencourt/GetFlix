<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Replace with your actual TMDB API key
$api_key = '3a7031c592fe904b320cba541d174789';

// Get the type parameter from the query string
$type = isset($_GET['type']) ? $_GET['type'] : 'movie';

// Validate the type parameter
if ($type !== 'movie' && $type !== 'tv') {
    echo json_encode(['error' => 'Invalid type parameter']);
    exit;
}

// Base URL for the TMDB API
$base_url = 'https://api.themoviedb.org/3/discover/';

// Full URL with the type and API key
$url = $base_url . $type . '?api_key=' . $api_key;

// Initialize cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
    echo json_encode(['error' => curl_error($ch)]);
} else {
    // Decode the JSON response
    $data = json_decode($response, true);

    // Check if the response contains an error
    if (isset($data['status_code']) && $data['status_code'] !== 200) {
        echo json_encode(['error' => $data['status_message']]);
    } else {
        // Return the data as JSON
        echo $response;
    }
}

// Close the cURL session
curl_close($ch);
?>