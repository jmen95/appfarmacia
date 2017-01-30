<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

/*
$app->map(['GET', 'POST'], '/example3',function($request, $response){

  $e = new Example;
  $response->withJson($e->Foo($_POST || $_GET));

  return $response;
});
*/

$app->map(['GET', 'POST'], '/test',function($request, $response){

  
  $response->withJson(array('name' => 'Jesus','doc' => '1042450864' ));

  return $response;
});

?>
