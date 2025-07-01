<?php
if (!isset($_GET['phone'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing phone number']);
    exit;
}

$phone = preg_replace('/[^0-9]/', '', $_GET['phone']); // sanitize input
$url = "https://legendxdata.site/Api/simdata.php?phone=$phone";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
if (curl_errno($ch)) {
    http_response_code(500);
    echo json_encode(['error' => 'cURL error']);
} else {
    echo $response;
}
curl_close($ch);
