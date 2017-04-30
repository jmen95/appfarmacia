<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class proveedorController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Proveedor;

    switch($this->method) {
      case 'crear':
        echo $this->template->render('proveedor/crear');
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
          echo $this->template->render('proveedor/editar', array(
            'data' => $item[0]
          ));
        } else {
          Func::redir(URL . 'proveedor/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('proveedor/proveedor',array(
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
