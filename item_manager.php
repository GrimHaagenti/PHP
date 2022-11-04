<?php

if (!isset($_POST["item"])
|| !isset($_POST["id"])  
|| !isset($_POST["description"])  
|| !isset($_POST["cost"])  
|| !isset($_POST["weight"])  
|| !isset($_POST["rarity"])  
|| !isset($_POST["type"])  
){
	echo"ERROR 1: Formulario no enviado";
	exit;
}

if(strlen(trim($_POST["item"])) < 2){
	echo"ERROR 2: Nombre mal formado";
	exit;
}

if(($_POST["id"]) < 0){
	echo"ERROR 3: ID incorrecto";
	exit;
}

if(strlen(trim($_POST["description"])) < 10){
	echo"ERROR 4: Descripción mal formada";
	exit;
}

if(($_POST["cost"]) < 0){
	echo"ERROR 5: Coste negativo";
	exit;
}

if(($_POST["weight"]) < 0){
	echo "ERROR 6: Peso incorrecto";
	exit;
}

if(($_POST["rarity"]) < 0){
	echo "ERROR 7: Rareza incorrecta";
	exit;
}

if(strlen(trim($_POST["type"])) < 4){
	echo"ERROR 8: Tipo mal formado";
	exit;
}

?>
