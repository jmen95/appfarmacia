<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class usersController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Users;

    $g = new General;

    switch($this->method) {
      case 'crear':
        Helper::load('bootstrap');
        $roles = array('' =>'Seleccione uno');
        foreach ($m->getRolesActivos() as $rol) {
          $roles[$rol['rolid']]=$rol['rolname'];
        }
        $sucursal = array('' =>'Seleccione una');
        foreach ($g->getSucursalesActivas() as $suc) {
          $sucursal[$suc['id']]=$suc['sucname'];
        }
         
        echo $this->template->render('users/crear',array(
          'roles' => $roles,
          'sucursal' => $sucursal
          ));
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
          Helper::load('bootstrap');
          $roles = array('' =>'Seleccione uno');
          foreach ($m->getRolesActivos() as $rol) {
            $roles[$rol['rolid']]=$rol['rolname'];
          }
           $sucursal = array('' =>'Seleccione una');
          foreach ($g->getSucursalesActivas() as $suc) {
            $sucursal[$suc['id']]=$suc['sucname'];
          }
          echo $this->template->render('users/editar', array(
            'data' => $item[0],
            'roles' => $roles,
            'sucursal' => $sucursal
          ));
        } else {
          Func::redir(URL . 'users/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('users/users',array(
          'data' => $m->leer(),
          'edita' => $this->edita,
          'elimina' => $this->elimina,
          'crea' => $this->crea
        ));
      break;
    }
  }

}

?>
