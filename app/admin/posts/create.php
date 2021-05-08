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

    <title>ADMIN SECTION – ADD POSTS</title>
</head>

<body>
    <!-- HEADER -->
    <header>
        <div class="logo">
            <h1 class="logo-text">
                <a href="/app/index.html"><span>TFC</span>BLOG</a>
            </h1>
        </div>
        <i class="fa fa-bars burger"></i>
        <ul class="nav">
            <li>
                <a href="#">
                    <i class="fa fa-user"></i> Username
                    <i class="fa fa-chevron-down" style="font-size: 0.8em;"></i>
                </a>

                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#" class="logout">Log out</a></li>
                </ul>
            </li>
        </ul>
    </header>
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

                <form action="create.html" method="POST">
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
                        <button type="submit" class="btn btn-big">Add post</button>
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