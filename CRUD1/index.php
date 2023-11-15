<?php 
try {
    $dsn = "mysql:host=localhost;dbname=colyseum;charset=utf8";
    $pdo = new PDO($dsn, 'phpmyadmin', 'mypassword');
    $clients = $pdo->query('SELECT * FROM clients')->fetchAll(PDO::FETCH_ASSOC);
    $showTypes = $pdo->query('SELECT * FROM showTypes')->fetchAll(PDO::FETCH_ASSOC);
    $clients20 = $pdo->query('SELECT * FROM clients LIMIT 20 ')->fetchAll(PDO::FETCH_ASSOC);
    $clientsFidelity = $pdo->query("SELECT * FROM clients WHERE card = '1'")->fetchAll(PDO::FETCH_ASSOC);
    $clientsM = $pdo->query("SELECT lastName, firstName FROM clients WHERE lastName LIKE 'M%' ORDER BY lastName ASC ")->fetchAll(PDO::FETCH_ASSOC);
    $spectacles = $pdo->query('SELECT title, performer, date, startTime FROM shows ORDER BY title ASC')->fetchAll(PDO::FETCH_ASSOC);
}
catch (Exception $e){
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : '.$e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Colyseum</title>
</head>
<body>
    

<?php
// Afficher tous les clients.
echo '<h1>Clients</h1>';
echo '<pre>';
print_r($clients);
echo '</pre>';

// Afficher tous les types de spectacles possibles.
echo '<h1>Types de spectacles</h1>';
echo '<pre>';
print_r($showTypes);
echo '</pre>';

// Afficher les 20 premiers clients.
echo '<h1>20 Clients</h1>';
echo '<pre>';
print_r($clients20);
echo '</pre>';

// N'afficher que les clients possédant une carte de fidélité.
echo '<h1>Clients avec carte de fidélité</h1>';
echo '<pre>';
print_r($clientsFidelity);
echo '</pre>';

//Afficher uniquement le nom et le prénom de tous les clients dont le nom commence par la lettre "M".
//Trier les noms par ordre alphabétique.
echo '<h1>Clients dont le nom commence par M</h1>';
echo '<pre>';
print_r($clientsM);
echo '</pre>';

//Afficher le titre de tous les spectacles ainsi que l'artiste, la date et l'heure. 
//Trier les titres par ordre alphabétique. 
echo '<h1>Spectacles</h1>';
echo '<pre>';
print_r($spectacles);
echo '</pre>';

?>
</body>
</html>