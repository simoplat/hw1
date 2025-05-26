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
    SELECT Post.id_post, Post.title, Post.contenuto, Post.percorsoMedia, Post.categoria,
           users.username AS autore, users.name, users.surname,
           i.immagine_profilo, i.immagine_copertina
    FROM Post
    JOIN users ON Post.id_autore = users.id
    LEFT JOIN immaginiutente AS i ON users.id = i.id_utente
    WHERE Post.id_post = $id_post
    LIMIT 1
";


$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(['error' => 'Errore nella query']);
    exit;
}

if (!$post = mysqli_fetch_assoc($result)) {
    echo json_encode(['error' => 'Post non trovato']);
    exit;
}

// Restituisci il post in formato JSON
echo json_encode([
    'id_post'       => (int) $post['id_post'],
    'title'         => $post['title'],
    'contenuto'     => $post['contenuto'],
    'percorsoMedia' => $post['percorsoMedia'],
    'categoria'     => $post['categoria'],
    'autore'        => $post['autore'],
    'name'          => $post['name'],
    'surname'       => $post['surname'],
    'immagine_profilo' => $post['immagine_profilo'],
    'immagine_copertina' => $post['immagine_copertina']
]);

exit;
?>
