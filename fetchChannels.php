<?php 

require_once 'auth.php';
if (!$userid = checkAuth()) exit;

header('Content-Type: application/json');

$conn = mysqli_connect($dbconfig['host'], $dbconfig['user'], $dbconfig['password'], $dbconfig['name']);
if (!$conn) {
    echo json_encode(['error' => 'Errore di connessione al database']);
    exit;
}

$userid = mysqli_real_escape_string($conn, $userid);

$query = "
    SELECT u.id, u.username, u.name, u.surname 
    FROM iscrizione i
    JOIN users u ON i.seguito_id = u.id
    WHERE i.follower_id = $userid
";

$result = mysqli_query($conn, $query);
if (!$result) {
    http_response_code(500);
    echo json_encode(['error' => mysqli_error($conn)]);
    exit;
}

$arrayChannel = [];
while ($entry = mysqli_fetch_assoc($result)) {
    $arrayChannel[] = [
        'channelid' => $entry['id'],
        'channelname' => $entry['username'],
        'name' => $entry['name'],
        'surname' => $entry['surname']
    ];
}

echo json_encode($arrayChannel);

exit;
?>
