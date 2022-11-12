<?php


require("template.php");


print_head("Página de Login");

$form = <<<EOD

<article>
<form method="POST" action="login_manager.php" id="login-form">
<p>
<label for="login_user"> User: </label>
<input type="text" name="user" id="login-user" />
<p>

<p>
<label for="login_passwd"> Password: </label>
<input type="password" name="passwd" id="login-passwd" />
<p>

<p><input type="submit" value="Identificar" /></p>
</form>
EOD;

$register_form = <<<EOD
<form method="POST" action="register_manager.php" id="register-form">

<p>
<label for="register_fullName"> Nombre completo: </label>
<input type="text" name="fullName" id="register-fullName" />
<p>

<p>
<label for="register_user"> User: </label>
<input type="text" name="user" id="register-user" />
<p>

<p>
<label for="register_passwd"> Password: </label>
<input type="password" name="passwd" id="register-passwd" />
<p>

<p>
<label for="register_rePasswd"> Re-Password: </label>
<input type="password" name="rePasswd" id="register-rePasswd" />
<p>

<p>
<label for="register_birthdate"> Birthdate: </label>
<input type="date" name="birthdate" id="register-birthdate" />
<p>

<p>
<label for="register_email"> Email: </label>
<input type="email" name="email" id="register-email" />
<p>



<p><input type="submit" value="Registrar" /></p>


</form>
</article>
EOD;


print_body($form.$register_form);


?>
