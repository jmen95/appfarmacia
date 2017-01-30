$('#sucursal').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_sucursal').removeClass('alert-danger');
  $('#ajax_sucursal').removeClass('alert-warning');
  $('#ajax_sucursal').addClass('alert-warning');
  $("#ajax_sucursal").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_sucursal').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/sucursal/crear",
    data : $('#sucursal_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_sucursal').html(success_icon + obj.message);
        $("#ajax_sucursal").removeClass('alert-warning');
        $("#ajax_sucursal").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_sucursal').html(error_icon  + obj.message);
        $("#ajax_sucursal").removeClass('alert-warning');
        $("#ajax_sucursal").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#sucursal ERORR');
    }
  });
});
