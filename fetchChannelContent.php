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

// Prima query: prendo i post con immagini
$query = "
    SELECT id_post, id_autore, title, contenuto, percorsoMedia, categoria, i.immagine_profilo, i.immagine_copertina
    FROM Post 
    LEFT JOIN immaginiutente i ON Post.id_autore = i.id_utente
    WHERE id_autore = $searchUserId
    ORDER BY id_post DESC 
";

$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(['error' => 'Errore nella query']);
    exit;
}

// Inizializza i contenitori
$posts = [];
$profilo = [
    'immagine_profilo' => 'Media/Portrait_Placeholder.png',
    'immagine_copertina' => 'Media/placeholder.jpg'
];

// Prima query: prendi i post con immagini
$query = "
    SELECT id_post, id_autore, title, contenuto, percorsoMedia, categoria, i.immagine_profilo, i.immagine_copertina
    FROM Post 
    LEFT JOIN immaginiutente i ON Post.id_autore = i.id_utente
    WHERE id_autore = $searchUserId
    ORDER BY id_post DESC
";

$result = mysqli_query($conn, $query);
if ($result) {
    while ($entry = mysqli_fetch_assoc($result)) {
        // Popola i post
        $posts[] = [
            'id_post' => $entry['id_post'],
            'id_autore' => $entry['id_autore'],
            'title' => $entry['title'],
            'contenuto' => $entry['contenuto'],
            'percorsoMedia' => $entry['percorsoMedia'],
            'categoria' => $entry['categoria']
        ];

        // Prendi le immagini profilo/copertina dal primo risultato
        if ($entry['immagine_profilo'] || $entry['immagine_copertina']) {
            $profilo['immagine_profilo'] = $entry['immagine_profilo'] ?: $profilo['immagine_profilo'];
            $profilo['immagine_copertina'] = $entry['immagine_copertina'] ?: $profilo['immagine_copertina'];
        }
    }
}

// Se non ci sono post, fai query alternativa solo per le immagini
if (count($posts) === 0) {
    $queryImg = "
        SELECT immagine_profilo, immagine_copertina
        FROM immaginiutente
        WHERE id_utente = $searchUserId
        LIMIT 1
    ";
    $resImg = mysqli_query($conn, $queryImg);
    if ($resImg && $rowImg = mysqli_fetch_assoc($resImg)) {
        $profilo['immagine_profilo'] = $rowImg['immagine_profilo'] ?: $profilo['immagine_profilo'];
        $profilo['immagine_copertina'] = $rowImg['immagine_copertina'] ?: $profilo['immagine_copertina'];
    }
}

// Output completo
echo json_encode([
    'profilo' => $profilo,
    'post' => $posts
]);
exit;

?>
