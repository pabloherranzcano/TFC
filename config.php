<?php 

/*******************************************************/
/************************* PATH ************************/
/*******************************************************/

// En local. Cambiar el número de puerto en caso necesario.
$path = "http://localhost:3000";

// Deplyed en heroku.
$path = "https://pabloherranzcano.herokuapp.com";

/*******************************************************/
/*** Variables para la conexión con la base de datos ***/
/*******************************************************/


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

?>