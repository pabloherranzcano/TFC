<?php

require_once ROOT_PATH . "/app/database/db.php";
require_once ROOT_PATH . "/app/helpers/validateContact.php";
require_once ROOT_PATH . "/app/helpers/middleware.php";

$table = 'contact';

$errors = array();
$id = '';
$name = '';
$email = '';
$message = '';
$created_at = "now()";

/*
** En el contacto no nos interesa poder modificar los emails uqe nos lleguen, por lo que
** no haremos un Update en ningún momento. Haremos un create para generar el email de contacto.
** Reaa, para poder leerlo desde el panel de administrador. Y delete, por si queremos eliminarlo.
*/

/********************************************/
/**************** C R E A T E ***************/
/********************************************/
if (isset($_POST['contact-btn'])) {
	// // Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	// adminOnly();
	$errors = validateContact($_POST);
	if ($errors == 0) {
		unset($_POST['contact-btn']);
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];

		// Ejecutamos la query, esta vez sin la función create().
		$sql = "INSERT INTO $table (name, email, message, created_at) VALUES ('$name', '$email', '$message', now());";
		$contact_id = mysqli_query($connection, $sql);

		$_SESSION['message'] = 'Email enviado correctamente.';
		$_SESSION['type'] = 'success';
		
		header('location: ' . BASE_URL . '/index.php');
		exit();
	}
	else
	{
		$name = $_POST['name'];
		$email = $_POST['email'];
		$message = $_POST['message'];

		$_SESSION['message'] = 'Ha habido un problema al enviar el email.';
		$_SESSION['type'] = 'error';
	}
}

/********************************************/
/****************** R E A D *****************/
/********************************************/
if (isset($_GET['read_id'])) {
	$id = $_GET['read_id'];
	$singleEmailFetched = selectOne($table, ['id' => $id]);
	
	$id = $singleEmailFetched['id'];
	$name = $singleEmailFetched['name'];
	$email = $singleEmailFetched['email'];
	$body = $singleEmailFetched['message'];
	$created_at = $singleEmailFetched['created_at'];
}

/********************************************/
/**************** D E L E T E ***************/
/********************************************/
if (isset($_GET['delete_id'])) {
	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();
	
	$id = $_GET['delete_id'];
	$count = delete($table, $id);

	$_SESSION['message'] = 'Email eliminado correctamente.';
	$_SESSION['type'] = 'success';

	header('location: ' . BASE_URL . '/admin/contact/index.php');
	
	exit();
}
?>