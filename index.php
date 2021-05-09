<?php
include "path.php";
include ROOT_PATH . "/app/controllers/topics.php";
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

			<div class="post-wrapper">
				<div class="post">
					<img src="/assets/images/image1.png" alt="" class="slider-img">
					<div class="post-info">
						<h4><a href="#">1er post!!</a></h4>
						<i class="far fa-user">Pablito</i>
						<i class="far fa-calendar">27 abril 2021</i>
					</div>
				</div>
				<div class="post">
					<img src="/assets/images/image1.png" alt="" class="slider-img">
					<div class="post-info">
						<h4><a href="#">2o post!!</a></h4>
						<i class="far fa-user">Pablito</i>
						<i class="far fa-calendar">27 abril 2021</i>
					</div>
				</div>
				<div class="post">
					<img src="/assets/images/image1.png" alt="" class="slider-img">
					<div class="post-info">
						<h4><a href="#">3o post!!</a></h4>
						<i class="far fa-user">Pablito</i>
						<i class="far fa-calendar">27 abril 2021</i>
					</div>
				</div>
				<div class="post">
					<img src="/assets/images/image1.png" alt="" class="slider-img">
					<div class="post-info">
						<h4><a href="#">4o post!!</a></h4>
						<i class="far fa-user">Pablito</i>
						<i class="far fa-calendar">27 abril 2021</i>
					</div>
				</div>
				<div class="post">
					<img src="/assets/images/image1.png" alt="" class="slider-img">
					<div class="post-info">
						<h4><a href="#">5o post!!</a></h4>
						<i class="far fa-user">Pablito</i>
						<i class="far fa-calendar">27 abril 2021</i>
					</div>
				</div>
			</div>
		</div>
		<!-- // Post slider -->


		<!-- CONTENT -->

		<div class="content clearfix">
			<!-- Main content -->
			<div class="main-content">
				<h1 class="recent-post-title">RECENT POSTS</h1>

				<!-- Post -->
				<div class="post clearfix">
					<img src="/assets/images/image1.png" alt="" class="post-img">
					<div class="post-preview">
						<h2><a href="#">Titleeeeeeeeeeeeeeeeee</a></h2>
						<i class="far fa-user">Pablito</i> &nbsp;
						<i class="far calendar">27 abril 2021</i>
						<p class="prevew-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime dignissimos nemo non obcaecati aperiam dolores! Laborum recusandae sint hic earum, blanditiis
						</p>
						<a href="#" class="btn read-more">Read more...</a>
					</div>
				</div>
				<!-- // Post -->

				<!-- Post -->
				<div class="post clearfix">
					<img src="/assets/images/image1.png" alt="" class="post-img">
					<div class="post-preview">
						<h2><a href="#">Titleeeeeeeeeeeeeeeeee</a></h2>
						<i class="far fa-user">Pablito</i> &nbsp;
						<i class="far calendar">27 abril 2021</i>
						<p class="prevew-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime dignissimos nemo non obcaecati aperiam dolores! Laborum recusandae sint hic earum, blanditiis
						</p>
						<a href="#" class="btn read-more">Read more...</a>
					</div>
				</div>
				<!-- // Post -->

				<!-- Post -->
				<div class="post clearfix">
					<img src="/assets/images/image1.png" alt="" class="post-img">
					<div class="post-preview">
						<h2><a href="#">Titleeeeeeeeeeeeeeeeee</a></h2>
						<i class="far fa-user">Pablito</i> &nbsp;
						<i class="far calendar">27 abril 2021</i>
						<p class="prevew-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime dignissimos nemo non obcaecati aperiam dolores! Laborum recusandae sint hic earum, blanditiis
						</p>
						<a href="#" class="btn read-more">Read more...</a>
					</div>
				</div>
				<!-- // Post -->

			</div>
			<!-- // Main content -->

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Buscador -->
				<div class="section search">
					<h2 class="section-title">SEARCH</h2>
					<form action="index.html" method="POST">
						<input type="text" name="search-term" class="text-input" placeholder="Search...">
					</form>
				</div>
				<!-- Topics -->
				<div class="section topics">
					<h2 class="section-title">TOPICS</h2>
					<ul>
						<?php foreach ($topics as $key => $topic) : ?>
							<li><a href="#"><?php echo $topic['name']; ?></a></li>
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