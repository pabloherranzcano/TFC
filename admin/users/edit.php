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

	<title>ADMIN SECTION – EDIT USERS</title>
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

				<form action="edit.php" method="POST">
				<!-- Necesario para editarlo, sólo para saber qué user necesitamos editar. Por eo hidden. -->
				<input type="hidden" name="id" value="<?php echo $id; ?>">
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
						<!-- Imaginemos que queremos hacer admin a un usuario normal, para ello necesitaríamos entrar
						en el panel de edición de usuario, con los campos de password y password confirmation rellenos
						con la contraseña original del usuario. Por eso en este caso volvemos a mostrar la contraseña, 
						porque es obvio que si es usuario, es porque ha pasado la validación de ambas contraseñas. -->
						<input type="password" name="passwordConf" value="<?php echo $password; ?>" class="text-input">
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
						<button type="submit" name="update-user" class="btn btn-big">Update user</button>
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