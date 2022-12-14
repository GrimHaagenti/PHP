<?php

/// SHOP ARMOUR MANAGER ///

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

if (!isset($_POST["id_armour"])){
	echo "ERROR 2: Formulario no recibido";
	exit;
}

$id_armour = intval($_POST["id_armour"]);

$query = <<<EOD
SELECT cost 
FROM armours
WHERE id_armour=$id_armour;
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 3: Query mal formada";
	exit;
}

if($res->num_rows != 1){
	echo"ERROR 4: Armadura inexistente";
	exit;
}
//Guardamos info de la armadura
$armour = $res->fetch_assoc();



$query = <<<EOD
SELECT balance 
FROM bank_accounts
WHERE id_user=$id_user;
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 5: Query mal formada";
	exit;
}

if($res->num_rows != 1){
	echo"ERROR 6: Cuenta inexistente";
	exit;
}
//Cuenta del usuario activo
$userAcc = $res->fetch_assoc();


//require_once(bank_func.php);
$balance = $userAcc["balance"];

if($balance < $armour["cost"]){
	echo"Balance insuficiente";
	exit;
}

$balance = $balance - $armour["cost"];

$query = <<<EOD
UPDATE bank_accounts
SET balance=$balance
WHERE id_user=$id_user;
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 7: Query mal formada";
	exit;
}

//Insertamos obj

$query = <<<EOD
INSERT INTO armours_users(id_armour, id_user, purchased)
VALUES($id_armour, $id_user, now());
EOD;

$res = $conn->query($query);

if(!$res){
	echo"ERROR 8: Query mal formada";
	exit;
}

header("Location: shop.php");

?>
