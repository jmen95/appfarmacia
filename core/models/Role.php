<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

final class Role extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  # Control de errores
  final public function errores(array $data) {
    try {

      $i = array(
        'rolname' => $data['nombre'],
        'rolestado' => $data['estado']
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
      'rolname' => $data['nombre'],
      'rolestado' => $data['estado'],
      'roldesc' => $data['descripcion']
    );
    $this->db->insert('role',$i);

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
      'rolname' => $data['nombre'],
      'rolestado' => $data['estado'],
      'roldesc' => $data['descripcion']
    );

    $this->db->update('role',$i,"rolid='$this->id'",'LIMIT 1');

    return array('success' => 1, 'message' => '<b>Editado</b> con éxito.');
  }

  # Borrar un elemento
  final public function borrar() {
    $this->db->delete('role',"id='$this->id'");
    Func::redir(URL . 'role/');
  }

  # Leer uno o todos los elementos
  final public function leer(bool $multi = true) {
    if($multi) {
      return $this->db->select('*','role');
    }

    return $this->db->select('*','role',"rolid='$this->id'");
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
