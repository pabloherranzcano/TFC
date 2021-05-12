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
 
/********************************************/
/**************** C R E A T E ***************/
/********************************************/
/* 
** Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
** 
** Comprobamos que haya una imagen seleccionada. No pueden tener el mismo nombre por lo que usamos la función time() para que
** tengan siempre un nombre diferente (empezarán con la hora y día en que se subió) seguido del nombre original.
** 
** Si se ha subido con éxito
** 
** Como es inseguro dejar etiquetas html en la base de datos, le aplicamos un paso extra de seguridad con el método 
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
	
	if(!empty($_FILES['image']['name'])) {
		$image_name = time() . '_' . $_FILES['image']['name'];
		$destination = ROOT_PATH . "/assets/images/" . $image_name;

		$result = move_uploaded_file($_FILES['image']['tmp_name'], $destination); 
		
		if($result) {
			$_POST['image'] = $image_name;
		}
		else {
			array_push($errors, "Ha habido un error al subir la imagen.");
		}
	}
	else
		array_push($errors, "Es necesario subir una imagen.");

	if (count($errors) == 0) {
		unset($_POST['add-post']);
		$_POST['user_id'] = $_SESSION['id'];
		$_POST['published'] = isset($_POST['published']) ? 1 : 0; // Ternario: si se ha marcado la opción de publicarlo, le asignamos 1, si no, 0.
		

		$post_id = create($table, $_POST);

		$_SESSION['message'] = 'Post creado correctamente.';
		$_SESSION['type'] = 'success';

		header('location: ' . BASE_URL . '/admin/posts/index.php');
	}
	else{
		$title = $_POST['title'];
		$body = $_POST['body'];
		$topic_id = $_POST['topic_id'];

		$published = isset($_POST['published']) ? 1 : 0;;
	}
}


/********************************************/
/****************** R E A D *****************/
/********************************************/
if (isset($_GET['id'])){
	$post =	selectOne($table, ['id' => $_GET['id']]);
	// printData($post);

	$id = $_GET['id'];
	$title = $post['title'];
	$body = $post['body'];
	$topic_id = $post['topic_id'];
	$published = $post['published'];
}

/********************************************/
/**************** U P D A T E ***************/
/********************************************/
if (isset($_POST['update-post'])) {
	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();
	
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
			array_push($errors, "Ha habido un error al subir la imagen.");
		}
	}
	else
		array_push($errors, "Es necesario subir una imagen.");

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

/********************************************/
/**************** D E L E T E ***************/
/********************************************/
if (isset($_GET['delete_id'])){

	// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
	adminOnly();

	$id = $_GET['delete_id'];
	$count = delete($table, $id);
	
	$_SESSION['message'] = 'Post eliminado con éxito.';
	$_SESSION['type'] = 'success';
	
	header('location: ' . BASE_URL . '/admin/posts/index.php');
}

// PUBLISH
if (isset($_GET['published']) && isset($_GET['p_id'])){
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

/*
Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur atque ab dolorem minus illum eligendi debitis, ducimus omnis voluptate veniam error consequatur necessitatibus a nihil expedita laboriosam! Quasi facere illo impedit officiis sit adipisci officia, tenetur magni, neque dicta animi. Veniam facere repudiandae cum quod, voluptates odio soluta magni sequi tenetur amet, illum provident doloremque. Exercitationem voluptatum voluptates nulla laudantium et itaque voluptas! Odio beatae fuga enim eaque. Magnam facere fugit deserunt sit consequatur iure. Quo, eligendi? Necessitatibus mollitia sed inventore error, porro architecto ipsum blanditiis voluptatem incidunt quas laboriosam sit culpa debitis autem accusamus neque ipsa expedita reiciendis repellat nobis temporibus vitae! Atque laudantium est ea sequi vero quis iure similique at corporis. Deleniti, porro.

Sequi accusantium eos nisi exercitationem aperiam repudiandae voluptates repellat odio possimus quibusdam aliquid velit perferendis necessitatibus hic, aliquam accusamus sint praesentium a temporibus aspernatur quae porro suscipit. Hic iure aspernatur exercitationem consectetur quam amet quis, animi, aut ducimus repellat quia quo ullam dolores ipsam mollitia temporibus perspiciatis? Aut corrupti, repellat animi placeat corporis, nesciunt maxime, expedita modi dolore magni voluptatum? Minus ipsam officiis porro quos temporibus dicta, iusto voluptate repellat reiciendis accusamus recusandae, molestias quae soluta, labore eaque pariatur fugiat velit eligendi sit nesciunt veritatis odit nihil excepturi.

Quidem cum sed atque cupiditate necessitatibus tempore enim repudiandae! Vel, facere excepturi optio impedit perspiciatis neque nobis sapiente amet ullam dignissimos molestias ipsum similique nulla facilis dolorem dolore, alias maiores inventore officia nisi suscipit porro blanditiis aperiam? Repellendus quae expedita possimus, ea velit deleniti, voluptatum tenetur recusandae suscipit illo est impedit quisquam eaque provident omnis. Est eos animi nam mollitia reiciendis necessitatibus atque corrupti tenetur modi molestiae, sit iusto magnam molestias eligendi aliquam quis obcaecati perferendis cupiditate libero cumque. Molestiae facere saepe nostrum expedita, natus quidem laborum tempore consequuntur, labore, voluptatibus ad unde in ab reiciendis aliquid delectus ratione inventore ducimus provident odio soluta officiis. Nulla culpa totam cum illo itaque animi.

Recusandae odit eos dolorem, vel libero mollitia quia est placeat neque eum alias, quae repellendus molestias tempora maxime dolorum eveniet officia voluptate sunt. Laboriosam, iste provident. Doloribus maiores qui reiciendis? In quia cum aliquid error! Delectus alias, eveniet sed reiciendis magnam nemo in nam debitis amet adipisci ratione, quae ad vero repudiandae ullam quas iusto ipsa repellendus animi maxime odio deserunt ipsum praesentium voluptate? At voluptatem facere similique maiores, provident obcaecati incidunt iure blanditiis non, dolor, natus eligendi nemo tempora fugiat temporibus minima ratione necessitatibus quisquam voluptates possimus sequi! Commodi velit neque, eligendi pariatur dicta eaque ducimus. Dolorum impedit, officia aut magni eligendi dolor, inventore eveniet iure optio ullam suscipit labore quisquam aperiam incidunt! Delectus amet consequatur cum quia soluta!

Quia facilis iusto at id, ex, optio ad sint minus quae exercitationem minima adipisci fuga? Aut, placeat nulla at accusamus alias ipsa voluptas quas repellat cum porro vero accusantium distinctio velit itaque. Ut, inventore adipisci quos veritatis neque magni perspiciatis ipsa minus maxime. Nam maiores sed reiciendis omnis, fugiat eveniet, laboriosam atque asperiores placeat maxime itaque nobis? Ut dolorem adipisci iusto hic accusantium optio?
*/