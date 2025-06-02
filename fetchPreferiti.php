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
        p.contenuto,
        p.percorsoMedia,
        p.categoria,
        u.username AS autore,
        u.name,
        u.surname,
        img.immagine_profilo,
        img.immagine_copertina,
        TRUE AS preferito
    FROM 
        Preferiti fav
    JOIN 
        Post p ON fav.id_post = p.id_post
    JOIN 
        users u ON p.id_autore = u.id
    LEFT JOIN 
        ImmaginiUtente img ON u.id = img.id_utente
    WHERE 
        fav.id_utente = $userid
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
        'contenuto'        => $row['contenuto'],
        'percorsoMedia'    => $row['percorsoMedia'],
        'categoria'        => $row['categoria'],
        'autore'           => $row['autore'],
        'name'             => $row['name'],
        'surname'          => $row['surname'],
        'immagine_profilo' => $row['immagine_profilo'],
        'immagine_copertina' => $row['immagine_copertina'],
        'preferito'        => (bool) $row['preferito']
    ];
}

//JSON
mysqli_free_result($result);
mysqli_close($conn);
echo json_encode($posts);
exit;
?>
