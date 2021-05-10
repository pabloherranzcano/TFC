<?php
include "path.php";
include ROOT_PATH . "/app/controllers/topics.php";

/* Lo primero, hacemos fetch de todos los posts de la base de datos que
queremos que se muestren (publish = 1). 

$posts = selectAll('posts', ['published' => 1]);

Eso sería lo lógico, pero en cambio llamamos a la fución getPublishedPosts,
ya que con ella se nos incluirá el nombre de usuario que ha publicado los
posts por el método POST.
*/
$posts = array();
// Para mostrar "Posts de temática ...", "Posts recientes" o "Resultados de búsqueda".
$postsTitle = "Recent posts";

if (isset($_GET['topic_id']))
{
	$posts = getPostsByTopic($_GET['topic_id']);
	$postsTitle = "You searched for posts under '" . $_GET['name'] . "'";
}
else if(isset($_POST['search-term']))
{
	$postsTitle = "You searched for '" . $_POST['search-term'] . "'";
	$posts = searchPosts($_POST['search-term']);
}
else {
	$posts = getPublishedPosts();
}
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
	<title>TFCBLOG</title>
</head>

<body>

	<!-- HEADER -->
	<?php include ROOT_PATH . "/app/includes/header.php"; ?>
	<?php include ROOT_PATH . "/app/includes/messages.php"; ?>
	<!-- // HEADER -->

	<!-- PAGE WRAPPER -->
	<div class="page-wrapper">

		<!-- Post slider -->
		<div class="post-slider">
			<h1 class="slider-title">TRENDING POSTS</h1>

			<!-- Botones del slider -->
			<i class="fas fa-chevron-left prev"></i>
			<i class="fas fa-chevron-right next"></i>
			<!-- // Botones del slider -->

			<!-- Post-wrapper -->
			<div class="post-wrapper">
				<?php foreach ($posts as $post) : ?>
					<div class="post">
						<img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="slider-img">
						<div class="post-info">
							<!-- Tenemos que enviar el id del post para recoger ese post específico de la base de datos y mostrarlo
							en single.php -->
							<h4><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h4>
							<i class="far fa-user"><?php echo $post['username']; ?></i>
							<!-- Para mostrar la fecha de creaciónd el post, usamos la función date, a la que pasaremos la forma
							en la que queremos que se muestre la fecha, y el string de la fecha -->
							<i class="far calendar"><?php echo date('j F, Y', strtotime($post['created_at'])); ?></i>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<!-- // Post-wrapper -->
		</div>
		<!-- // Post slider -->


		<!-- CONTENT -->

		<div class="content clearfix">
			<!-- Main content -->
			<div class="main-content">
				<h1 class="recent-post-title"><?php echo $postsTitle; ?></h1>

				<?php foreach ($posts as $post) : ?>
				<!-- Post -->
				<div class="post clearfix">
					<img src="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" alt="" class="post-img">
					<div class="post-preview">
						<h2><a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a></h2>
						<i class="far fa-user"><?php echo $post['username']; ?></i>
						&nbsp;
						<i class="far calendar"><?php echo date('j F, Y', strtotime($post['created_at'])); ?></i>
						<!-- Utilzamos la función substr para cortar mostrar un preview del texto del post.
						La función html_entity_decode nos permie deshacenos de las etiquetas html que se guardan por
						defecto en la base de datos a la hora de crear un pos. -->
						<p class="preview-text">
							<?php echo html_entity_decode(substr($post['body'], 0, 130). '...'); ?>
						</p>
						<a href="single.html?id=<?php echo $post['id']; ?>" class="btn read-more">Read more...</a>
					</div>
				</div>
				<!-- // Post -->
				<?php endforeach; ?>



			</div>
			<!-- // Main content -->

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Buscador -->
				<div class="section search">
					<h2 class="section-title">SEARCH</h2>
					<form action="index.php" method="POST">
						<input type="text" name="search-term" class="text-input" placeholder="Search...">
						<!-- No es necesario un botón, porque al darle a intro, se envía el formulario -->
					</form>
				</div>
				<!-- Topics -->
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
	<!-- FIN FOOTER -->







	<!-- JQUERY SCRIPT -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- SLICK CAROUSEL -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

	<!-- CUSTOM SCRIPT -->
	<script src="/assets/js/scripts.js"></script>
</body>

</html>