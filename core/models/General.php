<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

final class General extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  # Leer sucursales
  final public function getSucursalesActivas() {
    
    return $this->db->select('id,sucname','sucursal',"estado='AC'");
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
