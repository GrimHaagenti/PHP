<?php

function get_balance ($conn, $id_user){	

	$query = <<<EOD
SELECT balance
FROM bank_accounts
WHERE id_user=$id_user;
EOD;

	$res = $conn->query($query);

	if(!$res){
		echo "ERROR BANK 1: Error al hacer la query";
		return false;
	}

	if($res->num_rows != 1){
		return false;
	}

	$balance = $res->fetch_assoc();

	return $balance["balance"];
}

?>
