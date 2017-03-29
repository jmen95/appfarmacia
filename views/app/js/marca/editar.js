$('#marca').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_marca').removeClass('alert-danger');
  $('#ajax_marca').removeClass('alert-warning');
  $('#ajax_marca').addClass('alert-warning');
  $("#ajax_marca").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_marca').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/marca/editar",
    data : $('#marca_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_marca').html(success_icon + obj.message);
        $("#ajax_marca").removeClass('alert-warning');
        $("#ajax_marca").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_marca').html(error_icon  + obj.message);
        $("#ajax_marca").removeClass('alert-warning');
        $("#ajax_marca").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#marca ERORR');
    }
  });
});
