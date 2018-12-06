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
$last_id=$_SESSION['last_id'];
if(isset($_POST['btnBack']))
header("location:../accueil.php" );


if($last_id!=$_SESSION['Last_Record'])
		{
			$req="INSERT INTO translation(link,dates,original,translation,id_langage_Source,id_langage_destination) 
VALUES('$lien','$d','$textsource','$textTraduit','$idlangSource','$langage_destination')"; 
if($pdo->exec($req))
	 
			$_SESSION['last_id']= $pdo->lastInsertId();
				
			
			 else
				{  
					echo "<div class='col-md-10 col-md-offset-1 center section-title'>
						<h4>Failed saving record!<br></h4></div>";     
header("Refresh: 3; url=../pages/TraductionAffichage.php");}

}
    
        
        
 

 echo "<section id=section-subscribe class=subscribe-wrap>
<div class='col-md-10 col-md-offset-1 center section-title'>";
echo "<br><h4>text in ".$nomLangageSource.":</h4>";
echo "<form id=subscription-form action=sauveEdit.php method=post>";
echo "<br><textarea  class=textarea-field name=texteSource  rows=10 cols=80 style='resize: none;' data-role='none'>".$textsource."</textarea>";
echo "<br><br><h4>text in ".$nomLangageDest.":</h4>";
echo "<br><textarea  class=textarea-field name=texteDestination rows=10 cols=80>".$textTraduit."</textarea>";

echo "<br><input type=submit  value='Save Edition' name=btnsauveEdit class='fancy-button button-sub button-white'>";
echo "</form>";
echo "<form id=subscription-form  method=post>";
echo "<input type=submit  value=Back name=btnBack class='fancy-button button-sub button-white'>";
echo "</form>
</div>	</section>";             
 ?>