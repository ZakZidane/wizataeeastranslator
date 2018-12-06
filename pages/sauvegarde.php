<head>
 <title>EEAS</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
	<link rel="stylesheet" href="../css/style.css" />
	</head>
<body>
	

<?php
session_start();
include '../pages/connexion.php';
$textsource=$_SESSION['texteSource'];
$textTraduit=$_SESSION['texteTraduit'];	
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

$req="INSERT INTO translation(link,dates,original,translation,id_langage_Source,id_langage_destination) 
VALUES('$lien','$d','$textsource','$textTraduit','$idlangSource','$langage_destination')"; 
if($pdo->exec($req))

			{	 echo "<div class='col-md-10 col-md-offset-1 center section-title'>
						<h4>Record has been saved successfully!<br></h4></div>";
			$_SESSION['last_id'] = $pdo->lastInsertId();

		}
			 else
				  echo "<div class='col-md-10 col-md-offset-1 center section-title'>
						<h4>Failed saving record!<br></h4></div>";     

echo "<div class='col-md-10 col-md-offset-1 center section-title'>
<a href=../pages/TraductionAffichage.php>Back to translation display </a></div>" ;             
        
              
 ?>