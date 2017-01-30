<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class permisosController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Permisos();

    Helper::load('bootstrap');
    $roles = array('' =>'Seleccione uno');
    foreach ($m->getRolesActivos() as $rol) {
      $roles[$rol['rolid']]=$rol['rolname'];
    }
    
    echo $this->template->render('permisos/permisos',array(
          'roles' => $roles,
          'paginas' => $m->getPaginas()
          ));
  }

}

?>
