$('#proveedor').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_proveedor').removeClass('alert-danger');
  $('#ajax_proveedor').removeClass('alert-warning');
  $('#ajax_proveedor').addClass('alert-warning');
  $("#ajax_proveedor").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_proveedor').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/proveedor/editar",
    data : $('#proveedor_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_proveedor').html(success_icon + obj.message);
        $("#ajax_proveedor").removeClass('alert-warning');
        $("#ajax_proveedor").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_proveedor').html(error_icon  + obj.message);
        $("#ajax_proveedor").removeClass('alert-warning');
        $("#ajax_proveedor").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#proveedor ERORR');
    }
  });
});
