<head>
	<title>EEAS</title>
	
	<meta charset="utf-8">
    <link rel="stylesheet" href="css/style.css" />
	
</head>
<body>

	<section id="section-subscribe" class="subscribe-wrap">
		
					<div class="col-md-10 col-md-offset-1 center section-title">
						<h3>Insert the translation link</h3>
				<form id="subscription-form" action=pages/traitement.php method=post>
					
	                    <input  name="link"  class="input-email" placeholder="Insert the translation link"/>
						
												
					<h3>Or Insert the text to translate</h3><br>
					<textarea class=textarea-field name=texteSource  rows=10 cols=80 style='resize: none;' data-role='none' placeholder="Insert the text to translate"></textarea>
					<br>

					<span class=titre>Select the translation language default is english</span>
					<table align="center">
						<tr><td>
							<input type="submit"  value="Translate text" name="btntext" class="fancy-button button-sub button-white large zoom">
						
						</td>
						<td>

					<select class=carac name=lang size=5>
						<?php
						include 'pages/connexion.php';
									  $r=$pdo->query("select * from langage ");
									 
									  while($row=$r->fetch())		  
						{if($row['code']=="en")
							echo "<option value=".$row['id_langage'].",".$row['code'].",".$row['nom_langage']." selected>".$row['nom_langage']."</option>";
							else
					     echo "<option value=".$row['id_langage'].",".$row['code'].",".$row['nom_langage'].">".$row['nom_langage']."</option>";}


						?>
					</select>

					
						</td>
						<td>
						<input type="submit"  value="Translate the web page"  name="btnlink" class="fancy-button button-sub button-white large zoom">
					</td>
				    </tr>
						
					<tr>
				    
					<td style="padding-left:120px" colspan=3>				
				</form>
				<form " action=pages/liste.php method=post>
		
					<input  type="submit"  value="List of links translated" name="btnlist" class="fancy-button button-sub button-white large zoom">
						
				</form>
				</td>
				
				    </tr>
				</table>
			</div>
		</div>
	</section>
	<!--=== Subscribe section Ends ===-->
	
</body>
