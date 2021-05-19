<?php

/*
** Este archivo es simplemente para crear la conexión a la base de datos del blog
*/

include "config.php";

$connection = new MySQLi($host, $user, $pass, $db_name);

if ($connection -> connect_error) {
	echo 'Se ha producido un error intentando conectar con la base de datos: ' . $connection -> connect_error;
}

?>
