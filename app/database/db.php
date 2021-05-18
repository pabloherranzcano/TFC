<?php

/* db.php es el cerebro de las operaciones CRUD. Aquí están definidas
** las funciones que interactuarán con al base de datos. De esta forma
** cumplimos con el objetivo de modularizar el código.
** 
** Lo primero que hacemos aquí es iniciar una sesión en este archivo,
** porque así no tenemos que iniciarla en todos los demás.
*/
session_start();

/*
** Lo segundo que hacemos es un include (o require) del archivo connection.php,
** que es el que nos permite conectarnos
** con la base de datos.
*/
require("connection.php");

/**********************************************************************************/
/**********************************************************************************/
/*********************************** C  R  U  D ***********************************/
/**********************************************************************************/
/**********************************************************************************/

/********************************************/
/**************** C R E A T E ***************/
/********************************************/

/*
** Hay dos formas de insertar datos en una base de datos:
** 		1- "INSERT INTO users (username, admin, email, password) VALUES (?, ?, ?, ?)"
** 		2- "INSERT INTO users SET username=?, admin=?, email=?, password=?"
**
** En esta función nos centraremos en crear la query de la forma nº 2.
**
** ForEach para crear la query. Sentencia if para poner o no la coma que separa los campos.
*/
function create($table, $data)
{
	global $connection;

	$sql = "INSERT INTO $table SET";

	if ($table == "contact" || $table == "comments") {
		$i = 0;
		foreach ($data as $key => $value) {
			if ($i == 0)
				$sql = $sql . " $key='$value'";
			else
				$sql = $sql . ", $key='$value'";
			$i++;
		}
		$sql = $sql . ", created_at=now();";
	} else {
		foreach ($data as $key => $value) {
			if ($i == 0)
				$sql = $sql . " $key=?";
			else
				$sql = $sql . ", $key=?";
			$i++;
		}
	}

	echo var_dump($sql);

	$stmt = executeQuery($sql, $data);
	$id = $stmt->insert_id;

	return ($id);
}

/********************************************/
/****************** R E A D *****************/
/********************************************/

/* 
** "executeQuery()" es una función para modularizar el código, ya que ésta parte
** se repite en las funciones siguientes: "selectAll" y "selectOne".

** También forma parte de un paso extra que ejecutamos para añadirle un poco más de
** seguridad a nuestro blog y a nuestras consultas.
** 
** Extraemos todos los valores del array $data y comprobamos cuantos valores de tipo "s" (String)
** hay en el aray. Los metemos forzadamenete en String para evitar problemas con la base de datos).
** 
** bind_param vincula un parámetro al nombre de variable especificado.
*/
function executeQuery($sql, $data)
{
	global $connection;

	$stmt = $connection->prepare($sql);
	$values = array_values($data);
	$types = str_repeat('s', count($values));
	$stmt->bind_param($types, ...$values);
	$stmt->execute();

	return ($stmt);
}

/*
** Esta función es para mostrar los registros de la tabla que queramos.
** El segundo parámetro es opcional, ya que habrá veces que no queramos mostrar
** TODOS los registros de la consulta y simplemente queramos ver los registros
** que coincidan con una condición determinada.
**
** Para hacer un parámetro opcional, lo iniciamos en los paréntesis.
** 
** Si no se pasan condiciones por parámetro (si "conditions" está vacío),
** mostramos todos los registros. Else... modificamos la query para mostrar
** los que coincidan con esa condición.
**
**
** Con el foreach lo que hacemos es crear una query con las condiciones
** que le pasemos por parámetro a la función.
*/
function selectAll($table, $conditions = [])
{
	global $connection;

	$sql = "SELECT * FROM $table";
	if (empty($conditions)) {
		$stmt = $connection->prepare($sql);
		$stmt->execute();
		$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

		return ($records);
	}

	$i = 0;
	foreach ($conditions as $key => $value) {
		if ($i == 0)
			$sql = $sql . " WHERE $key=?";
		else
			$sql = $sql . " AND $key=?";
		$i++;
	}

	$stmt = executeQuery($sql, $conditions);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

	return ($records);
}

/*
** Esta función nos muestra sólo un registro que coincida con la condición (esta vez obligatoria)
** que le pasemos como argumento.
** 
** Ya no usaremos la función fetch_all, y usaremos simplemente fetch_assoc.
**
** Con el foreach lo que hacemos es crear una query con las condiciones
** que le pasemos por parámetro a la función.
** 
** Como esta función lo que hace es mirar todos los registros (podemos estar hablando de
** millones) para después mostrarnos el primero que coincida con los criterios de búsqueda,
** concatenamos a la query "LIMIT 1" para que una vez haya encontrado el primer registro que coincida,
** deje de buscar. De esta forma, nuestro programa será más eficiente.
*/
function selectOne($table, $conditions)
{
	global $connection;

	$sql = "SELECT * FROM $table";

	$i = 0;
	foreach ($conditions as $key => $value) {
		if ($i == 0)
			$sql = $sql . " WHERE $key=?";
		else
			$sql = $sql . " AND $key=?";
		$i++;
	}

	$sql = $sql . " LIMIT 1";

	$stmt = executeQuery($sql, $conditions);
	$records = $stmt->get_result()->fetch_assoc();

	return ($records);
}

/********************************************/
/**************** U P D A T E ***************/
/********************************************/

/*
** La query para actualizar los datos de un registro de la tabla sería algo como esto:
** 		2- "UPDATE users SET username=?, admin=?, email=?, password=? WHERE id=?"
**
** En esta función nos centraremos en crear esta query.
**
** ForEach para crear la query. Sentencia if para poner o no la coma que separa los campos.
*/
function update($table, $id, $data)
{
	global $connection;

	$sql = "UPDATE $table SET";

	$i = 0;
	foreach ($data as $key => $value) {
		if ($i == 0)
			$sql = $sql . " $key=?";
		else
			$sql = $sql . ", $key=?";
		$i++;
	}
	$sql = $sql . " WHERE id=?";
	$data['id'] = $id;

	$stmt = executeQuery($sql, $data);

	return ($stmt->affected_rows);
}

/********************************************/
/**************** D E L E T E ***************/
/********************************************/

/*
** La query para eliminar una fila de la tabla sería algo como esto:
** 		2- "DELETE FROM users WHERE id=9"
**
** En esta función nos centraremos en crear esta query.
**
** Como en esta función no recibe $data, que es uno de los argumentos
** de "executeQuery()", le pasamos el "id" del array
*/
function delete($table, $id)
{
	global $connection;

	$sql = "DELETE FROM $table WHERE id=?";

	$stmt = executeQuery($sql, ['id' => $id]);
	return ($stmt->affected_rows);
}

/*
** Función para saber quién ha escrito un post publicado, ya que user_id es foreign key de la tabla POSTS, y no podremos obtener
** el nombre del "user_id" sin hacer un inner join en la consulta
** 
** SELECT p.*, u.username
** 			FROM posts AS p
** 			JOIN users AS u
** 			ON p.user_id=u.id
** 			WHERE p.published=?
** 
** Ponemos ? en p.published para poder pasarlo como condición a la hora de llamar a executeQuery, que recibe
** la query sql y una condición.
*/
function getPublishedPosts()
{
	global $connection;

	$sql = "SELECT p.*, u.username
			FROM posts AS p
			JOIN users AS u
			ON p.user_id=u.id
			WHERE p.published=?";
	$stmt = executeQuery($sql, ['published' => 1]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return ($records);
}

/*
** Función para saber quién ha escrito un post. Recogemos todos los datos de los posts, y de ahí extraemos
** quién es el autor.
** 
** SELECT p.*, u.username
** 			FROM posts AS p
** 			JOIN users AS u
** 			ON p.user_id=u.id;
** 			WHERE published=0
** 			AND published=1"
** 
** Ponemos ? en p.published para poder pasarlo como condición a la hora de llamar a executeQuery, que recibe
** la query sql y una condición.
*/
function getAllPostsRecords()
{
	global $connection;

	$sql = "SELECT p.*, u.username
			FROM posts AS p
			JOIN users AS u
			ON p.user_id=u.id
			WHERE p.published=0
			OR p.published=?";
	$stmt = executeQuery($sql, ['published' => 1]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return ($records);
}
/*
** Función para buscar posts. Le entra por parámetro la palabra a buscar. Es muy parecida a getPublishedPosts,
** sólo que añadiendo AND y OR. Sería como decirle "búscame los posts publicados y cuyo título O cuerpo contenga
** (%?%) la palabra que le entre por parámetro (la que metamos en el buscador). 
** 
** SELECT p.*, u.username
** 			FROM posts AS p
** 			JOIN users AS u
** 			ON p.user_id=u.id
** 			WHERE p.published=?
** 			AND p.title LIKE %?% 
** 			OR p.body LIKE %?%
** 
** Variable match necesaria para 'stringify' la variable $term, ya que a la query hay que pasarle un string.
*/
function searchPosts($term)
{
	global $connection;

	$match = '%' . $term . '%';

	$sql = "SELECT p.*, u.username
			FROM posts AS p
			JOIN users AS u
			ON p.user_id=u.id
			WHERE p.published=?
			AND p.title LIKE ? 
			OR p.body LIKE ?";
	$stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return ($records);
}

/*
** Función para buscar toos los posts de una temática determinada. Le entra por parámetro el id de la temática.
** Es muy parecida a getPublishedPosts, sólo que añadiendo AND. Sería como decirle "búscame los posts publicados 
** que pertenezcan a la temática (topic_id) X.
** 
** SELECT p.*, u.username
** 			FROM posts AS p
** 			JOIN users AS u
** 			ON p.user_id=u.id
** 			WHERE p.published=?
** 			AND topic_id =?
** 
** Variable match necesaria para 'stringify' la variable $term, ya que a la query hay que pasarle un string.
*/
function getPostsByTopic($topic_id)
{
	global $connection;

	$sql = "SELECT p.*, u.username
			FROM posts AS p
			JOIN users AS u
			ON p.user_id=u.id
			WHERE p.published=?
			AND topic_id =?";
	$stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return ($records);
}
