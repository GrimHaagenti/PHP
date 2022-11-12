<?php

session_start();

if(intval($_SESSION["id_user"]) != 1)
{
echo "No eres admin";
exit;
}

if (!isset($_POST["id_weapon_type"])
|| !isset($_POST["weapon"])  
|| !isset($_POST["description"])  
|| !isset($_POST["value"])  
|| !isset($_POST["weight"])  
|| !isset($_POST["rarity"])  
|| !isset($_POST["icon"])  
){
	echo"ERROR 1: Formulario no enviado";
	exit;
}


// WEAPON CHECK

$weapon = trim($_POST["weapon"]);
if(strlen($weapon) < 2){
	echo"ERROR 3: Arma mal formada";
	exit;
}

$weapon_quotes = filter_var($weapon, FILTER_SANITIZE_ADD_SLASHES);

if($weapon != $weapon_quotes){
	echo"ERROR 3.1: Arma mal formada";
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

$id_weapon_type = trim($_POST["id_weapon_type"]);
if(strlen($id_weapon_type) < 1){
	echo"ERROR 8: ID mal formada";

	exit;
}

$id_weapon_type = intval($id_weapon_type);


//DB CONNECTION

require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno)
{
	echo "ERROR DB 1: Not connected";
	exit;
}

$query = <<<EOD
INSERT INTO weapons (weapon, description, cost, weight, rarity, icon, id_weapon_type)
VALUES("$weapon", "$description", "$value", "$weight", "$rarity", "$icon", $id_weapon_type);
EOD;


$res = $conn->query($query);

if(!$res){
	echo "ERROR DB 2: Query mal formada";
	exit;
}
else{
header("Location: inventiory.php");
}
?>
