<?php

include "path.php";
include ROOT_PATH . "/app/controllers/posts.php";

/* Para que no haya errores, comprobamos que se ha enviado por GET el id del post.
En caso afirmativo, recogemos su valor y la almacenamos en la variable $post. */
if (isset($_GET['id']))
	$post = selectOne('posts', ['id' => $_GET['id']]);

$topics = selectAll('topics');
$posts = selectAll('posts', ['published' => 1]);


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
				</div>
			</div>
			<!-- // Main content -->

			<!-- Sidebar -->
			<div class="sidebar single">
				<!-- Topics -->
				<div class="section popular">
					<div class="section-title">Popular</div>
					<?php foreach ($posts as $p) : ?>
						<div class="post clearfix">
							<img src="<?php echo BASE_URL . '/assets/images/' . $p['image']; ?>" alt="">
							<a href="<?php echo BASE_URL . "/single.php?id=", $p['id']; ?>" class="title">
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
	<!-- FIN FOOTER -->







	<!-- JQUERY SCRIPT -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- SLICK CAROUSEL -->
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

	<!-- CUSTOM SCRIPT -->
	<script src="/assets/js/scripts.js"></script>
</body>

</html>