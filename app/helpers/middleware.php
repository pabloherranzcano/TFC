<?php

/* 
** Archivo para controlar los accesos a unas partes u otras de la web
** dependiendo del tipo de usuario que sea.
*/

/*
** Función destinada a los visitantes que todavía no se han logueado.
**
** Si el usuario no está logueado, o sea, si no hay id en la
** variable global SESSION, se lanza el mensaje para que se loguee, y
** le redireccionamos al index.
*/
function usersOnly($redirect = '/index.php')
{
	if (empty($_SESSION['id'])) {
		$_SESSION['message'] = 'Primero necesitas loguearte.';
		$_SESSION['type'] = 'error';
		
		header('location: ' . BASE_URL . $redirect);

		exit();
	}
}

/*
** Función para permitir parte de nuestro código sólo a los usuarios
** admin. No queremos que cualquiera pueda acceder a todos los apartados
** de nuestro blog.
**
** Si el usuario no está registrado, o sea, si no hay id en la
** variable global SESSION... se lanza el mensaje de aviso, y
** le redireccionamos al index.
*/
function adminOnly($redirect = '/index.php')
{
	if (empty($_SESSION['admin'])) {
		$_SESSION['message'] = 'No estás autorizado.';
		$_SESSION['type'] = 'error';
		
		header('location: ' . BASE_URL . $redirect);

		exit();
	}
}

/*
** Función para los usuarios ya logueados.
**
** Si el usuario está logueado, no necesitamos mostrar ningún mensaje.
** Simplemnte le redireccionamos al index.
*/
function guestsOnly($redirect = '/index.php')
{
	if (isset($_SESSION['id'])) {
		
		header('location: ' . BASE_URL . $redirect);

		exit();
	}
}
