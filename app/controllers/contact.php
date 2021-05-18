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
$sent_at = "now()";

// CREATE
if (isset($_POST['contact-btn'])) {
	// // Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	// adminOnly();
	$errors = validateContact($_POST);
	if ($errors == 0) {
		unset($_POST['contact-btn']);

		$email_id = create($table, $_POST);

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
// READ
if (isset($_GET['read_id'])) {
	$id = $_GET['read_id'];
	$singleEmailFetched = selectOne($table, ['id' => $id]);
	
	$id = $singleEmailFetched['id'];
	$name = $singleEmailFetched['name'];
	$email = $singleEmailFetched['email'];
	$body = $singleEmailFetched['message'];
	$sent_at = $singleEmailFetched['created_at'];
	

}

// DELETE
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