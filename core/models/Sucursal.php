<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

final class Sucursal extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  # Control de errores
  final public function errores(array $data) {
    try {

      $requeridos = array(
        'sucname' => $data['nombre'],
        'sucdir' => $data['direccion'],
        'empresa' => $data['empresa'],
        'sucdesc' => $data['descripcion']
      );

      if(!Func::all_full($requeridos)) {
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

    $principal=$data['principal']??0;

    $i = array(
      'sucname' => $data['nombre'],
      'sucdesc' => $data['descripcion'],
      'suctel' => $data['telefono'],
      'empresa' => $data['empresa'],
      'sucdir' => $data['direccion'],
      'principal' => $principal
    );

    $e = array('principal' => 0);

    $this->db->update('sucursal',$e,"empresa=".$data['empresa'],'');

    $this->db->insert('sucursal',$i);

    return array('success' => 1, 'message' => '<b>Creado</b> con éxito.');
  }

  # Editar un elemento
  final public function editar(array $data) : array {

    $this->id = $this->db->scape($data['id']);

    $error = $this->errores($data);
    if(false !== $error) {
      return $error;
    }

    $principal=$data['principal']??0;

    $i = array(
      'sucname' => $data['nombre'],
      'sucdesc' => $data['descripcion'],
      'suctel' => $data['telefono'],
      'empresa' => $data['empresa'],
      'sucdir' => $data['direccion'],
      'principal' => $principal
    );

    $e = array('principal' => 0);

    $this->db->update('sucursal',$e,"empresa='".$data['empresa']."'",'');

    $this->db->update('sucursal',$i,"id='$this->id'",'LIMIT 1');

    return array('success' => 1, 'message' => '<b>Editado</b> con éxito.');
  }

  # Borrar un elemento
  final public function borrar() {
    $this->db->delete('sucursal',"id='$this->id'");
    Func::redir(URL . 'sucursal/');
  }

  # Leer uno o todos los elementos
  final public function leer(bool $multi = true) {
    if($multi) {
      return $this->db->select('s.*,empname','sucursal s inner join empresa e on e.id=s.empresa');
    }

    return $this->db->select('*','sucursal',"id='$this->id'");
  }

  # Leer empresas
  final public function getEmpresas() {
    
    return $this->db->select('id,empname','empresa',"1=1");
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
