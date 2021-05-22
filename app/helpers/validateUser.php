<?php 

/*
** En este archivo están las funciones encargadas de validar un registro o un login.
*/

/*
** Función para comprobar que un usuario ha metido los datos bien al registrarse:
** que no haya dejado nada en blanco, que no haya espacios en el nombre, el captcha...
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

	/********* USUARIO *********/

	// Comprobamos que usuario no esté vacío, o que no haya espacios ni caracteres no imprimibles.
	if (empty($user['username']) || strpos($user['username'], " ") || !ctype_print($user['username'])) {
		if (empty($user['username']))
			array_push($errors, 'Introduce un nombre de usuario.');
		else
			array_push($errors, 'El nombre de usuario no puede contener espacios en blanco ni caracteres raros.');
	}

	// Comprobamos que no exista un usuario con ese nombre.
	$existingUser = selectOne('users', ['username' => $user['username']]);

	if ($existingUser) {
		if ((isset($user['update-user']) && $existingUser['id'] != $user['id']) || isset($_POST['create-admin']) || isset($_POST['register-btn']))
			array_push($errors, "Ya existe el usuario " . "'" . $user['username'] . "'");
	}

	/* ********EMAIL *********/

	// Comprobamos que el email no esté vacío
	if (empty($user['email']))
		array_push($errors, 'Es necesario introducir un email.');	

	// Comprobamos que no exista un usuario con ese email.
	$existingUser = selectOne('users', ['email' => $user['email']]);
	if ($existingUser){
		if ((isset($user['update-user']) && $existingUser['id'] != $user['id']) || isset($_POST['create-admin']) || isset($_POST['register-btn']))
			array_push($errors, 'Ese email ya está registrado.');
	}
	
	/********* CONTRASEÑA *********/

	// Comprobamos que la cotnraseña no esté vacía, que se hayan metido mínimo 6 caracteres y que contraseña y confirmación coincidan.
	if (empty($user['password']) || strlen($user['password']) < 6 || $user['password'] != $user['passwordConf']) {
		if (empty($user['password']))
			array_push($errors, 'Es necesario introducir una contraseña.');
		else if (strlen($user['password']) < 6)
			array_push($errors, 'La contraseña debe tener al menos 6 caracteres.');
		else
			array_push($errors, 'Las contraseñas no coinciden.');
	}
	
	/********* CAPTCHA *********/
	
	// Coimprobamos que el resultado del captcha sea correcto.
	if(isset($user['register-btn'])){
		if (empty($user['captcha']) || ($user['captcha'] != $user['captchaResult']))
			array_push($errors, 'El captcha es incorrecto.');
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
