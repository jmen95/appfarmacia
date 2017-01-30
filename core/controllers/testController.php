<?php

# Seguridad
defined('INDEX_DIR') OR exit('Ocrend software says .i.');

//------------------------------------------------

class testController extends Controllers {

  public function __construct() {
    parent::__construct();
    Helper::load('strings');

    echo Strings::hash('123');

    // echo $this->template->render('test/test');
  }

}

?>
