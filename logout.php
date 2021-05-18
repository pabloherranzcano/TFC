<?php 

/*
** Archivo para realizar el logout del usuario. Para ello, una vez
** la sesión esté iniciada o reanudada (ya viene así por el session_start()
** ejecutado en el archivo db.php), borramos con la función unset todos los
** parámetros de la variable global $_SESSION.
*/

include "path.php";
include ROOT_PATH . "/app/database/db.php";

// session_start();

unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['admin']);
unset($_SESSION['message']);
unset($_SESSION['type']);
session_destroy();

header('location: ' . BASE_URL . '/index.php');


?>