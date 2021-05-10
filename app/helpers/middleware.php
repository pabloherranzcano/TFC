<?php


/* Función para restingir el acceso a los usuarios no admin dependiendo
de la funcionalidad a la que se quiera acceder */ 
function usersOnly($redirect = '/index.php')
{
	/* Si el usuario no está logueado, o sea, si no hay id en la
	variable global SESSION... */
	if (empty($_SESSION['id'])) {
		$_SESSION['message'] = 'You need to log in first';
		$_SESSION['type'] = 'error';
		
		header('location: ' . BASE_URL . $redirect);

		exit();
	}
}

/* Función para restingir parte de nuestro código sólo a los usuarios
admin. No queremos que cualquiera pueda acceder a todos los apartados
de nuestro blog. */
function adminOnly($redirect = '/index.php')
{
	/* Si el usuario no está registrado, o sea, si no hay id en la
	variable global SESSION... O no es admin */
	if (empty($_SESSION['admin']) || empty($_SESSION['admin'])) {
		$_SESSION['message'] = 'You are not authorized';
		$_SESSION['type'] = 'error';
		
		header('location: ' . BASE_URL . $redirect);

		exit();
	}
}

/* Función para restingir el acceso páginas como el login o el registro
a usuarios que ya se han logueado. */ 
function guestsOnly($redirect = '/index.php')
{
	/* Si el usuario está logueado, no necesitamos mostrar ningún mensaje.
	Simplemnteo lo redireccionamos al index. */
	if (isset($_SESSION['id'])) {
		
		header('location: ' . BASE_URL . $redirect);

		exit();
	}
}

?>