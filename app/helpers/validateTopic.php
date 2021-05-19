<?php 

/*
** Función para comprobar que un topic está listo para publicarse.
** 
** Tenemos que hacer la última comprobación para saber si el topic se está creando
** por primera vez o estamos editándolo, ya que si lo editamos y no hacemos esta
** comprobación, nunca nos dejará guardar los cambios con el mismo nombre, ya que
** ese nombre ya existe en la base de datos. Si se ha pulsado el botón de editar
** y además el id del post de la base de datos NO coincide con el que editamos, entonces
** mostramos el error.
*/
function validateTopic($topic)
{
	$errors = array();

	if (empty($topic['name']))
		array_push($errors, 'Name is required');

	$existingTopic = selectOne('topics', ['name' => $topic['name']]);
	if ($existingTopic)

	if ((isset($topic['update-topic']) && $existingTopic['id'] != $topic['id']) || isset($_POST['add-topic']))
		array_push($errors, "Ya existe la categoría " . "'" . $topic['name'] . "'");
		
	return ($errors);
}

?>