<?php

/*
** Como hay varios directorios a los que apuntamos a 
** través de hipervínculos, creamos las constante ROOT_PATH
** y BASE_URL para no liarnos con las rutas relativas.
**
** De igual forma que en el archivo connection.php, si queremos trabajar en local
** y ver nuestros cambios en local, reemplazaremos la variable dentro del "define" de
** BASE_URL (prestando atención a que sea ese el puerto en el que estamos corriendo nuestro
** servidor). Por el contrario, si queremos que todos los enlaces funcionen en la web desplegada
** en "https://pabloherranzcano.herokuapp.com/", descomentaremos el código debajo de
** DEPLOYED.
*/

$local = "http://localhost:3000";
$heroku = "https://pherranz.herokuapp.com";

/* BASE_URL */
define("BASE_URL", $heroku);

/* ROOT_URL */
define("ROOT_PATH", realpath(dirname(__FILE__)));

