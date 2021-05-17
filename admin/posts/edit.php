<?php
include "../../path.php";
include ROOT_PATH . "/app/controllers/posts.php";

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
	<script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>

	<title>EDITAR POST | Panel de administrador | TFCBLOG</title>
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

			<div class="content">
				<h2 class="page-title">EDITAR POST</h2>
				
				<!-- Comprobamos que no haya ningún campo vacío del formulario, y si lo hay
				mostramos en este div una lista con los errores. -->
				<?php include ROOT_PATH . "/app/helpers/formErrors.php" ?>
				
					<!-- Enctype para poder subir imágenes -->
					<form action="edit.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<div>
						<label>Título</label>
						<input type="text" name="title" value="<?php echo $title; ?>" class="text-input">
					</div>
					<div>
						<label>Texto</label>
						<textarea name="body" id="body"><?php echo $body; ?></textarea>
						<script>
							ClassicEditor
								.create(document.querySelector('#body'))
								.catch(error => {
									console.error(error);
								});
						</script>
					</div>
					<div>
						<label>Imagen</label>
						<input type="file" name="image" value="<?php echo BASE_URL . '/assets/images/' . $post['image']; ?>" class="text-input">
					</div>
					<div>
						<label>Categoría</label>
						<select name="topic_id" class="text-input">
							<option value=""></option>
							<?php foreach ($topics as $key => $topic) : ?>

								<?php if (!empty($topic_id) && $topic_id == $topic['id']) : ?>
									<option selected value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>
								<?php else : ?>
									<option value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>
								<?php endif; ?>
								<!-- Como queremos que se nos muestren las categorías en el select... -->
							<?php endforeach; ?>

						</select>
					</div>
					<div>
						<?php if (empty($published) && $published == 0) : ?>
							<label>
								<input type="checkbox" name="published">
								Publicar
							</label>
						<?php else : ?>
							<label>
								<input type="checkbox" name="published" checked>
								Publicar
							</label>
						<?php endif; ?>
					</div>
					<div>
						<button type="submit" name="update-post" class="btn btn-big">Update post</button>
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