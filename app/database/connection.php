<?php

/*
** Este archivo es simplemente para crear la conexión a la base de datos del blog
*/

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'tfcblog';

$connection = new MySQLi($host, $user, $pass, $db_name);

if ($connection -> connect_error) {
	echo 'Se ha producido un error intentando conectar con la base de datos: ' . $connection -> connect_error;
}

?>