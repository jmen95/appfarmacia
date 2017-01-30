<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

final class Users extends Models implements OCREND {

  public function __construct() {
    parent::__construct();
  }

  # Control de errores
  final public function errores(array $data, bool $editpass = true, bool $crear = true) {
    try {

      if($editpass){
        $requeridos = array(
          'userdoc' => $data['cedula'],
          'username' => $data['nombre'],
          'usercorreo' => $data['correo'],
          'userusu' => $data['usuario'],
          'userpass' => $data['pass'],
          'rol' => $data['rol'],
          'sucursal' => $data['sucursal'],
          'userestado' => $data['estado']
        );
      }else{
        $requeridos = array(
        'userdoc' => $data['cedula'],
        'username' => $data['nombre'],
        'usercorreo' => $data['correo'],
        'userusu' => $data['usuario'],
        'rol' => $data['rol'],
        'sucursal' => $data['sucursal'],
        'userestado' => $data['estado']
      );
      }
      

      if(!Func::all_full($requeridos)) {
        throw new Exception('<b>Error:</b> Faltan datos por llenar.');
      }

      if($editpass And $data['pass']!=$data['pass2']){
        throw new Exception('<b>Error:</b> Las contraseñas no coinciden.');
      }

      Helper::load('strings');

      if(!Strings::is_email($data['correo'])) {
        throw new Exception('<b>Error:</b> Email no tiene un formato válido.');
      }

      if(!is_numeric($data['cedula'])) {
        throw new Exception('<b>Error:</b> la cédula no tiene el formato correcto.');
      }

      $user = $this->db->scape($data['usuario']);
      $email = $this->db->scape($data['correo']);
      $doc = $this->db->scape($data['cedula']);

      
      if ($crear) {
        $u = $this->db->select('userusu,usercorreo,userdoc','users',"userusu='$user' OR usercorreo='$email' OR userdoc='$doc'",'LIMIT 1');
        if(false != $u) {
          if(strtolower($u[0][0]) == strtolower($user)) {
            throw new Exception('<b>Error:</b> El usuario ya existe.');
          } else if(strtolower($u[0][1]) == strtolower($email)) {
            throw new Exception('<b>Error:</b> El email ya existe.');
          }else{
            throw new Exception('<b>Error:</b> La cédula ya existe.');
          }
        }
      }else{
        $u = $this->db->select('userusu,usercorreo,userdoc','users',"(userusu='$user' OR usercorreo='$email' OR userdoc='$doc') AND userid<>'$this->id'",'LIMIT 1');
        if(false != $u) {
          if(strtolower($u[0][0]) == strtolower($user)) {
            throw new Exception('<b>Error:</b> El usuario ya existe.');
          } else if(strtolower($u[0][1]) == strtolower($email)) {
            throw new Exception('<b>Error:</b> El email ya existe.');
          }else{
            throw new Exception('<b>Error:</b> La cédula ya existe.');
          }
        }
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

    Helper::load('strings');

    $i = array(
      'userdoc' => $data['cedula'],
      'username' => $data['nombre'],
      'usertele' => $data['telefono'],
      'userdir' => $data['direccion'],
      'usercorreo' => $data['correo'],
      'userusu' => $data['usuario'],
      'userpass' => Strings::hash($data['pass']),
      'rol' => $data['rol'],
      'sucursal' => $data['sucursal'],
      'userestado' => $data['estado']
    );
    $this->db->insert('users',$i);

    return array('success' => 1, 'message' => '<b>Creado</b> con éxito.');
  }

  # Editar un elemento
  final public function editar(array $data) : array {

    $this->id = $this->db->scape($data['id']);

    $error = $this->errores($data,isset($data['editpass']),false);
    if(false !== $error) {
      return $error;
    }

    Helper::load('strings');

    if(isset($data['editpass'])){
       $i = array(
        'userdoc' => $data['cedula'],
        'username' => $data['nombre'],
        'usertele' => $data['telefono'],
        'userdir' => $data['direccion'],
        'usercorreo' => $data['correo'],
        'userusu' => $data['usuario'],
        'userpass' => Strings::hash($data['pass']),
        'rol' => $data['rol'],
        'sucursal' => $data['sucursal'],
        'userestado' => $data['estado']
      );
    }else{
       $i = array(
        'userdoc' => $data['cedula'],
        'username' => $data['nombre'],
        'usertele' => $data['telefono'],
        'userdir' => $data['direccion'],
        'usercorreo' => $data['correo'],
        'userusu' => $data['usuario'],
        'rol' => $data['rol'],
        'sucursal' => $data['sucursal'],
        'userestado' => $data['estado']
      );
    }

   
    $this->db->update('users',$i,"userid='$this->id'",'LIMIT 1');

    return array('success' => 1, 'message' => '<b>Editado</b> con éxito.');
  }

  # Borrar un elemento
  final public function borrar() {
    $this->db->delete('users',"userid='$this->id'");
    Func::redir(URL . 'users/');
  }

  # Leer uno o todos los elementos
  final public function leer(bool $multi = true) {
    if($multi) {
      return $this->db->select('u.*,sucname,rolname','users u inner join sucursal s on s.id=u.sucursal inner join role r on r.rolid=u.rol');
    }

    return $this->db->select('*','users',"userid='$this->id'");
  }

  # Leer roles
  final public function getRolesActivos() {
    
    return $this->db->select('rolid,rolname','role',"rolestado='AC'");
  }
  # Leer sucursales
  final public function getSucursales() {
    
    return $this->db->select('id,sucname','sucursal',"1=1");
  }

  public function __destruct() {
    parent::__destruct();
  }

}

?>
