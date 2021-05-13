<?php

include ROOT_PATH . "/app/database/db.php";
include ROOT_PATH . "/app/helpers/validateUser.php";
include ROOT_PATH . "/app/helpers/middleware.php";


$table = 'users';

// Como solo queremos que se nos muestren todos los admin users...
$admin_users = selectAll($table);

$errors = array();
$id = '';
$username = '';
$admin = '';
$email = '';
$password = '';
$passwordConf = '';

//FUNCIÓN DE LOGINUSER
function loginUser($user)
{
	$_SESSION['admin'] = $user['admin'];
	$_SESSION['id'] = $user['id'];
	$_SESSION['username'] = $user['username'];
	$_SESSION['message'] = '¡Ya estás logueado!';
	$_SESSION['type'] = 'success';

	/* Regresamos al index si el usuario no es admin. Si no, al control panel */
	if ($_SESSION['admin'])
		header('location: ' . BASE_URL . '/admin/dashboard.php');
	else
		header('location: ' . BASE_URL . '/index.php');

	/* Acabamos la ejecución del script en este punto. */
	exit();
}

// CREATE
/* Función para crear nuevos usuarios, pero también para el panel de control, administrar
los admin. Sólo una de las dos condiciones de este if va a ser verdad, porque o se registra
como un usuario normal, o lo hacemos nosotros desde el panel de control.

Tendreemos que hacer unset de create-admin, porque al pasar #_POST a la función create de db, 
no se contempla ese valor. */
if (isset($_POST['register-btn']) || isset($_POST['create-admin'])) {
	/* Lo primero que hacemos es comprobar que todos los campos del formulario
	ha sido rellenados, para mostrar un mensaje u otro en caso negativo. Para ello,
	creamos un array en el que iremos almacenando cada error existente. */
	$errors = validateUser($_POST);

	/* En el caso de que no haya ningún error, añadimos al usuario a nuestra BBDD. */
	if (count($errors) == 0) {

		/* Esta comprobación es para saber si se ha creado un usuario desde register.php o desde
		el panel de control. Como después vamos a borrar register-btn para no enviarlo a la base de datos,
		ya que no existe ese campo en la tabla, guardamos antes el valor para, en caso afirmativo, poder
		logear al usuario y redirigirlo correctamente al index. */
		if (isset($_POST['register-btn']))
			$register = 1;

		/* Para creara un usuario no necesitamos los valores de "passwordConf" y
		"register-btn", por lo que los eliminamos con la función "unset", 
		para quedarnos con lo que nos interesa. */
		unset($_POST['passwordConf'], $_POST['register-btn'], $_POST['create-admin']);

		/* Encriptamos las contraseñas como elemento de seguridad. De este modo, 
		cualquiera que tenga acceso a la base de datos no podrá saber la contraseña
		del usuario. */
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);

		/* Si "admin" llega por POST, es porque tenemos que crear al usuario con permisos
		de administrador (1 –true– en la DB) */
		if ($_POST['admin']) {
			$_POST['admin'] = 1;
			$user_id = create($table, $_POST);

			$_SESSION['message'] = 'Administrador creado con éxito.';
			$_SESSION['type'] = 'success';

			/* No nos interesa hacer login en el panel de control */
			header('location: ' . BASE_URL . '/admin/users/index.php');
			exit(); // Siempre que redireccionas, hay que hacer exit.
		} else {
			/* Cuando se registre un usuario, queremos que NO sea admin por defecto, 
			por lo tanto, le asignamos el valor "false" */
			$_POST['admin'] = 0;

			// /* Creamos el usuario llamando a la función "create" dentro del CRUD de db.php */
			$user_id = create($table, $_POST);
			$user = selectOne($table, ['id' => $user_id]);

			/* Si se ha creado el usuario desde register.php logueamos a dicho usuario con sesiones.
			Si no es así, es porque se ha creado desde el panel de control, por lo que sólo mostraremos
			un mensaje de éxito y redirigiremos al panel index de users.*/
			if ($register)
				loginUser($user);
			else {
				$_SESSION['message'] = 'Usuario creado con éxito.';
				$_SESSION['type'] = 'success';

				/* No nos interesa hacer login en el panel de control */
				header('location: ' . BASE_URL . '/admin/users/index.php');
				exit(); // Siempre que redireccionas, hay que hacer exit.
			}
		}
	} else {
		$username = $_POST['username'];
		$admin = isset($_POST['admin']) ? 1 : 0;
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];
	}
}

// LOGIN
if (isset($_POST['login-btn'])) {
	$errors = validateLogin($_POST);
	/* Si el usuario existe y la contraseña concuerda... */
	if (count($errors) == 0) {
		$user = selectOne($table, ['username' => $_POST['username']]);

		if ($user && password_verify($_POST['password'], $user['password'])) {
			/* Loguea y redirecciona */
			loginUser($user);
		} else {
<<<<<<< HEAD
			array_push($errors, "Usuario o contraseña inválidos.");
=======
			array_push($errors, "Usuario o contraseña incorrectos.");
			// printData($user);
			// printData($_POST['password']);
>>>>>>> 4c15febdb1a3d68ca2e11dba6184c59782de5f3d
		}
	}
	$username = $_POST['username'];
	$password = $_POST['password'];
}
// READ
if (isset($_GET['id'])) {
	$user =	selectOne($table, ['id' => $_GET['id']]);

	$id = $user['id'];
	$username = $user['username'];
	$admin = $user['admin'];
	$email = $user['email'];
	$password = $user['password'];
	$passwordConf = $user['passwordConf'];
}

// UPDATE
if (isset($_POST['update-user'])) {
	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();

	$errors = validateUser($_POST);

	if (count($errors) == 0) {
		$id = $_POST['id'];
		unset($_POST['passwordConf'], $_POST['update-user'], $_POST['id']);

		unset($_POST['passwordConf'], $_POST['register-btn'], $_POST['create-admin']);

		// Podemos quitarle los permisos de administrador al usuario que estemos editando.
		$_POST['admin'] = isset($_POST['admin']) ? 1 : 0;
		$count = update($table, $id, $_POST); //update y create devuelven el número de filas afectadas.

		$_SESSION['message'] = 'Admin user update succesfully.';
		$_SESSION['type'] = 'success';

		header('location: ' . BASE_URL . '/admin/users/index.php');
		exit();
	} else {
		$username = $_POST['username'];
		$admin = isset($_POST['admin']) ? 1 : 0;
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];
	}
}

// DELETE
if (isset($_GET['delete_id'])) {
	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();

	$id = $_GET['delete_id'];
	$count = delete($table, $id);

	$_SESSION['message'] = 'Usuario eliminado con éxito.';
	$_SESSION['type'] = 'success';

	header('location: ' . BASE_URL . '/admin/users/index.php');

	exit();
}
