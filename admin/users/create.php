<?php
include "../../path.php";
include ROOT_PATH . "/app/controllers/users.php";

// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
adminOnly();
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

	<!-- ADMIN CSS -->
	<link rel="stylesheet" href="/assets/css/admin.css">

	<!-- CKEDITOR -->
	<script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>

	<title>ADMIN SECTION – CREATE USERS</title>
</head>

<body>
	<!-- ADMIN HEADER -->
	<?php include ROOT_PATH . "/app/includes/adminHeader.php" ?>
	<!-- // ADMIN HEADER -->

	<!-- PAGE WRAPPER -->
	<div class="admin-wrapper">
		<!-- Left sidebar -->
		<?php include ROOT_PATH . "/app/includes/adminSidebar.php" ?>
		<!-- // Left sidebar -->

		<!-- Admin content -->
		<div class="admin-content">
			<div class="btn-group">
				<a href="create.php" class="btn btn-big">Add User</a>
				<a href="index.php" class="btn btn-big">Manage User</a>
			</div>

			<div class="content">
					<h2 class="page-title">Add User</h2>

					<!-- Comprobamos que no haya ningún campo vacío del formulario, y si lo hay
					mostramos en este div una lista con los errores. -->
					<?php include ROOT_PATH . "/app/helpers/formErrors.php" ?>

				<form action="create.php" method="POST">
					<div>
						<label>Username</label>
						<input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
					</div>
					<div>
						<label>Email</label>
						<input type="text" name="email" value="<?php echo $email; ?>" class="text-input">
					</div>
					<div>
						<label>Password</label>
						<input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
					</div>
					<div>
						<label>Password Confirmation</label>
						<input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text-input">
					</div>
					<div>
					<?php if ($admin == 1) : ?>
							<label>
								<input type="checkbox" name="admin" checked>
								Admin
							</label>
						<?php else : ?>
							<label>
								<input type="checkbox" name="admin">
								Admin
							</label>
						<?php endif; ?>
                    </div>
					<div>
						<button type="submit" name="create-admin" class="btn btn-big">Add user</button>
					</div>
				</form>
			</div>
		</div>
		<!-- // Admin content -->
	</div>
	<!-- // PAGE WRAPPER -->



	<!-- JQUERY SCRIPT -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

	<!-- CUSTOM SCRIPT -->
	<script src="/assets/js/scripts.js"></script>
</body>

</html>