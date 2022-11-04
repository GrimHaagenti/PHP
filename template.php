<?php

function print_head ($subtitle = "" ){


$title = "invENTIory";

	if($subtitle != "") 
	$title .= ": ". $subtitle;


echo <<<EOD

<!DOCTYPE html>
<html>
<head>

	<title>$title </title>

</head>

EOD;

}

function get_menu(){
	$login = "<li><a href=\"index.php\">Login</a></li>";
	if(!isset($_SESSION["id_user"])){
		$login = "<li><a href=\"logout.php\">Logout</a></li>";
	}
	return <<<EOD
<ul>
	<li><a href="inventiory.php">Portada</a></li>
	<li><a href="shop.php">Tienda</a></li>
	$login
</ul>
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
