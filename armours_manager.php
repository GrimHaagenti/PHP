<?php

if (!isset($_POST["id_armour_type"])
|| !isset($_POST["armour"])  
|| !isset($_POST["description"])  
|| !isset($_POST["value"])  
|| !isset($_POST["weight"])  
|| !isset($_POST["rarity"])  
|| !isset($_POST["icon"])  
){
	echo"ERROR 1: Formulario no enviado";
	exit;
}


/* ARMOUR CHECK */

$armour = trim($_POST["armour"]);
if(strlen($armour) < 2){
	echo"ERROR 3: Armadura mal formada";
	exit;
}

$armour_quotes = filter_var($armour, FILTER_SANITIZE_ADD_SLASHES);

if($armour != $armour_quotes){
	echo"ERROR 3.1: Armadura mal formada";
}

/* DESC CHECK */

$description = trim($_POST["description"]);
if(strlen($description) < 2){
	echo"ERROR 3: Descripción mal formada";
	exit;
}

$description_quotes = filter_var($description, FILTER_SANITIZE_ADD_SLASHES);

if($description != $description_quotes){
	echo"ERROR 3.1: Descripción mal formada";
}

/* VALUE CHECK */

$value = trim($_POST["value"]);
if(strlen($value) < 1){
	echo"ERROR 4: Coste mal formado";
	exit;
}

$value = floatval($value);

/* WEIGHT CHECK */

$weight = trim($_POST["weight"]);
if(strlen($weight) < 1){
	echo"ERROR 5: Peso mal formado";
	exit;
}

$weight = floatval($weight);

/* RARITY CHECK */

$rarity = trim($_POST["rarity"]);
if(strlen($rarity) < 1){
	echo"ERROR 6: Rareza mal formada";
	exit;
}

$rarity = intval($rarity);

/* ICON CHECK */

$icon = trim($_POST["icon"]);
if(strlen($icon) < 2){
	echo"ERROR 7: Icono mal formado";
	exit;
}

$icon_quotes = filter_var($icon, FILTER_SANITIZE_ADD_SLASHES);


/* ID ARMOUR TYPE CHECK */

$id_armour_type = trim($_POST["id_armour_type"]);
if(strlen($id_armour_type) < 1){
	echo"ERROR 8: ID mal formada";
	exit;
}

$id_armour_type = intval($id_armour_type);


//DB CONNECTION

require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno)
{
	echo "ERROR DB 1: Not connected";
	exit;
}

$query = <<<EOD
INSERT INTO armours (armour, description, value, weight, rarity, icon, id_armour_type)
VALUES("$armour", "$description", "$value", "$weight", "$rarity", "$icon", $id_armour_type);
EOD;


$res = $conn->query($query);

if(!$res){
	echo "ERROR DB 2: Query mal formada";
	exit;
}

header("Location: armours.php");

?>
