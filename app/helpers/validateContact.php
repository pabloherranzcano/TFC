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
function validateContact($post)
{
	$errors = 0;

	if (empty($post['name']))
		$errors++;

	if (empty($post['email']))
		$errors++;

	if (empty($post['message']))
		$errors++;

	return ($errors);
}
