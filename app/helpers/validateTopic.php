<?php 

function validateTopic($topic)
{
	$errors = array();

	if (empty($topic['name']))
		array_push($errors, 'Name is required');

	$existingTopic = selectOne('topics', ['name' => $topic['name']]);
	if ($existingTopic)

		/* Tenemos que hacer esta comprobación para saber si el post se está creando
		por primera vez o estamos editándolo, ya que si lo editamos y no hacemos esta
		comprobación, nunca nos dejará guardar los cambios con el mismo título, ya que
		ese título ya existe en la base de datos. Si se ha pulsado el botón de editar
		y además el id del post de la base de datos NO coincide con el que editamos, entonces
		mostramos el error. */
		if ((isset($topic['update-topic']) && $existingTopic['id'] != $topic['id']) || isset($_POST['add-topic']))
			array_push($errors, 'Name already exists');
		
	return ($errors);
}

?>