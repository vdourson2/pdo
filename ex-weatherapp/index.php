<?php
//Exercice d'utilisation de PDO : mini weatherapp
error_reporting(E_ALL);
ini_set('display_errors', 1);

try
{
	//Connecting to MySQL
	$pdo = new PDO(
		'mysql:host=localhost;dbname=weatherapp;charset=utf8',
		'phpmyadmin', 
		'mypassword');
	
	//Add a city
	if (isset($_GET['ville'],$_GET['haut'],$_GET['bas'])) {
		$query = $pdo->prepare('INSERT INTO Météo VALUES (:ville,:haut,:bas)');
		$query->execute([
			'ville'=> $_GET['ville'],
			'haut'=> $_GET['haut'],
			'bas'=> $_GET['bas']
		]);
		header('Location:./index.php');
	}

	//Suppress a city
	if (isset($_GET['del'])){
		$query = $pdo->prepare('DELETE FROM Météo WHERE ville LIKE :del');
		$query->execute([
			'del'=> $_GET['del']
		]);
		header('Location:./index.php');
	}

	$query = 'SELECT * FROM Météo';
	$arr = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
	
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

<form action="" method="get">
	<input type="text" name="ville" placeholder="City">
	<input type="number" name="haut" placeholder="Haut">
	<input type="number" name="bas" placeholder="Bas">
	<button type='submit'>Ajouter</button>
</form>

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
				<td>
					<a href="./index.php?del=<?= $row['ville'] ?>">
						<input type="checkbox" name="">
					</a>
				</td>
				<?php foreach($arr[$i] as $data){ ?>
					<td><?= $data ?></td>
				<?php } ?>
			</tr>
	<?php } ?>
  </tbody>
</table>
