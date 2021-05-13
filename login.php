<?php

/*
** Esta es la pantalla para realizar el login del usuario.
** Llamamos a guestsOnly() del archio middleware, para comprobar
** que el usuario , para comprobar si el usuario está o no logueado.
*/

include "path.php";
include ROOT_PATH . "/app/controllers/users.php";

guestsOnly();
	
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
    <title>Login | TFCBLOG</title>
</head>

<body>
    <!-- HEADER -->
	<?php include ROOT_PATH . "/app/includes/header.php"; ?>
    <!-- // HEADER -->

    <div class="auth-content">
        <form action="login.php" method="POST">
            <h2 class="form-title">LOG IN</h2>
            
			<?php include ROOT_PATH . "/app/helpers/formErrors.php" ?>
			
			<div>
                <label>Nombre de usuario</label>
                <input type="text" name="username" value="<?php echo $username; ?>" id="" class="text-input">
            </div>
            <div>
                <label>Contraseña</label>
                <input type="password" name="password" value="<?php echo $password; ?>" id="" class="text-input">
            </div>
            <div>
                <button type="submit" name="login-btn" class="btn btn-big">Login</button>
            </div>
            <p>O <a href="<?php echo BASE_URL . "/register.php" ?>">Regístrate</a></p>
        </form>
    </div>



    <!-- JQUERY SCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- CUSTOM SCRIPT -->
    <script src="/assets/js/scripts.js"></script>
</body>

</html>