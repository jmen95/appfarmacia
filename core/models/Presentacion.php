<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

final class Presentacion extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  # Control de errores
  final public function errores(array $data) {
    try {

      $i = array(
        'prenombre' => $data['nombre'],
        'preestado' => $data['estado']
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
      'prenombre' => $data['nombre'],
      'predescripcion' => $data['descripcion'],
      'preestado' => $data['estado']
    );
    $this->db->insert('presentacion',$i);

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
      'prenombre' => $data['nombre'],
      'predescripcion' => $data['descripcion'],
      'preestado' => $data['estado']
    );
    $this->db->update('presentacion',$i,"id='$this->id'",'LIMIT 1');

    return array('success' => 1, 'message' => '<b>Editado</b> con éxito.');
  }

  # Borrar un elemento
  final public function borrar() {
    $this->db->delete('presentacion',"id='$this->id'");
    Func::redir(URL . 'presentacion/');
  }

  # Leer uno o todos los elementos
  final public function leer(bool $multi = true) {
    if($multi) {
      return $this->db->select('*','presentacion');
    }

    return $this->db->select('*','presentacion',"id='$this->id'");
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
