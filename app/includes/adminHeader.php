<!-- ADMIN HEADER -->
<header>
	<div class="logo">
		<a href="<?php echo BASE_URL . '/index.php' ?>">
			<h1 class="logo-text"><span>Pablo</span>Herranz</h1>
			<h5 class="logo-description">Desarrollo de Aplicaciones Web</h5>
		</a>
	</div>
	<i class="fa fa-bars burger"></i>
	<ul class="nav">
		<?php if (isset($_SESSION['id'])) : ?>
			<li>
				<a href="#">
					<i class="fa fa-user"></i>
					<?php echo $_SESSION['username']; ?>
					<i class="fa fa-chevron-down" style="font-size: 0.8em;"></i>
				</a>

				<ul>
					<li><a href="<?php echo BASE_URL . "/logout.php" ?>" class="logout">Log out</a></li>
				</ul>
			</li>
		<?php endif; ?>
	</ul>
</header>
<!-- // ADMIN HEADER -->