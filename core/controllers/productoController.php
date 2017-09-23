<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class productoController extends Controllers {

    public function __construct() {
        parent::__construct(true);

        $m = new Producto;
        $g = new General;

        switch ($this->method) {
            case 'crear':
                Helper::load('bootstrap');
                $laboratorios = array('' => 'Seleccione uno');
                $laboratorioss = $m->getLaboratoriosActivos();
                if ($laboratorioss != false)
                    foreach ($laboratorioss as $row) {
                        $laboratorios[$row['labcodigo']] = $row['labnombre'];
                    }
                $categorias = array('' => 'Seleccione uno');
                $categoriass = $m->getCategoriasActivas();
                if ($categoriass != false)
                    foreach ($categoriass as $row) {
                        $categorias[$row['catcodigo']] = $row['catnombre'];
                    }
                $unidades = array('' => 'Seleccione uno');
                $unidadess = $m->getUnidadesActivas();
                if ($unidadess != false)
                    foreach ($unidadess as $row) {
                        $unidades[$row['undcodigo']] = $row['undnombre'];
                    }
                $unidadesventa = array('' => 'Seleccione uno');
                $unidadesventas = $m->getUnidadesVentasActivas();
                if ($unidadesventas != false)
                    foreach ($unidadesventas as $row) {
                        $unidadesventa[$row['id']] = $row['nombre'];
                    }
                $presentacion = array('' => 'Seleccione uno');
                $presentacions = $m->getPresentacionesActivas();
                if ($presentacions != false)
                    foreach ($presentacions as $row) {
                        $presentacion[$row['id']] = $row['nombre'];
                    }
                $formafarmaceutica = array('' => 'Seleccione uno');
                $formafarmaceuticas = $m->getFormasFarmaceuticasActivas();
                if ($formafarmaceuticas != false)
                    foreach ($formafarmaceuticas as $row) {
                        $formafarmaceutica[$row['id']] = $row['nombre'];
                    }
                $sucursalUsuario = $m->getSucursalUsuario();

                $sucursal = array('' => 'Seleccione una');
                $sucursals = $g->getSucursalesActivas();
                if ($sucursals != false)
                    foreach ($sucursals as $suc) {
                        $sucursal[$suc['id']] = $suc['sucname'];
                    }

                $principio = array('' => 'Seleccione una');
                $principios = $m->getPrincipiosActivos();
                if ($principios != false)
                    foreach ($principios as $row) {
                        $principio[$row['id']] = $row['nombre'];
                    }

                $id_user = $m->getIdUsuario();

                echo $this->template->render('producto/crear', array(
                    'laboratorios' => $laboratorios,
                    'categorias' => $categorias,
                    'unidades' => $unidades,
                    'unidadesventa' => $unidadesventa,
                    'presentacion' => $presentacion,
                    'formafarmaceutica' => $formafarmaceutica,
                    'sucursalUsuario' => $sucursalUsuario[0][0],
                    'sucursal' => $sucursal,
                    'principio' => $principio,
                    'id_user' => $id_user
                ));

                break;
            case 'editar':
                if ($this->isset_id and false !== ($item = $m->leer(false))) {
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
                echo $this->template->render('producto/producto', array(
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
