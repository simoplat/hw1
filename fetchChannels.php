<?php

require_once 'auth.php';
if (!$userid = checkAuth())
    exit;

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(['error' => 'Errore di connessione al database']);
    exit;
}

$userid = mysqli_real_escape_string($conn, $userid);

$query = "
    SELECT u.id, u.username, u.name, u.surname, imm.immagine_profilo
    FROM iscrizione i
    JOIN users u ON i.seguito_id = u.id
    LEFT JOIN immaginiutente imm ON u.id = imm.id_utente
    WHERE i.follower_id = $userid
";

$result = mysqli_query($conn, $query);
if (!$result) {
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

$arrayChannel = [];
while ($entry = mysqli_fetch_assoc($result)) {
    $arrayChannel[] = [
        'channelid' => $entry['id'],
        'channelname' => $entry['username'],
        'name' => $entry['name'],
        'surname' => $entry['surname'],
        'immagine_profilo' => $entry['immagine_profilo']
    ];
}

echo json_encode($arrayChannel);


mysqli_free_result($result);
mysqli_close($conn);


exit;
?>