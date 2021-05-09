<?php

include ROOT_PATH . "/app/database/db.php";
include ROOT_PATH . "/app/helpers/validateUser.php";

$errors = array();
$username = '';
$email = '';
$password = '';
$passwordConf = '';
$table = 'users';

function loginUser($user)
{
	$_SESSION['id'] = $user['id'];
	$_SESSION['username'] = $user['username'];
	$_SESSION['admin'] = $user['admin'];
	$_SESSION['message'] = 'You are now logged in';
	$_SESSION['type'] = 'success';

	/* Regresamos al index si el usuario no es admin. Si no, al control panel */
	if ($_SESSION['admin'])
		header('location: ' . BASE_URL . '/admin/dashboard.php');
	header('location: ' . BASE_URL . '/index.php');

	/* Acabamos la ejecución del script en este punto. */
	exit();
}

if (isset($_POST["register-btn"])) {

	/* Lo primero que hacemos es comprobar que todos los campos del formulario
	ha sido rellenados, para mostrar un mensaje u otro en caso negativo. Para ello,
	creamos un array en el que iremos almacenando cada error existente. */
	$errors = validateUser($_POST);

	/* En el caso de que no haya ningún error, añadimos al usuario a nuestra BBDD. */
	if (count($errors) == 0) {
	
		/* Para creara un usuario no necesitamos los valores de "passwordConf" y
		"register-btn", por lo que los eliminamos con la función "unset", 
		para quedarnos con lo que nos interesa. */
		unset($_POST['passwordConf'], $_POST['register-btn']);
		
		/* Cuando se registre un usuario, queremos que NO sea admin por defecto, 
		por lo tanto, le asignamos el valor "false" */
		$_POST['admin'] = 0;
	
		/* Encriptamos las contraseñas como elemento de seguridad. De este modo, 
		cualquiera que tenga acceso a la base de datos no podrá saber la contraseña
		del usuario. */
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		// /* Creamos el usuario llamando a la función "create" dentro del CRUD de db.php */
		$user_id = create($table, $_POST);
		$user = selectOne($table, ['id' => $user_id]);

		/* Logueamos al usuario con sesiones */
		loginUser($user);
	}
	else 
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];
	}
	
}

if (isset($_POST['login-btn'])) {
	$errors = validateLogin($_POST);
	/* Si el usuario existe y la contraseña concuerda... */
	if (count($errors) == 0) {
		$user = selectOne($table, ['username' => $_POST['username']]);

		if ($user && password_verify($_POST['password'], $user['password'])) {
			/* Loguea y redirecciona */
			loginUser($user);
		}	
		else
			array_push($errors, "Wrong credentials.");
	}
	$username = $_POST['username'];
	$password = $_POST['password'];
}
?>