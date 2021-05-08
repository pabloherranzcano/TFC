<?php

include ROOT_PATH . "/app/database/db.php";
include ROOT_PATH . "/app/helpers/validateUser.php";

$username = '';
$email = '';
$password = '';
$passwordConf = '';

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
		$user_id = create('users', $_POST);
		$user = selectOne('users', ['id' => $user_id]);
		
		
		printData($user);
	}
	else 
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$passwordConf = $_POST['passwordConf'];
	}
	
}
?>