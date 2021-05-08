<?php 

/*
** Lo primero que hacemos aquí es un include (o require) del 
** archivo connection.php, que es el que nos permite conectarnos
** con la base de datos.
*/
require("connection.php");

function printData($value) // SE ELIMINARÁ
{
	/* Como la función print_r imprime un 1 por ahí, lo que
	hacemos es pasarle "true" como segundo parámetro */
	echo "<pre>", print_r($value, true), "</pre>";
	
	/* Es necesario parar la ejecución de esta parte */
	die();
}



/**********************************************************************************/
/**********************************************************************************/
/*********************************** C  R  U  D ***********************************/
/**********************************************************************************/
/**********************************************************************************/



/********************************************/
/****************** R E A D *****************/
/********************************************/
/* 
** Función para modularizar el código, ya que esta parte se repite en las
** funciones siguientes "selectAll" y "selectOne".
*/
function executeQuery($sql, $data)
{
	global $connection;

	$stmt = $connection->prepare($sql);
	$values = array_values($data);
	$types = str_repeat('s', count($values));
	$stmt->bind_param($types, ...$values); //ENTENDERLO
	$stmt->execute();

	return ($stmt);
}
/*
** Esta función es para ahorrarnos líneas de código y mostrar los
** registros de la tabla que queramos. El segundo parámetro es opcional,
** ya que habrá veces que no queramos mostrar TODOS los registros de la consulta
** y simplemente quqeramos ver los registros que coincidan con una condición
** que le digamos.
**
** Para hacer un parámetro opcional, lo iniciamos en los paréntesis.
** 
** Si no se pasan condiciones por parámetro (si "conditions" está vacío),
** mostramos todos los registros. Else... modificamos la query para mostrar
** los que coincidan con esa condición.
*/
function selectAll($table, $conditions =[])
{
	global $connection;

	$sql = "SELECT * FROM $table";
	if (empty($conditions))
	{
		$stmt = $connection->prepare($sql);
		$stmt->execute();
		$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
		return ($records);
	}

	/* Con este foreach lo que hacemos es crear una query con las condiciones
	que le pasemos por parámetro a la función. */
	$i = 0;
	foreach ($conditions as $key => $value) {
		if ($i == 0)
			$sql = $sql . " WHERE $key=?";
		else
			$sql = $sql . " AND $key=?";
		$i++;
	}
	
	// /* Para añadirle un poco más de seguridad a nuestro blog y a nuestras consultas,
	// añadimos las condiciones a la query en un paso extra */
	$stmt = executeQuery($sql, $conditions);
	$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
	return ($records);
}

/*
** Esta función nos muestra sólo un registro que coincida con la condición (esta vez obligatoria)
** que le pasemos como argumento.
** 
** Ya no usaremos la función fetch_all, y usaremos simplemente fetch_assoc.
*/
function selectOne($table, $conditions)
{
	global $connection;

	$sql = "SELECT * FROM $table";

	/* Con este foreach lo que hacemos es crear una query con las condiciones
	que le pasemos por parámetro a la función. */
	$i = 0;
	foreach ($conditions as $key => $value) {
		if ($i == 0)
			$sql = $sql . " WHERE $key=?";
		else
			$sql = $sql . " AND $key=?";
		$i++;
	}
	
	/* Como esta función lo que hace es mirar todos los registros (podemos estar hablando de
	millones) para después mostrarnos el primero que coincida con los criterios de búsqueda,
	añadimos a la query "LIMIT 1" para que una vez haya encontrado el primer registro que coincida,
	deje de buscar. De esta forma, nuestro programa será más eficiente. */
	$sql = $sql . " LIMIT 1";

	// /* Para añadirle un poco más de seguridad a nuestro blog y a nuestras consultas,
	// añadimos las condiciones a la query en un paso extra */
	$stmt = executeQuery($sql, $conditions);
	$records = $stmt->get_result()->fetch_assoc();
	return ($records);
}

/********************************************/
/**************** C R E A T E ***************/
/********************************************/
/*
** Hay dos formas de insertar datos en una base de datos:
** 		1- "INSERT INTO users (username, admin, email, password) VALUES (?, ?, ?, ?)"
** 		2- "INSERT INTO users SET username=?, admin=?, email=?, password=?"
**
** En esta función nos centraremos en crear la query de la forma 2.
*/
function create($table, $data)
{
	global $connection;

	$sql = "INSERT INTO $table SET";

	/* ForEach para crear la query. Sentencia if para poner o no la coma que separa los campos. */
	$i = 0;
	foreach ($data as $key => $value) {
		if ($i == 0)
			$sql = $sql . " $key=?";
		else
			$sql = $sql . ", $key=?";
		$i++;
	}

	$stmt = executeQuery($sql, $data);
	$id = $stmt->insert_id;
	
	return ($id);
}

/********************************************/
/**************** U P D A T E ***************/
/********************************************/
/*
** La query para actualizar los datos de un registro de la tabla sería algo como esto:
** 		2- "UPDATE users SET username=?, admin=?, email=?, password=? WHERE id=?"
**
** En esta función nos centraremos en crear esta query.
*/
function update($table, $id, $data)
{
	global $connection;
	
	$sql = "UPDATE $table SET";
	
	/* ForEach para crear la query. Sentencia if para poner o no la coma que separa los campos. */
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
** 		2- "DELETE FROM users WHERE id=9
**
** En esta función nos centraremos en crear esta query.
**
** Como en esta función no recibe $data, que es uno de los argumentos
** de "executeQuery", le pasamos el "id" del array
*/
function delete($table, $id)
{
	global $connection;
	
	$sql = "DELETE FROM $table WHERE id=?";
	
	$stmt = executeQuery($sql, ['id' => $id]);
	return ($stmt->affected_rows);
}

$data = [
	'username' => 'Pablooooooooo',
	'admin' => 0,
	'email' => 'pablo111@gmail.com',
	'password' => 'Enrique'
];

// $user_id = create('users', $data);
// $user = selectOne('users', ['id' => $user_id]);

// printData($user);
?>