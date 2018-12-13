<?php
$user='EEAS@translatorwizata';
//$user='eeas@wizatatranslator-mysqldbserver';
$pass='Wizata987';
$server="translatorwizata.mysql.database.azure.com";
//$server="wizatatranslator-mysqldbserver.mysql.database.azure.com";
$bdd="translationdb";
$dsn = "mysql:host=".$server."; dbname=".$bdd;
try {
   $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
   die("Error ! : ".$e->getMessage());
}

?>

