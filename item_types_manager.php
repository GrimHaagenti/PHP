<?php

/// ADD ITEM TYPES MANAGER ///

session_start();

if(intval($_SESSION["id_user"]) != 1){
echo "No eres Admin";
exit;

}


if (!isset($_POST["type"])
|| !isset($_POST["icon"])
){
	echo "Error 1: Formulario no enviadito";
	exit;
}


// ITEM TYPE CHECK 

$type = trim($_POST["type"]);
if(strlen($type) < 4){
	echo"ERROR 3: Item Type mal formado";
	exit;
}

$icon = trim($_POST["icon"]);
if(strlen($icon) < 4){
	echo"ERROR 3: Icon filename mal formado";
	exit;
}

require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno)
{
	echo "ERROR DB 1: Not connected";
	exit;
}

$query = <<<EOD
INSERT INTO item_types (type, icon)
VALUES ("$type", "$icon");
EOD;


$res = $conn->query($query);

if(!$res){
	echo "ERROR DB 2: Query mal formada";
	exit;
}
else
{
header("Location: inventiory.php");
}
?>
