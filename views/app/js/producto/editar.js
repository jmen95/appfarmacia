$('#producto').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_producto').removeClass('alert-danger');
  $('#ajax_producto').removeClass('alert-warning');
  $('#ajax_producto').addClass('alert-warning');
  $("#ajax_producto").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_producto').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/producto/editar",
    data : $('#producto_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_producto').html(success_icon + obj.message);
        $("#ajax_producto").removeClass('alert-warning');
        $("#ajax_producto").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_producto').html(error_icon  + obj.message);
        $("#ajax_producto").removeClass('alert-warning');
        $("#ajax_producto").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#producto ERORR');
    }
  });
});
