<head>
	<title>EEAS</title>
	
	<meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" />
	
</head>
<body>

	<section id="section-subscribe" class="subscribe-wrap">
		
					<div class="col-md-10 col-md-offset-1 center section-title">
						<table align="center"><tr><td><h3>List of edited translations</h3></td><td>
						<form id=subscription-form action=../accueil.php method=post>
<input type=submit  value="Back to home page" name=btnBack class='fancy-button button-sub button-white' >					
</form></td></tr></table>
						<form  action=../pages/listeSearch.php method=post>
<h4>Please enter a date range here</h4>
<input class=titre name=dd  placeholder="From date d/m/y">
					
<input name=df class="titre" placeholder="To date d/m/y"><br>
<h4>Or enter a specific date </h4>
<input name=ds class="titre" placeholder="Date d/m/y">

<h4>Or enter a web link </h4>
<input name=wl class="titre" placeholder=Link><br>					
<input type=submit  value=search name=btnsearch class='fancy-button button-sub button-white' >					

</form>

 
			 <form id=subscription-form action=../pages/affichage.php method=post>
			  <table align=center border=3 bgcolor=white>
			  <tr bgcolor=green style='color:white'><th>Link</th><th>Translation date</th><th>Source language</th>
<th>Translation language</th><th>Edition date</th><th>Visualiser</th></tr>

	
<?php
session_start();

include '../pages/connexion.php';
$req="select t.link,t.dates,l1.nom_langage,l2.nom_langage,e.dates,e.id_edition from translation t,edition e, langage l1,langage l2 where t.id_translation=e.id_translation and t.id_langage_source=l1.id_langage and t.id_langage_destination=l2.id_langage order by e.id_translation desc";		  

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
			
		</div>
	</section>
	

</body>
