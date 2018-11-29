<?php
$user='root';
$pass='';
echo "test modif" ;

$dsn=mysqli_init();mysqli_ssl_set($dsn, NULL, NULL, {ca-cert filename}, NULL, NULL); mysqli_real_connect($dsn, "translatorwizata-mysqldbserver.mysql.database.azure.com", "EEAS@translatorwizata-mysqldbserver", {}, {translationdb}, 3306);
try {
   $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
   die("Error ! : ".$e->getMessage());
}
?>
