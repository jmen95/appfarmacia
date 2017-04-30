$('#presentacion').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_presentacion').removeClass('alert-danger');
  $('#ajax_presentacion').removeClass('alert-warning');
  $('#ajax_presentacion').addClass('alert-warning');
  $("#ajax_presentacion").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_presentacion').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/presentacion/crear",
    data : $('#presentacion_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_presentacion').html(success_icon + obj.message);
        $("#ajax_presentacion").removeClass('alert-warning');
        $("#ajax_presentacion").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_presentacion').html(error_icon  + obj.message);
        $("#ajax_presentacion").removeClass('alert-warning');
        $("#ajax_presentacion").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#presentacion ERORR');
    }
  });
});
