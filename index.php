<?php




/*

function saludo (){
echo "<h2>Awoooo</h2>";
}

echo "<h1>invENTIory</h1>";

$var = "<p>Shiden-Go</p>";


echo "<p>Hola, ". $var .", </p>";

saludo();
*/

require("template.php");


//print_head("La Pelicula: El Juego: La pelicula");
//print_body();



print_head("Página de login");

$login_form = <<<EOD
<form method="POST" action="login_manager.php" id="login-form">
<h2> Log In </h2>
<p><label for="login-user">User:</label>
<input type="text" name="user" id="login-user "/></p>
<p><label for="login-passwd">Password:</label>
<input type="password" name="password" id="login-passwd" /></p>
<p><input type="submit" value="Identificar" /></p>
</form>
EOD;

$register_form = <<<EOD
<form method="POST" action="register_manager.php" id="register-form">
<h2> Register </h2>
<p><label for="register-name">Full Name:</label>
<input type="text" name="name" id="register-name"/></p>
<p><label for="register-user">Username:</label>
<input type="text" name="user" id="register-user"/></p>
<p><label for="register-passwd1">Password:</label>
<input type="password" name="password1" id="register-passwd1" /></p>
<p><label for="register-passwd2"> Repeat Password:</label>
<input type="password" name="password2" id="register-passwd2" /></p>
<p><label for="register-birthdate">Birthdate:</label>
<input type="date" name="birthdate" id="register-birthdate"/></p>
<p><label for="register-email">Email:</label>
<input type="text" name="email" id="register-email"/></p>
<p><input type="submit" value="Registrar" /></p>
</form>
EOD;

print_body($login_form.$register_form);
?>
