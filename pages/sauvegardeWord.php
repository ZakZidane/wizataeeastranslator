<head>
 <title>EEAS</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
	
	</head>
<body>
<?php 
session_start();
$textSource=$_SESSION['tSource'];
$textTraduit=$_SESSION['tTraduit'];
if(isset($_POST['btnExport1']))
{
$f="translation of ".date("d-m-Y")." at ".date("H:i:s").".doc";
header("Content-Type: application/vnd.ms-word");
header("content-disposition: attachment;filename=$f");
echo "<p>Original text:";
echo "</p><p>";
echo "--------------";
echo "</p><p>";
echo $textSource;
echo "</p><p>";
echo "Translated text:";
echo "</p><p>";
echo "---------------\r\n";
echo "</p><p>";
echo $textTraduit;
echo "</p>";


}
				
?>
</body>