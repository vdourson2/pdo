<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try
{
	// On se connecte à MySQL
	$pdo = new PDO(
		'mysql:host=localhost;dbname=weatherapp;charset=utf8',
		'phpmyadmin', 
		'mypassword');
	$query = 'SELECT * FROM Météo';
    $arr = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC); // Sur une même ligne ...
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
	var_dump($arr);
}
catch(Exception $e)
{
	// En cas d'erreur, on affiche un message et on arrête tout
        die('Erreur : '.$e->getMessage());
}

?>

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
				<?php foreach($arr[$i] as $data){ ?>
					<td><?= $data ?></td>
				<?php } ?>
			</tr>
	<?php } ?>
  </tbody>
</table>
