<?php

/*
** Este archivo es simplemente para crear la conexión a la base de datos del blog
*/
// LOCAL
// $host = 'localhost';
// $user = 'root';
// $pass = '';
// $db_name = 'tfcblog';

// ONLINE
$host = 'remotemysql.com';
$user = 'O4JnLPhRnn';
$pass = 'YbASczJrKQ';
$db_name = 'O4JnLPhRnn';

$connection = new MySQLi($host, $user, $pass, $db_name);

if ($connection -> connect_error) {
	echo 'Se ha producido un error intentando conectar con la base de datos: ' . $connection -> connect_error;
}

?>