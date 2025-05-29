<?php
require_once 'auth.php';
if (!$userid = checkAuth()) {
    echo json_encode(['error' => 'Utente non autenticato']);
    exit;
}

header('Content-Type: application/json');

// Connessione al database
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(['error' => 'Errore di connessione al database']);
    exit;
}

if (!isset($_POST['id_post'])) {
    echo json_encode(['error' => 'ID post non fornito']);
    exit;
}

$post_id = intval(mysqli_real_escape_string($conn, $_POST['id_post']));
$user_id = intval($userid);

if (empty($post_id) || empty($user_id)) {
    echo json_encode(['error' => 'ID post o ID utente non validi']);
    exit;
}

// Verifica se il post è già tra i preferiti
$query = "SELECT * FROM Preferiti WHERE id_utente = $user_id AND id_post = $post_id";
$res = mysqli_query($conn, $query);

if (!$res) {
    echo json_encode(['error' => 'Errore nella query SELECT']);
    mysqli_close($conn);
    exit;
}

if (mysqli_num_rows($res) > 0) {
    // Il post è già tra i preferiti, lo rimuovo
    $deleteQuery = "DELETE FROM Preferiti WHERE id_utente = $user_id AND id_post = $post_id";
    if (mysqli_query($conn, $deleteQuery)) {
        echo json_encode(['preferito' => false]);
    } else {
        echo json_encode(['error' => 'Errore durante la rimozione del preferito']);
    }
} else {
    // Il post non è tra i preferiti, lo aggiungo
    $insertQuery = "INSERT INTO Preferiti (id_utente, id_post) VALUES ($user_id, $post_id)";
    if (mysqli_query($conn, $insertQuery)) {
        echo json_encode(['preferito' => true]);
    } else {
        echo json_encode(['error' => 'Errore durante l\'aggiunta del preferito']);
    }
}

mysqli_free_result($res);
mysqli_close($conn);
exit;
?>
