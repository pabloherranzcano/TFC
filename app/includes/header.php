<?php include "../../path.php"; ?>
<header>
	<div class="logo">
		<a href="<?php echo BASE_URL . '/index.php' ?>">
			<h1 class="logo-text"><span>Pablo</span>Herranz</h1>
			<h5 class="logo-description">Desarrollo de Aplicaiones Web</h5>
		</a>
	</div>
	<i class="fa fa-bars burger"></i>
	<ul class="nav">
		<li><a href="/index.php">Home</a></li>
		<li><a href="#">Noticias</a></li>
		<li><a href="#">Vlog</a></li>

		<!-- Depende de si la sesión está activa (logged in) o no (logged out)
		el header mostrará una cosa u otra.  -->
		<?php if (isset($_SESSION['id'])) : ?>
			<li>
				<a href="#">
					<i class="fa fa-user"></i> &nbsp;
					<?php echo $_SESSION['username']; ?>
					<i class="fa fa-chevron-down" style="font-size: 0.8em;"></i>
				</a>

				<ul>
					<?php if ($_SESSION['admin']) : ?>
						<li><a href="<?php echo BASE_URL . "/admin/dashboard.php" ?>">Dashboard</a></li>
					<?php endif; ?>
					<li><a href="<?php echo BASE_URL . "/logout.php" ?>" class="logout">Cerrar sesión</a></li>
				</ul>
			</li>
		<?php else : ?>
			<li><a href="<?php echo BASE_URL . "/register.php" ?>">Registrarse</a></li>
			<li><a href="<?php echo BASE_URL . "/login.php" ?>">Iniciar sesión</a></li>
		<?php endif; ?>
	</ul>
</header>