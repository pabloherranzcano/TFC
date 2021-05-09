<?php 

include ROOT_PATH . "/app/database/db.php";
include ROOT_PATH . "/app/helpers/validatePost.php";

$table = 'posts';

// Para mostrar los topics en el select de create.php de posts
$topics = selectAll('topics');
$posts = selectAll('posts');

$errors = array();
$id = "";
$title = "";
$body = "";
$topic_id = "";
$published = "";
 
// CREATE
if (isset($_POST['add-post'])) {
	$errors = validatePost($_POST);
	
	/* Comprobamos que haya una imgen seleccionada. No pueden tener el mismo nombre por lo que usamos la función time() para que
	tengan siempre un nombre diferente (empezarán con la hora y día en que se subió) seguido del nombre original. */
	if(!empty($_FILES['image']['name'])) {
		$image_name = time() . '_' . $_FILES['image']['name'];
		$destination = ROOT_PATH . "/assets/images/" . $image_name;

		$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination); 
		
		// Si se ha subido con éxito
		if($result) {
			$_POST['image'] = $image_name;
		}
		else {
			array_push($errors, "Failed to upload image");
		}
	}
	else
		array_push($errors, "Post image require");

	if (count($errors) == 0) {
		unset($_POST['add-post']);
		$_POST['user_id'] = 1;
		$_POST['published'] = isset($_POST['published']) ? 1 : 0; // Ternario: si se ha marcado la opción de publicarlo, le asignamos 1, si no, 0.
		
		/* Como es inseguro dejar etiquetas html en la base de datos, le aplicamos un paso extra de seguridad con el método 
		htmlentities, que se encargará de quitar las etiquetas <p> y </p> */
		// $_POST['body'] = htmlentities($_POST['body']);

		$post_id = create($table, $_POST);

		$_SESSION['message'] = 'Post created successfully.';
		$_SESSION['type'] = 'success';

		header('location: ' . BASE_URL . '/admin/posts/index.php');
	}
	else{
		$title = $_POST['title'];
		$body = $_POST['body'];
		$topic_id = $_POST['topic_id'];

		/* Los checkbox no funcionan igual que los otros elementos del formulario. Si no lo marcamos,
		directamente no se envía por POST, por lo que tenemos que volver a mostrarlo de la misa manera
		que antes */
		$published = isset($_POST['published']) ? 1 : 0;;
	}
}


// READ
if (isset($_GET['id'])){
	$post =	selectOne($table, ['id' => $_GET['id']]);
	// printData($post);

	$id = $_GET['id'];
	$title = $_GET['title'];
	$body = $_GET['body'];
	$topic_id = $_GET['topic_id'];
	$published = $_GET['published'];
}

//UPDATE
if (isset($_POST['update-post'])) {
	$errors = validatePost($_POST);
	
	/* Comprobamos que haya una imgen seleccionada. No pueden tener el mismo nombre por lo que usamos la función time() para que
	tengan siempre un nombre diferente (empezarán con la hora y día en que se subió) seguido del nombre original. */
	if(!empty($_FILES['image']['name'])) {
		$image_name = time() . '_' . $_FILES['image']['name'];
		$destination = ROOT_PATH . "/assets/images/" . $image_name;

		$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination); 
		
		// Si se ha subido con éxito
		if($result) {
			$_POST['image'] = $image_name;
		}
		else {
			array_push($errors, "Failed to upload image");
		}
	}
	else
		array_push($errors, "Post image require");

	if (count($errors) == 0) {

		/* Recogemos el id del post porque es necesrio para saber qué post vamos a editar, y después
		lo borramos, porque el id no se puede modificar. */
		$id = $_POST['id'];
		unset($_POST['update-post'], $_POST['id']);
		$_POST['user_id'] = 1;
		$_POST['published'] = isset($_POST['published']) ? 1 : 0; // Ternario: si se ha marcado la opción de publicarlo, le asignamos 1, si no, 0.
		
		/* Como es inseguro dejar etiquetas html en la base de datos, le aplicamos un paso extra de seguridad con el método 
		htmlentities, que se encargará de quitar las etiquetas <p> y </p> */
		// $_POST['body'] = htmlentities($_POST['body']);

		$post_id = update($table, $id, $_POST);

		$_SESSION['message'] = 'Post updated successfully.';
		$_SESSION['type'] = 'success';

		header('location: ' . BASE_URL . '/admin/posts/index.php');
	}
	else{
		$title = $_POST['title'];
		$body = $_POST['body'];
		$topic_id = $_POST['topic_id'];

		/* Los checkbox no funcionan igual que los otros elementos del formulario. Si no lo marcamos,
		directamente no se envía por POST, por lo que tenemos que volver a mostrarlo de la misa manera
		que antes */
		$published = isset($_POST['published']) ? 1 : 0;;
	}
}

// DELETE
if (isset($_GET['delete_id'])){
	$count = delete($table, $_GET['delete_id']);

	$_SESSION['message'] = 'Post deleted successfully.';
		$_SESSION['type'] = 'success';

		header('location: ' . BASE_URL . '/admin/posts/index.php');
}
?>