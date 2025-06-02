<?php

require_once 'auth.php';

if (!checkAuth()) exit;

header('Content-Type: application/json');

// API Key di YouTube
$API_KEY = 'secret';
$maxResults = 20;

if (!isset($_POST['q'])) {
    echo json_encode(['error' => 'Parametro "q" mancante']);
    exit;
}

$searchInput = $_POST['q'];
$encodedQuery = urlencode($searchInput);

$apiUrl = "https://www.googleapis.com/youtube/v3/search?part=snippet&q={$encodedQuery}&type=video&maxResults={$maxResults}&key={$API_KEY}";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
curl_close($ch);

echo $response;

?>
