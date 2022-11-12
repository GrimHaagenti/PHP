<?php

/// ADD ITEM ///


session_start();

if(!isset($_SESSION["id_user"])){
	echo "ERROR 1: Usuario no identificado";
	exit;
}

$id_user = intval($_SESSION["id_user"]);

if($id_user != 1)
{
	echo "No eres Admin. Largo";
	exit;
}



require("template.php");
require_once("db_config.php");

$conn = new mysqli($db_server, $db_user, $db_pass, $db);

if($conn->errno){
	echo "ERROR DB 1: Not connected";
	exit;
}

$query = <<<EOD
SELECT * FROM item_types;
EOD;

$res = $conn->query($query);
if(!$res){
	echo "ERROR DB 2: Error al obtener los datos de tipos";
	exit;
}

$options = "";
while ($opt = $res->fetch_assoc()){
	$options .= <<<EOD
<option value="{$opt["id_item_type"]}">{$opt["type"]}</option>
EOD;
}


print_head("Item Insert");

$item_form = <<<EOD
<form method="POST" action="item_manager.php">
<p><label for="item-types">Tipos:</label>
<select id="item-types" name="id_item_type">
$options
</select>
<a href="item_types.php">Añadir tipo de objeto</a>
</p>
<p><label for="item">Objeto:</label>
<input type="text" id="item" name="item" /></p>
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
<input type="submit" value="Enviar objeto" /></p>
</form>
EOD;

print_body($item_form);

?>
