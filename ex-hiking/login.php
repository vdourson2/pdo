<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['login'],$_POST['pwd'])){
    try
    {
        //Connecting to MySQL
        $pdo = new PDO(
            'mysql:host=localhost;dbname=becode;charset=utf8',
            'phpmyadmin', 
            'mypassword');
        $query = 'SELECT * FROM users';
        $users = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($users as $key => $user) {
            if ($user['login'] == $_POST['login'] AND $user['password'] == sha1($_POST['pwd'])){
                session_start();
                $_SESSION['login'] = $_POST['login'];
                $_SESSION['password'] = $_POST['pwd'];
                $_SESSION['displayForm'] = 'none';
                break;
            }
        }
        // Display all table - used to debug
        // echo '<pre>';
        // print_r($users);
        // echo '</pre>';
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
            die('Erreur : '.$e->getMessage());
    }
}
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
header('location:./read.php');