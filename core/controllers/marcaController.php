<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class marcaController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Marca;

    switch($this->method) {
      case 'crear':
        echo $this->template->render('marca/crear');
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
          echo $this->template->render('marca/editar', array(
            'data' => $item[0]
          ));
        } else {
          Func::redir(URL . 'marca/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('marca/marca',array(
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
