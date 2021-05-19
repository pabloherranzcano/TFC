<?php

/*
** Como hay varios directorios a los que apuntamos a través de hipervínculos,
** creamos las constante ROOT_PATH y BASE_URL para no liarnos con las rutas
** relativas, y todo pueda funcionar perfectamentee... Básicamente, BASE_URL es
** para todo lo que implique mostrar imágenes o navegar por la web, para que el
** navegador sepa a dónde ir, y ROOT_PATH es para los includes.
*/

include "config.php";

/* BASE_URL */
define("BASE_URL", $path);

/* ROOT_URL */
define("ROOT_PATH", realpath(dirname(__FILE__)));

