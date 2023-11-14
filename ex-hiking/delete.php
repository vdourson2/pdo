<?php
/**** Supprimer une randonnée ****/

try
{
	//Connecting to MySQL
	$pdo = new PDO(
		'mysql:host=localhost;dbname=becode;charset=utf8',
		'phpmyadmin', 
		'mypassword');

    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $query = $pdo->prepare('DELETE FROM hiking WHERE id = :id');
        $query->execute([
            'id'=>$id
        ]);
        header('Location:./read.php');
	}
}
catch(Exception $e)
{
    // En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}
