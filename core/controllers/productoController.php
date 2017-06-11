<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class productoController extends Controllers {

  public function __construct() {
    parent::__construct(true);

    $m = new Producto;
    $g = new General;

    switch($this->method) {
      case 'crear':
        Helper::load('bootstrap');
        $laboratorios = array('' =>'Seleccione uno');
        foreach ($m->getLaboratoriosActivos() as $row) {
          $laboratorios[$row['labcodigo']]=$row['labnombre'];
        }
        $categorias = array('' =>'Seleccione uno');
        foreach ($m->getCategoriasActivas() as $row) {
          $categorias[$row['catcodigo']]=$row['catnombre'];
        }
        $unidades = array('' =>'Seleccione uno');
        foreach ($m->getUnidadesActivas() as $row) {
          $unidades[$row['tideCodigo']]=$row['tideNombre'];
        }
        $sucursalUsuario = $m->getSucursalUsuario();

        $sucursal = array('' =>'Seleccione una');
        foreach ($g->getSucursalesActivas() as $suc) {
          $sucursal[$suc['id']]=$suc['sucname'];
        }
        $id_user=$m->getIdUsuario();

        echo $this->template->render('producto/crear',array(
          'laboratorios' => $laboratorios, 
          'categorias' => $categorias, 
          'unidades' => $unidades, 
          'sucursalUsuario' => $sucursalUsuario[0][0], 
          'sucursal' => $sucursal,
          'id_user' => $id_user
        ));
        
      break;
      case 'editar':
        if($this->isset_id and false !== ($item = $m->leer(false))) {
          echo $this->template->render('producto/editar', array(
            'data' => $item[0]
          ));
        } else {
          Func::redir(URL . 'producto/');
        }
      break;
      case 'eliminar':
        $m->borrar();
      break;
      default:
        Helper::load('bootstrap');
        echo $this->template->render('producto/producto',array(
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
