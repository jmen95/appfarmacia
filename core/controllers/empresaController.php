<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class empresaController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Empresa;

    switch($this->method) {
      case 'crear':
        echo $this->template->render('empresa/crear');
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
          echo $this->template->render('empresa/editar', array(
            'data' => $item[0]
          ));
        } else {
          Func::redir(URL . 'empresa/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('empresa/empresa',array(
          'data' => $m->leer()
        ));
      break;
    }
  }

}

?>
