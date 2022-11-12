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

if($balance == false){
	$balance = "NO HAY CUENTA BANCARIA";
}

$nameQuery = <<<EOD
SELECT * FROM users WHERE id_user=$id_user;
EOD;

$res = $conn->query($nameQuery);

$userObj = $res->fetch_assoc();



$navPanel="";

if ($id_user != 1)
{
$navPanel= <<<EOD
	<ul>
		<li><a href="shop.php">Shop</a></li>
	</ul>
EOD;
}
else{
$navPanel= <<<EOD
	<ul>
		<li><a href="armour_types.php" > Add Armour Type</a></li>
		<li><a href="armours.php" > Add Armour</a></li>
		<li><a href="weapon_types.php" > Add Weapon Type</a></li>
		<li><a href="weapons.php"> Add Weapon</a></li>
		<li><a href="item_types.php" > Add Item Type</a></li>
		<li><a href="item.php" > Add Item</a></li>
		<li><a href="shop.php">Shop</a></li>
	</ul>
	EOD;
}
$birthdate = date("d/m/Y", strtotime($userObj["birthdate"]));

$content = <<<EOD
<header>
	<h1> Inventiory </h1>
</header>
<nav>
$navPanel
</nav>

<h1>Bienvenido/a, {$userObj["username"]} </h1>
<p><ul>
		<li>Nombre: {$userObj["name"]}</li>
		<li>Fecha de nacimiento: $birthdate </li>
		<li>Tienes: $balance €</li>
</ul></p>
<p><a href="logout.php">Logout</a></p>
<article>
EOD;

$userArmorContent = "<div><h2>Tus armaduras</h2><ul>";



$userArmorsQuery = <<<EOD
SELECT * 
FROM armours_users 
LEFT JOIN armours ON armours.id_armour=armours_users.id_armour 
WHERE armours_users.id_user=$id_user;
EOD;

$res = $conn->query($userArmorsQuery);


if($res->num_rows < 1){
$userArmorContent .= "<h3>No tienes armaduras<h3>";
}
else{

while ($userArmors = $res->fetch_assoc()){
	$userArmorContent .= <<<EOD
	<li>
	{$userArmors["armour"]}
	</li>
	EOD;
	}
}
$userArmorContent .= "</ul></div>";
$content .= $userArmorContent;


$userWeaponContent .= "<div><h2>Tus armas</h2><ul>";

$userWeaponQuery = <<<EOD
SELECT *
FROM weapons_users
LEFT JOIN weapons ON weapons.id_weapon=weapons_users.id_weapon
WHERE weapons_users.id_user=$id_user;
EOD;

$res = $conn->query($userWeaponQuery);
if($res->num_rows < 1){
$userWeaponContent .= "<h3>No tienes armas</h3>";
}
else{
while ($userWeapon = $res->fetch_assoc()){
	$userWeaponContent .= <<<EOD
	<li>
	{$userWeapon["weapon"]}
	</li>
	EOD;
	}
}
$userWeaponContent .= "</ul></div>";
$content .= $userWeaponContent;


$userItemContent .= "<div><h2>Tus objetos</h2><ul>";

$userItemsQuery = <<<EOD
SELECT *
FROM inventory_items
LEFT JOIN items ON items.id_item=inventory_items.id_item
WHERE inventory_items.id_user=$id_user;
EOD;

$res = $conn->query($userItemsQuery);
if($res->num_rows < 1){
$userItemContent .= "<h3>No tienes objectos</h3>";
}
else{
while ($userItems = $res->fetch_assoc()){
	$userItemContent .= <<<EOD
	<li>
	{$userItems["item"]}
	</li>
	EOD;
	}
}
$userItemContent .= "</ul></div></article>";
$content .= $userItemContent;




print_body($content);



?>
