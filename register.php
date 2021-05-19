<?php
include "path.php";
include ROOT_PATH . "/app/controllers/users.php";

// Llamamos a guestsOnly(), para comprobar si el usuario está o no logueado.
guestsOnly();

?>

<!DOCTYPE html>
<html lang="en">

<head
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/434ac71e85.js" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Registro | TFCBLOG</title>
</head>

<body>
    <!-- HEADER -->
	<?php include ROOT_PATH . "/app/includes/header.php"; ?>
    <!-- // HEADER -->

    <div class="auth-content">
        <form action="register.php" method="POST">
            <h2 class="form-title">REGISTRO</h2>

			<!-- Comprobamos que no haya ningún campo vacío del formulario, y si lo hay
			mostramos en este div una lista con los errores. -->
			<?php include ROOT_PATH . "/app/helpers/formErrors.php" ?>
			            
			<div>
                <label>Nombre de usuario</label>
                <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
            </div>
            <div>
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email; ?>" class="text-input">
            </div>
            <div>
                <label>Contraseña</label>
                <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
            </div>
            <div>
                <label>Confirma la contraseña</label>
                <input type="password" name="passwordConf" value="<?php echo $passwordConf; ?>" class="text-input">
            </div>
			<div>
                <label>¿Cuánto es <?php echo $captcha[0] ?> + <?php echo $captcha[1] ?>?</label>
                <input type="number" name="captcha" class="text-input">
				<input type="hidden" name="captchaResult" value="<?php echo $captcha[0] + $captcha[1] ?>">
            </div>
			
            <div>
                <button type="submit" name="register-btn" class="btn btn-big auth-btn">Registrarse</button>
            </div>
            <p>ó <a href="<?php echo BASE_URL . "/login.php" ?>">Loguéate</a></p>
        </form>
    </div>



    <!-- JQUERY SCRIPT -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- CUSTOM SCRIPT -->
    <script src="/assets/js/scripts.js"></script>
</body>

</html>