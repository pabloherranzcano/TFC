<?php 
/*
** Aquí empieza todo. Para no tener problemas con las rutas relativas, tenemos que definir
** en el archivo path.php dos variables que nos permitirán que todo funcione. En este apartado
** le tienes que decir a la web si estás en local o deployed. Al igual que decirle dóndee está
** la base de datos en donde se almacena toda la información. 
** 
** Todo está preconfigurado para funcionar correctamente desplegada en heroku.
*/

/*******************************************************/
/************************* PATH ************************/
/*******************************************************/

// En local. Cambiar el número de puerto al puerto deseado.
$path = "http://localhost:3000";

// Deployed en heroku.
// $path = "https://pabloherranzcano.herokuapp.com";

/*******************************************************/
/*** Variables para la conexión con la base de datos ***/
/*******************************************************/

/* LOCAL */
// $host = 'localhost';
// $user = 'root';
// $pass = '';
// $db_name = 'tfcblog';

/* DEPLOYED */
$host = 'remotemysql.com';
$user = 'O4JnLPhRnn';
$pass = 'YbASczJrKQ';
$db_name = 'O4JnLPhRnn';
