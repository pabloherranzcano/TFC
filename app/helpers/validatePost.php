<?php

/*
** Función para comprobar que un post está listo para publicarse.
** 
** Tenemos que hacer la última comprobación para saber si el post se está creando
** por primera vez o estamos editándolo, ya que si lo editamos y no hacemos esta
** comprobación, nunca nos dejará guardar los cambios con el mismo título, ya que
** ese título ya existe en la base de datos. Si se ha pulsado el botón de editar
** y además el id del post de la base de datos NO coincide con el que estamos editando,
** entonces mostramos el error.
*/
function validatePost($post)
{
	$errors = array();

	if (empty($post['title']))
		array_push($errors, 'Escribe un título.');

	if (empty($post['body']))
		array_push($errors, 'Escribe algo en el post.');

	if (empty($post['topic_id']))
		array_push($errors, 'Selecciona un topic');


	$existingPost = selectOne('posts', ['title' => $post['title']]);
	if ($existingPost) {
		if ((isset($post['update-post']) && $existingPost['id'] != $post['id']) || isset($_POST['add-post']))
			array_push($errors, 'Ya existe un post con ese título.');
	}
	return ($errors);
}
