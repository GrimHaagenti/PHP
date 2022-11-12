<?php

/// ADD ARMOUR TYPES ///


session_start();

if(intval($_SESSION["id_user"]) != 1)
{
	echo "No eres Admin. Largo";
	exit;
}


require("template.php");

print_head("Armour Type");

$armour_type_form = <<<EOD
<form method="POST" action="armour_types_manager.php" id="armour-type-form">
<h2> Add Armour Type </h2>
<p><label for="armour-type-name">Armour Type:</label>
<input type="text" name="type" id="armour-type-name"/></p>
<p><label for="armour-type-icon">Icon filename:</label>
<input type="text" name="icon" id="armour-type-icon"/></p>
<p><input type="submit" value="Add" /></p>
</form>
EOD;

print_body($armour_type_form);

?>
