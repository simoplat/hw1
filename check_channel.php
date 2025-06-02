<?php
require_once 'auth.php';
header('Content-Type: application/json');

if (!$userid = checkAuth()) {
    echo 'false';
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo 'false';
    exit;
}

if (!isset($_POST['user'])) {
    echo 'false';
    exit;
}

$username = mysqli_real_escape_string($conn, $_POST['user']);
$user_id = intval($userid);

$query = "SELECT id FROM users WHERE username = '$username'";
$res = mysqli_query($conn, $query);

if (!$res || mysqli_num_rows($res) === 0) {
    echo 'false';
    mysqli_close($conn);
    exit;
}

$row = mysqli_fetch_assoc($res);
$channel_id = intval($row['id']);

// Non può iscriversi a se stesso
if ($channel_id === $user_id) {
    echo 'TeStesso';
    mysqli_close($conn);
    exit;
}

$checkQuery = "SELECT follower_id FROM iscrizione WHERE follower_id = $user_id AND seguito_id = $channel_id";
$checkRes = mysqli_query($conn, $checkQuery);

if ($checkRes && mysqli_num_rows($checkRes) > 0) {
    echo 'true';
} else {
    echo 'false';
}


mysqli_free_result($res);
if ($checkRes) mysqli_free_result($checkRes);
mysqli_close($conn);
exit;
?>
