<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RaccFilm</title>
</head>
<body>
    <h1>Sistema raccomandazioni film</h1>

    <h2>Qui ci sono i film consigliati tra un utente ed altri utenti:</h2>
    
    

    <div id="userSimilarities"></div>

    <?php include '../php/recommendation.php'; ?>

    <script>
        
        // Ordina le somiglianze degli utenti
        var sortedUserSimilarities = sortAssociativeArrayByValue(userSimilarities);

        // Visualizza le somiglianze degli utenti ordinati
        var userSimilaritiesDiv = document.getElementById("userSimilarities");
        sortedUserSimilarities.forEach(function(item) {
            var users = item[0].split('-');
            var user1 = users[0];
            var user2 = users[1];
            var similarity = item[1];
            userSimilaritiesDiv.innerHTML += "Similarità degli utenti" + user1 + " and " + user2 + ": " + similarity + "<br>";
        });
    </script>
    
</body>
</html>
