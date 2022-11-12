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

require_once("template.php");
require_once("bank_func.php");

$balance = get_balance($conn, $id_user);

print_head("Shop");

$content = <<<EOD
<header><h1>Tienda</h1></header>
<body>
<p><strong>Balance: $balance €</strong></p>
<p><a href="inventiory.php">Volver al inventario</a></p>
<article>
EOD;

$armaduras = "<div><h2>Armaduras</h2>";

$query = <<<EOD
SELECT * FROM armours;
EOD;

$res = $conn->query($query);

while($armour = $res->fetch_assoc()){
	$armaduras .= <<<EOD
<form method="POST" action="shop_armour_manager.php">
<input type="hidden" name="id_armour" value="{$armour["id_armour"]}" />
<h3>{$armour["armour"]}</h3>
<p><strong>{$armour["cost"]} €</strong></p>
<p><input type="submit" value="+" /></p>
</form>
EOD;
}
$armaduras.= "</div>";
$armas = "<div><h2>Armas</h2>";


$query = <<<EOD
SELECT * FROM weapons;
EOD;

$res = $conn->query($query);

while($weapon = $res->fetch_assoc()){
	$armas .= <<<EOD
<form method="POST" action="shop_weapon_manager.php">
<input type="hidden" name="id_weapon" value="{$weapon["id_weapon"]}" />
<h3>{$weapon["weapon"]}</h3>
<p><strong>{$weapon["cost"]} €</strong></p>
<p><input type="submit" value="+" /></p>
</form>
EOD;
}
$armas .= "</div>";

$objetos = "<div><h2>Objetos</h2>";

$query = <<<EOD
SELECT * FROM items;
EOD;

$res = $conn->query($query);

while($item = $res->fetch_assoc()){
	$objetos .= <<<EOD
<form method="POST" action="shop_item_manager.php">
<input type="hidden" name="id_item" value="{$item["id_item"]}" />
<h3>{$item["item"]}</h3>
<p><strong>{$item["cost"]} €</strong></p>
<p><input type="submit" value="+" /></p>
</form>
EOD;
}

$objetos .= "</div>";
$content .= $armaduras . $armas. $objetos. "</body>";


print_body($content);

?>
