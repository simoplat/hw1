<?php
require_once 'auth.php';
header('Content-Type: application/json');

if (!$userid = checkAuth()) {
    echo json_encode(['error' => 'Utente non autenticato']);
    exit;
}

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(['error' => 'Errore di connessione al database']);
    exit;
}

$user_id = intval(mysqli_real_escape_string($conn, $userid));

$query = "SELECT u.username
          FROM Iscrizione i
          JOIN users u ON i.follower_id = u.id
          WHERE i.seguito_id = $user_id";


$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (!$res) {
    echo json_encode(['error' => 'Errore nella query di selezione']);
    mysqli_close($conn);
    exit;
}



$followers = [];
while ($row = mysqli_fetch_assoc($res)) {
    $followers[] = $row['username'];
}


echo json_encode(['followers' => $followers]);


mysqli_free_result($res);
mysqli_close($conn);
?>
