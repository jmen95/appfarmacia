<?= $this->insert('overall/header')?>

<body>

<?= $this->insert('overall/topnav')?>

  <div class="ts-main-content">

    <?= $this->insert('overall/menu')?>

    <div class="content-wrapper">
      <div class="container-fluid">

        <div class="row">
          <div class="col-md-12">
          
            <h2 class="page-title">Blank page</h2>
            
            <div class="well">
              <form id="{{action}}_form" role="form">
                  <div class="alert hide" id="ajax_{{action}}"></div>
                  <div class="form-group">
                    <label class="cole">Ejemplo:</label>
                    <input type="text" class="form-control form-input" name="ejemplo" placeholder="Escribe algo..." />
                  </div>
                  <div class="form-group">
                    <button type="button" id="{{action}}" class="btn btn-primary  center-block">Enviar</button>
                </div>
              </form>

            </div>
            
          </div>
        </div>
        
        <?= $this->insert('overall/inner_footer')?>

      </div>
    </div>
  </div>




<?= $this->insert('overall/footer')?>
<script src="views/app/js/{{action}}.js"></script>
</body>

</html>