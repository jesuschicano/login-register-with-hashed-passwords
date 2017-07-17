<?php
if( isset($_POST['crear']) )
{
	if( $_POST['password'] === $_POST['password2'] ) 
	{
		require_once('user.php');
		$usuario = new User();
		$usuario->save($_POST['nombre'],$_POST["apellidos"],$_POST['password'],$_POST["localidad"],$_POST["mail"],$_POST["telefono"],$_POST["tipo"]);
	} else {
		echo "<div class='box text-center'>Las contraseñas deben ser iguales</div>";
	}
}
