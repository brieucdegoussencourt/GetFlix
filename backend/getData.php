<?php
header('Content-Type: application/json');

$apiKey = '3a7031c592fe904b320cba541d174789';
$apiKey = 'a2e04e780120a2bd372881b15bb83024';
$query = urlencode($_GET['query']);
$mediaType = urlencode($_GET['media_type']);
$url = "https://api.themoviedb.org/3/search/{$mediaType}?api_key={$apiKey}&query={$query}";

$response = file_get_contents($url);
if ($response === FALSE) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch data from TMDB API']);
    exit;
}

$data = json_decode($response, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to decode JSON response']);
    exit;
}

$results = [];
foreach ($data['results'] as $item) {
    $results[] = [
        'id' => $item['id'],
        'title' => $item['title'] ?? $item['name'],
        'poster_path' => $item['poster_path']
    ];
}

echo json_encode(['results' => $results]);
?>