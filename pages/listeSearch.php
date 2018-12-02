<head>
	<title>EEAS</title>
	
	<meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" />
	
</head>
<body>

	<section id="section-subscribe" class="subscribe-wrap">
		
					<div class="col-md-10 col-md-offset-1 center section-title">
						<br><h3>List of the links translated and edited</h3>
			 <form id=subscription-form action=../pages/affichage.php method=post>
			  <table align=center border=3 bgcolor=white>
			  <tr bgcolor=green style='color:white'><th>Link</th><th>Translation date</th><th>Source language</th>
<th>Translation language</th><th>Edition date</th><th>Visualiser</th></tr>

	
<?php
session_start();

include '../pages/connexion.php';
//if(isset($_POST['btnsearch']))
if(!empty($_POST['dd']))
{
$date_deb=explode("/",$_POST['dd']);
$date_d=$date_deb[2]."-".$date_deb[1]."-".$date_deb[0];	

$date_fin=explode("/",$_POST['df']);
$date_f=$date_fin[2]."-".$date_fin[1]."-".$date_fin[0];	
$req="select t.link,t.dates,l1.nom_langage,l2.nom_langage,e.dates,e.id_edition from translation t,edition e, langage l1,langage l2 where t.id_translation=e.id_translation and t.id_langage_source=l1.id_langage and t.id_langage_destination=l2.id_langage and e.dates between '".$date_d."' and '".$date_f."'";
}
else if(!empty($_POST['ds']))
{$date_spec=explode("/",$_POST['ds']);
$date_s=$date_spec[2]."-".$date_spec[1]."-".$date_spec[0];	
	 
	$req="select t.link,t.dates,l1.nom_langage,l2.nom_langage,e.dates,e.id_edition from translation t,edition e, langage l1,langage l2 where t.id_translation=e.id_translation and t.id_langage_source=l1.id_langage and t.id_langage_destination=l2.id_langage and e.dates='".$date_s."'";
	}
else if(!empty($_POST['wl']))
			  
	$req="select t.link,t.dates,l1.nom_langage,l2.nom_langage,e.dates,e.id_edition from translation t,edition e, langage l1,langage l2 where t.id_translation=e.id_translation and t.id_langage_source=l1.id_langage and t.id_langage_destination=l2.id_langage and t.link='".$_POST['wl']."'";		  

else
$req="select t.link,t.dates,l1.nom_langage,l2.nom_langage,e.dates,e.id_edition from translation t,edition e, langage l1,langage l2 where t.id_translation=e.id_translation and t.id_langage_source=l1.id_langage and t.id_langage_destination=l2.id_langage ";		  

$r=$pdo->query($req);
			  $i=1;
			  
	while($row=$r->fetch())	
			  {if($i%2)
echo "<tr bgcolor=cyan style='color:black'>";
else
echo "<tr bgcolor=gray style='color:white'>";	
$texte=$row[0];
$max_caracteres=25;
// Test si la longueur du texte dépasse la limite
if (strlen($texte)>$max_caracteres){   
 // Séléction du maximum de caractères
$texte = substr($texte, 0, $max_caracteres);    
}
$date_trans=new DateTime($row[1]);
$date_tr=$date_trans->format('d/m/Y');
$date_edit=new DateTime($row[4]);
$date_ed=$date_edit->format('d/m/Y');
echo "<td>$texte</td><td>$date_tr</td><td>$row[2]</td><td>$row[3]</td><td>$date_ed</td><td ><input class=loupe value='   'type=submit name=bouton".$row[5]."></td></tr>";
		
	$i++;
			  }
			  
	
?>
</table>
</form>



 <form id=subscription-form action=../accueil.php method=post>
<input type=submit size=30 value=Back name=btnBack class='fancy-button button-line button-white' >					
</form>			
		</div>
	</section>
	

</body>
