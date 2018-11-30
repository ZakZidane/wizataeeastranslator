<!DOCTYPE html>
<html>
<head>
 <title>EEAS</title>
    
    <meta charset=UTF-8" />
    
    <link rel="stylesheet" href="../css/style.css" />
    </head>
<body>
<?php

session_start();
include '../pages/connexion.php';

$_SESSION['lien'] = $_POST['link'];
$langage=explode(",",$_POST['lang']);
$_SESSION['id_langage'] = $langage[0];
$_SESSION['code_langage'] = $langage[1];
$_SESSION['langage'] = $langage[2];

if(isset($_POST['btnlink']))
{
    $file_headers = @get_headers($_POST['link']);
if($file_headers[0] != 'HTTP/1.1 404 Not Found')
{echo "link ".$_POST['link']." is not found";
header("location:../accueil.php");}
$chemin_fichier =$_POST['link'];

$fp=fopen($chemin_fichier,"r");

$contenu = "";


if($fp)
{
   while(!feof($fp)){ 
   if ((strpos(fgets($fp,1024), '<p') !== false)
	   or (strpos(fgets($fp,1024), '<h1') !== false)
	   or (strpos(fgets($fp,1024), '<h2') !== false)
	   or (strpos(fgets($fp,1024), '<h3') !== false)
	   or (strpos(fgets($fp,1024), '<h4') !== false)
	   or (strpos(fgets($fp,1024), '<h5') !== false)
	   or (strpos(fgets($fp,1024), '<h6') !== false)
	   )
   $contenu .= trim(strip_tags(fgets($fp,1024)));
   $contenu=htmlspecialchars($contenu, ENT_IGNORE);
$contenu=str_replace("\\n","",$contenu);
$contenu=str_replace("\\r","",$contenu);
$contenu=str_replace("\\\"","",$contenu);
$contenu=str_replace("\"","",$contenu);
$contenu=str_replace("\'","",$contenu);
   }

 


//traduction----------------------------------------------------------

$key = '50f9e8db1cec491f96e24096ba9e4a88';


$u = "https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&to=";
$u.=$_SESSION['code_langage'];

$text = $contenu;

 //$text  = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $text );

$requestBody = array (
    array (
        'Text' => $text,
    ),
);
$content = json_encode($requestBody);
if (!function_exists('com_create_guid')) {
  function com_create_guid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
  }
}
$headers = "Content-type: application/json\r\n" .
        "Content-length: " . strlen($content) . "\r\n" .
        "Ocp-Apim-Subscription-Key: $key\r\n" .
        "X-ClientTraceId: " . com_create_guid() . "\r\n";
$options = array (
        'http' => array (
            'header' => $headers,
            'method' => 'POST',
            'content' => $content
        )
    );
    $context  = stream_context_create ($options);


$c= file_get_contents ($u, true, $context) or die("Failed to translation API plaise restart later!");
$c = json_encode(json_decode($c), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$assoc = false;
$depth = 512;
$options = 0;
   
    $json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $c);
    
    if(version_compare(phpversion(), '5.4.0', '>=')) {
        $json = json_decode($json, $assoc, $depth, $options);
    }
    elseif(version_compare(phpversion(), '5.3.0', '>=')) {
        $json = json_decode($json, $assoc, $depth);
    }
    else {
        $json = json_decode($json, $assoc);
    }
$_SESSION['codelangSource'] =$json[0]->detectedLanguage->language ;

$req="select * from langage where code='".$_SESSION['codelangSource']."'";
$r=$pdo->query($req);
if($row=$r->fetch())		  
{$_SESSION['nomLangageSource']=$row['nom_langage'];
$_SESSION['idlangSource']=$row['id_langage'];
}
$req="select MAX(id_translation) from translation";
$r=$pdo->query($req);
if($row=$r->fetch())		  
$_SESSION['Last_Record']=$row[0]+1;

header("location:aspireTraduire.php");
}					
else
echo "Impossible d'ouvrir la page $chemin_fichier";
}




if(isset($_POST['btntext']))
{
    $_SESSION['texteSource'] = $_POST['texteSource'];

$key = '50f9e8db1cec491f96e24096ba9e4a88';


$u = "https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&to=";
$u.=$_SESSION['code_langage'];

$text = $_POST['texteSource'];

 $text  = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $text );

$requestBody = array (
    array (
        'Text' => $text,
    ),
);
$content = json_encode($requestBody);
if (!function_exists('com_create_guid')) {
  function com_create_guid() {
    return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
        mt_rand( 0, 0xffff ),
        mt_rand( 0, 0x0fff ) | 0x4000,
        mt_rand( 0, 0x3fff ) | 0x8000,
        mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
    );
  }
}
$headers = "Content-type: application/json\r\n" .
        "Content-length: " . strlen($content) . "\r\n" .
        "Ocp-Apim-Subscription-Key: $key\r\n" .
        "X-ClientTraceId: " . com_create_guid() . "\r\n";
$options = array (
        'http' => array (
            'header' => $headers,
            'method' => 'POST',
            'content' => $content
        )
    );
    $context  = stream_context_create ($options);


$c= file_get_contents ($u, true, $context) or die("Failed to translation API plaise restart later!");
$c = json_encode(json_decode($c), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

$assoc = false;
$depth = 512;
$options = 0;
   
    $json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t]//.*)|(^//.*)#", '', $c);
    
    if(version_compare(phpversion(), '5.4.0', '>=')) {
        $json = json_decode($json, $assoc, $depth, $options);
    }
    elseif(version_compare(phpversion(), '5.3.0', '>=')) {
        $json = json_decode($json, $assoc, $depth);
    }
    else {
        $json = json_decode($json, $assoc);
    }
$_SESSION['codelangSource'] =$json[0]->detectedLanguage->language ;

$req="select * from langage where code='".$_SESSION['codelangSource']."'";
$r=$pdo->query($req);
if($row=$r->fetch())          
{$_SESSION['nomLangageSource']=$row['nom_langage'];
$_SESSION['idlangSource']=$row['id_langage'];
}
$req="select MAX(id_translation) from translation";
$r=$pdo->query($req);
if($row=$r->fetch())          
$_SESSION['Last_Record']=$row[0]+1;

header("location:traduireText.php");
}


?>
