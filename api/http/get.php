<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

/*
$app->get('/example2',function($request, $response){

  $e = new Example;
  $response->withJson($e->Foo($_GET));

  return $response;
});
*/

$app->get('/permisos',function($request, $response){

  $e = new Permisos;
  $response->withJson($e->getPermisos($_GET));

  return $response;
});
