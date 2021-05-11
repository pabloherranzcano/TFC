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
	// LOCAL
	// define("BASE_URL", "http://localhost:3000");

	// DEPLOYED
	define("BASE_URL", "https://pabloherranzcano.herokuapp.com");
?>