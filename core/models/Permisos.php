<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

final class Permisos extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  # Control de errores
  final public function errores(array $data) {
    try {

      $requeridos = array(
        'rol' => $data['rol']
      );

      if(!Func::all_full($requeridos)) {
        throw new Exception('<b>Error:</b> Faltan datos por llenar.');
      }

      return false;
    } catch(Exception $e) {
      return array('success' => 0, 'message' => $e->getMessage());
    }
  }

  final public function Foo(array $data) : array {

    $error = $this->errores($data);
    if(false !== $error) {
      return $error;
    }
    
    $this->db->delete('permisos',"peridrol=".$data['rol'],'');
    foreach ($data['paginas'] as $pag) {
      $peredita="N";
      $perelimina="N";


      if ($pag['permiso']=="edita") {
        $peredita="S";
      }else if ($pag['permiso']=="elimina") {
        $perelimina="S";
      }else  if ($pag['permiso']=="edyel") {
        $peredita="S";
        $perelimina="S";
      }

      $i = array('perpag' => $pag['id'],
        'peridrol' => $data['rol'],
        'peredita' => $peredita,
        'perelimina' => $perelimina,
      );

      $this->db->insert('permisos',$i);

    }

    return array('success' => 1, 'message' => 'Permisos registrados con éxito');
  }

   # Leer roles
  final public function getRolesActivos() {
    
    return $this->db->select('rolid,rolname','role',"rolestado='AC'");
  }
  # Leer paginas
  final public function getPaginas() {
    
    return $this->db->select('pagid,pagname','paginas',"1=1");
  }

  # Leer permisos
  final public function getPermisos(array $data) {
    
    return $this->db->select('*','permisos',"peridrol=".$data['rol']);
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
