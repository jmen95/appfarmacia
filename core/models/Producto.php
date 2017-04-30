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
      'proGruCodigo' => $data['categoria'],
      'proEstado' => $data['estado'],
      'proUbicacion' => $data['ubicacion'],
      'proTipoDescarga' => $data['unidadmedida'],
      'proReferencia' => $data['referencia'],
      'proIdUsuario' => $data['idusuario'],
      'sucursal' => $data['sucursal']
    );

      if(!Func::all_full($i)) {
        throw new Exception('<b>Error:</b> Faltan datos por llenar.');
      }

      $l = array('codlote' => null);
      if($data['lotmultiple']=="S"){
        $l = array(
          'codlote' => $data['codlote'][0], 
          'cantidad' => $data['cantidad'][0], 
          'fechavencimiento' => $data['fechavencimiento'][0], 
          'iva' => $data['iva'][0]
        );
      }else{
        $l = array(
          'codlote' => $data['codlote'], 
          'cantidad' => $data['cantidad'], 
          'fechavencimiento' => $data['fechavencimiento'], 
          'iva' => $data['iva']
        );
      }

      if(!Func::all_full($l)) {
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
      'proGruCodigo' => $data['categoria'],
      'proEstado' => $data['estado'],
      'proUbicacion' => $data['ubicacion'],
      'proTipoDescarga' => $data['unidadmedida'],
      'proReferencia' => $data['referencia'],
      'proIdUsuario' => $data['idusuario'],
      'sucursal' => $data['sucursal']
    );
    $this->db->insert('producto',$i);

    $l = array('codlote' => null);
    if($data['lotmultiple']=="S"){
      for ($j=0; $j < $data['codlote']; $j++) {
        $lotpiva=0;
        $lotiva=0;
        if($data['tipoiva'][i]=='P'){
          $lotpiva=$data['iva'][i];
          // $lotiva=$data['iva'][i];
        }else{
          
        }
        $l = array(
          'codlote' => $data['codlote'][i], 
          'cantidad' => $data['cantidad'][i], 
          'fechavencimiento' => $data['fechavencimiento'][i], 
          'tipoiva' => $data['tipoiva'][i],
          'iva' => $data['iva'][i]
        );

        $this->db->insert('lotes',$l);


      }
      
    }else{
      $l = array(
        'codlote' => $data['codlote'], 
        'cantidad' => $data['cantidad'], 
        'fechavencimiento' => $data['fechavencimiento'], 
        'tipoiva' => $data['tipoiva'],
        'iva' => $data['iva']
      );
      $this->db->insert('lotes',$l);
    }

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
      'proCodigoBarra' => $data['codigobarra'],
      'proNombre' => $data['nombre'],
      'proMarCodigo' => $data['marca'],
      'proValorCompra' => $data['valorcompra'],
      'proStockMinimo' => $data['stockminimo'],
      'proGruCodigo' => $data['categoria'],
      'proEstado' => $data['estado'],
      'proUbicacion' => $data['ubicacion'],
      'proTipoDescarga' => $data['unidadmedida'],
      'proReferencia' => $data['referencia'],
      'proIdUsuario' => $data['idusuario'],
      'sucursal' => $data['sucursal']
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

    return $this->db->select('*','producto',"proCodigoBarra='$this->id'");
  }

  # Leer Marcas
  final public function getMarcasActivos() {
    
    return $this->db->select('marCodigo,marNombre','marca',"marEstado='AC'");
  }

  # Leer Grupos
  final public function getGruposActivos() {
    
    return $this->db->select('gruCodigo,gruNombre','grupo',"gruEstado='AC'");
  }

  # Leer unidades de medida
  final public function getUnidadesActivas() {
    
    return $this->db->select('tideCodigo,tideNombre','tipodescarga',"tideEstado='AC'");
  }

  # Leer sucursal del usuario logueado
  final public function getSucursalUsuario() {
    
    return $this->db->select('sucursal','users',"userid=$this->id_user");
  }

  # Leer id usuario
  final public function getIdUsuario() {
    
    return $this->id_user;
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
