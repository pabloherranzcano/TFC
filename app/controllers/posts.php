<?php

include ROOT_PATH . "/app/database/db.php";
include ROOT_PATH . "/app/helpers/validatePost.php";
include ROOT_PATH . "/app/helpers/middleware.php";

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
$image_name = "";
$image = "";

/********************************************/
/**************** C R E A T E ***************/
/********************************************/
/* 
** Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
** 
** Comprobamos que haya una imagen seleccionada. No pueden tener el mismo nombre por lo que usamos la función time() para que
** tengan siempre un nombre diferente (empezarán con la hora y día en que se subió) seguido del nombre original.
** 
** Si se ha subido con éxito, le damos la ruta creada en $image_name.
** 
** Como es inseguro dejar etiquetas html en la base de datos, podríamos aplicar un paso extra de seguridad con el método 
** htmlentities, que se encargará de quitar las etiquetas <p> y </p>
** // $_POST['body'] = htmlentities($_POST['body']);
** 
** Los checkbox no funcionan igual que los otros elementos del formulario. Si no lo marcamos,
** directamente no se envía por POST, por lo que tenemos que volver a mostrarlo de la misa manera
** que antes
*/
if (isset($_POST['add-post'])) {
	adminOnly();
	$errors = validatePost($_POST);

	if (!empty($_FILES['image']['name'])) {
		$image_name = time() . '_' . $_FILES['image']['name'];
		$destination = ROOT_PATH . "/assets/images/" . $image_name;

		$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

		if ($result) {
			$_POST['image'] = $image_name;
		} else {
			array_push($errors, "Ha habido un error al subir la imagen.");
		}
	} else {
		array_push($errors, "Es necesario subir una imagen.");
	}
	if (count($errors) == 0) {
		unset($_POST['add-post']);
		$_POST['user_id'] = $_SESSION['id'];
		$_POST['published'] = isset($_POST['published']) ? 1 : 0; // Ternario: si se ha marcado la opción de publicarlo, le asignamos 1, si no, 0.


		$post_id = create($table, $_POST);

		$_SESSION['message'] = 'Post creado correctamente.';
		$_SESSION['type'] = 'success';

		header('location: ' . BASE_URL . '/admin/posts/index.php');
	} else {
		$title = $_POST['title'];
		$body = $_POST['body'];
		$topic_id = $_POST['topic_id'];

		$published = isset($_POST['published']) ? 1 : 0;;
	}
}


/********************************************/
/****************** R E A D *****************/
/********************************************/
if (isset($_GET['id'])) {
	$post =	selectOne($table, ['id' => $_GET['id']]);
	$id = $_GET['id'];
	$title = $post['title'];
	$body = $post['body'];
	$topic_id = $post['topic_id'];
	$published = $post['published'];
	$image = $post['image'];
}


/********************************************/
/**************** U P D A T E ***************/
/********************************************/
if (isset($_POST['update-post'])) {
	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();

	$errors = validatePost($_POST);

	/* Si no se ha subido ninguna imagen borramos el atributo imagen, para actualizar todos los campos de la base
	de datos menos ese. Así podremos edita un post (actualizarlo) sin estar obligados a subir una nueva imagen. */
	if (empty($_FILES['image']['name'])) {
		unset($_POST['image']);
	}
	else {
		$image_name = time() . '_' . $_FILES['image']['name'];
		$destination = ROOT_PATH . "/assets/images/" . $image_name;

		$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination);

		if ($result) {
			$_POST['image'] = $image_name;
		} else {
			array_push($errors, "Ha habido un error al subir la imagen.");
		}
	}

	if (count($errors) == 0) {

		/* Recogemos el id del post porque es necesrio para saber qué post vamos a editar, y después
		lo borramos, porque el id no se puede modificar. */
		$id = $_POST['id'];
		unset($_POST['update-post'], $_POST['id']);
		$_POST['user_id'] = $_SESSION['id'];;
		$_POST['published'] = isset($_POST['published']) ? 1 : 0; // Ternario: si se ha marcado la opción de publicarlo, le asignamos 1, si no, 0.

		/* Como es inseguro dejar etiquetas html en la base de datos, le aplicamos un paso extra de seguridad con el método 
		htmlentities, que se encargará de quitar las etiquetas <p> y </p> */
		// $_POST['body'] = htmlentities($_POST['body']);

		$post_id = update($table, $id, $_POST);

		$_SESSION['message'] = 'Post actualizado correctamente.';
		$_SESSION['type'] = 'success';

		header('location: ' . BASE_URL . '/admin/posts/index.php');
	} else {
		$title = $_POST['title'];
		$body = $_POST['body'];
		$topic_id = $_POST['topic_id'];

		/* Los checkbox no funcionan igual que los otros elementos del formulario. Si no lo marcamos,
		directamente no se envía por POST, por lo que tenemos que volver a mostrarlo de la misa manera
		que antes */
		$published = isset($_POST['published']) ? 1 : 0;;
	}
}

/********************************************/
/**************** D E L E T E ***************/
/********************************************/
if (isset($_GET['delete_id'])) {

	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();

	$id = $_GET['delete_id'];
	$count = delete($table, $id);

	$_SESSION['message'] = 'Post eliminado con éxito.';
	$_SESSION['type'] = 'success';

	header('location: ' . BASE_URL . '/admin/posts/index.php');
}

// PUBLISH
if (isset($_GET['published']) && isset($_GET['p_id'])) {
	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();

	$published = $_GET['published'];
	$p_id = $_GET['p_id'];

	// Ahora hacemos update.
	$count = update($table, $p_id, ['published' => $published]);
	// Mostramos el mensaje.

	if ($_GET['published'] == 1)
		$_SESSION['message'] = 'El post ahora es visible en el blog.';
	else
		$_SESSION['message'] = 'El post ya no es visible en el blog.';

	$_SESSION['type'] = 'success';

	header('location: ' . BASE_URL . '/admin/posts/index.php');
}
