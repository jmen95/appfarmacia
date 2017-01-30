<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class roleController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Role;

    switch($this->method) {
      case 'crear':
        echo $this->template->render('role/crear');
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
          echo $this->template->render('role/editar', array(
            'data' => $item[0]
          ));
        } else {
          Func::redir(URL . 'role/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('role/role',array(
          'data' => $m->leer()
        ));
      break;
    }
  }

}

?>
