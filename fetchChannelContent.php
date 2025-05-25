<?php
require_once 'auth.php';
if (!$userid = checkAuth()) exit;

header('Content-Type: application/json');
$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(['error' => 'Errore di connessione al database']);
    exit;
}

// Se viene passato un nome utente, cerco il suo ID
if (isset($_GET['user'])) {
    $username = mysqli_real_escape_string($conn, $_GET['user']);
    $res = mysqli_query($conn, "SELECT id FROM users WHERE username = '$username'");
    if ($row = mysqli_fetch_assoc($res)) {
        $searchUserId = $row['id'];
    } else {
        echo json_encode(['error' => 'Utente non trovato']);
        exit;
    }
} else {
    $searchUserId = $userid;
}

// Prendo i post dell'utente corretto
$query = "
    SELECT id_post, id_autore, title, contenuto, percorsoMedia, categoria 
    FROM Post 
    WHERE id_autore = $searchUserId
    ORDER BY id_post DESC 
";

$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(['error' => 'Errore nella query']);
    exit;
}

$postArray = [];
while ($entry = mysqli_fetch_assoc($result)) {
    $postArray[] = [
        'id_post' => $entry['id_post'],
        'id_autore' => $entry['id_autore'],
        'title' => $entry['title'],
        'contenuto' => $entry['contenuto'],
        'percorsoMedia' => $entry['percorsoMedia'],
        'categoria' => $entry['categoria']
    ];
}

echo json_encode($postArray);
exit;

?>