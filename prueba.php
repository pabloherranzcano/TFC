<?php 
include "path.php";
include ROOT_PATH . "/app/database/db.php";

$data = [
	'username' => 'Carlota',
	'admin' => 0,
	'email' => 'pablo111@gmail.com',
	'password' => 'Enrique'
];

$user_id = create('users', $data);
$user = selectOne('users', ['id' => $user_id]);

printData($user); 
?>