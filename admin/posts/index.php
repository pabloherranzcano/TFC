<?php
include "../../path.php";
include ROOT_PATH . "/app/controllers/posts.php";

// Llamamos a adminOnly(), para comprobar si el usuario tiene o no permisos.
adminOnly();

$records = getPostRecords();
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

	<title>POSTS | Panel de administrador | TFCBLOG</title>
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
				<h2 class="page-title">POSTS</h2>

				<?php include ROOT_PATH . "/app/includes/messages.php"; ?>

				<table>
					<thead>
						<th>#</th>
						<th>Título</th>
						<th colspan='3'>Opciones</th>
					</thead>
					<tbody>
						<?php foreach ($posts as $key => $post) : ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $post['title']; ?></td>
								<td><a href="edit.php?id=-<?php echo $post['id'] ?>-" class="edit">Editar</a></td>
								<td><a href="edit.php?delete_id=<?php echo $post['id'] ?>" class="delete">Eliminar</a></td>
								
								<?php if ($post['published']) : ?>
									<td><a href="edit.php?published=0&p_id=<?php echo $post['id']; ?>" class="unpublish">Ocultar</a></td>
								<?php else : ?>
									<td><a href="edit.php?published=1&p_id=<?php echo $post['id']; ?>" class="publish">Publicar</a></td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
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