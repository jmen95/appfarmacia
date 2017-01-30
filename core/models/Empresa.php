<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

final class Empresa extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  # Control de errores
  final public function errores(array $data) {
    try {

      if(!Func::all_full($data)) {
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
      'empname' => $data['nombre'],
      'empdesc' => $data['descripcion'],
      'empnit' => $data['nit']
    );
    $this->db->insert('empresa',$i);

    return array('success' => 1, 'message' => '<b>Creado</b> con éxito.');
  }

  # Editar un elemento
  final public function editar(array $data) : array {

    $this->id = $this->db->scape($data['id']);

    $error = $this->errores($data);
    if(false !== $error) {
      return $error;
    }

   $i = array(
      'empname' => $data['nombre'],
      'empdesc' => $data['descripcion'],
      'empnit' => $data['nit']
    );
   
    $this->db->update('empresa',$i,"id='$this->id'",'LIMIT 1');

    return array('success' => 1, 'message' => '<b>Editado</b> con éxito.');
  }

  # Borrar un elemento
  final public function borrar() {
    $this->db->delete('empresa',"id='$this->id'");
    Func::redir(URL . 'empresa/');
  }

  # Leer uno o todos los elementos
  final public function leer(bool $multi = true) {
    if($multi) {
      return $this->db->select('*','empresa');
    }

    return $this->db->select('*','empresa',"id='$this->id'");
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
