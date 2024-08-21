<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'API_KEY.php';

try {
    // Get query parameters
    if (!isset($_GET['query']) || !isset($_GET['media_type'])) {
        throw new Exception('Missing query parameters');
    }

    $query = urlencode($_GET['query']);
    $mediaType = urlencode($_GET['media_type']);
    $url = "https://api.themoviedb.org/3/search/{$mediaType}?api_key={$apiKey}&query={$query}";

    // Fetch data from the API
    $response = file_get_contents($url);
    if ($response === FALSE) {
        throw new Exception('Failed to fetch data from TMDB API');
    }

    // Decode the JSON response
    $data = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception('Failed to decode JSON response: ' . json_last_error_msg());
    }

    // Process the results
    $results = [];
    foreach ($data['results'] as $item) {
        $results[] = [
            'id' => $item['id'],
            'title' => $item['title'] ?? $item['name'],
            'poster_path' => $item['poster_path']
        ];
    }

    // Return the results as JSON
    echo json_encode(['results' => $results]);
} catch (Exception $e) {
    // Log the error
    error_log($e->getMessage());

    // Return a 500 error response
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>