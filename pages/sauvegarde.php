<head>
 <title>EEAS</title>
	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
	
	</head>
<body>
<?php 
session_start();
if(isset($_POST['btnExport1']))
{
$f="SourceFile.doc";
header("Content-Type: application/vnd.ms-word");
header("content-disposition: attachment;filename=$f");
echo $_SESSION['tSource'];

}
if(isset($_POST['btnExport2']))
{

$f="translatedFile.doc";
header("Content-Type: application/vnd.ms-word");
header("content-disposition: attachment;filename=$f");

echo $_SESSION['tTraduit'];

}
				
?>
</body>