<?php 

function validatePost($post)
{
	$errors = array();

	if (empty($post['title']))
		array_push($errors, 'Title is required');
	
	if (empty($post['body']))
		array_push($errors, 'Body is required');	
	
	if (empty($post['topic_id']))
		array_push($errors, 'Please select a topic');


	$existingPost = selectOne('posts', ['title' => $post['title']]);
	if ($existingPost)

		/* Tenemos que hacer esta comprobación para saber si el post se está creando
		por primera vez o estamos editándolo, ya que si lo editamos y no hacemos esta
		comprobación, nunca nos dejará guardar los cambios con el mismo título, ya que
		ese título ya existe en la base de datos. Si se ha pulsado el botón de editar
		y además el id del post de la base de datos NO coincide con el que editamos, entonces
		mostramos el error. */

		/* Necesitamos saber si el usuario está creando el post o editándolo, para ello
		comprobamos si lo que se pasa por POST es update o add, y en caso de update, tenemos
		que comprobar dsi el id del post fetcheado (proveeniente de la BDD es igual al que ha
		llegado por POST. */
		if ((isset($post['update-post']) && $existingPost['id'] != $post['id']) || isset($_POST['add-post']))
			array_push($errors, 'Post with that title already exists');
		
	return ($errors);
}


?>