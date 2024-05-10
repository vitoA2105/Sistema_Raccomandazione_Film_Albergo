<?php

// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "movie_recommendation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Funzione per calcolare la cosine similarity tra due vettori
function cosine_similarity($vec1, $vec2) {
    $dot_product = array_sum(array_map(function ($v1, $v2) { return $v1 * $v2; }, $vec1, $vec2));
    $magnitude1 = sqrt(array_sum(array_map(function ($v) { return $v * $v; }, $vec1)));
    $magnitude2 = sqrt(array_sum(array_map(function ($v) { return $v * $v; }, $vec2)));

    if ($magnitude1 == 0 || $magnitude2 == 0) {
        return 0;
    } else {
        return $dot_product / ($magnitude1 * $magnitude2);
    }
}

// Recuperiamo le valutazioni degli utenti dal database
$sql = "SELECT user_id, movie_id, rating FROM ratings";
$result = $conn->query($sql);

$ratings = [];
while ($row = $result->fetch_assoc()) {
    $ratings[$row['user_id']][$row['movie_id']] = $row['rating'];
}

// Calcoliamo la cosine similarity tra gli utenti
$similarities = [];
foreach ($ratings as $user1 => $user1_ratings) {
    foreach ($ratings as $user2 => $user2_ratings) {
        if ($user1 != $user2) {
            $similarity = cosine_similarity($user1_ratings, $user2_ratings);
            $similarities["$user1-$user2"] = $similarity;
        }
    }
}

// Ordiniamo le cosine similarity in ordine decrescente
arsort($similarities);

// Visualizziamo le cosine similarity
foreach ($similarities as $users => $similarity) {
    echo "Similarity between users $users: $similarity <br>";
}

$conn->close();

?>
