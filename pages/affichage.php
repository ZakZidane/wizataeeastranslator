<head>
 <title>EEAS</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" href="../css/style.css" />
	</head>
<body>
<?php
session_start();


include '../pages/connexion.php';
$r=$pdo->query("select id_edition from edition");
			  
			  
			  while($row=$r->fetch())
	{$v="bouton".$row[0];

			  if(isset($_POST[$v]))
			  $id_edition=$row[0];
			  
	}
if(isset($_POST['btnBack']))
header("location:../accueil.php" );
$req="select t.link,t.original,t.translation,
t.dates,l1.nom_langage,l2.nom_langage,
e.dates,e.id_edition,e.source_edited,e.translation_edited 
from translation t,edition e, langage l1,langage l2 
  where t.id_translation=e.id_translation 
  and t.id_langage_source=l1.id_langage 
  and t.id_langage_destination=l2.id_langage
  and e.id_edition='".$id_edition."'";
  $r=$pdo->query($req);
		if($row=$r->fetch())
		{$link=	$row[0];
	$original=	$row[1];
	$translation=$row[2];
	$dateTranslation=$row[3];
$nomLangageSource=$row[4];
$nomLangageDest=$row[5];
$dateEdited=$row[6];
$source_edited=$row[8];
$translation_edited =$row[9];
echo "<form id=subscription-form  method=post>";
		
echo "<br><center><h4 class=titre> Hypertext link ".$link." <br>Translation date:".$dateTranslation." </h4> </center>";
	
echo "<table align=center><tr><td class=titre>Oiginal text in ".$nomLangageSource."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td class=titre>Translated text in ".$nomLangageDest."</td></tr>";
echo "<tr><td><textarea class=textarea-field name=texteSource  rows=10 cols=60 style='resize: none;' data-role='none'>".$original."</textarea></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
echo "<textarea class=textarea-field name=texteDestination rows=10 cols=60>".$translation."</textarea></td></tr>";

echo "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr><tr><td class=titre> Edition date:".$dateEdited." </td><td></td><td></td></tr>";
	 
echo "<tr><td class=titre>Edited text source in ".$nomLangageSource."</td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td class=titre>Edited translated text in  ".$nomLangageDest."</td></tr>";

echo "<tr><td><textarea class=textarea-field name=texteSource  rows=10 cols=60 style='resize: none;' data-role='none'>".$source_edited."</textarea></td><td>&nbsp;&nbsp;&nbsp;&nbsp;</td><td>";
echo "<textarea class=textarea-field name=texteDestination rows=10 cols=60>".$translation_edited."</textarea></td></tr></table>";

echo "<center><input type=submit  value=Back name=btnBack class='fancy-button button-sub button-white' ></center>";

}
?>
</body>
