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

$query = "
    SELECT 
        p.id_post,
        p.title,
        p.percorsoMedia,
        u.username AS canale,
        img.immagine_profilo,
        p.categoria
    FROM 
        Iscrizione i
    JOIN 
        users u ON i.seguito_id = u.id
    JOIN 
        Post p ON p.id_autore = u.id
    LEFT JOIN 
        ImmaginiUtente img ON img.id_utente = u.id
    WHERE 
        i.follower_id = $userid
    ORDER BY 
        p.id_post DESC
";

$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(['error' => 'Errore nella query']);
    exit;
}

$posts = [];
while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = [
        'id_post'          => (int) $row['id_post'],
        'title'            => $row['title'],
        'percorsoMedia'    => $row['percorsoMedia'],
        'canale'           => $row['canale'],
        'immagine_profilo' => $row['immagine_profilo'],
        'categoria'        => $row['categoria']
    ];
}


// Restituisci i post in formato JSON
mysqli_free_result($result);
mysqli_close($conn);
echo json_encode($posts);


exit;

?>
