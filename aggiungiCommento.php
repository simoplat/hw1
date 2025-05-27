<?php
require_once 'auth.php';
if (!$userid = checkAuth()) exit;

header('Content-Type: application/json');

// Connessione al database
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(['error' => 'Errore di connessione al database']);
    exit;
}

if (isset($_POST['commento']) && isset($_POST['id_post'])) {
    $content = mysqli_real_escape_string($conn, $_POST['commento']);
    $post_id = intval($_POST['id_post']);
    $user_id = intval($userid);

    $query = "INSERT INTO commenti (id_post, id_autore, testo) 
              VALUES ($post_id, $user_id, '$content')";

    if (mysqli_query($conn, $query)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'Errore durante l\'inserimento del commento']);
    }

    mysqli_close($conn);
} else {
    echo json_encode(['error' => 'Dati mancanti']);
}
?>
