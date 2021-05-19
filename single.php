<?php

include "path.php";
include ROOT_PATH . "/app/controllers/posts.php";
include ROOT_PATH . "/app/controllers/comments.php";

/* Para que no haya errores, comprobamos que se ha enviado por GET el id del post.
En caso afirmativo, recogemos su valor y la almacenamos en la variable $post. */
if (isset($_GET['id']))
	$post = selectOne('posts', ['id' => $_GET['id']]);

$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);

$topic_id = $_GET['topic_id'];
$postsTopic = selectAll('posts', ['topic_id' => $topic_id]);
$topicName = selectOne('topics', ['id' => $topic_id]);
$topicName = $topicName['name'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- FontAwesome -->
	<script src="https://kit.fontawesome.com/434ac71e85.js" crossorigin="anonymous"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="/assets/css/style.css">
	<link rel="stylesheet" href="/assets/css/comments.css">
	<title><?php echo $post['title']; ?> | TFCBlog</title>
</head>

<body>
	<!-- HEADER -->
	<?php include ROOT_PATH . "/app/includes/header.php"; ?>
	<!-- // HEADER -->



	<!-- PAGE WRAPPER -->
	<div class="page-wrapper">

		<!-- CONTENT -->

		<div class="content clearfix">
			<!-- Main content wrapper -->
			<div class="main-content-wrapper">

				<div class="main-content single">
					<img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="single-img" alt="">
					<h1 class="post-title"><?php echo $post['title']; ?></h1>
					<div class="post-content">
						<?php echo html_entity_decode($post['body']); ?>
					</div>

					<!-- COMMENTS -->
					<div class="comments-section">
						<!-- Si el usuario no se está logueado, le decimos que se loguee o registre. -->
						<?php if (isset($user_id)) : ?>
							<form class="clearfix" action="single.php" method="POST" id="comment_form">
								<input type="text" id="postPostId" value="<?php echo $_GET['id'] ?>" hidden>
								<textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
								<button class="btn btn-primary btn-sm pull-right" id="submit_comment">Enviar comentario</button>
							</form>
						<?php else : ?>
							<div class="well">
								<h4 class="text-center">Debes <a href="register.php">registrarte</a> o <a href="login.php">loguearte</a> para comentar</h4>
							</div>
						<?php endif ?>
						<!-- Mostramos el total de comentarios de este post -->
						<h2><span id="comments_count"><?php echo count($comments) ?></span> Comentario(s)</h2>
						<hr>
						<!-- Comments wrapper -->
						<div id="comments-wrapper">
							<?php if (isset($comments)) : ?>
								<!-- Bucle Foreach para mostrar los comentarios -->
								<?php foreach ($comments as $comment) : ?>
									<!-- Comentario -->
									<div class="comment clearfix">
										<img src="../../assets/images/profile.png" alt="" class="profile_pic">
										<div class="comment-details">
											<span class="comment-name"><?php echo getUsernameById($comment['user_id']) ?></span>
											<span class="comment-date"><?php echo date("F j, Y ", strtotime($comment["created_at"])); ?></span>
											<p><?php echo $comment['body']; ?></p>
										</div>
									</div>
									<!-- // Comentario -->
								<?php endforeach ?>
							<?php else : ?>
								<h2>¡Sé el primero en comentar este post!</h2>
							<?php endif ?>
						</div>
						<!-- // Comments wrapper -->
					</div>
					<!-- // COMMENTS -->
				</div>
			</div>
			<!-- // Main content -->

			<!-- Sidebar -->
			<div class="sidebar single">
				<!-- Topics -->
				<div class="section popular">
					<div class="section-title">
						<h2><?php echo "\"$topicName\""; ?></h2>
					</div>
					<?php foreach ($postsTopic as $p) : ?>
						<div class="post clearfix">
							<img src="<?php echo BASE_URL . '/assets/images/' . $p['image']; ?>" alt="">
							<a href="<?php echo BASE_URL . "/single.php?id=" . $p['id']  . "&topic_id=" . $p['topic_id']; ?>" class="title">
								<h4><?php echo $p['title']; ?></h4>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
				<div class="section topics">
					<h2 class="section-title">TOPICS</h2>
					<ul>
						<?php foreach ($topics as $key => $topic) : ?>
							<li><a href="<?php echo BASE_URL . "/index.php?topic_id=" . $topic['id'] . "&name=" . $topic['name']; ?>"><?php echo $topic['name']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<!-- // Sidebar -->
		</div>
		<!-- // CONTENT -->

	</div>
	<!-- // PAGE WRAPPER -->

	<!-- FOOTER -->
	<?php include ROOT_PATH . "/app/includes/footer.php"; ?>
	<!-- // FOOTER -->







	<!-- JQUERY SCRIPT -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- SLICK CAROUSEL -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

	<!-- CUSTOM SCRIPT -->
	<script src="/assets/js/scripts.js"></script>

	<!-- COMENTARIOS -->
	<script src="/assets/js/comments.js"></script>
</body>

</html>