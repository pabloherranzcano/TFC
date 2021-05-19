<?php

/*
** Este archivo es en el cargado de mostrarnoss los emails enviados desde el formulario del footer.
*/

include "../../path.php";
include ROOT_PATH . "/app/controllers/contact.php";

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

	<title>EMAIL | Panel de administrador | TFCBLOG</title>
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

				<a href="index.php" class="btn btn-big">Bandeja&nbsp;de&nbsp;entrada</a>
			</div>

			<div class="content">
				<h2 class="page-title">EMAIL</h2>
				<div class="mail">
					<label>Nombre de contacto</label>
					<div class="contactName"><?php echo $name; ?></div>
					<label>Email de contacto</label>
					<div class="contactEmail"> <?php echo $email; ?></div>
					<label>Texto</label>
					<div class="contactBody"><?php echo $body; ?></div>
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