<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if (isset($_SESSION['login'], $_SESSION['password'])){

	//Sur cette page on va pouvoir faire les modifications pour la randonnée choisie. 
	//Les champs du formulaire présents sur cette page doivent être pré-remplis à partir des informations de la randonnée choisie.
	try
	{
		//Connecting to MySQL
		$pdo = new PDO(
			'mysql:host=localhost;dbname=becode;charset=utf8',
			'phpmyadmin', 
			'mypassword');

		if (isset($_GET['id'])){
			$id = $_GET['id'];

			//Update db if form submited
			if (isset($_POST['name'], $_POST['difficulty'], $_POST['distance'],$_POST['duration'],$_POST['height_difference'])) {
				$query = $pdo->prepare('UPDATE hiking SET name = :name , difficulty = :difficulty, distance = :distance, duration = :duration, height_difference = :height_difference WHERE id = :id');
				$query->execute([
					'name'=>$_POST['name'],
					'difficulty' => $_POST['difficulty'],
					'distance' => $_POST['distance'],
					'duration' => $_POST['duration'],
					'height_difference' => $_POST['height_difference'],
					'id'=> $id
				]);
			}

			//Complete fields of the chosen hiking
			$query = $pdo->prepare('SELECT * FROM hiking WHERE id = :id');
			$query->execute([
				'id'=> $id
			]);
			$array = $query->fetch(PDO::FETCH_ASSOC);

			// Display selected hiking - used to debug
			// echo '<pre>';
			// print_r($array);
			// echo '</pre>';
		}
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
		<title>Modifier une randonnée</title>
		<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
	</head>
	<body>
		<a href="./read.php">Liste des randonnées</a>
		<h1>Modifier une randonnée</h1>
		<form action="" method="post">
			<div>
				<label for="name">Name</label>
				<input type="text" name="name" value="<?php echo htmlspecialchars($array['name']) !== NULL ? htmlspecialchars($array['name']) : '' ?>">
			</div>

			<div>
				<label for="difficulty">Difficulté</label>
				<select name="difficulty">
					<option value="très facile" <?= $array['difficulty'] == "très facile" ? 'selected' : ''?>>Très facile</option>
					<option value="facile"<?= $array['difficulty'] == "facile" ? 'selected' : ''?>>Facile</option>
					<option value="moyen" <?= $array['difficulty'] == "moyen" ? 'selected' : ''?>>Moyen</option>
					<option value="difficile" <?= $array['difficulty'] == "difficile" ? 'selected' : ''?>>Difficile</option>
					<option value="très difficile" <?= $array['difficulty'] == "très difficile" ? 'selected' : ''?>>Très difficile</option>
				</select>
			</div>
			
			<div>
				<label for="distance">Distance</label>
				<input type="text" name="distance" value="<?php echo htmlspecialchars($array['distance']) !== NULL ? htmlspecialchars($array['distance']) : '' ?>">
			</div>
			<div>
				<label for="duration">Durée</label>
				<input type="duration" name="duration" value="<?php echo htmlspecialchars($array['duration']) !== NULL ? htmlspecialchars($array['duration']) : '' ?>">
			</div>
			<div>
				<label for="height_difference">Dénivelé</label>
				<input type="text" name="height_difference" value="<?php echo htmlspecialchars($array['height_difference']) !== NULL ? htmlspecialchars($array['height_difference']) : '' ?>">
			</div>
			<button type="submit" name="button">Envoyer</button>
		</form>
	</body>
	</html>
	<?php 
}
else {
	echo '<p> Your are not loged in </p>';
}
