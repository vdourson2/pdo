<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

//Nous allons faire une web app qui va lister les randonnées à l'île de la Réunion.
//Récupérer la base de données hiking (reunion_island.sql) pour l'importer.
//Cette base de données ne contient, pour l'instant, que la table hiking.
// Il faut insérer 5 randonnées. Chaque randonnée devra renseigner les champs :
//     name
//     difficulty (très facile, facile, etc.)
//     distance
//     duration
//     height_difference (dénivelé)

//Dans le fichier read.php, récupérez les randonnées directement de la base données et affichez-les dans un tableau.
try
{
	//Connecting to MySQL
	$pdo = new PDO(
		'mysql:host=localhost;dbname=becode;charset=utf8',
		'phpmyadmin', 
		'mypassword');
    $query = 'SELECT * FROM hiking';
    $arr = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    
    // Display all table - used to debug
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
    echo gettype($arr[0]['duration']);
    print_r(date_parse($arr[0]['duration']));
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Randonnées</title>
    <link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body>
    <h1>Liste des randonnées</h1>
    <table>
        <thead>
          <tr>
              <?php foreach($arr[0] as $key => $a) { ?>
                      <th><?= $key ?></th>
              <?php } ?>
          </tr>
        </thead>
        <tbody>
            <?php foreach($arr as $i => $row) { ?>
                  <tr>
                      <?php foreach($arr[$i] as $col => $data) { ?>
                        <?php if ($col == 'name') : ?>
                                <td><a href="./update.php?id=<?=$arr[$i]['id']?>"><?= htmlspecialchars($data) ?></a></td>
                        <?php else : ?>
                                <td><?= htmlspecialchars($data)?></td>
                        <?php endif ?>
                      <?php } ?>
                      <td><a href="./delete.php?id=<?= $arr[$i]['id']?>">Supprimer</a></td>
                  </tr>
          <?php } ?>
        </tbody>
    </table>
    <a href="./create.php">Ajouter une randonnées</a>
  </body>
</html>