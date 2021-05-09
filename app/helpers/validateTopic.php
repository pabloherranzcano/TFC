<?php 

function validateTopic($topic)
{
	$errors = array();

	if (empty($topic['name']))
		array_push($errors, 'Name is required');

	$existingTopic = selectOne('topics', ['name' => $topic['name']]);
	// No utilizamos isset, porque en alguans versiones de PHP siempre es true, entonces no tendría sentido.
	if ($existingTopic)
		array_push($errors, 'Name already exists');
		
	return ($errors);
}

?>