<?php

/*
Incluimos los ficheros db.php y middleware.php con "require_once" para evitar conflictos
con los includes del archivo posts.php que se generan al incluir posts.php encima de
comments.php en el archivo single.php.
*/

require_once ROOT_PATH . "/app/database/db.php";
require_once ROOT_PATH . "/app/helpers/middleware.php";

$table = "comments";

/* Esta variable la utilizaremos en el index del panel de administador de comentarios. */


/* Lo primero que hacemos es darle valor a la variable $user_id, para saber qué usuario escribe
qué comentario */
$user_id = $_SESSION['id'];

/*
** Si quremos, por ejemlo, mostrar los comentarios asociados a un post específico, o contar cuántos
** comentarios en total tiene dicho post deberemos comprobar si isset($_GET['id']) == true. De moddo que
** recogemos por GET el id del post del que queremos información. Más adelante esto no nos servirá cuando hagamos
** la petición por AJAX, y tendremos que volver a recogerlo por POST.
** 
** Recogemos en $getPostId el id del post del que solicitaremos información a la base de datos. Después, recogmos
** todos los comentarios de la base de datos y le damos la vuelta al array para que el último comentario aparezca el primero.
*/
if(isset($_GET['id'])) {
	$getPostId = $_GET['id'];

	$post =	selectOne($table, ['id' => $getPostId]);

	$comments =	array_reverse(selectAll($table, ['post_id' => $getPostId]));

}

/*
** Función que recibe el id de un usuario y devuelve su nombre.
*/
function getUsernameById($id)
{
	global $connection;
	$result = mysqli_query($connection, "SELECT username FROM users WHERE id=$id LIMIT 1");
	
	return mysqli_fetch_assoc($result)['username'];
}

/*
** Función que recibe el id de un post y devuelve el número total de comentarios
** de ese post.
*/
function getCommentsCountByPostId($post_id)
{
	global $connection;
	$result = mysqli_query($connection, "SELECT COUNT(*) AS total FROM comments WHERE post_id=$post_id");
	$data = mysqli_fetch_assoc($result);
	return $data['total'];
}

/*
** En cuanto haga click en enviar comentario, se hará una llamada a "comments.js", la cual es la encargada
** de hacer la llamada AJAX y decir que se ha enviado un comentario (comment_posted = 1). En ese momento,
** nosotros recogermos toda la información del post almacenada en un JSON, y la mostraremos automáticamente, y sin
** refrescar la página, enciama del último post enviado.
**
** Insertamos el comentario con la función create(), pasándole el nombre de la tabla y los datos de $inserted_comment
*/
// $result = create($table, $_POST);
// $inserted_comment = selectAll($table, ['id' => $inserted_id]);
if (isset($_POST['comment_posted'])) {
	global $connection;
	
	// Recogeemos el id del post y el texto del comentario .
	$postPostId = $_POST['postId'];
	$comment_text = $_POST['comment_text'];

	// Insertamos el comentario en la base de datos.
	$sql = "INSERT INTO comments (post_id, user_id, body, created_at) VALUES ($postPostId, $user_id, '$comment_text', now());";
	$result = mysqli_query($connection, $sql);

	// Insertamos el comentario que vamos a mostrar posteriormente.
	$inserted_id = $connection->insert_id;
	$res = mysqli_query($connection, "SELECT * FROM comments WHERE id=$inserted_id");
	$inserted_comment = mysqli_fetch_assoc($res);

	// Si se ha insertado con éxito, recogemos el comentario de la base de datos, y lo devolvemos a la web.
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
	$count = delete($table, $id);
	if ($count) {
		$_SESSION['message'] = 'Comentario eliminado correctamente.';
		$_SESSION['type'] = 'success';
	} else {
		$_SESSION['message'] = 'Ha habido un error al intentar eliminar el comentario.';
		$_SESSION['type'] = 'error';
	}

	header('location: ' . BASE_URL . '/admin/comments/index.php');
	
	exit();
}
