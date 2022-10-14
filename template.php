<?php


function print_head ($subtitle = "" ){


$title = "invENTIory";

	if($subtitle != "") $title .= ": ". $subtitle;


echo <<<EOD

<!DOCTYPE html>
<html>
<head>

	<title>$title </title>
	


</head>

EOD;

}




function print_body($content){
	
echo <<<EOD



<body>


$content

</body>
</html>


EOD;

}





?>
