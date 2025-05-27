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

// Leggi l'id_post dalla richiesta GET
if (!isset($_GET['id_post']) || !is_numeric($_GET['id_post'])) {
    echo json_encode(['error' => 'ID post non valido']);
    exit;
}

$id_post = intval($_GET['id_post']);

// Query con join per recuperare anche il nome utente dell'autore
$query = "
    SELECT u.username, c.testo
    FROM Commenti c
    JOIN users u ON c.id_autore = u.id
    WHERE c.id_post = $id_post
    ORDER BY c.id_commento DESC
";

$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(['error' => 'Errore nella query']);
    exit;
}

// Costruisci array dei commenti
$commenti = [];
while ($row = mysqli_fetch_assoc($result)) {
    $commenti[] = $row;
}

// Restituisci i commenti in formato JSON
echo json_encode($commenti);

mysqli_free_result($result);
mysqli_close($conn);

exit;
?>
