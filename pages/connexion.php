<?php
//$user='EEAS@translatorwizata-mysqldbserver';
$user='eeas@wizatatranslator';
$pass='Wizata987';
//$server="translatorwizata-mysqldbserver.mysql.database.azure.com";
$server="wizatatranslator.mysql.database.azure.com";
$bdd="translationdb";
$dsn = "mysql:host=".$server."; dbname=".$bdd;
try {
   $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
   die("Error ! : ".$e->getMessage());
}

?>

