<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
//Récupérer les informations envoyées par ce formulaire et les enregistrer dans la base de données.

$message = NULL;
try
{
	//Connecting to MySQL
	$pdo = new PDO(
		'mysql:host=localhost;dbname=becode;charset=utf8',
		'phpmyadmin', 
		'mypassword');

	if (isset($_POST['name'], $_POST['difficulty'], $_POST['distance'],$_POST['duration'],$_POST['height_difference'])) {
		$query = $pdo->prepare('INSERT INTO hiking (name, difficulty, distance, duration, height_difference) VALUES (:name, :difficulty, :distance, :duration, :height_difference)');
		$query->execute([
			'name'=>$_POST['name'],
			'difficulty' => $_POST['difficulty'],
			'distance' => $_POST['distance'],
			'duration' => $_POST['duration'],
			'height_difference' => $_POST['height_difference']
		]);
		$message = 'La randonnée a été rajoutée avec succès';
	}
    
    // Display all table - used to debug
    // echo '<pre>';
    // print_r($arr);
    // echo '</pre>';
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
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="./read.php">Liste des randonnées</a>
	<h1>Ajouter</h1>
	<p><?= $message ?? ''?></p>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="">
		</div>

		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>

		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
