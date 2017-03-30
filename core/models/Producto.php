<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

final class Producto extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  # Control de errores
  final public function errores(array $data) {
    try {

    $i = array(
      'proCodigoBarra' => $data['codigobarra'],
      'proNombre' => $data['nombre'],
      'proMarCodigo' => $data['marca'],
      'proValorCompra' => $data['valorcompra'],
      'proStockMinimo' => $data['stockminimo'],
      'proStockBodega' => $data['stockbodega'],
      'proGruCodigo' => $data['categoria'],
      'proEstado' => $data['estado'],
      'proUbicacion' => $data['ubicacion'],
      'proImagen' => $data['estado'],
      'proFechaModificacion' => $data['estado'],
      'proTipoDescarga' => $data['estado'],
      'proReferencia' => $data['estado'],
      'proLote' => $data['estado'],
      'proIdUsuario' => $data['estado'],
      'sucursal' => $data['estado']
    );

      if(!Func::all_full($i)) {
        throw new Exception('<b>Error:</b> Faltan datos por llenar.');
      }

      return false;
    } catch(Exception $e) {
      return array('success' => 0, 'message' => $e->getMessage());
    }
  }

  # Crear un elemento
  final public function crear(array $data) : array {
    $error = $this->errores($data);
    if(false !== $error) {
      return $error;
    }

    $i = array(
      'proCodigoBarra' => $data['codigobarra'],
      'proNombre' => $data['nombre'],
      'proMarCodigo' => $data['marca'],
      'proValorCompra' => $data['valorcompra'],
      'proStockMinimo' => $data['stockminimo'],
      'proStockBodega' => $data['stockbodega'],
      'proGruCodigo' => $data['categoria'],
      'proEstado' => $data['estado'],
      'proUbicacion' => $data['ubicacion'],
      'proImagen' => $data['estado'],
      'proFechaModificacion' => $data['estado'],
      'proTipoDescarga' => $data['estado'],
      'proReferencia' => $data['estado'],
      'proLote' => $data['estado'],
      'proIdUsuario' => $data['estado'],
      'sucursal' => $data['estado']
    );
    $this->db->insert('producto',$i);

    return array('success' => 1, 'message' => '<b>Creado</b> con éxito.');
  }

  # Editar un elemento
  final public function editar(array $data) : array {

    $this->id = $this->db->scape($data['proCodigoBarra']);

    $error = $this->errores($data);
    if(false !== $error) {
      return $error;
    }

    $i = array(
      'proNombre' => $data['nombre'],
      'proMarCodigo' => $data['marca'],
      'proValorCompra' => $data['valorcompra'],
      'proStockMinimo' => $data['stockminimo'],
      'proStockBodega' => $data['stockbodega'],
      'proGruCodigo' => $data['categoria'],
      'proEstado' => $data['estado'],
      'proUbicacion' => $data['ubicacion'],
      'proImagen' => $data['estado'],
      'proFechaModificacion' => $data['estado'],
      'proTipoDescarga' => $data['estado'],
      'proReferencia' => $data['estado'],
      'proLote' => $data['estado'],
      'proIdUsuario' => $data['estado'],
      'sucursal' => $data['estado']
    );
    $this->db->update('producto',$i,"proCodigoBarra='$this->id'",'LIMIT 1');

    return array('success' => 1, 'message' => '<b>Editado</b> con éxito.');
  }

  # Borrar un elemento
  final public function borrar() {
    $this->id = $this->db->scape($this->id);
    $i = array(
      'proEstado' => "IN"
    );
    $this->db->update('producto',$i,"proCodigoBarra='$this->id'",'LIMIT 1');
    Func::redir(URL . 'producto/');
  }

  # Leer uno o todos los elementos
  final public function leer(bool $multi = true) {
    if($multi) {
      return $this->db->select('*','producto');
    }

    return $this->db->select('*','producto',"id='$this->id'");
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
