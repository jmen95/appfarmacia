<?= $this->insert('overall/header')?>

<body>

<?= $this->insert('overall/topnav')?>

  <div class="ts-main-content">

    <?= $this->insert('overall/menu')?>

    <div class="content-wrapper">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
          
            <h1 class="page-title">{{model}}</h1>

            <h2>Creación</h2>
            
            <div class="col-lg-2"></div>
            <div class="well col-lg-8">
              <div class="form-actions">
                <div class="panel panel-default">
                  <div class="panel-heading">Crear {{model}}</div>
                  <div class="panel-body">
                    <form id="{{action}}_form" role="form">
                      <div class="alert hide" id="ajax_{{action}}"></div>
                      <div class="col-lg-4 form-group">
                        <label class="cole">Ejemplo:</label>
                        <input type="text" class="form-control form-input" name="ejemplo" placeholder="Escribe algo..." />
                      </div>
                      <div class="col-lg-12">
                        <div class="form-group">
                          <button type="button" id="{{action}}" class="btn btn-primary  center-block">Enviar</button>
                        </div>
                      </div>
                    </form>
                  </div>

                </div>
                

              </div>
              <a class="btn btn-primary" href="{{action}}">Ver listado</a>
            </div>
            <div class="col-lg-2"></div> 
            
          </div>
        </div>
        
        <?= $this->insert('overall/inner_footer')?>

      </div>
    </div>
  </div>




<?= $this->insert('overall/footer')?>
<script src="views/app/js/{{action}}/crear.js"></script>
</body>

</html>