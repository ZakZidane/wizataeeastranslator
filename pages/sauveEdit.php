<head>
 <title>EEAS</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
	<link rel="stylesheet" href="../css/style.css" />
	</head>
<body>
	

<?php
session_start();
include '../pages/connexion.php';

$textsource=$_POST['texteSource'];
$textTraduit=$_POST['texteDestination'];
$_SESSION['texteSource']=$textsource;
$_SESSION['texteTraduit']=$textTraduit;
$langage_destination=$_SESSION['id_langage'];
$codelangageSource=$_SESSION['codelangSource'];
$nomLangageSource=$_SESSION['nomLangageSource'];
$idlangSource=$_SESSION['idlangSource'];
$lien=$_SESSION['lien'];
$codeLangageDest=$_SESSION['code_langage'];
$nomLangageDest=$_SESSION['langage'];
$textsource=preg_replace("/'/", " ",$textsource);
$textTraduit=preg_replace("/'/", " ",$textTraduit);
    $d=date("Y-m-d H:i:s");
    $date_trans=new DateTime($d);
$d=$date_trans->format('Y-m-d H:i:s');
$last_id=$_SESSION['last_id'];
if(isset($_POST['btnBack']))
header("location:../accueil.php" );

$_SESSION['tSource']=$textsource;
$_SESSION['tTraduit']=$textTraduit;
	$req="INSERT INTO edition(dates,source_edited,translation_edited,id_translation) 
VALUES('$d','$textsource','$textTraduit','$last_id')";		
			if($pdo->exec($req))
				 echo "<div class='col-md-10 col-md-offset-1 center section-title'>
					<h4>Edition has been saved successfully!<br></h4></div>";
			 else
			 echo "<div class='col-md-10 col-md-offset-1 center section-title'>
						<h4>Failed saving edition!<br></h4></div>";
echo "<div class='col-md-10 col-md-offset-1 center section-title'>";
echo "<form  action=sauvegardeWord.php method=post>";

echo "<input  type=submit  value='Export to MSWord' name=btnExport1 class='fancy-button button-sub button-white'>";

echo "</form>					
<h4>
<a href=../pages/modification.php>Back to edition display </a></div>" ;
           
 ?>