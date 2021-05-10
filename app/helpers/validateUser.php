<?php 

function validateUser($user)
{
	$errors = array();

	if (empty($user['username']))
		array_push($errors, 'Username is required');
	
	if (empty($user['email']))
		array_push($errors, 'Email is required');	
	
	if (empty($user['password']))
		array_push($errors, 'Password is required');

	if ($user['password'] != $user['passwordConf'])
		array_push($errors, 'Passwords do not match');

	// Comprobamos que no exista un usuario con ese nombre.
	$existingUser= selectOne('users', ['username' => $user['username']]);
	if (isset($existingUser)) {
		if ((isset($user['update-user']) && $existingUser['id'] != $user['id']) || isset($_POST['create-admin']))
			array_push($errors, 'Username already exists');
	}
	// Comprobamos que no exista un usuario con ese email.
	$existingUser = selectOne('users', ['email' => $user['email']]);
	if ($existingUser){
		if ((isset($user['update-user']) && $existingUser['id'] != $user['id']) || isset($_POST['create-admin']))
			array_push($errors, 'Email already exists');
	}
	/* Tenemos que hacer esta comprobación para saber si el post se está creando
	por primera vez o estamos editándolo, ya que si lo editamos y no hacemos esta
	comprobación, nunca nos dejará guardar los cambios con el mismo título, ya que
	ese título ya existe en la base de datos. Si se ha pulsado el botón de editar
	y además el id del post de la base de datos NO coincide con el que editamos, entonces
	mostramos el error. */
	return ($errors);
}

function validateLogin($user)
{
	$errors = array();

	if (empty($user['username']))
		array_push($errors, 'Username is required');
		
	if (empty($user['password']))
		array_push($errors, 'Password is required');
		
	return ($errors);
}
