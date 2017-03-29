<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class unidadesController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Unidades;

    switch($this->method) {
      case 'crear':
        echo $this->template->render('unidades/crear');
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
          echo $this->template->render('unidades/editar', array(
            'data' => $item[0]
          ));
        } else {
          Func::redir(URL . 'unidades/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('unidades/unidades',array(
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
