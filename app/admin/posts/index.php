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

    <title>ADMIN SECTION – MANAGE POSTS</title>
</head>

<body>
    <!-- HEADER -->
	<?php include "../../includes/header.php"; ?>
    <!-- // HEADER -->



    <!-- PAGE WRAPPER -->
    <div class="admin-wrapper">
        <!-- Left sidebar -->
        <div class="left-sidebar">
            <ul>
                <li><a href="index.html">Manage posts</a></li>
                <li><a href="../users/index.html">Manage users</a></li>
                <li><a href="../topics/index.html">Manage topics</a></li>
            </ul>
        </div>
        <!-- // Left sidebar -->

        <!-- Admin content -->
        <div class="admin-content">
            <div class="btn-group">
                <a href="create.html" class="btn btn-big">Add post</a>
                <a href="index.html" class="btn btn-big">Manage posts</a>
            </div>

            <div class="content">
                <h2 class="page-title">Manage Posts</h2>

                <table>
                    <thead>
                        <th>SN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th colspan='3'>Action</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Title of the post</td>
                            <td>Author</td>
                            <td><a href="" class="edit">Edit</a></td>
                            <td><a href="" class="delete">Delete</a></td>
                            <td><a href="" class="publish">Publish</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Title of the post</td>
                            <td>Marvin</td>
                            <td><a href="" class="edit">Edit</a></td>
                            <td><a href="" class="delete">Delete</a></td>
                            <td><a href="" class="publish">Publish</a></td>
                        </tr>
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