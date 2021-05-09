<?php 

include ROOT_PATH . "/app/database/db.php";
include ROOT_PATH . "/app/helpers/validatePost.php";

$table = 'posts';

// Para mostrar los topics en el select de create.php de posts
$topics = selectAll('topics');
$posts = selectAll('posts');

$errors = array();

// CREATE
if (isset($_POST['add-post'])) {
	unset($_POST['topic_id'], $_POST['add-post']);
	$_POST['user_id'] = 1;
	$_POST['published'] = 1;
	$post_id = create($table, $_POST);

	header('location: ' . BASE_URL . '/admin/posts/index.php');

}

?>