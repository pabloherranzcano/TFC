<?php include "../../path.php" ?>
<header>
	<a href="<?php echo BASE_URL . '/index.php' ?>" class="logo">
		<h1 class="logo-text"><span>TFC</span>BLOG</h1>
	</a>
	<i class="fa fa-bars burger"></i>
	<ul class="nav">
		<li><a href="/index.php">Home</a></li>
		<li><a href="#">About</a></li>
		<li><a href="#">Services</a></li>

		<!-- Depende de si la sesión está activa (logged in) o no (logged out)
		el header mostrará una cosa u otra.  -->
		<?php if (isset($_SESSION['id'])) : ?>
			<li>
				<a href="#">
					<i class="fa fa-user"></i>
					<?php echo $_SESSION['username']; ?>
					<i class="fa fa-chevron-down" style="font-size: 0.8em;"></i>
				</a>

				<ul>
				<?php if ($_SESSION['admin']) : ?>
					<li><a href="<?php echo BASE_URL . "/admin/dashboard.php" ?>">Dashboard</a></li>
				<?php endif; ?>
					<li><a href="<?php echo BASE_URL . "/logout.php" ?>" class="logout">Log out</a></li>
				</ul>
			</li>
		<?php else: ?>
			<li><a href="<?php echo BASE_URL . "/register.php" ?>">Sign up</a></li>
			<li><a href="<?php echo BASE_URL . "/login.php" ?>">Log in</a></li>
		<?php endif; ?>
	</ul>
</header>
