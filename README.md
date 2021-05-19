TFCBlog | Pablo Herranz Cano.

Hay dos opciones de visualizar este proyecto:
	- En local.
	- En la url http://pabloherranzcano.herokuapp.com

También nos lo podemos descargar entero de aquí: https://github.com/pabloherranzcano/TFC

Lo primero quee tenemos que hacer es abrir el arhcivo config.php y comentar lo que queramos, depeendiendo de cómo queramos ver la página.
Si tenemos conexión a intternet, con modificar el path valdría, ya que la base de datos, aparte de en local, también está colgada en
remotedatamysql.com.

Está configurado de serie para que funcione todo correctamente una vez desplegada la web en heroku.

El planteamientoe es el siguiente:
	- Distinguimos dos partes de la web: la relacionada con el diseño (front) y la relacionada con el back.
	- La parte del front está repartida por la raíz y la carpeta "/assets".

El recorrido que sigue la web para funcionar parece complejo pero es simple.

El código está comentado todo lo mejor que he podido, así que espero que sea útil cada una de las líneas comentadas que irás
encontrando a lo largo de este laberinto de archivos. El primero sería la página index.php (si no eres administrador o ni siquiera estás
registrsado). Si tienes permisos de adminsitrador (user: "admin", pass: "admin"), podrás acceder al dashboard y de ahí a las
diferentes zonas de gestión: usuarios, comentarios, posts, topics y contacto.

El orden de creación de los paneles de admin fueron: topics, users y post, y después comments y contact. Se puede ver cómo el cansancio hizo que
empezara comentando muy fuerte, y acabara comentando cada vez menos cosas en esos últimos.

El archivo "db.php" en la carpeta "/app/databaase/" es el cerebro de todo esto. En él se encuentran los prototipos de las funciones
que nos permitirán hacer las consultas CRUD a la base de datos que, por cierto, también incluyo en la raíz de esta carpeta.
Después, la carpeta "/app/controllers" es la encargada darle dinamismo a la web. Hace muchas llamadas a las funciones de db.php para mostrar
una cosa u otra dependiendo de dónde nos encontremos y qué queramos ver.


Y eso es todo, parece más de lo que en realidad es. Si has llegado hasta aquí, sólo me queda darte ánimos para empeezar el viaje.





