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
			  $r=$pdo->query("select t.link,t.dates,l1.nom_langage,l2.nom_langage,e.dates,e.id_edition from translation t,edition e, langage l1,langage l2 where t.id_translation=e.id_translation and t.id_langage_source=l1.id_langage and t.id_langage_destination=l2.id_langage");
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
			  echo "<form>";
	
?>
</table>
					
</form>			
		</div>
	</section>
	

</body>
