<?php
require_once 'auth.php';
if (!$userid = checkAuth()) exit;

header('Content-Type: app_content/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
$userid = mysqli_real_escape_string($conn, $userid);









?>
