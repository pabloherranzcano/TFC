<?php
include "../../path.php";
include ROOT_PATH . "/app/controllers/topics.php";

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

	<title>TOPICS | Panel de administrador | TFCBLOG</title>
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
				<a href="create.php" class="btn btn-big">Crear&nbsp;post</a>
				<a href="index.php" class="btn btn-big">Administrar&nbsp;posts</a>
			</div>

			<h2 class="page-title">EDITAR TOPIC</h2>

			<div class="content">

				<!-- Comprobamos que no haya ningún campo vacío del formulario, y si lo hay
				mostramos en este div una lista con los errores. -->
				<?php include ROOT_PATH . "/app/helpers/formErrors.php" ?>

				<form action="edit.php" method="POST">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div>
						<label>Name</label>
						<input type="text" name="name" value="<?php echo $name; ?>" class="text-input">
					</div>
					<div>
						<label>Description</label>
						<textarea name="description" id="description"><?php echo $description; ?></textarea>
						<script>
							ClassicEditor
								.create(document.querySelector('#description'))
								.catch(error => {
									console.error(error);
								});
						</script>
					</div>
					<div>
						<button type="submit" name="update-topic" class="btn btn-big">Actualizar topic</button>
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