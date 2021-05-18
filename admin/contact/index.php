<?php

include "../../path.php"; 
include ROOT_PATH . "/app/controllers/contact.php";

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

	<title>BANDEJA DE ENTRADA | Panel de administrador | TFCBLOG</title>
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


            <div class="content">
                <h2 class="page-title">BANDEJA DE ENTRADA</h2>

				<?php include ROOT_PATH . "/app/includes/messages.php"; ?>

                <table>
                    <thead>
                        <th>#</th>
                        <th>#Email</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Body</th>
						<th colspan='2' class="actions">Opciones</th>
                    </thead>
                    <tbody>
						<?php foreach ($emailsContact as $key => $email): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $email['name']; ?></td>
								<td><?php echo $email['email']; ?></td>
								<td><?php echo $email['body']; ?></td>
								<td><a href="index.php?delete_id=<?php echo $email['id']; ?>" class="delete">Visualizar</a></td>
								<td><a href="index.php?delete_id=<?php echo $email['id']; ?>" class="delete">Eliminar</a></td>
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