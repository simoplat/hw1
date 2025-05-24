<?php 

require_once 'auth.php';
if (!$userid = checkAuth()) exit;

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(['error' => 'Errore di connessione al database']);
    exit;
}

// Prendo il parametro 'userid' dalla query string, se non esiste uso l'utente autenticato
$searchUserId = isset($_GET['userid']) ? intval($_GET['userid']) : $userid;

// Prepara la query per prendere gli ultimi 10 post dell'utente cercato
$query = "
    SELECT id_post, id_autore, contenuto, percorsoMedia, categoria 
    FROM Post 
    WHERE id_autore = $searchUserId
    ORDER BY id_post DESC 
";

$result = mysqli_query($conn, $query);
if (!$result) {
    exit;
}

$postArray = [];
while ($entry = mysqli_fetch_assoc($result)) {
    $postArray[] = [
        'id_post' => $entry['id_post'],
        'id_autore' => $entry['id_autore'],
        'contenuto' => $entry['contenuto'],
        'percorsoMedia' => $entry['percorsoMedia'],
        'categoria' => $entry['categoria']
    ];
}

echo json_encode($postArray);

exit;
?>
