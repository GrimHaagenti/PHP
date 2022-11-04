<?php


session_start();

if(!isset($_SESSION["id_user"])){
	echo "ERROR 1: Usuario no identificado";
	exit;
}

$id_user = intval($_SESSION["id_user"]);




require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno){
	echo "ERROR DB 1: Not connected";
	exit;
}

$query = <<<EOD
SELECT * FROM armour_types;
EOD;

$res = $conn->query($query);
if(!$res){
	echo "ERROR DB 2: Error al obtener los datos de tipos";
	exit;
}

$options = "";
while ($opt = $res->fetch_assoc()){
	$options .= <<<EOD
<option value="{$opt["id_armour_type"]}">{$opt["type"]}</option>
EOD;
}

echo <<<EOD
<form method="POST" action="armours_manager.php">
<p><label for="armour-types">Tipos:</label>
<select id="armour-types" name="id_armour_type">
$options
</select>
<a href="armour_types.php">Añadir tipo de armadura</a>
</p>
<p><label for="armour">Armadura:</label>
<input type="text" id="armour" name="armour" /></p>
<p><label for="description">Descripción:</label>
<input type="text" id="description" name="description" /></p>
<p><label for="value">Coste:</label>
<input type="text" id="value" name="value" /></p>
<p><label for="weight">Peso:</label>
<input type="text" id="weight" name="weight" /></p>
<p><label for="rarity">Rareza:</label>
<input type="text" id="rarity" name="rarity" /></p>
<p><label for="icon">Icono:</label>
<input type="text" id="icon" name="icon" /></p>
<input type="submit" value="Enviar armadura" /></p>
</form>
EOD;
?>
