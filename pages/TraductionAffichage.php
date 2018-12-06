<head>
 <title>EEAS</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
	<link rel="stylesheet" href="../css/style.css" />
	</head>
<body>
<?php
session_start();
$textsource=$_SESSION['texteSource'];
$textTraduit=$_SESSION['texteTraduit'];			
$langage_destination=$_SESSION['id_langage'];
$codelangageSource=$_SESSION['codelangSource'];
$nomLangageSource=$_SESSION['nomLangageSource'];
$idlangSource=$_SESSION['idlangSource'];
$lien=$_SESSION['lien'];
$codeLangageDest=$_SESSION['code_langage'];
$nomLangageDest=$_SESSION['langage'];
include '../pages/connexion.php';
if(isset($_POST['btnBack']))
header("location:../accueil.php" );

if(isset($_POST['btnsauve']))
header("location:../pages/sauvegarde.php" );

if(isset($_POST['btnModif']))
	header("location:../pages/modification.php" );
 echo "<section id=section-subscribe class=subscribe-wrap>
<div class='col-md-10 col-md-offset-1 center section-title'>";
echo "<br><h4>text in ".$nomLangageSource.":</h4>";
echo "<form id=subscription-form  method=post>";
echo "<br><textarea readonly class=textarea-field name=texteSource  rows=10 cols=80 style='resize: none;' data-role='none'>".$textsource."</textarea>";
echo "<br><br><h4>text in ".$nomLangageDest.":</h4>";
echo "<br><textarea readonly class=textarea-field name=texteDestination rows=10 cols=80>".$textTraduit."</textarea>";
$_SESSION['tSource']=$textsource;
$_SESSION['tTraduit']=$textTraduit;
echo "<br><input type=submit  value=Save name=btnsauve class='fancy-button button-sub button-white'>";
echo "<input type=submit  value=Edit name=btnModif class='fancy-button button-sub button-white'>";
echo "<input type=submit  value=Back name=btnBack class='fancy-button button-sub button-white'>";
echo "</form>";
echo "<form  action=sauvegardeWord.php method=post>";

echo "<input type=submit  value='Export to MSWord' name=btnExport1 class='fancy-button button-sub button-white'>";


echo "</form></div>	</section>";



?>
</body>