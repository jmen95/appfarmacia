<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

abstract class Controllers {

  //------------------------------------------------

  protected $template;
  protected $isset_id;
  protected $method;
  protected $route;
  protected $page;
  protected $session = null;

  //------------------------------------------------

  /**
    * Constructor, inicializa los alcances de todos los Controladores
    *
    * @param bool $LOGED: Si el controlador en cuestión será exclusivamente para usuarios logeados, se pasa TRUE
    * @param bool $UNLOGED: Si el controlador en cuestión será exclusivamente para usuarios NO logeados, se pasa TRUE
    *
    * @return void
  */
  protected function __construct(bool $LOGED = false, bool $UNLOGED = false) {

    global $router;

    # Accedemos a el router para URL's amigables
    $this->route = $router;

    # Control de vida de sesiones
    if(DB_SESSION) {
      $this->session = new Sessions;
      $this->session->check_life();
    }

    # Restricción para usuarios logeados
    if($LOGED and !isset($_SESSION[SESS_APP_ID])) {
      Func::redir(URL . 'logout');
      exit;
    }

    if($LOGED){
      $paginas = array_merge($_SESSION['MENU'], $_SESSION['MENUHIJOS']);

     
     
     $key = array_search($this->route->getControllerName(), array_column($paginas, 'pagurl'));

     if(false!=$key){

          echo var_dump($paginas[$key]['peredita  ']);
     }else{
          echo "no";
     }
    

    
      exit;
      // $this->session = new Sessions;
      // $this->session->check_life();
    }

    # Restricción de página para ser visa sólamente por usuarios No logeados
    if($UNLOGED and isset($_SESSION[SESS_APP_ID])) {
      Func::redir();
      exit;
    }

    # Carga del template
    $this->template = new League\Plates\Engine('templates','phtml');

    # Debug
    if(DEBUG) {
      $_SESSION['___QUERY_DEBUG___'] = array();
    }

    # Utilidades
    $this->method = ($router->getMethod() != null and Strings::alphanumeric($router->getMethod())) ? $router->getMethod() : null;
    $this->isset_id = ($router->getId() != null and is_numeric($router->getId()) and $router->getId() >= 1);
    $this->page = $this->route->getControllerName();

  }

}

?>
