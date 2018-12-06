<head>
	<title>EEAS</title>
	
	<meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" />
	
</head>
<body>

	<section id="section-subscribe" class="subscribe-wrap">
		
					<div class="col-md-10 col-md-offset-1 center section-title">
						<table align="center"><tr><td><h3>List of the links translated </h3>
				</td><td>
 <form id=subscription-form action=../accueil.php method=post>
<input type=submit  value="Back to home page" name=btnBack class='fancy-button button-sub button-white' >					
</form></td></tr></table>

			<form  action=../pages/listeSearch1.php method=post>
<h4>Enter a date range here</h4>
<input class=titre name=dd  placeholder="From date d/m/Y">
					
<input name=df class="titre" placeholder="To date d/m/Y"><br>
<h4>Or enter a speciic date </h4>
<input name=ds class="titre" placeholder="Date d/m/Y">

<h4>Or enter a web link </h4>
<input name=wl class="titre" placeholder=Link><br>					
<input type=submit  value=search name=btnsearch class='fancy-button button-sub button-white' >					

</form>


	
			 <form id=subscription-form action=../pages/affichage1.php method=post>
			  <table align=center border=3 bgcolor=white>
			  <tr bgcolor=green style='color:white'><th>Link</th><th>Translation date</th><th>Source language</th>
<th>Translation language</th><th>Visualiser</th></tr>

	
<?php
session_start();

include '../pages/connexion.php';
$req="select t.link,t.dates,l1.nom_langage,l2.nom_langage,t.id_translation from translation t, langage l1,langage l2 where  t.id_langage_source=l1.id_langage and t.id_langage_destination=l2.id_langage 
order by t.id_translation desc";		  

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

echo "<td>$texte</td><td>$date_tr</td><td>$row[2]</td><td>$row[3]</td><td ><input class=loupe value='   ' type=submit name=bouton".$row[4]."></td></tr>";
		
	$i++;
			  }
			  
	
?>
</table>
</form>
		
		</div>
	</section>
	

</body>
