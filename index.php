<?php

require_once __DIR__.'/vendor/autoload.php';


$app = new Silex\Application();

$app->get('/comments', function () {
	$data = array('name' => 'name', 'text' => 'comment');
	$data_string = json_encode($data);
   return $data_string;
});


$app->post('/comment', function () {
	return "ok";
});

$app->put('/comment/{id}', function($id) {
	return $id;
});

$app->run();
