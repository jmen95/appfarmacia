<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

/*
$app->post('/example4',function($request, $response){

  $e = new Example;
  $response->withJson($e->Foo($_POST));

  return $response;
});
*/

//------------------------------------------------

/**
  * Registro de un usuario
  * @return Devuelve un json con informaci贸n acerca del 茅xito o posibles errores.
*/
$app->post('/register',function($request, $response){

  $reg = new Register;
  $response->withJson($reg->SignUp($_POST));

  return $response;
});

//------------------------------------------------

/**
  * Inicio de Sesi贸n
  * @return Devuelve un json con informaci贸n acerca del 茅xito o posibles errores.
*/
$app->post('/login',function($request, $response) {

  $login = new Login;
  $response->withJson($login->SignIn($_POST));

  return $response;
});

//------------------------------------------------

/**
	* Recuperaci贸n de contrase帽a perdida
	* @return Devuelve un json con informaci贸n acerca del 茅xito o posibles errores.
*/
$app->post('/lostpass',function($request, $response) {

	$model = new Lostpass;
	$response->withJson($model->RepairPass($_POST));

	return $response;
});



/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/users/editar',function($request, $response) {

	$model = new Users;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/users/crear',function($request, $response) {

	$model = new Users;
	$response->withJson($model->crear($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/role/editar',function($request, $response) {

	$model = new Role;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/role/crear',function($request, $response) {

	$model = new Role;
	$response->withJson($model->crear($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/sucursal/editar',function($request, $response) {

	$model = new Sucursal;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/sucursal/crear',function($request, $response) {

	$model = new Sucursal;
	$response->withJson($model->crear($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/empresa/editar',function($request, $response) {

	$model = new Empresa;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/empresa/crear',function($request, $response) {

	$model = new Empresa;
	$response->withJson($model->crear($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/permisos',function($request, $response) {

	$model = new Permisos;
	$response->withJson($model->foo($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/marca/editar',function($request, $response) {

	$model = new Marca;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/marca/crear',function($request, $response) {

	$model = new Marca;
	$response->withJson($model->crear($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/categoria/editar',function($request, $response) {

	$model = new Categoria;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/categoria/crear',function($request, $response) {

	$model = new Categoria;
	$response->withJson($model->crear($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/unidades/editar',function($request, $response) {

	$model = new Unidades;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/unidades/crear',function($request, $response) {

	$model = new Unidades;
	$response->withJson($model->crear($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/producto/editar',function($request, $response) {

	$model = new Producto;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/producto/crear',function($request, $response) {

	$model = new Producto;
	$response->withJson($model->crear($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/presentacion/editar',function($request, $response) {

	$model = new Presentacion;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/presentacion/crear',function($request, $response) {

	$model = new Presentacion;
	$response->withJson($model->crear($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/proveedor/editar',function($request, $response) {

	$model = new Proveedor;
	$response->withJson($model->editar($_POST));

	return $response;
});

/**
	* 縬ue hace (el modelo que se invoca desde aqui)?
	* @return Devuelve un json con informaci髇 acerca del 閤ito o posibles errores. 
*/
$app->post('/proveedor/crear',function($request, $response) {

	$model = new Proveedor;
	$response->withJson($model->crear($_POST));

	return $response;
});