TFCBlog de Pablo Herranz Cano.

Hay dos opciones de visualizar este proyecto:
	- En local.
	- En la url http://pabloherranzcano.herokuapp.com

Si lo queremos ver en local, lo primero que tenemos que hacer es modificar el archivo path.php en la raíz del proyecto (donde
está este README) para modificar las variables ROOT_URL y BASE_URL, que son las encargadas de que los links funcionen.
Y seguidamente, el achivo connection.php que está dentro de /app/database.

Este paso es necesario porque está configurado para que funcione todo correctamente una vez desplegada la web en heroku.

