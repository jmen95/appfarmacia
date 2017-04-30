<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class presentacionController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Presentacion;

    switch($this->method) {
      case 'crear':
        echo $this->template->render('presentacion/crear');
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
          echo $this->template->render('presentacion/editar', array(
            'data' => $item[0]
          ));
        } else {
          Func::redir(URL . 'presentacion/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('presentacion/presentacion',array(
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
