$('#unidades').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_unidades').removeClass('alert-danger');
  $('#ajax_unidades').removeClass('alert-warning');
  $('#ajax_unidades').addClass('alert-warning');
  $("#ajax_unidades").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_unidades').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/unidades/crear",
    data : $('#unidades_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_unidades').html(success_icon + obj.message);
        $("#ajax_unidades").removeClass('alert-warning');
        $("#ajax_unidades").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_unidades').html(error_icon  + obj.message);
        $("#ajax_unidades").removeClass('alert-warning');
        $("#ajax_unidades").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#unidades ERORR');
    }
  });
});
