<?php
require_once 'auth.php';
header('Content-Type: application/json');

// Controlla autenticazione
if (!$userid = checkAuth()) {
    echo json_encode(['error' => 'Utente non autenticato']);
    exit;
}

// Connessione al database
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(['error' => 'Errore di connessione al database']);
    exit;
}

$user_id = intval(mysqli_real_escape_string($conn, $userid));

// Prepara la query per ottenere i follower dell'utente loggato
$query = "SELECT u.username
          FROM Iscrizione i
          JOIN users u ON i.follower_id = u.id
          WHERE i.seguito_id = $user_id";


$res = mysqli_query($conn, $query);

if (!$res) {
    echo json_encode(['error' => 'Errore nella query di selezione']);
    mysqli_close($conn);
    exit;
}


// Prepara i dati da restituire
$followers = [];
while ($row = mysqli_fetch_assoc($res)) {
    $followers[] = $row['username'];
}

// Risposta JSON
echo json_encode(['followers' => $followers]);

// Cleanup
mysqli_free_result($res);
mysqli_close($conn);
?>
