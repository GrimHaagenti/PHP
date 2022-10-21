<?php

require_once("db_config.php");
	$conn = new mysqli($db_server, $db_user, $db_pass, $db);

	if ($conn->connect_errno){
	echo 'ERROR al conectarse';
	exit;
	}



$query = <<<EOD
	SELECT * FROM users;
	EOD;

$res = $conn->query($query);
if(!$res){
	echo "Error al obtener los usuarios";
	exit;
}

echo <<<EOD
<table>
<tr><th>Nombre</th><th>Usuario</th><th>Email</th></tr>
EOD;



while ($user = $res->fetch_assoc()){

echo <<<EOD
<tr><td>{$user["nombre"]}</td><td>{$user["username"]}</td><td>{$user["email"]}</td></tr>
EOD;
}

echo "</table>";

?>


