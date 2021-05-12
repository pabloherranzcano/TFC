<?php 

/*
** En este archivo están las funciones encargadas de validar un registro o un login.
*/

/*
** Función para comprobar que un usuario ha metido los datos bien al registrarse.
** 
** Tenemos que hacer la última comprobación para saber si el usuario se está creando
** por primera vez o estamos editándolo desde el panel de admin, ya que si lo editamos y
** no hacemos esta comprobación, nunca nos dejará guardar los cambios con el mismo nombre,
** ya que ese nombre ya existe en la base de datos. Si se ha pulsado el botón de editar
** y además el id del usuario de la base de datos NO coincide con el que editamos, entonces
** mostramos el error.
*/
function validateUser($user)
{
	$errors = array();

	if (empty($user['username']))
		array_push($errors, 'Es necesario introducir un nombre de usuario.');
	
	if (empty($user['email']))
		array_push($errors, 'Es necesario introducir un email.');	
	
	if (empty($user['password']))
		array_push($errors, 'Es necesario introducir una contraseña.');

	if ($user['password'] != $user['passwordConf'])
		array_push($errors, 'Las contraseñas no coinciden.');

	// Comprobamos que no exista un usuario con ese nombre.
	$existingUser= selectOne('users', ['username' => $user['username']]);
	if (isset($existingUser)) {
		if ((isset($user['update-user']) && $existingUser['id'] != $user['id']) || isset($_POST['create-admin']))
			array_push($errors, 'Ese nombre de usuario ya está registrado.');
	}
	// Comprobamos que no exista un usuario con ese email.
	$existingUser = selectOne('users', ['email' => $user['email']]);
	if ($existingUser){
		if ((isset($user['update-user']) && $existingUser['id'] != $user['id']) || isset($_POST['create-admin']))
			array_push($errors, 'Ese email ya está registrado.');
	}

	return ($errors);
}

/*
** Función para comprobar que un usuario ha metido los datos bien al loguearse.
*/
function validateLogin($user)
{
	$errors = array();

	if (empty($user['username']))
		array_push($errors, 'Es necesario introducir un nombre de usuario.');
		
	if (empty($user['password']))
		array_push($errors, 'Es necesario introducir una contraseña.');
		
	return ($errors);
}
