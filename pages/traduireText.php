<head>
 <title>EEAS</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
	<link rel="stylesheet" href="../css/style.css" />
	</head>
<body>
<?php
session_start();
$textsource=$_SESSION['texteSource'];			
$langage_destination=$_SESSION['id_langage'];
$codelangageSource=$_SESSION['codelangSource'];
$nomLangageSource=$_SESSION['nomLangageSource'];
$idlangSource=$_SESSION['idlangSource'];

$codeLangageDest=$_SESSION['code_langage'];
$nomLangageDest=$_SESSION['langage'];
include '../pages/connexion.php';
if(isset($_POST['btnBack']))
header("location:../accueil.php" );
  if(isset($_POST['btnsauve']))
{
$textSource=$_POST['texteSource'];
$textTraduit=$_POST['texteDestination'];
$textSource=preg_replace("/'/", " ",$textSource);
$textTraduit=preg_replace("/'/", " ",$textTraduit);	
$_SESSION['texteSource']=$textSource;
if(!empty($textTraduit) and !empty($textTraduit) )
{		$d=date("Y-m-d H:i:s");
	$date_trans=new DateTime($d);
$d=$date_trans->format('Y-m-d H:i:s');

$req="INSERT INTO translation(link,dates,original,translation,id_langage_Source,id_langage_destination) 
VALUES('text','$d','$textSource','$textTraduit','$idlangSource','$langage_destination')";		
			if($pdo->exec($req))
			{	 echo "<div class='col-md-10 col-md-offset-1 center section-title'>
						<h4>Record has been saved successfully!<br>Page will be refreshed in 3 seconds</h4></div>";
			$_SESSION['last_id'] = $pdo->lastInsertId();}
			 else
				  echo "<div class='col-md-10 col-md-offset-1 center section-title'>
						<h4>Failed saving record!<br>Page will be refreshed in 3 seconds</h4></div>";
header("Refresh: 3; url=traduireText.php" );			 
		
			  }}
if(isset($_POST['btnModif']))
	{$last_id=$_SESSION['last_id'];
	if($last_id!=$_SESSION['Last_Record'])
		echo "<div class='col-md-10 col-md-offset-1 center section-title'>
						<h4>Must save record first!<br>Page will be refreshed in 3 seconds</h4></div>";
    else {	
$textSource=$_POST['texteSource'];
$textTraduit=$_POST['texteDestination'];
$textSource=preg_replace("/'/", " ",$textSource);
$textTraduit=preg_replace("/'/", " ",$textTraduit);	
$_SESSION['texteSource']=$textSource;
$_SESSION['tt']=$textTraduit;
if(!empty($textTraduit) and !empty($textTraduit) )
{		$d=date("Y-m-d H:i:s");
$req="INSERT INTO edition(dates,source_edited,translation_edited,id_translation) 
VALUES('$d','$textSource','$textTraduit','$last_id')";		
			if($pdo->exec($req))
				 echo "<div class='col-md-10 col-md-offset-1 center section-title'>
					<h4>Edition has been saved successfully!<br>Page will be refreshed in 3 seconds</h4></div>";
			 else
			 echo "<div class='col-md-10 col-md-offset-1 center section-title'>
						<h4>Failed saving edition!<br>Page will be refreshed in 3 seconds</h4></div>";
}}
header("Refresh: 3; url=traduireText.php" );
}


   $contenu = trim(strip_tags($textsource));
$contenu=htmlspecialchars($contenu, ENT_IGNORE);
$contenu=str_replace("\\n","",$contenu);
$contenu=str_replace("\\r","",$contenu);
$contenu=str_replace("\\\"","",$contenu);
$contenu=str_replace("\"","",$contenu);
$contenu=str_replace("\'","",$contenu);
   

 
 echo "<section id=section-subscribe class=subscribe-wrap>
<div class='col-md-10 col-md-offset-1 center section-title'>";



//traduction----------------------------------------------------------

$key = '50f9e8db1cec491f96e24096ba9e4a88';


$u = "https://api.cognitive.microsofttranslator.com/translate?api-version=3.0&to=";
$u.=$codeLangageDest;
$text = $contenu;
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
            'content' => $content,
			'category' => "9c0c0196-5575-4437-9d18-5d623691282c-POLISCI"
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

$textTraduit=trim($json[0]->translations[0]->text);
$textTraduit=str_replace ("   ", "", $textTraduit);
while (($pos = strpos ($textTraduit, "\s\s")) !== FALSE) {
  $textTraduit = substr_replace ($textTraduit, "\s", $pos, 2);
}

if($codelangageSource=="zh-Hans" or $codelangageSource=="zh-Hant")
$contenu=preg_replace("/[a-zA-Z\_]/", "",$contenu);

echo "<br><h4>text in ".$nomLangageSource.":</h4>";
echo "<form id=subscription-form  method=post>";
echo "<br><textarea class=textarea-field name=texteSource  rows=10 cols=80 style='resize: none;' data-role='none'>".$contenu."</textarea>";
echo "<br><br><h4>text in ".$nomLangageDest.":</h4>";
echo "<br><textarea class=textarea-field name=texteDestination rows=10 cols=80>".$textTraduit."</textarea>";

echo "<br><input type=submit  value=Save name=btnsauve class='fancy-button button-line button-white'>";
echo "<input type=submit  value=Edit name=btnModif class='fancy-button button-line button-white'>";
echo "<input type=submit  value=Back name=btnBack class='fancy-button button-line button-white'>";
echo "</form>";
echo "<form  action=sauvegarde.php method=post>";
$_SESSION['tSource']=$contenu;
$_SESSION['tTraduit']=$textTraduit;
echo "<input type=submit  value='Export source' name=btnExport1 class='fancy-button button-line button-white'>";
echo "<input type=submit  value='Export Translation'  name=btnExport2 class='fancy-button button-line button-white' >";

echo "</form></div>	</div></section>";



?>
</body>
