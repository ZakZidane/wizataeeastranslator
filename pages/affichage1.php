<head>
 <title>EEAS</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="../css/style.css" />
	</head>
<body>
<?php
session_start();


include '../pages/connexion.php';
$r=$pdo->query("select id_translation from translation");
			  
			  
			  while($row=$r->fetch())
	{$v="bouton".$row[0];
         
			  if(isset($_POST[$v]))
			  $id_trans=$row[0];
			  
	}
if(isset($_POST['btnBack']))
header("location:../accueil.php" );
echo $id_trans;
$req="select t.link,t.original,t.translation,
t.dates,l1.nom_langage,l2.nom_langage 
from translation t, langage l1,langage l2 
  where  t.id_langage_source=l1.id_langage 
  and t.id_langage_destination=l2.id_langage
  and t.id_translation='".$id_trans."'";
  $r=$pdo->query($req);
		if($row=$r->fetch())
		{$link=	$row[0];
	$original=	$row[1];
	$translation=$row[2];
	$dateTranslation=$row[3];
$nomLangageSource=$row[4];
$nomLangageDest=$row[5];

echo "<form id=subscription-form  method=post>";
		
echo "<br><center><h4 class=titre> Hypertext link ".$link." <br>Translation date:".$dateTranslation." </h4> </center>";
	
echo "<table align=center><tr><td class=titre>Oiginal text in ".$nomLangageSource."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td class=titre>Translated text in ".$nomLangageDest."</td></tr>";
echo "<tr><td><textarea class=textarea-field name=texteSource  rows=10 cols=60 style='resize: none;' data-role='none'>".$original."</textarea></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
echo "<textarea class=textarea-field name=texteDestination rows=10 cols=60>".$translation."</textarea></td></tr></table>";

echo "<center><input type=submit  value=Back name=btnBack class='fancy-button button-sub button-white' ></center>";

}
?>
</body>