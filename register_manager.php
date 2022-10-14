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

	if (strlen(trim($_POST["fullName"])) < 2 )
	{
		echo "ERROR 2: Nombre mal formado";
		exit;
	}

	if (strlen(trim($_POST["user"])) < 4 )
	{
		echo "ERROR 3: Nombre de usuario mal formado";
		exit;
	}

	if (strlen(trim($_POST["passwd"])) < 6 )
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


	if (strlen(trim($_POST["birthdate"])) != 10 )
	{
		echo "ERROR 6: Fecha no válida";
		exit;
	}


$birthdate = explode("-", $_POST["birthdate"] );

print_r($birthdate);


	if (count($birthdate) != 3){ echo "ERROR 6.1: Fecha mal formada"; }

	
	if (strlen($birthdate[0] != 4 || strlen($birthdate[1] != 2 || strlen($birthdate[2] != 2)
	{
		echo "ERROR 6.2: Fecha mal formado";
		exit;

	}

	if (strval($birthdate[0]) > getdate("year") - 18 ){ echo "ERROR 6.3: Eres menor de edad"; exit;}

	if (strval($birthdate[1]) > getdate("year") - 18 ){ echo "ERROR 6.3: Eres menor de edad"; exit;}

	if (strval($birthdate[2]) > getdate("year") - 18 ){ echo "ERROR 6.3: Eres menor de edad"; exit;}

?>
