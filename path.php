<?php
	/* Como hay varios directorios a los que apuntamos a 
	** través de hipervínculos, creamos la constante ROOT_PATH
	** para no liarnos con las rutas relativas. 
	*/
	define("ROOT_PATH", realpath(dirname(__FILE__)));

	/* Como hay varios directorios a los que apuntamos a 
	** través de hipervínculos, creamos la constante ROOT_PATH
	** para no liarnos con las rutas relativas. 
	*/
	define("BASE_URL", "http://localhost:3000");
?>