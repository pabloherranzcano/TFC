<?php 

include ROOT_PATH . "/app/database/db.php";
include ROOT_PATH . "/app/helpers/validateTopic.php";
include ROOT_PATH . "/app/helpers/middleware.php";


$table = 'topics';

$errors = array();
$id = '';
$name = '';
$description = '';

$topics = selectAll($table);

// CREATE
if (isset($_POST['add-topic'])) {
	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();

	$errors = validateTopic($_POST);
	if (count($errors) == 0) {
		unset($_POST['add-topic']);
		$topic_id = create($table, $_POST);
		
		$_SESSION['message'] = 'Topic created successfully.';
		$_SESSION['type'] = 'success';
		
		header('location: ' . BASE_URL . '/admin/topics/index.php');
		exit();
	}
	else
	{
		$name = $_POST['name'];
		$description = $_POST['description'];
	}
}

// READ
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$topic = selectOne('topics', ['id' => $id]);
	
	$id = $topic['id'];
	$name = $topic['name'];
	$description = $topic['description'];
}

// UPDATE
if(isset($_POST['update-topic'])) {
	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();
	
	$errors = validateTopic($_POST);

	if (count($errors) == 0) {
		$id = $_POST['id'];
		unset($_POST['update-topic'], $_POST['id']);
		$topic_id = update($table, $id, $_POST);

		$_SESSION['message'] = 'Topic updated successfully.';
		$_SESSION['type'] = 'success';

		header('location: ' . BASE_URL . '/admin/topics/index.php');
	}
	else
	{
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
	}
}

// DELETE
if (isset($_GET['delete_id'])) {
	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();
	
	$id = $_GET['delete_id'];
	$count = delete($table, $id);

	$_SESSION['message'] = 'Topic deleted successfully.';
	$_SESSION['type'] = 'success';

	header('location: ' . BASE_URL . '/admin/topics/index.php');
	
	exit();
}
?>