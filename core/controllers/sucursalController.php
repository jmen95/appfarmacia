<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class sucursalController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Sucursal;

    switch($this->method) {
      case 'crear':
        Helper::load('bootstrap');
        $empresa = array('' =>'Seleccione una');
        foreach ($m->getEmpresas() as $emp) {
          $empresa[$emp['id']]=$emp['empname'];
        }
        echo $this->template->render('sucursal/crear',array(
          'empresa' => $empresa
          ));
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
           Helper::load('bootstrap');
          $empresa = array('' =>'Seleccione una');
          foreach ($m->getEmpresas() as $emp) {
            $empresa[$emp['id']]=$emp['empname'];
          }
          echo $this->template->render('sucursal/editar', array(
            'data' => $item[0],
            'empresa' => $empresa
          ));
        } else {
          Func::redir(URL . 'sucursal/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('sucursal/sucursal',array(
          'data' => $m->leer()
        ));
      break;
    }
  }

}

?>
