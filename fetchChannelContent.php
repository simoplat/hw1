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

// Inizializza i contenitori
$posts = [];
$profilo = [
    'immagine_profilo' => 'Media/Portrait_Placeholder.png',
    'immagine_copertina' => 'Media/placeholder.jpg',
    'name' => '',
    'surname' => ''
];

// Query con JOIN su utenti e immagini
$query = "
    SELECT p.id_post, p.id_autore, p.title, p.contenuto, p.percorsoMedia, p.categoria,
           i.immagine_profilo, i.immagine_copertina,
           u.name, u.surname, u.username
    FROM Post p
    LEFT JOIN immaginiutente i ON p.id_autore = i.id_utente
    LEFT JOIN users u ON p.id_autore = u.id
    WHERE p.id_autore = $searchUserId
    ORDER BY p.id_post DESC
";

$result = mysqli_query($conn, $query);
if ($result) {
    while ($entry = mysqli_fetch_assoc($result)) {
        // Aggiungi post alla lista
        $posts[] = [
            'id_post' => $entry['id_post'],
            'id_autore' => $entry['id_autore'],
            'title' => $entry['title'],
            'contenuto' => $entry['contenuto'],
            'percorsoMedia' => $entry['percorsoMedia'],
            'categoria' => $entry['categoria'],
            'username' => $entry['username'] ?: '',
        ];

        // Aggiorna immagini solo una volta
        if ($entry['immagine_profilo'] || $entry['immagine_copertina']) {
            $profilo['immagine_profilo'] = $entry['immagine_profilo'] ?: $profilo['immagine_profilo'];
            $profilo['immagine_copertina'] = $entry['immagine_copertina'] ?: $profilo['immagine_copertina'];
        }

        // Salva nome e cognome solo una volta
        if (empty($profilo['name']) && !empty($entry['name'])) {
            $profilo['name'] = $entry['name'];
            $profilo['surname'] = $entry['surname'];
            $profilo['username'] = $entry['username'];
        }
    }
}

// Se non ci sono post, fai query alternativa solo per profilo
if (count($posts) === 0) {
    $queryImg = "
        SELECT i.immagine_profilo, i.immagine_copertina, u.name, u.surname,u.username
        FROM users u
        LEFT JOIN immaginiutente i ON u.id = i.id_utente
        WHERE u.id = $searchUserId
        LIMIT 1

    ";
    $resImg = mysqli_query($conn, $queryImg);
    if ($resImg && $rowImg = mysqli_fetch_assoc($resImg)) {
        $profilo['immagine_profilo'] = $rowImg['immagine_profilo'] ?: $profilo['immagine_profilo'];
        $profilo['immagine_copertina'] = $rowImg['immagine_copertina'] ?: $profilo['immagine_copertina'];
        $profilo['name'] = $rowImg['name'] ?? '';
        $profilo['surname'] = $rowImg['surname'] ?? '';
        $profilo['username'] = $rowImg['username'] ?? '';
    }
}

echo json_encode([
    'profilo' => $profilo,
    'post' => $posts
]);


mysqli_free_result($result);
mysqli_close($conn);

exit;
?>
