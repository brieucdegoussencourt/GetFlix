<?php
$api_key = '3a7031c592fe904b320cba541d174789';
$endpoint = '';


if (isset($_GET['query'])) {
    $query = urlencode($_GET['query']);
    $media_type = isset($_GET['media_type']) ? $_GET['media_type'] : 'movie'; // default to movie if not specified
    $endpoint = "https://api.themoviedb.org/3/search/$media_type?api_key=$api_key&query=$query";
}

if ($endpoint) {
    $response = file_get_contents($endpoint);
    echo $response;
} else {
    echo json_encode(["error" => "No valid endpoint specified"]);
}
?>