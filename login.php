<?php
include('header.php');
?>

<?php
if( isset($_POST['entrar']) ){
	// recoger el usuario en el sistema
	require_once('user.php');
	$usuario = new User();
	$data = $usuario->login($_POST['nick'], $_POST['pass']);

	if( !empty($data) ){
		// guardamos la sesión del usuario
		$_SESSION['perfil'] = $data['nombre'];
		$_SESSION['rol'] = $data['id_tipo'];

		// guardar cookie cuando el login es ok
		if( !empty($_POST['remember']) ){
			setcookie('usuario_cookie',$_POST['nick'],time() + 3600);
			// el usuario expira en una hora
			setcookie('usuario_pass',$_POST['pass'],time() + 3600);
			// la pass expira en una hora
		} else {
			if( isset($_COOKIE["usuario_cookie"]) )
				setcookie("usuario_cookie","");
			if( isset($_COOKIE["usuario_pass"]) )
				setcookie("usuario_pass","");
		}

		// redirigir al index
		header("Location: index.php");
	} else {
		echo "<script>
						if(window.confirm('No existen estas credenciales de usuario.'))
							document.location = 'login.php';
					</script>";
	}
}
?>
