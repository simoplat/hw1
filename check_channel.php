<?php
require_once 'auth.php';
header('Content-Type: application/json');

if (!$userid = checkAuth()) {
    echo json_encode(['iscritto' => false]);
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(['iscritto' => false]);
    exit;
}

if (!isset($_POST['user'])) {
    echo json_encode(['iscritto' => false]);
    exit;
}

$username = mysqli_real_escape_string($conn, $_POST['user']);
$user_id = intval($userid);

$query = "SELECT id FROM users WHERE username = '$username'";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (!$res || mysqli_num_rows($res) === 0) {
    echo json_encode(['iscritto' => false]);
    mysqli_close($conn);
    exit;
}

$row = mysqli_fetch_assoc($res);
$channel_id = intval($row['id']);

if ($channel_id === $user_id) {
    echo json_encode(['iscritto' => 'TeStesso']);
    mysqli_close($conn);
    exit;
}

$checkQuery = "SELECT follower_id FROM iscrizione WHERE follower_id = $user_id AND seguito_id = $channel_id";
$checkRes = mysqli_query($conn, $checkQuery) or die(mysqli_error($conn));

if ($checkRes && mysqli_num_rows($checkRes) > 0) {
    echo json_encode(['iscritto' => true]);
} else {
    echo json_encode(['iscritto' => false]);
}

mysqli_free_result($res);
if ($checkRes) mysqli_free_result($checkRes);
mysqli_close($conn);
exit;
?>
