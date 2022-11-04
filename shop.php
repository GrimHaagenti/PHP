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

print_head("Shop");


$content = "<h2>Armaduras</h2>";

require_once("bank_func.php");

$balance = get_balance($conn, $id_user);

$content .= "<p><strong>Balance: ".$balance." €</strong></p>";

$query = <<<EOD
SELECT * FROM armours;
EOD;

$res = $conn->query($query);

while($armour = $res->fetch_assoc()){
	$content .= <<<EOD
<form method="POST" action="shop_armour_manager.php">
<input type="hidden" name="id_armour" value="{$armour["id_armour"]}" />
<h3>{$armour["armour"]}</h3>
<p><strong>{$armour["value"]} €</strong></p>
<p><input type="submit" value="+" /></p>
</form>
EOD;
}

print_body($content);

?>
