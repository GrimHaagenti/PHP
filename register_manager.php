<?php


if (!isset($_POST["fullName"]) || 
	!isset($_POST["user"]) || 
	!isset($_POST["passwd"]) ||  
	!isset($_POST["rePasswd"]) || 
	!isset($_POST["birthdate"])||
	!isset($_POST["email"]) )
	{
	echo "ERROR 1: Formulario no enviado";
	exit;
	
	}

$name = trim($_POST["fullName"]);

	if (strlen($name) < 2 )
	{
		echo "ERROR 2: Nombre mal formado";
		exit;
	}



$user = trim($_POST["user"]);

	if (strlen($user) < 4 )
	{
		echo "ERROR 3: Nombre de usuario mal formado";
		exit;
	}

$user_quotes = filter_var($user, FILTER_SANITIZE_ADD_SLASHES);
	if($user != $user_quotes){
	echo "Error 3:     >:(( ";
	exit;
	}

$password = trim($_POST["passwd"]);

	if (strlen($password) < 6 )
	{
		echo "ERROR 4: Password mal formado";
		exit;
	}



	$pass_nums = filter_var($_POST["passwd"], FILTER_SANITIZE_NUMBER_INT);

	if (strlen($pass_nums) == 0){
		echo "ERROR 4.1: Password mal formado, necesita al menos un número";
		exit;

	}
	
	if (strlen($pass_nums) == strlen($_POST["passwd"]) ){
		echo "ERROR 4.2: Password mal formado, necesita al menos un caracter";
		exit;

	}
	
	if ( $_POST["rePasswd"] != $_POST["passwd"] )
	{
		echo "ERROR 5: Password mismatch";
		exit;
	}

$pass_quotes = filter_var($password, FILTER_SANITIZE_ADD_SLASHES);
	if($password != $pass_quotes){
	echo "Error 3:     >:(( ";
exit;
	}



$bdate = trim($_POST["birthdate"]);

	if (strlen($bdate) != 10 )
	{
		echo "ERROR 6: Fecha no válida";
		exit;
	}


$birthdate = explode("-", $_POST["birthdate"] );

	if (count($birthdate) != 3){ echo "ERROR 6.1: Fecha mal formada"; }

	
	if (strlen($birthdate[0]) != 4 || strlen($birthdate[1]) != 2 || strlen($birthdate[2]) != 2)
	{
		echo "ERROR 6.2: Fecha mal formado";
		exit;

	}

	if (strval($birthdate[0]) >  getdate()["year"] - 18 ){ 
				echo "ERROR 6.3: Eres menor de edad"; exit;}
	
	$bdate_quotes = filter_var($bdate, FILTER_SANITIZE_ADD_SLASHES);
	if($bdate != $bdate_quotes){
	echo "Error 3:     >:(( ";
		exit;
	}

	

$email = trim ($_POST["email"]);

	if (strlen($email) < 6){
	echo "Error 7";
	exit;
	}

	$email_validate = filter_var($email, FILTER_VALIDATE_EMAIL);

$password = md5($password);
	
	require_once("db_config.php");
	$conn = new mysqli($db_server, $db_user, $db_pass, $db);

	if ($conn->connect_errno){
	echo 'ERROR al conectarse';

	exit;
	}

$query = <<<EOD

			SELECT id_user FROM users WHERE username="$user";
			EOD;

$res = $conn->query($query);

if(!$res){ 
echo "Error al conectarse al servidor"; 
exit;
}


if ($res->num_rows >= 1){echo "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAnop"; exit;} 

$query = <<<EOD

	INSERT INTO users(username, nombre, password, birthdate, email, register)
	VALUES ("$user", "$name", "$password", "$bdate", "$email", now() );
	EOD;



$res = $conn->query($query);

if (!$res){
echo "Error DB2 : query mal formada";
exit;

}

if ($res->num_rows != 1){
	echo "ERROR DB 3: Login incorrecto";
	exit;

	}



?>
