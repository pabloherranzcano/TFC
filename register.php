<?php include "path.php"; ?>
<?php include "app/controllers/users.php"; ?>

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
    <title>REGISTRO</title>
</head>

<body>
    <!-- HEADER -->
	<?php include ROOT_PATH . "/app/includes/header.php"; ?>
    <!-- // HEADER -->

    <div class="auth-content">
        <form action="register.php" method="POST">
            <h2 class="form-title">REGISTRO</h2>

            <!-- <div class="msg success error">
                <li>Username required</li>
            </div> -->
            
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
                <button type="submit" name="register-btn" class="btn btn-big">Register</button>
            </div>
            <p>Or <a href="<?php echo BASE_URL . "/login.php" ?>">Log in</a></p>
        </form>
    </div>



    <!-- JQUERY SCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- CUSTOM SCRIPT -->
    <script src="/assets/js/scripts.js"></script>
</body>

</html>