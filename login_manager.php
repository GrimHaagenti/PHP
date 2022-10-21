<?php


if (!isset($_POST["user"]) || 
	!isset($_POST["passwd"]) 
	)
	{
	echo "ERROR 1: Formulario no enviado";
	exit;
	
	}



$user = trim($_POST["user"]);

	if (strlen($user) < 4 )
	{
		echo "ERROR 2: Nombre de usuario mal formado";
		exit;
	}

$user_quotes = filter_var($user, FILTER_SANITIZE_ADD_SLASHES);

	if($user != $user_quotes){
	die("ERROR 2.1: Funny guy, r u ? >:(");

	}



$password = trim($_POST["passwd"]);

	if (strlen($password) < 6 )
	{
		echo "ERROR 3: Password mal formado";
		exit;
	}

$pass_nums = filter_var($_POST["passwd"], FILTER_SANITIZE_NUMBER_INT);

	if (strlen($pass_nums) == 0){
		echo "ERROR 3.1: Password mal formado, necesita al menos un número";
		exit;

	}
	
	if (strlen($pass_nums) == strlen($_POST["passwd"]) ){
		echo "ERROR 3.2: Password mal formado, necesita al menos un caracter";
		exit;

	}
$pass_quotes = filter_var($password, FILTER_SANITIZE_ADD_SLASHES);

	if($password != $pass_quotes){
	die("ERROR 3.3: Password mal formado");

	}

$password = md5($password);
	require_once("db_config.php");
	$conn = new mysqli($db_server, $db_user, $db_pass, $db);


		if ($conn->connect_errno){
			echo 'ERROR al conectarse';
			exit;
			}




$query = <<< EOD

	SELECT id_user FROM users WHERE username="$user" AND password="$password"
	EOD;



$res = $conn->query($query);

if (!$res){
echo "Error DB2 : query mal formada";
exit;
}

 if($res->num_rows != 1){
 echo "Login incorrecto";
 exit;
 }

$user = $res->fetch_assoc();

session_start();

$_SESSION["id_user"]= $user["id_user"];

?>

