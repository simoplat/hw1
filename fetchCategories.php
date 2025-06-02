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
    SELECT DISTINCT p.categoria
    FROM Iscrizione i
    JOIN Post p ON i.seguito_id = p.id_autore
    WHERE i.follower_id = $userid
    AND p.categoria IS NOT NULL
    ORDER BY p.categoria;
    ";

$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(['error' => 'Errore nella query']);
    exit;
}

$categorie = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categorie[] = $row['categoria'];
}



mysqli_free_result($result);
mysqli_close($conn);
echo json_encode($categorie);


exit;

?>
