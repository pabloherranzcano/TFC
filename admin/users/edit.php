<?php include "../../path.php"; ?>

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
                <h2 class="page-title">Edit User</h2>

                <form action="create.php" method="POST">
                    <div>
                        <label>Username</label>
                        <input type="text" name="username" id="" class="text-input">
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="text" name="email" id="" class="text-input">
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="text" name="password" id="" class="text-input">
                    </div>
                    <div>
                        <label>Password Confirmation</label>
                        <input type="text" name="passwordConf" id="" class="text-input">
                    </div>
                    <div>
                        <label>Role</label>
                        <select name="topic" class="text-input">
							<option value="Admin">Admin</option>
							<option value="Author">Author</option>
						</select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-big">Update user</button>
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