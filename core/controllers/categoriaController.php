<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class categoriaController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Categoria;

    switch($this->method) {
      case 'crear':
        echo $this->template->render('categoria/crear');
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
          echo $this->template->render('categoria/editar', array(
            'data' => $item[0]
          ));
        } else {
          Func::redir(URL . 'categoria/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('categoria/categoria',array(
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
