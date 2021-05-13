<?php

/*
** Este archivo es simplemente para crear la conexión a la base de datos del blog
** Si queremos trabajar en local y ver nuestros cambios en local, comentaremos el código
** debajo de DEPLOYED. Por el contrario, si queremos conectar a la base de datos desplegada
** en https://remotemysql.com/, lo descomentaremos.
*/

/* LOCAL */
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'tfcblog';

/* DEPLOYED */
$host = 'remotemysql.com';
$user = 'O4JnLPhRnn';
$pass = 'YbASczJrKQ';
$db_name = 'O4JnLPhRnn';

$connection = new MySQLi($host, $user, $pass, $db_name);

if ($connection -> connect_error) {
	echo 'Se ha producido un error intentando conectar con la base de datos: ' . $connection -> connect_error;
}

?>
