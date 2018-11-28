<?php
$user='root';
$pass='';


$dsn = 'mysql:host=localhost;dbname=translationdb';
try {
   $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
   die("Error ! : ".$e->getMessage());
}
?>