<?php


session_start();

if(!isset($_SESSION["id_user"])){
	echo "ERROR 1: Usuario no identificado";
	exit;
}

$id_user = intval($_SESSION["id_user"]);




require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno)
{
	echo "ERROR DB 1: Not connected";
	exit;
}



require_once("template.php");

print_head("Portada");


require_once("bank_func.php");

$balance = get_balance($conn, $id_user);

if($balance === false){
	$balance = "NO HAY CUENTA BANCARIA";
}

$content = <<<EOD
<h1>Bienvenido/a</h1>
<p>Tienes: $balance</p>
EOD;

print_body($content);

$query = <<<EOD
SELECT *
FROM inventory_armours
LEFT JOIN armours ON armours.id_armour=inventory_armours.id_armour
WHERE inventory_armours.id_user=$id_user;
EOD;

$content .= $query;

print_body($content);

?>
