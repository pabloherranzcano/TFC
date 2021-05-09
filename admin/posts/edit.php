<?php
include "../../path.php";
include ROOT_PATH . "/app/controllers/posts.php";
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

	<title>ADMIN SECTION – EDIT POST</title>
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
                <a href="create.php" class="btn btn-big">Add post</a>
                <a href="index.php" class="btn btn-big">Manage posts</a>
            </div>

            <div class="content">
                <h2 class="page-title">EDIT Posts</h2>

                <form action="create.php" method="POST">
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" class="text-input">
                    </div>
                    <div>
                        <label>Body</label>
                        <textarea name="body" id="body"></textarea>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#body'))
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                    </div>
                    <div>
                        <label>Image</label>
                        <input type="file" name="image" class="text-input">
                    </div>
                    <div>
                        <label>Topic</label>
                        <select name="topic" class="text-input">
							<option value="Poetry">Poetry</option>
							<option value="Guerra">Guerra</option>
						</select>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-big">Update post</button>
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
