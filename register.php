<?php
include('header.php');
?>
<!-- CONTENIDO -->
<div class="l-6 center s-12">
	<h1 class="text-center">Registro de nuevo usuario</h1>
	<div class="box">
		<form action="register.php" class="customform" method="POST">
			<label for="tipo">¿Qué perfil eres?</label>
			<select name="tipo" id="selectTipo">
				<option value="1">Embajador</option>
				<option value="2">Empresa</option>
				<option value="3">Showroom</option>
			</select>
			<label for="nombre">Nombre</label>
			<input type="text" name="nombre" placeholder="Introduce tu nombre" required>
			<label for="apellidos">Apellidos</label>
			<input type="text" name="apellidos" placeholder="Introduce tus apellidos">
			<label for="password">Contraseña</label>
			<input type="password" name="password" placeholder="Introduce al menos 6 caracteres alfanuméricos" required pattern="[0-9a-zA-Z]{6,12}">
			<label for="password2">Confirma tu contraseña</label>
			<input type="password" name="password2" placeholder="Vuelve a introducir tu contraseña" required pattern="[0-9a-zA-Z]{6,12}">
			<label for="localidad">Localidad</label>
			<input type="text" name="localidad" placeholder="Dónde te encuentras" required>
			<label for="mail">Mail</label>
			<input type="mail" name="mail" placeholder="Introduce un correo válido" required>
			<label for="telefono">Teléfono</label>
			<input type="text" name="telefono" placeholder="Introduce un teléno de contacto" required>
			<button class="buttonn-submit-btn" type="submit" name="crear">Crear</button>
		</form>
	</div>
</div>


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
include('footer.php');
?>