<?php

require("template.php");

print_head("Item Insert");

$item_form = <<<EOD
<form method="POST" action="item_manager.php" id="item-form">
<h2> Add Item </h2>
<p><label for="item-name">Item:</label>
<input type="text" name="item" id="item-name"/></p>
<p><label for="item-id">ID Item:</label>
<input type="text" name="id" id="item-id"/></p>
<p><label for="item-desc">Description:</label>
<input type="text" name="description" id="item-desc"/></p>
<p><label for="item-cost">Cost:</label>
<input type="text" name="cost" id="item-cost"/></p>
<p><label for="item-weight">Weight:</label>
<input type="text" name="weight" id="item-weight"/></p>
<p><label for="item-rarity">Rarity:</label>
<input type="text" name="rarity" id="item-rarity"/></p>
<p><label for="item-type">Type:</label>
<input type="text" name="type" id="item-type" /></p>
<p><input type="submit" value="Add" /></p>
</form>
EOD;

print_body($item_form);

?>
