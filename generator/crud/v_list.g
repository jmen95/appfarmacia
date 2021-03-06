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

            <h2>Listado</h2>
            
            <div class="well">
              <div class="form-actions">

                <div class="panel-heading">Table by DataTables plugin</div>
                  <div class="panel-body">
                    <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>#</th>
                          <?php  if(false!=$edita): ?>
                          <th></th>
                          <?php  endif ?>
                          <?php  if(false!=$elimina): ?>
                          <th></th>
                          <?php  endif ?>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <?php  if(false!=$edita): ?>
                          <th></th>
                          <?php  endif ?>
                          <?php  if(false!=$elimina): ?>
                          <th></th>
                          <?php  endif ?>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php foreach(false != $data ? $data : array() as $d): ?>
                        <tr>
                          <td><?= $d['id'] ?></td>
                          <?php  if(false!=$edita): ?>
                          <td><a href="{{action}}/editar/<?= $d['id'] ?>">Editar</a></td>
                          <?php  endif ?>
                          <?php  if(false!=$elimina): ?>
                          <td><a href="{{action}}/eliminar/<?= $d['id'] ?>">Eliminar</a></td>
                          <?php  endif ?>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                <?php  if(false!=$crea): ?>
                <a class="btn btn-primary" href="{{action}}/crear">Crear</a>
                <?php  endif ?>
              </div>
            </div>
            
          </div>
        </div>
        
      </div>
        <?= $this->insert('overall/inner_footer')?>

    </div>
  </div>

<?= $this->insert('overall/footer')?>

</body>

</html>