$('#role').click(function(){

  var error_icon = '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ',
      success_icon = '<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> ',
      process_icon = '<span class="fa fa-spinner fa-spin" aria-hidden="true"></span> ';

  $('#ajax_role').removeClass('alert-danger');
  $('#ajax_role').removeClass('alert-warning');
  $('#ajax_role').addClass('alert-warning');
  $("#ajax_role").html(process_icon  + 'Procesando por favor espere...');
  $('#ajax_role').removeClass('hide');

  $.ajax({
    type : "POST",
    url : "api/role/editar",
    data : $('#role_form').serialize(),
    success : function(json) {
      var obj = jQuery.parseJSON(json);
      if(obj.success == 1) {
        $('#ajax_role').html(success_icon + obj.message);
        $("#ajax_role").removeClass('alert-warning');
        $("#ajax_role").addClass('alert-success');
        setTimeout(function(){
          location.reload();
        },1000);
      } else {
        $('#ajax_role').html(error_icon  + obj.message);
        $("#ajax_role").removeClass('alert-warning');
        $("#ajax_role").addClass('alert-danger');
      }
    },
    error : function() {
      window.alert('#role ERORR');
    }
  });
});
