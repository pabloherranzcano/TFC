<?php

include "../../config.php";
require_once ROOT_PATH . "/app/database/db.php";
require_once ROOT_PATH . "/app/helpers/middleware.php";
	
$table = "comments";
/* Lo primero que hacemos es darle valor a la variable $user_id, para saber qué usuario escribe
qué comentario */
$user_id = $_SESSION['id'];

/* Conectamos de nuevo con la base de datos */
$db = mysqli_connect($host, $user, $pass, $db_name);

/* Recogemos por GET el id del post que vamos a leer. Más adelante esto no nos servirá cuando hagamos
la petición por AJAX, y tendremos que volver a recogerlo por POST. */
$getPostId = $_GET['id'];

/* Seleccionamos el post cuyo id acabamos de recoger en la base de datos. */
$post_query_result = mysqli_query($db, "SELECT * FROM posts WHERE id=$getPostId");
$post = mysqli_fetch_assoc($post_query_result);


// Recogemos todos los comentarios de la base de datos
$comments_query_result = mysqli_query($db, "SELECT * FROM comments WHERE post_id=$getPostId ORDER BY created_at DESC");

$comments = mysqli_fetch_all($comments_query_result, MYSQLI_ASSOC);

$commentsAdmin = mysqli_query($db, "SELECT * FROM comments");
/* Función que recibe el id de un usuario y devuelve su nombre. */
function getUsernameById($id)
{
	global $db;
	$result = mysqli_query($db, "SELECT username FROM users WHERE id=$id LIMIT 1");
	
	return mysqli_fetch_assoc($result)['username'];
}

/* Función que recibe el id de un post y devuelve el número total de comentarios
de ese post. */
function getCommentsCountByPostId($post_id)
{
	global $db;
	$result = mysqli_query($db, "SELECT COUNT(*) AS total FROM comments WHERE post_id=$post_id");
	$data = mysqli_fetch_assoc($result);
	return $data['total'];
}

/*
En cuanto haga click en enviar comentario, se hará una llamada a "comments.js", la cual es la encargada
de hacer la llamada AJAX y decir que se ha enviado un comentario (comment_posted = 1). En ese momento,
nosotros recogermos toda la información del post almacenada en un JSON, y la mostraremos automáticamente, y sin
refrescar la página, enciama del último post enviado.
*/
if (isset($_POST['comment_posted'])) {
	global $db;
	$postPostId = $_POST['postId'];

	// Recogeemos el comentario que ha sido enviado a través de AJAX.
	$comment_text = $_POST['comment_text'];

	// Insertamos el comentario en la base de datos.
	$sql = "INSERT INTO comments (post_id, user_id, body, created_at) VALUES ($postPostId, $user_id, '$comment_text', now());";
	$result = mysqli_query($db, $sql);

	// Inssertamos el comentario que vamos a mostrar posteriormente.
	$inserted_id = $db->insert_id;
	$res = mysqli_query($db, "SELECT * FROM comments WHERE id=$inserted_id");
	$inserted_comment = mysqli_fetch_assoc($res);
	// Si se ha insertado con éxito, recogemos el comentario de la base de datos, y lo devolvemos a la web
	if ($result) {
		$comment = "<div class='comment clearfix'>
					<img src='../../assets/images/profile.png' alt='' class='profile_pic'>
					<div class='comment-details'>
						<span class='comment-name'>" . getUsernameById($inserted_comment['user_id']) . "</span>
						<span class='comment-date'>" . date('F j, Y ', strtotime($inserted_comment['created_at'])) . "</span>
						<p>" . $inserted_comment['body'] . "</p>
					</div>";
		$comment_info = array(
			'comment' => $comment,
			'comments_count' => getCommentsCountByPostId($postPostId)
		);
		echo json_encode($comment_info);
		exit();
	} else {
		echo "error";
		exit();
	}
}


// DELETE
if (isset($_GET['delete_id'])) {

	$id = $_GET['delete_id'];
	$sql = "DELETE FROM $table WHERE id=$id";
	$result = mysqli_query($db, $sql);
	if ($result) {
		$_SESSION['message'] = 'Comentario eliminado correctamente.';
		$_SESSION['type'] = 'success';
	} else {
		$_SESSION['message'] = 'Ha habido un error al intentar eliminar el comentario.';
		$_SESSION['type'] = 'error';
	}

	header('location: ' . BASE_URL . '/admin/comments/index.php');
	
	exit();
}
