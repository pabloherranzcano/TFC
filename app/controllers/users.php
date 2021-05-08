<?php

include ROOT_PATH . "/app/database/db.php";

if (isset($_POST["register-btn"])) {

	/* Lo primero que hacemos es comprobar que todos los campos del formulario
	ha sido rellenados, para mostrar un mensaje u otro en caso negativo. Para ello,
	creamos un array en el que iremos almacenando cada error existente. */
	$errors = array();

	/* Usuario */
	if (empty($_POST['username'])) {
		array_push($errors, 'Username is required');
	}
	
	/* Email */
	if (empty($_POST['email'])) {
		array_push($errors, 'Email is required');
	}	
	
	/* Contraseña */
	if (empty($_POST['password'])) {
		array_push($errors, 'Password is required');
	}

	/* password != passwordConf*/
	if ($_POST['password'] != $_POST['passwordConf']) {
		array_push($errors, 'Passwords do not match');
	}
	
	printData($errors);

	/* En el caso de que no haya ningún error, añadimos al usuario a nuestra BBDD. */
	if (count($erors) == 0) {
		
	
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
		// $user_id = create('users', $_POST);
		// $user = selectOne('users', ['id' => $user_id]);
		
		// $data = [
		// 	'username' => 'Pablooooooooo',
		// 	'admin' => 0,
		// 	'email' => 'pablo111@gmail.com',
		// 	'password' => 'Enrique'
		// ];
		
		$user_id = create('users', $_POST);
		$user = selectOne('users', ['id' => $user_id]);
		
		printData($user);
	}



}

?>