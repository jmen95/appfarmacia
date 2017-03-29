$('#categoria').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_categoria').removeClass('alert-danger');
  $('#ajax_categoria').removeClass('alert-warning');
  $('#ajax_categoria').addClass('alert-warning');
  $("#ajax_categoria").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_categoria').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/categoria/editar",
    data : $('#categoria_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_categoria').html(success_icon + obj.message);
        $("#ajax_categoria").removeClass('alert-warning');
        $("#ajax_categoria").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_categoria').html(error_icon  + obj.message);
        $("#ajax_categoria").removeClass('alert-warning');
        $("#ajax_categoria").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#categoria ERORR');
    }
  });
});
