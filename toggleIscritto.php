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

if (!isset($_POST['user'])) {
    echo json_encode(['error' => 'Username del canale non fornito']);
    exit;
}

$username = mysqli_real_escape_string($conn, $_POST['user']);
$user_id = intval($userid);

$query = "SELECT id FROM users WHERE username = '$username'";
$res = mysqli_query($conn, $query) or die(mysqli_error($conn));

if (!$res || mysqli_num_rows($res) === 0) {
    echo json_encode(['error' => 'Utente (canale) non trovato']);
    mysqli_close($conn);
    exit;
}

$row = mysqli_fetch_assoc($res);
$channel_id = intval($row['id']);

if ($channel_id === $user_id) {
    echo json_encode(['error' => 'Non puoi iscriverti a te stesso']);
    mysqli_close($conn);
    exit;
}

$checkQuery = "SELECT * FROM iscrizione WHERE follower_id = $user_id AND seguito_id = $channel_id";
$checkRes = mysqli_query($conn, $checkQuery) or die(mysqli_error($conn));

if (!$checkRes) {
    echo json_encode(['error' => 'Errore nella query SELECT']);
    mysqli_close($conn);
    exit;
}

if (mysqli_num_rows($checkRes) > 0) {
    // Già iscritto: rimuovi
    $deleteQuery = "DELETE FROM iscrizione WHERE follower_id = $user_id AND seguito_id = $channel_id";
    if (mysqli_query($conn, $deleteQuery) or die(mysqli_error($conn))) {
        echo json_encode(['iscritto' => false]);
    } else {
        echo json_encode(['error' => 'Errore durante la rimozione dell\'iscrizione']);
    }
} else {
    // Non iscritto: aggiungi
    $insertQuery = "INSERT INTO iscrizione (follower_id, seguito_id) VALUES ($user_id, $channel_id)";
    if (mysqli_query($conn, $insertQuery) or die(mysqli_error($conn))) {
        echo json_encode(['iscritto' => true]);
    } else {
        echo json_encode(['error' => 'Errore durante l\'aggiunta dell\'iscrizione']);
    }
}

mysqli_free_result($res);
mysqli_free_result($checkRes);
mysqli_close($conn);
exit;
?>
